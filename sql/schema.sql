CREATE DATABASE IF NOT EXISTS `db`;
USE `db`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'admin') NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10, 2) NOT NULL,
    `image_url` VARCHAR(255),
    `category_id` INT,
    `stock` INT DEFAULT 0,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `cart` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `item_id` INT NOT NULL,
    `quantity` INT DEFAULT 1,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Inserts
INSERT INTO `categories` (`name`) VALUES ('Electronics'), ('Books'), ('Clothing');
INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES 
('admin_user', 'admin@shop.com', '$2y$10$e0MYzXy..hashedpassword..', 'admin');

INSERT INTO `items` (`name`, `description`, `price`, `image_url`, `category_id`, `stock`) VALUES 
('Mechanical Keyboard', 'RGB Backlit, Blue Switches.', 59.99, 'keyboard.jpg', 1, 15),
('Gaming Mouse', '12000 DPI, Ergonomic design.', 35.50, 'mouse.jpg', 1, 30),
('Smart Coffee Mug', 'Keeps your drink at 55°C.', 25.00, 'mug.jpg', 2, 10);
