<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$user = get_current_user_data();

// Sample daily routines data
$dailyRoutines = [
    [
        'id' => 1,
        'title' => 'Günlük Giriş Bonusu',
        'description' => 'Her gün oyuna giriş yap ve bonus kazan',
        'icon' => '🎁',
        'reward' => '50 Neural Fragment',
        'progress' => 1,
        'target' => 1,
        'completed' => true,
        'streak' => 7,
        'type' => 'login'
    ],
    [
        'id' => 2,
        'title' => 'Karakter Sohbeti',
        'description' => 'Herhangi bir karakterle 5 mesaj alışverişi yap',
        'icon' => '💬',
        'reward' => '25 Neural Fragment + 10 XP',
        'progress' => 3,
        'target' => 5,
        'completed' => false,
        'streak' => 0,
        'type' => 'chat'
    ],
    [
        'id' => 3,
        'title' => 'Hikaye İlerlemesi',
        'description' => 'Ana hikayede 1 bölüm tamamla',
        'icon' => '📖',
        'reward' => '100 Neural Fragment + 50 XP',
        'progress' => 0,
        'target' => 1,
        'completed' => false,
        'streak' => 0,
        'type' => 'story'
    ],
    [
        'id' => 4,
        'title' => 'Koleksiyon Keşfi',
        'description' => 'Galeriyi ziyaret et ve 3 yeni görsel keşfet',
        'icon' => '🖼️',
        'reward' => '30 Neural Fragment',
        'progress' => 1,
        'target' => 3,
        'completed' => false,
        'streak' => 0,
        'type' => 'collection'
    ],
    [
        'id' => 5,
        'title' => 'Sosyal Etkileşim',
        'description' => 'Bir karakterin affinity seviyesini artır',
        'icon' => '💙',
        'reward' => '40 Neural Fragment + 20 XP',
        'progress' => 0,
        'target' => 1,
        'completed' => false,
        'streak' => 0,
        'type' => 'affinity'
    ]
];

// Calculate daily progress
$completedRoutines = count(array_filter($dailyRoutines, fn($routine) => $routine['completed']));
$totalRoutines = count($dailyRoutines);
$dailyProgress = ($completedRoutines / $totalRoutines) * 100;

// Calculate total rewards earned today
$totalRewardsToday = 0;
foreach ($dailyRoutines as $routine) {
    if ($routine['completed']) {
        // Extract number from reward string (simplified)
        preg_match('/(\d+)/', $routine['reward'], $matches);
        if ($matches) {
            $totalRewardsToday += intval($matches[1]);
        }
    }
}
?>

<div class="content-container">
    <!-- Daily Routines Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">📅</div>
            <div class="header-info">
                <h1 class="page-title">Günlük Rutinler</h1>
                <p class="page-description">Her gün tamamlayabileceğin görevler ve ödüller</p>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="stat-value"><?php echo $completedRoutines; ?>/<?php echo $totalRoutines; ?></span>
                <span class="stat-label">Tamamlandı</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo $totalRewardsToday; ?></span>
                <span class="stat-label">Bugünkü Kazanç</span>
            </div>
        </div>
    </div>

    <!-- Daily Progress -->
    <div class="daily-progress-card">
        <div class="progress-header">
            <h3>Günlük İlerleme</h3>
            <span class="progress-percentage"><?php echo round($dailyProgress); ?>%</span>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo $dailyProgress; ?>%"></div>
            </div>
        </div>
        <div class="progress-info">
            <span>Tüm görevleri tamamla ve bonus ödül kazan!</span>
            <?php if ($dailyProgress === 100): ?>
                <button class="claim-bonus-btn" onclick="claimDailyBonus()">
                    🎁 Bonus Ödülü Al (200 Neural Fragment)
                </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- Routines List -->
    <div class="routines-list">
        <?php foreach ($dailyRoutines as $routine): ?>
        <div class="routine-card <?php echo $routine['completed'] ? 'completed' : 'active'; ?>">
            <div class="routine-icon">
                <?php echo $routine['icon']; ?>
            </div>
            
            <div class="routine-content">
                <div class="routine-header">
                    <h3 class="routine-title"><?php echo htmlspecialchars($routine['title']); ?></h3>
                    <?php if ($routine['completed']): ?>
                        <div class="completion-badge">✅ Tamamlandı</div>
                    <?php endif; ?>
                </div>
                
                <p class="routine-description"><?php echo htmlspecialchars($routine['description']); ?></p>
                
                <div class="routine-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo ($routine['progress'] / $routine['target']) * 100; ?>%"></div>
                    </div>
                    <span class="progress-text"><?php echo $routine['progress']; ?>/<?php echo $routine['target']; ?></span>
                </div>
                
                <div class="routine-reward">
                    <span class="reward-icon">🎁</span>
                    <span class="reward-text"><?php echo $routine['reward']; ?></span>
                </div>
                
                <?php if ($routine['streak'] > 0): ?>
                <div class="streak-info">
                    <span class="streak-icon">🔥</span>
                    <span class="streak-text"><?php echo $routine['streak']; ?> gün streak</span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="routine-actions">
                <?php if ($routine['completed']): ?>
                    <button class="action-btn claimed" disabled>
                        <span class="btn-icon">✅</span>
                        <span class="btn-text">Alındı</span>
                    </button>
                <?php elseif ($routine['progress'] >= $routine['target']): ?>
                    <button class="action-btn claimable" onclick="claimRoutineReward(<?php echo $routine['id']; ?>)">
                        <span class="btn-icon">🎁</span>
                        <span class="btn-text">Ödülü Al</span>
                    </button>
                <?php else: ?>
                    <button class="action-btn" onclick="startRoutine(<?php echo $routine['id']; ?>)">
                        <span class="btn-icon">▶️</span>
                        <span class="btn-text">Başla</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Reset Timer -->
    <div class="reset-timer-card">
        <div class="timer-icon">⏰</div>
        <div class="timer-content">
            <h3>Günlük Sıfırlama</h3>
            <p>Yeni görevler için kalan süre</p>
            <div class="countdown-timer" id="reset-countdown">
                <span class="time-unit">
                    <span class="time-value" id="hours">08</span>
                    <span class="time-label">Saat</span>
                </span>
                <span class="time-separator">:</span>
                <span class="time-unit">
                    <span class="time-value" id="minutes">45</span>
                    <span class="time-label">Dakika</span>
                </span>
                <span class="time-separator">:</span>
                <span class="time-unit">
                    <span class="time-value" id="seconds">30</span>
                    <span class="time-label">Saniye</span>
                </span>
            </div>
        </div>
    </div>
</div>

<script>
const routinesData = <?php echo json_encode($dailyRoutines); ?>;

function startRoutine(routineId) {
    const routine = routinesData.find(r => r.id === routineId);
    if (!routine) return;
    
    let message = '';
    let action = '';
    
    switch (routine.type) {
        case 'chat':
            message = 'Karakterler sayfasına yönlendiriliyorsun...';
            action = () => window.location.href = 'characters.php';
            break;
        case 'story':
            message = 'Hikaye moduna yönlendiriliyorsun...';
            action = () => window.location.href = 'story-mode.php';
            break;
        case 'collection':
            message = 'Koleksiyon sayfasına yönlendiriliyorsun...';
            action = () => loadContent('gallery');
            break;
        case 'affinity':
            message = 'Karakterler sayfasına yönlendiriliyorsun...';
            action = () => window.location.href = 'characters.php';
            break;
        default:
            message = 'Görev başlatılıyor...';
            action = () => {};
    }
    
    showNotification(message);
    
    if (window.audioManager) {
        window.audioManager.playSound('click');
    }
    
    setTimeout(action, 1500);
}

function claimRoutineReward(routineId) {
    const routine = routinesData.find(r => r.id === routineId);
    if (!routine) return;
    
    // Simulate claiming reward
    showNotification(`Ödül alındı: ${routine.reward}`);
    
    // Update UI
    const routineCard = event.target.closest('.routine-card');
    routineCard.classList.add('completed');
    routineCard.classList.remove('active');
    
    const actionBtn = routineCard.querySelector('.action-btn');
    actionBtn.innerHTML = '<span class="btn-icon">✅</span><span class="btn-text">Alındı</span>';
    actionBtn.classList.add('claimed');
    actionBtn.disabled = true;
    
    // Add completion badge
    const header = routineCard.querySelector('.routine-header');
    if (!header.querySelector('.completion-badge')) {
        const badge = document.createElement('div');
        badge.className = 'completion-badge';
        badge.textContent = '✅ Tamamlandı';
        header.appendChild(badge);
    }
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
    
    // Check if all routines are completed
    setTimeout(checkDailyCompletion, 500);
}

function claimDailyBonus() {
    showNotification('Günlük bonus alındı: 200 Neural Fragment! 🎉');
    
    const bonusBtn = event.target;
    bonusBtn.textContent = '✅ Bonus Alındı';
    bonusBtn.disabled = true;
    bonusBtn.classList.add('claimed');
    
    if (window.audioManager) {
        window.audioManager.playSound('notification');
    }
}

function checkDailyCompletion() {
    const completedCards = document.querySelectorAll('.routine-card.completed').length;
    const totalCards = document.querySelectorAll('.routine-card').length;
    
    if (completedCards === totalCards) {
        const progressCard = document.querySelector('.daily-progress-card');
        const progressInfo = progressCard.querySelector('.progress-info');
        
        if (!progressInfo.querySelector('.claim-bonus-btn')) {
            const bonusBtn = document.createElement('button');
            bonusBtn.className = 'claim-bonus-btn';
            bonusBtn.onclick = claimDailyBonus;
            bonusBtn.innerHTML = '🎁 Bonus Ödülü Al (200 Neural Fragment)';
            progressInfo.appendChild(bonusBtn);
        }
        
        // Update progress bar
        const progressFill = progressCard.querySelector('.progress-fill');
        const progressPercentage = progressCard.querySelector('.progress-percentage');
        progressFill.style.width = '100%';
        progressPercentage.textContent = '100%';
    }
}

// Countdown timer
function updateCountdown() {
    const now = new Date();
    const tomorrow = new Date(now);
    tomorrow.setDate(tomorrow.getDate() + 1);
    tomorrow.setHours(0, 0, 0, 0);
    
    const timeLeft = tomorrow - now;
    
    const hours = Math.floor(timeLeft / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
    
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
}

// Update countdown every second
setInterval(updateCountdown, 1000);
updateCountdown();
</script>
