<?php
/**
 * RefCo Supply - Email Notification Endpoint
 * Handles email subscriptions with CSRF protection and rate limiting
 */

// Start session for CSRF token validation
session_start();

// Set content type to JSON
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// CORS headers (adjust origins as needed for production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'ok' => false,
        'error' => 'Method not allowed. Only POST requests are accepted.'
    ]);
    exit;
}

/**
 * Rate limiting function
 * Prevents spam by limiting submissions per IP address
 */
function isRateLimited($ip, $timeWindow = 60, $maxAttempts = 3) {
    $rateLimitFile = 'rate_limit.json';
    $currentTime = time();
    
    // Load existing rate limit data
    $rateLimitData = [];
    if (file_exists($rateLimitFile)) {
        $content = file_get_contents($rateLimitFile);
        if ($content) {
            $rateLimitData = json_decode($content, true) ?: [];
        }
    }
    
    // Clean old entries
    $rateLimitData = array_filter($rateLimitData, function($data) use ($currentTime, $timeWindow) {
        return ($currentTime - $data['first_attempt']) < $timeWindow;
    });
    
    // Check current IP
    if (!isset($rateLimitData[$ip])) {
        $rateLimitData[$ip] = [
            'attempts' => 1,
            'first_attempt' => $currentTime,
            'last_attempt' => $currentTime
        ];
    } else {
        $rateLimitData[$ip]['attempts']++;
        $rateLimitData[$ip]['last_attempt'] = $currentTime;
        
        if ($rateLimitData[$ip]['attempts'] > $maxAttempts) {
            return true; // Rate limited
        }
    }
    
    // Save rate limit data
    file_put_contents($rateLimitFile, json_encode($rateLimitData));
    
    return false; // Not rate limited
}

/**
 * Validate and sanitize email address
 */
function validateEmail($email) {
    $email = trim($email);
    
    if (empty($email)) {
        return false;
    }
    
    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    // Additional security checks
    if (strlen($email) > 254) {
        return false;
    }
    
    // Check for dangerous characters
    $dangerous = ['<', '>', '"', "'", '&', '\r', '\n', '\t'];
    foreach ($dangerous as $char) {
        if (strpos($email, $char) !== false) {
            return false;
        }
    }
    
    return $email;
}

/**
 * Validate and sanitize name
 */
function validateName($name) {
    $name = trim($name);
    
    if (empty($name)) {
        return ''; // Name is optional
    }
    
    // Limit length
    if (strlen($name) > 100) {
        $name = substr($name, 0, 100);
    }
    
    // Remove dangerous characters but allow international characters
    $name = preg_replace('/[<>"\'\&\r\n\t]/', '', $name);
    
    return $name;
}

/**
 * Check if email already exists in subscribers list
 */
function emailExists($email, $csvFile) {
    if (!file_exists($csvFile)) {
        return false;
    }
    
    $handle = fopen($csvFile, 'r');
    if (!$handle) {
        return false;
    }
    
    // Skip header row
    fgetcsv($handle);
    
    while (($data = fgetcsv($handle)) !== false) {
        if (isset($data[0]) && strtolower(trim($data[0])) === strtolower($email)) {
            fclose($handle);
            return true;
        }
    }
    
    fclose($handle);
    return false;
}

/**
 * Save subscriber to CSV file
 */
function saveSubscriber($email, $name, $csvFile) {
    $fileExists = file_exists($csvFile);
    
    // Create directory if it doesn't exist
    $dir = dirname($csvFile);
    if (!is_dir($dir)) {
        if (!mkdir($dir, 0755, true)) {
            throw new Exception('Failed to create subscribers directory');
        }
    }
    
    $handle = fopen($csvFile, 'a');
    if (!$handle) {
        throw new Exception('Failed to open subscribers file');
    }
    
    // Add header if file is new
    if (!$fileExists || filesize($csvFile) === 0) {
        fputcsv($handle, ['Email', 'Name', 'Subscription Date', 'IP Address', 'User Agent']);
    }
    
    // Add subscriber data
    $data = [
        $email,
        $name,
        date('Y-m-d H:i:s'),
        $_SERVER['REMOTE_ADDR'] ?? 'Unknown',
        substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown', 0, 200) // Limit user agent length
    ];
    
    $result = fputcsv($handle, $data);
    fclose($handle);
    
    if (!$result) {
        throw new Exception('Failed to write subscriber data');
    }
    
    return true;
}

try {
    // Get client IP for rate limiting
    $clientIP = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $forwardedIPs = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $clientIP = trim($forwardedIPs[0]);
    }
    
    // Rate limiting check
    if (isRateLimited($clientIP)) {
        http_response_code(429);
        echo json_encode([
            'ok' => false,
            'error' => 'Too many requests. Please wait before submitting again.'
        ]);
        exit;
    }
    
    // CSRF token validation
    $submittedToken = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'] ?? '';
    
    if (empty($submittedToken) || empty($sessionToken) || !hash_equals($sessionToken, $submittedToken)) {
        http_response_code(403);
        echo json_encode([
            'ok' => false,
            'error' => 'Invalid security token. Please refresh the page and try again.'
        ]);
        exit;
    }
    
    // Validate and sanitize input
    $email = validateEmail($_POST['email'] ?? '');
    $name = validateName($_POST['name'] ?? '');
    
    if (!$email) {
        http_response_code(400);
        echo json_encode([
            'ok' => false,
            'error' => 'Please provide a valid email address.'
        ]);
        exit;
    }
    
    // Check for honeypot field (basic bot protection)
    if (!empty($_POST['website']) || !empty($_POST['url'])) {
        // Likely a bot
        http_response_code(400);
        echo json_encode([
            'ok' => false,
            'error' => 'Invalid submission detected.'
        ]);
        exit;
    }
    
    // Define CSV file path
    $csvFile = 'subscribers.csv';
    
    // Check if email already exists
    if (emailExists($email, $csvFile)) {
        // Don't reveal that email exists, just return success
        echo json_encode([
            'ok' => true,
            'message' => 'Thank you! You will be notified when we launch.'
        ]);
        exit;
    }
    
    // Save subscriber
    saveSubscriber($email, $name, $csvFile);
    
    // Log successful subscription (optional)
    error_log("New RefCo Supply subscriber: $email from IP: $clientIP");
    
    // Success response
    echo json_encode([
        'ok' => true,
        'message' => 'Thank you! You have been successfully subscribed to our launch notifications.'
    ]);
    
} catch (Exception $e) {
    // Log error
    error_log("RefCo Supply notification error: " . $e->getMessage());
    
    // Return generic error to user
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => 'We apologize, but there was a technical issue. Please try again later.'
    ]);
} catch (Error $e) {
    // Log fatal error
    error_log("RefCo Supply notification fatal error: " . $e->getMessage());
    
    // Return generic error to user
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => 'We apologize, but there was a technical issue. Please try again later.'
    ]);
}

// Regenerate CSRF token for next request
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>