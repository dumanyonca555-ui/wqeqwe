<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Test - Celestial Tale</title>
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <link rel="stylesheet" href="assets/css/main-menu.css">
    <link rel="stylesheet" href="assets/css/characters.css">
    <link rel="stylesheet" href="assets/css/enhanced-features.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a0d2e 0%, #2d1b4e 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .test-container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(10px);
        }
        
        .test-title {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .character-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .character-link {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }
        
        .character-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }
        
        .character-avatar-test {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            display: block;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        
        .character-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .character-role {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .image-test {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .image-test h3 {
            color: white;
            margin-bottom: 15px;
        }
        
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .image-item {
            text-align: center;
        }
        
        .image-item img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 10px;
        }
        
        .image-item span {
            color: white;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="starfield"></div>
    <div class="nebula"></div>
    
    <div class="test-container">
        <h1 class="test-title">🎭 Character System Test</h1>
        
        <div class="character-links">
            <a href="character-leo.php" class="character-link">
                <img src="assets/images/characters/leo-portrait.png" alt="Leo" class="character-avatar-test">
                <div class="character-name">Leo</div>
                <div class="character-role">The Strategist</div>
            </a>
            
            <a href="character-chloe.php" class="character-link">
                <img src="assets/images/characters/chloe-portrait.png" alt="Chloe" class="character-avatar-test">
                <div class="character-name">Chloe</div>
                <div class="character-role">The Hacker</div>
            </a>
            
            <a href="character-felix.php" class="character-link">
                <img src="assets/images/characters/felix-portrait.png" alt="Felix" class="character-avatar-test">
                <div class="character-name">Felix</div>
                <div class="character-role">The Heart</div>
            </a>
            
            <a href="character-elara.php" class="character-link">
                <img src="assets/images/characters/elara-portrait.png" alt="Elara" class="character-avatar-test">
                <div class="character-name">Elara</div>
                <div class="character-role">The Mentor</div>
            </a>
        </div>
        
        <div class="image-test">
            <h3>📸 Image Loading Test</h3>
            <div class="image-grid">
                <div class="image-item">
                    <img src="assets/images/characters/leo-portrait.png" alt="Leo">
                    <span>Leo Portrait</span>
                </div>
                <div class="image-item">
                    <img src="assets/images/characters/chloe-portrait.png" alt="Chloe">
                    <span>Chloe Portrait</span>
                </div>
                <div class="image-item">
                    <img src="assets/images/characters/felix-portrait.png" alt="Felix">
                    <span>Felix Portrait</span>
                </div>
                <div class="image-item">
                    <img src="assets/images/characters/elara-portrait.png" alt="Elara">
                    <span>Elara Portrait</span>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="main-menu.php" style="color: #7b9fff; text-decoration: none; font-size: 1.1rem;">
                ← Ana Menüye Dön
            </a>
        </div>
    </div>

    <script src="assets/js/menu-manager.js"></script>
    <script src="assets/js/audio-manager.js"></script>
    <script src="assets/js/main-menu.js"></script>
</body>
</html>
