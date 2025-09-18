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

try {
    // Fetch all story chapters
    $stmt = $pdo->prepare("SELECT * FROM story_chapters ORDER BY chapter_number ASC");
    $stmt->execute();
    $chapters = $stmt->fetchAll();
    
    echo json_encode(['chapters' => $chapters]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error: ' . $e->getMessage()]);
}