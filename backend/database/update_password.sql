-- Update test user password
UPDATE users SET password_hash = '$2y$12$o6Q5QLlokt2olB9WLjQTh.DN1vqS6EKJ81H32o6TELn2r0gNmc3cC' WHERE email = 'test@example.com';

-- Alternative: Create a new user if the above doesn't work
INSERT IGNORE INTO users (username, email, password_hash, is_active) VALUES
('testuser2', 'test2@example.com', '$2y$12$o6Q5QLlokt2olB9WLjQTh.DN1vqS6EKJ81H32o6TELn2r0gNmc3cC', TRUE);

-- Insert profile for new user
INSERT IGNORE INTO user_profiles (user_id, avatar, bio) VALUES
(LAST_INSERT_ID(), 'https://api.dicebear.com/7.x/adventurer/svg?seed=testuser2', 'İkinci test kullanıcısı');

-- Insert settings for new user
INSERT IGNORE INTO user_settings (user_id) VALUES (LAST_INSERT_ID());
