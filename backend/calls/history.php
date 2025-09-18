<?php
session_start();

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$page_title = 'Telefon Aramaları';
$page_description = 'Missed calls ve call history';
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
            <h1>☎️ Telefon Aramaları</h1>
            <p>Missed calls ve call history</p>
        </div>

        <!-- Call Stats -->
        <div class="glass-card">
            <h3>Arama İstatistikleri</h3>
            <div class="call-stats">
                <div class="stat-item">
                    <span class="stat-number">5</span>
                    <span class="stat-label">Kaçırılan Arama</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Cevaplanan Arama</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">2</span>
                    <span class="stat-label">Reddedilen Arama</span>
                </div>
            </div>
        </div>

        <!-- Call History -->
        <div class="glass-card">
            <h3>Arama Geçmişi</h3>
            <div class="call-history">
                <div class="call-item missed">
                    <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                    <div class="call-info">
                        <h4>Leo</h4>
                        <p>Kaçırılan arama</p>
                        <span class="call-time">2 saat önce</span>
                    </div>
                    <div class="call-actions">
                        <button class="btn btn-primary" onclick="callback('leo')">
                            <span>📞</span>
                            <span>Geri Ara</span>
                        </button>
                    </div>
                </div>

                <div class="call-item answered">
                    <img src="../api/characters/character-images/chloe.png" alt="Chloe" class="character-avatar">
                    <div class="call-info">
                        <h4>Chloe</h4>
                        <p>Cevaplanan arama - 5 dakika</p>
                        <span class="call-time">4 saat önce</span>
                    </div>
                    <div class="call-actions">
                        <button class="btn btn-secondary" onclick="viewCallDetails('chloe')">
                            <span>👁️</span>
                            <span>Detaylar</span>
                        </button>
                    </div>
                </div>

                <div class="call-item missed">
                    <img src="../api/characters/character-images/felix.png" alt="Felix" class="character-avatar">
                    <div class="call-info">
                        <h4>Felix</h4>
                        <p>Kaçırılan arama</p>
                        <span class="call-time">6 saat önce</span>
                    </div>
                    <div class="call-actions">
                        <button class="btn btn-primary" onclick="callback('felix')">
                            <span>📞</span>
                            <span>Geri Ara</span>
                        </button>
                    </div>
                </div>

                <div class="call-item answered">
                    <img src="../api/characters/character-images/elara.png" alt="Elara" class="character-avatar">
                    <div class="call-info">
                        <h4>Elara</h4>
                        <p>Cevaplanan arama - 12 dakika</p>
                        <span class="call-time">1 gün önce</span>
                    </div>
                    <div class="call-actions">
                        <button class="btn btn-secondary" onclick="viewCallDetails('elara')">
                            <span>👁️</span>
                            <span>Detaylar</span>
                        </button>
                    </div>
                </div>

                <div class="call-item declined">
                    <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                    <div class="call-info">
                        <h4>Leo</h4>
                        <p>Reddedilen arama</p>
                        <span class="call-time">2 gün önce</span>
                    </div>
                    <div class="call-actions">
                        <button class="btn btn-primary" onclick="callback('leo')">
                            <span>📞</span>
                            <span>Geri Ara</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call Details Modal -->
        <div class="glass-card" id="callDetails" style="display: none;">
            <div class="call-details-header">
                <h3 id="callDetailsTitle">Arama Detayları</h3>
                <button class="btn btn-secondary" onclick="closeCallDetails()">
                    <span>✖</span>
                </button>
            </div>
            <div class="call-details-content" id="callDetailsContent">
                <!-- Call details will be loaded here -->
            </div>
        </div>
    </div>


    <script>
        function callback(characterId) {
            const characterNames = {
                'leo': 'Leo',
                'chloe': 'Chloe',
                'felix': 'Felix',
                'elara': 'Elara'
            };
            
            // Show calling animation
            const btn = event.target.closest('.btn');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<span>📞</span><span>Aranıyor...</span>';
            btn.disabled = true;
            
            // Simulate call
            setTimeout(() => {
                btn.innerHTML = '<span>✅</span><span>Bağlandı</span>';
                
                setTimeout(() => {
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    showCallNotification(characterNames[characterId]);
                }, 2000);
            }, 3000);
        }

        function viewCallDetails(characterId) {
            document.getElementById('callDetails').style.display = 'block';
            
            const characterNames = {
                'leo': 'Leo',
                'chloe': 'Chloe',
                'felix': 'Felix',
                'elara': 'Elara'
            };
            
            document.getElementById('callDetailsTitle').textContent = characterNames[characterId] + ' - Arama Detayları';
            
            // Load call details
            loadCallDetails(characterId);
        }

        function closeCallDetails() {
            document.getElementById('callDetails').style.display = 'none';
        }

        function loadCallDetails(characterId) {
            const content = document.getElementById('callDetailsContent');
            content.innerHTML = '';
            
            // Simulate call details
            const callDetails = {
                'chloe': {
                    duration: '5 dakika',
                    date: 'Bugün 14:30',
                    type: 'Cevaplanan',
                    transcript: [
                        { speaker: 'Chloe', text: 'Merhaba! Nasılsın?' },
                        { speaker: 'Sen', text: 'İyiyim, teşekkürler! Sen nasılsın?' },
                        { speaker: 'Chloe', text: 'Ben de iyiyim. Yeni bir proje üzerinde çalışıyorum.' },
                        { speaker: 'Sen', text: 'Çok ilginç! Ne tür bir proje?' },
                        { speaker: 'Chloe', text: 'Yapay zeka ile ilgili bir şey. Detaylarını daha sonra anlatırım.' }
                    ]
                },
                'elara': {
                    duration: '12 dakika',
                    date: 'Dün 16:45',
                    type: 'Cevaplanan',
                    transcript: [
                        { speaker: 'Elara', text: 'Merhaba, nasıl gidiyor?' },
                        { speaker: 'Sen', text: 'İyi gidiyor, teşekkürler. Sen nasılsın?' },
                        { speaker: 'Elara', text: 'Ben de iyiyim. Bugün çok güzel bir kitap okudum.' },
                        { speaker: 'Sen', text: 'Hangi kitap?' },
                        { speaker: 'Elara', text: 'Felsefe üzerine bir kitap. Çok derin konular var.' },
                        { speaker: 'Sen', text: 'Bana da önerir misin?' },
                        { speaker: 'Elara', text: 'Tabii ki! Size önerebilirim.' }
                    ]
                }
            };
            
            const details = callDetails[characterId];
            
            // Call summary
            const summaryDiv = document.createElement('div');
            summaryDiv.className = 'call-summary';
            summaryDiv.innerHTML = `
                <h4>Arama Özeti</h4>
                <div class="summary-item">
                    <span class="summary-label">Süre:</span>
                    <span class="summary-value">${details.duration}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Tarih:</span>
                    <span class="summary-value">${details.date}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Durum:</span>
                    <span class="summary-value">${details.type}</span>
                </div>
            `;
            content.appendChild(summaryDiv);
            
            // Call transcript
            const transcriptDiv = document.createElement('div');
            transcriptDiv.className = 'call-transcript';
            transcriptDiv.innerHTML = '<h4>Konuşma Metni</h4>';
            
            details.transcript.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'transcript-item';
                itemDiv.innerHTML = `
                    <div class="transcript-speaker">${item.speaker}</div>
                    <div class="transcript-text">${item.text}</div>
                `;
                transcriptDiv.appendChild(itemDiv);
            });
            
            content.appendChild(transcriptDiv);
        }

        function showCallNotification(characterName) {
            const notification = document.createElement('div');
            notification.className = 'toast-message show';
            notification.textContent = `${characterName} ile arama başarılı!`;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Auto-refresh call status
        setInterval(() => {
            const missedCalls = document.querySelectorAll('.call-item.missed');
            missedCalls.forEach(call => {
                if (Math.random() < 0.1) {
                    call.classList.remove('missed');
                    call.classList.add('answered');
                    const info = call.querySelector('.call-info p');
                    info.textContent = 'Cevaplanan arama - ' + Math.floor(Math.random() * 10) + ' dakika';
                }
            });
        }, 10000);
    </script>
</body>
</html>
