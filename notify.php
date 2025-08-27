<?php
session_start();

// CORS headers if needed
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit();
}

// Rate limiting (simple implementation)
$ip = $_SERVER['REMOTE_ADDR'];
$rateLimitFile = sys_get_temp_dir() . '/refco_rate_limit_' . md5($ip) . '.txt';
$rateLimitWindow = 3600; // 1 hour
$maxRequests = 5;

if (file_exists($rateLimitFile)) {
    $data = json_decode(file_get_contents($rateLimitFile), true);
    $currentTime = time();
    
    // Clean old entries
    $data = array_filter($data, function($timestamp) use ($currentTime, $rateLimitWindow) {
        return ($currentTime - $timestamp) < $rateLimitWindow;
    });
    
    if (count($data) >= $maxRequests) {
        http_response_code(429);
        echo json_encode(['success' => false, 'error' => 'Too many requests']);
        exit();
    }
    
    $data[] = $currentTime;
} else {
    $data = [time()];
}

file_put_contents($rateLimitFile, json_encode($data));

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit();
}

// Verify CSRF token
if (!isset($input['csrf_token']) || !isset($_SESSION['csrf_token']) || 
    $input['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Invalid CSRF token']);
    exit();
}

// Validate input
$email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
$name = trim($input['name'] ?? '');

if (!$email || empty($name)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'validation_failed']);
    exit();
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

// In a real application, you would:
// 1. Save to database
// 2. Send confirmation email
// 3. Add to mailing list

// For now, we'll log to a file (create a proper database integration in production)
$logFile = __DIR__ . '/notify_submissions.log';
$logEntry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | IP: $ip\n";

// Attempt to write to log file
if (@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) === false) {
    // If logging fails, still return success to user but log error
    error_log("Failed to write to notify submissions log");
}

// Send success response
http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);

// Optional: Send email notification to admin
// mail('admin@refcosupply.com', 'New Launch Notification Signup', $logEntry);
?>