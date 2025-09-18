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
    
    if (isset($input['chapter_id'])) {
        $chapter_id = (int)$input['chapter_id'];
        $user_id = $_SESSION['user_id'];
        $choices_made = isset($input['choices_made']) ? json_encode($input['choices_made']) : null;
        
        try {
            // Check if chapter exists
            $stmt = $pdo->prepare("SELECT id FROM story_chapters WHERE id = ?");
            $stmt->execute([$chapter_id]);
            $chapter = $stmt->fetch();
            
            if (!$chapter) {
                http_response_code(404);
                echo json_encode(['error' => 'Chapter not found']);
                exit;
            }
            
            // Check if user progress already exists
            $stmt = $pdo->prepare("SELECT id FROM user_story_progress WHERE user_id = ? AND chapter_id = ?");
            $stmt->execute([$user_id, $chapter_id]);
            $progress = $stmt->fetch();
            
            if ($progress) {
                // Update existing progress
                $stmt = $pdo->prepare("UPDATE user_story_progress SET completed_at = NOW(), choices_made = ? WHERE id = ?");
                $stmt->execute([$choices_made, $progress['id']]);
            } else {
                // Create new progress record
                $stmt = $pdo->prepare("INSERT INTO user_story_progress (user_id, chapter_id, completed_at, choices_made) VALUES (?, ?, NOW(), ?)");
                $stmt->execute([$user_id, $chapter_id, $choices_made]);
            }
            
            echo json_encode(['success' => true, 'message' => 'Progress saved successfully']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing chapter_id']);
    }
} else if ($method === 'GET') {
    // Get user progress
    $user_id = $_SESSION['user_id'];
    
    try {
        // Get all user progress
        $stmt = $pdo->prepare("SELECT chapter_id, completed_at, choices_made FROM user_story_progress WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $progress = $stmt->fetchAll();
        
        echo json_encode(['progress' => $progress]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}