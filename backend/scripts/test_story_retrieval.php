<?php
require_once '../config/database.php';

try {
    // Test retrieving chapter information
    $stmt = $pdo->query("SELECT * FROM story_chapters ORDER BY chapter_number");
    $chapters = $stmt->fetchAll();
    
    echo "=== CHAPTERS ===\n";
    foreach ($chapters as $chapter) {
        echo "Chapter {$chapter['chapter_number']}: {$chapter['title']}\n";
        echo "  Description: {$chapter['description']}\n";
        echo "  Unlock time: {$chapter['unlock_time']}\n";
        echo "  Unlocked: " . ($chapter['is_unlocked'] ? 'Yes' : 'No') . "\n\n";
    }
    
    // Test retrieving dialogues for Chapter 1
    $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE chapter_id = 1 ORDER BY order_sequence");
    $stmt->execute();
    $dialogues = $stmt->fetchAll();
    
    echo "=== CHAPTER 1 DIALOGUES ===\n";
    foreach ($dialogues as $dialogue) {
        echo "Dialogue {$dialogue['order_sequence']}: {$dialogue['character_name']} - {$dialogue['dialogue_text']}\n";
        echo "  Choice point: " . ($dialogue['is_choice_point'] ? 'Yes' : 'No') . "\n";
        
        // Get choices for this dialogue if it's a choice point
        if ($dialogue['is_choice_point']) {
            $choiceStmt = $pdo->prepare("SELECT * FROM story_choices WHERE dialogue_id = ?");
            $choiceStmt->execute([$dialogue['id']]);
            $choices = $choiceStmt->fetchAll();
            
            foreach ($choices as $choice) {
                echo "    Choice: {$choice['choice_text']}\n";
                echo "    Affinity change: {$choice['affinity_change']}\n";
            }
        }
        echo "\n";
    }
    
    echo "Story content retrieval test completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}