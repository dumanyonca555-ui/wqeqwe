<?php
// Set proper headers for API response
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Cache-Control: no-cache, must-revalidate');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Start output buffering to prevent any accidental output
ob_start();

require_once '../config/config.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

try {
    // Clear any output buffer
    ob_clean();
    
    // For testing purposes, use a default user ID
    $user_id = 1; // Default test user
    
    // Check if user is logged in (commented for testing)
    // if (!is_logged_in()) {
    //     throw new Exception('User not logged in');
    // }
    // $user_id = $_SESSION['user_id'];
    
    // Validate database connection
    if (!$pdo) {
        throw new Exception('Database connection failed');
    }

    // Get character data with user affinity
    $stmt = $pdo->prepare("
        SELECT 
            c.id,
            c.name,
            c.title,
            c.description,
            c.active_hours,
            c.portrait_image,
            COALESCE(ua.affinity, 0) as user_affinity,
            COALESCE(ua.milestones_unlocked, 0) as milestones_unlocked,
            COALESCE(ua.cgs_unlocked, 0) as cgs_unlocked,
            c.created_at
        FROM characters c
        LEFT JOIN user_character_affinity ua ON c.id = ua.character_id AND ua.user_id = ?
        WHERE c.is_active = 1
        ORDER BY c.display_order ASC, c.name ASC
    ");
    
    $stmt->execute([$user_id]);
    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If no characters found, create default characters
    if (empty($characters)) {
        $defaultCharacters = [
            [
                'id' => 'leo',
                'name' => 'Leo',
                'title' => 'The Strategist',
                'description' => 'Analitik ve koruyucu',
                'active_hours' => '9-18',
                'portrait_image' => 'leo-portrait.png',
                'user_affinity' => 75,
                'milestones_unlocked' => 12,
                'cgs_unlocked' => 8
            ],
            [
                'id' => 'chloe',
                'name' => 'Chloe',
                'title' => 'The Hacker',
                'description' => 'Enerjik ve teknoloji sever',
                'active_hours' => '10-22',
                'portrait_image' => 'chloe-portrait.png',
                'user_affinity' => 60,
                'milestones_unlocked' => 8,
                'cgs_unlocked' => 5
            ],
            [
                'id' => 'felix',
                'name' => 'Felix',
                'title' => 'The Heart',
                'description' => 'Neşeli ve şefkatli',
                'active_hours' => '8-20',
                'portrait_image' => 'felix-portrait.png',
                'user_affinity' => 45,
                'milestones_unlocked' => 6,
                'cgs_unlocked' => 3
            ],
            [
                'id' => 'elara',
                'name' => 'Elara',
                'title' => 'The Mentor',
                'description' => 'Bilge ve sakin',
                'active_hours' => '7-19',
                'portrait_image' => 'elara-portrait.png',
                'user_affinity' => 90,
                'milestones_unlocked' => 15,
                'cgs_unlocked' => 12
            ]
        ];

        // Insert default characters if they don't exist
        foreach ($defaultCharacters as $char) {
            $stmt = $pdo->prepare("
                INSERT IGNORE INTO characters 
                (id, name, title, description, active_hours, portrait_image, is_active, display_order, created_at)
                VALUES (?, ?, ?, ?, ?, ?, 1, ?, NOW())
            ");
            $stmt->execute([
                $char['id'],
                $char['name'],
                $char['title'],
                $char['description'],
                $char['active_hours'],
                $char['portrait_image'],
                array_search($char['id'], array_column($defaultCharacters, 'id')) + 1
            ]);

            // Insert user affinity if it doesn't exist
            $stmt = $pdo->prepare("
                INSERT IGNORE INTO user_character_affinity 
                (user_id, character_id, affinity_level, milestones_unlocked, cgs_unlocked, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $user_id,
                $char['id'],
                $char['user_affinity'],
                $char['milestones_unlocked'],
                $char['cgs_unlocked']
            ]);
        }

        // Get the characters again
        $stmt = $pdo->prepare("
            SELECT 
                c.id,
                c.name,
                c.title,
                c.description,
                c.active_hours,
                c.portrait_image,
                COALESCE(ua.affinity_level, 0) as user_affinity,
                COALESCE(ua.milestones_unlocked, 0) as milestones_unlocked,
                COALESCE(ua.cgs_unlocked, 0) as cgs_unlocked,
                c.created_at
            FROM characters c
            LEFT JOIN user_character_affinity ua ON c.id = ua.character_id AND ua.user_id = ?
            WHERE c.is_active = 1
            ORDER BY c.display_order ASC, c.name ASC
        ");
        
        $stmt->execute([$user_id]);
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Format the response
    $response = [
        'success' => true,
        'data' => $characters,
        'count' => count($characters),
        'timestamp' => date('Y-m-d H:i:s')
    ];

    // Clear output buffer and send response
    ob_clean();
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    // Clear output buffer
    ob_clean();
    
    // Log error for debugging
    error_log('Characters API Error: ' . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => [
            'message' => $e->getMessage(),
            'code' => 'CHARACTER_LOAD_ERROR'
        ],
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} finally {
    // End output buffering
    ob_end_flush();
}
?>