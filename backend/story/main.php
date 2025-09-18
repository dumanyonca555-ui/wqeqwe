<?php
session_start();

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$page_title = 'Hikaye Modu';
$page_description = 'Ana hikaye progression';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Neural Chat</title>
    <link rel="stylesheet" href="../../frontend/assets/css/theme.css">
    <link rel="stylesheet" href="../../frontend/assets/css/style.css">
    <link rel="stylesheet" href="../../frontend/assets/css/mobile.css">
</head>
<body>
    <div class="glass-container">
        <a href="../../frontend/main-menu.php" class="btn btn-secondary">
            <span>←</span>
            <span>Ana Menü</span>
        </a>

        <div class="text-center mb-4">
            <h1>📖 Hikaye Modu</h1>
            <p>Ana hikaye progression</p>
        </div>

        <!-- Story Progress -->
        <div class="glass-card">
            <h3>Hikaye İlerlemesi</h3>
            <div class="progress-overview">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 35%"></div>
                </div>
                <div class="progress-text">
                    <span>35% Tamamlandı</span>
                    <span>Bölüm 3 / 8</span>
                </div>
            </div>
        </div>

        <!-- Current Chapter -->
        <div class="glass-card">
            <div class="chapter-header">
                <h3>Bölüm 3: İlk Karşılaşma</h3>
                <div class="chapter-status">
                    <span class="status-badge active">Aktif</span>
                </div>
            </div>
            
            <div class="story-content">
                <p>Neural Chat dünyasına hoş geldiniz. Burada karakterlerle etkileşime geçerek hikayenizi şekillendireceksiniz. Her kararınız hikayenin gidişatını etkileyecek.</p>
                
                <div class="story-choice">
                    <h4>Kararınızı Verin:</h4>
                    <div class="choice-options">
                        <button class="choice-btn" onclick="makeChoice('explore')">
                            <span>🔍</span>
                            <div>
                                <h5>Keşfet</h5>
                                <p>Çevreyi keşfetmeye başla</p>
                            </div>
                        </button>
                        <button class="choice-btn" onclick="makeChoice('socialize')">
                            <span>👥</span>
                            <div>
                                <h5>Sosyalleş</h5>
                                <p>Diğer karakterlerle tanış</p>
                            </div>
                        </button>
                        <button class="choice-btn" onclick="makeChoice('analyze')">
                            <span>🧠</span>
                            <div>
                                <h5>Analiz Et</h5>
                                <p>Durumu analiz et</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Chapters -->
        <div class="glass-card">
            <h3>Mevcut Bölümler</h3>
            <div class="chapters-list">
                <div class="chapter-item completed">
                    <div class="chapter-info">
                        <h4>Bölüm 1: Başlangıç</h4>
                        <p>Hikayenin başlangıcı</p>
                        <span class="completion-status">✅ Tamamlandı</span>
                    </div>
                    <div class="chapter-rewards">
                        <span class="reward">+10 Affinity</span>
                    </div>
                </div>

                <div class="chapter-item completed">
                    <div class="chapter-info">
                        <h4>Bölüm 2: Tanışma</h4>
                        <p>Karakterlerle ilk tanışma</p>
                        <span class="completion-status">✅ Tamamlandı</span>
                    </div>
                    <div class="chapter-rewards">
                        <span class="reward">+15 Affinity</span>
                    </div>
                </div>

                <div class="chapter-item active">
                    <div class="chapter-info">
                        <h4>Bölüm 3: İlk Karşılaşma</h4>
                        <p>Ana karakterlerle karşılaşma</p>
                        <span class="completion-status">🔄 Devam Ediyor</span>
                    </div>
                    <div class="chapter-rewards">
                        <span class="reward">+20 Affinity</span>
                    </div>
                </div>

                <div class="chapter-item locked">
                    <div class="chapter-info">
                        <h4>Bölüm 4: Sırlar</h4>
                        <p>Gizli sırlar ortaya çıkıyor</p>
                        <span class="completion-status">🔒 Kilitli</span>
                    </div>
                    <div class="chapter-rewards">
                        <span class="reward">+25 Affinity</span>
                    </div>
                </div>

                <div class="chapter-item locked">
                    <div class="chapter-info">
                        <h4>Bölüm 5: Çatışma</h4>
                        <p>Büyük çatışma başlıyor</p>
                        <span class="completion-status">🔒 Kilitli</span>
                    </div>
                    <div class="chapter-rewards">
                        <span class="reward">+30 Affinity</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Character Affinity -->
        <div class="glass-card">
            <h3>Karakter Affinity</h3>
            <div class="affinity-list">
                <div class="affinity-item">
                    <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                    <div class="affinity-info">
                        <h4>Leo</h4>
                        <div class="affinity-bar">
                            <div class="affinity-fill" style="width: 75%"></div>
                        </div>
                        <span class="affinity-percentage">75%</span>
                    </div>
                </div>

                <div class="affinity-item">
                    <img src="../api/characters/character-images/chloe.png" alt="Chloe" class="character-avatar">
                    <div class="affinity-info">
                        <h4>Chloe</h4>
                        <div class="affinity-bar">
                            <div class="affinity-fill" style="width: 60%"></div>
                        </div>
                        <span class="affinity-percentage">60%</span>
                    </div>
                </div>

                <div class="affinity-item">
                    <img src="../api/characters/character-images/felix.png" alt="Felix" class="character-avatar">
                    <div class="affinity-info">
                        <h4>Felix</h4>
                        <div class="affinity-bar">
                            <div class="affinity-fill" style="width: 45%"></div>
                        </div>
                        <span class="affinity-percentage">45%</span>
                    </div>
                </div>

                <div class="affinity-item">
                    <img src="../api/characters/character-images/elara.png" alt="Elara" class="character-avatar">
                    <div class="affinity-info">
                        <h4>Elara</h4>
                        <div class="affinity-bar">
                            <div class="affinity-fill" style="width: 90%"></div>
                        </div>
                        <span class="affinity-percentage">90%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function makeChoice(choice) {
            // Show loading
            const btn = event.target.closest('.choice-btn');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<span>⏳</span><div><h5>İşleniyor...</h5><p>Kararınız kaydediliyor</p></div>';
            btn.disabled = true;
            
            // Simulate choice processing
            setTimeout(() => {
                btn.innerHTML = '<span>✅</span><div><h5>Tamamlandı!</h5><p>Kararınız kaydedildi</p></div>';
                
                // Show next story content
                setTimeout(() => {
                    showNextStoryContent(choice);
                }, 1500);
            }, 2000);
        }

        function showNextStoryContent(choice) {
            const storyContent = document.querySelector('.story-content');
            
            const responses = {
                'explore': {
                    title: 'Keşif Başlıyor',
                    content: 'Çevreyi keşfetmeye başladınız. Yeni alanlar ve gizli köşeler buluyorsunuz. Bu keşif sırasında Leo ile karşılaşıyorsunuz.',
                    affinity: '+5 Leo Affinity'
                },
                'socialize': {
                    title: 'Sosyalleşme',
                    content: 'Diğer karakterlerle tanışmaya karar verdiniz. Chloe ve Felix ile güzel bir sohbet başlıyor.',
                    affinity: '+3 Chloe, +3 Felix Affinity'
                },
                'analyze': {
                    title: 'Analiz',
                    content: 'Durumu analiz etmeye başladınız. Elara bu analitik yaklaşımınızı takdir ediyor.',
                    affinity: '+8 Elara Affinity'
                }
            };
            
            const response = responses[choice];
            
            storyContent.innerHTML = `
                <h4>${response.title}</h4>
                <p>${response.content}</p>
                <div class="choice-result">
                    <span class="affinity-gain">${response.affinity}</span>
                </div>
                <button class="btn btn-primary" onclick="continueStory()">Devam Et</button>
            `;
        }

        function continueStory() {
            // Reset story content
            const storyContent = document.querySelector('.story-content');
            storyContent.innerHTML = `
                <p>Hikaye devam ediyor... Yeni kararlar almanız gerekecek.</p>
                <div class="story-choice">
                    <h4>Sonraki Kararınız:</h4>
                    <div class="choice-options">
                        <button class="choice-btn" onclick="makeChoice('explore')">
                            <span>🔍</span>
                            <div>
                                <h5>Keşfet</h5>
                                <p>Çevreyi keşfetmeye başla</p>
                            </div>
                        </button>
                        <button class="choice-btn" onclick="makeChoice('socialize')">
                            <span>👥</span>
                            <div>
                                <h5>Sosyalleş</h5>
                                <p>Diğer karakterlerle tanış</p>
                            </div>
                        </button>
                        <button class="choice-btn" onclick="makeChoice('analyze')">
                            <span>🧠</span>
                            <div>
                                <h5>Analiz Et</h5>
                                <p>Durumu analiz et</p>
                            </div>
                        </button>
                    </div>
                </div>
            `;
        }

        // Update affinity bars with animation
        document.addEventListener('DOMContentLoaded', function() {
            const affinityBars = document.querySelectorAll('.affinity-fill');
            affinityBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
</body>
</html>
