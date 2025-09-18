<?php
header('Content-Type: application/json');
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['choice_id'])) {
        // Process user choice
        $choice_id = (int)$input['choice_id'];
        $user_id = $_SESSION['user_id'];
        
        try {
            // Get choice details
            $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE id = ?");
            $stmt->execute([$choice_id]);
            $choice = $stmt->fetch();
            
            if (!$choice) {
                http_response_code(404);
                echo json_encode(['error' => 'Choice not found']);
                exit;
            }
            
            // Get next dialogue based on choice
            $next_dialogue_id = $choice['leads_to_dialogue_id'];
            
            if ($next_dialogue_id) {
                // Get next dialogue
                $stmt = $pdo->prepare("SELECT * FROM story_dialogues WHERE id = ?");
                $stmt->execute([$next_dialogue_id]);
                $next_dialogue = $stmt->fetch();
                
                if ($next_dialogue) {
                    // Check if next dialogue is a choice point
                    $is_choice_point = $next_dialogue['is_choice_point'];
                    $choices = [];
                    
                    if ($is_choice_point) {
                        // Get choices for next dialogue
                        $stmt = $pdo->prepare("SELECT * FROM story_choices WHERE dialogue_id = ?");
                        $stmt->execute([$next_dialogue_id]);
                        $choices = $stmt->fetchAll();
                    }
                    
                    // Update user progress
                    $stmt = $pdo->prepare("UPDATE user_story_progress SET current_dialogue_id = ? WHERE user_id = ? AND chapter_id = (SELECT chapter_id FROM story_dialogues WHERE id = ?)");
                    $stmt->execute([$next_dialogue_id, $user_id, $next_dialogue_id]);
                    
                    // Process affinity changes
                    $affinity_changes = json_decode($choice['affinity_change'], true);
                    if ($affinity_changes) {
                        foreach ($affinity_changes as $character_name => $change) {
                            // Get character ID by name
                            $stmt = $pdo->prepare("SELECT id FROM characters WHERE name = ?");
                            $stmt->execute([ucfirst($character_name)]);
                            $character = $stmt->fetch();
                            
                            if ($character) {
                                // Update character affinity
                                $stmt = $pdo->prepare("INSERT INTO character_affinity (user_id, character_id, affinity_points) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE affinity_points = affinity_points + ?");
                                $stmt->execute([$user_id, $character['id'], $change, $change]);
                            }
                        }
                    }
                    
                    // Return next dialogue and choices
                    echo json_encode([
                        'dialogue' => $next_dialogue,
                        'choices' => $choices,
                        'affinity_changes' => $affinity_changes
                    ]);
                } else {
                    // No next dialogue, chapter might be complete
                    echo json_encode([
                        'dialogue' => null,
                        'choices' => [],
                        'chapter_complete' => true
                    ]);
                }
            } else {
                // No next dialogue specified, chapter might be complete
                echo json_encode([
                    'dialogue' => null,
                    'choices' => [],
                    'chapter_complete' => true
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing choice_id']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}