<?php
session_start();

// Settings header include
require_once '../config/config.php';

$page_title = 'Ses';
$page_description = 'Müzik ve efekt sesleri';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $master_volume = intval($_POST['master_volume'] ?? 50);
    $music_volume = intval($_POST['music_volume'] ?? 70);
    $sfx_volume = intval($_POST['sfx_volume'] ?? 80);
    $voice_volume = intval($_POST['voice_volume'] ?? 60);
    
    // Update user settings (simplified for demo)
    $_SESSION['user_settings']['master_volume'] = $master_volume;
    $_SESSION['user_settings']['music_volume'] = $music_volume;
    $_SESSION['user_settings']['sfx_volume'] = $sfx_volume;
    $_SESSION['user_settings']['voice_volume'] = $voice_volume;
    
    header('Location: audio.php?success=1');
    exit;
}

// Get current settings
$master_volume = $_SESSION['user_settings']['master_volume'] ?? 50;
$music_volume = $_SESSION['user_settings']['music_volume'] ?? 70;
$sfx_volume = $_SESSION['user_settings']['sfx_volume'] ?? 80;
$voice_volume = $_SESSION['user_settings']['voice_volume'] ?? 60;
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
            <h1>🔊 Ses</h1>
            <p>Müzik ve efekt sesleri</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                ✅ Ayarlar başarıyla kaydedildi!
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="setting-item">
                <div class="setting-info">
                    <h3>Ana Ses Seviyesi</h3>
                    <p>Genel ses seviyesi kontrolü</p>
                </div>
                <div class="volume-control">
                    <input type="range" name="master_volume" class="volume-slider" 
                           min="0" max="100" value="<?php echo $master_volume; ?>" 
                           oninput="updateVolume(this)">
                    <span class="volume-value"><?php echo $master_volume; ?>%</span>
                </div>
            </div>

            <div class="setting-item">
                <div class="setting-info">
                    <h3>Müzik Ses Seviyesi</h3>
                    <p>Arka plan müziği ses seviyesi</p>
                </div>
                <div class="volume-control">
                    <input type="range" name="music_volume" class="volume-slider" 
                           min="0" max="100" value="<?php echo $music_volume; ?>" 
                           oninput="updateVolume(this)">
                    <span class="volume-value"><?php echo $music_volume; ?>%</span>
                </div>
            </div>

            <div class="setting-item">
                <div class="setting-info">
                    <h3>Efekt Ses Seviyesi</h3>
                    <p>Buton tıklama ve UI sesleri</p>
                </div>
                <div class="volume-control">
                    <input type="range" name="sfx_volume" class="volume-slider" 
                           min="0" max="100" value="<?php echo $sfx_volume; ?>" 
                           oninput="updateVolume(this)">
                    <span class="volume-value"><?php echo $sfx_volume; ?>%</span>
                </div>
            </div>

            <div class="setting-item">
                <div class="setting-info">
                    <h3>Sesli Mesaj Seviyesi</h3>
                    <p>Karakter sesli mesajları</p>
                </div>
                <div class="volume-control">
                    <input type="range" name="voice_volume" class="volume-slider" 
                           min="0" max="100" value="<?php echo $voice_volume; ?>" 
                           oninput="updateVolume(this)">
                    <span class="volume-value"><?php echo $voice_volume; ?>%</span>
                </div>
            </div>

            <button type="submit" class="save-btn">💾 Ayarları Kaydet</button>
        </form>
    </div>

    <script>
        function updateVolume(slider) {
            const valueSpan = slider.parentElement.querySelector('.volume-value');
            valueSpan.textContent = slider.value + '%';
        }

        // Initialize volume displays
        document.querySelectorAll('.volume-slider').forEach(slider => {
            updateVolume(slider);
        });
    </script>
</body>
</html>
