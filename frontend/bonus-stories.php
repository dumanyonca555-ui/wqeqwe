<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();

// Sample bonus stories data
$bonusStories = [
    [
        'id' => 1,
        'title' => 'Leo\'nun Geçmişi: Stratejist\'in Doğuşu',
        'description' => 'Leo\'nun Neural Network\'e katılmadan önceki hayatı ve stratejist olma yolculuğu',
        'image' => 'assets/images/stories/leo-backstory.jpg',
        'category' => 'character',
        'character' => 'Leo',
        'duration' => '15 dakika',
        'unlocked' => true,
        'new' => false,
        'chapters' => 3,
        'rating' => 4.8
    ],
    [
        'id' => 2,
        'title' => 'Chloe\'nin İlk Hack\'i',
        'description' => 'Genç Chloe\'nin teknoloji dünyasına ilk adımları ve büyük keşfi',
        'image' => 'assets/images/stories/chloe-first-hack.jpg',
        'category' => 'character',
        'character' => 'Chloe',
        'duration' => '12 dakika',
        'unlocked' => true,
        'new' => true,
        'chapters' => 2,
        'rating' => 4.9
    ],
    [
        'id' => 3,
        'title' => 'Felix ve Müzik: Kalbin Melodisi',
        'description' => 'Felix\'in müzik tutkusu ve duygusal yolculuğu',
        'image' => 'assets/images/stories/felix-music.jpg',
        'category' => 'character',
        'character' => 'Felix',
        'duration' => '18 dakika',
        'unlocked' => false,
        'new' => false,
        'chapters' => 4,
        'rating' => 4.7
    ],
    [
        'id' => 4,
        'title' => 'Elara\'nın Sırrı: Mentor\'un Geçmişi',
        'description' => 'Elara\'nın gizemli geçmişi ve Neural Network\'teki gerçek rolü',
        'image' => 'assets/images/stories/elara-secret.jpg',
        'category' => 'character',
        'character' => 'Elara',
        'duration' => '25 dakika',
        'unlocked' => false,
        'new' => false,
        'chapters' => 5,
        'rating' => 5.0
    ],
    [
        'id' => 5,
        'title' => 'Kozmik Festival\'in Ardındaki Hikaye',
        'description' => 'Şehrin en büyük etkinliğinin bilinmeyen yönleri',
        'image' => 'assets/images/stories/festival-behind.jpg',
        'category' => 'event',
        'character' => null,
        'duration' => '20 dakika',
        'unlocked' => true,
        'new' => true,
        'chapters' => 3,
        'rating' => 4.6
    ],
    [
        'id' => 6,
        'title' => 'Neural Network\'ün Kuruluşu',
        'description' => 'Platformun nasıl kurulduğu ve ilk günlerin hikayesi',
        'image' => 'assets/images/stories/network-foundation.jpg',
        'category' => 'lore',
        'character' => null,
        'duration' => '30 dakika',
        'unlocked' => false,
        'new' => false,
        'chapters' => 6,
        'rating' => 4.9
    ]
];

$categories = [
    'all' => 'Tümü',
    'character' => 'Karakter Hikayeleri',
    'event' => 'Etkinlik Hikayeleri',
    'lore' => 'Dünya Tarihi'
];
?>

<div class="content-container">
    <!-- Bonus Stories Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">📖</div>
            <div class="header-info">
                <h1 class="page-title">Bonus Hikayeler</h1>
                <p class="page-description">Karakterlerin geçmişi ve dünyamızın derinliklerini keşfedin</p>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($bonusStories, fn($story) => $story['unlocked'])); ?></span>
                <span class="stat-label">Açılmış</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($bonusStories, fn($story) => $story['new'])); ?></span>
                <span class="stat-label">Yeni</span>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="filter-tabs">
        <?php foreach ($categories as $key => $name): ?>
        <button class="filter-tab <?php echo $key === 'all' ? 'active' : ''; ?>" 
                onclick="filterStories('<?php echo $key; ?>')" 
                data-category="<?php echo $key; ?>">
            <?php echo $name; ?>
        </button>
        <?php endforeach; ?>
    </div>

    <!-- Stories Grid -->
    <div class="stories-grid">
        <?php foreach ($bonusStories as $story): ?>
        <div class="story-card <?php echo $story['unlocked'] ? 'unlocked' : 'locked'; ?>" 
             data-category="<?php echo $story['category']; ?>"
             onclick="<?php echo $story['unlocked'] ? "openStory({$story['id']})" : "showNotification('Bu hikaye henüz açılmamış!')"; ?>">
            
            <div class="story-image">
                <img src="<?php echo $story['image']; ?>" alt="<?php echo htmlspecialchars($story['title']); ?>" loading="lazy">
                
                <?php if (!$story['unlocked']): ?>
                <div class="locked-overlay">
                    <div class="lock-icon">🔒</div>
                </div>
                <?php endif; ?>
                
                <?php if ($story['new']): ?>
                <div class="new-badge">YENİ</div>
                <?php endif; ?>
                
                <div class="story-duration">
                    <span class="duration-icon">⏱️</span>
                    <span class="duration-text"><?php echo $story['duration']; ?></span>
                </div>
            </div>
            
            <div class="story-content">
                <div class="story-header">
                    <h3 class="story-title"><?php echo htmlspecialchars($story['title']); ?></h3>
                    <div class="story-rating">
                        <span class="rating-stars">
                            <?php 
                            $fullStars = floor($story['rating']);
                            $hasHalfStar = $story['rating'] - $fullStars >= 0.5;
                            
                            for ($i = 0; $i < $fullStars; $i++) echo '⭐';
                            if ($hasHalfStar) echo '⭐';
                            ?>
                        </span>
                        <span class="rating-value"><?php echo $story['rating']; ?></span>
                    </div>
                </div>
                
                <p class="story-description"><?php echo htmlspecialchars($story['description']); ?></p>
                
                <div class="story-meta">
                    <div class="meta-item">
                        <span class="meta-icon">📚</span>
                        <span class="meta-text"><?php echo $story['chapters']; ?> bölüm</span>
                    </div>
                    
                    <?php if ($story['character']): ?>
                    <div class="meta-item">
                        <span class="meta-icon">👤</span>
                        <span class="meta-text"><?php echo $story['character']; ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="meta-item">
                        <span class="meta-icon">🏷️</span>
                        <span class="meta-text"><?php echo $categories[$story['category']]; ?></span>
                    </div>
                </div>
                
                <?php if ($story['unlocked']): ?>
                <div class="story-actions">
                    <button class="action-btn primary" onclick="event.stopPropagation(); readStory(<?php echo $story['id']; ?>)">
                        <span class="btn-icon">📖</span>
                        <span class="btn-text">Oku</span>
                    </button>
                    <button class="action-btn secondary" onclick="event.stopPropagation(); favoriteStory(<?php echo $story['id']; ?>)">
                        <span class="btn-icon">⭐</span>
                        <span class="btn-text">Favorile</span>
                    </button>
                </div>
                <?php else: ?>
                <div class="unlock-requirement">
                    <span class="unlock-icon">🔓</span>
                    <span class="unlock-text">Ana hikayeyi ilerlet</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Reading Progress -->
    <div class="reading-progress-card">
        <div class="progress-header">
            <h3>Okuma İlerlemen</h3>
            <span class="progress-percentage">60%</span>
        </div>
        <div class="progress-details">
            <div class="progress-item">
                <span class="progress-label">Okunan Hikayeler</span>
                <span class="progress-value">3/5</span>
            </div>
            <div class="progress-item">
                <span class="progress-label">Toplam Okuma Süresi</span>
                <span class="progress-value">2 saat 15 dakika</span>
            </div>
            <div class="progress-item">
                <span class="progress-label">Favori Hikayeler</span>
                <span class="progress-value">2</span>
            </div>
        </div>
        <div class="achievement-hint">
            <span class="hint-icon">🏆</span>
            <span class="hint-text">Tüm bonus hikayeleri oku ve özel rozet kazan!</span>
        </div>
    </div>
</div>

<script>
const storiesData = <?php echo json_encode($bonusStories); ?>;

function filterStories(category) {
    const cards = document.querySelectorAll('.story-card');
    const tabs = document.querySelectorAll('.filter-tab');
    
    // Update active tab
    tabs.forEach(tab => {
        tab.classList.toggle('active', tab.dataset.category === category);
    });
    
    // Filter cards
    cards.forEach(card => {
        const cardCategory = card.dataset.category;
        const shouldShow = category === 'all' || cardCategory === category;
        card.style.display = shouldShow ? 'block' : 'none';
    });
    
    // Play click sound
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
}

function openStory(storyId) {
    const story = storiesData.find(s => s.id === storyId);
    if (!story || !story.unlocked) return;
    
    showNotification(`"${story.title}" hikayesi açılıyor...`);
    
    // In a real implementation, this would open the story reader
    setTimeout(() => {
        readStory(storyId);
    }, 1000);
}

function readStory(storyId) {
    const story = storiesData.find(s => s.id === storyId);
    if (!story) return;
    
    // In a real implementation, this would navigate to the story reader
    showNotification(`"${story.title}" okunmaya başlanıyor...`);
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
    
    // Simulate navigation to story reader
    setTimeout(() => {
        // window.location.href = `story-reader.php?story=${storyId}`;
        showNotification('Hikaye okuyucu yakında eklenecek!');
    }, 1500);
}

function favoriteStory(storyId) {
    const story = storiesData.find(s => s.id === storyId);
    if (!story) return;
    
    showNotification(`"${story.title}" favorilere eklendi!`);
    
    // Update UI
    const storyCard = event.target.closest('.story-card');
    const favoriteBtn = storyCard.querySelector('.action-btn.secondary');
    favoriteBtn.innerHTML = '<span class="btn-icon">⭐</span><span class="btn-text">Favorilendi</span>';
    favoriteBtn.classList.add('favorited');
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
}

// Add hover effects to story cards
document.querySelectorAll('.story-card.unlocked').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
