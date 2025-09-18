<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakterler - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        /* Ensure Montserrat font usage */
        * {
            font-family: 'Montserrat', sans-serif !important;
        }

        /* Mobile-first character page styles */
        .characters-container {
            padding: var(--spacing-lg);
            max-width: 1200px;
            margin: 0 auto;
        }

        .characters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .character-card {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-lg);
            transition: var(--transition-normal);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .character-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }

        .character-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gradient-secondary);
            margin: 0 auto var(--spacing-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            position: relative;
        }

        .character-info h3 {
            color: var(--color5);
            font-size: 1.2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: var(--spacing-sm);
            font-family: 'Montserrat', sans-serif;
        }

        .character-role {
            color: var(--color4);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: var(--spacing-md);
            font-family: 'Montserrat', sans-serif;
        }

        .character-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: var(--spacing-md);
        }

        .stat-item {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            color: var(--color5);
            font-size: 1.1rem;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
        }

        .stat-label {
            color: var(--color4);
            font-size: 0.7rem;
            font-family: 'Montserrat', sans-serif;
        }

        .character-actions {
            display: flex;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-md);
        }

        .btn-character {
            flex: 1;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            border: none;
            background: var(--gradient-secondary);
            color: var(--color5);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-normal);
            font-family: 'Montserrat', sans-serif;
        }

        .btn-character:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .filter-section {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .filter-controls {
            display: flex;
            gap: var(--spacing-md);
            flex-wrap: wrap;
            align-items: center;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.05);
            color: var(--color5);
            font-family: 'Montserrat', sans-serif;
        }

        .search-input::placeholder {
            color: var(--color4);
        }

        .filter-select {
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.05);
            color: var(--color5);
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 768px) {
            .characters-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
            }

            .filter-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>

    <main class="main-container">
        <div id="ajax-content" class="content-container">


            <div class="characters-container">

                <!-- Page Header -->
                <div class="page-header" style="text-align: center; margin-bottom: var(--spacing-lg);">
                    <h1 style="color: var(--color5); font-size: 2rem; font-weight: 800; margin-bottom: var(--spacing-sm); font-family: 'Montserrat', sans-serif;">👥 Karakterler</h1>
                    <p style="color: var(--color4); font-size: 1rem; font-family: 'Montserrat', sans-serif;">Tüm karakterlere göz atın ve detaylarını keşfedin</p>
                </div>

                <!-- Filter/Search Section -->
                <div class="filter-section">
                    <div class="filter-controls">
                        <input type="text" class="search-input" placeholder="Karakter ara..." id="searchInput">
                        <select class="filter-select" id="roleFilter">
                            <option value="">Tüm Roller</option>
                            <option value="strategist">Stratejist</option>
                            <option value="hacker">Hacker</option>
                            <option value="heart">Kalp</option>
                            <option value="mentor">Mentor</option>
                        </select>
                        <button class="btn-character" onclick="clearFilters()">🗑️ Temizle</button>
                        <button class="btn-character" onclick="applyFilters()">🔍 Filtrele</button>
                    </div>
                </div>

                <!-- Characters Grid -->
                <div class="characters-grid" id="charactersGrid">
                    <!-- Leo -->
                    <div class="character-card" data-character="leo" data-role="strategist" onclick="openCharacterProfile('leo')">
                        <div class="character-avatar">⚔️</div>
                        <div class="character-info">
                            <h3>Leo</h3>
                            <p class="character-role">The Strategist</p>
                            <div class="character-stats">
                                <div class="stat-item">
                                    <div class="stat-value">12</div>
                                    <div class="stat-label">Seviye</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">45%</div>
                                    <div class="stat-label">İlişki</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">8</div>
                                    <div class="stat-label">Mesaj</div>
                                </div>
                            </div>
                            <div class="character-actions">
                                <button class="btn-character" onclick="event.stopPropagation(); startChat('leo')">💬 Sohbet</button>
                                <button class="btn-character" onclick="event.stopPropagation(); viewProfile('leo')">👤 Profil</button>
                            </div>
                        </div>
                    </div>

                    <!-- Chloe -->
                    <div class="character-card" data-character="chloe" data-role="hacker" onclick="openCharacterProfile('chloe')">
                        <div class="character-avatar">💻</div>
                        <div class="character-info">
                            <h3>Chloe</h3>
                            <p class="character-role">The Hacker</p>
                            <div class="character-stats">
                                <div class="stat-item">
                                    <div class="stat-value">18</div>
                                    <div class="stat-label">Seviye</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">78%</div>
                                    <div class="stat-label">İlişki</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">15</div>
                                    <div class="stat-label">Mesaj</div>
                                </div>
                            </div>
                            <div class="character-actions">
                                <button class="btn-character" onclick="event.stopPropagation(); startChat('chloe')">💬 Sohbet</button>
                                <button class="btn-character" onclick="event.stopPropagation(); viewProfile('chloe')">👤 Profil</button>
                            </div>
                        </div>
                    </div>

                    <!-- Felix -->
                    <div class="character-card" data-character="felix" data-role="heart" onclick="openCharacterProfile('felix')">
                        <div class="character-avatar">😊</div>
                        <div class="character-info">
                            <h3>Felix</h3>
                            <p class="character-role">The Heart</p>
                            <div class="character-stats">
                                <div class="stat-item">
                                    <div class="stat-value">14</div>
                                    <div class="stat-label">Seviye</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">62%</div>
                                    <div class="stat-label">İlişki</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">12</div>
                                    <div class="stat-label">Mesaj</div>
                                </div>
                            </div>
                            <div class="character-actions">
                                <button class="btn-character" onclick="event.stopPropagation(); startChat('felix')">💬 Sohbet</button>
                                <button class="btn-character" onclick="event.stopPropagation(); viewProfile('felix')">👤 Profil</button>
                            </div>
                        </div>
                    </div>

                    <!-- Elara -->
                    <div class="character-card" data-character="elara" data-role="mentor" onclick="openCharacterProfile('elara')">
                        <div class="character-avatar">🌟</div>
                        <div class="character-info">
                            <h3>Elara</h3>
                            <p class="character-role">The Mentor</p>
                            <div class="character-stats">
                                <div class="stat-item">
                                    <div class="stat-value">20</div>
                                    <div class="stat-label">Seviye</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">85%</div>
                                    <div class="stat-label">İlişki</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">25</div>
                                    <div class="stat-label">Mesaj</div>
                                </div>
                            </div>
                            <div class="character-actions">
                                <button class="btn-character" onclick="event.stopPropagation(); startChat('elara')">💬 Sohbet</button>
                                <button class="btn-character" onclick="event.stopPropagation(); viewProfile('elara')">👤 Profil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-between mt-4">
            <button class="btn btn-secondary" onclick="showNotification('İstatistikler yakında!')">
                📊 İstatistikler
            </button>
            <button class="btn btn-primary" onclick="showNotification('Toplu mesaj yakında!')">
                💬 Hepsine Mesaj
            </button>
        </div>
    </div>

    <script>
        // Characters Mobile Controller
        class CharactersController {
            constructor() {
                this.characters = [
                    { id: 'leo', name: 'Leo', role: 'strategist', level: 12, affinity: 45, messages: 8, emoji: '⚔️' },
                    { id: 'chloe', name: 'Chloe', role: 'hacker', level: 18, affinity: 78, messages: 15, emoji: '💻' },
                    { id: 'felix', name: 'Felix', role: 'heart', level: 14, affinity: 62, messages: 12, emoji: '😊' },
                    { id: 'elara', name: 'Elara', role: 'mentor', level: 20, affinity: 85, messages: 25, emoji: '🌟' }
                ];
                this.init();
            }

            init() {
                console.log('👥 Characters Controller Initializing...');
                this.createStarfield();
                this.setupEventListeners();
                console.log('✅ Characters Controller Ready!');
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

            setupEventListeners() {
                // Real-time search
                const searchInput = document.getElementById('searchInput');
                if (searchInput) {
                    searchInput.addEventListener('input', () => this.applyFilters());
                }

                // Role filter
                const roleFilter = document.getElementById('roleFilter');
                if (roleFilter) {
                    roleFilter.addEventListener('change', () => this.applyFilters());
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

            clearFilters() {
                document.getElementById('searchInput').value = '';
                document.getElementById('roleFilter').value = '';
                this.showAllCharacters();
            }

            applyFilters() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const roleFilter = document.getElementById('roleFilter').value;
                const cards = document.querySelectorAll('.character-card');

                cards.forEach(card => {
                    const characterName = card.querySelector('h3').textContent.toLowerCase();
                    const characterRole = card.dataset.role;

                    const matchesSearch = characterName.includes(searchTerm);
                    const matchesRole = !roleFilter || characterRole === roleFilter;

                    if (matchesSearch && matchesRole) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.3s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            showAllCharacters() {
                const cards = document.querySelectorAll('.character-card');
                cards.forEach(card => {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.3s ease';
                });
            }

            // AJAX character profile loading
            async loadCharacterProfile(characterId) {
                try {
                    this.showNotification(`${characterId} profili yükleniyor...`);

                    // Simulate AJAX call
                    await new Promise(resolve => setTimeout(resolve, 1000));

                    // Redirect to character page
                    window.location.href = `character-${characterId}.php`;
                } catch (error) {
                    this.showNotification('Profil yüklenirken hata oluştu!');
                }
            }

            // AJAX chat initialization
            async startChat(characterId) {
                try {
                    this.showNotification(`${characterId} ile sohbet başlatılıyor...`);

                    // Simulate AJAX call
                    await new Promise(resolve => setTimeout(resolve, 800));

                    this.showNotification(`${characterId} ile sohbet yakında!`);
                } catch (error) {
                    this.showNotification('Sohbet başlatılırken hata oluştu!');
                }
            }
        }

        // Global functions for onclick events
        function openCharacterProfile(characterId) {
            charactersController.loadCharacterProfile(characterId);
        }

        function startChat(characterId) {
            charactersController.startChat(characterId);
        }

        function viewProfile(characterId) {
            charactersController.loadCharacterProfile(characterId);
        }

        function clearFilters() {
            charactersController.clearFilters();
        }

        function applyFilters() {
            charactersController.applyFilters();
        }

        // Initialize
        let charactersController;
        document.addEventListener('DOMContentLoaded', function() {
            charactersController = new CharactersController();
        });
    </script>

</body>
</html>