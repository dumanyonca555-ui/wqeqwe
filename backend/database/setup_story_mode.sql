-- Create story mode tables
USE celestial_tale;

-- Story chapters table
CREATE TABLE IF NOT EXISTS story_chapters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    chapter_number INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    unlock_time TIME,
    unlock_interval_hours INT DEFAULT 3,
    is_unlocked BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_chapter_number (chapter_number),
    INDEX idx_unlock_time (unlock_time),
    UNIQUE KEY unique_chapter (chapter_number)
);

-- Story dialogues table
CREATE TABLE IF NOT EXISTS story_dialogues (
    id INT PRIMARY KEY AUTO_INCREMENT,
    chapter_id INT NOT NULL,
    character_name VARCHAR(50),
    character_avatar VARCHAR(255),
    dialogue_text TEXT NOT NULL,
    order_sequence INT NOT NULL,
    is_choice_point BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_chapter (chapter_id),
    INDEX idx_order (order_sequence),
    FOREIGN KEY (chapter_id) REFERENCES story_chapters(id) ON DELETE CASCADE
);

-- Story choices table
CREATE TABLE IF NOT EXISTS story_choices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dialogue_id INT NOT NULL,
    choice_text VARCHAR(255) NOT NULL,
    affinity_change JSON,
    leads_to_dialogue_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_dialogue (dialogue_id),
    FOREIGN KEY (dialogue_id) REFERENCES story_dialogues(id) ON DELETE CASCADE,
    FOREIGN KEY (leads_to_dialogue_id) REFERENCES story_dialogues(id) ON DELETE SET NULL
);

-- User story progress table
CREATE TABLE IF NOT EXISTS user_story_progress (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    chapter_id INT NOT NULL,
    completed_at TIMESTAMP NULL,
    choices_made JSON,
    current_dialogue_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_chapter (user_id, chapter_id),
    INDEX idx_user (user_id),
    INDEX idx_chapter (chapter_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (chapter_id) REFERENCES story_chapters(id) ON DELETE CASCADE,
    FOREIGN KEY (current_dialogue_id) REFERENCES story_dialogues(id) ON DELETE SET NULL
);

-- Insert default story chapters
INSERT IGNORE INTO story_chapters (id, chapter_number, title, description, unlock_time, unlock_interval_hours, is_unlocked) VALUES
(1, 1, 'Başlangıç', 'Gece geç saatler, Leo online\'a geçiyor', '15:30:00', 3, TRUE),
(2, 2, 'Tanışma', 'Sabah rutini ve Chloe\'nin gelişi', '18:30:00', 3, TRUE),
(3, 3, 'İlk Görev', 'Tüm karakterlerle görev tanıtımı', '21:30:00', 3, FALSE),
(4, 4, 'Gizem', 'Leo ile gizli bilgi keşfi', '00:30:00', 3, FALSE),
(5, 5, 'Hacking Challenge', 'Chloe ile teknoloji mücadelesi', '03:30:00', 3, FALSE),
(6, 6, 'Grup Yemeği', 'Felix ile sosyal etkinlik', '06:30:00', 3, FALSE),
(7, 7, 'Mentörlük Seansı', 'Elara ile kişisel gelişim', '09:30:00', 3, FALSE),
(8, 8, 'Kriz Yönetimi', 'Tüm karakterlerle kriz yönetimi', '12:30:00', 3, FALSE),
(9, 9, 'Kişisel Anlar', 'Oyuncu seçimine göre kişisel sahne', '15:30:00', 3, FALSE),
(10, 10, 'Final Confrontation', 'Klimaks ve son karar', '18:30:00', 3, FALSE);