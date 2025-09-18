<?php
require_once 'backend/config/config.php';
require_once 'backend/config/database.php';
require_once 'backend/includes/functions.php';

// Check if user is logged in
if (is_logged_in()) {
    redirect('/frontend/main-menu.php');
}

$error_message = '';
$success_message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'login') {
        $email = sanitize_input($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $error_message = 'Email and password are required.';
        } else {
            try {
                // Check if user exists
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if (!$user) {
                    $error_message = 'Invalid email or password.';
                } elseif (!verify_password($password, $user['password_hash'])) {
                    $error_message = 'Invalid email or password.';
                } else {
                    // Set session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];

                    // Log activity
                    log_activity($user['id'], 'User logged in');

                    // Redirect to main menu
                    redirect('/frontend/main-menu.php');
                }
            } catch (Exception $e) {
                $error_message = 'Database error occurred.';
            }
        }
    }
    
    elseif ($action === 'signup') {
        $username = sanitize_input($_POST['username'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $terms = isset($_POST['terms']);
        
        if (empty($username) || empty($email) || empty($password)) {
            $error_message = 'All fields are required.';
        } elseif (!$terms) {
            $error_message = 'You must agree to the Terms of Service.';
        } else {
            try {
                // Check for existing user
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
                $stmt->execute([$email, $username]);
                if ($stmt->fetch()) {
                    $error_message = 'Email or username already exists.';
                } else {
                    // Create new user
                    $password_hash = hash_password($password);
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
                    $stmt->execute([$username, $email, $password_hash]);
                    
                    $user_id = $pdo->lastInsertId();

                    // Set session
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;

                    // Create default character profile for new user
                    $stmt = $pdo->prepare("INSERT INTO character_profiles (user_id, name, backstory, avatar_url, zodiac, age, favorite_color, default_emoji) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $user_id,
                        $username,
                        'A new explorer ready to discover the Neural Chat world.',
                        'https://api.dicebear.com/7.x/adventurer/svg?seed=' . urlencode($username),
                        'Leo',
                        25,
                        '#7b9fff',
                        '🌟'
                    ]);

                    // Log activity
                    log_activity($user_id, 'User registered');

                    // Redirect to main menu
                    redirect('/frontend/main-menu.php');
                }
            } catch (Exception $e) {
                $error_message = 'Database error occurred.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="frontend/assets/css/theme.css">
    <link rel="stylesheet" href="frontend/assets/css/style.css">
    <link rel="stylesheet" href="frontend/assets/css/animations.css">
    <link rel="stylesheet" href="frontend/assets/css/mobile.css">
</head>
<body>
    <main class="main-container">
        
        <div class="content-container">
            <h1 class="main-title">Celestial Tale</h1>
            <p class="subtitle">Your next visual novel adventure awaits.</p>
            
            <div class="auth-container">
                <div class="auth-tabs">
                    <button class="auth-tab active" data-tab="login">Login</button>
                    <button class="auth-tab" data-tab="signup">Sign Up</button>
                </div>
                
                <!-- Login Form -->
                <form id="login-form" class="auth-form active" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="input-group">
                        <span class="input-icon">📧</span>
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="submit-btn">Enter the Cosmos</button>
                </form>
                
                <!-- Signup Form -->
                <form id="signup-form" class="auth-form" method="POST">
                    <input type="hidden" name="action" value="signup">
                    <div class="input-group">
                        <span class="input-icon">👤</span>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <span class="input-icon">📧</span>
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#" class="terms-link">Terms of Service</a></label>
                    </div>
                    <button type="submit" class="submit-btn">Create Account</button>
                </form>
                
                <?php if ($error_message): ?>
                    <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                
                <?php if ($success_message): ?>
                    <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
                <?php endif; ?>
                
                <div class="social-login">
                    <div class="divider">
                        <span>Or continue with</span>
                    </div>
                    <div class="social-buttons">
                        <button class="social-btn">Google</button>
                        <button class="social-btn">Apple</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="frontend/assets/js/main.js"></script>
    <script src="frontend/assets/js/mobile.js"></script>
</body>
</html>