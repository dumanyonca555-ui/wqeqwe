<?php
// Utility functions

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_password($password) {
    return strlen($password) >= PASSWORD_MIN_LENGTH;
}

function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function get_current_user_data() {
    global $pdo;
    if (!is_logged_in()) {
        return null;
    }
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

function json_response($data, $status_code = 200) {
    http_response_code($status_code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

function log_activity($user_id, $activity) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user_activities (user_id, activity, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$user_id, $activity]);
}

function generate_avatar_url($name) {
    return "https://api.dicebear.com/7.x/adventurer/svg?seed=" . urlencode($name);
}


function truncate_text($text, $length = 100) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

function checkUserProfile() {
    global $pdo;
    if (!is_logged_in()) {
        return false;
    }
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_profiles WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $count = $stmt->fetchColumn();
    
    return $count > 0;
}

function getUserSettings() {
    global $pdo;
    if (!is_logged_in()) {
        return getDefaultSettings();
    }
    
    $stmt = $pdo->prepare("SELECT * FROM user_settings WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $settings = $stmt->fetch();
    
    if (!$settings) {
        return getDefaultSettings();
    }
    
    return $settings;
}

function getDefaultSettings() {
    return [
        'master_volume' => 70,
        'music_enabled' => true,
        'sound_effects' => true,
        'character_voices' => true,
        'brightness' => 80,
        'auto_forward_speed' => 3,
        'high_contrast' => false,
        'developer_console' => false
    ];
}

?>
