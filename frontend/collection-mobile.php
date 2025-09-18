<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksiyon - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        /* Mobile-First Collection Styles */
        .collection-container {
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
        
        .collection-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }
        
        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-md);
            text-align: center;
            transition: var(--transition-normal);
        }
        
        .stat-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }
        
        .stat-icon {
            font-size: 2rem;
            margin-bottom: var(--spacing-xs);
        }
        
        .stat-value {
            color: var(--color5);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: var(--spacing-xs);
        }
        
        .stat-label {
            color: var(--color4);
            font-size: 0.8rem;
        }
        
        .collection-tabs {
            display: flex;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xs);
            margin-bottom: var(--spacing-lg);
            overflow-x: auto;
        }
        
        .collection-tab {
            flex: 1;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            background: transparent;
            border: none;
            color: var(--color4);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition-normal);
            white-space: nowrap;
        }
        
        .collection-tab.active {
            background: var(--gradient-secondary);
            color: var(--color5);
        }
        
        .collection-tab:hover:not(.active) {
            background: rgba(255, 255, 255, 0.05);
            color: var(--color5);
        }
        
        .collection-content {
            display: none;
        }
        
        .collection-content.active {
            display: block;
        }
        
        .collection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }
        
        .collection-item {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-sm);
            transition: var(--transition-normal);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            aspect-ratio: 3/4;
        }
        
        .collection-item:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }
        
        .collection-item.locked {
            opacity: 0.4;
            filter: grayscale(1);
        }
        
        .collection-item.new {
            border: 2px solid var(--color3);
            box-shadow: 0 0 20px rgba(123, 159, 255, 0.3);
        }
        
        .collection-item.new::after {
            content: 'YENİ';
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--gradient-secondary);
            color: var(--color5);
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 0.6rem;
            font-weight: 700;
        }
        
        .item-image {
            width: 100%;
            height: 70%;
            background: var(--gradient-secondary);
            border-radius: var(--radius-md);
            margin-bottom: var(--spacing-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-md);
        }
        
        .item-info {
            text-align: center;
        }
        
        .item-title {
            color: var(--color5);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .item-rarity {
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .item-rarity.common {
            background: rgba(156, 163, 175, 0.3);
            color: var(--neutral-300);
        }
        
        .item-rarity.rare {
            background: rgba(59, 130, 246, 0.3);
            color: var(--color3);
        }
        
        .item-rarity.epic {
            background: rgba(147, 51, 234, 0.3);
            color: var(--color4);
        }
        
        .item-rarity.legendary {
            background: rgba(245, 158, 11, 0.3);
            color: var(--accent-gold);
        }
        
        .lock-overlay {
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
        
        .collection-item.locked:hover .lock-overlay {
            opacity: 1;
        }
        
        .lock-icon {
            font-size: 2rem;
            margin-bottom: var(--spacing-sm);
        }
        
        .lock-text {
            color: var(--color5);
            font-size: 0.8rem;
            text-align: center;
            padding: 0 var(--spacing-sm);
        }
        
        .filter-bar {
            display: flex;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-lg);
            flex-wrap: wrap;
        }
        
        .filter-btn {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--color4);
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--radius-md);
            font-size: 0.8rem;
            cursor: pointer;
            transition: var(--transition-normal);
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
        }
        
        .achievement-item {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-md);
            transition: var(--transition-normal);
            cursor: pointer;
        }
        
        .achievement-item:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }
        
        .achievement-item.completed {
            border-color: var(--accent-green);
            background: rgba(76, 175, 80, 0.1);
        }
        
        .achievement-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-sm);
        }
        
        .achievement-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .achievement-info {
            flex: 1;
        }
        
        .achievement-title {
            color: var(--color5);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .achievement-description {
            color: var(--color4);
            font-size: 0.8rem;
            line-height: 1.4;
        }
        
        .achievement-progress {
            margin-top: var(--spacing-sm);
        }
        
        .progress-bar {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: var(--spacing-xs);
        }
        
        .progress-fill {
            height: 100%;
            background: var(--gradient-secondary);
            border-radius: 3px;
            transition: width 0.8s ease;
        }
        
        .progress-text {
            display: flex;
            justify-content: space-between;
            font-size: 0.7rem;
            color: var(--color4);
        }
        
        /* Tablet and Desktop */
        @media (min-width: 768px) {
            .collection-container {
                max-width: 1200px;
                padding: var(--spacing-lg);
            }
            
            .collection-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: var(--spacing-lg);
            }
            
            .page-title {
                font-size: 2.5rem;
            }
            
            .stat-value {
                font-size: 2rem;
            }
            
            .item-title {
                font-size: 0.9rem;
            }
        }
        
        /* Parallax Layers */
        .parallax-layer {
            position: absolute;
            pointer-events: none;
            will-change: transform;
            transition: transform .08s linear;
        }
        
        .parallax-layer:nth-child(1) {
            background: radial-gradient(circle at 25% 75%, rgba(123, 159, 255, 0.06) 0%, transparent 50%);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: 15%;
            left: 0%;
        }
        
        .parallax-layer:nth-child(2) {
            background: radial-gradient(circle at 75% 25%, rgba(132, 21, 103, 0.06) 0%, transparent 50%);
            width: 250px;
            height: 250px;
            border-radius: 50%;
            top: 45%;
            right: 0%;
        }
        
        .parallax-layer:nth-child(3) {
            background: radial-gradient(circle at 50% 50%, rgba(235, 199, 255, 0.04) 0%, transparent 50%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            top: 25%;
            left: 30%;
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
            <div class="collection-container">


                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">🎨 Koleksiyon</h1>
                    <p class="page-subtitle">Topladığın CG'ler, başarımlar ve özel içerikler</p>
                </div>

                <!-- Collection Stats -->
                <div class="collection-stats">
                    <div class="stat-card">
                        <div class="stat-icon">🖼️</div>
                        <div class="stat-value" id="cg-count">0</div>
                        <div class="stat-label">CG Galerisi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🏆</div>
                        <div class="stat-value" id="achievement-count">0</div>
                        <div class="stat-label">Başarımlar</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🎵</div>
                        <div class="stat-value" id="music-count">0</div>
                        <div class="stat-label">Müzik</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">📚</div>
                        <div class="stat-value" id="memory-count">0</div>
                        <div class="stat-label">Anılar</div>
                    </div>
                </div>

                <!-- Collection Tabs -->
                <div class="collection-tabs">
                    <button class="collection-tab active" data-tab="cg">CG Galerisi</button>
                    <button class="collection-tab" data-tab="achievements">Başarımlar</button>
                    <button class="collection-tab" data-tab="music">Müzik</button>
                    <button class="collection-tab" data-tab="memories">Anılar</button>
                </div>

                <!-- CG Gallery Content -->
                <div class="collection-content active" id="cg-content">
                    <div class="filter-bar">
                        <button class="filter-btn active" data-filter="all">Tümü</button>
                        <button class="filter-btn" data-filter="common">Yaygın</button>
                        <button class="filter-btn" data-filter="rare">Nadir</button>
                        <button class="filter-btn" data-filter="epic">Epik</button>
                        <button class="filter-btn" data-filter="legendary">Efsanevi</button>
                    </div>
                    <div class="collection-grid" id="cg-grid">
                        <!-- CG items will be loaded here -->
                    </div>
                </div>

                <!-- Achievements Content -->
                <div class="collection-content" id="achievements-content">
                    <div class="achievement-list" id="achievement-list">
                        <!-- Achievements will be loaded here -->
                    </div>
                </div>

                <!-- Music Content -->
                <div class="collection-content" id="music-content">
                    <div class="collection-grid" id="music-grid">
                        <!-- Music items will be loaded here -->
                    </div>
                </div>

                <!-- Memories Content -->
                <div class="collection-content" id="memories-content">
                    <div class="collection-grid" id="memories-grid">
                        <!-- Memory items will be loaded here -->
                    </div>
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
        // Collection Mobile Controller
        class CollectionMobileController {
            constructor() {
                this.currentTab = 'cg';
                this.currentFilter = 'all';

                this.cgItems = [
                    {
                        id: 'cg-001',
                        title: 'Leo ile İlk Karşılaşma',
                        rarity: 'common',
                        unlocked: true,
                        isNew: false,
                        image: '🎭',
                        category: 'story'
                    },
                    {
                        id: 'cg-002',
                        title: 'Chloe\'nin Hacker Odası',
                        rarity: 'rare',
                        unlocked: true,
                        isNew: true,
                        image: '💻',
                        category: 'character'
                    },
                    {
                        id: 'cg-003',
                        title: 'Felix\'in Gülümsemesi',
                        rarity: 'epic',
                        unlocked: true,
                        isNew: false,
                        image: '😊',
                        category: 'romance'
                    },
                    {
                        id: 'cg-004',
                        title: 'Neural Network Merkezi',
                        rarity: 'legendary',
                        unlocked: false,
                        isNew: false,
                        image: '🧠',
                        category: 'story',
                        unlockCondition: 'Ana hikayeyi tamamla'
                    },
                    {
                        id: 'cg-005',
                        title: 'Elara\'nın Bilgeliği',
                        rarity: 'legendary',
                        unlocked: false,
                        isNew: false,
                        image: '✨',
                        category: 'character',
                        unlockCondition: 'Elara\'yı aç'
                    },
                    {
                        id: 'cg-006',
                        title: 'Takım Toplantısı',
                        rarity: 'rare',
                        unlocked: true,
                        isNew: false,
                        image: '👥',
                        category: 'group'
                    }
                ];

                this.achievements = [
                    {
                        id: 'ach-001',
                        title: 'İlk Adım',
                        description: 'Oyuna ilk kez giriş yap',
                        icon: '🚀',
                        progress: 100,
                        maxProgress: 100,
                        completed: true,
                        reward: '10 Neural Fragment'
                    },
                    {
                        id: 'ach-002',
                        title: 'Sohbet Ustası',
                        description: '50 mesaj gönder',
                        icon: '💬',
                        progress: 32,
                        maxProgress: 50,
                        completed: false,
                        reward: '25 Neural Fragment'
                    },
                    {
                        id: 'ach-003',
                        title: 'Koleksiyoncu',
                        description: '10 CG topla',
                        icon: '🎨',
                        progress: 3,
                        maxProgress: 10,
                        completed: false,
                        reward: '50 Neural Fragment'
                    },
                    {
                        id: 'ach-004',
                        title: 'Kalp Kırıcı',
                        description: 'Bir karakterle maksimum ilişki seviyesine ulaş',
                        icon: '💖',
                        progress: 75,
                        maxProgress: 100,
                        completed: false,
                        reward: 'Özel CG + 100 Neural Fragment'
                    }
                ];

                this.musicItems = [
                    {
                        id: 'music-001',
                        title: 'Main Theme',
                        artist: 'Celestial Composer',
                        duration: '3:45',
                        unlocked: true,
                        image: '🎵'
                    },
                    {
                        id: 'music-002',
                        title: 'Leo\'s Theme',
                        artist: 'Character Themes',
                        duration: '2:30',
                        unlocked: true,
                        image: '⚔️'
                    },
                    {
                        id: 'music-003',
                        title: 'Romantic Melody',
                        artist: 'Love Songs',
                        duration: '4:12',
                        unlocked: false,
                        image: '💕',
                        unlockCondition: 'Romantik rota aç'
                    }
                ];

                this.memoryItems = [
                    {
                        id: 'memory-001',
                        title: 'İlk Gün Anıları',
                        description: 'Neural Network\'e ilk girişin',
                        date: '2024-01-15',
                        unlocked: true,
                        image: '📅'
                    },
                    {
                        id: 'memory-002',
                        title: 'Leo ile Strateji',
                        description: 'Leo ile ilk strateji toplantısı',
                        date: '2024-01-16',
                        unlocked: true,
                        image: '🎯'
                    },
                    {
                        id: 'memory-003',
                        title: 'Gizli Keşif',
                        description: 'Chloe ile gizli sistem keşfi',
                        date: '2024-01-18',
                        unlocked: false,
                        image: '🔍',
                        unlockCondition: 'Chloe rotasını ilerlet'
                    }
                ];

                this.init();
            }

            init() {
                console.log('🎨 Collection Mobile Controller Initializing...');
                this.setupTabs();
                this.setupFilters();
                this.updateStats();
                this.renderContent();
                console.log('✅ Collection Mobile Controller Ready!');
            }

            setupTabs() {
                const tabs = document.querySelectorAll('.collection-tab');
                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        const tabName = tab.dataset.tab;
                        this.switchTab(tabName);
                    });
                });
            }

            setupFilters() {
                const filters = document.querySelectorAll('.filter-btn');
                filters.forEach(filter => {
                    filter.addEventListener('click', () => {
                        const filterName = filter.dataset.filter;
                        this.setFilter(filterName);
                    });
                });
            }

            switchTab(tabName) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                this.currentTab = tabName;

                // Update tab buttons
                document.querySelectorAll('.collection-tab').forEach(tab => {
                    tab.classList.toggle('active', tab.dataset.tab === tabName);
                });

                // Update content
                document.querySelectorAll('.collection-content').forEach(content => {
                    content.classList.toggle('active', content.id === `${tabName}-content`);
                });

                this.renderContent();
            }

            setFilter(filterName) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                this.currentFilter = filterName;

                // Update filter buttons
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.filter === filterName);
                });

                this.renderContent();
            }

            updateStats() {
                const unlockedCG = this.cgItems.filter(item => item.unlocked).length;
                const completedAchievements = this.achievements.filter(ach => ach.completed).length;
                const unlockedMusic = this.musicItems.filter(item => item.unlocked).length;
                const unlockedMemories = this.memoryItems.filter(item => item.unlocked).length;

                document.getElementById('cg-count').textContent = `${unlockedCG}/${this.cgItems.length}`;
                document.getElementById('achievement-count').textContent = `${completedAchievements}/${this.achievements.length}`;
                document.getElementById('music-count').textContent = `${unlockedMusic}/${this.musicItems.length}`;
                document.getElementById('memory-count').textContent = `${unlockedMemories}/${this.memoryItems.length}`;

                // Animate counters
                this.animateCounters();
            }

            animateCounters() {
                const counters = document.querySelectorAll('.stat-value');
                counters.forEach(counter => {
                    const target = counter.textContent;
                    counter.textContent = '0';

                    setTimeout(() => {
                        counter.textContent = target;
                        counter.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            counter.style.transform = 'scale(1)';
                        }, 200);
                    }, 300);
                });
            }

            renderContent() {
                switch (this.currentTab) {
                    case 'cg':
                        this.renderCGGallery();
                        break;
                    case 'achievements':
                        this.renderAchievements();
                        break;
                    case 'music':
                        this.renderMusic();
                        break;
                    case 'memories':
                        this.renderMemories();
                        break;
                }
            }

            renderCGGallery() {
                const container = document.getElementById('cg-grid');
                container.innerHTML = '';

                let filteredItems = this.cgItems;
                if (this.currentFilter !== 'all') {
                    filteredItems = this.cgItems.filter(item => item.rarity === this.currentFilter);
                }

                filteredItems.forEach(item => {
                    const element = this.createCGItem(item);
                    container.appendChild(element);
                });
            }

            createCGItem(item) {
                const element = document.createElement('div');
                element.className = `collection-item ${!item.unlocked ? 'locked' : ''} ${item.isNew ? 'new' : ''}`;
                element.dataset.itemId = item.id;

                element.innerHTML = `
                    <div class="item-image">
                        ${item.image}
                    </div>
                    <div class="item-info">
                        <div class="item-title">${item.title}</div>
                        <div class="item-rarity ${item.rarity}">${this.getRarityText(item.rarity)}</div>
                    </div>
                    ${!item.unlocked ? `
                        <div class="lock-overlay">
                            <div class="lock-icon">🔒</div>
                            <div class="lock-text">${item.unlockCondition || 'Kilitli içerik'}</div>
                        </div>
                    ` : ''}
                `;

                element.addEventListener('click', () => this.viewCGItem(item));
                return element;
            }

            renderAchievements() {
                const container = document.getElementById('achievement-list');
                container.innerHTML = '';

                this.achievements.forEach(achievement => {
                    const element = this.createAchievementItem(achievement);
                    container.appendChild(element);
                });
            }

            createAchievementItem(achievement) {
                const element = document.createElement('div');
                element.className = `achievement-item ${achievement.completed ? 'completed' : ''}`;
                element.dataset.achievementId = achievement.id;

                const progressPercent = (achievement.progress / achievement.maxProgress) * 100;

                element.innerHTML = `
                    <div class="achievement-header">
                        <div class="achievement-icon">${achievement.icon}</div>
                        <div class="achievement-info">
                            <div class="achievement-title">${achievement.title}</div>
                            <div class="achievement-description">${achievement.description}</div>
                        </div>
                    </div>
                    <div class="achievement-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${progressPercent}%"></div>
                        </div>
                        <div class="progress-text">
                            <span>${achievement.progress}/${achievement.maxProgress}</span>
                            <span>Ödül: ${achievement.reward}</span>
                        </div>
                    </div>
                `;

                element.addEventListener('click', () => this.viewAchievement(achievement));
                return element;
            }

            renderMusic() {
                const container = document.getElementById('music-grid');
                container.innerHTML = '';

                this.musicItems.forEach(item => {
                    const element = this.createMusicItem(item);
                    container.appendChild(element);
                });
            }

            createMusicItem(item) {
                const element = document.createElement('div');
                element.className = `collection-item ${!item.unlocked ? 'locked' : ''}`;
                element.dataset.itemId = item.id;

                element.innerHTML = `
                    <div class="item-image">
                        ${item.image}
                    </div>
                    <div class="item-info">
                        <div class="item-title">${item.title}</div>
                        <div style="color: var(--color4); font-size: 0.7rem; margin-bottom: 4px;">${item.artist}</div>
                        <div style="color: var(--color3); font-size: 0.7rem;">${item.duration}</div>
                    </div>
                    ${!item.unlocked ? `
                        <div class="lock-overlay">
                            <div class="lock-icon">🔒</div>
                            <div class="lock-text">${item.unlockCondition || 'Kilitli müzik'}</div>
                        </div>
                    ` : ''}
                `;

                element.addEventListener('click', () => this.playMusic(item));
                return element;
            }

            renderMemories() {
                const container = document.getElementById('memories-grid');
                container.innerHTML = '';

                this.memoryItems.forEach(item => {
                    const element = this.createMemoryItem(item);
                    container.appendChild(element);
                });
            }

            createMemoryItem(item) {
                const element = document.createElement('div');
                element.className = `collection-item ${!item.unlocked ? 'locked' : ''}`;
                element.dataset.itemId = item.id;

                element.innerHTML = `
                    <div class="item-image">
                        ${item.image}
                    </div>
                    <div class="item-info">
                        <div class="item-title">${item.title}</div>
                        <div style="color: var(--color4); font-size: 0.7rem; margin-bottom: 4px;">${item.description}</div>
                        <div style="color: var(--color3); font-size: 0.7rem;">${item.date}</div>
                    </div>
                    ${!item.unlocked ? `
                        <div class="lock-overlay">
                            <div class="lock-icon">🔒</div>
                            <div class="lock-text">${item.unlockCondition || 'Kilitli anı'}</div>
                        </div>
                    ` : ''}
                `;

                element.addEventListener('click', () => this.viewMemory(item));
                return element;
            }

            getRarityText(rarity) {
                const rarityMap = {
                    'common': 'Yaygın',
                    'rare': 'Nadir',
                    'epic': 'Epik',
                    'legendary': 'Efsanevi'
                };
                return rarityMap[rarity] || rarity;
            }

            viewCGItem(item) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                if (!item.unlocked) {
                    this.showNotification(`${item.title} henüz kilitli!`, 'warning');
                    return;
                }

                this.showNotification(`${item.title} görüntüleniyor...`, 'info');

                // Simulate CG viewer
                setTimeout(() => {
                    alert(`CG Görüntüleyici yakında eklenecek!\n\n${item.title}\nNadirlik: ${this.getRarityText(item.rarity)}`);
                }, 1000);
            }

            viewAchievement(achievement) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const status = achievement.completed ? 'Tamamlandı!' : `İlerleme: ${achievement.progress}/${achievement.maxProgress}`;
                alert(`${achievement.title}\n\n${achievement.description}\n\nDurum: ${status}\nÖdül: ${achievement.reward}`);
            }

            playMusic(item) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                if (!item.unlocked) {
                    this.showNotification(`${item.title} henüz kilitli!`, 'warning');
                    return;
                }

                this.showNotification(`${item.title} çalınıyor...`, 'info');

                // Simulate music player
                setTimeout(() => {
                    alert(`Müzik Çalar yakında eklenecek!\n\n${item.title}\nSanatçı: ${item.artist}\nSüre: ${item.duration}`);
                }, 1000);
            }

            viewMemory(item) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                if (!item.unlocked) {
                    this.showNotification(`${item.title} henüz kilitli!`, 'warning');
                    return;
                }

                this.showNotification(`${item.title} anısı açılıyor...`, 'info');

                setTimeout(() => {
                    alert(`Anı Görüntüleyici yakında eklenecek!\n\n${item.title}\n${item.description}\nTarih: ${item.date}`);
                }, 1000);
            }

            showNotification(message, type = 'info') {
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

        // Initialize Collection Controller
        let collectionController;
        document.addEventListener('DOMContentLoaded', async () => {
            if (window.waitForApp) {
                await window.waitForApp();
            }

            collectionController = new CollectionMobileController();
        });
    </script>
</body>
</html>
