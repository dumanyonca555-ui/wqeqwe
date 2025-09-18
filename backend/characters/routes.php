<?php
session_start();

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$page_title = 'Karakter Rotaları';
$page_description = '4 karakter individual story paths';
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
            <h1>👥 Karakter Rotaları</h1>
            <p>4 karakter individual story paths</p>
        </div>

        <!-- Character Routes -->
        <div class="routes-grid">
            <div class="route-card" onclick="openRoute('leo')">
                <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                <div class="route-info">
                    <h3>Leo - Stratejist Yolu</h3>
                    <p>Analitik düşünce ve stratejik planlama</p>
                    <div class="route-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                        <span class="progress-text">75% Tamamlandı</span>
                    </div>
                    <div class="route-status">
                        <span class="status-badge active">Aktif</span>
                        <span class="affinity">75% Affinity</span>
                    </div>
                </div>
            </div>

            <div class="route-card" onclick="openRoute('chloe')">
                <img src="../api/characters/character-images/chloe.png" alt="Chloe" class="character-avatar">
                <div class="route-info">
                    <h3>Chloe - Hacker Yolu</h3>
                    <p>Teknoloji ve yaratıcılık</p>
                    <div class="route-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 60%"></div>
                        </div>
                        <span class="progress-text">60% Tamamlandı</span>
                    </div>
                    <div class="route-status">
                        <span class="status-badge active">Aktif</span>
                        <span class="affinity">60% Affinity</span>
                    </div>
                </div>
            </div>

            <div class="route-card" onclick="openRoute('felix')">
                <img src="../api/characters/character-images/felix.png" alt="Felix" class="character-avatar">
                <div class="route-info">
                    <h3>Felix - Kalp Yolu</h3>
                    <p>Neşe ve şefkat</p>
                    <div class="route-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 45%"></div>
                        </div>
                        <span class="progress-text">45% Tamamlandı</span>
                    </div>
                    <div class="route-status">
                        <span class="status-badge locked">Kilitli</span>
                        <span class="affinity">45% Affinity</span>
                    </div>
                </div>
            </div>

            <div class="route-card" onclick="openRoute('elara')">
                <img src="../api/characters/character-images/elara.png" alt="Elara" class="character-avatar">
                <div class="route-info">
                    <h3>Elara - Mentor Yolu</h3>
                    <p>Bilgelik ve öğrenme</p>
                    <div class="route-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 90%"></div>
                        </div>
                        <span class="progress-text">90% Tamamlandı</span>
                    </div>
                    <div class="route-status">
                        <span class="status-badge completed">Tamamlandı</span>
                        <span class="affinity">90% Affinity</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Route Details Modal -->
        <div class="glass-card" id="routeDetails" style="display: none;">
            <div class="route-details-header">
                <h3 id="routeTitle">Karakter Rotası</h3>
                <button class="btn btn-secondary" onclick="closeRouteDetails()">
                    <span>✖</span>
                </button>
            </div>
            <div class="route-details-content" id="routeDetailsContent">
                <!-- Route details will be loaded here -->
            </div>
        </div>
    </div>


    <script>
        function openRoute(characterId) {
            document.getElementById('routeDetails').style.display = 'block';
            
            const characterNames = {
                'leo': 'Leo - Stratejist Yolu',
                'chloe': 'Chloe - Hacker Yolu',
                'felix': 'Felix - Kalp Yolu',
                'elara': 'Elara - Mentor Yolu'
            };
            
            document.getElementById('routeTitle').textContent = characterNames[characterId];
            
            // Load route details
            loadRouteDetails(characterId);
        }

        function closeRouteDetails() {
            document.getElementById('routeDetails').style.display = 'none';
        }

        function loadRouteDetails(characterId) {
            const content = document.getElementById('routeDetailsContent');
            content.innerHTML = '';
            
            // Simulate route chapters
            const routeChapters = {
                'leo': [
                    { title: 'Stratejik Düşünce', description: 'Analitik yaklaşım ve planlama becerileri', status: 'completed', reward: '+10 Affinity' },
                    { title: 'Liderlik', description: 'Takım yönetimi ve karar verme', status: 'completed', reward: '+15 Affinity' },
                    { title: 'Kriz Yönetimi', description: 'Zor durumlarda stratejik çözümler', status: 'active', reward: '+20 Affinity' },
                    { title: 'Gelecek Planlaması', description: 'Uzun vadeli stratejik vizyon', status: 'locked', reward: '+25 Affinity' }
                ],
                'chloe': [
                    { title: 'Teknoloji Tutkusu', description: 'Yeni teknolojileri keşfetme', status: 'completed', reward: '+10 Affinity' },
                    { title: 'Yaratıcılık', description: 'İnovatif çözümler geliştirme', status: 'completed', reward: '+15 Affinity' },
                    { title: 'Problem Çözme', description: 'Karmaşık problemleri çözme', status: 'active', reward: '+20 Affinity' },
                    { title: 'İnovasyon', description: 'Yeni fikirler ve projeler', status: 'locked', reward: '+25 Affinity' }
                ],
                'felix': [
                    { title: 'Neşe ve Pozitiflik', description: 'Olumlu enerji yayma', status: 'completed', reward: '+10 Affinity' },
                    { title: 'Şefkat', description: 'Diğerlerine karşı şefkatli yaklaşım', status: 'active', reward: '+15 Affinity' },
                    { title: 'Empati', description: 'Başkalarının duygularını anlama', status: 'locked', reward: '+20 Affinity' },
                    { title: 'İyileştirme', description: 'Çevresini iyileştirme', status: 'locked', reward: '+25 Affinity' }
                ],
                'elara': [
                    { title: 'Bilgelik', description: 'Derin düşünce ve analiz', status: 'completed', reward: '+10 Affinity' },
                    { title: 'Mentorluk', description: 'Diğerlerine rehberlik etme', status: 'completed', reward: '+15 Affinity' },
                    { title: 'Öğretme', description: 'Bilgi aktarma ve öğretme', status: 'completed', reward: '+20 Affinity' },
                    { title: 'Felsefe', description: 'Hayatın anlamını keşfetme', status: 'completed', reward: '+25 Affinity' }
                ]
            };
            
            const chapters = routeChapters[characterId];
            
            chapters.forEach(chapter => {
                const chapterDiv = document.createElement('div');
                chapterDiv.className = 'route-chapter';
                
                const statusIcon = {
                    'completed': '✅',
                    'active': '🔄',
                    'locked': '🔒'
                };
                
                chapterDiv.innerHTML = `
                    <h4>${chapter.title}</h4>
                    <p>${chapter.description}</p>
                    <div class="chapter-status">
                        <span>${statusIcon[chapter.status]} ${chapter.status === 'completed' ? 'Tamamlandı' : chapter.status === 'active' ? 'Aktif' : 'Kilitli'}</span>
                        <span class="chapter-reward">${chapter.reward}</span>
                    </div>
                `;
                
                content.appendChild(chapterDiv);
            });
        }

        // Animate progress bars
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
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
