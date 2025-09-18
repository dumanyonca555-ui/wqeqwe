<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();

// Sample gallery data
$galleryItems = [
    [
        'id' => 1,
        'title' => 'Leo ile İlk Karşılaşma',
        'description' => 'Neural Network\'te Leo ile tanışma anı',
        'image' => 'assets/images/gallery/leo-first-meeting.jpg',
        'category' => 'character',
        'unlocked' => true,
        'date' => '2024-01-15'
    ],
    [
        'id' => 2,
        'title' => 'Kozmik Festival',
        'description' => 'Şehirdeki büyük festival sahnesi',
        'image' => 'assets/images/gallery/cosmic-festival.jpg',
        'category' => 'event',
        'unlocked' => true,
        'date' => '2024-01-20'
    ],
    [
        'id' => 3,
        'title' => 'Chloe\'nin Hacker Odası',
        'description' => 'Chloe\'nin gizli teknoloji merkezi',
        'image' => 'assets/images/gallery/chloe-hacker-room.jpg',
        'category' => 'location',
        'unlocked' => true,
        'date' => '2024-01-25'
    ],
    [
        'id' => 4,
        'title' => 'Felix ile Romantik Sahne',
        'description' => 'Çatı katında yıldızları izleme',
        'image' => 'assets/images/gallery/felix-romantic.jpg',
        'category' => 'romance',
        'unlocked' => false,
        'date' => '2024-02-01'
    ],
    [
        'id' => 5,
        'title' => 'Elara\'nın Sırrı',
        'description' => 'Mentor Elara\'nın geçmişi hakkında ipuçları',
        'image' => 'assets/images/gallery/elara-secret.jpg',
        'category' => 'story',
        'unlocked' => false,
        'date' => '2024-02-05'
    ]
];

$categories = [
    'all' => 'Tümü',
    'character' => 'Karakterler',
    'event' => 'Etkinlikler',
    'location' => 'Lokasyonlar',
    'romance' => 'Romantik',
    'story' => 'Hikaye'
];
?>

<div class="content-container">
    <!-- Gallery Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">🖼️</div>
            <div class="header-info">
                <h1 class="page-title">CG Galerisi</h1>
                <p class="page-description">Oyun içi görselleri ve özel sahneleri keşfedin</p>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($galleryItems, fn($item) => $item['unlocked'])); ?></span>
                <span class="stat-label">Açılmış</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo count($galleryItems); ?></span>
                <span class="stat-label">Toplam</span>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="filter-tabs">
        <?php foreach ($categories as $key => $name): ?>
        <button class="filter-tab <?php echo $key === 'all' ? 'active' : ''; ?>" 
                onclick="filterGallery('<?php echo $key; ?>')" 
                data-category="<?php echo $key; ?>">
            <?php echo $name; ?>
        </button>
        <?php endforeach; ?>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid">
        <?php foreach ($galleryItems as $item): ?>
        <div class="gallery-item <?php echo $item['unlocked'] ? 'unlocked' : 'locked'; ?>" 
             data-category="<?php echo $item['category']; ?>"
             onclick="<?php echo $item['unlocked'] ? "openGalleryModal({$item['id']})" : "showNotification('Bu görsel henüz açılmamış!')"; ?>">
            
            <div class="gallery-image">
                <?php if ($item['unlocked']): ?>
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy">
                <?php else: ?>
                    <div class="locked-overlay">
                        <div class="lock-icon">🔒</div>
                        <span class="lock-text">Kilitli</span>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="gallery-info">
                <h3 class="gallery-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                <p class="gallery-description"><?php echo htmlspecialchars($item['description']); ?></p>
                <div class="gallery-meta">
                    <span class="gallery-category"><?php echo $categories[$item['category']]; ?></span>
                    <span class="gallery-date"><?php echo date('d.m.Y', strtotime($item['date'])); ?></span>
                </div>
            </div>
            
            <?php if (!$item['unlocked']): ?>
            <div class="unlock-badge">
                <span class="unlock-text">Hikayeyi ilerlet</span>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Gallery Modal -->
    <div id="gallery-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title"></h2>
                <button class="modal-close" onclick="closeGalleryModal()">&times;</button>
            </div>
            <div class="modal-body">
                <img id="modal-image" src="" alt="">
                <p id="modal-description"></p>
                <div class="modal-meta">
                    <span id="modal-category"></span>
                    <span id="modal-date"></span>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn-secondary" onclick="downloadImage()">İndir</button>
                <button class="btn" onclick="shareImage()">Paylaş</button>
            </div>
        </div>
    </div>
</div>

<script>
// Gallery functionality
function filterGallery(category) {
    const items = document.querySelectorAll('.gallery-item');
    const tabs = document.querySelectorAll('.filter-tab');
    
    // Update active tab
    tabs.forEach(tab => {
        tab.classList.toggle('active', tab.dataset.category === category);
    });
    
    // Filter items
    items.forEach(item => {
        const itemCategory = item.dataset.category;
        const shouldShow = category === 'all' || itemCategory === category;
        item.style.display = shouldShow ? 'block' : 'none';
    });
    
    // Play click sound
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
}

function openGalleryModal(itemId) {
    const galleryData = <?php echo json_encode($galleryItems); ?>;
    const item = galleryData.find(i => i.id === itemId);
    
    if (!item) return;
    
    document.getElementById('modal-title').textContent = item.title;
    document.getElementById('modal-image').src = item.image;
    document.getElementById('modal-description').textContent = item.description;
    document.getElementById('modal-category').textContent = '<?php echo json_encode($categories); ?>'[item.category];
    document.getElementById('modal-date').textContent = new Date(item.date).toLocaleDateString('tr-TR');
    
    document.getElementById('gallery-modal').classList.add('show');
    
    // Play notification sound
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
}

function closeGalleryModal() {
    document.getElementById('gallery-modal').classList.remove('show');
}

function downloadImage() {
    const imageUrl = document.getElementById('modal-image').src;
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = document.getElementById('modal-title').textContent + '.jpg';
    link.click();
    
    showNotification('Görsel indiriliyor...');
}

function shareImage() {
    if (navigator.share) {
        navigator.share({
            title: document.getElementById('modal-title').textContent,
            text: document.getElementById('modal-description').textContent,
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href);
        showNotification('Link panoya kopyalandı!');
    }
}

// Close modal when clicking outside
document.getElementById('gallery-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeGalleryModal();
    }
});
</script>
