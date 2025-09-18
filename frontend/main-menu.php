<?php
// Simplified main menu - no backend dependencies for now
// In production, add proper authentication and database calls

// Mock user data for testing
$user_logged_in = true;
$user_data = [
    'username' => 'TestUser',
    'neural_fragments' => 150,
    'memory_shards' => 75,
    'data_points' => 300
];

// Mock character profile for testing
$character_profile = [
    'username' => 'TestUser',
    'level' => 5,
    'experience' => 1250
];

$has_profile = true;

// Fetch character data for the submenu
$characters = [
    [
        'id' => 1,
        'name' => 'Leo',
        'role' => 'Strategist',
        'avatar' => '<img src="assets/images/characters/leo-portrait.png" alt="Leo" class="submenu-avatar">',
        'affinity' => 75,
        'status' => 'online',
        'action' => 'menuManager.loadContent(\'character-leo\')'
    ],
    [
        'id' => 2,
        'name' => 'Chloe',
        'role' => 'Hacker',
        'avatar' => '<img src="assets/images/characters/chloe-portrait.png" alt="Chloe" class="submenu-avatar">',
        'affinity' => 60,
        'status' => 'away',
        'action' => 'menuManager.loadContent(\'character-chloe\')'
    ],
    [
        'id' => 3,
        'name' => 'Felix',
        'role' => 'Heart',
        'avatar' => '<img src="assets/images/characters/felix-portrait.png" alt="Felix" class="submenu-avatar">',
        'affinity' => 90,
        'status' => 'online',
        'action' => 'menuManager.loadContent(\'character-felix\')'
    ],
    [
        'id' => 4,
        'name' => 'Elara',
        'role' => 'Mentor',
        'avatar' => '<img src="assets/images/characters/elara-portrait.png" alt="Elara" class="submenu-avatar">',
        'affinity' => 45,
        'status' => 'offline',
        'action' => 'menuManager.loadContent(\'character-elara\')'
    ]
];

// Menu data structure
$menuData = [
    'chat' => [
        'title' => 'Chat & Hikayeler',
        'icon' => '📱',
        'description' => 'Ana chat odası ve özel sohbetler. Karakterlerle etkileşime geçin.',
        'badge' => '3',
        'items' => [
            [
                'icon' => '💬',
                'title' => 'Sohbet & Hikayeler',
                'description' => 'Mobile-first sohbet arayüzü',
                'badge' => '3',
                'action' => 'window.location.href=\'chat-stories-mobile.php\''
            ],
            [
                'icon' => '🔒',
                'title' => 'Özel Chat Odaları',
                'description' => 'Karakterlerle özel sohbetler',
                'badge' => '12',
                'action' => 'loadContent(\'private-chat\')'
            ],
            [
                'icon' => '📦',
                'title' => 'Geçmiş Sohbetler',
                'description' => 'Önceki konuşmaları görüntüle',
                'action' => 'loadContent(\'story-history\')'
            ],
            [
                'icon' => '📖',
                'title' => 'Hikaye Modu',
                'description' => 'Ana hikaye progression',
                'badge' => 'Yeni',
                'special' => true,
                'action' => 'window.location.href=\'story-mode.php\''
            ],
            [
                'icon' => '👥',
                'title' => 'Karakter Rotaları',
                'description' => '4 karakter individual story paths',
                'badge' => '4',
                'action' => 'loadContent(\'character-routes\')'
            ],
            [
                'icon' => '📞',
                'title' => 'Telefon Aramaları',
                'description' => 'Missed calls ve call history',
                'badge' => '5',
                'action' => 'loadContent(\'call-history\')'
            ]
        ]
    ],
    'characters' => [
        'title' => 'Karakterler',
        'icon' => '👥',
        'description' => 'Leo, Chloe, Felix ve Elara ile ilişkilerinizi geliştirin.',
        'badge' => '4',
        'items' => array_merge([
            [
                'icon' => '👥',
                'title' => 'Tüm Karakterler',
                'description' => 'Mobile-first karakter arayüzü',
                'badge' => '4',
                'action' => 'window.location.href=\'characters-mobile.php\''
            ]
        ], $characters)
    ],
    'collection' => [
        'title' => 'Koleksiyon',
        'icon' => '📚',
        'description' => 'CG galerisi, ses kayıtları ve bonus hikayeleri.',
        'badge' => '3',
        'items' => [
            [
                'icon' => '🎨',
                'title' => 'Koleksiyon',
                'description' => 'Mobile-first koleksiyon arayüzü',
                'badge' => '24',
                'action' => 'window.location.href=\'collection-mobile.php\''
            ],
            [
                'icon' => '🖼️',
                'title' => 'CG Galerisi (Eski)',
                'description' => 'Önceki oyun görselleri ve sahneler',
                'badge' => '24',
                'action' => 'loadContent(\'gallery\')'
            ],
            [
                'icon' => '🎵',
                'title' => 'Ses Kayıtları',
                'description' => 'Karakter sesleri ve oyun müziği',
                'badge' => '18',
                'action' => 'loadContent(\'audio-collection\')'
            ],
            [
                'icon' => '📖',
                'title' => 'Bonus Hikayeler',
                'description' => 'Ekstra içerikler ve yan hikayeler',
                'badge' => 'Yeni',
                'special' => true,
                'action' => 'loadContent(\'bonus-stories\')'
            ]
        ]
    ],
    'events' => [
        'title' => 'Etkinlikler',
        'icon' => '⚡',
        'description' => 'Günlük rutinler ve özel etkinlikler.',
        'badge' => '5',
        'items' => [
            [
                'icon' => '🎉',
                'title' => 'Etkinlikler',
                'description' => 'Mobile-first etkinlik arayüzü',
                'badge' => '5',
                'action' => 'window.location.href=\'events-mobile.php\''
            ],
            [
                'icon' => '📅',
                'title' => 'Günlük Rutinler',
                'description' => 'Her gün katılabileceğin mini görevler',
                'badge' => '3',
                'action' => 'loadContent(\'daily-routines\')'
            ],
            [
                'icon' => '🎉',
                'title' => 'Özel Etkinlikler',
                'description' => 'Hafta sonu ve özel günlerde açılan etkinlikler',
                'badge' => '1',
                'action' => 'loadContent(\'special-events\')'
            ],
            [
                'icon' => '🏆',
                'title' => 'Ödüller',
                'description' => 'Etkinliklerden kazanılan item ve puanlar',
                'badge' => '12',
                'action' => 'loadContent(\'rewards\')'
            ],
            [
                'icon' => '⏰',
                'title' => 'Etkinlik Takvimi',
                'description' => 'Yaklaşan etkinlikler ve zamanlayıcılar',
                'action' => 'loadContent(\'event-calendar\')'
            ]
        ]
    ],
    'premium' => [
        'title' => 'Premium',
        'icon' => '👑',
        'description' => 'Neural Fragment paketleri ve VIP üyelik.',
        'badge' => 'VIP',
        'special' => true,
        'items' => [
            [
                'icon' => '💎',
                'title' => 'Premium Mağaza',
                'description' => 'Mobile-first premium mağaza',
                'badge' => 'VIP',
                'special' => true,
                'action' => 'window.location.href=\'premium-shop-mobile.php\''
            ],
            [
                'icon' => '💰',
                'title' => 'VIP Paketler',
                'description' => 'Neural Fragment paketleri ve özel içerik',
                'badge' => 'Popüler',
                'special' => true,
                'action' => 'loadContent(\'vip-packages\')'
            ],
            [
                'icon' => '📚',
                'title' => 'Özel Hikayeler',
                'description' => 'Sadece premium üyeler görebilir',
                'badge' => '8',
                'special' => true,
                'action' => 'loadContent(\'premium-stories\')'
            ],
            [
                'icon' => '👥',
                'title' => 'Bonus Karakterler',
                'description' => 'Geçici veya kalıcı yeni karakterler',
                'badge' => '4',
                'special' => true,
                'action' => 'loadContent(\'bonus-characters\')'
            ],
            [
                'icon' => '🎁',
                'title' => 'Premium Ödüller',
                'description' => 'Özel rozetler ve exclusive içerikler',
                'badge' => 'Yeni',
                'special' => true,
                'action' => 'loadContent(\'premium-rewards\')'
            ]
        ]
    ],
    'settings' => [
        'title' => 'Ayarlar',
        'icon' => '⚙️',
        'description' => 'Bildirimler, ses, görsel ve hesap yönetimi.',
        'items' => [
            [
                'icon' => '🔔',
                'title' => 'Bildirimler',
                'description' => 'Ses, popup ve e-mail bildirimleri',
                'action' => 'loadContent(\'notifications-settings\')'
            ],
            [
                'icon' => '🎵',
                'title' => 'Ses ve Müzik',
                'description' => 'Background müzik ve efektler kontrolü',
                'action' => 'loadContent(\'audio-settings\')'
            ],
            [
                'icon' => '🎨',
                'title' => 'Görsel Ayarlar',
                'description' => 'Theme seçimi, renk şeması, animasyon hızı',
                'action' => 'loadContent(\'visual-settings\')'
            ],
            [
                'icon' => '👤',
                'title' => 'Hesap Yönetimi',
                'description' => 'Profil güncelleme, şifre değiştirme',
                'action' => 'loadContent(\'account-management\')'
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celestial Tale - Ana Menü</title>
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
        <div id="ajax-content" class="content-container">
            <!-- User Profile Header -->
            <div class="profile-header">
                <div class="profile-info">
                    <div class="profile-avatar" onclick="loadContent('profile-edit')" title="Profili Düzenle">
                        <div class="avatar-circle"></div>
                    </div>
                    <div class="profile-details">
                        <h2 class="profile-name"><?php echo htmlspecialchars($user_data['username'] ?? 'Player'); ?></h2>
                        <p class="profile-role">Neural Network Agent</p>
                    </div>
                </div>
                <div class="profile-stats" onclick="loadContent('premium')" title="Premium Özellikleri">
                    <div class="stat-item">
                        <span class="stat-icon">💎</span>
                        <span class="stat-value">1250</span>
                        <span class="stat-label">Neural Fragments</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">💙</span>
                        <span class="stat-value">89</span>
                        <span class="stat-label">Affinity</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">📊</span>
                        <span class="stat-value">456</span>
                        <span class="stat-label">Experience</span>
                    </div>
                </div>
            </div>
            
            <!-- Cosmic Festival Event -->
            <div class="glass-card">
                <div class="event-content">
                    <div class="flex-between">
                        <div class="flex">
                            <div class="event-icon">🎆</div>
                            <div class="event-info">
                                <h3 class="event-title">Kozmik Festival Etkinliği</h3>
                                <div class="event-progress">
                                    <span class="progress-text">7g 12s 27d 12s</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Menu Cards -->
            <div class="menu-cards">
                <?php foreach ($menuData as $key => $menu): ?>
                <div class="menu-card <?php echo isset($menu['items']) ? 'expandable' : ''; ?>" 
                     onclick="<?php echo isset($menu['items']) ? "toggleSubmenu('{$key}-submenu')" : (isset($menu['action']) ? $menu['action'] : ''); ?>">
                    <div class="card-content">
                        <div class="card-icon"><?php echo $menu['icon']; ?></div>
                        <div class="card-info">
                            <h3 class="card-title"><?php echo $menu['title']; ?></h3>
                            <p class="card-description"><?php echo $menu['description']; ?></p>
                        </div>
                        <?php if (isset($menu['badge'])): ?>
                        <div class="card-badge <?php echo isset($menu['special']) ? 'special' : ''; ?>">
                            <?php echo $menu['badge']; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (isset($menu['items'])): ?>
                    <!-- Submenu for <?php echo $menu['title']; ?> -->
                    <div class="submenu-container" id="<?php echo $key; ?>-submenu">
                        <?php foreach ($menu['items'] as $item): ?>
                        <div class="submenu-item" 
                             onclick="<?php echo isset($item['action']) ? $item['action'] . '; event.stopPropagation(); event.preventDefault(); return false;' : 'event.stopPropagation(); event.preventDefault(); return false;'; ?>">
                            <div class="submenu-icon"><?php echo $item['icon'] ?? $item['avatar']; ?></div>
                            <div class="submenu-content">
                                <h4 class="submenu-title"><?php echo $item['title'] ?? $item['name']; ?></h4>
                                <p class="submenu-description"><?php echo $item['description'] ?? $item['role']; ?></p>
                                <?php if (isset($item['affinity'])): ?>
                                <div class="character-progress">
                                    <div class="character-progress-bar" style="width: <?php echo $item['affinity']; ?>%"></div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if (isset($item['badge'])): ?>
                            <div class="submenu-badge <?php echo isset($item['special']) ? 'special' : ''; ?>">
                                <?php echo $item['badge']; ?>
                            </div>
                            <?php elseif (isset($item['affinity'])): ?>
                            <div class="submenu-badge"><?php echo $item['affinity']; ?>%</div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="floating-particles"></div>
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

    <!-- Global Functions -->
    <script>
        // Global functions for menu actions
        function toggleSubmenu(submenuId) {
            if (window.menuManager) {
                window.menuManager.toggleSubmenu(submenuId);
            }
        }

        function loadContent(page) {
            if (window.menuManager) {
                window.menuManager.loadContent(page);
            }
        }

        function showNotification(message) {
            if (window.menuManager) {
                window.menuManager.showNotification(message);
            }
        }

        function toggleBackgroundMusic() {
            if (window.audioManager) {
                const musicBtn = document.getElementById('music-toggle');
                const musicIcon = musicBtn.querySelector('.music-icon');

                if (window.audioManager.music && !window.audioManager.music.paused) {
                    window.audioManager.pauseMusic();
                    musicIcon.textContent = '🔇';
                    musicBtn.title = 'Müziği Aç';
                } else {
                    window.audioManager.playMusic();
                    musicIcon.textContent = '🎵';
                    musicBtn.title = 'Müziği Kapat';
                }
            }
        }

        function setMusicVolume(value) {
            if (window.audioManager) {
                window.audioManager.setMusicVolume(value / 100);
            }
        }

        // Auto-start background music after user interaction
        document.addEventListener('click', function startMusicOnFirstClick() {
            if (window.audioManager && !window.audioManager.isInitialized) {
                setTimeout(() => {
                    window.audioManager.playMusic();
                }, 1000);
            }
            document.removeEventListener('click', startMusicOnFirstClick);
        }, { once: true });
    </script>

    <!-- Scripts - Load in correct order for proper initialization -->
    <script src="assets/js/loading-manager.js"></script>
    <script src="assets/js/data-manager.js"></script>
    <script src="assets/js/settings-manager.js"></script>
    <script src="assets/js/audio-manager.js"></script>
    <script src="assets/js/navigation.js"></script>
    <script src="assets/js/parallax-cursor.js"></script>
    <script src="assets/js/menu-manager.js"></script>
    <script src="assets/js/app-integration.js"></script>
    <script src="assets/js/main-menu.js"></script>
</body>
</html>