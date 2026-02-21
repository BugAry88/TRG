-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `trg-lp12` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Use the database
USE `trg-lp12`;

-- Create lp12_levels table
CREATE TABLE IF NOT EXISTS `lp12_levels` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create component_categories table
CREATE TABLE IF NOT EXISTS `component_categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `display_order` int(11) NOT NULL DEFAULT 0,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create components table
CREATE TABLE IF NOT EXISTS `components` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `category_id` int(11) NOT NULL,
    `name` varchar(200) NOT NULL,
    `price_modifier` decimal(10,2) NOT NULL DEFAULT 0.00,
    `image_path` varchar(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    KEY `category_id` (`category_id`),
    CONSTRAINT `components_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `component_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create compatibility_map table
CREATE TABLE IF NOT EXISTS `compatibility_map` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `level_id` int(11) NOT NULL,
    `component_id` int(11) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    KEY `level_id` (`level_id`),
    KEY `component_id` (`component_id`),
    CONSTRAINT `compatibility_map_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `lp12_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `compatibility_map_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert sample data into lp12_levels
INSERT INTO `lp12_levels` (`id`, `name`, `base_price`) VALUES
(1, 'Majik', 85000.00),
(2, 'Akurate', 195000.00),
(3, 'Klimax', 485000.00),
(4, 'Basic', 1000.00),
(5, 'Standard', 2500.00),
(6, 'Premium', 5000.00)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `base_price` = VALUES(`base_price`);

-- Insert sample data into component_categories
INSERT INTO `component_categories` (`id`, `name`, `display_order`) VALUES
(1, 'Plinth', 1),
(2, 'Tonearm', 2),
(3, 'Cartridge', 3),
(4, 'Power Supply', 4)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `display_order` = VALUES(`display_order`);

-- Insert sample data into components
INSERT INTO `components` (`id`, `category_id`, `name`, `price_modifier`, `description`) VALUES
-- Plinth options
(1, 1, 'Oak Plinth', 0.00, 'Classic oak wood plinth with natural finish'),
(2, 1, 'Rosewood Plinth', 15000.00, 'Premium rosewood plinth with rich tones'),
(3, 1, 'Ebony Plinth', 25000.00, 'Luxury ebony plinth with deep black finish'),

-- Tonearm options
(4, 2, 'Basic Tonearm', 0.00, 'Standard tonearm for reliable performance'),
(5, 2, 'Akito Tonearm', 35000.00, 'Improved tracking and stability'),
(6, 2, 'Ekos SE Tonearm', 65000.00, 'Premium tonearm with enhanced precision'),

-- Cartridge options
(7, 3, 'Krystal Cartridge', 0.00, 'Moving coil cartridge with detailed sound'),
(8, 3, 'Kandid Cartridge', 45000.00, 'High-end cartridge with exceptional clarity'),
(9, 3, 'Klyde Cartridge', 85000.00, 'Reference-grade cartridge for ultimate performance'),

-- Power Supply options
(10, 4, 'Basic Power Supply', 0.00, 'Standard power supply for stable operation'),
(11, 4, 'Lingo Power Supply', 25000.00, 'Improved power regulation and timing'),
(12, 4, 'Radikal Power Supply', 55000.00, 'Ultimate power supply with precision control')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `price_modifier` = VALUES(`price_modifier`), `description` = VALUES(`description`);

-- Insert compatibility data
INSERT INTO `compatibility_map` (`level_id`, `component_id`) VALUES
-- Majik Level (Level 1) - Basic components only
(1, 1), (1, 4), (1, 7), (1, 10),

-- Akurate Level (Level 2) - Mid-range components
(2, 1), (2, 2), (2, 4), (2, 5), (2, 7), (2, 8), (2, 10), (2, 11),

-- Klimax Level (Level 3) - All components
(3, 1), (3, 2), (3, 3), (3, 4), (3, 5), (3, 6), (3, 7), (3, 8), (3, 9), (3, 10), (3, 11), (3, 12),

-- Basic Level (Level 4) - Basic components only
(4, 1), (4, 4), (4, 7), (4, 10),

-- Standard Level (Level 5) - Mid-range components
(5, 1), (5, 2), (5, 4), (5, 5), (5, 7), (5, 8), (5, 10), (5, 11),

-- Premium Level (Level 6) - Premium components only
(6, 2), (6, 3), (6, 5), (6, 6), (6, 8), (6, 9), (6, 11), (6, 12)
ON DUPLICATE KEY UPDATE `level_id` = VALUES(`level_id`), `component_id` = VALUES(`component_id`);

-- Create customers table
CREATE TABLE IF NOT EXISTS `customers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `email` varchar(200) NOT NULL,
    `phone` varchar(20) DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `address` text DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create orders table
CREATE TABLE IF NOT EXISTS `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `order_number` varchar(50) NOT NULL,
    `customer_id` int(11) NOT NULL,
    `customer_name` varchar(200) NOT NULL,
    `customer_email` varchar(200) NOT NULL,
    `customer_phone` varchar(20) DEFAULT NULL,
    `customer_address` text DEFAULT NULL,
    `level_id` int(11) NOT NULL,
    `level_name` varchar(100) NOT NULL,
    `level_price` decimal(10,2) NOT NULL DEFAULT 0.00,
    `components_json` text DEFAULT NULL,
    `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
    `status` varchar(50) NOT NULL DEFAULT 'pending',
    `notes` text DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `order_number` (`order_number`),
    KEY `customer_id` (`customer_id`),
    KEY `level_id` (`level_id`),
    CONSTRAINT `orders_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `orders_level_id_fk` FOREIGN KEY (`level_id`) REFERENCES `lp12_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Show created tables
SHOW TABLES;

-- Show sample data
SELECT 'Levels:' as table_name;
SELECT * FROM lp12_levels;

SELECT 'Categories:' as table_name;
SELECT * FROM component_categories ORDER BY display_order;

SELECT 'Components:' as table_name;
SELECT c.*, cat.name as category_name 
FROM components c 
LEFT JOIN component_categories cat ON c.category_id = cat.id 
ORDER BY cat.display_order, c.name;

SELECT 'Compatibility Map:' as table_name;
SELECT cm.*, l.name as level_name, comp.name as component_name
FROM compatibility_map cm
LEFT JOIN lp12_levels l ON cm.level_id = l.id
LEFT JOIN components comp ON cm.component_id = comp.id
ORDER BY l.id, comp.name;
