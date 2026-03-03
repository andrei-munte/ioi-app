-- ============================================================
-- UPDATE HEADLINE TO WINNING VERSION
-- Run this in phpMyAdmin to update the headline
-- Score: 89/100 "Warning: This Bot Makes Trading Too Easy"
-- ============================================================

-- Update badge
UPDATE wp_ioi_translations 
SET content = 'Warning' 
WHERE string_id = (SELECT id FROM wp_ioi_strings WHERE string_key = 'badge')
AND language_id = 1;

-- Update title part 1
UPDATE wp_ioi_translations 
SET content = 'This Bot Makes' 
WHERE string_id = (SELECT id FROM wp_ioi_strings WHERE string_key = 'title_1')
AND language_id = 1;

-- Update title highlight (gold part)
UPDATE wp_ioi_translations 
SET content = 'Trading Too Easy' 
WHERE string_id = (SELECT id FROM wp_ioi_strings WHERE string_key = 'title_highlight')
AND language_id = 1;

-- Verify changes
SELECT s.string_key, t.content 
FROM wp_ioi_strings s
JOIN wp_ioi_translations t ON t.string_id = s.id
WHERE s.string_key IN ('badge', 'title_1', 'title_highlight')
AND t.language_id = 1;
