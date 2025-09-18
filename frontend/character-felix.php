<?php
// Simplified character page - no backend dependencies for now
// In production, add proper authentication and database calls

// Mock user check for now
$user_logged_in = true;

// Felix Character Data
$character_data = [
    'id' => 'felix',
    'name' => 'Felix',
    'title' => 'The Heart',
    'description' => 'Duygusal zekâsı ve içtenliğiyle tanınan, kalp adamı.',
    'affinity' => 90,
    'status' => 'online',
    'personality' => 'Samimi, duygusal, romantik',
    'age' => 26,
    'occupation' => 'Art Therapist',
    'hobbies' => 'Resim yapmak, müzik dinlemek, yemek pişirmek',
    'active_hours' => '18:00 - 22:00',
    'avatar' => 'assets/images/characters/felix-portrait.png',
    'background' => 'linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%)',
    'theme_color' => '#ff9a9e',
    'messages_count' => 245,
    'stories_unlocked' => 15,
    'achievements' => 22,
    'last_seen' => 'Şimdi aktif',
    'relationship_status' => 'Yakın Arkadaş',
    'favorite_topics' => ['Sanat', 'Müzik', 'Yemek', 'Duygular'],
    'special_abilities' => ['Empati', 'Sanatsal Yaratıcılık', 'Duygusal Destek'],
    'story_progress' => [
        'main_story' => 85,
        'personal_route' => 75,
        'side_stories' => 95
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
        /* Felix-specific warm theme */
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
            background: linear-gradient(90deg, <?php echo $character_data['theme_color']; ?>, #fecfef);
        }
        
        .action-btn.primary {
            background: linear-gradient(135deg, <?php echo $character_data['theme_color']; ?> 0%, #fecfef 100%);
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
