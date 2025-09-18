<?php
session_start();

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$page_title = 'Geçmiş Sohbetler';
$page_description = 'Önceki konuşmaları görüntüle';
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
            <h1>📦 Geçmiş Sohbetler</h1>
            <p>Önceki konuşmaları görüntüle</p>
        </div>

        <!-- Search and Filter -->
        <div class="glass-card">
            <div class="search-filter">
                <div class="search-box">
                    <input type="text" id="searchInput" class="form-control" placeholder="Sohbet ara...">
                    <button class="btn btn-primary">
                        <span>🔍</span>
                    </button>
                </div>
                <div class="filter-options">
                    <select class="form-control" id="characterFilter">
                        <option value="">Tüm Karakterler</option>
                        <option value="leo">Leo</option>
                        <option value="chloe">Chloe</option>
                        <option value="felix">Felix</option>
                        <option value="elara">Elara</option>
                    </select>
                    <select class="form-control" id="dateFilter">
                        <option value="">Tüm Tarihler</option>
                        <option value="today">Bugün</option>
                        <option value="week">Bu Hafta</option>
                        <option value="month">Bu Ay</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Chat History List -->
        <div class="glass-card">
            <h3>Sohbet Geçmişi</h3>
            <div class="chat-history-list">
                <div class="chat-history-item" onclick="viewChatHistory('main', '2024-01-15')">
                    <div class="chat-info">
                        <h4>Ana Chat Odası</h4>
                        <p>Genel sohbet ve etkinlikler</p>
                        <span class="chat-date">15 Ocak 2024</span>
                    </div>
                    <div class="chat-stats">
                        <span class="message-count">24 mesaj</span>
                        <span class="participants">4 katılımcı</span>
                    </div>
                </div>

                <div class="chat-history-item" onclick="viewChatHistory('leo', '2024-01-14')">
                    <div class="chat-info">
                        <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                        <div class="chat-details">
                            <h4>Leo ile Özel Sohbet</h4>
                            <p>Strateji ve analiz konularında sohbet</p>
                            <span class="chat-date">14 Ocak 2024</span>
                        </div>
                    </div>
                    <div class="chat-stats">
                        <span class="message-count">18 mesaj</span>
                        <span class="affinity">+5 Affinity</span>
                    </div>
                </div>

                <div class="chat-history-item" onclick="viewChatHistory('chloe', '2024-01-13')">
                    <div class="chat-info">
                        <img src="../api/characters/character-images/chloe.png" alt="Chloe" class="character-avatar">
                        <div class="chat-details">
                            <h4>Chloe ile Özel Sohbet</h4>
                            <p>Teknoloji ve yaratıcılık hakkında</p>
                            <span class="chat-date">13 Ocak 2024</span>
                        </div>
                    </div>
                    <div class="chat-stats">
                        <span class="message-count">31 mesaj</span>
                        <span class="affinity">+8 Affinity</span>
                    </div>
                </div>

                <div class="chat-history-item" onclick="viewChatHistory('elara', '2024-01-12')">
                    <div class="chat-info">
                        <img src="../api/characters/character-images/elara.png" alt="Elara" class="character-avatar">
                        <div class="chat-details">
                            <h4>Elara ile Özel Sohbet</h4>
                            <p>Bilgelik ve öğrenme konularında</p>
                            <span class="chat-date">12 Ocak 2024</span>
                        </div>
                    </div>
                    <div class="chat-stats">
                        <span class="message-count">22 mesaj</span>
                        <span class="affinity">+12 Affinity</span>
                    </div>
                </div>

                <div class="chat-history-item" onclick="viewChatHistory('felix', '2024-01-11')">
                    <div class="chat-info">
                        <img src="../api/characters/character-images/felix.png" alt="Felix" class="character-avatar">
                        <div class="chat-details">
                            <h4>Felix ile Özel Sohbet</h4>
                            <p>Neşe ve şefkat dolu sohbet</p>
                            <span class="chat-date">11 Ocak 2024</span>
                        </div>
                    </div>
                    <div class="chat-stats">
                        <span class="message-count">15 mesaj</span>
                        <span class="affinity">+3 Affinity</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Viewer Modal -->
        <div class="glass-card" id="chatViewer" style="display: none;">
            <div class="chat-viewer-header">
                <h3 id="viewerTitle">Sohbet Görüntüleyici</h3>
                <button class="btn btn-secondary" onclick="closeChatViewer()">
                    <span>✖</span>
                </button>
            </div>
            <div class="chat-viewer-content" id="chatViewerContent">
                <!-- Chat content will be loaded here -->
            </div>
        </div>
    </div>


    <script>
        function viewChatHistory(chatType, date) {
            document.getElementById('chatViewer').style.display = 'block';
            
            const titles = {
                'main': 'Ana Chat Odası',
                'leo': 'Leo ile Sohbet',
                'chloe': 'Chloe ile Sohbet',
                'felix': 'Felix ile Sohbet',
                'elara': 'Elara ile Sohbet'
            };
            
            document.getElementById('viewerTitle').textContent = titles[chatType] + ' - ' + date;
            
            // Load chat history
            loadChatHistory(chatType, date);
        }

        function closeChatViewer() {
            document.getElementById('chatViewer').style.display = 'none';
        }

        function loadChatHistory(chatType, date) {
            const content = document.getElementById('chatViewerContent');
            content.innerHTML = '';
            
            // Simulate chat history
            const sampleMessages = [
                { sender: 'Leo', message: 'Merhaba! Nasılsın bugün?', time: '14:30' },
                { sender: 'Sen', message: 'İyiyim, teşekkürler! Sen nasılsın?', time: '14:32' },
                { sender: 'Leo', message: 'Ben de iyiyim. Bugün stratejik planlama üzerine çalışıyorum.', time: '14:33' },
                { sender: 'Sen', message: 'Çok ilginç! Bu konuda ne düşünüyorsun?', time: '14:35' },
                { sender: 'Leo', message: 'Analitik düşünce ve uzun vadeli planlama çok önemli.', time: '14:37' }
            ];
            
            sampleMessages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.className = 'history-message';
                
                messageDiv.innerHTML = `
                    <div class="sender">${msg.sender}</div>
                    <div class="content">${msg.message}</div>
                    <div class="timestamp">${msg.time}</div>
                `;
                
                content.appendChild(messageDiv);
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const items = document.querySelectorAll('.chat-history-item');
            
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Filter functionality
        document.getElementById('characterFilter').addEventListener('change', function(e) {
            const filter = e.target.value;
            const items = document.querySelectorAll('.chat-history-item');
            
            items.forEach(item => {
                if (!filter || item.textContent.toLowerCase().includes(filter.toLowerCase())) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
