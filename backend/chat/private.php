<?php
session_start();

// Check if user is logged in
if (!is_logged_in()) {
    redirect('/index.php');
}

$page_title = 'Özel Chat Odaları';
$page_description = 'Karakterlerle özel sohbetler';
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
            <h1>🔒 Özel Chat Odaları</h1>
            <p>Karakterlerle özel sohbetler</p>
        </div>

        <!-- Character Selection -->
        <div class="glass-card">
            <h3>Karakter Seçimi</h3>
            <div class="characters-grid">
                <div class="character-card" onclick="openPrivateChat('leo')">
                    <img src="../api/characters/character-images/leo.png" alt="Leo" class="character-avatar">
                    <div class="character-info">
                        <h4>Leo</h4>
                        <p>The Strategist</p>
                        <span class="affinity">75% Affinity</span>
                    </div>
                    <div class="character-status">
                        <span class="status-indicator online"></span>
                        <span class="unread-count">3</span>
                    </div>
                </div>

                <div class="character-card" onclick="openPrivateChat('chloe')">
                    <img src="../api/characters/character-images/chloe.png" alt="Chloe" class="character-avatar">
                    <div class="character-info">
                        <h4>Chloe</h4>
                        <p>The Hacker</p>
                        <span class="affinity">60% Affinity</span>
                    </div>
                    <div class="character-status">
                        <span class="status-indicator online"></span>
                        <span class="unread-count">5</span>
                    </div>
                </div>

                <div class="character-card" onclick="openPrivateChat('felix')">
                    <img src="../api/characters/character-images/felix.png" alt="Felix" class="character-avatar">
                    <div class="character-info">
                        <h4>Felix</h4>
                        <p>The Heart</p>
                        <span class="affinity">45% Affinity</span>
                    </div>
                    <div class="character-status">
                        <span class="status-indicator offline"></span>
                        <span class="unread-count">2</span>
                    </div>
                </div>

                <div class="character-card" onclick="openPrivateChat('elara')">
                    <img src="../api/characters/character-images/elara.png" alt="Elara" class="character-avatar">
                    <div class="character-info">
                        <h4>Elara</h4>
                        <p>The Mentor</p>
                        <span class="affinity">90% Affinity</span>
                    </div>
                    <div class="character-status">
                        <span class="status-indicator online"></span>
                        <span class="unread-count">1</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Private Chat Interface (Hidden by default) -->
        <div class="glass-card" id="privateChatInterface" style="display: none;">
            <div class="chat-header">
                <div class="chat-info">
                    <h3 id="chatCharacterName">Karakter</h3>
                    <p id="chatCharacterStatus">Durum</p>
                </div>
                <button class="btn btn-secondary" onclick="closePrivateChat()">
                    <span>✖</span>
                </button>
            </div>

            <div class="chat-messages" id="privateChatMessages">
                <!-- Messages will be loaded here -->
            </div>

            <div class="chat-input">
                <form id="privateMessageForm" class="flex">
                    <input type="text" id="privateMessageInput" class="form-control" placeholder="Özel mesajınızı yazın..." maxlength="500" required>
                    <button type="submit" class="btn btn-primary">
                        <span>📤</span>
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        let currentCharacter = null;

        function openPrivateChat(characterId) {
            currentCharacter = characterId;
            const characterNames = {
                'leo': 'Leo',
                'chloe': 'Chloe', 
                'felix': 'Felix',
                'elara': 'Elara'
            };
            
            document.getElementById('chatCharacterName').textContent = characterNames[characterId];
            document.getElementById('chatCharacterStatus').textContent = 'Özel sohbet';
            document.getElementById('privateChatInterface').style.display = 'block';
            
            // Load chat history
            loadPrivateChatHistory(characterId);
        }

        function closePrivateChat() {
            document.getElementById('privateChatInterface').style.display = 'none';
            currentCharacter = null;
        }

        function loadPrivateChatHistory(characterId) {
            const messagesContainer = document.getElementById('privateChatMessages');
            messagesContainer.innerHTML = '';
            
            // Simulate chat history
            const sampleMessages = [
                { sender: 'character', message: 'Merhaba! Özel sohbetimize hoş geldin.' },
                { sender: 'user', message: 'Merhaba! Nasılsın?' },
                { sender: 'character', message: 'İyiyim, teşekkürler. Sen nasılsın?' }
            ];
            
            sampleMessages.forEach(msg => {
                addPrivateMessage(msg.sender, msg.message);
            });
        }

        function addPrivateMessage(sender, message) {
            const messagesContainer = document.getElementById('privateChatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${sender}-message`;
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            
            const p = document.createElement('p');
            p.textContent = message;
            contentDiv.appendChild(p);
            
            messageDiv.appendChild(contentDiv);
            messagesContainer.appendChild(messageDiv);
            
            // Scroll to bottom
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Private message form
        document.getElementById('privateMessageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const message = document.getElementById('privateMessageInput').value.trim();
            
            if (message && currentCharacter) {
                addPrivateMessage('user', message);
                document.getElementById('privateMessageInput').value = '';
                
                // Simulate character response
                setTimeout(() => {
                    const responses = [
                        'Bu konuda ne düşünüyorsun?',
                        'İlginç bir nokta!',
                        'Devam et, dinliyorum.',
                        'Bu konuda daha fazla bilgi verebilir misin?',
                        'Anlıyorum, çok mantıklı.'
                    ];
                    const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                    addPrivateMessage('character', randomResponse);
                }, 1000 + Math.random() * 2000);
            }
        });
    </script>
</body>
</html>
