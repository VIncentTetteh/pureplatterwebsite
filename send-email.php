<?php
// Enable CORS for cross-origin requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

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

// Email configuration
$to = filter_var($input['to'], FILTER_VALIDATE_EMAIL);
$from = filter_var($input['from'], FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars($input['subject']);
$message = htmlspecialchars($input['message']);

if (!$to || !$from) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email addresses']);
    exit;
}

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

