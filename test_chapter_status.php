<?php
require_once 'backend/config/database.php';

// Test chapter status
$stmt = $pdo->query("SELECT id, chapter_number, title, is_unlocked FROM story_chapters ORDER BY chapter_number");
$chapters = $stmt->fetchAll();

echo "<h1>Chapter Status Test</h1>\n";
echo "<table border='1'>\n";
echo "<tr><th>Chapter</th><th>Title</th><th>Database Status</th><th>Should be Unlocked</th></tr>\n";

foreach ($chapters as $chapter) {
    $isUnlocked = $chapter['is_unlocked'] == 1;
    $shouldBeUnlocked = in_array($chapter['chapter_number'], [1, 2]); // Chapters 1 and 2 should be unlocked
    
    echo "<tr>\n";
    echo "<td>Chapter {$chapter['chapter_number']}</td>\n";
    echo "<td>{$chapter['title']}</td>\n";
    echo "<td>" . ($isUnlocked ? "UNLOCKED" : "LOCKED") . "</td>\n";
    echo "<td>" . ($shouldBeUnlocked ? "YES" : "NO") . "</td>\n";
    echo "</tr>\n";
}

echo "</table>\n";

// Test a specific redirect
echo "<h2>Test Links</h2>\n";
echo "<p><a href='frontend/chapter-play.php?chapter=1'>Go to Chapter 1</a></p>\n";
echo "<p><a href='frontend/chapter-play.php?chapter=2'>Go to Chapter 2</a></p>\n";
echo "<p><a href='frontend/story-mode.php'>Back to Story Mode</a></p>\n";
?>