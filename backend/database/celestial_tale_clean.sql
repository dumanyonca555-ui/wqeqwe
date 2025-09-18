-- ========================================
-- OYUNUM - CELESTIAL TALE DATABASE SCHEMA
-- Clean version - Fixed for login redirect issues
-- ========================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS celestial_tale CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE celestial_tale;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    login_attempts INT DEFAULT 0,
    locked_until TIMESTAMP NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_active (is_active)
);

-- Character profiles table (FIXED VERSION)
CREATE TABLE IF NOT EXISTS character_profiles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    backstory TEXT,
    avatar_url VARCHAR(255),
    zodiac VARCHAR(20) DEFAULT 'Leo',
    age INT DEFAULT 25,
    favorite_color VARCHAR(7) DEFAULT '#7b9fff',
    default_emoji VARCHAR(10) DEFAULT '🌟',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_name (name)
);

-- User profiles table
CREATE TABLE IF NOT EXISTS user_profiles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    avatar VARCHAR(255),
    bio TEXT,
    preferences JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_profile (user_id)
);

-- User settings table
CREATE TABLE IF NOT EXISTS user_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    master_volume INT DEFAULT 70,
    music_enabled BOOLEAN DEFAULT TRUE,
    sound_effects BOOLEAN DEFAULT TRUE,
    character_voices BOOLEAN DEFAULT TRUE,
    brightness INT DEFAULT 80,
    auto_forward_speed INT DEFAULT 3,
    high_contrast BOOLEAN DEFAULT FALSE,
    developer_console BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_settings (user_id)
);

-- User activities table
CREATE TABLE IF NOT EXISTS user_activities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_created_at (created_at)
);

-- Characters table  
CREATE TABLE IF NOT EXISTS characters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    avatar VARCHAR(255),
    status ENUM('online', 'offline', 'typing', 'away') DEFAULT 'offline',
    last_active TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    affinity_level INT DEFAULT 0,
    bio TEXT,
    personality TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_affinity (affinity_level)
);

-- Messages table
CREATE TABLE IF NOT EXISTS messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT NOT NULL,
    receiver_id INT NULL,
    character_id INT NULL,
    message TEXT NOT NULL,
    message_type ENUM('text', 'image', 'system', 'voice') DEFAULT 'text',
    is_read BOOLEAN DEFAULT FALSE,
    chat_type ENUM('main', 'private', 'group') DEFAULT 'main',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_sender (sender_id),
    INDEX idx_receiver (receiver_id),
    INDEX idx_character (character_id),
    INDEX idx_chat_type (chat_type),
    INDEX idx_created_at (created_at)
);

-- Calls table
CREATE TABLE IF NOT EXISTS calls (
    id INT PRIMARY KEY AUTO_INCREMENT,
    character_id INT NOT NULL,
    user_id INT NOT NULL,
    call_type ENUM('incoming', 'outgoing') NOT NULL,
    status ENUM('answered', 'missed', 'declined', 'busy') DEFAULT 'missed',
    duration INT DEFAULT 0,
    call_content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_character (character_id),
    INDEX idx_user (user_id),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

-- Stories table
CREATE TABLE IF NOT EXISTS stories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    character_id INT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    story_type ENUM('main', 'character_route', 'side_story') DEFAULT 'main',
    is_unlocked BOOLEAN DEFAULT FALSE,
    unlock_requirement TEXT,
    order_index INT DEFAULT 0,
    affinity_required INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_character (character_id),
    INDEX idx_story_type (story_type),
    INDEX idx_unlocked (is_unlocked),
    INDEX idx_order (order_index)
);

-- User progress table
CREATE TABLE IF NOT EXISTS user_progress (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    story_id INT NOT NULL,
    character_id INT NULL,
    progress_percentage INT DEFAULT 0,
    last_read_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_story (user_id, story_id),
    INDEX idx_user (user_id),
    INDEX idx_story (story_id),
    INDEX idx_character (character_id)
);

-- Character affinity table
CREATE TABLE IF NOT EXISTS character_affinity (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    character_id INT NOT NULL,
    affinity_points INT DEFAULT 0,
    last_interaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_character (user_id, character_id),
    INDEX idx_user (user_id),
    INDEX idx_character (character_id),
    INDEX idx_affinity (affinity_points)
);

-- Chat rooms table
CREATE TABLE IF NOT EXISTS chat_rooms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_name VARCHAR(100) NOT NULL,
    room_type ENUM('main', 'private', 'group') NOT NULL,
    character_id INT NULL,
    user_id INT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    last_message_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_room_type (room_type),
    INDEX idx_character (character_id),
    INDEX idx_user (user_id),
    INDEX idx_active (is_active)
);

-- Insert default data AFTER tables are created

-- Insert default characters
INSERT IGNORE INTO characters (id, name, avatar, status, affinity_level, bio, personality) VALUES
(1, 'Leo', 'api/characters/character-images/leo.png', 'online', 75, 'The Strategist - Analitik ve koruyucu', 'Analitik düşünce yapısı, koruyucu doğası, stratejik yaklaşım'),
(2, 'Chloe', 'api/characters/character-images/chloe.png', 'online', 60, 'The Hacker - Enerjik ve teknoloji sever', 'Enerjik kişilik, teknoloji tutkusu, yaratıcı çözümler'),
(3, 'Felix', 'api/characters/character-images/felix.png', 'offline', 45, 'The Heart - Neşeli ve şefkatli', 'Neşeli doğa, şefkatli yaklaşım, pozitif enerji'),
(4, 'Elara', 'api/characters/character-images/elara.png', 'online', 90, 'The Mentor - Bilge ve sakin', 'Bilge kişilik, sakin yaklaşım, mentorluk yeteneği');

-- Insert default stories
INSERT IGNORE INTO stories (id, character_id, title, content, story_type, is_unlocked, order_index, affinity_required) VALUES
(1, NULL, 'Ana Hikaye - Başlangıç', 'Neural Chat dünyasına hoş geldiniz. Burada karakterlerle etkileşime geçerek hikayenizi şekillendireceksiniz.', 'main', TRUE, 1, 0),
(2, 1, 'Leo - Stratejist Yolu', 'Leo ile stratejik düşünce ve analiz becerilerinizi geliştirin.', 'character_route', FALSE, 1, 50),
(3, 2, 'Chloe - Hacker Yolu', 'Chloe ile teknoloji ve yaratıcılık dünyasını keşfedin.', 'character_route', FALSE, 1, 40),
(4, 3, 'Felix - Kalp Yolu', 'Felix ile neşe ve şefkat dolu bir yolculuğa çıkın.', 'character_route', FALSE, 1, 30),
(5, 4, 'Elara - Mentor Yolu', 'Elara ile bilgelik ve öğrenme yolunda ilerleyin.', 'character_route', FALSE, 1, 60);

-- Insert default chat rooms
INSERT IGNORE INTO chat_rooms (id, room_name, room_type, is_active) VALUES
(1, 'Ana Chat Odası', 'main', TRUE),
(2, 'Özel Chat Odaları', 'private', TRUE),
(3, 'Geçmiş Sohbetler', 'main', TRUE);

-- Insert default test user
INSERT IGNORE INTO users (id, username, email, password_hash, is_active) VALUES
(1, 'testuser', 'test@example.com', '$2y$12$o6Q5QLlokt2olB9WLjQTh.DN1vqS6EKJ81H32o6TELn2r0gNmc3cC', TRUE);

-- Insert default user profile for test user
INSERT IGNORE INTO user_profiles (user_id, avatar, bio) VALUES
(1, 'https://api.dicebear.com/7.x/adventurer/svg?seed=testuser', 'Test kullanıcısı - Neural Chat dünyasını keşfetmeye hazır!');

-- Insert default settings for test user
INSERT IGNORE INTO user_settings (user_id) VALUES (1);

-- Insert default character profile for test user (FIXED)
INSERT IGNORE INTO character_profiles (user_id, name, backstory, avatar_url, zodiac, age, favorite_color, default_emoji) VALUES
(1, 'Test Character', 'A curious explorer ready to discover the Neural Chat world.', 'https://api.dicebear.com/7.x/adventurer/svg?seed=testcharacter', 'Leo', 25, '#7b9fff', '🌟');