<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Mağaza - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        /* Mobile-First Premium Shop Styles */
        .shop-container {
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
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-premium);
            opacity: 0.1;
            z-index: -1;
        }
        
        .page-header:hover {
            border: 1px solid var(--accent-gold);
            box-shadow: 0 0 30px rgba(245, 158, 11, 0.3);
            transform: translateY(-2px);
        }
        
        .page-title {
            color: var(--color5);
            font-size: 2rem;
            margin-bottom: var(--spacing-sm);
            background: var(--gradient-premium);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-subtitle {
            color: var(--color4);
            font-size: 1rem;
        }
        
        .currency-display {
            display: flex;
            justify-content: center;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }
        
        .currency-card {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-md);
            text-align: center;
            transition: var(--transition-normal);
            flex: 1;
            max-width: 150px;
        }
        
        .currency-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }
        
        .currency-icon {
            font-size: 2rem;
            margin-bottom: var(--spacing-xs);
        }
        
        .currency-amount {
            color: var(--color5);
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: var(--spacing-xs);
        }
        
        .currency-label {
            color: var(--color4);
            font-size: 0.8rem;
        }
        
        .shop-tabs {
            display: flex;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xs);
            margin-bottom: var(--spacing-lg);
            overflow-x: auto;
        }
        
        .shop-tab {
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
        
        .shop-tab.active {
            background: var(--gradient-premium);
            color: var(--color5);
        }
        
        .shop-tab:hover:not(.active) {
            background: rgba(255, 255, 255, 0.05);
            color: var(--color5);
        }
        
        .shop-content {
            display: none;
        }
        
        .shop-content.active {
            display: block;
        }
        
        .shop-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }
        
        .shop-item {
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
        
        .shop-item:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }
        
        .shop-item.premium {
            border: 2px solid var(--accent-gold);
            background: linear-gradient(135deg, var(--glass-bg), rgba(245, 158, 11, 0.05));
        }
        
        .shop-item.premium::before {
            content: 'PREMIUM';
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--gradient-premium);
            color: var(--color5);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 0.6rem;
            font-weight: 700;
        }
        
        .shop-item.limited {
            border: 2px solid var(--accent-red);
            background: linear-gradient(135deg, var(--glass-bg), rgba(239, 68, 68, 0.05));
        }
        
        .shop-item.limited::before {
            content: 'SINIRLI';
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--gradient-danger);
            color: var(--color5);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 0.6rem;
            font-weight: 700;
        }
        
        .item-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }
        
        .item-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }
        
        .item-icon.premium {
            background: var(--gradient-premium);
        }
        
        .item-info {
            flex: 1;
        }
        
        .item-title {
            color: var(--color5);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .item-description {
            color: var(--color4);
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: var(--spacing-sm);
        }
        
        .item-features {
            margin-bottom: var(--spacing-md);
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-item {
            color: var(--color4);
            font-size: 0.8rem;
            margin-bottom: var(--spacing-xs);
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
        }
        
        .feature-item::before {
            content: '✓';
            color: var(--accent-green);
            font-weight: bold;
        }
        
        .item-pricing {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--spacing-md);
        }
        
        .price-info {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }
        
        .current-price {
            color: var(--color5);
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
        }
        
        .original-price {
            color: var(--color4);
            font-size: 0.9rem;
            text-decoration: line-through;
            opacity: 0.7;
        }
        
        .discount-badge {
            background: var(--gradient-danger);
            color: var(--color5);
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .item-actions {
            display: flex;
            gap: var(--spacing-sm);
        }
        
        .shop-btn {
            flex: 1;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--color4);
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            transition: var(--transition-normal);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xs);
        }
        
        .shop-btn:hover {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
            transform: translateY(-1px);
        }
        
        .shop-btn.primary {
            background: var(--gradient-premium);
            border-color: transparent;
            color: var(--color5);
        }
        
        .shop-btn.primary:hover {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
        }
        
        .shop-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .shop-btn.disabled:hover {
            background: var(--glass-bg);
            border-color: var(--glass-border);
            color: var(--color4);
            transform: none;
        }
        
        .bundle-items {
            margin-bottom: var(--spacing-md);
        }
        
        .bundle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: var(--spacing-sm);
        }
        
        .bundle-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--spacing-sm);
            text-align: center;
            transition: var(--transition-normal);
        }
        
        .bundle-item:hover {
            border-color: var(--color3);
            transform: translateY(-2px);
        }
        
        .bundle-icon {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-xs);
        }
        
        .bundle-name {
            color: var(--color5);
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .bundle-amount {
            color: var(--color4);
            font-size: 0.6rem;
        }
        
        .limited-timer {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: var(--radius-md);
            padding: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            text-align: center;
        }
        
        .timer-text {
            color: var(--accent-red);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .timer-display {
            color: var(--color5);
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Courier New', monospace;
        }
        
        /* Tablet and Desktop */
        @media (min-width: 768px) {
            .shop-container {
                max-width: 1200px;
                padding: var(--spacing-lg);
            }
            
            .shop-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: var(--spacing-xl);
            }
            
            .page-title {
                font-size: 2.5rem;
            }
            
            .currency-display {
                gap: var(--spacing-xl);
            }
            
            .item-icon {
                width: 80px;
                height: 80px;
                font-size: 2.2rem;
            }
            
            .item-title {
                font-size: 1.4rem;
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
            background: radial-gradient(circle at 15% 85%, rgba(245, 158, 11, 0.08) 0%, transparent 50%);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: 20%;
            left: 5%;
        }
        
        .parallax-layer:nth-child(2) {
            background: radial-gradient(circle at 85% 15%, rgba(132, 21, 103, 0.08) 0%, transparent 50%);
            width: 250px;
            height: 250px;
            border-radius: 50%;
            top: 60%;
            right: 5%;
        }
        
        .parallax-layer:nth-child(3) {
            background: radial-gradient(circle at 50% 50%, rgba(123, 159, 255, 0.06) 0%, transparent 50%);
            width: 400px;
            height: 400px;
            border-radius: 50%;
            top: 10%;
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
            <div class="shop-container">


                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">💎 Premium Mağaza</h1>
                    <p class="page-subtitle">Özel içerikler ve premium özellikler</p>
                </div>

                <!-- Currency Display -->
                <div class="currency-display">
                    <div class="currency-card">
                        <div class="currency-icon">💎</div>
                        <div class="currency-amount" id="neural-fragments">1,250</div>
                        <div class="currency-label">Neural Fragment</div>
                    </div>
                    <div class="currency-card">
                        <div class="currency-icon">🧠</div>
                        <div class="currency-amount" id="memory-shards">85</div>
                        <div class="currency-label">Memory Shard</div>
                    </div>
                    <div class="currency-card">
                        <div class="currency-icon">⚡</div>
                        <div class="currency-amount" id="data-points">320</div>
                        <div class="currency-label">Data Point</div>
                    </div>
                </div>

                <!-- Shop Tabs -->
                <div class="shop-tabs">
                    <button class="shop-tab active" data-tab="premium">Premium</button>
                    <button class="shop-tab" data-tab="currency">Para Birimi</button>
                    <button class="shop-tab" data-tab="bundles">Paketler</button>
                    <button class="shop-tab" data-tab="limited">Sınırlı</button>
                </div>

                <!-- Premium Content -->
                <div class="shop-content active" id="premium-content">
                    <div class="shop-grid" id="premium-grid">
                        <!-- Premium items will be loaded here -->
                    </div>
                </div>

                <!-- Currency Content -->
                <div class="shop-content" id="currency-content">
                    <div class="shop-grid" id="currency-grid">
                        <!-- Currency items will be loaded here -->
                    </div>
                </div>

                <!-- Bundles Content -->
                <div class="shop-content" id="bundles-content">
                    <div class="shop-grid" id="bundles-grid">
                        <!-- Bundle items will be loaded here -->
                    </div>
                </div>

                <!-- Limited Content -->
                <div class="shop-content" id="limited-content">
                    <div class="shop-grid" id="limited-grid">
                        <!-- Limited items will be loaded here -->
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
        // Premium Shop Mobile Controller
        class PremiumShopMobileController {
            constructor() {
                this.currentTab = 'premium';
                this.limitedTimers = new Map();

                this.userCurrency = {
                    neuralFragments: 1250,
                    memoryShards: 85,
                    dataPoints: 320
                };

                this.premiumItems = [
                    {
                        id: 'premium-pass',
                        title: 'Premium Geçiş',
                        description: 'Tüm premium özelliklere erişim kazanın',
                        icon: '👑',
                        price: { type: 'real', amount: 9.99, currency: '₺' },
                        features: [
                            'Sınırsız Neural Fragment',
                            'Özel CG koleksiyonu',
                            'Premium karakterler',
                            'Reklamsız deneyim',
                            'Öncelikli destek'
                        ],
                        premium: true
                    },
                    {
                        id: 'character-unlock',
                        title: 'Tüm Karakterler',
                        description: 'Tüm karakterleri anında açın',
                        icon: '👥',
                        price: { type: 'neural', amount: 500 },
                        features: [
                            'Elara karakteri',
                            'Gizli karakterler',
                            'Özel diyaloglar',
                            'Bonus hikayeler'
                        ],
                        premium: false
                    },
                    {
                        id: 'cg-collection',
                        title: 'CG Koleksiyon Paketi',
                        description: 'Özel CG\'lerin tamamına erişim',
                        icon: '🎨',
                        price: { type: 'memory', amount: 150 },
                        features: [
                            '50+ özel CG',
                            'Yüksek çözünürlük',
                            'Wallpaper paketi',
                            'Sanatçı yorumları'
                        ],
                        premium: false
                    }
                ];

                this.currencyItems = [
                    {
                        id: 'neural-small',
                        title: 'Küçük Neural Paketi',
                        description: '100 Neural Fragment',
                        icon: '💎',
                        price: { type: 'real', amount: 0.99, currency: '₺' },
                        reward: { type: 'neural', amount: 100 }
                    },
                    {
                        id: 'neural-medium',
                        title: 'Orta Neural Paketi',
                        description: '500 Neural Fragment + %20 bonus',
                        icon: '💎',
                        price: { type: 'real', amount: 4.99, currency: '₺' },
                        reward: { type: 'neural', amount: 600 },
                        bonus: 20
                    },
                    {
                        id: 'neural-large',
                        title: 'Büyük Neural Paketi',
                        description: '1200 Neural Fragment + %50 bonus',
                        icon: '💎',
                        price: { type: 'real', amount: 9.99, currency: '₺' },
                        reward: { type: 'neural', amount: 1800 },
                        bonus: 50,
                        popular: true
                    },
                    {
                        id: 'memory-pack',
                        title: 'Memory Shard Paketi',
                        description: '50 Memory Shard',
                        icon: '🧠',
                        price: { type: 'real', amount: 2.99, currency: '₺' },
                        reward: { type: 'memory', amount: 50 }
                    }
                ];

                this.bundleItems = [
                    {
                        id: 'starter-bundle',
                        title: 'Başlangıç Paketi',
                        description: 'Yeni oyuncular için özel paket',
                        icon: '🚀',
                        price: { type: 'real', amount: 14.99, currency: '₺' },
                        originalPrice: { type: 'real', amount: 24.99, currency: '₺' },
                        discount: 40,
                        items: [
                            { name: 'Neural Fragment', amount: '1000', icon: '💎' },
                            { name: 'Memory Shard', amount: '100', icon: '🧠' },
                            { name: 'Özel CG', amount: '5', icon: '🎨' },
                            { name: 'Premium Geçiş', amount: '7 gün', icon: '👑' }
                        ]
                    },
                    {
                        id: 'ultimate-bundle',
                        title: 'Ultimate Paket',
                        description: 'En kapsamlı içerik paketi',
                        icon: '⭐',
                        price: { type: 'real', amount: 49.99, currency: '₺' },
                        originalPrice: { type: 'real', amount: 79.99, currency: '₺' },
                        discount: 38,
                        items: [
                            { name: 'Premium Geçiş', amount: 'Kalıcı', icon: '👑' },
                            { name: 'Tüm Karakterler', amount: 'Açık', icon: '👥' },
                            { name: 'CG Koleksiyonu', amount: 'Tam', icon: '🎨' },
                            { name: 'Neural Fragment', amount: '5000', icon: '💎' },
                            { name: 'Özel Unvan', amount: '1', icon: '🏆' }
                        ],
                        premium: true
                    }
                ];

                this.limitedItems = [
                    {
                        id: 'valentine-special',
                        title: 'Sevgililer Günü Özel',
                        description: 'Romantik CG koleksiyonu ve özel içerikler',
                        icon: '💕',
                        price: { type: 'neural', amount: 300 },
                        timeLeft: 2 * 24 * 60 * 60 * 1000, // 2 days
                        features: [
                            'Romantik CG seti',
                            'Özel diyaloglar',
                            'Sevgililer teması',
                            'Sınırlı rozet'
                        ],
                        limited: true
                    },
                    {
                        id: 'anniversary-pack',
                        title: 'Yıldönümü Paketi',
                        description: 'Oyunun yıldönümü için özel paket',
                        icon: '🎉',
                        price: { type: 'real', amount: 19.99, currency: '₺' },
                        originalPrice: { type: 'real', amount: 39.99, currency: '₺' },
                        discount: 50,
                        timeLeft: 7 * 24 * 60 * 60 * 1000, // 7 days
                        features: [
                            'Yıldönümü CG\'leri',
                            '2000 Neural Fragment',
                            'Özel karakter kostümü',
                            'Altın rozet'
                        ],
                        limited: true
                    }
                ];

                this.init();
            }

            init() {
                console.log('💎 Premium Shop Mobile Controller Initializing...');
                this.setupTabs();
                this.updateCurrencyDisplay();
                this.renderContent();
                this.startLimitedTimers();
                console.log('✅ Premium Shop Mobile Controller Ready!');
            }

            setupTabs() {
                const tabs = document.querySelectorAll('.shop-tab');
                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        const tabName = tab.dataset.tab;
                        this.switchTab(tabName);
                    });
                });
            }

            switchTab(tabName) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                this.currentTab = tabName;

                // Update tab buttons
                document.querySelectorAll('.shop-tab').forEach(tab => {
                    tab.classList.toggle('active', tab.dataset.tab === tabName);
                });

                // Update content
                document.querySelectorAll('.shop-content').forEach(content => {
                    content.classList.toggle('active', content.id === `${tabName}-content`);
                });

                this.renderContent();
            }

            updateCurrencyDisplay() {
                document.getElementById('neural-fragments').textContent = this.userCurrency.neuralFragments.toLocaleString();
                document.getElementById('memory-shards').textContent = this.userCurrency.memoryShards.toLocaleString();
                document.getElementById('data-points').textContent = this.userCurrency.dataPoints.toLocaleString();
            }

            renderContent() {
                switch (this.currentTab) {
                    case 'premium':
                        this.renderPremiumItems();
                        break;
                    case 'currency':
                        this.renderCurrencyItems();
                        break;
                    case 'bundles':
                        this.renderBundleItems();
                        break;
                    case 'limited':
                        this.renderLimitedItems();
                        break;
                }
            }

            renderPremiumItems() {
                const container = document.getElementById('premium-grid');
                container.innerHTML = '';

                this.premiumItems.forEach(item => {
                    const element = this.createShopItem(item, 'premium');
                    container.appendChild(element);
                });
            }

            renderCurrencyItems() {
                const container = document.getElementById('currency-grid');
                container.innerHTML = '';

                this.currencyItems.forEach(item => {
                    const element = this.createShopItem(item, 'currency');
                    container.appendChild(element);
                });
            }

            renderBundleItems() {
                const container = document.getElementById('bundles-grid');
                container.innerHTML = '';

                this.bundleItems.forEach(item => {
                    const element = this.createShopItem(item, 'bundle');
                    container.appendChild(element);
                });
            }

            renderLimitedItems() {
                const container = document.getElementById('limited-grid');
                container.innerHTML = '';

                this.limitedItems.forEach(item => {
                    const element = this.createShopItem(item, 'limited');
                    container.appendChild(element);
                });
            }

            createShopItem(item, type) {
                const element = document.createElement('div');
                element.className = `shop-item ${item.premium ? 'premium' : ''} ${item.limited ? 'limited' : ''} ${item.popular ? 'popular' : ''}`;
                element.dataset.itemId = item.id;

                let content = `
                    <div class="item-header">
                        <div class="item-icon ${item.premium ? 'premium' : ''}">${item.icon}</div>
                        <div class="item-info">
                            <div class="item-title">${item.title}</div>
                            <div class="item-description">${item.description}</div>
                        </div>
                    </div>
                `;

                // Features list
                if (item.features) {
                    content += `
                        <div class="item-features">
                            <ul class="feature-list">
                                ${item.features.map(feature => `
                                    <li class="feature-item">${feature}</li>
                                `).join('')}
                            </ul>
                        </div>
                    `;
                }

                // Bundle items
                if (item.items && type === 'bundle') {
                    content += `
                        <div class="bundle-items">
                            <div class="bundle-grid">
                                ${item.items.map(bundleItem => `
                                    <div class="bundle-item">
                                        <div class="bundle-icon">${bundleItem.icon}</div>
                                        <div class="bundle-name">${bundleItem.name}</div>
                                        <div class="bundle-amount">${bundleItem.amount}</div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }

                // Limited timer
                if (item.timeLeft && type === 'limited') {
                    content += `
                        <div class="limited-timer">
                            <div class="timer-text">Kalan Süre</div>
                            <div class="timer-display" id="timer-${item.id}">--:--:--</div>
                        </div>
                    `;
                }

                // Pricing
                content += `
                    <div class="item-pricing">
                        <div class="price-info">
                            <div class="current-price">
                                ${this.formatPrice(item.price)}
                                ${item.bonus ? `<span class="discount-badge">+${item.bonus}%</span>` : ''}
                            </div>
                            ${item.originalPrice ? `
                                <div class="original-price">${this.formatPrice(item.originalPrice)}</div>
                            ` : ''}
                        </div>
                        ${item.discount ? `
                            <div class="discount-badge">-%${item.discount}</div>
                        ` : ''}
                    </div>
                `;

                // Action buttons
                const canAfford = this.canAffordItem(item);
                content += `
                    <div class="item-actions">
                        <button class="shop-btn ${canAfford ? 'primary' : 'disabled'}"
                                onclick="shopController.purchaseItem('${item.id}')"
                                ${!canAfford ? 'disabled' : ''}>
                            ${item.price.type === 'real' ? '💳 Satın Al' : '💎 Satın Al'}
                        </button>
                        <button class="shop-btn" onclick="shopController.previewItem('${item.id}')">
                            👁️ Önizle
                        </button>
                    </div>
                `;

                element.innerHTML = content;
                return element;
            }

            formatPrice(price) {
                if (price.type === 'real') {
                    return `${price.amount}${price.currency}`;
                } else if (price.type === 'neural') {
                    return `${price.amount} 💎`;
                } else if (price.type === 'memory') {
                    return `${price.amount} 🧠`;
                } else if (price.type === 'data') {
                    return `${price.amount} ⚡`;
                }
                return `${price.amount}`;
            }

            canAffordItem(item) {
                if (item.price.type === 'real') {
                    return true; // Real money purchases are always "affordable" in demo
                } else if (item.price.type === 'neural') {
                    return this.userCurrency.neuralFragments >= item.price.amount;
                } else if (item.price.type === 'memory') {
                    return this.userCurrency.memoryShards >= item.price.amount;
                } else if (item.price.type === 'data') {
                    return this.userCurrency.dataPoints >= item.price.amount;
                }
                return false;
            }

            startLimitedTimers() {
                this.limitedItems.forEach(item => {
                    if (item.timeLeft) {
                        this.startTimer(item.id, item.timeLeft);
                    }
                });
            }

            startTimer(itemId, timeLeft) {
                const updateTimer = () => {
                    const element = document.getElementById(`timer-${itemId}`);
                    if (!element) return;

                    if (timeLeft <= 0) {
                        element.textContent = 'Süresi Doldu!';
                        element.style.color = 'var(--accent-red)';
                        return;
                    }

                    const days = Math.floor(timeLeft / (24 * 60 * 60 * 1000));
                    const hours = Math.floor((timeLeft % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
                    const minutes = Math.floor((timeLeft % (60 * 60 * 1000)) / (60 * 1000));
                    const seconds = Math.floor((timeLeft % (60 * 1000)) / 1000);

                    let timeString = '';
                    if (days > 0) {
                        timeString = `${days}g ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    } else {
                        timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }

                    element.textContent = timeString;
                    timeLeft -= 1000;
                };

                updateTimer();
                const timer = setInterval(updateTimer, 1000);
                this.limitedTimers.set(itemId, timer);
            }

            purchaseItem(itemId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                // Find item in all categories
                const allItems = [...this.premiumItems, ...this.currencyItems, ...this.bundleItems, ...this.limitedItems];
                const item = allItems.find(i => i.id === itemId);

                if (!item) return;

                if (!this.canAffordItem(item)) {
                    this.showNotification('Yetersiz bakiye!', 'error');
                    return;
                }

                this.showNotification(`${item.title} satın alınıyor...`, 'info');

                // Simulate purchase process
                setTimeout(() => {
                    if (item.price.type === 'real') {
                        // Real money purchase simulation
                        this.showNotification('Ödeme sistemi yakında eklenecek!', 'info');
                        alert(`${item.title}\n\nFiyat: ${this.formatPrice(item.price)}\n\nGerçek para ile satın alma sistemi yakında eklenecek!`);
                    } else {
                        // Virtual currency purchase
                        this.processPurchase(item);
                    }
                }, 1000);
            }

            processPurchase(item) {
                // Deduct currency
                if (item.price.type === 'neural') {
                    this.userCurrency.neuralFragments -= item.price.amount;
                } else if (item.price.type === 'memory') {
                    this.userCurrency.memoryShards -= item.price.amount;
                } else if (item.price.type === 'data') {
                    this.userCurrency.dataPoints -= item.price.amount;
                }

                // Add rewards if applicable
                if (item.reward) {
                    if (item.reward.type === 'neural') {
                        this.userCurrency.neuralFragments += item.reward.amount;
                    } else if (item.reward.type === 'memory') {
                        this.userCurrency.memoryShards += item.reward.amount;
                    } else if (item.reward.type === 'data') {
                        this.userCurrency.dataPoints += item.reward.amount;
                    }
                }

                this.updateCurrencyDisplay();
                this.renderContent();
                this.showNotification(`${item.title} başarıyla satın alındı!`, 'success');
            }

            previewItem(itemId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const allItems = [...this.premiumItems, ...this.currencyItems, ...this.bundleItems, ...this.limitedItems];
                const item = allItems.find(i => i.id === itemId);

                if (item) {
                    let preview = `${item.title}\n\n${item.description}\n\nFiyat: ${this.formatPrice(item.price)}`;

                    if (item.features) {
                        preview += `\n\nÖzellikler:\n${item.features.map(f => `• ${f}`).join('\n')}`;
                    }

                    if (item.items) {
                        preview += `\n\nPaket İçeriği:\n${item.items.map(i => `• ${i.name}: ${i.amount}`).join('\n')}`;
                    }

                    alert(preview);
                }
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

            destroy() {
                // Clear all timers
                this.limitedTimers.forEach(timer => clearInterval(timer));
                this.limitedTimers.clear();
            }
        }

        // Initialize Premium Shop Controller
        let shopController;
        document.addEventListener('DOMContentLoaded', async () => {
            if (window.waitForApp) {
                await window.waitForApp();
            }

            shopController = new PremiumShopMobileController();
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (shopController) {
                shopController.destroy();
            }
        });
    </script>
</body>
</html>
