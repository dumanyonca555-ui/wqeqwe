<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sohbet & Hikayeler - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        /* Mobile-First Chat & Stories Styles */
        .chat-container {
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
        
        .chat-tabs {
            display: flex;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xs);
            margin-bottom: var(--spacing-lg);
            overflow-x: auto;
        }
        
        .chat-tab {
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
        
        .chat-tab.active {
            background: var(--gradient-secondary);
            color: var(--color5);
        }
        
        .chat-tab:hover:not(.active) {
            background: rgba(255, 255, 255, 0.05);
            color: var(--color5);
        }
        
        .chat-content {
            display: none;
        }
        
        .chat-content.active {
            display: block;
        }
        
        .chat-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }
        
        .chat-item {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-md);
            transition: var(--transition-normal);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .chat-item:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }
        
        .chat-item.unread {
            border-left: 4px solid var(--color3);
        }
        
        .chat-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-sm);
        }
        
        .chat-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--glass-border);
            object-fit: cover;
        }
        
        .chat-info {
            flex: 1;
        }
        
        .chat-name {
            color: var(--color5);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .chat-preview {
            color: var(--color4);
            font-size: 0.9rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .chat-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: var(--spacing-sm);
        }
        
        .chat-time {
            color: var(--color4);
            font-size: 0.8rem;
        }
        
        .chat-badge {
            background: var(--gradient-secondary);
            color: var(--color5);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            color: var(--color3);
            font-size: 0.8rem;
            margin-top: var(--spacing-xs);
        }
        
        .typing-dots {
            display: flex;
            gap: 2px;
        }
        
        .typing-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--color3);
            animation: typing 1.4s infinite;
        }
        
        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        @keyframes typing {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: 0.4;
            }
            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }
        
        .story-item {
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
        
        .story-item:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }
        
        .story-item.locked {
            opacity: 0.6;
            filter: grayscale(0.3);
        }
        
        .story-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }
        
        .story-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .story-info {
            flex: 1;
        }
        
        .story-title {
            color: var(--color5);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }
        
        .story-description {
            color: var(--color4);
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .story-progress {
            margin-top: var(--spacing-md);
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
            align-items: center;
            font-size: 0.8rem;
        }
        
        .progress-label {
            color: var(--color4);
        }
        
        .progress-value {
            color: var(--color3);
            font-weight: 600;
        }
        
        .story-actions {
            display: flex;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-md);
        }
        
        .story-btn {
            flex: 1;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--color4);
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            transition: var(--transition-normal);
            cursor: pointer;
        }
        
        .story-btn:hover {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
            transform: translateY(-1px);
        }
        
        .story-btn.primary {
            background: var(--gradient-secondary);
            border-color: transparent;
            color: var(--color5);
        }
        
        .story-btn.locked {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        /* Tablet and Desktop */
        @media (min-width: 768px) {
            .chat-container {
                max-width: 1200px;
                padding: var(--spacing-lg);
            }
            
            .chat-list {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: var(--spacing-lg);
            }
            
            .page-title {
                font-size: 2.5rem;
            }
            
            .chat-avatar {
                width: 60px;
                height: 60px;
            }
            
            .story-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
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
            background: radial-gradient(circle at 30% 70%, rgba(123, 159, 255, 0.08) 0%, transparent 50%);
            width: 250px;
            height: 250px;
            border-radius: 50%;
            top: 20%;
            left: 5%;
        }
        
        .parallax-layer:nth-child(2) {
            background: radial-gradient(circle at 70% 30%, rgba(132, 21, 103, 0.08) 0%, transparent 50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            top: 50%;
            right: 5%;
        }
        
        .parallax-layer:nth-child(3) {
            background: radial-gradient(circle at 50% 80%, rgba(235, 199, 255, 0.05) 0%, transparent 50%);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: 10%;
            left: 40%;
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
            <div class="chat-container">


                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">💬 Sohbet & Hikayeler</h1>
                    <p class="page-subtitle">Karakterlerle sohbet et ve hikayeleri keşfet</p>
                </div>

                <!-- Chat Tabs -->
                <div class="chat-tabs">
                    <button class="chat-tab active" data-tab="chats">Sohbetler</button>
                    <button class="chat-tab" data-tab="stories">Hikayeler</button>
                    <button class="chat-tab" data-tab="group">Grup</button>
                </div>

                <!-- Chat Content -->
                <div class="chat-content active" id="chats-content">
                    <div class="chat-list" id="chat-list">
                        <!-- Chats will be loaded here -->
                    </div>
                </div>

                <!-- Stories Content -->
                <div class="chat-content" id="stories-content">
                    <div class="chat-list" id="stories-list">
                        <!-- Stories will be loaded here -->
                    </div>
                </div>

                <!-- Group Content -->
                <div class="chat-content" id="group-content">
                    <div class="chat-list" id="group-list">
                        <!-- Group chats will be loaded here -->
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
        // Chat & Stories Mobile Controller
        class ChatStoriesMobileController {
            constructor() {
                this.currentTab = 'chats';
                this.typingTimers = new Map();

                this.chats = [
                    {
                        id: 'leo',
                        name: 'Leo',
                        avatar: 'assets/images/characters/leo-portrait.png',
                        preview: 'Strateji hakkında konuşalım... Yeni bir plan var.',
                        time: '14:30',
                        unread: 2,
                        typing: false,
                        online: true
                    },
                    {
                        id: 'chloe',
                        name: 'Chloe',
                        avatar: 'assets/images/characters/chloe-portrait.png',
                        preview: 'Yeni bir sistem keşfettim! Bu çok önemli.',
                        time: '13:45',
                        unread: 0,
                        typing: true,
                        online: true
                    },
                    {
                        id: 'felix',
                        name: 'Felix',
                        avatar: 'assets/images/characters/felix-portrait.png',
                        preview: 'Bugün nasılsın? Seni merak ediyorum 💕',
                        time: '12:20',
                        unread: 5,
                        typing: false,
                        online: true
                    },
                    {
                        id: 'elara',
                        name: 'Elara',
                        avatar: 'assets/images/characters/elara-portrait.png',
                        preview: 'Bilgelik paylaşmak isterim...',
                        time: '11:15',
                        unread: 0,
                        typing: false,
                        online: false
                    }
                ];

                this.stories = [
                    {
                        id: 'main-story',
                        title: 'Ana Hikaye',
                        description: 'Neural Network\'teki gizemli olayları keşfet',
                        icon: '📖',
                        progress: 65,
                        locked: false,
                        chapters: 12,
                        currentChapter: 8
                    },
                    {
                        id: 'leo-route',
                        title: 'Leo\'nun Rotası',
                        description: 'Stratejist Leo ile derin bağ kur',
                        icon: '⚔️',
                        progress: 40,
                        locked: false,
                        chapters: 10,
                        currentChapter: 4
                    },
                    {
                        id: 'chloe-route',
                        title: 'Chloe\'nin Rotası',
                        description: 'Hacker Chloe\'nin sırlarını öğren',
                        icon: '💻',
                        progress: 25,
                        locked: false,
                        chapters: 8,
                        currentChapter: 2
                    },
                    {
                        id: 'felix-route',
                        title: 'Felix\'in Rotası',
                        description: 'Kalbi temiz Felix ile romantik macera',
                        icon: '💖',
                        progress: 0,
                        locked: true,
                        chapters: 6,
                        currentChapter: 0,
                        unlockRequirement: 'Leo rotasını tamamla'
                    }
                ];

                this.groupChats = [
                    {
                        id: 'team-meeting',
                        name: 'Takım Toplantısı',
                        avatar: '👥',
                        preview: 'Herkesi bekliyor... Önemli duyuru var.',
                        time: '10:00',
                        unread: 1,
                        members: ['Leo', 'Chloe', 'Felix'],
                        active: true
                    },
                    {
                        id: 'neural-network',
                        name: 'Neural Network',
                        avatar: '🧠',
                        preview: 'Sistem güncellemesi tamamlandı.',
                        time: 'Dün',
                        unread: 0,
                        members: ['Sistem', 'AI Assistant'],
                        active: false
                    }
                ];

                this.init();
            }

            init() {
                console.log('💬 Chat & Stories Mobile Controller Initializing...');
                this.setupTabs();
                this.renderContent();
                this.startTypingSimulation();
                console.log('✅ Chat & Stories Mobile Controller Ready!');
            }

            setupTabs() {
                const tabs = document.querySelectorAll('.chat-tab');
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
                document.querySelectorAll('.chat-tab').forEach(tab => {
                    tab.classList.toggle('active', tab.dataset.tab === tabName);
                });

                // Update content
                document.querySelectorAll('.chat-content').forEach(content => {
                    content.classList.toggle('active', content.id === `${tabName}-content`);
                });

                this.renderContent();
            }

            renderContent() {
                switch (this.currentTab) {
                    case 'chats':
                        this.renderChats();
                        break;
                    case 'stories':
                        this.renderStories();
                        break;
                    case 'group':
                        this.renderGroupChats();
                        break;
                }
            }

            renderChats() {
                const container = document.getElementById('chat-list');
                container.innerHTML = '';

                this.chats.forEach(chat => {
                    const item = this.createChatItem(chat);
                    container.appendChild(item);
                });
            }

            createChatItem(chat) {
                const item = document.createElement('div');
                item.className = `chat-item ${chat.unread > 0 ? 'unread' : ''}`;
                item.dataset.chatId = chat.id;

                item.innerHTML = `
                    <div class="chat-header">
                        <img src="${chat.avatar}" alt="${chat.name}" class="chat-avatar"
                             onerror="this.src='assets/images/characters/leo-portrait.png'">
                        <div class="chat-info">
                            <div class="chat-name">${chat.name}</div>
                            <div class="chat-preview">${chat.preview}</div>
                            ${chat.typing ? `
                                <div class="typing-indicator">
                                    <span>yazıyor</span>
                                    <div class="typing-dots">
                                        <div class="typing-dot"></div>
                                        <div class="typing-dot"></div>
                                        <div class="typing-dot"></div>
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                    <div class="chat-meta">
                        <span class="chat-time">${chat.time}</span>
                        ${chat.unread > 0 ? `<span class="chat-badge">${chat.unread}</span>` : ''}
                    </div>
                `;

                item.addEventListener('click', () => this.openChat(chat.id));
                return item;
            }

            renderStories() {
                const container = document.getElementById('stories-list');
                container.innerHTML = '';

                this.stories.forEach(story => {
                    const item = this.createStoryItem(story);
                    container.appendChild(item);
                });
            }

            createStoryItem(story) {
                const item = document.createElement('div');
                item.className = `story-item ${story.locked ? 'locked' : ''}`;
                item.dataset.storyId = story.id;

                item.innerHTML = `
                    <div class="story-header">
                        <div class="story-icon">${story.icon}</div>
                        <div class="story-info">
                            <div class="story-title">${story.title}</div>
                            <div class="story-description">${story.description}</div>
                        </div>
                    </div>
                    <div class="story-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${story.progress}%"></div>
                        </div>
                        <div class="progress-text">
                            <span class="progress-label">Bölüm ${story.currentChapter}/${story.chapters}</span>
                            <span class="progress-value">${story.progress}%</span>
                        </div>
                    </div>
                    <div class="story-actions">
                        <button class="story-btn ${story.locked ? 'locked' : 'primary'}"
                                onclick="chatStoriesController.${story.locked ? 'showUnlockInfo' : 'continueStory'}('${story.id}')"
                                ${story.locked ? 'disabled' : ''}>
                            ${story.locked ? '🔒 Kilitli' : story.progress > 0 ? '▶️ Devam Et' : '🚀 Başla'}
                        </button>
                        ${!story.locked ? `
                            <button class="story-btn" onclick="chatStoriesController.showStoryInfo('${story.id}')">
                                ℹ️ Bilgi
                            </button>
                        ` : ''}
                    </div>
                    ${story.locked ? `
                        <div style="margin-top: var(--spacing-sm); color: var(--color4); font-size: 0.8rem; text-align: center;">
                            ${story.unlockRequirement}
                        </div>
                    ` : ''}
                `;

                return item;
            }

            renderGroupChats() {
                const container = document.getElementById('group-list');
                container.innerHTML = '';

                this.groupChats.forEach(group => {
                    const item = this.createGroupItem(group);
                    container.appendChild(item);
                });
            }

            createGroupItem(group) {
                const item = document.createElement('div');
                item.className = `chat-item ${group.unread > 0 ? 'unread' : ''}`;
                item.dataset.groupId = group.id;

                item.innerHTML = `
                    <div class="chat-header">
                        <div class="chat-avatar" style="background: var(--gradient-secondary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            ${group.avatar}
                        </div>
                        <div class="chat-info">
                            <div class="chat-name">${group.name}</div>
                            <div class="chat-preview">${group.preview}</div>
                            <div style="color: var(--color4); font-size: 0.8rem; margin-top: 4px;">
                                ${group.members.join(', ')}
                            </div>
                        </div>
                    </div>
                    <div class="chat-meta">
                        <span class="chat-time">${group.time}</span>
                        ${group.unread > 0 ? `<span class="chat-badge">${group.unread}</span>` : ''}
                    </div>
                `;

                item.addEventListener('click', () => this.openGroupChat(group.id));
                return item;
            }

            startTypingSimulation() {
                // Simulate typing indicators
                setInterval(() => {
                    this.chats.forEach(chat => {
                        if (Math.random() < 0.1) { // 10% chance
                            chat.typing = !chat.typing;
                            if (this.currentTab === 'chats') {
                                this.renderChats();
                            }
                        }
                    });
                }, 5000);
            }

            openChat(chatId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const chat = this.chats.find(c => c.id === chatId);
                if (chat) {
                    this.showNotification(`${chat.name} ile sohbet açılıyor...`, 'info');

                    // Mark as read
                    chat.unread = 0;
                    this.renderChats();

                    // Simulate chat opening
                    setTimeout(() => {
                        alert(`${chat.name} ile sohbet özelliği yakında eklenecek!`);
                    }, 1000);
                }
            }

            continueStory(storyId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const story = this.stories.find(s => s.id === storyId);
                if (story) {
                    this.showNotification(`${story.title} devam ediyor...`, 'info');

                    setTimeout(() => {
                        alert(`${story.title} hikaye sistemi yakında eklenecek!`);
                    }, 1000);
                }
            }

            showStoryInfo(storyId) {
                const story = this.stories.find(s => s.id === storyId);
                if (story) {
                    alert(`${story.title}\n\n${story.description}\n\nBölüm: ${story.currentChapter}/${story.chapters}\nİlerleme: ${story.progress}%`);
                }
            }

            showUnlockInfo(storyId) {
                const story = this.stories.find(s => s.id === storyId);
                if (story) {
                    alert(`${story.title} kilitli!\n\nKilit açma koşulu: ${story.unlockRequirement}`);
                }
            }

            openGroupChat(groupId) {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
                }

                const group = this.groupChats.find(g => g.id === groupId);
                if (group) {
                    this.showNotification(`${group.name} grup sohbeti açılıyor...`, 'info');

                    // Mark as read
                    group.unread = 0;
                    this.renderGroupChats();

                    setTimeout(() => {
                        alert(`${group.name} grup sohbet özelliği yakında eklenecek!`);
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
        }

        // Initialize Chat & Stories Controller
        let chatStoriesController;
        document.addEventListener('DOMContentLoaded', async () => {
            if (window.waitForApp) {
                await window.waitForApp();
            }

            chatStoriesController = new ChatStoriesMobileController();
        });
    </script>
</body>
</html>
