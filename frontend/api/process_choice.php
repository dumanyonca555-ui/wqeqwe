<?php
require_once '../../backend/config/config.php';
require_once '../../backend/config/database.php';
require_once '../../backend/includes/functions.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!is_logged_in()) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$chapter_id = isset($_POST['chapter_id']) ? (int)$_POST['chapter_id'] : 0;
$choice_id = isset($_POST['choice_id']) ? (int)$_POST['choice_id'] : 0;

if ($chapter_id <= 0 || $choice_id <= 0) {
    echo json_encode(['error' => 'Invalid parameters']);
    exit();
}

try {
    // Function to process a single choice and return the next dialogue
    function processChoiceAndGetNext($pdo, $user_id, $chapter_id, $choice_id) {
        // Fetch choice details
        $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE id = ?");
        $stmt->execute([$choice_id]);
        $choice = $stmt->fetch();
        
        if (!$choice) {
            return ['error' => 'Choice not found'];
        }
        
        // Apply affinity changes
        $affinity_changes = json_decode($choice['affinity_change'], true);
        
        // Update user progress
        $next_dialogue_id = $choice['leads_to_dialogue_id'];
        if ($next_dialogue_id) {
            // Get current dialogue history
            $stmt = $pdo->prepare("SELECT dialogue_history, current_dialogue_id FROM user_story_progress WHERE user_id = ? AND chapter_id = ?");
            $stmt->execute([$user_id, $chapter_id]);
            $progress = $stmt->fetch();
            
            $dialogue_history = [];
            if ($progress && $progress['dialogue_history']) {
                $dialogue_history = json_decode($progress['dialogue_history'], true);
            }
            
            // Add current dialogue to history
            if ($progress && $progress['current_dialogue_id']) {
                $current_dialogue_stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
                $current_dialogue_stmt->execute([$progress['current_dialogue_id']]);
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
            }
            
            // Update user progress with next dialogue and history
            $stmt = $pdo->prepare("UPDATE user_story_progress SET current_dialogue_id = ?, dialogue_history = ? WHERE user_id = ? AND chapter_id = ?");
            $stmt->execute([$next_dialogue_id, json_encode($dialogue_history), $user_id, $chapter_id]);
        }
        
        // Fetch next dialogue
        $next_dialogue = null;
        $next_choices = [];
        
        if ($next_dialogue_id) {
            $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
            $stmt->execute([$next_dialogue_id]);
            $next_dialogue = $stmt->fetch();
            
            if ($next_dialogue && $next_dialogue['is_choice_point']) {
                $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE dialogue_id = ?");
                $stmt->execute([$next_dialogue_id]);
                $next_choices = $stmt->fetchAll();
            }
        }
        
        return [
            'dialogue' => $next_dialogue,
            'choices' => $next_choices,
            'affinity_changes' => $affinity_changes
        ];
    }
    
    // Process the initial choice
    $result = processChoiceAndGetNext($pdo, $user_id, $chapter_id, $choice_id);
    
    if (isset($result['error'])) {
        echo json_encode(['error' => $result['error']]);
        exit();
    }
    
    // If the next dialogue has only a "Continue" choice, process it automatically
    while ($result['choices'] && count($result['choices']) === 1 && $result['choices'][0]['choice_text'] === 'Continue') {
        $continue_choice_id = $result['choices'][0]['id'];
        $result = processChoiceAndGetNext($pdo, $user_id, $chapter_id, $continue_choice_id);
        
        if (isset($result['error'])) {
            echo json_encode(['error' => $result['error']]);
            exit();
        }
    }
    
    // Return the final result
    $result['success'] = true;
    echo json_encode($result);
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>