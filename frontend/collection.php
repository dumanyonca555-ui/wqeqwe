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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksiyon - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <link rel="stylesheet" href="assets/css/collection-mobile.css">
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <main class="main-container">
        <div id="ajax-content" class="content-container">


            <!-- User Profile Header -->
            <div class="profile-header">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <div class="avatar-circle"></div>
                    </div>
                    <div class="profile-details">
                        <h2 class="profile-name"><?php echo htmlspecialchars($user['username']); ?></h2>
                        <p class="profile-role">Neural Network Agent</p>
                    </div>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-value">1250</span>
                            <span class="stat-icon">💎</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">89</span>
                            <span class="stat-icon">💙</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">456</span>
                            <span class="stat-icon">📊</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Cosmic Festival Event -->
            <div class="event-card cosmic">
                <div class="event-background"></div>
                <div class="event-content">
                    <div class="event-icon">🎆</div>
                    <div class="event-info">
                        <h3 class="event-title">Kozmik Festival Etkinliği</h3>
                        <div class="event-progress">
                            <span class="progress-text">2g 12s 27d 12s</span>
                        </div>
                    </div>
                </div>
                <div class="event-glow"></div>
            </div>
            
            <!-- Collection Content -->
            <div class="collection-content">
                <!-- Collection Tabs -->
                <div class="collection-tabs">
                    <button class="collection-tab active" data-tab="cg" onclick="switchCollectionTab('cg')">
                        🎨 CG Galerisi
                    </button>
                    <button class="collection-tab" data-tab="achievements" onclick="switchCollectionTab('achievements')">
                        🏆 Başarımlar
                    </button>
                    <button class="collection-tab" data-tab="music" onclick="switchCollectionTab('music')">
                        🎵 Müzik
                    </button>
                    <button class="collection-tab" data-tab="memories" onclick="switchCollectionTab('memories')">
                        📚 Anılar
                    </button>
                </div>

                <!-- CG Gallery Tab -->
                <div class="tab-content active" id="cg-content">
                    <div class="collection-grid" id="cg-grid">
                        <!-- CG items will be loaded via AJAX -->
                    </div>
                </div>

                <!-- Achievements Tab -->
                <div class="tab-content" id="achievements-content">
                    <div class="achievements-list" id="achievements-list">
                        <!-- Achievements will be loaded via AJAX -->
                    </div>
                </div>

                <!-- Music Tab -->
                <div class="tab-content" id="music-content">
                    <div class="music-list" id="music-list">
                        <!-- Music items will be loaded via AJAX -->
                    </div>
                </div>

                <!-- Memories Tab -->
                <div class="tab-content" id="memories-content">
                    <div class="memories-list" id="memories-list">
                        <!-- Memory items will be loaded via AJAX -->
                    </div>
                </div>
            </div>
        </div>
        
        <div class="floating-particles"></div>
    </main>
    
    <script>
        // Collection Mobile Controller
        class CollectionController {
            constructor() {
                this.currentTab = 'cg';
                this.data = {
                    cg: [
                        { id: 1, title: 'Leo ile İlk Karşılaşma', description: 'Stratejist Leo ile tanışma anı', icon: '🎭' },
                        { id: 2, title: 'Chloe\'nin Hacker Odası', description: 'Teknoloji dolu gizli mekan', icon: '💻' },
                        { id: 3, title: 'Felix\'in Gülümsemesi', description: 'Kalbi temiz Felix\'in sıcaklığı', icon: '😊' },
                        { id: 4, title: 'Neural Network Merkezi', description: 'Sistemin kalbi', icon: '🧠' }
                    ],
                    achievements: [
                        { id: 1, title: 'İlk Adım', description: 'Oyuna ilk kez giriş yaptın', icon: '🚀' },
                        { id: 2, title: 'Sohbet Ustası', description: '50 mesaj gönderdin', icon: '💬' },
                        { id: 3, title: 'Koleksiyoncu', description: '10 CG topladın', icon: '🎨' }
                    ],
                    music: [
                        { id: 1, title: 'Main Theme', description: 'Ana tema müziği', icon: '🎵' },
                        { id: 2, title: 'Leo\'s Theme', description: 'Karakter teması', icon: '⚔️' },
                        { id: 3, title: 'Romantic Melody', description: 'Romantik anlar için', icon: '💕' }
                    ],
                    memories: [
                        { id: 1, title: 'İlk Gün Anıları', description: 'Neural Network\'e ilk girişin', icon: '📅' },
                        { id: 2, title: 'Leo ile Strateji', description: 'İlk strateji toplantısı', icon: '🎯' },
                        { id: 3, title: 'Gizli Keşif', description: 'Chloe ile sistem keşfi', icon: '🔍' }
                    ]
                };
                this.init();
            }

            init() {
                console.log('🎨 Collection Controller Initializing...');
                this.loadTabContent(this.currentTab);
                this.createStarfield();
                console.log('✅ Collection Controller Ready!');
            }

            createStarfield() {
                const starfield = document.querySelector('.starfield');
                if (!starfield) return;

                const starCount = 50;
                for (let i = 0; i < starCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'star';
                    star.style.left = Math.random() * 100 + '%';
                    star.style.top = Math.random() * 100 + '%';
                    star.style.animationDelay = Math.random() * 3 + 's';
                    starfield.appendChild(star);
                }
            }

            loadTabContent(tabName) {
                // Show loading
                const container = document.getElementById(`${tabName}-${tabName === 'cg' ? 'grid' : 'list'}`);
                if (!container) return;

                container.innerHTML = '<div class="loading">Yükleniyor...</div>';

                // Simulate AJAX call
                setTimeout(() => {
                    this.renderTabContent(tabName);
                }, 500);
            }

            renderTabContent(tabName) {
                const items = this.data[tabName] || [];
                const container = document.getElementById(`${tabName}-${tabName === 'cg' ? 'grid' : 'list'}`);

                if (tabName === 'cg') {
                    container.innerHTML = items.map(item => `
                        <div class="collection-item" onclick="collectionController.viewItem('${tabName}', ${item.id})">
                            <div class="item-image">${item.icon}</div>
                            <div class="item-info">
                                <div class="item-title">${item.title}</div>
                                <div class="item-description">${item.description}</div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = items.map(item => `
                        <div class="list-item" onclick="collectionController.viewItem('${tabName}', ${item.id})">
                            <div class="list-item-header">
                                <div class="list-item-icon">${item.icon}</div>
                                <div class="list-item-info">
                                    <div class="list-item-title">${item.title}</div>
                                    <div class="list-item-description">${item.description}</div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
            }

            viewItem(tabName, itemId) {
                const item = this.data[tabName].find(i => i.id === itemId);
                if (item) {
                    this.showNotification(`${item.title} görüntüleniyor...`);
                }
            }

            showNotification(message) {
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: var(--glass-bg);
                    backdrop-filter: blur(var(--blur-md));
                    border: 1px solid var(--glass-border);
                    border-radius: 12px;
                    padding: 16px 20px;
                    color: var(--color5);
                    z-index: 1000;
                    opacity: 0;
                    transform: translateX(100px);
                    transition: all 0.3s ease;
                    font-family: 'Montserrat', sans-serif;
                    font-size: 0.9rem;
                `;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '1';
                    notification.style.transform = 'translateX(0)';
                }, 10);

                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100px)';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }
        }

        // Tab switching function
        function switchCollectionTab(tabName) {
            // Update tab buttons
            document.querySelectorAll('.collection-tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.tab === tabName);
            });

            // Update content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.toggle('active', content.id === `${tabName}-content`);
            });

            // Load content via AJAX
            collectionController.currentTab = tabName;
            collectionController.loadTabContent(tabName);
        }

        // Initialize
        let collectionController;
        document.addEventListener('DOMContentLoaded', function() {
            collectionController = new CollectionController();
        });
    </script>
</body>
</html>