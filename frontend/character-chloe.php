<?php
// Simplified character page - no backend dependencies for now
// In production, add proper authentication and database calls

// Mock user check for now
$user_logged_in = true;

// Chloe Character Data
$character_data = [
    'id' => 'chloe',
    'name' => 'Chloe',
    'title' => 'The Hacker',
    'description' => 'Zekâsı ve teknolojiyle tanınan, siber güvenlik uzmanı.',
    'affinity' => 60,
    'status' => 'away',
    'personality' => 'Zeki, sır tutucu, teknoloji meraklısı',
    'age' => 24,
    'occupation' => 'Cybersecurity Specialist',
    'hobbies' => 'Kod yazmak, VR oyunları, anime',
    'active_hours' => '00:00 - 04:00',
    'avatar' => 'assets/images/characters/chloe-portrait.png',
    'background' => 'linear-gradient(135deg, #00d4aa 0%, #00a085 100%)',
    'theme_color' => '#00d4aa',
    'messages_count' => 89,
    'stories_unlocked' => 6,
    'achievements' => 15,
    'last_seen' => '30 dakika önce',
    'relationship_status' => 'Güvenilir Müttefik',
    'favorite_topics' => ['Teknoloji', 'Siber Güvenlik', 'Anime', 'VR Oyunları'],
    'special_abilities' => ['Hacking Yetenekleri', 'Sistem Analizi', 'Gizlilik Koruması'],
    'story_progress' => [
        'main_story' => 45,
        'personal_route' => 30,
        'side_stories' => 70
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
        /* Chloe-specific cyber theme */
        body {
            background: linear-gradient(135deg, #0a1929 0%, #1a3a5a 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
            color: #a0f1ff;
            margin: 0;
        }
        
        /* Header */
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            color: #a0f1ff;
        }
        
        .back-button {
            background: rgba(160, 241, 255, 0.1);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: #a0f1ff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            min-width: 44px;
            min-height: 44px;
        }
        
        .back-button:hover {
            background: rgba(160, 241, 255, 0.2);
        }
        
        .settings-button {
            background: rgba(160, 241, 255, 0.1);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: #a0f1ff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            min-width: 44px;
            min-height: 44px;
        }
        
        .settings-button:hover {
            background: rgba(160, 241, 255, 0.2);
        }
        
        .character-name-header {
            flex: 1;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        
        /* Name & Title */
        .character-name-main {
            color: #a0f1ff;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .character-title {
            color: #00ffff;
            font-size: 16px;
            font-style: italic;
            margin-bottom: 15px;
        }
        
        .character-subtitle {
            color: #00ffff;
            font-size: 16px;
            text-align: center;
        }
        
        /* Section Title */
        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #00ffff;
        }
        
        /* Affinity Section */
        .affinity-bar-container {
            width: 100%;
            height: 12px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            overflow: hidden;
            margin: 10px 0;
        }
        
        .affinity-progress {
            height: 100%;
            background: linear-gradient(90deg, #00ffff, #0088cc);
            border-radius: 6px;
            transition: width 0.3s ease;
            width: 0%;
        }
        
        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-label {
            font-size: 14px;
            color: #00ffff;
            margin-bottom: 5px;
        }
        
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #a0f1ff;
        }
        
        /* Achievements */
        .achievement-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(160, 241, 255, 0.2);
        }
        
        .achievement-item:last-child {
            border-bottom: none;
        }
        
        .achievement-status {
            font-size: 20px;
            margin-right: 10px;
        }
        
        .achievement-text {
            color: #a0f1ff;
            font-size: 14px;
        }
        
        .achievement-locked {
            color: #666;
        }
        
        /* Recent Chats */
        .chat-item {
            padding: 10px 0;
            border-bottom: 1px solid rgba(160, 241, 255, 0.2);
        }
        
        .chat-item:last-child {
            border-bottom: none;
        }
        
        .chat-text {
            color: #a0f1ff;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .chat-time {
            color: #00ffff;
            font-size: 12px;
        }
        
        .view-all {
            text-align: center;
            color: #00ffff;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }
        
        /* CG Gallery Preview */
        .cg-gallery-preview {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 15px 0;
        }
        
        .cg-thumbnail {
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #00ffff;
        }
        
        .cg-locked {
            opacity: 0.5;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .cg-gallery-preview {
                grid-template-columns: repeat(2, 1fr);
            }
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