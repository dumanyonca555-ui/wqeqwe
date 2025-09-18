<?php
// Application configuration
define('APP_NAME', 'Celestial Tale');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://localhost:8001');

// Session configuration
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Set to 1 for HTTPS
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

// Security settings
define('PASSWORD_MIN_LENGTH', 6);
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 300); // 5 minutes

// AI Configuration (for character generation)
define('GEMINI_API_KEY', 'your-gemini-api-key-here');

// File upload settings
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// Timezone
date_default_timezone_set('Europe/Istanbul');
?>
