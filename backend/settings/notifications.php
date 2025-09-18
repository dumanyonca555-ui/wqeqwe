<?php
session_start();

// Settings header include
require_once '../config/config.php';

$page_title = 'Bildirimler';
$page_description = 'Push notification ayarları';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $push_notifications = isset($_POST['push_notifications']) ? 1 : 0;
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $chat_notifications = isset($_POST['chat_notifications']) ? 1 : 0;
    
    // Update user settings (simplified for demo)
    $_SESSION['user_settings']['push_notifications'] = $push_notifications;
    $_SESSION['user_settings']['email_notifications'] = $email_notifications;
    $_SESSION['user_settings']['chat_notifications'] = $chat_notifications;
    
    header('Location: notifications.php?success=1');
    exit;
}

// Get current settings
$push_notifications = $_SESSION['user_settings']['push_notifications'] ?? 1;
$email_notifications = $_SESSION['user_settings']['email_notifications'] ?? 1;
$chat_notifications = $_SESSION['user_settings']['chat_notifications'] ?? 1;
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Ayarlar</title>
    <link rel="stylesheet" href="../../frontend/assets/css/theme.css">
    <link rel="stylesheet" href="../../frontend/assets/css/style.css">
    <!-- Using shared theme.css instead of duplicate styles -->
</head>
<body>
    <div class="glass-container">
        <a href="../../frontend/main-menu.php" class="btn btn-secondary">
            <span>←</span>
            <span>Ana Menü</span>
        </a>

        <div class="text-center mb-4">
            <h1>📱 Bildirimler</h1>
            <p>Push notification ayarları</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                ✅ Ayarlar başarıyla kaydedildi!
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="glass-card flex-between">
                <div>
                    <h3>Push Bildirimleri</h3>
                    <p>Yeni mesajlar ve etkinlikler için bildirim al</p>
                </div>
                <div class="toggle-switch <?php echo $push_notifications ? 'active' : ''; ?>" 
                     onclick="toggleSwitch(this)" data-input="push_notifications"></div>
                <input type="hidden" name="push_notifications" value="<?php echo $push_notifications; ?>">
            </div>

            <div class="glass-card flex-between">
                <div>
                    <h3>E-posta Bildirimleri</h3>
                    <p>Önemli güncellemeler için e-posta al</p>
                </div>
                <div class="toggle-switch <?php echo $email_notifications ? 'active' : ''; ?>" 
                     onclick="toggleSwitch(this)" data-input="email_notifications"></div>
                <input type="hidden" name="email_notifications" value="<?php echo $email_notifications; ?>">
            </div>

            <div class="glass-card flex-between">
                <div>
                    <h3>Chat Bildirimleri</h3>
                    <p>Karakterlerden gelen mesajlar için bildirim al</p>
                </div>
                <div class="toggle-switch <?php echo $chat_notifications ? 'active' : ''; ?>" 
                     onclick="toggleSwitch(this)" data-input="chat_notifications"></div>
                <input type="hidden" name="chat_notifications" value="<?php echo $chat_notifications; ?>">
            </div>

            <button type="submit" class="btn btn-primary w-full">💾 Ayarları Kaydet</button>
        </form>
    </div>

    <script>
        function toggleSwitch(element) {
            element.classList.toggle('active');
            const input = element.parentElement.querySelector('input[type="hidden"]');
            input.value = element.classList.contains('active') ? '1' : '0';
        }

        // Initialize toggles
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
            const input = toggle.parentElement.querySelector('input[type="hidden"]');
            if (input.value === '1') {
                toggle.classList.add('active');
            }
        });
    </script>
</body>
</html>
