// config.php /Users/vincenttetteh/puregrain-rice-website/config.php
<?php
// Production configuration for PureGrain Rice website
// DO NOT commit this file to public repositories

// Environment configuration
define('ENVIRONMENT', 'production'); // 'development' or 'production'

// Email configuration
define('RECIPIENT_EMAIL', 'vincentchrisbone@gmail.com');
define('FROM_EMAIL_DOMAIN', 'pureplatterfoods.com'); // Your domain

// Paystack configuration
// IMPORTANT: Replace these with your actual Paystack keys
define('PAYSTACK_PUBLIC_KEY_TEST', 'pk_test_your_test_key_here');
define('PAYSTACK_SECRET_KEY_TEST', 'sk_test_your_test_secret_here');
define('PAYSTACK_PUBLIC_KEY_LIVE', 'pk_live_your_live_key_here');
define('PAYSTACK_SECRET_KEY_LIVE', 'sk_live_your_live_secret_here');

// Africa's Talking configuration
define('AFRICAS_TALKING_USERNAME', 'your_username_here');
define('AFRICAS_TALKING_API_KEY', 'your_api_key_here');

// Rate limiting configuration
define('EMAIL_RATE_LIMIT', 5); // Max emails per hour per session
define('EMAIL_RATE_WINDOW', 3600); // 1 hour in seconds

// Security configuration
define('ALLOWED_ORIGINS', [
    'https://pureplatterfoods.com',
    'https://www.pureplatterfoods.com',
    'http://localhost:5500' // For development
]);

// Business information
define('BUSINESS_NAME', 'PurePlatter Foods LTD');
define('BUSINESS_ADDRESS', 'Taifa Suma Ampim 23, Ghana');
define('BUSINESS_PHONE', '+233542880528');
define('BUSINESS_EMAIL', 'info@pureplatterfoods.com');

// Helper functions
function getPaystackPublicKey() {
    return (ENVIRONMENT === 'production') 
        ? PAYSTACK_PUBLIC_KEY_LIVE 
        : PAYSTACK_PUBLIC_KEY_TEST;
}

function getPaystackSecretKey() {
    return (ENVIRONMENT === 'production') 
        ? PAYSTACK_SECRET_KEY_LIVE 
        : PAYSTACK_SECRET_KEY_TEST;
}

function isAllowedOrigin($origin) {
    return in_array($origin, ALLOWED_ORIGINS);
}

// Database configuration (if needed in future)
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'puregrain_db');
// define('DB_USER', 'db_username');
// define('DB_PASS', 'db_password');
?>

