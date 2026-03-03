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
-- ============================================================
-- IOI WEBSITE - ENGLISH CONTENT
-- Import this AFTER 01_create_tables.sql
-- ============================================================

-- Helper: Insert string and translation together
-- We'll do this manually since MySQL doesn't have the same function capabilities

-- ============================================================
-- NAVIGATION
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'nav'), 'link_how_it_works', 'Nav menu'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'nav'), 'link_features', 'Nav menu'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'nav'), 'link_security', 'Nav menu'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'nav'), 'link_pricing', 'Nav menu'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'nav'), 'link_download', 'Nav menu'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'nav'), 'link_guide', 'Nav menu');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_how_it_works'), 1, 'How It Works', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_features'), 1, 'Features', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_security'), 1, 'Security', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_pricing'), 1, 'Pricing', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_download'), 1, 'Download', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_guide'), 1, 'Setup Guide', 1);

-- ============================================================
-- HERO SECTION
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'badge', 'Badge above headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'title_1', 'First part of title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'title_highlight', 'Gold highlighted part'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'subtitle', 'Main value proposition'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'cta_primary', 'Primary button'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'cta_secondary', 'Secondary button'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'hero'), 'spots_label', 'Below spots number');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'badge'), 1, 'Warning', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'title_1'), 1, 'This Bot Makes', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'title_highlight'), 1, 'Trading Too Easy', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subtitle'), 1, 'Automated 24/7 trading that splits your budget across multiple positions, capturing micro-profits while minimizing risk. Set it. Forget it. Earn.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'cta_primary'), 1, 'Download App', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'cta_secondary'), 1, 'See How It Works', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'spots_label'), 1, 'spots remaining in current batch', 1);

-- ============================================================
-- STATS BAR
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_1_value', 'Win rate'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_1_label', 'Win rate label'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_2_value', '24/7'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_2_label', '24/7 label'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_3_value', 'Trading pairs'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_3_label', 'Pairs label'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_4_value', 'Fund access'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'stats'), 'stat_4_label', 'Trust indicator');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_1_value'), 1, '85%', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_1_label'), 1, 'Average Win Rate', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_2_value'), 1, '24/7', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_2_label'), 1, 'Automated Trading', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_3_value'), 1, '700+', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_3_label'), 1, 'Trading Pairs', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_4_value'), 1, '0%', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'stat_4_label'), 1, 'Platform Access to Funds', 1);

-- ============================================================
-- HOW IT WORKS
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'section_title', 'Section headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'section_subtitle', 'Section subhead'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'step_1_title', 'Step 1'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'step_1_desc', 'Step 1 desc'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'step_2_title', 'Step 2'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'step_2_desc', 'Step 2 desc'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'step_3_title', 'Step 3'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works'), 'step_3_desc', 'Step 3 desc');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_title' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works')), 1, 'Trading Made Simple', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_subtitle' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'how_it_works')), 1, 'No charts. No stress. No constant monitoring. Just results.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'step_1_title'), 1, 'Connect Your Binance', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'step_1_desc'), 1, 'Create API keys with trade-only permissions. Your funds stay in YOUR Binance account - we never touch them.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'step_2_title'), 1, 'Set Your Budget', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'step_2_desc'), 1, 'Choose how much to trade with. The bot splits it across multiple positions to spread risk.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'step_3_title'), 1, 'Watch It Work', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'step_3_desc'), 1, 'Our AI finds optimal entry points, executes trades, and captures profits around the clock.', 1);

-- ============================================================
-- FEATURES
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'section_title', 'Section headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'section_subtitle', 'Section subhead'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_1_icon', 'Emoji'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_1_title', 'Feature title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_1_desc', 'Feature desc'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_2_icon', 'Emoji'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_2_title', 'Feature title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_2_desc', 'Feature desc'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_3_icon', 'Emoji'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_3_title', 'Feature title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_3_desc', 'Feature desc'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_4_icon', 'Emoji'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_4_title', 'Feature title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'features'), 'feature_4_desc', 'Feature desc');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_title' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'features')), 1, 'Built for Real Results', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_subtitle' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'features')), 1, 'Every feature designed around one goal: consistent, sustainable profits.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_1_icon'), 1, '📊', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_1_title'), 1, 'Momentum-Based Algorithm', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_1_desc'), 1, 'Buys dips in uptrends only. Avoids falling knives. 2+ years of price data powering every decision.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_2_icon'), 1, '🎯', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_2_title'), 1, 'Risk Distribution', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_2_desc'), 1, 'Your budget splits across multiple small positions. One bad trade never ruins your day.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_3_icon'), 1, '⚡', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_3_title'), 1, 'Real-Time Execution', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_3_desc'), 1, 'Processing 12,000+ price updates per second. When opportunity strikes, we''re already there.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_4_icon'), 1, '📱', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_4_title'), 1, 'Full Mobile Control', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'feature_4_desc'), 1, 'Start, stop, monitor - all from your phone. Detailed analytics on every trade.', 1);

-- ============================================================
-- SECURITY
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'section_title', 'Section headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'visual_title', 'Security box title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'visual_desc', 'Security box desc'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'point_1', 'Security point'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'point_2', 'Security point'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'point_3', 'Security point'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'point_4', 'Security point'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'point_5', 'Security point'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'security'), 'point_6', 'Security point');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_title' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'security')), 1, 'Your Keys. Your Coins. Your Control.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'visual_title'), 1, 'Zero-Knowledge Architecture', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'visual_desc'), 1, 'Your API keys are encrypted on YOUR device with YOUR PIN. We literally cannot access them.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'point_1'), 1, 'Funds never leave your Binance account', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'point_2'), 1, 'Trade-only API permissions (no withdrawals)', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'point_3'), 1, 'PIN-encrypted credentials on device', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'point_4'), 1, 'Whitelist-only commission transfers', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'point_5'), 1, 'Biometric authentication support', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'point_6'), 1, 'Full audit trail of every action', 1);

-- ============================================================
-- PRICING
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'section_title', 'Section headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'section_subtitle', 'Section subhead'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_title', 'Plan name'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_price', 'Price'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_suffix', 'After price'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_tagline', 'Tagline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_f1', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_f2', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_f3', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_f4', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'commission_cta', 'Button'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_badge', 'Badge'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_title', 'Plan name'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_price', 'Price'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_suffix', 'After price'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_tagline', 'Tagline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_f1', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_f2', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_f3', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_f4', 'Feature'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing'), 'subscription_cta', 'Button');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_title' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing')), 1, 'Simple, Transparent Pricing', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_subtitle' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'pricing')), 1, 'Choose what works for you. Upgrade or downgrade anytime.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_title'), 1, 'Commission', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_price'), 1, '0.065%', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_suffix'), 1, '/ trade', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_tagline'), 1, 'Pay only when you profit', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_f1'), 1, 'Full bot functionality', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_f2'), 1, 'All trading pairs', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_f3'), 1, 'Real-time analytics', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_f4'), 1, 'No monthly commitment', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'commission_cta'), 1, 'Get Started', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_badge'), 1, 'MOST POPULAR', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_title'), 1, 'Subscription', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_price'), 1, '$29', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_suffix'), 1, '/ month', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_tagline'), 1, 'Zero trading fees', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_f1'), 1, 'Everything in Commission', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_f2'), 1, '0% per-trade fees', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_f3'), 1, 'Up to $10,000 budget', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_f4'), 1, 'Priority support', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'subscription_cta'), 1, 'Subscribe Now', 1);

-- ============================================================
-- DOWNLOAD
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'section_title', 'Section headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'section_subtitle', 'Section subhead'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'btn_apk_label', 'Button small'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'btn_apk_title', 'Button large'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'btn_galaxy_label', 'Button small'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'btn_galaxy_title', 'Button large'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'btn_huawei_label', 'Button small'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'btn_huawei_title', 'Button large'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'playstore_title', 'Explanation title'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'playstore_text', 'Explanation'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'download'), 'playstore_link', 'Learn more');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_title' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'download')), 1, 'Ready to Start?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_subtitle' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'download')), 1, 'Download ioi and set up your first bot in under 5 minutes.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'btn_apk_label'), 1, 'Download APK', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'btn_apk_title'), 1, 'Direct Download', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'btn_galaxy_label'), 1, 'Available on', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'btn_galaxy_title'), 1, 'Galaxy Store', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'btn_huawei_label'), 1, 'Available on', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'btn_huawei_title'), 1, 'Huawei AppGallery', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'playstore_title'), 1, 'Why not Google Play?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'playstore_text'), 1, 'Google''s policies restrict crypto trading apps. We chose direct distribution to give you full functionality without compromise.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'playstore_link'), 1, 'Learn more →', 1);

-- ============================================================
-- FAQ
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'section_title', 'Section headline'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'q1', 'Question'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'a1', 'Answer'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'q2', 'Question'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'a2', 'Answer'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'q3', 'Question'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'a3', 'Answer'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'q4', 'Question'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'a4', 'Answer'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'q5', 'Question'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'a5', 'Answer'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'q6', 'Question'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'faq'), 'a6', 'Answer');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'section_title' AND section_id = (SELECT id FROM wp_ioi_sections WHERE section_key = 'faq')), 1, 'Questions & Answers', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'q1'), 1, 'Is my money safe?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'a1'), 1, 'Your funds never leave your Binance account. We use trade-only API keys - the bot CAN''T withdraw. Ever.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'q2'), 1, 'What returns can I expect?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'a2'), 1, 'Results vary with market conditions. Our algorithm maintains 82-85% win rate, but past performance doesn''t guarantee future results.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'q3'), 1, 'How do commissions work?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'a3'), 1, 'On the commission plan, 0.065% is taken from profitable trades only. You set up a whitelisted transfer to our address.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'q4'), 1, 'Can I stop the bot anytime?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'a4'), 1, 'Yes. One tap. The bot will gracefully close positions at profit targets rather than panic-selling.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'q5'), 1, 'What if Binance goes down?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'a5'), 1, 'The bot pauses automatically when Binance API is unavailable and resumes when connectivity returns. Your positions remain safe.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'q6'), 1, 'Do I need trading experience?', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'a6'), 1, 'No. The bot handles everything. You just set your budget and risk preferences. Our guide walks you through setup in minutes.', 1);

-- ============================================================
-- FOOTER
-- ============================================================
INSERT INTO `wp_ioi_strings` (`section_id`, `string_key`, `context_note`) VALUES
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'brand_tagline', 'Below logo'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'col_product', 'Column heading'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'col_resources', 'Column heading'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'col_legal', 'Column heading'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'link_terms', 'Footer link'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'link_privacy', 'Footer link'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'link_risk', 'Footer link'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'link_aml', 'Footer link'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'copyright', 'Copyright text'),
((SELECT id FROM wp_ioi_sections WHERE section_key = 'footer'), 'disclaimer', 'Risk disclaimer');

INSERT INTO `wp_ioi_translations` (`string_id`, `language_id`, `content`, `is_approved`) VALUES
((SELECT id FROM wp_ioi_strings WHERE string_key = 'brand_tagline'), 1, 'Let your crypto work for you. Automated trading powered by AI.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'col_product'), 1, 'Product', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'col_resources'), 1, 'Resources', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'col_legal'), 1, 'Legal', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_terms'), 1, 'Terms of Service', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_privacy'), 1, 'Privacy Policy', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_risk'), 1, 'Risk Disclosure', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'link_aml'), 1, 'AML Policy', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'copyright'), 1, '© 2025 ioi. All rights reserved.', 1),
((SELECT id FROM wp_ioi_strings WHERE string_key = 'disclaimer'), 1, 'Trading involves risk. Only trade with funds you can afford to lose.', 1);
