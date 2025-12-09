-- MySQL schema for Apartmani project
-- Runs on MySQL 5.7+ / 8.0+

CREATE DATABASE IF NOT EXISTS `apartmani` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `apartmani`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `apartment_amenities`;
DROP TABLE IF EXISTS `amenities`;
DROP TABLE IF EXISTS `images`;
DROP TABLE IF EXISTS `apartment_translations`;
DROP TABLE IF EXISTS `house_rules`;
DROP TABLE IF EXISTS `bookings`;
DROP TABLE IF EXISTS `apartments`;

SET FOREIGN_KEY_CHECKS = 1;

-- apartments
CREATE TABLE `apartments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(191) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `beds` INT DEFAULT 0,
  `baths` INT DEFAULT 0,
  `guests` INT DEFAULT 1,
  `rating` DECIMAL(3,2) DEFAULT 0.00,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- translations for apartments (name, descriptions per lang)
CREATE TABLE `apartment_translations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `apartment_id` INT NOT NULL,
  `lang` VARCHAR(2) NOT NULL,
  `name` TEXT NOT NULL,
  `sub_name` TEXT DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `long_description` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_apartment_lang` (`apartment_id`, `lang`),
  KEY `idx_apartment` (`apartment_id`),
  CONSTRAINT `fk_apartment_trans_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- images
CREATE TABLE `images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `apartment_id` INT NOT NULL,
  `url` TEXT NOT NULL,
  `alt` TEXT DEFAULT NULL,
  `is_featured` TINYINT(1) DEFAULT 0,
  `display_order` INT DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_images_apartment` (`apartment_id`),
  CONSTRAINT `fk_images_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- amenities (master list)
CREATE TABLE `amenities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(100) NOT NULL,
  `label` VARCHAR(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_amenity_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- pivot table
CREATE TABLE `apartment_amenities` (
  `apartment_id` INT NOT NULL,
  `amenity_id` INT NOT NULL,
  PRIMARY KEY (`apartment_id`, `amenity_id`),
  KEY `idx_amenity` (`amenity_id`),
  CONSTRAINT `fk_apartment_amenity_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartments`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_apartment_amenity_amenity` FOREIGN KEY (`amenity_id`) REFERENCES `amenities`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- house rules (ordered per apartment)
CREATE TABLE `house_rules` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `apartment_id` INT NOT NULL,
  `rule_text` TEXT NOT NULL,
  `display_order` INT DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_rules_apartment` (`apartment_id`),
  CONSTRAINT `fk_rules_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- bookings
CREATE TABLE `bookings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `apartment_id` INT NOT NULL,
  `from_date` DATE NOT NULL,
  `to_date` DATE NOT NULL,
  `guests` INT NOT NULL DEFAULT 1,
  `nights` INT NOT NULL DEFAULT 0,
  `total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `customer_name` VARCHAR(191) DEFAULT NULL,
  `customer_email` VARCHAR(191) DEFAULT NULL,
  `customer_phone` VARCHAR(50) DEFAULT NULL,
  `status` VARCHAR(32) DEFAULT 'pending',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_bookings_apartment` (`apartment_id`),
  CONSTRAINT `fk_bookings_apartment` FOREIGN KEY (`apartment_id`) REFERENCES `apartments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- end
