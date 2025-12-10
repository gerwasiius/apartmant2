-- Migration: create admin database schema with audit and lockout support
-- Run this on the DB server where your main app is hosted.
-- Includes tables for users, audit log, and account lockout management.

DROP DATABASE IF EXISTS `apartmani_admin`;
CREATE DATABASE `apartmani_admin` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `apartmani_admin`;

-- Admin users table with lockout support
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'admin',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` TIMESTAMP NULL DEFAULT NULL,
  `failed_attempts` INT UNSIGNED NOT NULL DEFAULT 0,
  `locked_until` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Audit log for tracking login attempts and security events
CREATE TABLE IF NOT EXISTS `admin_audit` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` INT UNSIGNED NULL,
  `action` VARCHAR(255) NOT NULL,
  `meta` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX (`admin_id`),
  INDEX (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
