<?php
session_start();

// Settings header include
require_once '../config/config.php';

$page_title = 'Yardım';
$page_description = 'SSS ve destek';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Ayarlar</title>
    <link rel="stylesheet" href="../../frontend/assets/css/theme.css">
    <link rel="stylesheet" href="../../frontend/assets/css/style.css">
    <!-- Using shared theme.css instead of duplicate styles -->
</head>
<body>
    <div class="glass-container">
        <a href="../../frontend/main-menu.php" class="btn btn-secondary">
            <span>←</span>
            <span>Ana Menü</span>
        </a>

        <div class="text-center mb-4">
            <h1>❓ Yardım</h1>
            <p>SSS ve destek</p>
        </div>

        <div class="glass-card">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Oyun nasıl oynanır?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                <p>Oyun, karakterlerle sohbet ederek ilişkilerinizi geliştirdiğiniz interaktif bir hikaye deneyimidir. Ana menüden karakterleri seçin, onlarla sohbet edin ve hikayenizi şekillendirin.</p>
            </div>
        </div>

        <div class="glass-card">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Karakterlerle nasıl sohbet edebilirim?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                <p>Ana menüden "Karakterler" seçeneğine tıklayın, istediğiniz karakteri seçin ve özel sohbet odasına girin. Mesajlarınızı yazın ve karakterlerin yanıtlarını bekleyin.</p>
            </div>
        </div>

        <div class="glass-card">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Ayarlarımı nasıl değiştirebilirim?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                <p>Ana menüden "Ayarlar" seçeneğine tıklayın. Ses, görsel, bildirimler ve hesap ayarlarınızı buradan değiştirebilirsiniz.</p>
            </div>
        </div>

        <div class="glass-card">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Oyun verilerim kayboldu, ne yapmalıyım?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                <p>Verileriniz otomatik olarak kaydedilir. Eğer verileriniz kaybolduysa, tarayıcınızın çerezlerini temizlememiş olduğunuzdan emin olun. Sorun devam ederse destek ekibiyle iletişime geçin.</p>
            </div>
        </div>

        <div class="glass-card">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Mobil cihazlarda oynayabilir miyim?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-answer">
                <p>Evet! Oyun mobil cihazlarda da mükemmel çalışır. Responsive tasarım sayesinde telefon ve tabletinizde sorunsuz oynayabilirsiniz.</p>
            </div>
        </div>

        <div class="glass-card text-center">
            <h3>📞 İletişim</h3>
            <p>Daha fazla yardıma ihtiyacınız var mı?</p>
            <p>E-posta: <a href="mailto:support@neuralchat.com">support@neuralchat.com</a></p>
            <p>Discord: <a href="#">NeuralChat Community</a></p>
            <p>Twitter: <a href="#">@NeuralChatGame</a></p>
        </div>
    </div>

    <script>
        function toggleFAQ(element) {
            const faqItem = element.closest('.glass-card');
            const answer = faqItem.querySelector('.faq-answer');
            const icon = element.querySelector('.faq-icon');
            
            // Close all other FAQ items
            document.querySelectorAll('.glass-card').forEach(item => {
                if (item !== faqItem) {
                    const otherAnswer = item.querySelector('.faq-answer');
                    const otherIcon = item.querySelector('.faq-icon');
                    if (otherAnswer) {
                        otherAnswer.style.display = 'none';
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                }
            });
            
            // Toggle current FAQ item
            if (answer) {
                const isVisible = answer.style.display === 'block';
                answer.style.display = isVisible ? 'none' : 'block';
                if (icon) {
                    icon.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            }
        }

        // Add CSS for FAQ functionality
        const style = document.createElement('style');
        style.textContent = `
            .faq-question {
                padding: 15px;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                color: var(--color5);
                font-weight: 600;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            .faq-question:hover {
                background: rgba(132, 21, 103, 0.1);
            }
            .faq-answer {
                padding: 15px;
                color: var(--color4);
                line-height: 1.6;
                display: none;
            }
            .faq-icon {
                transition: transform 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>