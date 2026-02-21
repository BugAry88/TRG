-- LP12 Database Setup Script
-- Creates 4 tables for the LP12 turntable configuration system

-- Create lp12_levels table
CREATE TABLE `lp12_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create component_categories table
CREATE TABLE `component_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create components table
CREATE TABLE `components` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_modifier` decimal(10,2) NOT NULL DEFAULT '0.00',
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `components_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `component_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create compatibility_map table
CREATE TABLE `compatibility_map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` int(11) unsigned NOT NULL,
  `component_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_compatibility` (`level_id`,`component_id`),
  KEY `level_id` (`level_id`),
  KEY `component_id` (`component_id`),
  CONSTRAINT `compatibility_map_component_id_foreign` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compatibility_map_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `lp12_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert sample data into lp12_levels
INSERT INTO `lp12_levels` (`name`, `base_price`, `created_at`, `updated_at`) VALUES
('Majik', 2500.00, NOW(), NOW()),
('Akurate', 8500.00, NOW(), NOW()),
('Klimax', 25000.00, NOW(), NOW());

-- Insert sample data into component_categories
INSERT INTO `component_categories` (`name`, `display_order`, `created_at`, `updated_at`) VALUES
('Plinth', 1, NOW(), NOW()),
('Tonearm', 2, NOW(), NOW()),
('Cartridge', 3, NOW(), NOW()),
('Power Supply', 4, NOW(), NOW());

-- Insert sample data into components
INSERT INTO `components` (`category_id`, `name`, `price_modifier`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
-- Plinths
(1, 'Majik Plinth', 0.00, '/images/plinths/majik.jpg', 'Standard Majik level plinth with basic finish', NOW(), NOW()),
(1, 'Akurate Plinth', 2000.00, '/images/plinths/akurate.jpg', 'Enhanced Akurate level plinth with premium materials', NOW(), NOW()),
(1, 'Klimax Plinth', 8000.00, '/images/plinths/klimax.jpg', 'Premium Klimax level plinth with exotic materials', NOW(), NOW()),

-- Tonearms
(2, 'Majik Tonearm', 0.00, '/images/tonearms/majik.jpg', 'Basic tonearm for Majik level turntables', NOW(), NOW()),
(2, 'Akurate Tonearm', 1500.00, '/images/tonearms/akurate.jpg', 'Enhanced tonearm with improved bearings', NOW(), NOW()),
(2, 'Ekos SE Tonearm', 5000.00, '/images/tonearms/ekos_se.jpg', 'Premium tonearm for Klimax level systems', NOW(), NOW()),

-- Cartridges
(3, 'Krystal Cartridge', 0.00, '/images/cartridges/krystal.jpg', 'Standard cartridge for Majik and Akurate levels', NOW(), NOW()),
(3, 'Kandid Cartridge', 2500.00, '/images/cartridges/kandid.jpg', 'High-performance cartridge for Akurate level', NOW(), NOW()),
(3, 'Klyde Cartridge', 8000.00, '/images/cartridges/klyde.jpg', 'Reference cartridge for Klimax level systems', NOW(), NOW()),

-- Power Supplies
(4, 'Majik Power Supply', 0.00, '/images/power/majik_psu.jpg', 'Basic power supply for Majik level', NOW(), NOW()),
(4, 'Akurate Power Supply', 1200.00, '/images/power/akurate_psu.jpg', 'Enhanced power supply with better regulation', NOW(), NOW()),
(4, 'Radikal Power Supply', 6000.00, '/images/power/radikal.jpg', 'Ultimate reference power supply for Klimax level', NOW(), NOW());

-- Insert compatibility mappings
INSERT INTO `compatibility_map` (`level_id`, `component_id`, `created_at`, `updated_at`) VALUES
-- Majik Level (1) - compatible with basic components
(1, 1, NOW(), NOW()), -- Majik Plinth
(1, 4, NOW(), NOW()), -- Majik Tonearm
(1, 7, NOW(), NOW()), -- Krystal Cartridge
(1, 10, NOW(), NOW()), -- Majik Power Supply

-- Akurate Level (2) - compatible with Majik and Akurate components
(2, 1, NOW(), NOW()), -- Majik Plinth
(2, 2, NOW(), NOW()), -- Akurate Plinth
(2, 4, NOW(), NOW()), -- Majik Tonearm
(2, 5, NOW(), NOW()), -- Akurate Tonearm
(2, 7, NOW(), NOW()), -- Krystal Cartridge
(2, 8, NOW(), NOW()), -- Kandid Cartridge
(2, 10, NOW(), NOW()), -- Majik Power Supply
(2, 11, NOW(), NOW()), -- Akurate Power Supply

-- Klimax Level (3) - compatible with all components
(3, 1, NOW(), NOW()), -- Majik Plinth
(3, 2, NOW(), NOW()), -- Akurate Plinth
(3, 3, NOW(), NOW()), -- Klimax Plinth
(3, 4, NOW(), NOW()), -- Majik Tonearm
(3, 5, NOW(), NOW()), -- Akurate Tonearm
(3, 6, NOW(), NOW()), -- Ekos SE Tonearm
(3, 7, NOW(), NOW()), -- Krystal Cartridge
(3, 8, NOW(), NOW()), -- Kandid Cartridge
(3, 9, NOW(), NOW()), -- Klyde Cartridge
(3, 10, NOW(), NOW()), -- Majik Power Supply
(3, 11, NOW(), NOW()), -- Akurate Power Supply
(3, 12, NOW(), NOW()); -- Radikal Power Supply

-- Create customers table
CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create orders table
CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) NOT NULL,
  `customer_id` int(11) unsigned NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `level_id` int(11) unsigned NOT NULL,
  `level_name` varchar(100) NOT NULL,
  `level_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `components_json` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `customer_id` (`customer_id`),
  KEY `level_id` (`level_id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `lp12_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
