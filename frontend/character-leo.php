<?php
// Simplified character page - no backend dependencies for now
// In production, add proper authentication and database calls

// Mock user check for now
$user_logged_in = true;

// Leo Character Data
$character_data = [
    'id' => 'leo',
    'name' => 'Leo',
    'title' => 'The Strategist',
    'description' => 'Analitik ve koruyucu. Stratejik düşünür.',
    'affinity' => 75,
    'status' => 'online',
    'personality' => 'Güven kazanması zor, sadık, geç saatler aktif',
    'age' => 28,
    'occupation' => 'Tactical Analyst',
    'hobbies' => 'Satranç, Kitap okuma',
    'active_hours' => '22:00 - 02:00',
    'avatar' => 'assets/images/characters/leo-portrait.png',
    'background' => 'linear-gradient(135deg, #1a0d2e 0%, #2d1b4e 100%)',
    'theme_color' => '#7b9fff',
    'messages_count' => 127,
    'stories_unlocked' => 8,
    'achievements' => 15,
    'last_seen' => 'Şimdi aktif',
    'relationship_status' => 'Güvenilir Ortak',
    'favorite_topics' => ['Strateji', 'Teknoloji', 'Kitaplar', 'Satranç'],
    'special_abilities' => ['Analitik Düşünce', 'Koruma', 'Planlama'],
    'story_progress' => [
        'main_story' => 65,
        'personal_route' => 40,
        'side_stories' => 80
    ]
];

$page_title = $character_data['name'] . ' - ' . $character_data['title'];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/characters.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        /* Leo-specific dark theme */
        body {
            background: <?php echo $character_data['background']; ?>;
            min-height: 100vh;
        }
        
        .character-page {
            --character-theme: <?php echo $character_data['theme_color']; ?>;
        }
        
        .affinity-progress {
            stroke: <?php echo $character_data['theme_color']; ?>;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, <?php echo $character_data['theme_color']; ?>, #2d1b4e);
        }
        
        .action-btn.primary {
            background: linear-gradient(135deg, <?php echo $character_data['theme_color']; ?> 0%, #2d1b4e 100%);
        }
    </style>
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <main class="main-container">
        <?php include 'character-template.php'; ?>
    </main>

    <script src="assets/js/menu-manager.js"></script>
    <script src="assets/js/audio-manager.js"></script>
    <script src="assets/js/main-menu.js"></script>
</body>
</html>
