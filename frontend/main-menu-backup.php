<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();

// Check if user has a character profile
$stmt = $pdo->prepare("SELECT * FROM character_profiles WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$_SESSION['user_id']]);
$character_profile = $stmt->fetch();

$has_profile = !empty($character_profile);

// If user doesn't have a profile, redirect to profile creation
if (!$has_profile) {
    redirect('/profile-creation.php');
}

// Fetch character data for the submenu
$characters = [
    [
        'id' => 1,
        'name' => 'Leo',
        'role' => 'Strategist',
        'avatar' => '🦁',
        'affinity' => 75,
        'status' => 'online'
    ],
    [
        'id' => 2,
        'name' => 'Chloe',
        'role' => 'Hacker',
        'avatar' => '🕵️',
        'affinity' => 60,
        'status' => 'away'
    ],
    [
        'id' => 3,
        'name' => 'Felix',
        'role' => 'Heart',
        'avatar' => '💖',
        'affinity' => 90,
        'status' => 'online'
    ],
    [
        'id' => 4,
        'name' => 'Elara',
        'role' => 'Mentor',
        'avatar' => '🌟',
        'affinity' => 45,
        'status' => 'offline'
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
    <link rel="stylesheet" href="assets/css/style.css">
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
                </div>
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-icon">💎</span>
                        <span class="stat-value">1250</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">💙</span>
                        <span class="stat-value">89</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">📊</span>
                        <span class="stat-value">456</span>
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
                <!-- Chat & Stories with Submenu -->
                <div class="menu-card expandable" onclick="toggleSubmenu('chat-submenu')">
                    <div class="card-content">
                        <div class="card-icon">📱</div>
                        <div class="card-info">
                            <h3 class="card-title">Chat & Hikayeler</h3>
                            <p class="card-description">Ana chat odası ve özel sohbetler. Karakterlerle etkileşime geçin.</p>
                        </div>
                        <div class="card-badge">3</div>
                    </div>
                    
                    <!-- Submenu for Chat & Stories -->
                    <div class="submenu-container" id="chat-submenu">
                        <div class="submenu-item" onclick="loadContent('main-chatroom'); event.stopPropagation();">
                            <div class="submenu-icon">💬</div>
                            <div class="submenu-content">
                                <h4 class="submenu-title">Ana Chat Odası</h4>
                                <p class="submenu-description">Genel sohbet ve etkinlikler</p>
                            </div>
                            <div class="submenu-badge">3</div>
                        </div>
                        
                        <div class="submenu-item" onclick="loadContent('private-chat'); event.stopPropagation();">
                            <div class="submenu-icon">🔒</div>
                            <div class="submenu-content">
                                <h4 class="submenu-title">Özel Chat Odaları</h4>
                                <p class="submenu-description">Karakterlerle özel sohbetler</p>
                            </div>
                            <div class="submenu-badge">12</div>
                        </div>
                        
                        <div class="submenu-item" onclick="loadContent('story-history'); event.stopPropagation();">
                            <div class="submenu-icon">📦</div>
                            <div class="submenu-content">
                                <h4 class="submenu-title">Geçmiş Sohbetler</h4>
                                <p class="submenu-description">Önceki konuşmaları görüntüle</p>
                            </div>
                        </div>
                        
                        <div class="submenu-item" onclick="loadContent('story-mode'); event.stopPropagation();">
                            <div class="submenu-icon">📖</div>
                            <div class="submenu-content">
                                <h4 class="submenu-title">Hikaye Modu</h4>
                                <p class="submenu-description">Ana hikaye progression</p>
                            </div>
                            <div class="submenu-badge special">Yeni</div>
                        </div>
                        
                        <div class="submenu-item" onclick="loadContent('character-routes'); event.stopPropagation();">
                            <div class="submenu-icon">👥</div>
                            <div class="submenu-content">
                                <h4 class="submenu-title">Karakter Rotaları</h4>
                                <p class="submenu-description">4 karakter individual story paths</p>
                            </div>
                            <div class="submenu-badge">4</div>
                        </div>
                        
                        <div class="submenu-item" onclick="loadContent('call-history'); event.stopPropagation();">
                            <div class="submenu-icon">📞</div>
                            <div class="submenu-content">
                                <h4 class="submenu-title">Telefon Aramaları</h4>
                                <p class="submenu-description">Missed calls ve call history</p>
                            </div>
                            <div class="submenu-badge">5</div>
                        </div>
                    </div>
                </div>
                
                <!-- Characters with Submenu -->
                <div class="menu-card expandable" onclick="toggleSubmenu('characters-submenu')">
                    <div class="card-content">
                        <div class="card-icon">👥</div>
                        <div class="card-info">
                            <h3 class="card-title">Karakterler</h3>
                            <p class="card-description">Leo, Chloe, Felix ve Elara ile ilişkilerinizi geliştirin.</p>
                        </div>
                        <div class="card-badge">4</div>
                    </div>
                    
                    <!-- Submenu for Characters -->
                    <div class="submenu-container" id="characters-submenu">
                        <?php foreach ($characters as $character): ?>
                        <div class="submenu-item" onclick="showCharacterDetails(<?php echo $character['id']; ?>); event.stopPropagation();">
                            <div class="submenu-icon"><?php echo $character['avatar']; ?></div>
                            <div class="submenu-content">
                                <h4 class="submenu-title"><?php echo $character['name']; ?></h4>
                                <p class="submenu-description"><?php echo $character['role']; ?></p>
                                <div class="character-progress">
                                    <div class="character-progress-bar" style="width: <?php echo $character['affinity']; ?>%"></div>
                                </div>
                            </div>
                            <div class="submenu-badge"><?php echo $character['affinity']; ?>%</div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Collection -->
                <div class="menu-card" onclick="loadContent('collection')">
                    <div class="card-content">
                        <div class="card-icon">📚</div>
                        <div class="card-info">
                            <h3 class="card-title">Koleksiyon</h3>
                            <p class="card-description">CG galerisi, ses kayıtları ve bonus hikayeleri.</p>
                        </div>
                        <div class="card-badge">12</div>
                    </div>
                </div>
                
                <!-- Events -->
                <div class="menu-card" onclick="showNotification('Etkinlikler yakında!')">
                    <div class="card-content">
                        <div class="card-icon">⚡</div>
                        <div class="card-info">
                            <h3 class="card-title">Etkinlikler</h3>
                            <p class="card-description">Günlük rutinler ve özel etkinlikler.</p>
                        </div>
                        <div class="card-badge">2</div>
                    </div>
                </div>
                
                <!-- Premium -->
                <div class="menu-card" onclick="showNotification('Premium özellikleri yakında!')">
                    <div class="card-content">
                        <div class="card-icon">👑</div>
                        <div class="card-info">
                            <h3 class="card-title">Premium</h3>
                            <p class="card-description">Neural Fragment paketleri ve VIP üyelik.</p>
                        </div>
                        <div class="card-badge special">VIP</div>
                    </div>
                </div>
                
                <!-- Settings -->
                <div class="menu-card" onclick="loadContent('settings')" oncontextmenu="handleLogout(); return false;">
                    <div class="card-content">
                        <div class="card-icon">⚙️</div>
                        <div class="card-info">
                            <h3 class="card-title">Ayarlar</h3>
                            <p class="card-description">Bildirimler, ses, görsel ve hesap yönetimi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="floating-particles"></div>
    </main>
    
    <script>
        // Toggle submenu function
        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const isExpanded = submenu.classList.contains('open');
            
            // Close all other submenus
            document.querySelectorAll('.submenu-container').forEach(menu => {
                if (menu.id !== submenuId) {
                    menu.classList.remove('open');
                }
            });
            
            // Toggle current submenu
            if (isExpanded) {
                submenu.classList.remove('open');
            } else {
                submenu.classList.add('open');
            }
        }
        
        // AJAX Content Loading
        function loadContent(page) {
            showLoadingSpinner();
            
            fetch(`${page}.php`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    // Extract content from the response
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('.content-container') || doc.querySelector('main');
                    
                    if (newContent) {
                        const ajaxContent = document.getElementById('ajax-content');
                        ajaxContent.style.opacity = '0';
                        ajaxContent.style.transform = 'translateY(20px)';
                        
                        setTimeout(() => {
                            ajaxContent.innerHTML = newContent.innerHTML;
                            ajaxContent.style.opacity = '1';
                            ajaxContent.style.transform = 'translateY(0)';
                            
                            // Add back button if not main menu
                            if (page !== 'main-menu') {
                                addBackButton();
                            }
                            
                            // Initialize page-specific functionality
                            initializePageFeatures(page);
                            
                            hideLoadingSpinner();
                        }, 300);
                    } else {
                        throw new Error('Content not found in response');
                    }
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                    hideLoadingSpinner();
                    showNotification('İçerik yüklenirken hata oluştu!');
                });
        }
        
        function addBackButton() {
            const content = document.getElementById('ajax-content');
            const backButton = document.createElement('div');
            backButton.className = 'ajax-back-button';
            backButton.innerHTML = `
                <button onclick="loadMainMenu()" class="btn">
                    <span class="back-icon">←</span>
                    <span>Ana Menü</span>
                </button>
            `;
            content.insertBefore(backButton, content.firstChild);
        }
        
        function loadMainMenu() {
            const ajaxContent = document.getElementById('ajax-content');
            
            ajaxContent.style.opacity = '0';
            ajaxContent.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                // Reload the entire page to ensure all data is fresh
                location.reload();
            }, 300);
        }
        
        function initializePageFeatures(page) {
            switch(page) {
                case 'characters':
                    initializeCharacterCards();
                    break;
                case 'collection':
                    initializeCollectionCards();
                    break;
                case 'story-mode':
                    initializeStoryMode();
                    break;
                case 'settings':
                    initializeSettings();
                    break;
            }
        }
        
        function initializeCharacterCards() {
            document.querySelectorAll('.character-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        }
        
        function initializeCollectionCards() {
            document.querySelectorAll('.glass-card, .event-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        }
        
        function initializeStoryMode() {
            // Story mode specific initialization
            console.log('Story mode initialized');
        }
        
        function initializeSettings() {
            showNotification('Ayarlar sayfası yakında hazır olacak!');
        }
        
        function showCharacterDetails(characterId) {
            showNotification('Karakter detayları yakında!');
        }
        
        function showLoadingSpinner() {
            const spinner = document.createElement('div');
            spinner.id = 'loading-spinner';
            spinner.innerHTML = `
                <div class="loading-container">
                    <div class="loading-spinner"></div>
                    <p>Yükleniyor...</p>
                </div>
            `;
            spinner.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(10px);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                color: white;
            `;
            document.body.appendChild(spinner);
        }
        
        function hideLoadingSpinner() {
            const spinner = document.getElementById('loading-spinner');
            if (spinner) {
                document.body.removeChild(spinner);
            }
        }
        
        // Create floating particles
        function createFloatingParticles() {
            const container = document.querySelector('.floating-particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (Math.random() * 20 + 10) + 's';
                container.appendChild(particle);
            }
        }
        
        // Create starfield
        function createStarfield() {
            const starfield = document.querySelector('.starfield');
            const starCount = 100;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 3 + 's';
                starfield.appendChild(star);
            }
        }
        
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <div class="notification-content">
                    <div class="notification-icon">✨</div>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        function handleLogout() {
            const confirmation = document.createElement('div');
            confirmation.className = 'confirmation-modal';
            confirmation.innerHTML = `
                <div class="confirmation-content">
                    <h3>Çıkış Yapmak İstiyor Musun?</h3>
                    <p>Oyundaki ilerleme kaydedilecek</p>
                    <div class="confirmation-buttons">
                        <button class="btn-secondary" onclick="closeConfirmation()">İptal</button>
                        <button class="btn" onclick="window.location.href='../index.php'">Çıkış Yap</button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(confirmation);
            setTimeout(() => confirmation.classList.add('show'), 100);
        }
        
        function closeConfirmation() {
            const confirmation = document.querySelector('.confirmation-modal');
            confirmation.classList.remove('show');
            setTimeout(() => document.body.removeChild(confirmation), 300);
        }
        
        // Initialize everything
        document.addEventListener('DOMContentLoaded', function() {
            createFloatingParticles();
            createStarfield();
            
            // Add smooth transitions to ajax content
            const ajaxContent = document.getElementById('ajax-content');
            ajaxContent.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        });
    </script>
</body>
</html>