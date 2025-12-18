-- Clear existing items and add clothing products
DELETE FROM items;
DELETE FROM categories;

-- Add clothing categories
INSERT INTO `categories` (`id`, `name`) VALUES 
(1, 'Men'),
(2, 'Women'),
(3, 'Accessories');

-- Add clothing items with Google image URLs
INSERT INTO `items` (`name`, `description`, `price`, `image_url`, `category_id`, `stock`) VALUES 
-- Men's Clothing
('Classic White T-Shirt', 'Premium cotton, comfortable fit. Perfect for everyday wear.', 29.99, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500', 1, 50),
('Slim Fit Jeans', 'Dark wash denim, modern slim fit. Versatile and stylish.', 79.99, 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=500', 1, 35),
('Leather Jacket', 'Genuine leather, classic biker style. Timeless piece.', 299.99, 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=500', 1, 15),
('Casual Sneakers', 'Comfortable white sneakers, perfect for any outfit.', 89.99, 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=500', 1, 40),

-- Women's Clothing
('Floral Summer Dress', 'Light and breezy, perfect for warm days. Elegant floral pattern.', 69.99, 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=500', 2, 30),
('High-Waisted Jeans', 'Vintage style, comfortable stretch denim. Flattering fit.', 85.99, 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=500', 2, 45),
('Silk Blouse', 'Elegant silk fabric, versatile for work or evening wear.', 119.99, 'https://images.unsplash.com/photo-1564257577-7fd5f1b8b5d0?w=500', 2, 25),
('Ankle Boots', 'Stylish leather boots with comfortable heel. All-season wear.', 149.99, 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=500', 2, 20),

-- Accessories
('Leather Crossbody Bag', 'Compact and stylish, perfect for daily essentials.', 89.99, 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=500', 3, 35),
('Classic Sunglasses', 'UV protection, timeless aviator style.', 59.99, 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500', 3, 60),
('Wool Scarf', 'Soft merino wool, available in multiple colors. Winter essential.', 45.99, 'https://images.unsplash.com/photo-1520903920243-00d872a2d1c9?w=500', 3, 40),
('Minimalist Watch', 'Sleek design, leather strap. Perfect accessory for any outfit.', 199.99, 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=500', 3, 25);
