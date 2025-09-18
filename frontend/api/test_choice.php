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
$chapter_id = isset($_GET['chapter_id']) ? (int)$_GET['chapter_id'] : 1;
$choice_id = isset($_GET['choice_id']) ? (int)$_GET['choice_id'] : 0;

if ($choice_id <= 0) {
    echo json_encode(['error' => 'Invalid choice ID']);
    exit();
}

try {
    // Fetch choice details
    $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE id = ?");
    $stmt->execute([$choice_id]);
    $choice = $stmt->fetch();
    
    if (!$choice) {
        echo json_encode(['error' => 'Choice not found']);
        exit();
    }
    
    // Apply affinity changes
    $affinity_changes = json_decode($choice['affinity_change'], true);
    
    // Update user progress
    $next_dialogue_id = $choice['leads_to_dialogue_id'];
    if ($next_dialogue_id) {
        $stmt = $pdo->prepare("UPDATE user_story_progress SET current_dialogue_id = ? WHERE user_id = ? AND chapter_id = ?");
        $stmt->execute([$next_dialogue_id, $user_id, $chapter_id]);
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
    
    echo json_encode([
        'success' => true,
        'choice_id' => $choice_id,
        'next_dialogue_id' => $next_dialogue_id,
        'dialogue' => $next_dialogue,
        'choices' => $next_choices,
        'affinity_changes' => $affinity_changes
    ]);
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>