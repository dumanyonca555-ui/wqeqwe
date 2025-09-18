<?php
session_start();

// Settings header include
require_once '../config/config.php';

$page_title = 'Görsel';
$page_description = 'Tema ve görünüm ayarları';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = $_POST['theme'] ?? 'default';
    $font_size = $_POST['font_size'] ?? 'medium';
    $animations = isset($_POST['animations']) ? 1 : 0;
    $dark_mode = isset($_POST['dark_mode']) ? 1 : 0;
    
    // Update user settings (simplified for demo)
    $_SESSION['user_settings']['theme'] = $theme;
    $_SESSION['user_settings']['font_size'] = $font_size;
    $_SESSION['user_settings']['animations'] = $animations;
    $_SESSION['user_settings']['dark_mode'] = $dark_mode;
    
    header('Location: theme.php?success=1');
    exit;
}

// Get current settings
$theme = $_SESSION['user_settings']['theme'] ?? 'default';
$font_size = $_SESSION['user_settings']['font_size'] ?? 'medium';
$animations = $_SESSION['user_settings']['animations'] ?? 1;
$dark_mode = $_SESSION['user_settings']['dark_mode'] ?? 0;
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
            <h1>🎨 Görsel</h1>
            <p>Tema ve görünüm ayarları</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                ✅ Ayarlar başarıyla kaydedildi!
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="setting-item">
                <div class="setting-info">
                    <h3>Tema Seçimi</h3>
                    <p>Uygulamanızın görünümünü değiştirin</p>
                </div>
                <div class="theme-grid">
                    <label class="theme-option <?php echo $theme === 'default' ? 'selected' : ''; ?>">
                        <input type="radio" name="theme" value="default" <?php echo $theme === 'default' ? 'checked' : ''; ?>>
                        <div class="theme-preview"></div>
                        <div class="theme-name">Varsayılan</div>
                    </label>
                    <label class="theme-option <?php echo $theme === 'purple' ? 'selected' : ''; ?>">
                        <input type="radio" name="theme" value="purple" <?php echo $theme === 'purple' ? 'checked' : ''; ?>>
                        <div class="theme-preview theme-purple"></div>
                        <div class="theme-name">Mor</div>
                    </label>
                    <label class="theme-option <?php echo $theme === 'blue' ? 'selected' : ''; ?>">
                        <input type="radio" name="theme" value="blue" <?php echo $theme === 'blue' ? 'checked' : ''; ?>>
                        <div class="theme-preview theme-blue"></div>
                        <div class="theme-name">Mavi</div>
                    </label>
                    <label class="theme-option <?php echo $theme === 'green' ? 'selected' : ''; ?>">
                        <input type="radio" name="theme" value="green" <?php echo $theme === 'green' ? 'checked' : ''; ?>>
                        <div class="theme-preview theme-green"></div>
                        <div class="theme-name">Yeşil</div>
                    </label>
                </div>
            </div>

            <div class="setting-item">
                <div class="setting-info">
                    <h3>Yazı Boyutu</h3>
                    <p>Metin okunabilirliği için yazı boyutunu ayarlayın</p>
                </div>
                <div class="font-size-options">
                    <label class="font-size-option <?php echo $font_size === 'small' ? 'selected' : ''; ?>">
                        <input type="radio" name="font_size" value="small" <?php echo $font_size === 'small' ? 'checked' : ''; ?>>
                        Küçük
                    </label>
                    <label class="font-size-option <?php echo $font_size === 'medium' ? 'selected' : ''; ?>">
                        <input type="radio" name="font_size" value="medium" <?php echo $font_size === 'medium' ? 'checked' : ''; ?>>
                        Orta
                    </label>
                    <label class="font-size-option <?php echo $font_size === 'large' ? 'selected' : ''; ?>">
                        <input type="radio" name="font_size" value="large" <?php echo $font_size === 'large' ? 'checked' : ''; ?>>
                        Büyük
                    </label>
                </div>
            </div>

            <div class="setting-item">
                <div class="setting-info">
                    <h3>Animasyonlar</h3>
                    <p>Geçiş efektleri ve animasyonları aç/kapat</p>
                </div>
                <div class="toggle-switch <?php echo $animations ? 'active' : ''; ?>" 
                     onclick="toggleSwitch(this)" data-input="animations"></div>
                <input type="hidden" name="animations" value="<?php echo $animations; ?>">
            </div>

            <div class="setting-item">
                <div class="setting-info">
                    <h3>Karanlık Mod</h3>
                    <p>Göz yorgunluğunu azaltmak için karanlık tema</p>
                </div>
                <div class="toggle-switch <?php echo $dark_mode ? 'active' : ''; ?>" 
                     onclick="toggleSwitch(this)" data-input="dark_mode"></div>
                <input type="hidden" name="dark_mode" value="<?php echo $dark_mode; ?>">
            </div>

            <button type="submit" class="save-btn">💾 Ayarları Kaydet</button>
        </form>
    </div>

    <script>
        function toggleSwitch(element) {
            element.classList.toggle('active');
            const input = element.parentElement.querySelector('input[type="hidden"]');
            input.value = element.classList.contains('active') ? '1' : '0';
        }

        // Theme selection
        document.querySelectorAll('input[name="theme"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.theme-option').forEach(option => {
                    option.classList.remove('selected');
                });
                this.closest('.theme-option').classList.add('selected');
            });
        });

        // Font size selection
        document.querySelectorAll('input[name="font_size"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.font-size-option').forEach(option => {
                    option.classList.remove('selected');
                });
                this.closest('.font-size-option').classList.add('selected');
            });
        });

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
