// send email.php
<?php
// Production-ready secure email handler for PureGrain Rice website
// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Enable CORS for specific origin (replace with your domain in production)
header('Access-Control-Allow-Origin: https://your-domain.com'); // Change this to your actual domain
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400'); // Cache preflight for 24 hours
header('Content-Type: application/json; charset=utf-8');

// Rate limiting (simple implementation)
session_start();
if (!isset($_SESSION['email_count'])) {
    $_SESSION['email_count'] = 0;
    $_SESSION['email_time'] = time();
}

// Reset counter every hour
if (time() - $_SESSION['email_time'] > 3600) {
    $_SESSION['email_count'] = 0;
    $_SESSION['email_time'] = time();
}

// Limit to 5 emails per hour per session
if ($_SESSION['email_count'] >= 5) {
    http_response_code(429);
    echo json_encode(['error' => 'Too many requests. Please try again later.']);
    exit;
}

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Verify HTTPS in production
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    // Uncomment for production
    // http_response_code(403);
    // echo json_encode(['error' => 'HTTPS required']);
    // exit;
}

// Get the JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

// Validate required fields
if (empty($input['to']) || empty($input['from']) || empty($input['subject']) || empty($input['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Africa's Talking configuration
// Replace these with your actual Africa's Talking credentials
$apiKey = 'YOUR_AFRICAS_TALKING_API_KEY';
$username = 'YOUR_AFRICAS_TALKING_USERNAME';

// Input validation and sanitization
function validateAndSanitize($input) {
    $errors = [];
    
    // Validate email addresses
    $to = filter_var($input['to'], FILTER_VALIDATE_EMAIL);
    $from = filter_var($input['from'], FILTER_VALIDATE_EMAIL);
    
    if (!$to) $errors[] = 'Invalid recipient email';
    if (!$from) $errors[] = 'Invalid sender email';
    
    // Validate and sanitize text inputs
    $subject = trim(htmlspecialchars($input['subject'], ENT_QUOTES, 'UTF-8'));
    $message = trim(htmlspecialchars($input['message'], ENT_QUOTES, 'UTF-8'));
    
    // Length validation
    if (strlen($subject) > 200) $errors[] = 'Subject too long';
    if (strlen($message) > 5000) $errors[] = 'Message too long';
    if (strlen($message) < 10) $errors[] = 'Message too short';
    
    // Basic spam detection
    $spamKeywords = ['viagra', 'casino', 'lottery', 'winner', 'congratulations', 'click here'];
    $messageChecksum = strtolower($subject . ' ' . $message);
    
    foreach ($spamKeywords as $keyword) {
        if (strpos($messageChecksum, $keyword) !== false) {
            $errors[] = 'Message contains prohibited content';
            break;
        }
    }
    
    // Check for suspicious patterns
    if (preg_match('/\b(?:https?:\/\/[^\s]+|www\.[^\s]+)\b/i', $message)) {
        // Allow one URL maximum
        if (preg_match_all('/\b(?:https?:\/\/[^\s]+|www\.[^\s]+)\b/i', $message) > 1) {
            $errors[] = 'Too many URLs in message';
        }
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors,
        'data' => [
            'to' => $to,
            'from' => $from,
            'subject' => $subject,
            'message' => $message
        ]
    ];
}

// Validate input
$validation = validateAndSanitize($input);

if (!$validation['valid']) {
    http_response_code(400);
    echo json_encode(['error' => 'Validation failed: ' . implode(', ', $validation['errors'])]);
    exit;
}

$to = $validation['data']['to'];
$from = $validation['data']['from'];
$subject = $validation['data']['subject'];
$message = $validation['data']['message'];

// For demo purposes, we'll use PHP's built-in mail function
// In production, you should use Africa's Talking Email API or another email service

// Email headers
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: " . $from . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Email body
$emailBody = "New contact form submission from PureGrain Rice website:\n\n";
$emailBody .= $message;
$emailBody .= "\n\n---\n";
$emailBody .= "This message was sent from the PureGrain Rice contact form.";

try {
    // Send email using PHP mail function
    // Note: This requires a properly configured mail server
    $mailSent = mail($to, $subject, $emailBody, $headers);
    
    if ($mailSent) {
        // Increment email counter on successful send
        $_SESSION['email_count']++;
        
        echo json_encode([
            'success' => true,
            'message' => 'Email sent successfully'
        ]);
    } else {
        throw new Exception('Failed to send email');
    }
    
} catch (Exception $e) {
    error_log('Email sending error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to send email. Please try again later.'
    ]);
}

// Alternative implementation using Africa's Talking Email API
// Uncomment and configure the following code to use Africa's Talking:

/*
function sendEmailWithAfricasTalking($apiKey, $username, $to, $from, $subject, $message) {
    $url = 'https://api.sandbox.africastalking.com/version1/messaging/email';
    
    $data = [
        'username' => $username,
        'to' => $to,
        'from' => $from,
        'subject' => $subject,
        'textBody' => $message
    ];
    
    $headers = [
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
        'apiKey: ' . $apiKey
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'success' => $httpCode === 200,
        'response' => json_decode($response, true)
    ];
}

// Use Africa's Talking to send email
$result = sendEmailWithAfricasTalking($apiKey, $username, $to, $from, $subject, $emailBody);

if ($result['success']) {
    echo json_encode([
        'success' => true,
        'message' => 'Email sent successfully via Africa\'s Talking'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to send email via Africa\'s Talking'
    ]);
}
*/
?>

