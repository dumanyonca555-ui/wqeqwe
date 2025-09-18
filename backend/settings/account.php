<?php
session_start();

// Settings header include
require_once '../config/config.php';

$page_title = 'Hesap';
$page_description = 'Profil ve veri yönetimi';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    
    // Update user settings (simplified for demo)
    $_SESSION['user_settings']['username'] = $username;
    $_SESSION['user_settings']['email'] = $email;
    $_SESSION['user_settings']['bio'] = $bio;
    
    header('Location: account.php?success=1');
    exit;
}

// Get current settings
$username = $_SESSION['user_settings']['username'] ?? 'Kullanıcı';
$email = $_SESSION['user_settings']['email'] ?? 'user@example.com';
$bio = $_SESSION['user_settings']['bio'] ?? '';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Ayarlar</title>
    <link rel="stylesheet" href="../../frontend/assets/css/theme.css">
    <link rel="stylesheet" href="../../frontend/assets/css/style.css">
</head>
<body>
    <div class="glass-container">
        <a href="../../frontend/main-menu.php" class="btn btn-secondary">
            <span>←</span>
            <span>Ana Menü</span>
        </a>

        <div class="text-center mb-4">
            <h1>👤 Hesap</h1>
            <p>Profil ve veri yönetimi</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                ✅ Ayarlar başarıyla kaydedildi!
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">E-posta</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label for="bio">Hakkımda</label>
                <textarea id="bio" name="bio" placeholder="Kendiniz hakkında bir şeyler yazın..."><?php echo htmlspecialchars($bio); ?></textarea>
            </div>

            <button type="submit" class="save-btn">💾 Ayarları Kaydet</button>
        </form>
    </div>
</body>
</html>
