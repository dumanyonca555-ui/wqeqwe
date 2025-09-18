<?php
require_once 'backend/config/config.php';
require_once 'backend/config/database.php';
require_once 'backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();
$error_message = '';
$success_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_input($_POST['name'] ?? $user['username']);
    $backstory = sanitize_input($_POST['backstory'] ?? '');
    $zodiac = sanitize_input($_POST['zodiac'] ?? 'Leo');
    $age = intval($_POST['age'] ?? 25);
    $favorite_color = sanitize_input($_POST['favorite_color'] ?? '#7b9fff');
    $default_emoji = sanitize_input($_POST['default_emoji'] ?? '🌟');
    
    if (empty($name)) {
        $error_message = 'Character name is required.';
    } else {
        try {
            // Create character profile
            $stmt = $pdo->prepare("INSERT INTO character_profiles (user_id, name, backstory, avatar_url, zodiac, age, favorite_color, default_emoji) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $avatar_url = 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . urlencode($name);
            
            $stmt->execute([
                $_SESSION['user_id'],
                $name,
                $backstory ?: 'A new explorer ready to discover the Neural Chat world.',
                $avatar_url,
                $zodiac,
                $age,
                $favorite_color,
                $default_emoji
            ]);
            
            log_activity($_SESSION['user_id'], 'Character profile created');
            
            // Redirect to main menu
            redirect('/frontend/main-menu.php');
            
        } catch (Exception $e) {
            error_log("Profile creation error: " . $e->getMessage());
            $error_message = 'Profile creation failed. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Profile Creation - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="frontend/assets/css/theme.css">
    <link rel="stylesheet" href="frontend/assets/css/style.css">
    <link rel="stylesheet" href="frontend/assets/css/animations.css">
    <link rel="stylesheet" href="frontend/assets/css/mobile.css">
</head>
<body>
    <main class="main-container">
        
        <div class="content-container">
            <h1 class="main-title">Create Your Character</h1>
            <p class="subtitle">Welcome to Celestial Tale! Let's create your character profile.</p>
            
            <div class="profile-creation-container">
                <form method="POST" class="profile-form">
                    <div class="input-group">
                        <span class="input-icon">👤</span>
                        <input type="text" name="name" placeholder="Character Name" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-icon">📖</span>
                        <textarea name="backstory" placeholder="Character Backstory (Optional)" rows="3">A new explorer ready to discover the Neural Chat world.</textarea>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-icon">⭐</span>
                        <select name="zodiac" required>
                            <option value="Leo" selected>Leo ♌</option>
                            <option value="Aries">Aries ♈</option>
                            <option value="Taurus">Taurus ♉</option>
                            <option value="Gemini">Gemini ♊</option>
                            <option value="Cancer">Cancer ♋</option>
                            <option value="Virgo">Virgo ♍</option>
                            <option value="Libra">Libra ♎</option>
                            <option value="Scorpio">Scorpio ♏</option>
                            <option value="Sagittarius">Sagittarius ♐</option>
                            <option value="Capricorn">Capricorn ♑</option>
                            <option value="Aquarius">Aquarius ♒</option>
                            <option value="Pisces">Pisces ♓</option>
                        </select>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-icon">🎂</span>
                        <input type="number" name="age" placeholder="Age" value="25" min="16" max="100" required>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-icon">🎨</span>
                        <input type="color" name="favorite_color" value="#7b9fff" required>
                        <label>Favorite Color</label>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-icon">😊</span>
                        <input type="text" name="default_emoji" placeholder="Default Emoji" value="🌟" maxlength="2" required>
                    </div>
                    
                    <button type="submit" class="submit-btn">Create Character</button>
                </form>
                
                <?php if ($error_message): ?>
                    <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                
                <?php if ($success_message): ?>
                    <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <script src="frontend/assets/js/main.js"></script>
    <script src="frontend/assets/js/mobile.js"></script>
</body>
</html>