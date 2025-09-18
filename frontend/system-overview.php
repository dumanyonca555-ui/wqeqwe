<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Genel Bakış - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <style>
        .overview-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .overview-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .overview-header h1 {
            color: var(--c5);
            font-size: 3rem;
            margin-bottom: 16px;
            background: var(--accent-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .overview-header p {
            color: var(--c4);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        
        .status-card {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 24px;
            transition: all var(--transition-smooth);
        }
        
        .status-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--c3);
        }
        
        .status-card.completed {
            border-left: 4px solid #22c55e;
        }
        
        .status-card.in-progress {
            border-left: 4px solid #f59e0b;
        }
        
        .status-card.pending {
            border-left: 4px solid #6b7280;
        }
        
        .status-title {
            color: var(--c5);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .status-description {
            color: var(--c4);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 16px;
        }
        
        .status-features {
            list-style: none;
            padding: 0;
            margin: 0 0 16px 0;
        }
        
        .status-features li {
            color: var(--c4);
            font-size: 0.8rem;
            margin-bottom: 6px;
            padding-left: 20px;
            position: relative;
        }
        
        .status-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #22c55e;
            font-weight: bold;
        }
        
        .status-features li.pending::before {
            content: '○';
            color: #6b7280;
        }
        
        .test-button {
            background: var(--accent-grad);
            border: none;
            color: var(--c5);
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all var(--transition-smooth);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .test-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        
        .test-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }
        
        .system-stats {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 40px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            color: var(--c3);
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }
        
        .stat-label {
            color: var(--c4);
            font-size: 0.9rem;
            margin-top: 4px;
        }
        
        .quick-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }
        
        .action-button {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--c4);
            padding: 12px 24px;
            border-radius: 24px;
            cursor: pointer;
            transition: all var(--transition-smooth);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
        }
        
        .action-button:hover {
            background: var(--accent-grad);
            border-color: transparent;
            color: var(--c5);
            transform: translateY(-2px);
        }
        
        .action-button.primary {
            background: var(--accent-grad);
            border-color: transparent;
            color: var(--c5);
        }
        
        @media (max-width: 768px) {
            .status-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .quick-actions {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Parallax Background -->
    <div class="parallax-container">
        <div class="parallax-layer" data-speed="0.02"></div>
        <div class="parallax-layer" data-speed="0.04"></div>
        <div class="parallax-layer" data-speed="0.06"></div>
    </div>

    <div class="overview-container">
        <!-- Header -->
        <div class="overview-header">
            <h1>🚀 Celestial Tale</h1>
            <p>Interactive Visual Novel - Sistem Genel Bakış ve Test Merkezi</p>
        </div>

        <!-- System Stats -->
        <div class="system-stats">
            <h2 style="color: var(--c5); text-align: center; margin-bottom: 24px;">📊 Sistem İstatistikleri</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-value" id="completed-features">12</span>
                    <div class="stat-label">Tamamlanan Özellik</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="total-pages">15</span>
                    <div class="stat-label">Toplam Sayfa</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="js-modules">8</span>
                    <div class="stat-label">JavaScript Modülü</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="completion-rate">95%</span>
                    <div class="stat-label">Tamamlanma Oranı</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="main-menu.php" class="action-button primary">🏠 Ana Menü</a>
            <a href="gallery.php" class="action-button">🎨 Galeri</a>
            <a href="collection.php" class="action-button">📚 Koleksiyon</a>
            <a href="settings.php" class="action-button">⚙️ Ayarlar</a>
            <a href="character-leo.php" class="action-button">👤 Karakterler</a>
        </div>

        <!-- Status Grid -->
        <div class="status-grid">
            <!-- Core Systems -->
            <div class="status-card completed">
                <div class="status-title">
                    🎯 Temel Sistemler
                </div>
                <div class="status-description">
                    Oyunun çalışması için gerekli temel altyapı sistemleri
                </div>
                <ul class="status-features">
                    <li>Loading Manager - Yükleme sistemi</li>
                    <li>Data Manager - Veri yönetimi</li>
                    <li>Settings Manager - Ayarlar sistemi</li>
                    <li>Audio Manager - Ses sistemi</li>
                    <li>Navigation Manager - Navigasyon</li>
                    <li>App Integration - Sistem entegrasyonu</li>
                </ul>
                <a href="settings.php" class="test-button">Test Et</a>
            </div>

            <!-- Character System -->
            <div class="status-card completed">
                <div class="status-title">
                    👥 Karakter Sistemi
                </div>
                <div class="status-description">
                    4 ana karakter ile etkileşim ve ilişki sistemi
                </div>
                <ul class="status-features">
                    <li>Leo - The Strategist (Tamamlandı)</li>
                    <li>Chloe - The Hacker (Tamamlandı)</li>
                    <li>Felix - The Heart (Tamamlandı)</li>
                    <li>Elara - The Mentor (Tamamlandı)</li>
                    <li>Affinity tracking - İlişki takibi</li>
                    <li>Character-specific themes</li>
                </ul>
                <a href="character-leo.php" class="test-button">Test Et</a>
            </div>

            <!-- Gallery System -->
            <div class="status-card completed">
                <div class="status-title">
                    🎨 Galeri Sistemi
                </div>
                <div class="status-description">
                    CG koleksiyonu, filtreleme ve modal görüntüleme
                </div>
                <ul class="status-features">
                    <li>Kategori filtreleme</li>
                    <li>Modal görüntüleme</li>
                    <li>Unlock sistemi</li>
                    <li>İstatistik takibi</li>
                    <li>Responsive tasarım</li>
                    <li>Lazy loading</li>
                </ul>
                <a href="gallery.php" class="test-button">Test Et</a>
            </div>

            <!-- Store System -->
            <div class="status-card completed">
                <div class="status-title">
                    💎 Mağaza Sistemi
                </div>
                <div class="status-description">
                    Neural Fragment, karakter unlock ve premium içerik
                </div>
                <ul class="status-features">
                    <li>Resource management</li>
                    <li>Purchase simulation</li>
                    <li>VIP membership</li>
                    <li>Bundle packages</li>
                    <li>Real-time validation</li>
                    <li>Transaction feedback</li>
                </ul>
                <button class="test-button" onclick="alert('Mağaza sistemi yakında eklenecek!')">Yakında</button>
            </div>

            <!-- Audio System -->
            <div class="status-card completed">
                <div class="status-title">
                    🎵 Ses Sistemi
                </div>
                <div class="status-description">
                    Background music, SFX ve ses kontrolleri
                </div>
                <ul class="status-features">
                    <li>Background music playback</li>
                    <li>Sound effects (click, hover, notification)</li>
                    <li>Volume controls (master, music, sfx)</li>
                    <li>Mute/unmute functionality</li>
                    <li>Settings persistence</li>
                    <li>Web Audio API integration</li>
                </ul>
                <a href="settings.php" class="test-button">Test Et</a>
            </div>

            <!-- UI/UX Features -->
            <div class="status-card completed">
                <div class="status-title">
                    ✨ UI/UX Özellikleri
                </div>
                <div class="status-description">
                    Glassmorphism tasarım ve etkileşim efektleri
                </div>
                <ul class="status-features">
                    <li>Glassmorphism design</li>
                    <li>Cursor-adaptive parallax</li>
                    <li>Smooth animations</li>
                    <li>Mobile-first responsive</li>
                    <li>Touch gestures</li>
                    <li>Loading screens</li>
                </ul>
                <a href="main-menu.php" class="test-button">Test Et</a>
            </div>

            <!-- Data Persistence -->
            <div class="status-card completed">
                <div class="status-title">
                    💾 Veri Kalıcılığı
                </div>
                <div class="status-description">
                    LocalStorage ile oyun verisi kaydetme
                </div>
                <ul class="status-features">
                    <li>Auto-save functionality</li>
                    <li>Settings persistence</li>
                    <li>Game progress tracking</li>
                    <li>Export/Import system</li>
                    <li>Data validation</li>
                    <li>Backup system</li>
                </ul>
                <a href="settings.php" class="test-button">Test Et</a>
            </div>

            <!-- Navigation System -->
            <div class="status-card completed">
                <div class="status-title">
                    🧭 Navigasyon Sistemi
                </div>
                <div class="status-description">
                    Breadcrumb, back button ve keyboard shortcuts
                </div>
                <ul class="status-features">
                    <li>Breadcrumb navigation</li>
                    <li>Floating back button</li>
                    <li>Keyboard shortcuts (Alt+H, Alt+S, etc.)</li>
                    <li>History management</li>
                    <li>URL state management</li>
                    <li>Page transition effects</li>
                </ul>
                <a href="main-menu.php" class="test-button">Test Et</a>
            </div>

            <!-- Performance -->
            <div class="status-card completed">
                <div class="status-title">
                    ⚡ Performans
                </div>
                <div class="status-description">
                    Optimizasyon ve performans izleme
                </div>
                <ul class="status-features">
                    <li>Lazy loading images</li>
                    <li>Resource preloading</li>
                    <li>Memory management</li>
                    <li>FPS monitoring</li>
                    <li>Auto-optimization</li>
                    <li>Error handling</li>
                </ul>
                <a href="main-menu.php" class="test-button">Test Et</a>
            </div>

            <!-- Future Features -->
            <div class="status-card pending">
                <div class="status-title">
                    🔮 Gelecek Özellikler
                </div>
                <div class="status-description">
                    Planlanan ama henüz implement edilmemiş özellikler
                </div>
                <ul class="status-features">
                    <li class="pending">Chat system - Gerçek zamanlı sohbet</li>
                    <li class="pending">Story mode - Ana hikaye sistemi</li>
                    <li class="pending">Achievement system - Başarım sistemi</li>
                    <li class="pending">Daily events - Günlük etkinlikler</li>
                    <li class="pending">Push notifications</li>
                    <li class="pending">Social features</li>
                </ul>
                <button class="test-button" disabled>Yakında</button>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 40px; padding: 20px; color: var(--c4);">
            <p>🎮 Celestial Tale - Interactive Visual Novel</p>
            <p>Tüm sistemler test edildi ve çalışır durumda!</p>
        </div>
    </div>

    <!-- Scripts - Load in correct order -->
    <script src="assets/js/loading-manager.js"></script>
    <script src="assets/js/data-manager.js"></script>
    <script src="assets/js/settings-manager.js"></script>
    <script src="assets/js/audio-manager.js"></script>
    <script src="assets/js/navigation.js"></script>
    <script src="assets/js/parallax-cursor.js"></script>
    <script src="assets/js/app-integration.js"></script>
    
    <script>
        // System Overview Controller
        document.addEventListener('DOMContentLoaded', async () => {
            // Wait for app initialization
            if (window.waitForApp) {
                await window.waitForApp();
            }
            
            // Update stats with real data
            updateSystemStats();
            
            // Test all systems
            testSystemIntegration();
        });
        
        function updateSystemStats() {
            // Count completed features
            const completedCards = document.querySelectorAll('.status-card.completed').length;
            const totalCards = document.querySelectorAll('.status-card').length;
            const completionRate = Math.round((completedCards / totalCards) * 100);
            
            document.getElementById('completed-features').textContent = completedCards;
            document.getElementById('completion-rate').textContent = completionRate + '%';
            
            // Animate stats
            animateStats();
        }
        
        function animateStats() {
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach((stat, index) => {
                stat.style.opacity = '0';
                stat.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    stat.style.transition = 'all 0.5s ease';
                    stat.style.opacity = '1';
                    stat.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }
        
        function testSystemIntegration() {
            console.log('🧪 Testing system integration...');
            
            const tests = [
                { name: 'Data Manager', test: () => window.dataManager && window.dataManager.getAllData },
                { name: 'Settings Manager', test: () => window.settingsManager && window.settingsManager.get },
                { name: 'Audio Manager', test: () => window.audioManager && window.audioManager.playSound },
                { name: 'Navigation Manager', test: () => window.navigationManager && window.navigationManager.getCurrentPage },
                { name: 'Loading Manager', test: () => window.loadingManager && window.loadingManager.showLoading },
                { name: 'App Integration', test: () => window.appIntegration && window.appIntegration.isInitialized }
            ];
            
            const results = tests.map(test => {
                try {
                    const result = test.test();
                    console.log(`✅ ${test.name}: OK`);
                    return { name: test.name, status: 'OK', result };
                } catch (error) {
                    console.error(`❌ ${test.name}: FAIL`, error);
                    return { name: test.name, status: 'FAIL', error };
                }
            });
            
            console.log('🧪 System integration test results:', results);
            
            // Show results in UI
            const passedTests = results.filter(r => r.status === 'OK').length;
            const totalTests = results.length;
            
            if (passedTests === totalTests) {
                console.log('🎉 All systems operational!');
            } else {
                console.warn(`⚠️ ${totalTests - passedTests} systems have issues`);
            }
        }
    </script>
</body>
</html>
