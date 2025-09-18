<?php
session_start();
require_once 'backend/config/database.php';

echo "<h1>Session Test</h1>\n";

// Check if user is logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo "<p>User is NOT logged in</p>\n";
    echo "<p>Session data:</p>\n";
    echo "<pre>" . print_r($_SESSION, true) . "</pre>\n";
} else {
    echo "<p>User IS logged in with ID: " . $_SESSION['user_id'] . "</p>\n";
    
    // Test database connection
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        if ($user) {
            echo "<p>User found in database: " . $user['username'] . "</p>\n";
        } else {
            echo "<p>User NOT found in database</p>\n";
        }
    } catch (Exception $e) {
        echo "<p>Database error: " . $e->getMessage() . "</p>\n";
    }
}

echo "<p><a href='frontend/story-mode.php'>Go to Story Mode</a></p>\n";
?>