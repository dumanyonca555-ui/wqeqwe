<?php
require_once '../backend/config/config.php';
require_once '../backend/config/database.php';
require_once '../backend/includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    echo "User not logged in<br>";
    exit();
}

echo "User is logged in<br>";

// Get chapter ID from URL parameter
$chapter_id = isset($_GET['chapter']) ? (int)$_GET['chapter'] : 0;

echo "Chapter ID from URL: " . $chapter_id . "<br>";

if ($chapter_id <= 0) {
    echo "Invalid chapter ID<br>";
    exit();
}

// Fetch chapter information
$stmt = $pdo->prepare("SELECT * FROM story_chapters WHERE id = ?");
$stmt->execute([$chapter_id]);
$chapter = $stmt->fetch();

if (!$chapter) {
    echo "Chapter not found in database<br>";
    exit();
}

echo "Chapter found: " . $chapter['title'] . "<br>";

// Check if chapter is unlocked
function isChapterUnlocked($chapter_id, $user_id, $pdo) {
    // Fetch chapter to check if it's unlocked in database
    $stmt = $pdo->prepare("SELECT chapter_number, is_unlocked FROM story_chapters WHERE id = ?");
    $stmt->execute([$chapter_id]);
    $chapter = $stmt->fetch();
    
    if (!$chapter) {
        return false;
    }
    
    // If chapter is marked as unlocked in database, it's available
    if ($chapter['is_unlocked']) {
        return true;
    }
    
    // Chapter 1 is always unlocked if marked in database
    if ($chapter['chapter_number'] == 1) {
        return $chapter['is_unlocked'];
    }
    
    // Check if previous chapter is completed
    $prev_chapter_num = $chapter['chapter_number'] - 1;
    $stmt = $pdo->prepare("SELECT completed_at FROM user_story_progress WHERE user_id = ? AND chapter_id = (SELECT id FROM story_chapters WHERE chapter_number = ?)");
    $stmt->execute([$user_id, $prev_chapter_num]);
    $result = $stmt->fetch();
    
    return !empty($result);
}

// Check if chapter is unlocked
$unlocked = isChapterUnlocked($chapter_id, $_SESSION['user_id'], $pdo);
echo "Chapter unlocked: " . ($unlocked ? "Yes" : "No") . "<br>";

// Get user progress for this chapter
$stmt = $pdo->prepare("SELECT * FROM user_story_progress WHERE user_id = ? AND chapter_id = ?");
$stmt->execute([$_SESSION['user_id'], $chapter_id]);
$userProgress = $stmt->fetch();

echo "User progress found: " . ($userProgress ? "Yes" : "No") . "<br>";
?>