<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    echo "User not logged in<br>";
    exit();
}

$user_id = $_SESSION['user_id'];
$chapter_id = 1;

echo "<h1>Test Continue Choice Flow</h1>";

// Reset user progress for testing
$stmt = $pdo->prepare("UPDATE user_story_progress SET current_dialogue_id = NULL, dialogue_history = NULL WHERE user_id = ? AND chapter_id = ?");
$stmt->execute([$user_id, $chapter_id]);

// Function to get current dialogue
function getCurrentDialogue($pdo, $user_id, $chapter_id) {
    // Get user progress
    $stmt = $pdo->prepare("SELECT * FROM user_story_progress WHERE user_id = ? AND chapter_id = ?");
    $stmt->execute([$user_id, $chapter_id]);
    $userProgress = $stmt->fetch();
    
    // Get the current dialogue or start from the first one
    $current_dialogue_id = $userProgress['current_dialogue_id'];
    if (!$current_dialogue_id) {
        $stmt = $pdo->prepare("SELECT id FROM story_dialogues WHERE chapter_id = ? ORDER BY order_sequence ASC LIMIT 1");
        $stmt->execute([$chapter_id]);
        $first_dialogue = $stmt->fetch();
        $current_dialogue_id = $first_dialogue ? $first_dialogue['id'] : null;
    }
    
    if ($current_dialogue_id) {
        $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
        $stmt->execute([$current_dialogue_id]);
        return $stmt->fetch();
    }
    
    return null;
}

// Function to get choices for current dialogue
function getChoices($pdo, $dialogue_id) {
    if (!$dialogue_id) return [];
    
    $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE dialogue_id = ?");
    $stmt->execute([$dialogue_id]);
    return $stmt->fetchAll();
}

// Display current dialogue
$current_dialogue = getCurrentDialogue($pdo, $user_id, $chapter_id);
if ($current_dialogue) {
    echo "<h3>Current Dialogue: " . htmlspecialchars($current_dialogue['character_name']) . "</h3>";
    echo "<p>" . htmlspecialchars($current_dialogue['dialogue_text']) . "</p>";
    
    $choices = getChoices($pdo, $current_dialogue['id']);
    if (!empty($choices)) {
        echo "<h4>Choices:</h4>";
        echo "<ul>";
        foreach ($choices as $choice) {
            if ($choice['choice_text'] !== 'Continue') {
                echo "<li><a href='?choice=" . $choice['id'] . "'>" . htmlspecialchars($choice['choice_text']) . " (leads to dialogue " . $choice['leads_to_dialogue_id'] . ")</a></li>";
            } else {
                echo "<li><strong>AUTO:</strong> " . htmlspecialchars($choice['choice_text']) . " (leads to dialogue " . $choice['leads_to_dialogue_id'] . ")</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>No choices available for this dialogue.</p>";
    }
}

// Process choice if selected
if (isset($_GET['choice'])) {
    $choice_id = (int)$_GET['choice'];
    echo "<h3>Processing choice ID: " . $choice_id . "</h3>";
    
    // Fetch choice details
    $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE id = ?");
    $stmt->execute([$choice_id]);
    $choice = $stmt->fetch();
    
    if ($choice) {
        echo "<p>Choice: " . htmlspecialchars($choice['choice_text']) . "</p>";
        
        // Process the choice
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
            
            // Add current dialogue to history
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
            
            echo "<p>Progressed to dialogue ID: " . $next_dialogue_id . "</p>";
            
            // Automatically process Continue choices
            $continue_dialogue_id = $next_dialogue_id;
            do {
                // Fetch the dialogue
                $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
                $stmt->execute([$continue_dialogue_id]);
                $dialogue = $stmt->fetch();
                
                if (!$dialogue) break;
                
                echo "<p>At dialogue: " . htmlspecialchars($dialogue['character_name']) . " - " . htmlspecialchars($dialogue['dialogue_text']) . "</p>";
                
                // Check if this dialogue has only a Continue choice
                $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE dialogue_id = ?");
                $stmt->execute([$continue_dialogue_id]);
                $choices = $stmt->fetchAll();
                
                if (count($choices) === 1 && $choices[0]['choice_text'] === 'Continue') {
                    $continue_choice = $choices[0];
                    echo "<p>Auto-processing Continue choice to dialogue ID: " . $continue_choice['leads_to_dialogue_id'] . "</p>";
                    
                    // Add to history
                    $dialogue_entry = [
                        'id' => $dialogue['id'],
                        'character_name' => $dialogue['character_name'],
                        'dialogue_text' => $dialogue['dialogue_text'],
                        'timestamp' => date('H:i')
                    ];
                    
                    $dialogue_history[] = $dialogue_entry;
                    
                    // Update progress
                    $continue_dialogue_id = $continue_choice['leads_to_dialogue_id'];
                    $stmt = $pdo->prepare("UPDATE user_story_progress SET current_dialogue_id = ?, dialogue_history = ? WHERE user_id = ? AND chapter_id = ?");
                    $stmt->execute([$continue_dialogue_id, json_encode($dialogue_history), $user_id, $chapter_id]);
                } else {
                    // Break the loop if there are other choices or no choices
                    break;
                }
            } while ($continue_dialogue_id);
            
            // Display final dialogue
            $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
            $stmt->execute([$continue_dialogue_id]);
            $final_dialogue = $stmt->fetch();
            
            if ($final_dialogue) {
                echo "<h3>Final Dialogue: " . htmlspecialchars($final_dialogue['character_name']) . "</h3>";
                echo "<p>" . htmlspecialchars($final_dialogue['dialogue_text']) . "</p>";
                
                $final_choices = getChoices($pdo, $final_dialogue['id']);
                if (!empty($final_choices)) {
                    echo "<h4>Choices:</h4>";
                    echo "<ul>";
                    foreach ($final_choices as $choice) {
                        if ($choice['choice_text'] !== 'Continue') {
                            echo "<li><a href='?choice=" . $choice['id'] . "'>" . htmlspecialchars($choice['choice_text']) . " (leads to dialogue " . $choice['leads_to_dialogue_id'] . ")</a></li>";
                        } else {
                            echo "<li><strong>AUTO:</strong> " . htmlspecialchars($choice['choice_text']) . " (leads to dialogue " . $choice['leads_to_dialogue_id'] . ")</li>";
                        }
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No choices available for this dialogue.</p>";
                }
            }
        }
    }
}

echo "<p><a href='?'>Reset and start over</a></p>";
?>