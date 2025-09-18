<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Ödüller - Celestial Tale</title>
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

        .rewards-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-lg);
        }

        .rewards-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .rewards-title {
            color: var(--color5);
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: var(--spacing-sm);
            background: var(--gradient-secondary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Montserrat', sans-serif;
        }

        .rewards-subtitle {
            color: var(--color4);
            font-size: 1rem;
            font-family: 'Montserrat', sans-serif;
        }

        /* Rewards Grid - Mobile First */
        .rewards-grid {
            display: grid;
            grid-template-columns: 1fr; /* Mobile: 1 column */
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        /* Tablet: 2 columns */
        @media (min-width: 768px) {
            .rewards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Desktop: 3 columns */
        @media (min-width: 1024px) {
            .rewards-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .reward-card {
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

        .reward-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }

        .reward-card-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto var(--spacing-md);
            transition: var(--transition-normal);
        }

        .reward-card:hover .reward-card-icon {
            transform: scale(1.1);
        }

        .reward-card-title {
            color: var(--color5);
            font-size: 1.1rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: var(--spacing-sm);
            font-family: 'Montserrat', sans-serif;
        }

        .reward-card-description {
            color: var(--color4);
            font-size: 0.85rem;
            text-align: center;
            line-height: 1.4;
            margin-bottom: var(--spacing-md);
            font-family: 'Montserrat', sans-serif;
        }

        .reward-card-badge {
            position: absolute;
            top: var(--spacing-sm);
            right: var(--spacing-sm);
            background: var(--gradient-secondary);
            color: var(--color5);
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--radius-md);
            font-size: 0.7rem;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
        }

        .reward-card-badge.new {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .reward-card-badge.exclusive {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .reward-card-badge.limited {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .reward-card-status {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xs);
            margin-top: var(--spacing-md);
            padding: var(--spacing-sm);
            border-radius: var(--radius-md);
            font-size: 0.8rem;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }

        .reward-card-status.unlocked {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .reward-card-status.locked {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .reward-card-status.claimed {
            background: rgba(123, 159, 255, 0.1);
            color: var(--color3);
            border: 1px solid rgba(123, 159, 255, 0.3);
        }

        /* Back Button */
        .back-section {
            margin-bottom: var(--spacing-lg);
        }

        .back-button {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-md) var(--spacing-lg);
            color: var(--color5);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-sm);
            transition: var(--transition-normal);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .back-button:hover {
            border-color: var(--glass-border-strong);
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        /* Loading State */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: var(--spacing-xl);
            color: var(--color4);
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <main class="main-container">
        <div id="ajax-content" class="content-container">
            <div class="rewards-container">
                <!-- Back Button -->
                <div class="back-section">
                    <a href="premium.php" class="back-button">
                        ← Premium'a Dön
                    </a>
                </div>

                <!-- Page Header -->
                <div class="rewards-header">
                    <h1 class="rewards-title">🎁 Premium Ödüller</h1>
                    <p class="rewards-subtitle">Özel rozetler ve exclusive içerikler</p>
                </div>

                <!-- Rewards Grid -->
                <div class="rewards-grid" id="rewards-grid">
                    <!-- Rewards will be loaded here -->
                </div>
            </div>
        </div>
        
        <div class="floating-particles"></div>
    </main>
    
    <script src="assets/js/navigation.js"></script>
    <script>
        // Premium Rewards Controller
        class PremiumRewardsController {
            constructor() {
                this.rewards = [
                    {
                        id: 1,
                        icon: '👑',
                        title: 'VIP Crown',
                        description: 'Özel VIP üye rozeti - profilde görünür',
                        badge: 'Yeni',
                        badgeType: 'new',
                        status: 'unlocked'
                    },
                    {
                        id: 2,
                        icon: '💎',
                        title: 'Diamond Badge',
                        description: 'Elmas rozet - premium üyelik simgesi',
                        badge: 'Exclusive',
                        badgeType: 'exclusive',
                        status: 'claimed'
                    },
                    {
                        id: 3,
                        icon: '🌟',
                        title: 'Star Collector',
                        description: 'Tüm karakterlerle maksimum affinity',
                        badge: 'Nadir',
                        badgeType: 'exclusive',
                        status: 'locked'
                    },
                    {
                        id: 4,
                        icon: '🎭',
                        title: 'Story Master',
                        description: 'Tüm premium hikayeleri tamamla',
                        badge: 'Yeni',
                        badgeType: 'new',
                        status: 'unlocked'
                    },
                    {
                        id: 5,
                        icon: '🔮',
                        title: 'Neural Oracle',
                        description: 'Özel neural fragment bonusu',
                        badge: 'Limited',
                        badgeType: 'limited',
                        status: 'locked'
                    },
                    {
                        id: 6,
                        icon: '🏆',
                        title: 'Champion',
                        description: 'Tüm etkinliklerde birinci ol',
                        badge: 'Exclusive',
                        badgeType: 'exclusive',
                        status: 'locked'
                    }
                ];
                this.init();
            }

            init() {
                console.log('🎁 Premium Rewards Controller Initializing...');
                this.createStarfield();
                this.loadRewards();
                console.log('✅ Premium Rewards Controller Ready!');
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

            loadRewards() {
                const grid = document.getElementById('rewards-grid');
                grid.innerHTML = '<div class="loading">Ödüller yükleniyor...</div>';

                // Simulate AJAX loading
                setTimeout(() => {
                    this.renderRewards();
                }, 800);
            }

            renderRewards() {
                const grid = document.getElementById('rewards-grid');
                
                grid.innerHTML = this.rewards.map(reward => `
                    <div class="reward-card" data-reward-id="${reward.id}" onclick="rewardsController.claimReward(${reward.id})">
                        <div class="reward-card-badge ${reward.badgeType}">${reward.badge}</div>
                        <div class="reward-card-icon">${reward.icon}</div>
                        <h3 class="reward-card-title">${reward.title}</h3>
                        <p class="reward-card-description">${reward.description}</p>
                        <div class="reward-card-status ${reward.status}">
                            ${this.getStatusText(reward.status)}
                        </div>
                    </div>
                `).join('');

                // Add hover effects
                this.setupHoverEffects();
            }

            getStatusText(status) {
                switch(status) {
                    case 'unlocked': return '✅ Kullanılabilir';
                    case 'locked': return '🔒 Kilitli';
                    case 'claimed': return '🎉 Alındı';
                    default: return '❓ Bilinmiyor';
                }
            }

            setupHoverEffects() {
                const cards = document.querySelectorAll('.reward-card');
                cards.forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        this.playHoverSound();
                    });
                });
            }

            claimReward(rewardId) {
                this.playClickSound();
                const reward = this.rewards.find(r => r.id === rewardId);
                
                if (reward) {
                    if (reward.status === 'unlocked') {
                        reward.status = 'claimed';
                        this.showNotification(`${reward.title} ödülü alındı!`);
                        this.renderRewards();
                    } else if (reward.status === 'locked') {
                        this.showNotification('Bu ödül henüz kilitli!');
                    } else {
                        this.showNotification('Bu ödül zaten alınmış!');
                    }
                }
            }

            playHoverSound() {
                if (window.audioManager) {
                    window.audioManager.playSound('hover');
                }
            }

            playClickSound() {
                if (window.audioManager) {
                    window.audioManager.playSound('click');
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

        // Initialize
        let rewardsController;
        document.addEventListener('DOMContentLoaded', function() {
            rewardsController = new PremiumRewardsController();
        });
    </script>
</body>
</html>
