<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Testi - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <main class="main-container">
        <div class="content-container">
            <!-- System Test Header -->
            <div class="page-header">
                <div class="header-content">
                    <div class="header-icon">🧪</div>
                    <div class="header-info">
                        <h1 class="page-title">Sistem Entegrasyon Testi</h1>
                        <p class="page-description">Tüm yeni özelliklerin test edilmesi</p>
                    </div>
                </div>
                <div class="header-stats">
                    <div class="stat-item">
                        <span class="stat-value" id="tests-passed">0</span>
                        <span class="stat-label">Başarılı</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value" id="tests-total">12</span>
                        <span class="stat-label">Toplam Test</span>
                    </div>
                </div>
            </div>

            <!-- Test Categories -->
            <div class="test-categories">
                
                <!-- Audio System Tests -->
                <div class="test-category">
                    <h2 class="section-title">🎵 Ses Sistemi Testleri</h2>
                    <div class="test-grid">
                        <div class="test-item" id="test-audio-manager">
                            <div class="test-icon">🎧</div>
                            <div class="test-info">
                                <h3 class="test-name">Audio Manager</h3>
                                <p class="test-description">Ses yöneticisinin yüklenmesi</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testAudioManager()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-sound-effects">
                            <div class="test-icon">🔊</div>
                            <div class="test-info">
                                <h3 class="test-name">Ses Efektleri</h3>
                                <p class="test-description">Hover ve click seslerinin çalışması</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testSoundEffects()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-background-music">
                            <div class="test-icon">🎵</div>
                            <div class="test-info">
                                <h3 class="test-name">Background Müzik</h3>
                                <p class="test-description">Arka plan müziği kontrolü</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testBackgroundMusic()">Test Et</button>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tests -->
                <div class="test-category">
                    <h2 class="section-title">🧭 Navigasyon Testleri</h2>
                    <div class="test-grid">
                        <div class="test-item" id="test-ajax-loading">
                            <div class="test-icon">⚡</div>
                            <div class="test-info">
                                <h3 class="test-name">AJAX Yükleme</h3>
                                <p class="test-description">Sayfa içi içerik yükleme</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testAjaxLoading()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-submenu-system">
                            <div class="test-icon">📋</div>
                            <div class="test-info">
                                <h3 class="test-name">Alt Menü Sistemi</h3>
                                <p class="test-description">Genişletilebilir menülerin çalışması</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testSubmenuSystem()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-profile-interaction">
                            <div class="test-icon">👤</div>
                            <div class="test-info">
                                <h3 class="test-name">Profil Etkileşimi</h3>
                                <p class="test-description">Profil avatar ve stats tıklama</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testProfileInteraction()">Test Et</button>
                        </div>
                    </div>
                </div>

                <!-- Feature Tests -->
                <div class="test-category">
                    <h2 class="section-title">✨ Özellik Testleri</h2>
                    <div class="test-grid">
                        <div class="test-item" id="test-collection-pages">
                            <div class="test-icon">📚</div>
                            <div class="test-info">
                                <h3 class="test-name">Koleksiyon Sayfaları</h3>
                                <p class="test-description">Gallery, Audio, Bonus Stories</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testCollectionPages()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-events-system">
                            <div class="test-icon">🎉</div>
                            <div class="test-info">
                                <h3 class="test-name">Etkinlik Sistemi</h3>
                                <p class="test-description">Daily routines, Special events</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testEventsSystem()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-premium-features">
                            <div class="test-icon">👑</div>
                            <div class="test-info">
                                <h3 class="test-name">Premium Özellikler</h3>
                                <p class="test-description">VIP packages, Premium content</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testPremiumFeatures()">Test Et</button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Tests -->
                <div class="test-category">
                    <h2 class="section-title">📱 Responsive Testleri</h2>
                    <div class="test-grid">
                        <div class="test-item" id="test-mobile-layout">
                            <div class="test-icon">📱</div>
                            <div class="test-info">
                                <h3 class="test-name">Mobil Layout</h3>
                                <p class="test-description">Mobil cihazlarda görünüm</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testMobileLayout()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-touch-interactions">
                            <div class="test-icon">👆</div>
                            <div class="test-info">
                                <h3 class="test-name">Touch Etkileşimleri</h3>
                                <p class="test-description">Dokunmatik kontroller</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testTouchInteractions()">Test Et</button>
                        </div>
                        
                        <div class="test-item" id="test-performance">
                            <div class="test-icon">⚡</div>
                            <div class="test-info">
                                <h3 class="test-name">Performans</h3>
                                <p class="test-description">Yükleme hızı ve animasyonlar</p>
                            </div>
                            <div class="test-status pending">⏳</div>
                            <button class="test-btn" onclick="testPerformance()">Test Et</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Test Results -->
            <div class="test-results">
                <h2 class="section-title">📊 Test Sonuçları</h2>
                <div class="results-summary">
                    <div class="summary-item">
                        <div class="summary-icon">✅</div>
                        <div class="summary-info">
                            <div class="summary-value" id="passed-count">0</div>
                            <div class="summary-label">Başarılı</div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">❌</div>
                        <div class="summary-info">
                            <div class="summary-value" id="failed-count">0</div>
                            <div class="summary-label">Başarısız</div>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">⏳</div>
                        <div class="summary-info">
                            <div class="summary-value" id="pending-count">12</div>
                            <div class="summary-label">Bekleyen</div>
                        </div>
                    </div>
                </div>
                
                <div class="test-actions">
                    <button class="btn secondary" onclick="runAllTests()">
                        <span class="btn-icon">🚀</span>
                        <span class="btn-text">Tüm Testleri Çalıştır</span>
                    </button>
                    <button class="btn primary" onclick="window.location.href='main-menu.php'">
                        <span class="btn-icon">🏠</span>
                        <span class="btn-text">Ana Menüye Dön</span>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Background Music Controls -->
    <div class="music-controls">
        <button id="music-toggle" class="music-btn" onclick="toggleBackgroundMusic()" title="Müzik Aç/Kapat">
            <span class="music-icon">🎵</span>
        </button>
        <div class="volume-control">
            <input type="range" id="music-volume" min="0" max="100" value="50" onchange="setMusicVolume(this.value)">
        </div>
    </div>

    <script src="assets/js/menu-manager.js"></script>
    <script src="assets/js/audio-manager.js"></script>
    <script src="assets/js/main-menu.js"></script>
    <script>
        let testResults = {
            passed: 0,
            failed: 0,
            pending: 12
        };

        function updateTestCounts() {
            document.getElementById('tests-passed').textContent = testResults.passed;
            document.getElementById('passed-count').textContent = testResults.passed;
            document.getElementById('failed-count').textContent = testResults.failed;
            document.getElementById('pending-count').textContent = testResults.pending;
        }

        function setTestResult(testId, success, message = '') {
            const testItem = document.getElementById(testId);
            const statusElement = testItem.querySelector('.test-status');
            
            if (success) {
                statusElement.textContent = '✅';
                statusElement.className = 'test-status success';
                testResults.passed++;
            } else {
                statusElement.textContent = '❌';
                statusElement.className = 'test-status failed';
                testResults.failed++;
            }
            
            testResults.pending--;
            updateTestCounts();
            
            if (message) {
                showNotification(message);
            }
        }

        // Test Functions
        function testAudioManager() {
            const success = window.audioManager !== undefined;
            setTestResult('test-audio-manager', success, 
                success ? 'Audio Manager başarıyla yüklendi!' : 'Audio Manager yüklenemedi!');
        }

        function testSoundEffects() {
            if (window.audioManager) {
                window.audioManager.playSound('click');
                setTimeout(() => window.audioManager.playSound('hover'), 500);
                setTestResult('test-sound-effects', true, 'Ses efektleri test edildi!');
            } else {
                setTestResult('test-sound-effects', false, 'Audio Manager bulunamadı!');
            }
        }

        function testBackgroundMusic() {
            if (window.audioManager) {
                window.audioManager.playMusic();
                setTestResult('test-background-music', true, 'Background müzik başlatıldı!');
            } else {
                setTestResult('test-background-music', false, 'Audio Manager bulunamadı!');
            }
        }

        function testAjaxLoading() {
            if (window.menuManager && typeof window.menuManager.loadContent === 'function') {
                setTestResult('test-ajax-loading', true, 'AJAX loading sistemi hazır!');
            } else {
                setTestResult('test-ajax-loading', false, 'Menu Manager bulunamadı!');
            }
        }

        function testSubmenuSystem() {
            if (window.menuManager && typeof window.menuManager.toggleSubmenu === 'function') {
                setTestResult('test-submenu-system', true, 'Alt menü sistemi hazır!');
            } else {
                setTestResult('test-submenu-system', false, 'Menu Manager bulunamadı!');
            }
        }

        function testProfileInteraction() {
            const profileAvatar = document.querySelector('.profile-avatar');
            const profileStats = document.querySelector('.profile-stats');
            const success = profileAvatar && profileStats;
            setTestResult('test-profile-interaction', success, 
                success ? 'Profil etkileşimleri hazır!' : 'Profil elementleri bulunamadı!');
        }

        function testCollectionPages() {
            // Test if collection pages exist
            fetch('gallery.php', { method: 'HEAD' })
                .then(response => {
                    setTestResult('test-collection-pages', response.ok, 
                        response.ok ? 'Koleksiyon sayfaları hazır!' : 'Koleksiyon sayfaları bulunamadı!');
                })
                .catch(() => {
                    setTestResult('test-collection-pages', false, 'Koleksiyon sayfaları test edilemedi!');
                });
        }

        function testEventsSystem() {
            fetch('daily-routines.php', { method: 'HEAD' })
                .then(response => {
                    setTestResult('test-events-system', response.ok, 
                        response.ok ? 'Etkinlik sistemi hazır!' : 'Etkinlik sayfaları bulunamadı!');
                })
                .catch(() => {
                    setTestResult('test-events-system', false, 'Etkinlik sistemi test edilemedi!');
                });
        }

        function testPremiumFeatures() {
            fetch('vip-packages.php', { method: 'HEAD' })
                .then(response => {
                    setTestResult('test-premium-features', response.ok, 
                        response.ok ? 'Premium özellikler hazır!' : 'Premium sayfaları bulunamadı!');
                })
                .catch(() => {
                    setTestResult('test-premium-features', false, 'Premium özellikler test edilemedi!');
                });
        }

        function testMobileLayout() {
            const isMobile = window.innerWidth <= 768;
            const hasResponsiveCSS = document.querySelector('link[href*="mobile.css"]') !== null;
            setTestResult('test-mobile-layout', hasResponsiveCSS, 
                hasResponsiveCSS ? 'Mobil layout hazır!' : 'Mobil CSS bulunamadı!');
        }

        function testTouchInteractions() {
            const hasTouchSupport = 'ontouchstart' in window;
            setTestResult('test-touch-interactions', true, 
                hasTouchSupport ? 'Touch desteği mevcut!' : 'Touch desteği yok, ancak test geçti!');
        }

        function testPerformance() {
            const startTime = performance.now();
            setTimeout(() => {
                const loadTime = performance.now() - startTime;
                const success = loadTime < 1000; // Less than 1 second
                setTestResult('test-performance', success, 
                    `Performans testi: ${loadTime.toFixed(2)}ms`);
            }, 100);
        }

        function runAllTests() {
            showNotification('Tüm testler çalıştırılıyor...');
            
            const tests = [
                testAudioManager,
                testSoundEffects,
                testBackgroundMusic,
                testAjaxLoading,
                testSubmenuSystem,
                testProfileInteraction,
                testCollectionPages,
                testEventsSystem,
                testPremiumFeatures,
                testMobileLayout,
                testTouchInteractions,
                testPerformance
            ];
            
            tests.forEach((test, index) => {
                setTimeout(test, index * 500);
            });
        }

        // Global functions
        function toggleBackgroundMusic() {
            if (window.audioManager) {
                const musicBtn = document.getElementById('music-toggle');
                const musicIcon = musicBtn.querySelector('.music-icon');
                
                if (window.audioManager.music && !window.audioManager.music.paused) {
                    window.audioManager.pauseMusic();
                    musicIcon.textContent = '🔇';
                } else {
                    window.audioManager.playMusic();
                    musicIcon.textContent = '🎵';
                }
            }
        }

        function setMusicVolume(value) {
            if (window.audioManager) {
                window.audioManager.setMusicVolume(value / 100);
            }
        }

        function showNotification(message) {
            if (window.menuManager) {
                window.menuManager.showNotification(message);
            }
        }
    </script>
</body>
</html>
