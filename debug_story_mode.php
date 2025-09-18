<?php
require_once 'backend/config/database.php';

// Fetch all story chapters
$stmt = $pdo->prepare("SELECT * FROM story_chapters ORDER BY chapter_number ASC");
$stmt->execute();
$chapters = $stmt->fetchAll();

// Simple function to check if a chapter is unlocked
function isChapterUnlocked($chapter) {
    return $chapter['is_unlocked'] == 1;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Hikaye Modu</title>
    <style>
        .chapter-card {
            background: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
        }
        
        .chapter-btn {
            padding: 10px 20px;
            background: #007cba;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .chapter-btn:hover {
            background: #005a87;
        }
    </style>
</head>
<body>
    <h1>Debug Hikaye Modu</h1>
    
    <div class="chapter-list">
        <?php foreach ($chapters as $chapter): ?>
            <?php 
            $isUnlocked = isChapterUnlocked($chapter);
            ?>
            <div class="chapter-card">
                <h2>Chapter <?php echo $chapter['chapter_number']; ?>: <?php echo htmlspecialchars($chapter['title']); ?></h2>
                <p>Status: <?php echo $isUnlocked ? 'UNLOCKED' : 'LOCKED'; ?></p>
                <p>Database is_unlocked value: <?php echo $chapter['is_unlocked']; ?></p>
                
                <?php if ($isUnlocked): ?>
                    <button class="chapter-btn" onclick="testPlayChapter(<?php echo $chapter['id']; ?>)">▶️ OYNA</button>
                <?php else: ?>
                    <button class="chapter-btn" disabled>🔒 Kilitli</button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <script>
        function testPlayChapter(chapterId) {
            console.log("Attempting to play chapter:", chapterId);
            // Instead of redirecting, let's show an alert first to verify the function is called
            alert("Redirecting to chapter " + chapterId);
            // Then redirect
            window.location.href = 'frontend/chapter-play.php?chapter=' + chapterId;
        }
    </script>
</body>
</html>