<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['error' => 'Method not allowed'], 405);
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    json_response(['error' => 'Invalid JSON input'], 400);
}

$email = sanitize_input($input['email'] ?? '');
$password = $input['password'] ?? '';

// Validation
if (empty($email) || empty($password)) {
    json_response(['error' => 'Email and password are required'], 400);
}

if (!validate_email($email)) {
    json_response(['error' => 'Invalid email format'], 400);
}

try {
    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        json_response(['error' => 'Invalid email or password'], 401);
    }

    // Check if account is locked
    if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {
        $lockout_time = date('H:i:s', strtotime($user['locked_until']));
        json_response(['error' => "Account locked until {$lockout_time}"], 423);
    }

    // Verify password
    if (!verify_password($password, $user['password_hash'])) {
        // Increment login attempts
        $stmt = $pdo->prepare("UPDATE users SET login_attempts = login_attempts + 1 WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        // Lock account if too many attempts
        if ($user['login_attempts'] + 1 >= MAX_LOGIN_ATTEMPTS) {
            $lockout_time = date('Y-m-d H:i:s', time() + LOGIN_LOCKOUT_TIME);
            $stmt = $pdo->prepare("UPDATE users SET locked_until = ? WHERE id = ?");
            $stmt->execute([$lockout_time, $user['id']]);
        }
        
        json_response(['error' => 'Invalid email or password'], 401);
    }

    // Reset login attempts and update last login
    $stmt = $pdo->prepare("UPDATE users SET login_attempts = 0, locked_until = NULL, last_login = NOW() WHERE id = ?");
    $stmt->execute([$user['id']]);

    // Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];

    // Log activity
    log_activity($user['id'], 'User logged in');

    json_response(['message' => 'Login successful', 'user' => [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email']
    ]]);

} catch (PDOException $e) {
    error_log("Login error: " . $e->getMessage());
    json_response(['error' => 'Database error occurred'], 500);
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    json_response(['error' => 'An unexpected error occurred'], 500);
}
?>
