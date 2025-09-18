<?php
session_start();

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$page_title = 'Ana Chat Odası';
$page_description = 'Genel sohbet ve etkinlikler';
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
    <!-- Using shared theme.css instead of duplicate styles -->
</head>
<body>
    <div class="glass-container">
        <a href="../../frontend/main-menu.php" class="btn btn-secondary">
            <span>←</span>
            <span>Ana Menü</span>
        </a>

        <div class="text-center mb-4">
            <h1>🗣️ Ana Chat Odası</h1>
            <p>Genel sohbet ve etkinlikler</p>
        </div>

        <!-- Chat Interface -->
        <div class="glass-card">
            <div class="chat-header">
                <div class="chat-info">
                    <h3>Genel Sohbet</h3>
                    <p class="online-count">4 kişi çevrimiçi</p>
                </div>
                <div class="chat-status">
                    <span class="status-indicator online"></span>
                    <span>Çevrimiçi</span>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                <!-- Messages will be loaded here via AJAX -->
                <div class="message system-message">
                    <div class="message-content">
                        <p>Ana chat odasına hoş geldiniz! Burada tüm karakterlerle genel sohbet edebilirsiniz.</p>
                    </div>
                </div>
            </div>

            <div class="chat-input">
                <form id="messageForm" class="flex">
                    <input type="text" id="messageInput" class="form-control" placeholder="Mesajınızı yazın..." maxlength="500" required>
                    <button type="submit" class="btn btn-primary">
                        <span>📤</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Online Characters -->
        <div class="glass-card">
            <h3>Çevrimiçi Karakterler</h3>
            <div class="characters-online">
                <div class="character-item">
                    <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                    <div class="character-info">
                        <h4>Leo</h4>
                        <p>Stratejist</p>
                    </div>
                    <span class="status-indicator online"></span>
                </div>
                <div class="character-item">
                    <img src="../api/characters/character-images/chloe.png" alt="Chloe" class="character-avatar">
                    <div class="character-info">
                        <h4>Chloe</h4>
                        <p>Hacker</p>
                    </div>
                    <span class="status-indicator online"></span>
                </div>
                <div class="character-item">
                    <img src="../api/characters/character-images/elara.png" alt="Elara" class="character-avatar">
                    <div class="character-info">
                        <h4>Elara</h4>
                        <p>Mentor</p>
                    </div>
                    <span class="status-indicator online"></span>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Chat functionality
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const chatMessages = document.getElementById('chatMessages');

        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = messageInput.value.trim();
            
            if (message) {
                sendMessage(message);
                messageInput.value = '';
            }
        });

        function sendMessage(message) {
            // Add message to chat
            addMessageToChat('You', message, 'user');
            
            // Simulate character response
            setTimeout(() => {
                const responses = [
                    'Merhaba! Nasılsın?',
                    'Bu konuda ne düşünüyorsun?',
                    'İlginç bir nokta!',
                    'Devam et, dinliyorum.',
                    'Bu konuda daha fazla bilgi verebilir misin?'
                ];
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                addMessageToChat('Leo', randomResponse, 'character');
            }, 1000 + Math.random() * 2000);
        }

        function addMessageToChat(sender, message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}-message`;
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            
            const p = document.createElement('p');
            p.textContent = message;
            contentDiv.appendChild(p);
            
            messageDiv.appendChild(contentDiv);
            chatMessages.appendChild(messageDiv);
            
            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Auto-refresh online status
        setInterval(() => {
            // Simulate status updates
            const indicators = document.querySelectorAll('.status-indicator');
            indicators.forEach(indicator => {
                if (Math.random() < 0.1) {
                    indicator.classList.toggle('online');
                }
            });
        }, 5000);
    </script>
</body>
</html>
