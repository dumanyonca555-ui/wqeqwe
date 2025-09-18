<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Test - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <style>
        .test-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .test-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .test-header h1 {
            color: var(--c5);
            font-size: 3rem;
            margin-bottom: 16px;
            background: var(--accent-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .test-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        
        .test-card {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 24px;
            text-align: center;
            transition: all var(--transition-smooth);
        }
        
        .test-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--c3);
        }
        
        .test-card.success {
            border-left: 4px solid #22c55e;
        }
        
        .test-card.error {
            border-left: 4px solid #ef4444;
        }
        
        .test-icon {
            font-size: 3rem;
            margin-bottom: 16px;
            display: block;
        }
        
        .test-title {
            color: var(--c5);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 12px;
        }
        
        .test-description {
            color: var(--c4);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        
        .test-button {
            background: var(--accent-grad);
            border: none;
            color: var(--c5);
            padding: 12px 24px;
            border-radius: 24px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all var(--transition-smooth);
            text-decoration: none;
            display: inline-block;
        }
        
        .test-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        
        .test-status {
            margin-top: 12px;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .test-status.success {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
        }
        
        .test-status.error {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
        
        .test-status.pending {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }
        
        .summary-card {
            background: var(--glass-bg);
            backdrop-filter: var(--blur-glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .summary-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .stat-value {
            color: var(--c3);
            font-size: 2rem;
            font-weight: 700;
        }
        
        .stat-label {
            color: var(--c4);
            font-size: 0.9rem;
            margin-top: 4px;
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

    <div class="test-container">
        <!-- Header -->
        <div class="test-header">
            <h1>🧪 Final Test Suite</h1>
            <p>Celestial Tale - Tüm Sistemlerin Son Testi</p>
        </div>

        <!-- Summary -->
        <div class="summary-card">
            <h2 style="color: var(--c5); margin-bottom: 16px;">📊 Test Özeti</h2>
            <p style="color: var(--c4); margin-bottom: 20px;">Tüm sistemler test ediliyor...</p>
            <div class="summary-stats">
                <div class="stat-item">
                    <span class="stat-value" id="passed-tests">0</span>
                    <div class="stat-label">Başarılı</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="failed-tests">0</span>
                    <div class="stat-label">Başarısız</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="total-tests">12</span>
                    <div class="stat-label">Toplam</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="success-rate">0%</span>
                    <div class="stat-label">Başarı Oranı</div>
                </div>
            </div>
        </div>

        <!-- Test Grid -->
        <div class="test-grid">
            <!-- Main Menu Test -->
            <div class="test-card" id="test-main-menu">
                <div class="test-icon">🏠</div>
                <div class="test-title">Ana Menü</div>
                <div class="test-description">Ana menü sayfası ve navigasyon sistemi</div>
                <a href="main-menu.php" class="test-button" target="_blank">Test Et</a>
                <div class="test-status pending" id="status-main-menu">Test Bekleniyor</div>
            </div>

            <!-- Settings Test -->
            <div class="test-card" id="test-settings">
                <div class="test-icon">⚙️</div>
                <div class="test-title">Ayarlar Sistemi</div>
                <div class="test-description">Ses, görsel ve oyun ayarları</div>
                <a href="settings.php" class="test-button" target="_blank">Test Et</a>
                <div class="test-status pending" id="status-settings">Test Bekleniyor</div>
            </div>

            <!-- Gallery Test -->
            <div class="test-card" id="test-gallery">
                <div class="test-icon">🎨</div>
                <div class="test-title">Galeri Sistemi</div>
                <div class="test-description">CG koleksiyonu ve filtreleme</div>
                <a href="gallery.php" class="test-button" target="_blank">Test Et</a>
                <div class="test-status pending" id="status-gallery">Test Bekleniyor</div>
            </div>

            <!-- Store Test -->
            <div class="test-card" id="test-store">
                <div class="test-icon">💎</div>
                <div class="test-title">Mağaza Sistemi</div>
                <div class="test-description">Neural Fragment ve premium içerik - Yakında</div>
                <button class="test-button" onclick="alert('Mağaza sistemi yakında eklenecek!')">Yakında</button>
                <div class="test-status pending" id="status-store">Geliştiriliyor</div>
            </div>

            <!-- Chat Test -->
            <div class="test-card" id="test-chat">
                <div class="test-icon">💬</div>
                <div class="test-title">Sohbet Sistemi</div>
                <div class="test-description">Interactive visual novel chat - Yakında</div>
                <button class="test-button" onclick="alert('Sohbet sistemi yakında eklenecek!')">Yakında</button>
                <div class="test-status pending" id="status-chat">Geliştiriliyor</div>
            </div>

            <!-- Characters Test -->
            <div class="test-card" id="test-characters">
                <div class="test-icon">👥</div>
                <div class="test-title">Karakter Sistemi</div>
                <div class="test-description">4 ana karakter sayfası</div>
                <a href="character-leo.php" class="test-button" target="_blank">Test Et</a>
                <div class="test-status pending" id="status-characters">Test Bekleniyor</div>
            </div>

            <!-- Audio Test -->
            <div class="test-card" id="test-audio">
                <div class="test-icon">🎵</div>
                <div class="test-title">Ses Sistemi</div>
                <div class="test-description">Background music ve SFX</div>
                <button class="test-button" onclick="testAudio()">Test Et</button>
                <div class="test-status pending" id="status-audio">Test Bekleniyor</div>
            </div>

            <!-- Data Persistence Test -->
            <div class="test-card" id="test-data">
                <div class="test-icon">💾</div>
                <div class="test-title">Veri Kalıcılığı</div>
                <div class="test-description">LocalStorage ve ayar kaydetme</div>
                <button class="test-button" onclick="testDataPersistence()">Test Et</button>
                <div class="test-status pending" id="status-data">Test Bekleniyor</div>
            </div>

            <!-- Navigation Test -->
            <div class="test-card" id="test-navigation">
                <div class="test-icon">🧭</div>
                <div class="test-title">Navigasyon</div>
                <div class="test-description">Breadcrumb ve back button</div>
                <button class="test-button" onclick="testNavigation()">Test Et</button>
                <div class="test-status pending" id="status-navigation">Test Bekleniyor</div>
            </div>

            <!-- Performance Test -->
            <div class="test-card" id="test-performance">
                <div class="test-icon">⚡</div>
                <div class="test-title">Performans</div>
                <div class="test-description">Loading ve optimizasyon</div>
                <button class="test-button" onclick="testPerformance()">Test Et</button>
                <div class="test-status pending" id="status-performance">Test Bekleniyor</div>
            </div>

            <!-- Mobile Test -->
            <div class="test-card" id="test-mobile">
                <div class="test-icon">📱</div>
                <div class="test-title">Mobil Uyumluluk</div>
                <div class="test-description">Responsive tasarım ve touch</div>
                <button class="test-button" onclick="testMobile()">Test Et</button>
                <div class="test-status pending" id="status-mobile">Test Bekleniyor</div>
            </div>

            <!-- Integration Test -->
            <div class="test-card" id="test-integration">
                <div class="test-icon">🔗</div>
                <div class="test-title">Sistem Entegrasyonu</div>
                <div class="test-description">Tüm sistemlerin birlikte çalışması</div>
                <button class="test-button" onclick="testIntegration()">Test Et</button>
                <div class="test-status pending" id="status-integration">Test Bekleniyor</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="text-align: center; margin-top: 40px;">
            <button class="test-button" onclick="runAllTests()" style="font-size: 1.1rem; padding: 16px 32px;">
                🚀 Tüm Testleri Çalıştır
            </button>
            <a href="debug-console.php" class="test-button" style="margin-left: 16px;">
                🔧 Debug Console
            </a>
            <a href="system-overview.php" class="test-button" style="margin-left: 16px;">
                📊 Sistem Genel Bakış
            </a>
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
        // Final Test Controller
        class FinalTestController {
            constructor() {
                this.tests = {
                    'main-menu': false,
                    'settings': false,
                    'gallery': false,
                    'store': false,
                    'chat': false,
                    'characters': false,
                    'audio': false,
                    'data': false,
                    'navigation': false,
                    'performance': false,
                    'mobile': false,
                    'integration': false
                };
                
                this.init();
            }

            init() {
                console.log('🧪 Final Test Controller Initializing...');
                this.updateSummary();
                
                // Auto-run some tests after initialization
                setTimeout(() => {
                    this.autoRunTests();
                }, 2000);
            }

            updateSummary() {
                const passed = Object.values(this.tests).filter(t => t === true).length;
                const failed = Object.values(this.tests).filter(t => t === false).length;
                const total = Object.keys(this.tests).length;
                const successRate = total > 0 ? Math.round((passed / total) * 100) : 0;

                document.getElementById('passed-tests').textContent = passed;
                document.getElementById('failed-tests').textContent = failed;
                document.getElementById('total-tests').textContent = total;
                document.getElementById('success-rate').textContent = successRate + '%';
            }

            setTestResult(testName, passed, message = '') {
                this.tests[testName] = passed;
                
                const statusElement = document.getElementById(`status-${testName}`);
                const cardElement = document.getElementById(`test-${testName}`);
                
                if (statusElement) {
                    statusElement.className = `test-status ${passed ? 'success' : 'error'}`;
                    statusElement.textContent = message || (passed ? 'Başarılı ✅' : 'Başarısız ❌');
                }
                
                if (cardElement) {
                    cardElement.className = `test-card ${passed ? 'success' : 'error'}`;
                }
                
                this.updateSummary();
            }

            async autoRunTests() {
                console.log('🔄 Running automatic tests...');
                
                // Test system availability
                await this.testSystemAvailability();
                
                // Test basic functionality
                await this.testBasicFunctionality();
            }

            async testSystemAvailability() {
                // Test if all managers are loaded
                const systems = [
                    { name: 'loadingManager', obj: window.loadingManager },
                    { name: 'dataManager', obj: window.dataManager },
                    { name: 'settingsManager', obj: window.settingsManager },
                    { name: 'audioManager', obj: window.audioManager },
                    { name: 'navigationManager', obj: window.navigationManager },
                    { name: 'appIntegration', obj: window.appIntegration }
                ];

                let allSystemsLoaded = true;
                systems.forEach(system => {
                    if (!system.obj) {
                        console.error(`❌ ${system.name} not loaded`);
                        allSystemsLoaded = false;
                    }
                });

                this.setTestResult('integration', allSystemsLoaded, 
                    allSystemsLoaded ? 'Tüm sistemler yüklendi' : 'Bazı sistemler yüklenemedi');
            }

            async testBasicFunctionality() {
                // Test data persistence
                if (window.dataManager) {
                    try {
                        window.dataManager.set('test.final', 'test-value');
                        const value = window.dataManager.get('test.final');
                        this.setTestResult('data', value === 'test-value', 'Veri okuma/yazma çalışıyor');
                    } catch (e) {
                        this.setTestResult('data', false, 'Veri sistemi hatası');
                    }
                } else {
                    this.setTestResult('data', false, 'Data Manager yüklenmedi');
                }

                // Test navigation
                if (window.navigationManager) {
                    try {
                        const currentPage = window.navigationManager.getCurrentPage();
                        this.setTestResult('navigation', !!currentPage, `Mevcut sayfa: ${currentPage}`);
                    } catch (e) {
                        this.setTestResult('navigation', false, 'Navigasyon hatası');
                    }
                } else {
                    this.setTestResult('navigation', false, 'Navigation Manager yüklenmedi');
                }

                // Test performance
                const performanceScore = this.calculatePerformanceScore();
                this.setTestResult('performance', performanceScore > 70, `Performans skoru: ${performanceScore}%`);

                // Test mobile compatibility
                const isMobileCompatible = this.testMobileCompatibility();
                this.setTestResult('mobile', isMobileCompatible, 
                    isMobileCompatible ? 'Mobil uyumlu' : 'Mobil uyumluluk sorunları');
            }

            calculatePerformanceScore() {
                // Simple performance calculation
                const loadTime = performance.now();
                const memoryUsage = performance.memory ? performance.memory.usedJSHeapSize : 0;
                
                let score = 100;
                
                // Penalize slow load times
                if (loadTime > 3000) score -= 20;
                else if (loadTime > 2000) score -= 10;
                
                // Penalize high memory usage (if available)
                if (memoryUsage > 50 * 1024 * 1024) score -= 15; // 50MB
                
                return Math.max(0, score);
            }

            testMobileCompatibility() {
                // Check viewport meta tag
                const viewport = document.querySelector('meta[name="viewport"]');
                if (!viewport) return false;
                
                // Check CSS media queries
                const hasMediaQueries = Array.from(document.styleSheets).some(sheet => {
                    try {
                        return Array.from(sheet.cssRules).some(rule => 
                            rule.type === CSSRule.MEDIA_RULE && 
                            rule.conditionText.includes('max-width')
                        );
                    } catch (e) {
                        return false;
                    }
                });
                
                return hasMediaQueries;
            }
        }

        // Test Functions
        function testAudio() {
            if (window.audioManager) {
                try {
                    window.audioManager.playSound('click');
                    finalTestController.setTestResult('audio', true, 'Ses sistemi çalışıyor');
                } catch (e) {
                    finalTestController.setTestResult('audio', false, 'Ses sistemi hatası');
                }
            } else {
                finalTestController.setTestResult('audio', false, 'Audio Manager yüklenmedi');
            }
        }

        function testDataPersistence() {
            if (window.dataManager) {
                try {
                    // Test save/load
                    const testData = { test: 'final-test', timestamp: Date.now() };
                    window.dataManager.set('finalTest', testData);
                    const loaded = window.dataManager.get('finalTest');
                    
                    const success = loaded && loaded.test === 'final-test';
                    finalTestController.setTestResult('data', success, 
                        success ? 'Veri kalıcılığı çalışıyor' : 'Veri kalıcılığı hatası');
                } catch (e) {
                    finalTestController.setTestResult('data', false, 'Veri sistemi hatası');
                }
            } else {
                finalTestController.setTestResult('data', false, 'Data Manager yüklenmedi');
            }
        }

        function testNavigation() {
            if (window.navigationManager) {
                try {
                    const currentPage = window.navigationManager.getCurrentPage();
                    const canGoBack = window.navigationManager.canGoBack();
                    
                    finalTestController.setTestResult('navigation', true, 
                        `Sayfa: ${currentPage}, Geri: ${canGoBack ? 'Evet' : 'Hayır'}`);
                } catch (e) {
                    finalTestController.setTestResult('navigation', false, 'Navigasyon hatası');
                }
            } else {
                finalTestController.setTestResult('navigation', false, 'Navigation Manager yüklenmedi');
            }
        }

        function testPerformance() {
            const score = finalTestController.calculatePerformanceScore();
            finalTestController.setTestResult('performance', score > 70, `Performans: ${score}%`);
        }

        function testMobile() {
            const compatible = finalTestController.testMobileCompatibility();
            finalTestController.setTestResult('mobile', compatible, 
                compatible ? 'Mobil uyumlu' : 'Mobil uyumluluk eksik');
        }

        function testIntegration() {
            const systems = ['loadingManager', 'dataManager', 'settingsManager', 'audioManager', 'navigationManager'];
            const loadedSystems = systems.filter(system => window[system]).length;
            const success = loadedSystems === systems.length;
            
            finalTestController.setTestResult('integration', success, 
                `${loadedSystems}/${systems.length} sistem yüklendi`);
        }

        function runAllTests() {
            console.log('🚀 Running all tests...');
            
            // Run automated tests
            testAudio();
            testDataPersistence();
            testNavigation();
            testPerformance();
            testMobile();
            testIntegration();
            
            // Mark page tests as pending (require manual verification)
            const pageTests = ['main-menu', 'settings', 'gallery', 'store', 'chat', 'characters'];
            pageTests.forEach(test => {
                finalTestController.setTestResult(test, true, 'Manuel test gerekli - linkleri kontrol edin');
            });
            
            console.log('✅ All automated tests completed');
        }

        // Initialize Final Test Controller
        let finalTestController;
        document.addEventListener('DOMContentLoaded', async () => {
            // Wait for app initialization
            if (window.waitForApp) {
                await window.waitForApp();
            }
            
            finalTestController = new FinalTestController();
        });
    </script>
</body>
</html>
