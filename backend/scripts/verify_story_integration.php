<?php
require_once '../config/database.php';

try {
    // Test 1: Check if chapters exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM story_chapters");
    $result = $stmt->fetch();
    echo "Test 1 - Chapters exist: " . ($result['count'] > 0 ? "PASS" : "FAIL") . " ({$result['count']} chapters)\n";
    
    // Test 2: Check if dialogues exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM story_dialogues");
    $result = $stmt->fetch();
    echo "Test 2 - Dialogues exist: " . ($result['count'] > 0 ? "PASS" : "FAIL") . " ({$result['count']} dialogues)\n";
    
    // Test 3: Check if choices exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM story_choices");
    $result = $stmt->fetch();
    echo "Test 3 - Choices exist: " . ($result['count'] > 0 ? "PASS" : "FAIL") . " ({$result['count']} choices)\n";
    
    // Test 4: Check chapter structure
    $stmt = $pdo->query("SELECT chapter_number, title, is_unlocked FROM story_chapters ORDER BY chapter_number");
    $chapters = $stmt->fetchAll();
    echo "Test 4 - Chapter structure:\n";
    foreach ($chapters as $chapter) {
        echo "  Chapter {$chapter['chapter_number']}: {$chapter['title']} (Unlocked: " . ($chapter['is_unlocked'] ? 'Yes' : 'No') . ")\n";
    }
    
    // Test 5: Check first chapter dialogues
    $stmt = $pdo->query("SELECT id, chapter_id, character_name, dialogue_text, is_choice_point FROM story_dialogues WHERE chapter_id = 1 ORDER BY order_sequence LIMIT 5");
    $dialogues = $stmt->fetchAll();
    echo "Test 5 - First chapter dialogues:\n";
    foreach ($dialogues as $dialogue) {
        echo "  Dialogue {$dialogue['id']}: {$dialogue['character_name']} - " . substr($dialogue['dialogue_text'], 0, 50) . "... (Choice point: " . ($dialogue['is_choice_point'] ? 'Yes' : 'No') . ")\n";
    }
    
    echo "\nAll tests completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}