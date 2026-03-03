-- ============================================================
-- IOI WEBSITE TRANSLATION TABLES
-- Import this via phpMyAdmin on Hostinger
-- ============================================================

-- Languages table
CREATE TABLE IF NOT EXISTS `wp_ioi_languages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(5) NOT NULL UNIQUE,
    `name` VARCHAR(50) NOT NULL,
    `native_name` VARCHAR(50) NOT NULL,
    `is_default` TINYINT(1) DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert languages
INSERT INTO `wp_ioi_languages` (`code`, `name`, `native_name`, `is_default`, `sort_order`) VALUES
('en', 'English', 'English', 1, 1),
('de', 'German', 'Deutsch', 0, 2),
('es', 'Spanish', 'Español', 0, 3),
('fr', 'French', 'Français', 0, 4),
('ro', 'Romanian', 'Română', 0, 5),
('it', 'Italian', 'Italiano', 0, 6),
('pt', 'Portuguese', 'Português', 0, 7),
('nl', 'Dutch', 'Nederlands', 0, 8)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Content sections
CREATE TABLE IF NOT EXISTS `wp_ioi_sections` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `section_key` VARCHAR(100) NOT NULL UNIQUE,
    `section_name` VARCHAR(200) NOT NULL,
    `page` VARCHAR(50) DEFAULT 'landing',
    `sort_order` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sections
INSERT INTO `wp_ioi_sections` (`section_key`, `section_name`, `page`, `sort_order`) VALUES
('nav', 'Navigation', 'global', 1),
('hero', 'Hero Section', 'landing', 10),
('stats', 'Statistics Bar', 'landing', 20),
('how_it_works', 'How It Works', 'landing', 30),
('features', 'Features', 'landing', 40),
('security', 'Security', 'landing', 50),
('pricing', 'Pricing', 'landing', 60),
('download', 'Download', 'landing', 70),
('faq', 'FAQ', 'landing', 80),
('footer', 'Footer', 'global', 100),
('howto', 'How-To Guide', 'how-to', 10),
('legal', 'Legal Pages', 'legal', 10)
ON DUPLICATE KEY UPDATE `section_name` = VALUES(`section_name`);

-- Content strings (translatable text)
CREATE TABLE IF NOT EXISTS `wp_ioi_strings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `section_id` INT NOT NULL,
    `string_key` VARCHAR(200) NOT NULL,
    `string_type` VARCHAR(50) DEFAULT 'text',
    `context_note` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `section_string` (`section_id`, `string_key`),
    FOREIGN KEY (`section_id`) REFERENCES `wp_ioi_sections`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Translations
CREATE TABLE IF NOT EXISTS `wp_ioi_translations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `string_id` INT NOT NULL,
    `language_id` INT NOT NULL,
    `content` TEXT NOT NULL,
    `is_approved` TINYINT(1) DEFAULT 0,
    `is_machine_translated` TINYINT(1) DEFAULT 0,
    `version` INT DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `string_lang` (`string_id`, `language_id`),
    FOREIGN KEY (`string_id`) REFERENCES `wp_ioi_strings`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`language_id`) REFERENCES `wp_ioi_languages`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Translation jobs (for N8N batch processing)
CREATE TABLE IF NOT EXISTS `wp_ioi_translation_jobs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `job_uuid` VARCHAR(36) NOT NULL UNIQUE,
    `target_language_id` INT NOT NULL,
    `status` VARCHAR(50) DEFAULT 'pending',
    `total_strings` INT DEFAULT 0,
    `translated_strings` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `completed_at` TIMESTAMP NULL,
    FOREIGN KEY (`target_language_id`) REFERENCES `wp_ioi_languages`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Indexes for performance
CREATE INDEX `idx_translations_lookup` ON `wp_ioi_translations` (`string_id`, `language_id`);
CREATE INDEX `idx_strings_section` ON `wp_ioi_strings` (`section_id`);
CREATE INDEX `idx_jobs_status` ON `wp_ioi_translation_jobs` (`status`);
