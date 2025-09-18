<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etkinlikler - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        /* Mobile-First Events Styles */
        .events-container {
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
        
        .events-tabs {
            display: flex;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xs);
            margin-bottom: var(--spacing-lg);
            overflow-x: auto;
        }
        
        .events-tab {
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
        
        .events-tab.active {
            background: var(--gradient-secondary);
            color: var(--color5);
        }
        
        .events-tab:hover:not(.active) {
            background: rgba(255, 255, 255, 0.05);
            color: var(--color5);
        }
        
        .events-content {
            display: none;
        }
        
        .events-content.active {
            display: block;
        }
        
        .events-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }
        
        .event-card {
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
        
        .event-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }
        
        .event-card.active {
            border: 2px solid var(--color3);
            box-shadow: 0 0 20px rgba(123, 159, 255, 0.3);
        }
        
        .event-card.completed {
            opacity: 0.7;
            border-color: var(--accent-green);
        }
        
        .event-card.locked {
            opacity: 0.5;
            filter: grayscale(0.5);
        }
        
        .event-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }
        
        .event-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            position: relative;
        }
        
        .event-icon.pulsing {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(123, 159, 255, 0.7);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(123, 159, 255, 0);
            }
        }
        
        .event-info {
            flex: 1;
        }
        
        .event-title {
            color: var(--color5);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .event-description {
            color: var(--color4);
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: var(--spacing-sm);
        }
        
        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
        }
        
        .event-badge {
            background: var(--gradient-secondary);
            color: var(--color5);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .event-badge.time {
            background: rgba(245, 158, 11, 0.3);
            color: var(--accent-gold);
        }
        
        .event-badge.reward {
            background: rgba(76, 175, 80, 0.3);
            color: var(--accent-green);
        }
        
        .event-badge.difficulty {
            background: rgba(239, 68, 68, 0.3);
            color: var(--accent-red);
        }
        
        .event-progress {
            margin-bottom: var(--spacing-md);
        }
        
        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xs);
        }
        
        .progress-label {
            color: var(--color4);
            font-size: 0.8rem;
        }
        
        .progress-value {
            color: var(--color3);
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }
        
        .progress-fill {
            height: 100%;
            background: var(--gradient-secondary);
            border-radius: 4px;
            transition: width 0.8s ease;
            position: relative;
        }
        
        .progress-fill.animated::after {
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
        
        .event-rewards {
            margin-bottom: var(--spacing-md);
        }
        
        .rewards-list {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-xs);
        }
        
        .reward-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--spacing-xs) var(--spacing-sm);
            font-size: 0.8rem;
            color: var(--color4);
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
        }
        
        .event-actions {
            display: flex;
            gap: var(--spacing-sm);
        }
        
        .event-btn {
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
        
        .event-btn:hover {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
            transform: translateY(-1px);
        }
        
        .event-btn.primary {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
        }
        
        .event-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .event-btn.disabled:hover {
            background: var(--glass-bg);
            border-color: var(--glass-border);
            color: var(--color4);
            transform: none;
        }
        
        .countdown-timer {
            background: rgba(245, 158, 11, 0.2);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: var(--radius-md);
            padding: var(--spacing-sm);
            margin-top: var(--spacing-sm);
            text-align: center;
        }
        
        .countdown-text {
            color: var(--accent-gold);
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .countdown-time {
            color: var(--color5);
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: var(--spacing-xs);
            font-family: 'Courier New', monospace;
        }
        
        .daily-rewards {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }
        
        .daily-header {
            text-align: center;
            margin-bottom: var(--spacing-lg);
        }
        
        .daily-title {
            color: var(--color5);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .daily-subtitle {
            color: var(--color4);
            font-size: 0.9rem;
        }
        
        .daily-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: var(--spacing-sm);
        }
        
        .daily-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-md);
            padding: var(--spacing-sm);
            text-align: center;
            transition: var(--transition-normal);
            cursor: pointer;
            position: relative;
        }
        
        .daily-item:hover {
            border-color: var(--color3);
            transform: translateY(-2px);
        }
        
        .daily-item.claimed {
            background: rgba(76, 175, 80, 0.2);
            border-color: var(--accent-green);
        }
        
        .daily-item.current {
            background: var(--gradient-secondary);
            border-color: transparent;
            box-shadow: 0 0 15px rgba(123, 159, 255, 0.3);
        }
        
        .daily-day {
            color: var(--color4);
            font-size: 0.7rem;
            margin-bottom: var(--spacing-xs);
        }
        
        .daily-reward {
            color: var(--color5);
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .daily-icon {
            font-size: 1.2rem;
            margin-bottom: var(--spacing-xs);
        }
        
        .claimed-check {
            position: absolute;
            top: 4px;
            right: 4px;
            color: var(--accent-green);
            font-size: 0.8rem;
        }
        
        /* Tablet and Desktop */
        @media (min-width: 768px) {
            .events-container {
                max-width: 1200px;
                padding: var(--spacing-lg);
            }
            
            .events-list {
                grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
                gap: var(--spacing-xl);
            }
            
            .page-title {
                font-size: 2.5rem;
            }
            
            .event-icon {
                width: 80px;
                height: 80px;
                font-size: 2.2rem;
            }
            
            .event-title {
                font-size: 1.5rem;
            }
            
            .daily-grid {
                grid-template-columns: repeat(7, 1fr);
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
            background: radial-gradient(circle at 20% 60%, rgba(123, 159, 255, 0.08) 0%, transparent 50%);
            width: 280px;
            height: 280px;
            border-radius: 50%;
            top: 25%;
            left: 10%;
        }
        
        .parallax-layer:nth-child(2) {
            background: radial-gradient(circle at 80% 40%, rgba(132, 21, 103, 0.08) 0%, transparent 50%);
            width: 220px;
            height: 220px;
            border-radius: 50%;
            top: 55%;
            right: 10%;
        }
        
        .parallax-layer:nth-child(3) {
            background: radial-gradient(circle at 50% 20%, rgba(235, 199, 255, 0.05) 0%, transparent 50%);
            width: 350px;
            height: 350px;
            border-radius: 50%;
            top: 5%;
            left: 35%;
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
            <div class="events-container">


                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">🎉 Etkinlikler</h1>
                    <p class="page-subtitle">Özel etkinliklere katıl ve ödüller kazan</p>
                </div>

                <!-- Daily Rewards -->
                <div class="daily-rewards">
                    <div class="daily-header">
                        <div class="daily-title">📅 Günlük Ödüller</div>
                        <div class="daily-subtitle">Her gün giriş yap ve ödül kazan</div>
                    </div>
                    <div class="daily-grid" id="daily-grid">
                        <!-- Daily rewards will be loaded here -->
                    </div>
                </div>

                <!-- Events Tabs -->
                <div class="events-tabs">
                    <button class="events-tab active" data-tab="active">Aktif</button>
                    <button class="events-tab" data-tab="upcoming">Yaklaşan</button>
                    <button class="events-tab" data-tab="completed">Tamamlanan</button>
                </div>

                <!-- Active Events -->
                <div class="events-content active" id="active-content">
                    <div class="events-list" id="active-events">
                        <!-- Active events will be loaded here -->
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="events-content" id="upcoming-content">
                    <div class="events-list" id="upcoming-events">
                        <!-- Upcoming events will be loaded here -->
                    </div>
                </div>

                <!-- Completed Events -->
                <div class="events-content" id="completed-content">
                    <div class="events-list" id="completed-events">
                        <!-- Completed events will be loaded here -->
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
        // Events Mobile Controller
        class EventsMobileController {
            constructor() {
                this.currentTab = 'active';
                this.countdownTimers = new Map();

                this.dailyRewards = [
                    { day: 1, reward: '10 NF', icon: '💎', claimed: true },
                    { day: 2, reward: '15 NF', icon: '💎', claimed: true },
                    { day: 3, reward: '20 NF', icon: '💎', claimed: true },
                    { day: 4, reward: 'CG', icon: '🎨', claimed: false, current: true },
                    { day: 5, reward: '50 NF', icon: '💎', claimed: false },
                    { day: 6, reward: 'Müzik', icon: '🎵', claimed: false },
                    { day: 7, reward: '100 NF', icon: '💎', claimed: false }
                ];

                this.activeEvents = [
                    {
                        id: 'valentine-special',
                        title: 'Sevgililer Günü Özel',
                        description: 'Karakterlerle özel romantik anlar yaşa ve sınırlı CG\'leri topla',
                        icon: '💕',
                        progress: 65,
                        maxProgress: 100,
                        timeLeft: 2 * 24 * 60 * 60 * 1000, // 2 days
                        difficulty: 'Kolay',
                        rewards: ['Özel CG x3', '200 Neural Fragment', 'Romantik Müzik'],
                        active: true,
                        pulsing: true
                    },
                    {
                        id: 'neural-crisis',
                        title: 'Neural Ağ Krizi',
                        description: 'Sistem arızasını çöz ve karakterleri kurtar',
                        icon: '⚡',
                        progress: 30,
                        maxProgress: 100,
                        timeLeft: 5 * 24 * 60 * 60 * 1000, // 5 days
                        difficulty: 'Zor',
                        rewards: ['Efsanevi CG', '500 Neural Fragment', 'Özel Başlık'],
                        active: true,
                        pulsing: false
                    },
                    {
                        id: 'friendship-bonds',
                        title: 'Arkadaşlık Bağları',
                        description: 'Tüm karakterlerle arkadaşlık seviyesini artır',
                        icon: '🤝',
                        progress: 80,
                        maxProgress: 100,
                        timeLeft: 7 * 24 * 60 * 60 * 1000, // 7 days
                        difficulty: 'Orta',
                        rewards: ['Grup CG', '150 Neural Fragment', 'Arkadaşlık Rozeti'],
                        active: true,
                        pulsing: false
                    }
                ];

                this.upcomingEvents = [
                    {
                        id: 'summer-festival',
                        title: 'Yaz Festivali',
                        description: 'Karakterlerle yaz etkinliklerine katıl',
                        icon: '🌞',
                        startTime: 7 * 24 * 60 * 60 * 1000, // 7 days from now
                        difficulty: 'Kolay',
                        rewards: ['Yaz CG Seti', '300 Neural Fragment', 'Festival Kostümü'],
                        locked: false
                    },
                    {
                        id: 'mystery-dungeon',
                        title: 'Gizemli Zindan',
                        description: 'Bilinmeyen bölgeleri keşfet ve sırları çöz',
                        icon: '🏰',
                        startTime: 14 * 24 * 60 * 60 * 1000, // 14 days from now
                        difficulty: 'Çok Zor',
                        rewards: ['Efsanevi Ekipman', '1000 Neural Fragment', 'Kaşif Unvanı'],
                        locked: true,
                        unlockCondition: 'Ana hikayeyi %75 tamamla'
                    }
                ];

                this.completedEvents = [
                    {
                        id: 'new-year-celebration',
                        title: 'Yeni Yıl Kutlaması',
                        description: 'Karakterlerle yeni yılı karşıladın',
                        icon: '🎊',
                        completedDate: '2024-01-01',
                        rewards: ['Yeni Yıl CG', '100 Neural Fragment', 'Kutlama Rozeti'],
                        claimed: true
                    },
                    {
                        id: 'winter-wonderland',
                        title: 'Kış Masalı',
                        description: 'Kar manzaralı özel anlar yaşadın',
                        icon: '❄️',
                        completedDate: '2023-12-25',
                        rewards: ['Kış CG Seti', '250 Neural Fragment', 'Kar Tanesi Rozeti'],
                        claimed: true
                    }
                ];

                this.init();
            }

            init() {
                console.log('🎉 Events Mobile Controller Initializing...');
                this.setupTabs();
                this.renderDailyRewards();
                this.renderContent();
                this.startCountdowns();
                console.log('✅ Events Mobile Controller Ready!');
            }

            setupTabs() {
                const tabs = document.querySelectorAll('.events-tab');
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
                document.querySelectorAll('.events-tab').forEach(tab => {
                    tab.classList.toggle('active', tab.dataset.tab === tabName);
                });

                // Update content
                document.querySelectorAll('.events-content').forEach(content => {
                    content.classList.toggle('active', content.id === `${tabName}-content`);
                });

                this.renderContent();
            }

            renderDailyRewards() {
                const container = document.getElementById('daily-grid');
                container.innerHTML = '';

                this.dailyRewards.forEach(reward => {
                    const item = this.createDailyRewardItem(reward);
                    container.appendChild(item);
                });
            }

            createDailyRewardItem(reward) {
                const item = document.createElement('div');
                item.className = `daily-item ${reward.claimed ? 'claimed' : ''} ${reward.current ? 'current' : ''}`;
                item.dataset.day = reward.day;

                item.innerHTML = `
                    <div class="daily-day">Gün ${reward.day}</div>
                    <div class="daily-icon">${reward.icon}</div>
                    <div class="daily-reward">${reward.reward}</div>
                    ${reward.claimed ? '<div class="claimed-check">✓</div>' : ''}
                `;

                item.addEventListener('click', () => this.claimDailyReward(reward));
                return item;
            }

            renderContent() {
                switch (this.currentTab) {
                    case 'active':
                        this.renderActiveEvents();
                        break;
                    case 'upcoming':
                        this.renderUpcomingEvents();
                        break;
                    case 'completed':
                        this.renderCompletedEvents();
                        break;
                }
            }

            renderActiveEvents() {
                const container = document.getElementById('active-events');
                container.innerHTML = '';

                this.activeEvents.forEach(event => {
                    const element = this.createEventCard(event, 'active');
                    container.appendChild(element);
                });
            }

            renderUpcomingEvents() {
                const container = document.getElementById('upcoming-events');
                container.innerHTML = '';

                this.upcomingEvents.forEach(event => {
                    const element = this.createEventCard(event, 'upcoming');
                    container.appendChild(element);
                });
            }

            renderCompletedEvents() {
                const container = document.getElementById('completed-events');
                container.innerHTML = '';

                this.completedEvents.forEach(event => {
                    const element = this.createEventCard(event, 'completed');
                    container.appendChild(element);
                });
            }

            createEventCard(event, type) {
                const card = document.createElement('div');
                card.className = `event-card ${type === 'active' && event.active ? 'active' : ''} ${type === 'completed' ? 'completed' : ''} ${event.locked ? 'locked' : ''}`;
                card.dataset.eventId = event.id;

                let content = `
                    <div class="event-header">
                        <div class="event-icon ${event.pulsing ? 'pulsing' : ''}">${event.icon}</div>
                        <div class="event-info">
                            <div class="event-title">${event.title}</div>
                            <div class="event-description">${event.description}</div>
                        </div>
                    </div>
                `;

                // Event meta badges
                if (type !== 'completed') {
                    const badges = [];
                    if (event.difficulty) badges.push(`<span class="event-badge difficulty">${event.difficulty}</span>`);
                    if (type === 'upcoming' && event.startTime) {
                        const days = Math.ceil(event.startTime / (24 * 60 * 60 * 1000));
                        badges.push(`<span class="event-badge time">${days} gün sonra</span>`);
                    }

                    if (badges.length > 0) {
                        content += `<div class="event-meta">${badges.join('')}</div>`;
                    }
                }

                // Progress bar for active events
                if (type === 'active' && event.progress !== undefined) {
                    const progressPercent = (event.progress / event.maxProgress) * 100;
                    content += `
                        <div class="event-progress">
                            <div class="progress-header">
                                <span class="progress-label">İlerleme</span>
                                <span class="progress-value">${event.progress}/${event.maxProgress}</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill animated" style="width: ${progressPercent}%"></div>
                            </div>
                        </div>
                    `;
                }

                // Rewards
                if (event.rewards) {
                    content += `
                        <div class="event-rewards">
                            <div class="rewards-list">
                                ${event.rewards.map(reward => `
                                    <div class="reward-item">
                                        <span>🎁</span>
                                        <span>${reward}</span>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }

                // Countdown timer for active events
                if (type === 'active' && event.timeLeft) {
                    content += `
                        <div class="countdown-timer">
                            <div class="countdown-text">Kalan Süre</div>
                            <div class="countdown-time" id="countdown-${event.id}">--:--:--</div>
                        </div>
                    `;
                }

                // Action buttons
                let buttons = '';
                if (type === 'active') {
                    buttons = `
                        <button class="event-btn primary" onclick="eventsController.participateEvent('${event.id}')">
                            🚀 Katıl
                        </button>
                        <button class="event-btn" onclick="eventsController.viewEventDetails('${event.id}')">
                            ℹ️ Detaylar
                        </button>
                    `;
                } else if (type === 'upcoming') {
                    if (event.locked) {
                        buttons = `
                            <button class="event-btn disabled" disabled>
                                🔒 Kilitli
                            </button>
                            <button class="event-btn" onclick="eventsController.showUnlockInfo('${event.id}')">
                                ❓ Nasıl Açılır
                            </button>
                        `;
                    } else {
                        buttons = `
                            <button class="event-btn" onclick="eventsController.setReminder('${event.id}')">
                                🔔 Hatırlat
                            </button>
                            <button class="event-btn" onclick="eventsController.viewEventDetails('${event.id}')">
                                ℹ️ Detaylar
                            </button>
                        `;
                    }
                } else if (type === 'completed') {
                    buttons = `
                        <button class="event-btn" onclick="eventsController.viewEventDetails('${event.id}')">
                            📜 Geçmiş
                        </button>
                        ${!event.claimed ? `
                            <button class="event-btn primary" onclick="eventsController.claimRewards('${event.id}')">
                                🎁 Ödül Al
                            </button>
                        ` : ''}
                    `;
                }

                if (buttons) {
                    content += `<div class="event-actions">${buttons}</div>`;
                }

                // Unlock condition for locked events
                if (event.locked && event.unlockCondition) {
                    content += `
                        <div style="margin-top: var(--spacing-sm); padding: var(--spacing-sm); background: rgba(239, 68, 68, 0.1); border-radius: var(--radius-md); text-align: center;">
                            <div style="color: var(--accent-red); font-size: 0.8rem;">
                                🔒 ${event.unlockCondition}
                            </div>
                        </div>
                    `;
                }

                card.innerHTML = content;
                return card;
            }

            startCountdowns() {
                this.activeEvents.forEach(event => {
                    if (event.timeLeft) {
                        this.startCountdown(event.id, event.timeLeft);
                    }
                });
            }

            startCountdown(eventId, timeLeft) {
                const updateCountdown = () => {
                    const element = document.getElementById(`countdown-${eventId}`);
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

                updateCountdown();
                const timer = setInterval(updateCountdown, 1000);
                this.countdownTimers.set(eventId, timer);
            }

            claimDailyReward(reward) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                if (reward.claimed) {
                    this.showNotification('Bu ödül zaten alındı!', 'warning');
                    return;
                }

                if (!reward.current) {
                    this.showNotification('Bu ödülü henüz alamazsın!', 'warning');
                    return;
                }

                // Simulate claiming
                this.showNotification(`${reward.reward} ödülü alınıyor...`, 'info');

                setTimeout(() => {
                    reward.claimed = true;
                    reward.current = false;

                    // Move to next day
                    const nextReward = this.dailyRewards.find(r => r.day === reward.day + 1);
                    if (nextReward) {
                        nextReward.current = true;
                    }

                    this.renderDailyRewards();
                    this.showNotification(`${reward.reward} başarıyla alındı!`, 'success');
                }, 1000);
            }

            participateEvent(eventId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const event = this.activeEvents.find(e => e.id === eventId);
                if (event) {
                    this.showNotification(`${event.title} etkinliğine katılıyorsun...`, 'info');

                    setTimeout(() => {
                        alert(`${event.title} etkinlik sistemi yakında eklenecek!`);
                    }, 1000);
                }
            }

            viewEventDetails(eventId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                // Find event in all categories
                const allEvents = [...this.activeEvents, ...this.upcomingEvents, ...this.completedEvents];
                const event = allEvents.find(e => e.id === eventId);

                if (event) {
                    let details = `${event.title}\n\n${event.description}\n\n`;

                    if (event.difficulty) {
                        details += `Zorluk: ${event.difficulty}\n`;
                    }

                    if (event.rewards) {
                        details += `\nÖdüller:\n${event.rewards.map(r => `• ${r}`).join('\n')}`;
                    }

                    alert(details);
                }
            }

            setReminder(eventId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const event = this.upcomingEvents.find(e => e.id === eventId);
                if (event) {
                    this.showNotification(`${event.title} için hatırlatıcı kuruldu!`, 'success');
                }
            }

            showUnlockInfo(eventId) {
                const event = this.upcomingEvents.find(e => e.id === eventId);
                if (event && event.unlockCondition) {
                    alert(`${event.title} Kilit Açma Koşulu:\n\n${event.unlockCondition}`);
                }
            }

            claimRewards(eventId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const event = this.completedEvents.find(e => e.id === eventId);
                if (event) {
                    this.showNotification(`${event.title} ödülleri alınıyor...`, 'info');

                    setTimeout(() => {
                        event.claimed = true;
                        this.renderCompletedEvents();
                        this.showNotification('Ödüller başarıyla alındı!', 'success');
                    }, 1000);
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
                // Clear all countdown timers
                this.countdownTimers.forEach(timer => clearInterval(timer));
                this.countdownTimers.clear();
            }
        }

        // Initialize Events Controller
        let eventsController;
        document.addEventListener('DOMContentLoaded', async () => {
            if (window.waitForApp) {
                await window.waitForApp();
            }

            eventsController = new EventsMobileController();
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (eventsController) {
                eventsController.destroy();
            }
        });
    </script>
</body>
</html>
