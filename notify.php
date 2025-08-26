<?php
session_start();

// Headers for JSON response
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// Initialize response
$response = ['ok' => false];

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['error'] = 'Method not allowed';
    http_response_code(405);
    echo json_encode($response);
    exit;
}

// CSRF validation
if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token'])) {
    $response['error'] = 'Invalid request';
    http_response_code(403);
    echo json_encode($response);
    exit;
}

if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $response['error'] = 'Invalid request';
    http_response_code(403);
    echo json_encode($response);
    exit;
}

// Rate limiting - 60 seconds between submissions
$rate_limit_file = __DIR__ . '/.rate_limits.json';
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$current_time = time();
$rate_limit_duration = 60; // seconds

// Load rate limits
$rate_limits = [];
if (file_exists($rate_limit_file)) {
    $content = file_get_contents($rate_limit_file);
    if ($content) {
        $rate_limits = json_decode($content, true) ?: [];
    }
}

// Clean old entries (older than 1 hour)
$rate_limits = array_filter($rate_limits, function($timestamp) use ($current_time) {
    return ($current_time - $timestamp) < 3600;
});

// Check rate limit
if (isset($rate_limits[$client_ip])) {
    $time_passed = $current_time - $rate_limits[$client_ip];
    if ($time_passed < $rate_limit_duration) {
        $response['error'] = 'Please wait ' . ($rate_limit_duration - $time_passed) . ' seconds before trying again';
        http_response_code(429);
        echo json_encode($response);
        exit;
    }
}

// Validate input
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$name = trim($_POST['name'] ?? '');

if (!$email) {
    $response['error'] = 'Please provide a valid email address';
    http_response_code(400);
    echo json_encode($response);
    exit;
}

// Sanitize name
$name = preg_replace('/[^\p{L}\p{N}\s\-\.]/u', '', $name);
$name = substr($name, 0, 100); // Limit length

// CSV file path
$csv_file = __DIR__ . '/subscribers.csv';
$file_exists = file_exists($csv_file);

// Ensure directory is writable
if (!is_writable(__DIR__)) {
    $response['error'] = 'Server configuration error';
    http_response_code(500);
    echo json_encode($response);
    exit;
}

// Try to acquire exclusive lock
$lock_file = __DIR__ . '/.subscribers.lock';
$lock = fopen($lock_file, 'c');
if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) {
    $response['error'] = 'Server busy, please try again';
    http_response_code(503);
    echo json_encode($response);
    exit;
}

try {
    // Check for duplicates
    if ($file_exists) {
        $existing = array_map('str_getcsv', file($csv_file));
        foreach ($existing as $row) {
            if (isset($row[1]) && $row[1] === $email) {
                $response['error'] = 'This email is already registered';
                http_response_code(409);
                echo json_encode($response);
                exit;
            }
        }
    }
    
    // Open file for appending
    $file = fopen($csv_file, 'a');
    if (!$file) {
        throw new Exception('Could not open file');
    }
    
    // Add headers if new file
    if (!$file_exists) {
        fputcsv($file, ['timestamp', 'email', 'name', 'ip', 'user_agent']);
    }
    
    // Prepare data
    $data = [
        date('Y-m-d H:i:s'),
        $email,
        $name,
        $client_ip,
        substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown', 0, 200)
    ];
    
    // Write data
    if (!fputcsv($file, $data)) {
        throw new Exception('Could not write data');
    }
    
    fclose($file);
    
    // Update rate limit
    $rate_limits[$client_ip] = $current_time;
    file_put_contents($rate_limit_file, json_encode($rate_limits));
    
    // Success response
    $response['ok'] = true;
    http_response_code(200);
    
} catch (Exception $e) {
    $response['error'] = 'Could not save your information. Please try again later.';
    http_response_code(500);
    error_log('Notify error: ' . $e->getMessage());
} finally {
    // Release lock
    flock($lock, LOCK_UN);
    fclose($lock);
}

// Send response
echo json_encode($response);
?>