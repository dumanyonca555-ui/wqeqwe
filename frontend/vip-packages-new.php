<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Paketler - Celestial Tale</title>
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

        .packages-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-lg);
        }

        .packages-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .packages-title {
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

        .packages-subtitle {
            color: var(--color4);
            font-size: 1rem;
            font-family: 'Montserrat', sans-serif;
        }

        /* Packages Grid - Mobile First */
        .packages-grid {
            display: grid;
            grid-template-columns: 1fr; /* Mobile: 1 column */
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        /* Tablet: 2 columns */
        @media (min-width: 768px) {
            .packages-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Desktop: 3 columns */
        @media (min-width: 1024px) {
            .packages-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .package-card {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-lg);
            transition: var(--transition-normal);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 400px;
        }

        .package-card:hover {
            border: 1px solid var(--glass-border-strong);
            box-shadow: var(--shadow-glow);
            transform: translateY(-4px);
        }

        .package-card.popular {
            border: 2px solid var(--color3);
            background: linear-gradient(135deg, 
                rgba(123, 159, 255, 0.1) 0%, 
                rgba(132, 21, 103, 0.1) 50%, 
                rgba(36, 15, 72, 0.1) 100%);
        }

        .package-card.premium {
            border: 2px solid var(--color2);
            background: linear-gradient(135deg, 
                rgba(132, 21, 103, 0.1) 0%, 
                rgba(36, 15, 72, 0.1) 100%);
        }

        .package-card-header {
            text-align: center;
            margin-bottom: var(--spacing-lg);
        }

        .package-card-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto var(--spacing-md);
            transition: var(--transition-normal);
        }

        .package-card:hover .package-card-icon {
            transform: scale(1.1);
        }

        .package-card-title {
            color: var(--color5);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: var(--spacing-xs);
            font-family: 'Montserrat', sans-serif;
        }

        .package-card-price {
            color: var(--color3);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: var(--spacing-xs);
            font-family: 'Montserrat', sans-serif;
        }

        .package-card-period {
            color: var(--color4);
            font-size: 0.8rem;
            font-family: 'Montserrat', sans-serif;
        }

        .package-card-features {
            flex: 1;
            margin: var(--spacing-lg) 0;
        }

        .package-feature {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-sm);
            color: var(--color4);
            font-size: 0.9rem;
            font-family: 'Montserrat', sans-serif;
        }

        .package-feature-icon {
            color: var(--color3);
            font-weight: bold;
        }

        .package-card-button {
            background: var(--gradient-secondary);
            color: var(--color5);
            border: none;
            border-radius: var(--radius-md);
            padding: var(--spacing-md) var(--spacing-lg);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition-normal);
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            margin-top: auto;
        }

        .package-card-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .package-card-badge {
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

        .package-card-badge.popular {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .package-card-badge.best-value {
            background: linear-gradient(135deg, #f59e0b, #d97706);
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

        /* Purchase Modal */
        .purchase-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(var(--blur-md));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .purchase-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .purchase-modal-content {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--blur-md));
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-xl);
            padding: var(--spacing-xl);
            max-width: 400px;
            width: 90%;
            text-align: center;
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }

        .purchase-modal.active .purchase-modal-content {
            transform: scale(1);
        }

        .purchase-modal-title {
            color: var(--color5);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: var(--spacing-md);
            font-family: 'Montserrat', sans-serif;
        }

        .purchase-modal-text {
            color: var(--color4);
            font-size: 0.9rem;
            margin-bottom: var(--spacing-lg);
            font-family: 'Montserrat', sans-serif;
        }

        .purchase-modal-buttons {
            display: flex;
            gap: var(--spacing-md);
        }

        .purchase-modal-button {
            flex: 1;
            padding: var(--spacing-sm) var(--spacing-md);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-normal);
            font-family: 'Montserrat', sans-serif;
        }

        .purchase-modal-button.confirm {
            background: var(--gradient-secondary);
            color: var(--color5);
        }

        .purchase-modal-button.cancel {
            background: var(--glass-bg);
            color: var(--color4);
            border: 1px solid var(--glass-border);
        }
    </style>
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <main class="main-container">
        <div id="ajax-content" class="content-container">
            <div class="packages-container">
                <!-- Back Button -->
                <div class="back-section">
                    <a href="premium.php" class="back-button">
                        ← Premium'a Dön
                    </a>
                </div>

                <!-- Page Header -->
                <div class="packages-header">
                    <h1 class="packages-title">💎 VIP Paketler</h1>
                    <p class="packages-subtitle">Neural Fragment paketleri ve özel içerik erişimi</p>
                </div>

                <!-- Packages Grid -->
                <div class="packages-grid" id="packages-grid">
                    <!-- Packages will be loaded here -->
                </div>
            </div>
        </div>
        
        <!-- Purchase Modal -->
        <div class="purchase-modal" id="purchase-modal">
            <div class="purchase-modal-content">
                <h3 class="purchase-modal-title" id="modal-title">Satın Alma Onayı</h3>
                <p class="purchase-modal-text" id="modal-text">Bu paketi satın almak istediğinizden emin misiniz?</p>
                <div class="purchase-modal-buttons">
                    <button class="purchase-modal-button cancel" onclick="packagesController.closePurchaseModal()">İptal</button>
                    <button class="purchase-modal-button confirm" onclick="packagesController.confirmPurchase()">Satın Al</button>
                </div>
            </div>
        </div>
        
        <div class="floating-particles"></div>
    </main>
    
    <script src="assets/js/navigation.js"></script>
    <script>
        // VIP Packages Controller
        class VIPPackagesController {
            constructor() {
                this.packages = [
                    {
                        id: 1,
                        icon: '🌟',
                        title: 'Başlangıç Paketi',
                        price: '₺29',
                        period: '/ay',
                        badge: 'Popüler',
                        badgeType: 'popular',
                        cardType: 'popular',
                        features: [
                            '500 Neural Fragment',
                            '2 Premium Hikaye Erişimi',
                            'Özel Rozetler',
                            'Reklamsız Deneyim',
                            'Öncelikli Destek'
                        ]
                    },
                    {
                        id: 2,
                        icon: '💎',
                        title: 'Premium Paketi',
                        price: '₺49',
                        period: '/ay',
                        badge: 'En Değerli',
                        badgeType: 'best-value',
                        cardType: 'premium',
                        features: [
                            '1200 Neural Fragment',
                            'Tüm Premium Hikayeler',
                            'Exclusive İçerikler',
                            'Özel Karakterler',
                            'VIP Chat Odaları',
                            'Erken Erişim'
                        ]
                    },
                    {
                        id: 3,
                        icon: '👑',
                        title: 'VIP Elite',
                        price: '₺99',
                        period: '/ay',
                        badge: 'Elite',
                        badgeType: 'elite',
                        cardType: 'premium',
                        features: [
                            '3000 Neural Fragment',
                            'Sınırsız İçerik Erişimi',
                            'Özel AI Karakterler',
                            'Kişisel Hikaye Yazımı',
                            'VIP Etkinlikler',
                            'Özel Müzik Paketi',
                            '7/24 Premium Destek'
                        ]
                    }
                ];
                this.currentPackage = null;
                this.init();
            }

            init() {
                console.log('💎 VIP Packages Controller Initializing...');
                this.createStarfield();
                this.loadPackages();
                console.log('✅ VIP Packages Controller Ready!');
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

            loadPackages() {
                const grid = document.getElementById('packages-grid');
                grid.innerHTML = '<div class="loading">Paketler yükleniyor...</div>';

                // Simulate AJAX loading
                setTimeout(() => {
                    this.renderPackages();
                }, 800);
            }

            renderPackages() {
                const grid = document.getElementById('packages-grid');

                grid.innerHTML = this.packages.map(pkg => `
                    <div class="package-card ${pkg.cardType}" data-package-id="${pkg.id}">
                        <div class="package-card-badge ${pkg.badgeType}">${pkg.badge}</div>
                        <div class="package-card-header">
                            <div class="package-card-icon">${pkg.icon}</div>
                            <h3 class="package-card-title">${pkg.title}</h3>
                            <div class="package-card-price">${pkg.price}</div>
                            <div class="package-card-period">${pkg.period}</div>
                        </div>
                        <div class="package-card-features">
                            ${pkg.features.map(feature => `
                                <div class="package-feature">
                                    <span class="package-feature-icon">✓</span>
                                    <span>${feature}</span>
                                </div>
                            `).join('')}
                        </div>
                        <button class="package-card-button" onclick="packagesController.purchasePackage(${pkg.id})">
                            Satın Al
                        </button>
                    </div>
                `).join('');

                // Add hover effects
                this.setupHoverEffects();
            }

            setupHoverEffects() {
                const cards = document.querySelectorAll('.package-card');
                cards.forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        this.playHoverSound();
                    });
                });
            }

            purchasePackage(packageId) {
                this.playClickSound();
                this.currentPackage = this.packages.find(p => p.id === packageId);

                if (this.currentPackage) {
                    document.getElementById('modal-title').textContent = `${this.currentPackage.title} Satın Al`;
                    document.getElementById('modal-text').textContent =
                        `${this.currentPackage.title} paketini ${this.currentPackage.price}${this.currentPackage.period} fiyatıyla satın almak istediğinizden emin misiniz?`;

                    const modal = document.getElementById('purchase-modal');
                    modal.classList.add('active');
                }
            }

            closePurchaseModal() {
                const modal = document.getElementById('purchase-modal');
                modal.classList.remove('active');
                this.currentPackage = null;
            }

            confirmPurchase() {
                if (this.currentPackage) {
                    this.playNotificationSound();
                    this.showNotification(`${this.currentPackage.title} başarıyla satın alındı! 🎉`);
                    this.closePurchaseModal();

                    // Simulate purchase success
                    setTimeout(() => {
                        this.showNotification('Neural Fragment\'lar hesabınıza eklendi!');
                    }, 2000);
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

            playNotificationSound() {
                if (window.audioManager) {
                    window.audioManager.playSound('notification');
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
                    z-index: 1001;
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
                }, 4000);
            }
        }

        // Initialize
        let packagesController;
        document.addEventListener('DOMContentLoaded', function() {
            packagesController = new VIPPackagesController();
        });
    </script>
</body>
</html>
