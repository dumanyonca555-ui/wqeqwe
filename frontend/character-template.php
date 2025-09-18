<?php
// Character Template - This file is included by specific character pages
// Character data should be passed from the calling script

if (!isset($character_data)) {
    $character_data = [
        'id' => 'unknown',
        'name' => 'Unknown Character',
        'title' => 'Mystery Person',
        'description' => 'A mysterious character.',
        'affinity' => 0,
        'status' => 'offline',
        'personality' => 'Unknown personality',
        'age' => '??',
        'occupation' => 'Unknown',
        'hobbies' => 'Unknown',
        'active_hours' => 'Unknown',
        'avatar' => 'assets/images/characters/default-avatar.jpg',
        'background' => 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)',
        'theme_color' => '#7b9fff',
        'messages_count' => 0,
        'stories_unlocked' => 0,
        'achievements' => 0,
        'last_seen' => 'Bilinmiyor',
        'relationship_status' => 'Tanışmadınız',
        'favorite_topics' => ['Genel'],
        'special_abilities' => ['Bilinmiyor'],
        'story_progress' => [
            'main_story' => 0,
            'personal_route' => 0,
            'side_stories' => 0
        ]
    ];
}
?>

<div class="content-container character-page" data-character="<?php echo $character_data['id']; ?>">
    <!-- Character Header -->
    <div class="character-header">
        <div class="character-avatar-section">
            <div class="character-avatar-container">
                <img src="assets/images/characters/<?php echo $character_data['id']; ?>-portrait.png"
                     alt="<?php echo $character_data['name']; ?>"
                     class="character-avatar-large"
                     onerror="this.src='assets/images/characters/leo-portrait.png'">
                <div class="status-indicator <?php echo $character_data['status']; ?>"></div>
            </div>
            <div class="affinity-ring" data-affinity="<?php echo $character_data['affinity']; ?>">
                <svg class="affinity-circle" width="100" height="100">
                    <circle cx="50" cy="50" r="45" stroke="rgba(255,255,255,0.2)" stroke-width="4" fill="none"/>
                    <circle cx="50" cy="50" r="45" stroke="<?php echo $character_data['theme_color']; ?>" 
                            stroke-width="4" fill="none" class="affinity-progress"
                            stroke-dasharray="283" stroke-dashoffset="283"/>
                </svg>
                <div class="affinity-text"><?php echo $character_data['affinity']; ?>%</div>
            </div>
        </div>
        
        <div class="character-info">
            <h1 class="character-name"><?php echo $character_data['name']; ?></h1>
            <h2 class="character-title"><?php echo $character_data['title']; ?></h2>
            <p class="character-description"><?php echo $character_data['description']; ?></p>
            
            <div class="character-stats">
                <div class="stat-item">
                    <div class="stat-icon">💬</div>
                    <div class="stat-info">
                        <div class="stat-value"><?php echo $character_data['messages_count']; ?></div>
                        <div class="stat-label">Mesaj</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">📖</div>
                    <div class="stat-info">
                        <div class="stat-value"><?php echo $character_data['stories_unlocked']; ?></div>
                        <div class="stat-label">Hikaye</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">🏆</div>
                    <div class="stat-info">
                        <div class="stat-value"><?php echo $character_data['achievements']; ?></div>
                        <div class="stat-label">Başarım</div>
                    </div>
                </div>
            </div>
            
            <div class="relationship-status">
                <span class="status-label">İlişki Durumu:</span>
                <span class="status-value"><?php echo $character_data['relationship_status']; ?></span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="character-actions">
        <button class="action-btn primary" onclick="startChat('<?php echo $character_data['id']; ?>')">
            <span class="btn-icon">💬</span>
            <span class="btn-text">Chat Başlat</span>
        </button>
        <button class="action-btn secondary" onclick="viewStories('<?php echo $character_data['id']; ?>')">
            <span class="btn-icon">📖</span>
            <span class="btn-text">Hikayeleri Görüntüle</span>
        </button>
        <button class="action-btn tertiary" onclick="viewTasks('<?php echo $character_data['id']; ?>')">
            <span class="btn-icon">📋</span>
            <span class="btn-text">Görevler</span>
        </button>
    </div>

    <!-- Character Details -->
    <div class="character-details">
        <div class="details-grid">
            <!-- Personal Info -->
            <div class="detail-card">
                <h3 class="card-title">👤 Kişisel Bilgiler</h3>
                <div class="detail-list">
                    <div class="detail-item">
                        <span class="detail-label">Yaş:</span>
                        <span class="detail-value"><?php echo $character_data['age']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Meslek:</span>
                        <span class="detail-value"><?php echo $character_data['occupation']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Hobiler:</span>
                        <span class="detail-value"><?php echo $character_data['hobbies']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Aktif Saatler:</span>
                        <span class="detail-value"><?php echo $character_data['active_hours']; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Son Görülme:</span>
                        <span class="detail-value"><?php echo $character_data['last_seen']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Personality -->
            <div class="detail-card">
                <h3 class="card-title">🧠 Kişilik</h3>
                <p class="personality-text"><?php echo $character_data['personality']; ?></p>
                
                <div class="favorite-topics">
                    <h4 class="topics-title">Favori Konular:</h4>
                    <div class="topics-list">
                        <?php foreach ($character_data['favorite_topics'] as $topic): ?>
                            <span class="topic-tag"><?php echo $topic; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Special Abilities -->
            <div class="detail-card">
                <h3 class="card-title">✨ Özel Yetenekler</h3>
                <div class="abilities-list">
                    <?php foreach ($character_data['special_abilities'] as $ability): ?>
                        <div class="ability-item">
                            <span class="ability-icon">⭐</span>
                            <span class="ability-name"><?php echo $ability; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Story Progress -->
    <div class="story-progress-section">
        <h3 class="section-title">📈 Hikaye İlerlemesi</h3>
        <div class="progress-cards">
            <div class="progress-card">
                <div class="progress-header">
                    <span class="progress-icon">📖</span>
                    <span class="progress-title">Ana Hikaye</span>
                    <span class="progress-percentage"><?php echo $character_data['story_progress']['main_story']; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $character_data['story_progress']['main_story']; ?>%"></div>
                </div>
            </div>

            <div class="progress-card">
                <div class="progress-header">
                    <span class="progress-icon">💝</span>
                    <span class="progress-title">Kişisel Rota</span>
                    <span class="progress-percentage"><?php echo $character_data['story_progress']['personal_route']; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $character_data['story_progress']['personal_route']; ?>%"></div>
                </div>
            </div>

            <div class="progress-card">
                <div class="progress-header">
                    <span class="progress-icon">📚</span>
                    <span class="progress-title">Yan Hikayeler</span>
                    <span class="progress-percentage"><?php echo $character_data['story_progress']['side_stories']; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $character_data['story_progress']['side_stories']; ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="character-navigation">
        <button class="nav-btn" onclick="goBack()">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Geri Dön</span>
        </button>
        <button class="nav-btn" onclick="loadContent('characters')">
            <span class="btn-icon">👥</span>
            <span class="btn-text">Tüm Karakterler</span>
        </button>
    </div>
</div>

<script>
// Character-specific functions
function startChat(characterId) {
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
    
    // Start chat with character
    window.location.href = `story-mode.php?character=${characterId}`;
}

function viewStories(characterId) {
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
    
    // Load character stories
    if (window.menuManager) {
        window.menuManager.loadContent(`character-stories-${characterId}`);
    }
}

function viewTasks(characterId) {
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
    
    // Load character tasks
    if (window.menuManager) {
        window.menuManager.loadContent(`character-tasks-${characterId}`);
    }
}

function goBack() {
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
    
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = 'main-menu.php';
    }
}

// Initialize character page
document.addEventListener('DOMContentLoaded', function() {
    // Animate affinity ring
    const affinityRing = document.querySelector('.affinity-ring');
    if (affinityRing) {
        const affinity = parseInt(affinityRing.dataset.affinity);
        const progress = affinityRing.querySelector('.affinity-progress');
        
        setTimeout(() => {
            const circumference = 2 * Math.PI * 45; // radius = 45
            const offset = circumference - (affinity / 100) * circumference;
            progress.style.strokeDashoffset = offset;
            progress.style.transition = 'stroke-dashoffset 2s ease-in-out';
        }, 500);
    }

    // Animate progress bars
    const progressBars = document.querySelectorAll('.progress-fill');
    progressBars.forEach((bar, index) => {
        setTimeout(() => {
            bar.style.transition = 'width 1.5s ease-in-out';
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => bar.style.width = width, 100);
        }, 800 + (index * 200));
    });

    // Add hover effects to action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            if (window.audioManager) {
                window.audioManager.playSound('hover');
            }
        });
    });

    // Add hover effects to cards
    const cards = document.querySelectorAll('.detail-card, .progress-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
