<?php
// Simplified character page - no backend dependencies for now
// In production, add proper authentication and database calls

// Mock user check for now
$user_logged_in = true;

// Elara Character Data
$character_data = [
    'id' => 'elara',
    'name' => 'Elara',
    'title' => 'The Mentor',
    'description' => 'Bilgeliği ve rehberliğiyle tanınan, tecrübeli öğretmen.',
    'affinity' => 45,
    'status' => 'offline',
    'personality' => 'Bilge, sabırlı, öğretici',
    'age' => 32,
    'occupation' => 'Philosophy Professor',
    'hobbies' => 'Meditasyon, şiir yazmak, yıldızları izlemek',
    'active_hours' => '10:00 - 14:00',
    'avatar' => 'assets/images/characters/elara-portrait.png',
    'background' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
    'theme_color' => '#667eea',
    'messages_count' => 67,
    'stories_unlocked' => 4,
    'achievements' => 8,
    'last_seen' => '2 saat önce',
    'relationship_status' => 'Saygıdeğer Mentor',
    'favorite_topics' => ['Felsefe', 'Bilgelik', 'Meditasyon', 'Yıldızlar'],
    'special_abilities' => ['Derin Bilgi', 'Rehberlik', 'İç Huzur'],
    'story_progress' => [
        'main_story' => 30,
        'personal_route' => 15,
        'side_stories' => 50
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
        /* Elara-specific mystical theme */
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
            background: linear-gradient(90deg, <?php echo $character_data['theme_color']; ?>, #764ba2);
        }
        
        .action-btn.primary {
            background: linear-gradient(135deg, <?php echo $character_data['theme_color']; ?> 0%, #764ba2 100%);
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
