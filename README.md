# Neural Chat - Mobil Chat-Based Visual Novel

## 📁 Proje Yapısı

Proje artık frontend ve backend olarak ayrılmıştır:

```
/oyunum/
├── frontend/                 # Frontend dosyaları
│   ├── assets/              # CSS, JS, resimler, sesler
│   │   ├── css/            # Stil dosyaları
│   │   ├── js/             # JavaScript dosyaları
│   │   ├── images/         # Resimler ve karakterler
│   │   └── audio/          # Ses dosyaları
│   ├── main-menu.php        # Ana menü sayfası
│   └── manifest.json        # PWA manifest
├── backend/                 # Backend dosyaları
│   ├── api/                # API endpoint'leri
│   ├── config/             # Konfigürasyon dosyaları
│   ├── includes/           # Yardımcı fonksiyonlar
│   ├── components/         # Yeniden kullanılabilir bileşenler
│   ├── settings/           # Ayarlar sayfaları
│   ├── chat/               # Chat sayfaları
│   ├── calls/              # Arama sayfaları
│   ├── story/               # Hikaye sayfaları
│   ├── characters/          # Karakter sayfaları
│   ├── database/            # Veritabanı dosyaları
│   └── src/                 # MVC yapısı
└── index.php                # Ana giriş noktası
```

## 🚀 Kurulum ve Çalıştırma

1. **Veritabanı Kurulumu:**
   ```bash
   # MySQL/MariaDB'de veritabanı oluşturun
   mysql -u root -p < backend/database/chat_stories_system.sql
   ```

2. **Konfigürasyon:**
   ```bash
   # backend/config/config.php dosyasını düzenleyin
   define('BASE_URL', 'http://localhost:8001');
   ```

3. **Web Sunucusu:**
   ```bash
   # PHP built-in server ile çalıştırın
   php -S localhost:8001
   ```

4. **Tarayıcıda Açın:**
   ```
   http://localhost:8001
   ```

## 📱 Frontend Özellikleri

- **Mobile-First Design:** Tüm UI elementleri dokunmatik cihazlar için optimize edilmiş
- **Progressive Web App (PWA):** Offline destek ve kurulum özelliği
- **Responsive Design:** 320px'den 1024px'e kadar tüm ekran boyutları
- **Modern CSS:** Custom properties ve gradient'ler
- **Web Audio API:** Arka plan müziği ve ses efektleri

## 🔧 Backend Özellikleri

- **PHP 8.x:** Modern OOP ve type hints
- **RESTful API:** Temiz endpoint tasarımı
- **AJAX Mandatory:** Tüm dinamik içerik AJAX ile
- **Security:** CSRF koruması, rate limiting, input sanitization
- **Database:** MySQL/MariaDB ile optimize edilmiş sorgular

## 🎮 Oyun Mekanikleri

### Karakter Sistemi
- **4 Ana Karakter:** Leo (Strategist), Chloe (Hacker), Felix (Heart), Elara (Mentor)
- **Affinity Sistemi:** 0-100 puan ile hikaye ilerlemesi
- **Zamanlı Etkinlikler:** Belirli saatlerde planlanmış sohbetler
- **Telefon Aramaları:** Rastgele ve senaryolu aramalar

### Kaynak Yönetimi
- **Neural Fragments:** Premium para birimi (eski sohbetleri okuma, özel odalar)
- **Memory Shards:** Affinity artırıcı (CG'leri açma, özel seçenekler)
- **Data Points:** Temel para birimi (hediyeler, kozmetikler)

## 🔒 Güvenlik

- **CSRF Protection:** Token tabanlı doğrulama
- **Rate Limiting:** Kullanıcı başına API limitleri
- **Input Sanitization:** Tüm kullanıcı girdileri temizlenir
- **SQL Injection Prevention:** Sadece prepared statements
- **XSS Protection:** Tüm çıktılar escape edilir

## 📊 API Endpoints

### Chat API
- `POST /api/chat/send` - Mesaj gönderme
- `GET /api/chat/history` - Sohbet geçmişi
- `POST /api/chat/typing` - Yazıyor göstergesi

### Character API
- `GET /api/characters/routes` - Karakter rotaları
- `GET /api/characters/affinity` - Affinity durumu
- `POST /api/characters/profile` - Profil güncelleme

### Story API
- `GET /api/story/progress` - Hikaye ilerlemesi
- `POST /api/story/unlock` - Yeni içerik açma
- `POST /api/story/save` - Oyun kaydetme

## 🎨 Renk Paleti

```css
:root {
  --color1: #240f48; /* Primary dark */
  --color2: #841567; /* Accent purple */
  --color3: #7b9fff; /* Bright blue */
  --color4: #ebc7ff; /* Light purple */
  --color5: #fff7ff; /* Near white */
  --gradient-primary: linear-gradient(135deg, var(--color1) 0%, var(--color2) 50%, var(--color3) 100%);
  --glass-effect: rgba(255,255,255,0.06);
}
```

## 🧪 Test

```bash
# PHPUnit testleri (gelecekte eklenecek)
vendor/bin/phpunit tests/
```

## 📝 Geliştirme Notları

- Tüm dosya yolları frontend/backend ayrımına göre güncellenmiştir
- Ana index.php dosyası root seviyesinde entry point olarak çalışır
- Backend dosyaları ../backend/ yolu ile frontend'den erişilir
- Frontend dosyaları ../frontend/ yolu ile backend'den erişilir

## 🔄 Sonraki Adımlar

1. API endpoint'lerini test etme
2. Frontend-backend iletişimini doğrulama
3. Mobile optimizasyonları kontrol etme
4. PWA özelliklerini test etme
5. Güvenlik testleri yapma

---

**Not:** Bu yapı Cursor Rules'a uygun olarak tasarlanmıştır ve mobil-first, AJAX-mandatory yaklaşımını benimser.