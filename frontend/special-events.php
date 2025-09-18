<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();

// Sample special events data
$specialEvents = [
    [
        'id' => 1,
        'title' => 'Kozmik Festival 2024',
        'description' => 'Yıllık büyük festival etkinliği! Özel ödüller ve sürprizler seni bekliyor.',
        'image' => 'assets/images/events/cosmic-festival.jpg',
        'type' => 'festival',
        'status' => 'active',
        'start_date' => '2024-03-15 00:00:00',
        'end_date' => '2024-03-22 23:59:59',
        'rewards' => ['500 Neural Fragment', 'Özel Festival Rozeti', 'Sınırlı CG Görseli'],
        'progress' => 65,
        'participants' => 1247,
        'special' => true
    ],
    [
        'id' => 2,
        'title' => 'Sevgililer Günü Özel',
        'description' => 'Karakterlerle özel romantik sahneler ve sürpriz hediyeler.',
        'image' => 'assets/images/events/valentines-special.jpg',
        'type' => 'romance',
        'status' => 'upcoming',
        'start_date' => '2024-02-14 00:00:00',
        'end_date' => '2024-02-16 23:59:59',
        'rewards' => ['Romantik CG Koleksiyonu', '200 Neural Fragment', 'Özel Emoji Paketi'],
        'progress' => 0,
        'participants' => 0,
        'special' => true
    ],
    [
        'id' => 3,
        'title' => 'Hacker Challenge',
        'description' => 'Chloe ile birlikte zorlu puzzle\'ları çöz ve hacker rozetini kazan.',
        'image' => 'assets/images/events/hacker-challenge.jpg',
        'type' => 'challenge',
        'status' => 'completed',
        'start_date' => '2024-01-20 00:00:00',
        'end_date' => '2024-01-27 23:59:59',
        'rewards' => ['Hacker Rozeti', '300 Neural Fragment', 'Chloe Özel Diyalog'],
        'progress' => 100,
        'participants' => 892,
        'special' => false
    ],
    [
        'id' => 4,
        'title' => 'Müzik Festivali',
        'description' => 'Felix\'in müzik dünyasında özel konserler ve müzik yarışması.',
        'image' => 'assets/images/events/music-festival.jpg',
        'type' => 'music',
        'status' => 'upcoming',
        'start_date' => '2024-04-01 00:00:00',
        'end_date' => '2024-04-07 23:59:59',
        'rewards' => ['Müzik Koleksiyonu', 'Felix Özel Şarkısı', '400 Neural Fragment'],
        'progress' => 0,
        'participants' => 0,
        'special' => true
    ]
];

function getStatusText($status) {
    switch ($status) {
        case 'active': return 'Aktif';
        case 'upcoming': return 'Yakında';
        case 'completed': return 'Tamamlandı';
        default: return 'Bilinmiyor';
    }
}

function getStatusClass($status) {
    switch ($status) {
        case 'active': return 'status-active';
        case 'upcoming': return 'status-upcoming';
        case 'completed': return 'status-completed';
        default: return 'status-unknown';
    }
}

function getTimeRemaining($endDate) {
    $now = new DateTime();
    $end = new DateTime($endDate);
    $diff = $end->diff($now);
    
    if ($diff->invert === 0) {
        return 'Sona erdi';
    }
    
    if ($diff->days > 0) {
        return $diff->days . ' gün ' . $diff->h . ' saat';
    } else {
        return $diff->h . ' saat ' . $diff->i . ' dakika';
    }
}
?>

<div class="content-container">
    <!-- Special Events Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">🎉</div>
            <div class="header-info">
                <h1 class="page-title">Özel Etkinlikler</h1>
                <p class="page-description">Sınırlı süreli etkinlikler ve özel ödüller</p>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($specialEvents, fn($event) => $event['status'] === 'active')); ?></span>
                <span class="stat-label">Aktif</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo count(array_filter($specialEvents, fn($event) => $event['status'] === 'upcoming')); ?></span>
                <span class="stat-label">Yakında</span>
            </div>
        </div>
    </div>

    <!-- Active Events -->
    <div class="events-section">
        <h2 class="section-title">🔥 Aktif Etkinlikler</h2>
        <div class="events-grid">
            <?php foreach ($specialEvents as $event): ?>
                <?php if ($event['status'] === 'active'): ?>
                <div class="event-card active-event <?php echo $event['special'] ? 'special-event' : ''; ?>" 
                     onclick="openEvent(<?php echo $event['id']; ?>)">
                    
                    <div class="event-image">
                        <img src="<?php echo $event['image']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="event-overlay">
                            <div class="event-status <?php echo getStatusClass($event['status']); ?>">
                                <?php echo getStatusText($event['status']); ?>
                            </div>
                            <?php if ($event['special']): ?>
                            <div class="special-badge">⭐ ÖZEL</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="event-content">
                        <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p class="event-description"><?php echo htmlspecialchars($event['description']); ?></p>
                        
                        <div class="event-progress">
                            <div class="progress-header">
                                <span class="progress-label">İlerleme</span>
                                <span class="progress-percentage"><?php echo $event['progress']; ?>%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo $event['progress']; ?>%"></div>
                            </div>
                        </div>
                        
                        <div class="event-meta">
                            <div class="meta-item">
                                <span class="meta-icon">⏰</span>
                                <span class="meta-text"><?php echo getTimeRemaining($event['end_date']); ?></span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-icon">👥</span>
                                <span class="meta-text"><?php echo number_format($event['participants']); ?> katılımcı</span>
                            </div>
                        </div>
                        
                        <div class="event-rewards">
                            <h4 class="rewards-title">🎁 Ödüller</h4>
                            <div class="rewards-list">
                                <?php foreach (array_slice($event['rewards'], 0, 2) as $reward): ?>
                                <span class="reward-item"><?php echo $reward; ?></span>
                                <?php endforeach; ?>
                                <?php if (count($event['rewards']) > 2): ?>
                                <span class="reward-more">+<?php echo count($event['rewards']) - 2; ?> daha</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="event-actions">
                            <button class="action-btn primary" onclick="event.stopPropagation(); joinEvent(<?php echo $event['id']; ?>)">
                                <span class="btn-icon">🚀</span>
                                <span class="btn-text">Katıl</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="events-section">
        <h2 class="section-title">📅 Yaklaşan Etkinlikler</h2>
        <div class="events-grid">
            <?php foreach ($specialEvents as $event): ?>
                <?php if ($event['status'] === 'upcoming'): ?>
                <div class="event-card upcoming-event <?php echo $event['special'] ? 'special-event' : ''; ?>">
                    
                    <div class="event-image">
                        <img src="<?php echo $event['image']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="event-overlay">
                            <div class="event-status <?php echo getStatusClass($event['status']); ?>">
                                <?php echo getStatusText($event['status']); ?>
                            </div>
                            <?php if ($event['special']): ?>
                            <div class="special-badge">⭐ ÖZEL</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="event-content">
                        <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p class="event-description"><?php echo htmlspecialchars($event['description']); ?></p>
                        
                        <div class="event-countdown">
                            <div class="countdown-header">
                                <span class="countdown-label">Başlama Tarihi</span>
                            </div>
                            <div class="countdown-timer">
                                <?php echo date('d.m.Y H:i', strtotime($event['start_date'])); ?>
                            </div>
                        </div>
                        
                        <div class="event-rewards">
                            <h4 class="rewards-title">🎁 Ödüller</h4>
                            <div class="rewards-list">
                                <?php foreach (array_slice($event['rewards'], 0, 2) as $reward): ?>
                                <span class="reward-item"><?php echo $reward; ?></span>
                                <?php endforeach; ?>
                                <?php if (count($event['rewards']) > 2): ?>
                                <span class="reward-more">+<?php echo count($event['rewards']) - 2; ?> daha</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="event-actions">
                            <button class="action-btn secondary" onclick="remindEvent(<?php echo $event['id']; ?>)">
                                <span class="btn-icon">🔔</span>
                                <span class="btn-text">Hatırlat</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Completed Events -->
    <div class="events-section">
        <h2 class="section-title">✅ Tamamlanan Etkinlikler</h2>
        <div class="events-grid">
            <?php foreach ($specialEvents as $event): ?>
                <?php if ($event['status'] === 'completed'): ?>
                <div class="event-card completed-event">
                    
                    <div class="event-image">
                        <img src="<?php echo $event['image']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="event-overlay">
                            <div class="event-status <?php echo getStatusClass($event['status']); ?>">
                                <?php echo getStatusText($event['status']); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="event-content">
                        <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p class="event-description"><?php echo htmlspecialchars($event['description']); ?></p>
                        
                        <div class="event-stats">
                            <div class="stat-item">
                                <span class="stat-label">Katılım</span>
                                <span class="stat-value"><?php echo number_format($event['participants']); ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Tamamlanma</span>
                                <span class="stat-value"><?php echo $event['progress']; ?>%</span>
                            </div>
                        </div>
                        
                        <div class="event-actions">
                            <button class="action-btn disabled" disabled>
                                <span class="btn-icon">✅</span>
                                <span class="btn-text">Tamamlandı</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
const eventsData = <?php echo json_encode($specialEvents); ?>;

function openEvent(eventId) {
    const event = eventsData.find(e => e.id === eventId);
    if (!event) return;
    
    showNotification(`"${event.title}" etkinliği açılıyor...`);
    
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
    
    // In a real implementation, this would open the event details page
    setTimeout(() => {
        showNotification('Etkinlik detay sayfası yakında eklenecek!');
    }, 1500);
}

function joinEvent(eventId) {
    const event = eventsData.find(e => e.id === eventId);
    if (!event) return;
    
    showNotification(`"${event.title}" etkinliğine katıldın! 🎉`);
    
    // Update UI
    const eventCard = event.target.closest('.event-card');
    const joinBtn = eventCard.querySelector('.action-btn.primary');
    joinBtn.innerHTML = '<span class="btn-icon">✅</span><span class="btn-text">Katıldın</span>';
    joinBtn.classList.remove('primary');
    joinBtn.classList.add('success');
    joinBtn.disabled = true;
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
}

function remindEvent(eventId) {
    const event = eventsData.find(e => e.id === eventId);
    if (!event) return;
    
    showNotification(`"${event.title}" için hatırlatıcı kuruldu! 🔔`);
    
    // Update UI
    const remindBtn = event.target;
    remindBtn.innerHTML = '<span class="btn-icon">✅</span><span class="btn-text">Hatırlatıcı Kuruldu</span>';
    remindBtn.classList.add('success');
    remindBtn.disabled = true;
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
}

// Add hover effects to event cards
document.querySelectorAll('.event-card:not(.completed-event)').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
