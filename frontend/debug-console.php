<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Console - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <style>
        body {
            font-family: 'Montserrat', monospace;
            background: var(--accent-grad);
            color: var(--c5);
            padding: 20px;
            line-height: 1.6;
        }
        
        .debug-container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--glass-bg);
            backdrop-filter: var(--blur-glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
        }
        
        .debug-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .debug-header h1 {
            color: var(--c5);
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: var(--accent-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .test-section {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .test-section h3 {
            color: var(--c3);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }
        
        .test-result {
            padding: 10px;
            border-radius: 8px;
            margin: 5px 0;
            font-family: monospace;
            font-size: 0.9rem;
        }
        
        .test-result.success {
            background: rgba(34, 197, 94, 0.2);
            border-left: 4px solid #22c55e;
            color: #22c55e;
        }
        
        .test-result.error {
            background: rgba(239, 68, 68, 0.2);
            border-left: 4px solid #ef4444;
            color: #ef4444;
        }
        
        .test-result.warning {
            background: rgba(245, 158, 11, 0.2);
            border-left: 4px solid #f59e0b;
            color: #f59e0b;
        }
        
        .test-result.info {
            background: rgba(123, 159, 255, 0.2);
            border-left: 4px solid #7b9fff;
            color: #7b9fff;
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
            margin: 5px;
        }
        
        .test-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        
        .page-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .page-link {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--c4);
            padding: 15px;
            border-radius: 12px;
            text-decoration: none;
            text-align: center;
            transition: all var(--transition-smooth);
            display: block;
        }
        
        .page-link:hover {
            background: var(--accent-grad);
            color: var(--c5);
            transform: translateY(-2px);
        }
        
        #console-output {
            background: #1a1a1a;
            color: #00ff00;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="debug-container">
        <div class="debug-header">
            <h1>🔧 Debug Console</h1>
            <p>Celestial Tale - Sistem Test ve Debug Merkezi</p>
        </div>

        <!-- System Status -->
        <div class="test-section">
            <h3>📊 Sistem Durumu</h3>
            <div id="system-status">
                <div class="test-result info">Sistem kontrol ediliyor...</div>
            </div>
            <button class="test-button" onclick="checkSystemStatus()">Sistem Durumunu Kontrol Et</button>
        </div>

        <!-- JavaScript Tests -->
        <div class="test-section">
            <h3>🧪 JavaScript Testleri</h3>
            <div id="js-tests">
                <div class="test-result info">Testler hazırlanıyor...</div>
            </div>
            <button class="test-button" onclick="runJavaScriptTests()">JavaScript Testlerini Çalıştır</button>
        </div>

        <!-- Audio Tests -->
        <div class="test-section">
            <h3>🎵 Ses Sistemi Testleri</h3>
            <div id="audio-tests">
                <div class="test-result info">Ses sistemi kontrol ediliyor...</div>
            </div>
            <button class="test-button" onclick="testAudioSystem()">Ses Sistemini Test Et</button>
            <button class="test-button" onclick="playTestSound()">Test Sesi Çal</button>
        </div>

        <!-- Data Persistence Tests -->
        <div class="test-section">
            <h3>💾 Veri Kalıcılığı Testleri</h3>
            <div id="data-tests">
                <div class="test-result info">Veri sistemi kontrol ediliyor...</div>
            </div>
            <button class="test-button" onclick="testDataPersistence()">Veri Sistemini Test Et</button>
            <button class="test-button" onclick="clearAllData()">Tüm Verileri Temizle</button>
        </div>

        <!-- Navigation Tests -->
        <div class="test-section">
            <h3>🧭 Navigasyon Testleri</h3>
            <div id="nav-tests">
                <div class="test-result info">Navigasyon sistemi kontrol ediliyor...</div>
            </div>
            <button class="test-button" onclick="testNavigation()">Navigasyonu Test Et</button>
        </div>

        <!-- Console Output -->
        <div class="test-section">
            <h3>📝 Console Çıktısı</h3>
            <div id="console-output">Console mesajları burada görünecek...</div>
            <button class="test-button" onclick="clearConsole()">Console'u Temizle</button>
        </div>

        <!-- Page Links -->
        <div class="test-section">
            <h3>🔗 Sayfa Linkleri</h3>
            <div class="page-links">
                <a href="main-menu.php" class="page-link">🏠 Ana Menü</a>
                <a href="settings.php" class="page-link">⚙️ Ayarlar</a>
                <a href="gallery.php" class="page-link">🎨 Galeri</a>
                <a href="collection.php" class="page-link">📚 Koleksiyon</a>
                <a href="character-leo.php" class="page-link">👤 Leo</a>
                <a href="character-chloe.php" class="page-link">👤 Chloe</a>
                <a href="character-felix.php" class="page-link">👤 Felix</a>
                <a href="character-elara.php" class="page-link">👤 Elara</a>
                <a href="system-overview.php" class="page-link">📊 Sistem Genel Bakış</a>
            </div>
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
        // Debug Console Controller
        class DebugConsole {
            constructor() {
                this.consoleOutput = document.getElementById('console-output');
                this.init();
            }

            init() {
                this.log('🔧 Debug Console Initialized');
                this.interceptConsole();
                this.checkSystemStatus();
            }

            interceptConsole() {
                const originalLog = console.log;
                const originalError = console.error;
                const originalWarn = console.warn;

                console.log = (...args) => {
                    originalLog.apply(console, args);
                    this.addToConsole('LOG', args.join(' '));
                };

                console.error = (...args) => {
                    originalError.apply(console, args);
                    this.addToConsole('ERROR', args.join(' '));
                };

                console.warn = (...args) => {
                    originalWarn.apply(console, args);
                    this.addToConsole('WARN', args.join(' '));
                };
            }

            addToConsole(type, message) {
                const timestamp = new Date().toLocaleTimeString();
                const line = `[${timestamp}] ${type}: ${message}\n`;
                this.consoleOutput.textContent += line;
                this.consoleOutput.scrollTop = this.consoleOutput.scrollHeight;
            }

            log(message) {
                console.log(message);
            }

            updateTestResult(containerId, results) {
                const container = document.getElementById(containerId);
                container.innerHTML = results.map(result => 
                    `<div class="test-result ${result.type}">${result.message}</div>`
                ).join('');
            }
        }

        // Test Functions
        function checkSystemStatus() {
            const results = [];
            
            // Check if all systems are loaded
            const systems = [
                { name: 'Loading Manager', obj: window.loadingManager },
                { name: 'Data Manager', obj: window.dataManager },
                { name: 'Settings Manager', obj: window.settingsManager },
                { name: 'Audio Manager', obj: window.audioManager },
                { name: 'Navigation Manager', obj: window.navigationManager },
                { name: 'App Integration', obj: window.appIntegration }
            ];

            systems.forEach(system => {
                if (system.obj) {
                    results.push({
                        type: 'success',
                        message: `✅ ${system.name}: Loaded`
                    });
                } else {
                    results.push({
                        type: 'error',
                        message: `❌ ${system.name}: Not loaded`
                    });
                }
            });

            // Check localStorage
            try {
                localStorage.setItem('test', 'test');
                localStorage.removeItem('test');
                results.push({
                    type: 'success',
                    message: '✅ LocalStorage: Available'
                });
            } catch (e) {
                results.push({
                    type: 'error',
                    message: '❌ LocalStorage: Not available'
                });
            }

            // Check CSS variables
            const testElement = document.createElement('div');
            document.body.appendChild(testElement);
            const computedStyle = getComputedStyle(testElement);
            const c1 = computedStyle.getPropertyValue('--c1');
            document.body.removeChild(testElement);

            if (c1) {
                results.push({
                    type: 'success',
                    message: '✅ CSS Variables: Loaded'
                });
            } else {
                results.push({
                    type: 'warning',
                    message: '⚠️ CSS Variables: May not be loaded'
                });
            }

            debugConsole.updateTestResult('system-status', results);
        }

        function runJavaScriptTests() {
            const results = [];

            // Test basic JavaScript features
            try {
                // ES6 features
                const testArrow = () => 'arrow function works';
                const testTemplate = `template literal works`;
                const testDestructuring = { a: 1, b: 2 };
                const { a, b } = testDestructuring;

                results.push({
                    type: 'success',
                    message: '✅ ES6 Features: Working'
                });
            } catch (e) {
                results.push({
                    type: 'error',
                    message: `❌ ES6 Features: ${e.message}`
                });
            }

            // Test async/await
            try {
                const testAsync = async () => {
                    return await Promise.resolve('async works');
                };
                results.push({
                    type: 'success',
                    message: '✅ Async/Await: Working'
                });
            } catch (e) {
                results.push({
                    type: 'error',
                    message: `❌ Async/Await: ${e.message}`
                });
            }

            // Test DOM manipulation
            try {
                const testDiv = document.createElement('div');
                testDiv.classList.add('test');
                results.push({
                    type: 'success',
                    message: '✅ DOM Manipulation: Working'
                });
            } catch (e) {
                results.push({
                    type: 'error',
                    message: `❌ DOM Manipulation: ${e.message}`
                });
            }

            debugConsole.updateTestResult('js-tests', results);
        }

        function testAudioSystem() {
            const results = [];

            if (window.audioManager) {
                results.push({
                    type: 'success',
                    message: '✅ Audio Manager: Loaded'
                });

                // Test audio context
                try {
                    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    results.push({
                        type: 'success',
                        message: '✅ Web Audio API: Available'
                    });
                } catch (e) {
                    results.push({
                        type: 'warning',
                        message: '⚠️ Web Audio API: Limited support'
                    });
                }

                // Test audio files
                const testAudio = new Audio();
                testAudio.addEventListener('canplaythrough', () => {
                    results.push({
                        type: 'success',
                        message: '✅ Audio Files: Can load'
                    });
                    debugConsole.updateTestResult('audio-tests', results);
                });

                testAudio.addEventListener('error', () => {
                    results.push({
                        type: 'error',
                        message: '❌ Audio Files: Cannot load'
                    });
                    debugConsole.updateTestResult('audio-tests', results);
                });

                testAudio.src = 'assets/audio/sfx/click_soft.wav';
            } else {
                results.push({
                    type: 'error',
                    message: '❌ Audio Manager: Not loaded'
                });
            }

            debugConsole.updateTestResult('audio-tests', results);
        }

        function playTestSound() {
            if (window.audioManager) {
                window.audioManager.playSound('click');
                debugConsole.log('🎵 Test sound played');
            } else {
                debugConsole.log('❌ Audio Manager not available');
            }
        }

        function testDataPersistence() {
            const results = [];

            if (window.dataManager) {
                results.push({
                    type: 'success',
                    message: '✅ Data Manager: Loaded'
                });

                // Test data operations
                try {
                    const testData = window.dataManager.get('user.username');
                    results.push({
                        type: 'success',
                        message: `✅ Data Read: ${testData || 'Default data'}`
                    });

                    window.dataManager.set('test.debug', 'debug test');
                    const readBack = window.dataManager.get('test.debug');
                    
                    if (readBack === 'debug test') {
                        results.push({
                            type: 'success',
                            message: '✅ Data Write/Read: Working'
                        });
                    } else {
                        results.push({
                            type: 'error',
                            message: '❌ Data Write/Read: Failed'
                        });
                    }
                } catch (e) {
                    results.push({
                        type: 'error',
                        message: `❌ Data Operations: ${e.message}`
                    });
                }
            } else {
                results.push({
                    type: 'error',
                    message: '❌ Data Manager: Not loaded'
                });
            }

            debugConsole.updateTestResult('data-tests', results);
        }

        function clearAllData() {
            if (window.dataManager && confirm('Tüm oyun verilerini silmek istediğinizden emin misiniz?')) {
                window.dataManager.resetAllData();
                debugConsole.log('🗑️ All data cleared');
            }
        }

        function testNavigation() {
            const results = [];

            if (window.navigationManager) {
                results.push({
                    type: 'success',
                    message: '✅ Navigation Manager: Loaded'
                });

                const currentPage = window.navigationManager.getCurrentPage();
                results.push({
                    type: 'info',
                    message: `📍 Current Page: ${currentPage}`
                });

                const canGoBack = window.navigationManager.canGoBack();
                results.push({
                    type: 'info',
                    message: `⬅️ Can Go Back: ${canGoBack ? 'Yes' : 'No'}`
                });
            } else {
                results.push({
                    type: 'error',
                    message: '❌ Navigation Manager: Not loaded'
                });
            }

            debugConsole.updateTestResult('nav-tests', results);
        }

        function clearConsole() {
            document.getElementById('console-output').textContent = '';
            debugConsole.log('🧹 Console cleared');
        }

        // Initialize Debug Console
        let debugConsole;
        document.addEventListener('DOMContentLoaded', async () => {
            // Wait for app initialization
            if (window.waitForApp) {
                await window.waitForApp();
            }
            
            debugConsole = new DebugConsole();
            
            // Run initial tests
            setTimeout(() => {
                checkSystemStatus();
                runJavaScriptTests();
                testAudioSystem();
                testDataPersistence();
                testNavigation();
            }, 1000);
        });
    </script>
</body>
</html>
