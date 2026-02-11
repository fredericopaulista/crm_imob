-- Migration: Add slug column to properties and create settings table
-- Run this after the main schema.sql

-- Add slug column to properties table
ALTER TABLE `properties` 
ADD COLUMN `slug` VARCHAR(255) DEFAULT NULL AFTER `title`,
ADD UNIQUE KEY `slug` (`slug`),
ADD KEY `idx_status` (`status`),
ADD KEY `idx_purpose` (`purpose`);

-- Create settings table
CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL,
  `setting_value` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default SEO settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('google_search_console', ''),
('google_analytics', ''),
('sitemap_generated_at', NULL),
('robots_generated_at', NULL)
ON DUPLICATE KEY UPDATE `setting_key` = `setting_key`;
