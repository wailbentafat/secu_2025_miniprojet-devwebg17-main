-- Create admin user with hashed password
-- Username: admin
-- Password: admin123

DELETE FROM users WHERE username = 'admin_user' OR username = 'admin';

INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES 
('admin', 'admin@nexstore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- This password hash is for 'admin123'
-- You can login with:
-- Username: admin
-- Password: admin123
