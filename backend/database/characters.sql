-- Characters table
CREATE TABLE IF NOT EXISTS characters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    personality TEXT,
    avatar_url VARCHAR(255),
    status ENUM('online', 'away', 'offline') DEFAULT 'offline',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- User character affinity table
CREATE TABLE IF NOT EXISTS user_character_affinity (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    character_id INT NOT NULL,
    affinity_level INT DEFAULT 0 CHECK (affinity_level >= 0 AND affinity_level <= 100),
    last_interaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (character_id) REFERENCES characters(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_character (user_id, character_id)
);

-- Character CGs table
CREATE TABLE IF NOT EXISTS character_cgs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    character_id INT NOT NULL,
    cg_image VARCHAR(255) NOT NULL,
    unlock_condition TEXT,
    is_unlocked BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (character_id) REFERENCES characters(id) ON DELETE CASCADE
);

-- Insert sample character data
INSERT INTO characters (id, name, title, description, personality, avatar_url, status) VALUES
(1, 'Leo', 'The Strategist', 'Analitik ve koruyucu. Stratejik düşünür.', 'Güven kazanması zor, sadık, geç saatler aktif', 'leo.png', 'online'),
(2, 'Chloe', 'The Hacker', 'Teknoloji sever, renkli, çok aktif.', 'Teknoloji meraklısı, enerjik, her zaman çevrimiçi', 'chloe.png', 'away'),
(3, 'Felix', 'The Heart', 'Neşeli, yemek sever, morale booster.', 'Neşeli, yemek meraklısı, herkesin moralini yükseltir', 'felix.png', 'online'),
(4, 'Elara', 'The Mentor', 'Sakin, analiz eder, iş saatleri aktif.', 'Sakin, düşünceli, deneyimli mentor', 'elara.png', 'offline')
ON DUPLICATE KEY UPDATE name=name;

-- Insert sample CG data
INSERT INTO character_cgs (character_id, cg_image, unlock_condition, is_unlocked) VALUES
(1, 'leo_cg_1.png', 'Affinity > 50', FALSE),
(1, 'leo_cg_2.png', 'Complete Leo\'s story route', FALSE),
(2, 'chloe_cg_1.png', 'Affinity > 30', FALSE),
(2, 'chloe_cg_2.png', 'Send 5 gifts to Chloe', FALSE),
(3, 'felix_cg_1.png', 'Affinity > 70', FALSE),
(3, 'felix_cg_2.png', 'Cook meals with Felix', FALSE),
(4, 'elara_cg_1.png', 'Affinity > 40', FALSE),
(4, 'elara_cg_2.png', 'Complete mentor tasks', FALSE)
ON DUPLICATE KEY UPDATE cg_image=cg_image;