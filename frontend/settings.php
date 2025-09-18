<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ayarlar - Celestial Tale</title>
  <link rel="stylesheet" href="assets/css/theme.css">
  <link rel="stylesheet" href="assets/css/animations.css">
  <link rel="stylesheet" href="assets/css/mobile.css">
  <link rel="stylesheet" href="assets/css/main-menu.css">
  <link rel="stylesheet" href="assets/css/enhanced-features.css">
  <link rel="stylesheet" href="assets/css/settings.css">
  <style>
    /* Ensure Montserrat font usage */
    * {
      font-family: 'Montserrat', sans-serif !important;
    }

    .settings-container {
      max-width: 800px;
      margin: 0 auto;
      padding: var(--spacing-lg);
    }

    .settings-section {
      background: var(--glass-bg);
      backdrop-filter: blur(var(--blur-md));
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-xl);
      padding: var(--spacing-lg);
      margin-bottom: var(--spacing-lg);
      transition: var(--transition-normal);
    }

    .settings-section:hover {
      border-color: var(--glass-border-strong);
      box-shadow: var(--shadow-glow);
      transform: translateY(-2px);
    }

    .settings-section h3 {
      color: var(--color5);
      margin-bottom: var(--spacing-lg);
      font-size: 1.2rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: var(--spacing-sm);
      font-family: 'Montserrat', sans-serif;
    }

    .setting-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: var(--spacing-md) 0;
      border-bottom: 1px solid var(--glass-border);
      flex-wrap: wrap;
      gap: var(--spacing-sm);
    }

    .setting-item:last-child {
      border-bottom: none;
    }

    .setting-label {
      color: var(--color5);
      font-weight: 600;
      font-family: 'Montserrat', sans-serif;
      flex: 1;
      min-width: 0;
    }

    .setting-description {
      color: var(--color4);
      font-size: 0.8rem;
      margin-top: var(--spacing-xs);
      font-family: 'Montserrat', sans-serif;
      line-height: 1.4;
    }

    .setting-control {
      flex-shrink: 0;
      display: flex;
      align-items: center;
      gap: var(--spacing-sm);
    }

    .volume-slider {
      width: 120px;
      height: 6px;
      background: var(--glass-bg);
      border-radius: 3px;
      outline: none;
      border: 1px solid var(--glass-border);
      cursor: pointer;
    }

    .volume-slider::-webkit-slider-thumb {
      appearance: none;
      width: 18px;
      height: 18px;
      background: var(--gradient-secondary);
      border-radius: 50%;
      cursor: pointer;
      transition: var(--transition-normal);
    }

    .volume-slider::-webkit-slider-thumb:hover {
      transform: scale(1.1);
    }

    .toggle-switch {
      width: 50px;
      height: 26px;
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: 13px;
      position: relative;
      cursor: pointer;
      transition: var(--transition-normal);
    }

    .toggle-switch.active {
      background: var(--gradient-secondary);
      border-color: transparent;
    }

    .toggle-switch::after {
      content: '';
      position: absolute;
      top: 2px;
      left: 2px;
      width: 20px;
      height: 20px;
      background: var(--color5);
      border-radius: 50%;
      transition: transform var(--transition-normal);
    }

    .toggle-switch.active::after {
      transform: translateX(24px);
    }

    .select-dropdown {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-md);
      color: var(--color5);
      padding: var(--spacing-sm) var(--spacing-md);
      min-width: 120px;
      font-family: 'Montserrat', sans-serif;
      cursor: pointer;
      transition: var(--transition-normal);
    }

    .select-dropdown:hover {
      border-color: var(--glass-border-strong);
    }

    .volume-display {
      color: var(--color3);
      font-weight: 700;
      min-width: 40px;
      text-align: center;
      font-family: 'Montserrat', sans-serif;
      font-size: 0.9rem;
    }

    .settings-actions {
      display: flex;
      gap: var(--spacing-md);
      justify-content: center;
      margin-top: var(--spacing-xl);
      flex-wrap: wrap;
    }

    .btn {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      color: var(--color4);
      padding: var(--spacing-md) var(--spacing-lg);
      border-radius: var(--radius-xl);
      cursor: pointer;
      transition: var(--transition-normal);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: var(--spacing-sm);
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
      min-width: max-content;
    }

    .btn:hover {
      border-color: var(--glass-border-strong);
      color: var(--color5);
      transform: translateY(-2px);
      box-shadow: var(--shadow-glow);
    }

    .btn-primary {
      background: var(--gradient-secondary);
      color: var(--color5);
      border-color: transparent;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .settings-container {
        padding: var(--spacing-md);
      }

      .setting-item {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
      }

      .setting-control {
        width: 100%;
        justify-content: space-between;
      }

      .volume-slider {
        width: 100px;
      }

      .settings-actions {
        flex-direction: column;
        align-items: stretch;
      }

      .btn {
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .settings-section {
        padding: var(--spacing-md);
      }

      .settings-section h3 {
        font-size: 1.1rem;
      }

      .setting-label {
        font-size: 0.9rem;
      }

      .setting-description {
        font-size: 0.75rem;
      }
    }


  </style>
</head>
<body>
  <!-- Ana menü temasıyla uyumlu background -->
  <div class="starfield"></div>
  <div class="nebula"></div>

  <main class="main-container">
    <div id="ajax-content" class="content-container">
      <div class="settings-container">


    <!-- Header -->
    <div style="text-align: center; margin-bottom: var(--spacing-xl);">
      <h1 style="color: var(--color5); margin-bottom: var(--spacing-sm); font-family: 'Montserrat', sans-serif; font-size: 2rem; font-weight: 800;">⚙️ Ayarlar</h1>
      <p style="color: var(--color4); font-family: 'Montserrat', sans-serif; font-size: 1rem;">Oyun deneyiminizi kişiselleştirin</p>
    </div>

    <!-- Audio Settings -->
    <div class="settings-section">
      <h3>🔊 Ses Ayarları</h3>

      <div class="setting-item">
        <div class="setting-label">
          Ana Ses Seviyesi
          <div class="setting-description">Tüm seslerin genel seviyesi</div>
        </div>
        <div class="setting-control">
          <input type="range" id="master-volume" class="volume-slider" min="0" max="100" value="100">
          <span class="volume-display" id="master-volume-display">100%</span>
        </div>
      </div>

      <div class="setting-item">
        <div class="setting-label">
          Müzik Seviyesi
          <div class="setting-description">Arka plan müziği seviyesi</div>
        </div>
        <div class="setting-control">
          <input type="range" id="music-volume" class="volume-slider" min="0" max="100" value="50">
          <span class="volume-display" id="music-volume-display">50%</span>
        </div>
      </div>

      <div class="setting-item">
        <div class="setting-label">
          Ses Efektleri
          <div class="setting-description">Tıklama ve bildirim sesleri</div>
        </div>
        <div class="setting-control">
          <input type="range" id="sfx-volume" class="volume-slider" min="0" max="100" value="70">
          <span class="volume-display" id="sfx-volume-display">70%</span>
        </div>
      </div>

      <div class="setting-item">
        <div class="setting-label">
          Tüm Sesleri Kapat
          <div class="setting-description">Ana ses kontrolü</div>
        </div>
        <div class="setting-control">
          <div class="toggle-switch" id="master-mute"></div>
        </div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Müziği Kapat</div>
          <div class="setting-description">Sadece arka plan müziğini kapat</div>
        </div>
        <div class="toggle-switch" id="music-mute"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Ses Efektlerini Kapat</div>
          <div class="setting-description">Sadece ses efektlerini kapat</div>
        </div>
        <div class="toggle-switch" id="sfx-mute"></div>
      </div>
    </div>

    <!-- Display Settings -->
    <div class="settings-section">
      <h3>🎨 Görsel Ayarlar</h3>

      <div class="setting-item">
        <div>
          <div class="setting-label">Animasyonlar</div>
          <div class="setting-description">Geçiş animasyonları ve efektler</div>
        </div>
        <div class="toggle-switch active" id="animations-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Parçacık Efektleri</div>
          <div class="setting-description">Arka plan parçacık animasyonları</div>
        </div>
        <div class="toggle-switch active" id="particles-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Cursor Efektleri</div>
          <div class="setting-description">Mouse takip eden parallax efektler</div>
        </div>
        <div class="toggle-switch active" id="cursor-effects-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Yazı Boyutu</div>
          <div class="setting-description">Metin ve arayüz boyutu</div>
        </div>
        <select class="select-dropdown" id="font-size-select">
          <option value="small">Küçük</option>
          <option value="medium" selected>Orta</option>
          <option value="large">Büyük</option>
        </select>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Metin Hızı</div>
          <div class="setting-description">Karakter başına yazma hızı</div>
        </div>
        <div style="display: flex; align-items: center; gap: 12px;">
          <input type="range" id="text-speed" class="volume-slider" min="10" max="100" value="50">
          <span class="volume-display" id="text-speed-display">50</span>
        </div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Azaltılmış Hareket</div>
          <div class="setting-description">Hareket hassasiyeti olanlar için</div>
        </div>
        <div class="toggle-switch" id="reduced-motion-toggle"></div>
      </div>
    </div>

    <!-- Notification Settings -->
    <div class="settings-section">
      <h3>🔔 Bildirimler</h3>

      <div class="setting-item">
        <div>
          <div class="setting-label">Masaüstü Bildirimleri</div>
          <div class="setting-description">Tarayıcı bildirimleri (izin gerekli)</div>
        </div>
        <div class="toggle-switch" id="desktop-notifications-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Oyun İçi Bildirimler</div>
          <div class="setting-description">Oyun içinde görünen bildirimler</div>
        </div>
        <div class="toggle-switch active" id="ingame-notifications-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Mesaj Bildirimleri</div>
          <div class="setting-description">Yeni mesaj bildirimleri</div>
        </div>
        <div class="toggle-switch active" id="message-notifications-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Etkinlik Bildirimleri</div>
          <div class="setting-description">Özel etkinlik bildirimleri</div>
        </div>
        <div class="toggle-switch active" id="event-notifications-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Titreşim (Mobil)</div>
          <div class="setting-description">Mobil cihazlarda titreşim</div>
        </div>
        <div class="toggle-switch active" id="vibration-toggle"></div>
      </div>
    </div>

    <!-- Account Settings -->
    <div class="settings-section">
      <h3>👤 Hesap Ayarları</h3>

      <div class="setting-item">
        <div>
          <div class="setting-label">Kullanıcı Adı</div>
          <div class="setting-description">Oyun içinde görünen isim</div>
        </div>
        <input type="text" id="username-input" class="select-dropdown" value="Player" style="min-width: 150px;">
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">E-posta</div>
          <div class="setting-description">Hesap e-posta adresi</div>
        </div>
        <input type="email" id="email-input" class="select-dropdown" value="" placeholder="email@example.com" style="min-width: 200px;">
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Dil</div>
          <div class="setting-description">Arayüz dili</div>
        </div>
        <select class="select-dropdown" id="language-select">
          <option value="tr" selected>Türkçe</option>
          <option value="en">English</option>
        </select>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Otomatik Kaydetme</div>
          <div class="setting-description">İlerlemeyi otomatik kaydet</div>
        </div>
        <div class="toggle-switch active" id="auto-save-toggle"></div>
      </div>
    </div>

    <!-- Data & Privacy -->
    <div class="settings-section">
      <h3>🔒 Veri ve Gizlilik</h3>

      <div class="setting-item">
        <div>
          <div class="setting-label">Analitik Veriler</div>
          <div class="setting-description">Oyun geliştirme için anonim veri toplama</div>
        </div>
        <div class="toggle-switch" id="analytics-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Hata Raporlama</div>
          <div class="setting-description">Hataları otomatik raporla</div>
        </div>
        <div class="toggle-switch active" id="crash-reporting-toggle"></div>
      </div>

      <div class="setting-item">
        <div>
          <div class="setting-label">Kişiselleştirilmiş İçerik</div>
          <div class="setting-description">Oyun tarzınıza göre öneriler</div>
        </div>
        <div class="toggle-switch active" id="personalized-content-toggle"></div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="settings-actions">
      <button class="btn secondary" id="reset-settings-btn">↩ Varsayılanlara Dön</button>
      <button class="btn" id="export-settings-btn">📤 Ayarları Dışa Aktar</button>
      <button class="btn" id="import-settings-btn">📥 Ayarları İçe Aktar</button>
      <button class="btn primary" id="save-settings-btn">💾 Kaydet</button>
    </div>

    <!-- Hidden file input for import -->
    <input type="file" id="import-file-input" accept=".json" style="display: none;">
  </div>

  <!-- Scripts - Load in correct order -->
  <script src="assets/js/loading-manager.js"></script>
  <script src="assets/js/data-manager.js"></script>
  <script src="assets/js/settings-manager.js"></script>
  <script src="assets/js/audio-manager.js"></script>
  <script src="assets/js/navigation.js"></script>
  <script src="assets/js/parallax-cursor.js"></script>
  <script src="assets/js/app-integration.js"></script>
  <script>
    // Settings Page Controller
    class SettingsPageController {
      constructor() {
        this.init();
      }

      init() {
        console.log('⚙️ Settings Page Initializing...');

        // Wait for settings manager to be ready
        if (window.settingsManager) {
          this.setupEventListeners();
          this.loadCurrentSettings();
        } else {
          // Wait for settings manager
          document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
              if (window.settingsManager) {
                this.setupEventListeners();
                this.loadCurrentSettings();
              }
            }, 500);
          });
        }
      }

      setupEventListeners() {
        // Audio controls
        this.setupVolumeSlider('master-volume', 'audio', 'masterVolume');
        this.setupVolumeSlider('music-volume', 'audio', 'musicVolume');
        this.setupVolumeSlider('sfx-volume', 'audio', 'sfxVolume');

        this.setupToggle('master-mute', 'audio', 'muted');
        this.setupToggle('music-mute', 'audio', 'musicMuted');
        this.setupToggle('sfx-mute', 'audio', 'sfxMuted');

        // Display controls
        this.setupToggle('animations-toggle', 'display', 'animationsEnabled');
        this.setupToggle('particles-toggle', 'display', 'particleEffectsEnabled');
        this.setupToggle('cursor-effects-toggle', 'display', 'cursorEffectsEnabled');
        this.setupToggle('reduced-motion-toggle', 'display', 'reducedMotion');

        this.setupSelect('font-size-select', 'display', 'fontSize');
        this.setupVolumeSlider('text-speed', 'display', 'textSpeed');

        // Notification controls
        this.setupToggle('desktop-notifications-toggle', 'notifications', 'desktopNotifications');
        this.setupToggle('ingame-notifications-toggle', 'notifications', 'inGameNotifications');
        this.setupToggle('message-notifications-toggle', 'notifications', 'messageNotifications');
        this.setupToggle('event-notifications-toggle', 'notifications', 'eventNotifications');
        this.setupToggle('vibration-toggle', 'notifications', 'vibrationEnabled');

        // Account controls
        this.setupInput('username-input', 'account', 'username');
        this.setupInput('email-input', 'account', 'email');
        this.setupSelect('language-select', 'account', 'language');
        this.setupToggle('auto-save-toggle', 'account', 'autoSave');

        // Privacy controls
        this.setupToggle('analytics-toggle', 'privacy', 'analytics');
        this.setupToggle('crash-reporting-toggle', 'privacy', 'crashReporting');
        this.setupToggle('personalized-content-toggle', 'privacy', 'personalizedContent');

        // Action buttons
        document.getElementById('reset-settings-btn').addEventListener('click', () => {
          if (confirm('Tüm ayarları varsayılan değerlere döndürmek istediğinizden emin misiniz?')) {
            window.settingsManager.resetToDefaults();
            this.loadCurrentSettings();
            this.showNotification('Ayarlar varsayılan değerlere döndürüldü!', 'success');
          }
        });

        document.getElementById('export-settings-btn').addEventListener('click', () => {
          window.settingsManager.exportSettings();
          this.showNotification('Ayarlar dışa aktarıldı!', 'success');
        });

        document.getElementById('import-settings-btn').addEventListener('click', () => {
          document.getElementById('import-file-input').click();
        });

        document.getElementById('import-file-input').addEventListener('change', (e) => {
          const file = e.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
              try {
                const success = window.settingsManager.importSettings(e.target.result);
                if (success) {
                  this.loadCurrentSettings();
                  this.showNotification('Ayarlar başarıyla içe aktarıldı!', 'success');
                } else {
                  this.showNotification('Ayarlar içe aktarılırken hata oluştu!', 'error');
                }
              } catch (error) {
                this.showNotification('Geçersiz ayar dosyası!', 'error');
              }
            };
            reader.readAsText(file);
          }
        });

        document.getElementById('save-settings-btn').addEventListener('click', () => {
          window.settingsManager.saveSettings();
          this.showNotification('Ayarlar kaydedildi!', 'success');
        });
      }

      setupVolumeSlider(elementId, category, key) {
        const slider = document.getElementById(elementId);
        const display = document.getElementById(elementId + '-display');

        if (!slider) return;

        slider.addEventListener('input', (e) => {
          const value = parseFloat(e.target.value) / 100;
          window.settingsManager.set(category, key, value);

          if (display) {
            display.textContent = Math.round(value * 100) + (key === 'textSpeed' ? '' : '%');
          }
        });
      }

      setupToggle(elementId, category, key) {
        const toggle = document.getElementById(elementId);
        if (!toggle) return;

        toggle.addEventListener('click', () => {
          const currentValue = window.settingsManager.get(category, key);
          const newValue = !currentValue;

          window.settingsManager.set(category, key, newValue);
          toggle.classList.toggle('active', newValue);
        });
      }

      setupSelect(elementId, category, key) {
        const select = document.getElementById(elementId);
        if (!select) return;

        select.addEventListener('change', (e) => {
          window.settingsManager.set(category, key, e.target.value);
        });
      }

      setupInput(elementId, category, key) {
        const input = document.getElementById(elementId);
        if (!input) return;

        input.addEventListener('change', (e) => {
          window.settingsManager.set(category, key, e.target.value);
        });
      }

      loadCurrentSettings() {
        if (!window.settingsManager) return;

        const settings = window.settingsManager.getAll();

        // Load audio settings
        this.setSliderValue('master-volume', settings.audio.masterVolume * 100);
        this.setSliderValue('music-volume', settings.audio.musicVolume * 100);
        this.setSliderValue('sfx-volume', settings.audio.sfxVolume * 100);

        this.setToggleState('master-mute', settings.audio.muted);
        this.setToggleState('music-mute', settings.audio.musicMuted);
        this.setToggleState('sfx-mute', settings.audio.sfxMuted);

        // Load display settings
        this.setToggleState('animations-toggle', settings.display.animationsEnabled);
        this.setToggleState('particles-toggle', settings.display.particleEffectsEnabled);
        this.setToggleState('cursor-effects-toggle', settings.display.cursorEffectsEnabled);
        this.setToggleState('reduced-motion-toggle', settings.display.reducedMotion);

        this.setSelectValue('font-size-select', settings.display.fontSize);
        this.setSliderValue('text-speed', settings.display.textSpeed);

        // Load notification settings
        this.setToggleState('desktop-notifications-toggle', settings.notifications.desktopNotifications);
        this.setToggleState('ingame-notifications-toggle', settings.notifications.inGameNotifications);
        this.setToggleState('message-notifications-toggle', settings.notifications.messageNotifications);
        this.setToggleState('event-notifications-toggle', settings.notifications.eventNotifications);
        this.setToggleState('vibration-toggle', settings.notifications.vibrationEnabled);

        // Load account settings
        this.setInputValue('username-input', settings.account.username);
        this.setInputValue('email-input', settings.account.email);
        this.setSelectValue('language-select', settings.account.language);
        this.setToggleState('auto-save-toggle', settings.account.autoSave);

        // Load privacy settings
        this.setToggleState('analytics-toggle', settings.privacy.analytics);
        this.setToggleState('crash-reporting-toggle', settings.privacy.crashReporting);
        this.setToggleState('personalized-content-toggle', settings.privacy.personalizedContent);

        console.log('⚙️ Settings loaded into UI');
      }

      setSliderValue(elementId, value) {
        const slider = document.getElementById(elementId);
        const display = document.getElementById(elementId + '-display');

        if (slider) {
          slider.value = value;
          if (display) {
            display.textContent = Math.round(value) + (elementId.includes('speed') ? '' : '%');
          }
        }
      }

      setToggleState(elementId, active) {
        const toggle = document.getElementById(elementId);
        if (toggle) {
          toggle.classList.toggle('active', active);
        }
      }

      setSelectValue(elementId, value) {
        const select = document.getElementById(elementId);
        if (select) {
          select.value = value;
        }
      }

      setInputValue(elementId, value) {
        const input = document.getElementById(elementId);
        if (input) {
          input.value = value || '';
        }
      }

      showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type} show`;
        notification.textContent = message;
        notification.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          background: var(--glass-bg);
          backdrop-filter: var(--blur-glass);
          border: 1px solid var(--glass-border);
          border-radius: 12px;
          padding: 16px 20px;
          color: var(--c5);
          z-index: 1000;
          opacity: 0;
          transform: translateX(100px);
          transition: all 0.3s ease;
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
          notification.style.opacity = '1';
          notification.style.transform = 'translateX(0)';
        }, 10);

        // Remove after 3 seconds
        setTimeout(() => {
          notification.style.opacity = '0';
          notification.style.transform = 'translateX(100px)';
          setTimeout(() => {
            document.body.removeChild(notification);
          }, 300);
        }, 3000);
      }
    }

    // Initialize settings page
    const settingsPageController = new SettingsPageController();
  </script>
      </div>
    </div>
  </main>
</body>
</html>