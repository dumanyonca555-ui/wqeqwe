-- Essential tables only for login functionality
USE celestial_tale;

-- Users table
CREATE TABLE users (
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

-- Character profiles table - FIXED
CREATE TABLE character_profiles (
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

-- User activities table
CREATE TABLE user_activities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_created_at (created_at)
);

-- Insert test user
INSERT INTO users (id, username, email, password_hash, is_active) VALUES
(1, 'testuser', 'test@example.com', '$2y$12$o6Q5QLlokt2olB9WLjQTh.DN1vqS6EKJ81H32o6TELn2r0gNmc3cC', TRUE);

-- Insert character profile for test user
INSERT INTO character_profiles (user_id, name, backstory, avatar_url, zodiac, age, favorite_color, default_emoji) VALUES
(1, 'Test Character', 'A curious explorer ready to discover the Neural Chat world.', 'https://api.dicebear.com/7.x/adventurer/svg?seed=testcharacter', 'Leo', 25, '#7b9fff', '🌟');