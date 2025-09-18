<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();

// Sample rewards data
$rewards = [
    [
        'id' => 1,
        'title' => 'Günlük Giriş Bonusu',
        'description' => '7 gün üst üste giriş yaptın!',
        'type' => 'daily',
        'icon' => '🎁',
        'reward' => '100 Neural Fragment',
        'claimed' => true,
        'date_earned' => '2024-03-15',
        'rarity' => 'common'
    ],
    [
        'id' => 2,
        'title' => 'Kozmik Festival Rozeti',
        'description' => 'Festival etkinliğini başarıyla tamamladın',
        'type' => 'achievement',
        'icon' => '🏆',
        'reward' => 'Özel Rozet + 500 Neural Fragment',
        'claimed' => true,
        'date_earned' => '2024-03-20',
        'rarity' => 'legendary'
    ],
    [
        'id' => 3,
        'title' => 'Leo ile Yakınlık',
        'description' => 'Leo ile affinity seviyesi 75\'e ulaştı',
        'type' => 'character',
        'icon' => '💙',
        'reward' => 'Özel CG + 200 Neural Fragment',
        'claimed' => false,
        'date_earned' => '2024-03-22',
        'rarity' => 'rare'
    ],
    [
        'id' => 4,
        'title' => 'Hikaye Ustası',
        'description' => 'Ana hikayenin 5. bölümünü tamamladın',
        'type' => 'story',
        'icon' => '📖',
        'reward' => '300 Neural Fragment + XP Bonusu',
        'claimed' => false,
        'date_earned' => '2024-03-21',
        'rarity' => 'epic'
    ],
    [
        'id' => 5,
        'title' => 'Koleksiyoncu',
        'description' => 'Galeride 20 görsel açtın',
        'type' => 'collection',
        'icon' => '🖼️',
        'reward' => 'Özel Galeri Teması',
        'claimed' => true,
        'date_earned' => '2024-03-18',
        'rarity' => 'rare'
    ],
    [
        'id' => 6,
        'title' => 'Sosyal Kelebek',
        'description' => 'Tüm karakterlerle sohbet ettin',
        'type' => 'social',
        'icon' => '💬',
        'reward' => 'Grup Sohbet Odası Açıldı',
        'claimed' => false,
        'date_earned' => '2024-03-23',
        'rarity' => 'epic'
    ]
];

$rewardTypes = [
    'all' => 'Tümü',
    'daily' => 'Günlük',
    'achievement' => 'Başarım',
    'character' => 'Karakter',
    'story' => 'Hikaye',
    'collection' => 'Koleksiyon',
    'social' => 'Sosyal'
];

$rarityColors = [
    'common' => '#9ca3af',
    'rare' => '#3b82f6',
    'epic' => '#8b5cf6',
    'legendary' => '#f59e0b'
];

function getRarityText($rarity) {
    switch ($rarity) {
        case 'common': return 'Yaygın';
        case 'rare': return 'Nadir';
        case 'epic': return 'Epik';
        case 'legendary': return 'Efsanevi';
        default: return 'Bilinmiyor';
    }
}
?>

<div class="content-container">
    <!-- Rewards Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">🏆</div>
            <div class="header-info">
                <h1 class="page-title">Ödüller & Başarımlar</h1>
                <p class="page-description">Kazandığın ödüller ve başarımları görüntüle</p>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($rewards, fn($reward) => $reward['claimed'])); ?></span>
                <span class="stat-label">Alınan</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($rewards, fn($reward) => !$reward['claimed'])); ?></span>
                <span class="stat-label">Bekleyen</span>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="quick-stats">
        <div class="stat-card">
            <div class="stat-icon">💎</div>
            <div class="stat-info">
                <div class="stat-value">2,450</div>
                <div class="stat-label">Toplam Neural Fragment</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🏅</div>
            <div class="stat-info">
                <div class="stat-value">12</div>
                <div class="stat-label">Toplam Rozet</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⭐</div>
            <div class="stat-info">
                <div class="stat-value">3</div>
                <div class="stat-label">Efsanevi Ödül</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📈</div>
            <div class="stat-info">
                <div class="stat-value">85%</div>
                <div class="stat-label">Tamamlanma Oranı</div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <?php foreach ($rewardTypes as $key => $name): ?>
        <button class="filter-tab <?php echo $key === 'all' ? 'active' : ''; ?>" 
                onclick="filterRewards('<?php echo $key; ?>')" 
                data-type="<?php echo $key; ?>">
            <?php echo $name; ?>
        </button>
        <?php endforeach; ?>
    </div>

    <!-- Pending Rewards -->
    <?php $pendingRewards = array_filter($rewards, fn($reward) => !$reward['claimed']); ?>
    <?php if (!empty($pendingRewards)): ?>
    <div class="rewards-section">
        <h2 class="section-title">🎁 Bekleyen Ödüller</h2>
        <div class="rewards-grid">
            <?php foreach ($pendingRewards as $reward): ?>
            <div class="reward-card pending-reward <?php echo $reward['rarity']; ?>" 
                 data-type="<?php echo $reward['type']; ?>"
                 onclick="claimReward(<?php echo $reward['id']; ?>)">
                
                <div class="reward-header">
                    <div class="reward-icon"><?php echo $reward['icon']; ?></div>
                    <div class="reward-rarity" style="color: <?php echo $rarityColors[$reward['rarity']]; ?>">
                        <?php echo getRarityText($reward['rarity']); ?>
                    </div>
                </div>
                
                <div class="reward-content">
                    <h3 class="reward-title"><?php echo htmlspecialchars($reward['title']); ?></h3>
                    <p class="reward-description"><?php echo htmlspecialchars($reward['description']); ?></p>
                    
                    <div class="reward-prize">
                        <span class="prize-icon">🎁</span>
                        <span class="prize-text"><?php echo $reward['reward']; ?></span>
                    </div>
                    
                    <div class="reward-date">
                        <span class="date-icon">📅</span>
                        <span class="date-text">Kazanıldı: <?php echo date('d.m.Y', strtotime($reward['date_earned'])); ?></span>
                    </div>
                </div>
                
                <div class="reward-actions">
                    <button class="claim-btn" onclick="event.stopPropagation(); claimReward(<?php echo $reward['id']; ?>)">
                        <span class="btn-icon">🎁</span>
                        <span class="btn-text">Ödülü Al</span>
                    </button>
                </div>
                
                <div class="reward-glow"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Claimed Rewards -->
    <?php $claimedRewards = array_filter($rewards, fn($reward) => $reward['claimed']); ?>
    <div class="rewards-section">
        <h2 class="section-title">✅ Alınan Ödüller</h2>
        <div class="rewards-grid">
            <?php foreach ($claimedRewards as $reward): ?>
            <div class="reward-card claimed-reward <?php echo $reward['rarity']; ?>" 
                 data-type="<?php echo $reward['type']; ?>">
                
                <div class="reward-header">
                    <div class="reward-icon"><?php echo $reward['icon']; ?></div>
                    <div class="reward-rarity" style="color: <?php echo $rarityColors[$reward['rarity']]; ?>">
                        <?php echo getRarityText($reward['rarity']); ?>
                    </div>
                    <div class="claimed-badge">✅</div>
                </div>
                
                <div class="reward-content">
                    <h3 class="reward-title"><?php echo htmlspecialchars($reward['title']); ?></h3>
                    <p class="reward-description"><?php echo htmlspecialchars($reward['description']); ?></p>
                    
                    <div class="reward-prize">
                        <span class="prize-icon">🎁</span>
                        <span class="prize-text"><?php echo $reward['reward']; ?></span>
                    </div>
                    
                    <div class="reward-date">
                        <span class="date-icon">📅</span>
                        <span class="date-text">Alındı: <?php echo date('d.m.Y', strtotime($reward['date_earned'])); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Achievement Progress -->
    <div class="achievement-progress">
        <h2 class="section-title">📊 Başarım İlerlemen</h2>
        
        <div class="progress-categories">
            <div class="progress-category">
                <div class="category-header">
                    <span class="category-icon">📖</span>
                    <span class="category-name">Hikaye İlerlemesi</span>
                    <span class="category-progress">5/10</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 50%"></div>
                </div>
            </div>
            
            <div class="progress-category">
                <div class="category-header">
                    <span class="category-icon">💙</span>
                    <span class="category-name">Karakter İlişkileri</span>
                    <span class="category-progress">3/4</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 75%"></div>
                </div>
            </div>
            
            <div class="progress-category">
                <div class="category-header">
                    <span class="category-icon">🖼️</span>
                    <span class="category-name">Koleksiyon</span>
                    <span class="category-progress">20/50</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 40%"></div>
                </div>
            </div>
            
            <div class="progress-category">
                <div class="category-header">
                    <span class="category-icon">🎉</span>
                    <span class="category-name">Etkinlikler</span>
                    <span class="category-progress">8/15</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 53%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const rewardsData = <?php echo json_encode($rewards); ?>;

function filterRewards(type) {
    const cards = document.querySelectorAll('.reward-card');
    const tabs = document.querySelectorAll('.filter-tab');
    
    // Update active tab
    tabs.forEach(tab => {
        tab.classList.toggle('active', tab.dataset.type === type);
    });
    
    // Filter cards
    cards.forEach(card => {
        const cardType = card.dataset.type;
        const shouldShow = type === 'all' || cardType === type;
        card.style.display = shouldShow ? 'block' : 'none';
    });
    
    // Play click sound
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
}

function claimReward(rewardId) {
    const reward = rewardsData.find(r => r.id === rewardId);
    if (!reward || reward.claimed) return;
    
    showNotification(`Ödül alındı: ${reward.reward} 🎉`);
    
    // Update UI
    const rewardCard = event.target.closest('.reward-card');
    rewardCard.classList.remove('pending-reward');
    rewardCard.classList.add('claimed-reward');
    
    // Add claimed badge
    const header = rewardCard.querySelector('.reward-header');
    if (!header.querySelector('.claimed-badge')) {
        const badge = document.createElement('div');
        badge.className = 'claimed-badge';
        badge.textContent = '✅';
        header.appendChild(badge);
    }
    
    // Remove claim button
    const actions = rewardCard.querySelector('.reward-actions');
    if (actions) {
        actions.remove();
    }
    
    // Update date text
    const dateText = rewardCard.querySelector('.date-text');
    if (dateText) {
        dateText.textContent = 'Alındı: ' + new Date().toLocaleDateString('tr-TR');
    }
    
    // Remove glow effect
    const glow = rewardCard.querySelector('.reward-glow');
    if (glow) {
        glow.remove();
    }
    
    // Move to claimed section
    setTimeout(() => {
        const claimedSection = document.querySelector('.rewards-section:last-of-type .rewards-grid');
        claimedSection.appendChild(rewardCard);
    }, 1000);
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
    
    // Update reward data
    reward.claimed = true;
}

// Add hover effects to pending rewards
document.querySelectorAll('.pending-reward').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.05)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// Add sparkle animation to legendary rewards
document.querySelectorAll('.reward-card.legendary').forEach(card => {
    setInterval(() => {
        card.classList.add('sparkle');
        setTimeout(() => {
            card.classList.remove('sparkle');
        }, 1000);
    }, 3000);
});
</script>
