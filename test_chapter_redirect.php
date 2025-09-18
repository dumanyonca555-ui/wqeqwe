<?php
require_once 'backend/config/database.php';

// Test if we can fetch chapters
$stmt = $pdo->query("SELECT id, chapter_number, title, is_unlocked FROM story_chapters WHERE chapter_number IN (1, 2)");
$chapters = $stmt->fetchAll();

echo "<h1>Chapter Unlock Test</h1>\n";
echo "<p>Testing chapter unlock status:</p>\n";
echo "<ul>\n";

foreach ($chapters as $chapter) {
    echo "<li>Chapter {$chapter['chapter_number']}: {$chapter['title']} - " . 
         ($chapter['is_unlocked'] ? "UNLOCKED" : "LOCKED") . "</li>\n";
}

echo "</ul>\n";

// Test the redirect URL
$testChapterId = 1;
echo "<p>Test redirect URL for Chapter 1:</p>\n";
echo "<a href='frontend/chapter-play.php?chapter={$testChapterId}'>Go to Chapter 1</a>\n";
?>