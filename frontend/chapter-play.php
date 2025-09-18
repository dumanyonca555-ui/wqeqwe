<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Debug information
error_log("Chapter play script started");
error_log("GET parameters: " . print_r($_GET, true));

// Check if user is logged in
if (!is_logged_in()) {
    error_log("User not logged in, redirecting to index.php");
    header("Location: index.php");
    exit();
}

// Get chapter ID from URL parameter
$chapter_id = isset($_GET['chapter']) ? (int)$_GET['chapter'] : 0;

error_log("Chapter ID: " . $chapter_id);

if ($chapter_id <= 0) {
    error_log("Invalid chapter ID, redirecting to story-mode.php");
    header("Location: story-mode.php");
    exit();
}

$user = get_current_user_data();
$user_id = $_SESSION['user_id'];
error_log("User ID: " . $user_id);

// Fetch chapter information
$stmt = $pdo->prepare("SELECT * FROM story_chapters WHERE id = ?");
$stmt->execute([$chapter_id]);
$chapter = $stmt->fetch();

if (!$chapter) {
    error_log("Chapter not found, redirecting to story-mode.php");
    header("Location: story-mode.php");
    exit();
}

error_log("Chapter found: " . $chapter['title']);

// Check if chapter is unlocked
function isChapterUnlocked($chapter_id, $user_id, $pdo) {
    // Fetch chapter to check if it's unlocked in database
    $stmt = $pdo->prepare("SELECT chapter_number, is_unlocked FROM story_chapters WHERE id = ?");
    $stmt->execute([$chapter_id]);
    $chapter = $stmt->fetch();
    
    if (!$chapter) {
        return false;
    }
    
    // If chapter is marked as unlocked in database, it's available
    if ($chapter['is_unlocked']) {
        return true;
    }
    
    // Chapter 1 is always unlocked if marked in database
    if ($chapter['chapter_number'] == 1) {
        return $chapter['is_unlocked'];
    }
    
    // Check if previous chapter is completed
    $prev_chapter_num = $chapter['chapter_number'] - 1;
    $stmt = $pdo->prepare("SELECT completed_at FROM user_story_progress WHERE user_id = ? AND chapter_id = (SELECT id FROM story_chapters WHERE chapter_number = ?)");
    $stmt->execute([$user_id, $prev_chapter_num]);
    $result = $stmt->fetch();
    
    return !empty($result);
}

// Redirect if chapter is not unlocked
if (!isChapterUnlocked($chapter_id, $user_id, $pdo)) {
    error_log("Chapter not unlocked, redirecting to story-mode.php");
    header("Location: story-mode.php");
    exit();
}

// Handle choice selection if POST request
$choice_made = false;
$affinity_changes = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['choice_id'])) {
    $choice_id = (int)$_POST['choice_id'];
    error_log("Processing choice ID: " . $choice_id);
    
    // Fetch choice details
    $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE id = ?");
    $stmt->execute([$choice_id]);
    $choice = $stmt->fetch();
    
    if ($choice) {
        // Apply affinity changes
        $affinity_changes = json_decode($choice['affinity_change'], true);
        if ($affinity_changes) {
            // TODO: Apply affinity changes to user profile
            error_log("Affinity changes: " . print_r($affinity_changes, true));
        }
        
        // Update user progress
        $next_dialogue_id = $choice['leads_to_dialogue_id'];
        if ($next_dialogue_id) {
            // Get current dialogue history
            $stmt = $pdo->prepare("SELECT dialogue_history FROM user_story_progress WHERE user_id = ? AND chapter_id = ?");
            $stmt->execute([$user_id, $chapter_id]);
            $progress = $stmt->fetch();
            
            $dialogue_history = [];
            if ($progress && $progress['dialogue_history']) {
                $dialogue_history = json_decode($progress['dialogue_history'], true);
            }
            
            // Add current dialogue to history if not already there
            $current_dialogue_stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = (SELECT current_dialogue_id FROM user_story_progress WHERE user_id = ? AND chapter_id = ?)");
            $current_dialogue_stmt->execute([$user_id, $chapter_id]);
            $current_dialogue = $current_dialogue_stmt->fetch();
            
            if ($current_dialogue) {
                $dialogue_entry = [
                    'id' => $current_dialogue['id'],
                    'character_name' => $current_dialogue['character_name'],
                    'dialogue_text' => $current_dialogue['dialogue_text'],
                    'timestamp' => date('H:i')
                ];
                
                // Check if this dialogue is already in history
                $found = false;
                foreach ($dialogue_history as $entry) {
                    if ($entry['id'] == $current_dialogue['id']) {
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $dialogue_history[] = $dialogue_entry;
                }
            }
            
            // Update user progress with next dialogue and history
            $stmt = $pdo->prepare("UPDATE user_story_progress SET current_dialogue_id = ?, dialogue_history = ? WHERE user_id = ? AND chapter_id = ?");
            $stmt->execute([$next_dialogue_id, json_encode($dialogue_history), $user_id, $chapter_id]);
            error_log("Updated user progress to dialogue ID: " . $next_dialogue_id);
        }
        
        $choice_made = true;
    }
}

// Get user progress for this chapter
$stmt = $pdo->prepare("SELECT * FROM user_story_progress WHERE user_id = ? AND chapter_id = ?");
$stmt->execute([$user_id, $chapter_id]);
$userProgress = $stmt->fetch();

// If no progress, start from the beginning
if (!$userProgress) {
    $stmt = $pdo->prepare("INSERT INTO user_story_progress (user_id, chapter_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $chapter_id]);
    $userProgress = ['current_dialogue_id' => null, 'dialogue_history' => null];
}

// Get dialogue history
$dialogue_history = [];
if ($userProgress && $userProgress['dialogue_history']) {
    $dialogue_history = json_decode($userProgress['dialogue_history'], true);
}

// Get the current dialogue or start from the first one
$current_dialogue_id = $userProgress['current_dialogue_id'];
if (!$current_dialogue_id) {
    $stmt = $pdo->prepare("SELECT id FROM story_dialogues WHERE chapter_id = ? ORDER BY order_sequence ASC LIMIT 1");
    $stmt->execute([$chapter_id]);
    $first_dialogue = $stmt->fetch();
    $current_dialogue_id = $first_dialogue ? $first_dialogue['id'] : null;
}

// Fetch current dialogue
$current_dialogue = null;
if ($current_dialogue_id) {
    $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
    $stmt->execute([$current_dialogue_id]);
    $current_dialogue = $stmt->fetch();
}

// Fetch choices for current dialogue
$choices = [];
if ($current_dialogue && $current_dialogue['is_choice_point']) {
    $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE dialogue_id = ?");
    $stmt->execute([$current_dialogue_id]);
    $choices = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($chapter['title']); ?> - Hikaye Modu</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <style>
        /* Chapter Play Styles */
        .chapter-play {
            min-height: 100vh;
            background: linear-gradient(135deg, #240f48 0%, #841567 100%);
            display: flex;
            flex-direction: column;
        }

        .game-header {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #fff7ff;
        }

        .back-button {
            background: rgba(255, 247, 255, 0.1);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: #fff7ff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            min-width: 44px;
            min-height: 44px;
        }

        .back-button:hover {
            background: rgba(255, 247, 255, 0.2);
        }

        .settings-button {
            background: rgba(255, 247, 255, 0.1);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: #fff7ff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            min-width: 44px;
            min-height: 44px;
        }

        .settings-button:hover {
            background: rgba(255, 247, 255, 0.2);
        }

        .header-title {
            flex: 1;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .scene-info {
            background: rgba(255, 247, 255, 0.1);
            padding: 10px 20px;
            color: #ebc7ff;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .chat-area {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            max-height: calc(100vh - 300px);
        }

        .message-bubble {
            background: rgba(255, 247, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 15px 20px;
            margin-bottom: 15px;
            max-width: 80%;
            position: relative;
            border: 1px solid rgba(123, 159, 255, 0.3);
            animation: messageAppear 0.5s ease-out;
        }

        @keyframes messageAppear {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .message-bubble.leo {
            border-color: #4a90a4;
            background: rgba(74, 144, 164, 0.2);
        }

        .message-bubble.chloe {
            border-color: #00ff88;
            background: rgba(0, 255, 136, 0.2);
        }

        .message-header {
            display: flex;
            align-items: center;
            justify-content: between;
            margin-bottom: 8px;
            font-size: 12px;
            color: #ebc7ff;
        }

        .character-name {
            font-weight: bold;
            margin-right: 10px;
        }

        .message-time {
            color: rgba(235, 199, 255, 0.7);
            font-size: 11px;
        }

        .message-text {
            color: #fff7ff;
            line-height: 1.4;
            font-size: 16px;
        }

        .character-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 10px auto;
            border: 2px solid #7b9fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .typing-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ebc7ff;
            font-style: italic;
            margin: 10px 0;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .choice-section {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px;
        }

        .choice-prompt {
            color: #fff7ff;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .choice-option {
            background: rgba(255, 247, 255, 0.1);
            border: 2px solid rgba(123, 159, 255, 0.3);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 44px;
            display: flex;
            flex-direction: column;
        }

        .choice-option:hover {
            border-color: #7b9fff;
            background: rgba(123, 159, 255, 0.2);
            transform: translateY(-2px);
        }

        .choice-text {
            color: #fff7ff;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .choice-affinity {
            color: #ebc7ff;
            font-size: 12px;
            font-style: italic;
        }

        .control-bar {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .control-btn {
            background: none;
            border: 1px solid rgba(123, 159, 255, 0.5);
            border-radius: 20px;
            color: #7b9fff;
            padding: 8px 16px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .control-btn.active {
            background: #7b9fff;
            color: white;
        }

        .choice-timer {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(132, 21, 103, 0.8);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .affinity-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255, 247, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(123, 159, 255, 0.3);
            border-radius: 12px;
            padding: 15px;
            color: #fff7ff;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .affinity-notification.show {
            transform: translateX(0);
        }

        .affinity-change {
            font-weight: 600;
            margin: 5px 0;
        }

        .positive {
            color: #22c55e;
        }

        .negative {
            color: #ef4444;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .chat-area {
                padding: 15px;
            }
            
            .message-text {
                font-size: 14px;
            }
            
            .choice-text {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="chapter-play">
        <!-- Game Header -->
        <div class="game-header">
            <button class="back-button" onclick="history.back()">←</button>
            <div class="header-title">Chapter <?php echo $chapter['chapter_number']; ?>: <?php echo htmlspecialchars($chapter['title']); ?></div>
            <button class="settings-button">⏸️</button>
        </div>
        
        <!-- Scene Info -->
        <div class="scene-info">
            🏠 Neural Network HQ - 21:30
        </div>
        
        <!-- Chat Area -->
        <div class="chat-area" id="chat-area">
            <?php 
            // Display dialogue history
            foreach ($dialogue_history as $dialogue): ?>
                <div class="message-bubble <?php echo strtolower($dialogue['character_name']); ?>">
                    <div class="message-header">
                        <span class="character-name"><?php echo htmlspecialchars($dialogue['character_name']); ?></span>
                        <span class="message-time"><?php echo htmlspecialchars($dialogue['timestamp']); ?></span>
                    </div>
                    <div class="message-text"><?php echo htmlspecialchars($dialogue['dialogue_text']); ?></div>
                </div>
                
                <div class="character-avatar">
                    <img src="assets/images/characters/<?php echo strtolower($dialogue['character_name']); ?>-portrait.png" alt="<?php echo htmlspecialchars($dialogue['character_name']); ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                </div>
            <?php endforeach; ?>
            
            <?php if ($current_dialogue): ?>
                <div class="message-bubble <?php echo strtolower($current_dialogue['character_name']); ?>">
                    <div class="message-header">
                        <span class="character-name"><?php echo htmlspecialchars($current_dialogue['character_name']); ?></span>
                        <span class="message-time">21:30</span>
                    </div>
                    <div class="message-text"><?php echo htmlspecialchars($current_dialogue['dialogue_text']); ?></div>
                </div>
                
                <?php if (!empty($current_dialogue['character_avatar'])): ?>
                    <div class="character-avatar">
                        <img src="<?php echo htmlspecialchars($current_dialogue['character_avatar']); ?>" alt="<?php echo htmlspecialchars($current_dialogue['character_name']); ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <!-- Typing Indicator (will be shown dynamically) -->
            <div class="typing-indicator" id="typing-indicator" style="display: none;">
                <?php echo $current_dialogue ? htmlspecialchars($current_dialogue['character_name']) : 'Character'; ?> yazıyor...
            </div>
        </div>
        
        <!-- Choice Section -->
        <?php 
        // Filter out "Continue" choices for display - they should be processed automatically
        $display_choices = array_filter($choices, function($choice) {
            return $choice['choice_text'] !== 'Continue';
        });
        
        if (!empty($display_choices)): ?>
            <div class="choice-section">
                <div class="choice-prompt">💭 Seçiminizi yapın:</div>
                <?php foreach ($display_choices as $choice): ?>
                    <div class="choice-option" onclick="selectChoice(<?php echo $choice['id']; ?>)">
                        <div class="choice-text"><?php echo htmlspecialchars($choice['choice_text']); ?></div>
                        <?php 
                        $affinity_changes = json_decode($choice['affinity_change'], true);
                        if ($affinity_changes):
                        ?>
                            <div class="choice-affinity">
                                <?php 
                                $affinity_texts = [];
                                foreach ($affinity_changes as $character => $change) {
                                    $sign = $change > 0 ? '+' : '';
                                    $affinity_texts[] = "{$sign}{$change} " . ucfirst($character) . " Affinity";
                                }
                                echo implode(', ', $affinity_texts);
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($choices)): ?>
            <!-- Automatically process "Continue" choices -->
            <div class="choice-section" id="auto-processing-section" style="display: none;">
                <div class="choice-prompt">💭 Otomatik olarak devam ediliyor...</div>
            </div>
            <script>
                // Auto-process Continue choices
                document.addEventListener('DOMContentLoaded', function() {
                    // Show auto-processing indicator
                    const autoProcessingSection = document.getElementById('auto-processing-section');
                    if (autoProcessingSection) {
                        autoProcessingSection.style.display = 'block';
                    }
                    
                    // Find Continue choice
                    const continueChoice = <?php 
                    $continue_choice = null;
                    foreach ($choices as $choice) {
                        if ($choice['choice_text'] === 'Continue') {
                            $continue_choice = $choice;
                            break;
                        }
                    }
                    echo $continue_choice ? json_encode($continue_choice) : 'null';
                    ?>;
                    
                    if (continueChoice) {
                        // Add a small delay before auto-processing
                        setTimeout(function() {
                            selectChoice(continueChoice.id);
                        }, 1000);
                    }
                });
            </script>
        <?php endif; ?>
        
        <!-- Control Bar -->
        <div class="control-bar">
            <button class="control-btn">⏱️ 00:15</button>
            <button class="control-btn">📱 Auto</button>
            <button class="control-btn">💾 Save</button>
            <button class="control-btn">⚙️</button>
        </div>
    </div>
    
    <!-- Affinity Notification -->
    <div class="affinity-notification" id="affinity-notification">
        <div id="affinity-content"></div>
    </div>
    
    <script>
        // Auto-scroll to bottom
        function scrollToBottom() {
            const chatArea = document.querySelector('.chat-area');
            chatArea.scrollTop = chatArea.scrollHeight;
        }
        
        // Show typing indicator
        function showTypingIndicator(characterName) {
            const indicator = document.getElementById('typing-indicator');
            indicator.textContent = characterName + ' yazıyor...';
            indicator.style.display = 'flex';
            scrollToBottom();
        }
        
        // Hide typing indicator
        function hideTypingIndicator() {
            const indicator = document.getElementById('typing-indicator');
            indicator.style.display = 'none';
        }
        
        // Add message to chat
        function addMessage(character, text, delay = 1000) {
            setTimeout(() => {
                const chatArea = document.getElementById('chat-area');
                const messageHtml = `
                    <div class="message-bubble ${character.toLowerCase()}">
                        <div class="message-header">
                            <span class="character-name">${character}</span>
                            <span class="message-time">21:31</span>
                        </div>
                        <div class="message-text">${text}</div>
                    </div>
                    <div class="character-avatar">
                        <img src="assets/images/characters/${character.toLowerCase()}-portrait.png" alt="${character}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                `;
                chatArea.insertAdjacentHTML('beforeend', messageHtml);
                scrollToBottom();
            }, delay);
        }
        
        // Show affinity notification
        function showAffinityNotification(affinityChanges) {
            const notification = document.getElementById('affinity-notification');
            const content = document.getElementById('affinity-content');
            
            let notificationText = '';
            for (const [character, change] of Object.entries(affinityChanges)) {
                const className = change > 0 ? 'positive' : 'negative';
                const sign = change > 0 ? '+' : '';
                notificationText += `<div class="affinity-change ${className}">${character.toUpperCase()}: ${sign}${change} Affinity</div>`;
            }
            
            if (notificationText) {
                content.innerHTML = notificationText;
                notification.classList.add('show');
                
                // Hide notification after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        }
        
        // Select choice function
        function selectChoice(choiceId) {
            // Show typing indicator
            showTypingIndicator('<?php echo $current_dialogue ? htmlspecialchars($current_dialogue['character_name']) : 'Character'; ?>');
            
            // Hide choice sections
            const choiceSection = document.querySelector('.choice-section');
            if (choiceSection) {
                choiceSection.style.display = 'none';
            }
            
            const autoProcessingSection = document.getElementById('auto-processing-section');
            if (autoProcessingSection) {
                autoProcessingSection.style.display = 'none';
            }
            
            // Send choice to server
            fetch('api/process_choice.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'chapter_id=<?php echo $chapter_id; ?>&choice_id=' + encodeURIComponent(choiceId)
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    hideTypingIndicator();
                    addMessage('System', 'Bir hata oluştu: ' + data.error, 500);
                    // Show choice section again if there was an error
                    if (choiceSection) {
                        choiceSection.style.display = 'block';
                    }
                    return;
                }
                
                // Hide typing indicator
                hideTypingIndicator();
                
                // Add next message
                if (data.dialogue) {
                    addMessage(data.dialogue.character_name, data.dialogue.dialogue_text, 500);
                    
                    // Show affinity notification if there are changes
                    if (data.affinity_changes) {
                        showAffinityNotification(data.affinity_changes);
                    }
                    
                    // Check if the next dialogue has only a "Continue" choice
                    let hasOnlyContinue = false;
                    if (data.choices && data.choices.length === 1 && data.choices[0].choice_text === 'Continue') {
                        hasOnlyContinue = true;
                    }
                    
                    // Show next choice section if there are choices (excluding automatic Continue)
                    const displayChoices = data.choices ? data.choices.filter(choice => choice.choice_text !== 'Continue') : [];
                    
                    if (displayChoices.length > 0) {
                        setTimeout(() => {
                            let choicesHtml = '<div class="choice-section"><div class="choice-prompt">💭 Seçiminizi yapın:</div>';
                            displayChoices.forEach(choice => {
                                // Parse affinity changes for display
                                let affinityText = '';
                                if (choice.affinity_change) {
                                    try {
                                        const changes = JSON.parse(choice.affinity_change);
                                        const texts = [];
                                        for (const [character, change] of Object.entries(changes)) {
                                            const sign = change > 0 ? '+' : '';
                                            texts.push(`${sign}${change} ${character.charAt(0).toUpperCase() + character.slice(1)} Affinity`);
                                        }
                                        affinityText = texts.join(', ');
                                    } catch (e) {
                                        console.error('Error parsing affinity changes:', e);
                                    }
                                }
                                
                                choicesHtml += `
                                    <div class="choice-option" onclick="selectChoice(${choice.id})">
                                        <div class="choice-text">${choice.choice_text}</div>
                                        ${affinityText ? `<div class="choice-affinity">${affinityText}</div>` : ''}
                                    </div>
                                `;
                            });
                            choicesHtml += '</div>';
                            
                            const chatArea = document.getElementById('chat-area');
                            chatArea.insertAdjacentHTML('beforeend', choicesHtml);
                            scrollToBottom();
                        }, 1500);
                    } else if (hasOnlyContinue) {
                        // Show auto-processing indicator
                        setTimeout(() => {
                            const chatArea = document.getElementById('chat-area');
                            const autoProcessingHtml = '<div class="choice-section" id="auto-processing-section-dynamic" style="display: block;"><div class="choice-prompt">💭 Otomatik olarak devam ediliyor...</div></div>';
                            chatArea.insertAdjacentHTML('beforeend', autoProcessingHtml);
                            scrollToBottom();
                            
                            // Automatically process Continue choice after a delay
                            setTimeout(() => {
                                selectChoice(data.choices[0].id);
                            }, 1000);
                        }, 1500);
                    } else if (data.choices && data.choices.length === 0) {
                        // If no more choices, show end of chapter message
                        setTimeout(() => {
                            addMessage('System', 'Bölüm tamamlandı. Hikaye moduna geri dönülüyor...', 500);
                            setTimeout(() => {
                                window.location.href = 'story-mode.php';
                            }, 3000);
                        }, 1500);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                hideTypingIndicator();
                // Show error message
                addMessage('System', 'Bir hata oluştu. Lütfen tekrar deneyin.', 500);
                // Show choice section again if there was an error
                if (choiceSection) {
                    choiceSection.style.display = 'block';
                }
            });
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });
    </script>
</body>
</html>