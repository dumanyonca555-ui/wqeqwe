-- Database update script to fix character_profiles table structure
-- Run this if you have an existing database with the old structure

-- Drop the old table if it exists with wrong structure
DROP TABLE IF EXISTS character_profiles;

-- Create the correct character_profiles table
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

-- Insert default character profile for test user if it doesn't exist
INSERT IGNORE INTO character_profiles (user_id, name, backstory, avatar_url, zodiac, age, favorite_color, default_emoji) VALUES
(1, 'Test Character', 'A curious explorer ready to discover the Neural Chat world.', 'https://api.dicebear.com/7.x/adventurer/svg?seed=testcharacter', 'Leo', 25, '#7b9fff', '🌟');