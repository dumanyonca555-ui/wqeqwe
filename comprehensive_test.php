<?php
session_start();
require_once 'backend/config/database.php';
require_once 'backend/includes/functions.php';

echo "<h1>Comprehensive Test</h1>\n";

// 1. Check session
echo "<h2>1. Session Status</h2>\n";
if (is_logged_in()) {
    echo "<p>✅ User is logged in (ID: " . $_SESSION['user_id'] . ")</p>\n";
    
    // 2. Check user data
    $user = get_current_user_data();
    if ($user) {
        echo "<p>✅ User data retrieved: " . $user['username'] . "</p>\n";
    } else {
        echo "<p>❌ Failed to retrieve user data</p>\n";
    }
} else {
    echo "<p>❌ User is NOT logged in</p>\n";
    echo "<p>Session data: " . print_r($_SESSION, true) . "</p>\n";
    exit();
}

// 3. Check database connection and chapters
echo "<h2>2. Database Status</h2>\n";
try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM story_chapters");
    $result = $stmt->fetch();
    echo "<p>✅ Database connection OK. Found {$result['count']} chapters</p>\n";
    
    // 4. Check first two chapters
    $stmt = $pdo->query("SELECT id, chapter_number, title, is_unlocked FROM story_chapters WHERE chapter_number IN (1, 2)");
    $chapters = $stmt->fetchAll();
    
    foreach ($chapters as $chapter) {
        $status = $chapter['is_unlocked'] ? "UNLOCKED" : "LOCKED";
        echo "<p>Chapter {$chapter['chapter_number']}: {$chapter['title']} - {$status}</p>\n";
    }
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>\n";
    exit();
}

// 5. Test redirect function
echo "<h2>3. Redirect Test</h2>\n";
echo "<p>Testing redirect URLs:</p>\n";
echo "<ul>\n";
echo "<li><a href='frontend/story-mode.php'>Story Mode Page</a></li>\n";
echo "<li><a href='frontend/chapter-play.php?chapter=1'>Chapter 1</a></li>\n";
echo "<li><a href='frontend/chapter-play.php?chapter=2'>Chapter 2</a></li>\n";
echo "</ul>\n";

echo "<h2>4. Debug Info</h2>\n";
echo "<p>Current working directory: " . getcwd() . "</p>\n";
echo "<p>Base URL: " . (defined('BASE_URL') ? BASE_URL : 'NOT DEFINED') . "</p>\n";
?>