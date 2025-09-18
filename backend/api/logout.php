<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['error' => 'Method not allowed'], 405);
}

if (is_logged_in()) {
    // Log activity
    log_activity($_SESSION['user_id'], 'User logged out');
    
    // Destroy session
    session_destroy();
    
    json_response(['message' => 'Logged out successfully']);
} else {
    json_response(['error' => 'Not logged in'], 401);
}
?>
