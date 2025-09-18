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
        /* Mobile-First Characters Page Styles */
        .characters-container {
            max-width: 100%;
            margin: 0 auto;
            padding: var(--spacing-md);
            min-height: 100vh;
        }
        
        .page-header {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(var(--blur-md));
            border-radius: var(--radius-xl);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
            text-align: center;
            transition: var(--transition-normal);
        }
        
        .page-header:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }
        
        .page-title {
            color: var(--color5);
            font-size: 2rem;
            margin-bottom: var(--spacing-sm);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-subtitle {
            color: var(--color4);
            font-size: 1rem;
        }
        
        .characters-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }
        
        .character-card {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-lg);
            transition: var(--transition-normal);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .character-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }
        
        .character-card.locked {
            opacity: 0.6;
            filter: grayscale(0.5);
        }
        
        .character-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }
        
        .character-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--glass-border);
            object-fit: cover;
            transition: var(--transition-normal);
        }
        
        .character-card:hover .character-avatar {
            border-color: var(--color3);
            box-shadow: 0 0 20px rgba(123, 159, 255, 0.3);
        }
        
        .character-info {
            flex: 1;
        }
        
        .character-name {
            color: var(--color5);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .character-role {
            color: var(--color4);
            font-size: 0.9rem;
            margin-bottom: var(--spacing-xs);
        }
        
        .character-status {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            font-size: 0.8rem;
        }
        
        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent-green);
        }
        
        .status-indicator.offline {
            background: var(--neutral-400);
        }
        
        .affinity-section {
            margin-bottom: var(--spacing-md);
        }
        
        .affinity-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xs);
        }
        
        .affinity-text {
            color: var(--color4);
            font-size: 0.9rem;
        }
        
        .affinity-value {
            color: var(--color3);
            font-weight: 600;
        }
        
        .affinity-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }
        
        .affinity-fill {
            height: 100%;
            background: var(--gradient-secondary);
            border-radius: 4px;
            transition: width 0.8s ease;
            position: relative;
        }
        
        .affinity-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .route-progress {
            margin-bottom: var(--spacing-md);
        }
        
        .progress-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-xs) 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .progress-item:last-child {
            border-bottom: none;
        }
        
        .progress-label {
            color: var(--color4);
            font-size: 0.8rem;
        }
        
        .progress-badge {
            background: var(--gradient-secondary);
            color: var(--color5);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        .progress-badge.locked {
            background: var(--neutral-600);
        }
        
        .character-actions {
            display: flex;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-md);
        }
        
        .action-btn {
            flex: 1;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--color4);
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            font-size: 0.8rem;
            transition: var(--transition-normal);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xs);
        }
        
        .action-btn:hover {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
            transform: translateY(-1px);
        }
        
        .action-btn.primary {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
        }
        
        .unlock-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-xl);
            opacity: 0;
            transition: var(--transition-normal);
        }
        
        .character-card.locked:hover .unlock-overlay {
            opacity: 1;
        }
        
        .unlock-text {
            color: var(--color5);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: var(--spacing-sm);
        }
        
        .unlock-cost {
            color: var(--color3);
            font-size: 0.9rem;
            margin-bottom: var(--spacing-md);
        }
        
        .unlock-btn {
            background: var(--gradient-primary);
            border: none;
            color: var(--color5);
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-normal);
        }
        
        .unlock-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }
        
        /* Tablet and Desktop */
        @media (min-width: 768px) {
            .characters-container {
                max-width: 1200px;
                padding: var(--spacing-lg);
            }
            
            .characters-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: var(--spacing-xl);
            }
            
            .page-title {
                font-size: 2.5rem;
            }
            
            .character-avatar {
                width: 100px;
                height: 100px;
            }
            
            .character-name {
                font-size: 1.6rem;
            }
        }
        
        /* Cursor Parallax Layers */
        .parallax-layer {
            position: absolute;
            pointer-events: none;
            will-change: transform;
            transition: transform .08s linear;
        }
        
        .parallax-layer:nth-child(1) {
            background: radial-gradient(circle at 20% 80%, rgba(123, 159, 255, 0.1) 0%, transparent 50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            top: 10%;
            left: 10%;
        }
        
        .parallax-layer:nth-child(2) {
            background: radial-gradient(circle at 80% 20%, rgba(132, 21, 103, 0.1) 0%, transparent 50%);
            width: 150px;
            height: 150px;
            border-radius: 50%;
            top: 60%;
            right: 10%;
        }
        
        .parallax-layer:nth-child(3) {
            background: radial-gradient(circle at 50% 50%, rgba(235, 199, 255, 0.05) 0%, transparent 50%);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <!-- Ana menü temasıyla uyumlu background -->
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <!-- Cursor Parallax Layers -->
    <div class="parallax-layer" data-speed="0.02"></div>
    <div class="parallax-layer" data-speed="0.04"></div>
    <div class="parallax-layer" data-speed="0.06"></div>
    
    <main class="main-container">
        <div id="ajax-content" class="content-container">
            <div class="characters-container">


                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">👥 Karakterler</h1>
                    <p class="page-subtitle">Neural Network'teki arkadaşlarınla bağ kur</p>
                </div>

                <!-- Characters Grid -->
                <div class="characters-grid" id="characters-grid">
                    <!-- Characters will be loaded here -->
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="assets/js/loading-manager.js"></script>
    <script src="assets/js/data-manager.js"></script>
    <script src="assets/js/settings-manager.js"></script>
    <script src="assets/js/audio-manager.js"></script>
    <script src="assets/js/navigation.js"></script>
    <script src="assets/js/parallax-cursor.js"></script>
    <script src="assets/js/app-integration.js"></script>

    <script>
        // Characters Mobile Controller
        class CharactersMobileController {
            constructor() {
                this.characters = [
                    {
                        id: 'leo',
                        name: 'Leo',
                        role: 'The Strategist',
                        avatar: 'assets/images/characters/leo-portrait.png',
                        affinity: 75,
                        status: 'online',
                        unlocked: true,
                        routes: {
                            friendship: 'completed',
                            romance: 'in-progress',
                            special: 'locked'
                        },
                        description: 'Tactical genius with a mysterious past'
                    },
                    {
                        id: 'chloe',
                        name: 'Chloe',
                        role: 'The Hacker',
                        avatar: 'assets/images/characters/chloe-portrait.png',
                        affinity: 60,
                        status: 'online',
                        unlocked: true,
                        routes: {
                            friendship: 'completed',
                            romance: 'available',
                            special: 'locked'
                        },
                        description: 'Brilliant hacker with a rebellious spirit'
                    },
                    {
                        id: 'felix',
                        name: 'Felix',
                        role: 'The Heart',
                        avatar: 'assets/images/characters/felix-portrait.png',
                        affinity: 45,
                        status: 'online',
                        unlocked: true,
                        routes: {
                            friendship: 'in-progress',
                            romance: 'available',
                            special: 'locked'
                        },
                        description: 'Empathetic soul who brings warmth to everyone'
                    },
                    {
                        id: 'elara',
                        name: 'Elara',
                        role: 'The Mentor',
                        avatar: 'assets/images/characters/elara-portrait.png',
                        affinity: 30,
                        status: 'offline',
                        unlocked: false,
                        unlockCost: 150,
                        routes: {
                            friendship: 'locked',
                            romance: 'locked',
                            special: 'locked'
                        },
                        description: 'Wise mentor with ancient knowledge'
                    }
                ];

                this.init();
            }

            init() {
                console.log('👥 Characters Mobile Controller Initializing...');
                this.renderCharacters();
                this.setupEventListeners();
                this.startAffinityAnimations();
                console.log('✅ Characters Mobile Controller Ready!');
            }

            renderCharacters() {
                const grid = document.getElementById('characters-grid');
                grid.innerHTML = '';

                this.characters.forEach(character => {
                    const card = this.createCharacterCard(character);
                    grid.appendChild(card);
                });
            }

            createCharacterCard(character) {
                const card = document.createElement('div');
                card.className = `character-card ${!character.unlocked ? 'locked' : ''}`;
                card.dataset.characterId = character.id;

                const routeItems = Object.entries(character.routes).map(([route, status]) => {
                    const statusText = {
                        'completed': 'Tamamlandı',
                        'in-progress': 'Devam Ediyor',
                        'available': 'Mevcut',
                        'locked': 'Kilitli'
                    }[status];

                    return `
                        <div class="progress-item">
                            <span class="progress-label">${route === 'friendship' ? 'Arkadaşlık' : route === 'romance' ? 'Romantik' : 'Özel'}</span>
                            <span class="progress-badge ${status === 'locked' ? 'locked' : ''}">${statusText}</span>
                        </div>
                    `;
                }).join('');

                card.innerHTML = `
                    <div class="character-header">
                        <img src="${character.avatar}" alt="${character.name}" class="character-avatar"
                             onerror="this.src='assets/images/characters/leo-portrait.png'">
                        <div class="character-info">
                            <h3 class="character-name">${character.name}</h3>
                            <p class="character-role">${character.role}</p>
                            <div class="character-status">
                                <div class="status-indicator ${character.status}"></div>
                                <span>${character.status === 'online' ? 'Çevrimiçi' : 'Çevrimdışı'}</span>
                            </div>
                        </div>
                    </div>

                    <div class="affinity-section">
                        <div class="affinity-label">
                            <span class="affinity-text">İlişki Seviyesi</span>
                            <span class="affinity-value">${character.affinity}%</span>
                        </div>
                        <div class="affinity-bar">
                            <div class="affinity-fill" style="width: ${character.affinity}%"></div>
                        </div>
                    </div>

                    <div class="route-progress">
                        ${routeItems}
                    </div>

                    <div class="character-actions">
                        <button class="action-btn primary" onclick="charactersController.openChat('${character.id}')">
                            💬 Sohbet
                        </button>
                        <button class="action-btn" onclick="charactersController.viewProfile('${character.id}')">
                            👤 Profil
                        </button>
                        <button class="action-btn" onclick="charactersController.giveGift('${character.id}')">
                            🎁 Hediye
                        </button>
                    </div>

                    ${!character.unlocked ? `
                        <div class="unlock-overlay">
                            <div class="unlock-text">🔒 Karakter Kilitli</div>
                            <div class="unlock-cost">${character.unlockCost} Neural Fragment</div>
                            <button class="unlock-btn" onclick="charactersController.unlockCharacter('${character.id}')">
                                Kilidi Aç
                            </button>
                        </div>
                    ` : ''}
                `;

                return card;
            }

            setupEventListeners() {
                // Character card clicks
                document.addEventListener('click', (e) => {
                    const card = e.target.closest('.character-card');
                    if (card && !e.target.closest('.action-btn, .unlock-btn')) {
                        const characterId = card.dataset.characterId;
                        this.viewProfile(characterId);
                    }
                });
            }

            startAffinityAnimations() {
                // Animate affinity bars on load
                setTimeout(() => {
                    const fills = document.querySelectorAll('.affinity-fill');
                    fills.forEach(fill => {
                        const width = fill.style.width;
                        fill.style.width = '0%';
                        setTimeout(() => {
                            fill.style.width = width;
                        }, 100);
                    });
                }, 500);
            }

            openChat(characterId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                // Simulate chat opening
                this.showNotification(`${this.getCharacterName(characterId)} ile sohbet başlatılıyor...`, 'info');

                // In real app, navigate to chat
                setTimeout(() => {
                    alert(`${this.getCharacterName(characterId)} ile sohbet özelliği yakında eklenecek!`);
                }, 1000);
            }

            viewProfile(characterId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                // Navigate to character profile
                window.location.href = `character-${characterId}.php`;
            }

            giveGift(characterId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                this.showNotification(`${this.getCharacterName(characterId)} için hediye seçiliyor...`, 'info');

                setTimeout(() => {
                    alert('Hediye sistemi yakında eklenecek!');
                }, 1000);
            }

            unlockCharacter(characterId) {
                const character = this.characters.find(c => c.id === characterId);
                if (!character) return;

                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                // Simulate unlock process
                this.showNotification(`${character.name} kilidi açılıyor...`, 'info');

                setTimeout(() => {
                    // In real app, check resources and unlock
                    character.unlocked = true;
                    this.renderCharacters();
                    this.showNotification(`${character.name} başarıyla açıldı!`, 'success');
                }, 1500);
            }

            getCharacterName(characterId) {
                const character = this.characters.find(c => c.id === characterId);
                return character ? character.name : 'Karakter';
            }

            showNotification(message, type = 'info') {
                // Create notification
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;
                notification.textContent = message;
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
                    max-width: 300px;
                    font-size: 0.9rem;
                `;

                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.style.opacity = '1';
                    notification.style.transform = 'translateX(0)';
                }, 10);

                // Remove after 3 seconds
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

        // Initialize Characters Controller
        let charactersController;
        document.addEventListener('DOMContentLoaded', async () => {
            // Wait for app initialization
            if (window.waitForApp) {
                await window.waitForApp();
            }

            charactersController = new CharactersMobileController();
        });
    </script>
</body>
</html>
