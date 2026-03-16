<?php
/**
 * IOI Theme Functions
 * 
 * @package IOI
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

define('IOI_VERSION', '1.1.0');
define('IOI_THEME_DIR', get_template_directory());
define('IOI_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function ioi_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    
    register_nav_menus([
        'primary' => __('Primary Navigation', 'ioi'),
        'footer'  => __('Footer Navigation', 'ioi'),
    ]);
}
add_action('after_setup_theme', 'ioi_theme_setup');

/**
 * Enqueue Styles and Scripts
 */
function ioi_enqueue_assets() {
    // Main CSS
    wp_enqueue_style(
        'ioi-main',
        IOI_THEME_URI . '/assets/css/main.css',
        [],
        IOI_VERSION
    );

    // Pricing Carousel CSS
    wp_enqueue_style(
        'ioi-pricing-carousel',
        IOI_THEME_URI . '/assets/css/pricing-carousel.css',
        ['ioi-main'],
        IOI_VERSION
    );
    
    // Main JavaScript
    wp_enqueue_script(
        'ioi-main',
        IOI_THEME_URI . '/assets/js/main.js',
        [],
        IOI_VERSION,
        true
    );

    // Pricing Carousel JS
    wp_enqueue_script(
        'ioi-pricing-carousel',
        IOI_THEME_URI . '/assets/js/pricing-carousel.js',
        [],
        IOI_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'ioi_enqueue_assets');

/**
 * ============================================================
 * TRANSLATION SYSTEM
 * ============================================================
 */

/**
 * Get current language code
 */
function ioi_get_lang() {
    // Check URL param
    if (isset($_GET['lang']) && preg_match('/^[a-z]{2}$/', $_GET['lang'])) {
        return sanitize_text_field($_GET['lang']);
    }
    
    // Check URL path (e.g., /de/page)
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    $parts = explode('/', $uri);
    if (!empty($parts[0]) && preg_match('/^[a-z]{2}$/', $parts[0])) {
        $available = ioi_get_languages();
        if (isset($available[$parts[0]])) {
            return $parts[0];
        }
    }
    
    // Check cookie
    if (isset($_COOKIE['ioi_lang'])) {
        return sanitize_text_field($_COOKIE['ioi_lang']);
    }
    
    return 'en';
}

/**
 * Get available languages
 */
function ioi_get_languages() {
    global $wpdb;
    
    $cache_key = 'ioi_languages';
    $languages = wp_cache_get($cache_key);
    
    if ($languages === false) {
        $results = $wpdb->get_results(
            "SELECT code, name, native_name FROM {$wpdb->prefix}ioi_languages WHERE is_active = 1 ORDER BY sort_order"
        );
        
        $languages = [];
        foreach ($results as $row) {
            $languages[$row->code] = [
                'name' => $row->name,
                'native' => $row->native_name,
            ];
        }
        
        wp_cache_set($cache_key, $languages, '', HOUR_IN_SECONDS);
    }
    
    return $languages;
}

/**
 * Get all translations for current language
 */
function ioi_get_content() {
    global $wpdb;
    static $content = null;
    
    if ($content !== null) {
        return $content;
    }
    
    $lang = ioi_get_lang();
    $cache_key = 'ioi_content_' . $lang;
    $content = wp_cache_get($cache_key);
    
    if ($content === false) {
        // Get language ID
        $lang_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}ioi_languages WHERE code = %s",
            $lang
        ));
        
        // Fallback to English if language not found
        if (!$lang_id) {
            $lang_id = 1;
        }
        
        // Get all translations
        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT s.section_key, str.string_key, 
                    COALESCE(t.content, t_en.content) as content
             FROM {$wpdb->prefix}ioi_strings str
             JOIN {$wpdb->prefix}ioi_sections s ON s.id = str.section_id
             LEFT JOIN {$wpdb->prefix}ioi_translations t 
                    ON t.string_id = str.id AND t.language_id = %d
             LEFT JOIN {$wpdb->prefix}ioi_translations t_en 
                    ON t_en.string_id = str.id AND t_en.language_id = 1
             WHERE s.is_active = 1",
            $lang_id
        ));
        
        $content = [];
        foreach ($results as $row) {
            if (!isset($content[$row->section_key])) {
                $content[$row->section_key] = [];
            }
            $content[$row->section_key][$row->string_key] = $row->content;
        }
        
        wp_cache_set($cache_key, $content, '', 5 * MINUTE_IN_SECONDS);
    }
    
    return $content;
}

/**
 * Get translated string
 */
function ioi_t($section, $key, $default = '') {
    $content = ioi_get_content();
    
    if (isset($content[$section][$key])) {
        return $content[$section][$key];
    }
    
    return $default ?: "[{$section}.{$key}]";
}

/**
 * Echo translated string (escaped)
 */
function ioi_e($section, $key, $default = '') {
    echo esc_html(ioi_t($section, $key, $default));
}

/**
 * Echo translated HTML (sanitized)
 */
function ioi_html($section, $key, $default = '') {
    echo wp_kses_post(ioi_t($section, $key, $default));
}

/**
 * Language switcher HTML
 */
function ioi_language_switcher() {
    $languages = ioi_get_languages();
    $current = ioi_get_lang();
    
    $html = '<select class="lang-switcher" onchange="window.location.href=this.value">';
    foreach ($languages as $code => $data) {
        $url = add_query_arg('lang', $code, home_url($_SERVER['REQUEST_URI']));
        $selected = $code === $current ? ' selected' : '';
        $html .= sprintf(
            '<option value="%s"%s>%s</option>',
            esc_url($url),
            $selected,
            esc_html(strtoupper($code))
        );
    }
    $html .= '</select>';
    
    return $html;
}

/**
 * Set language cookie
 */
function ioi_set_lang_cookie() {
    $lang = ioi_get_lang();
    if (!isset($_COOKIE['ioi_lang']) || $_COOKIE['ioi_lang'] !== $lang) {
        setcookie('ioi_lang', $lang, time() + YEAR_IN_SECONDS, '/');
    }
}
add_action('init', 'ioi_set_lang_cookie');

/**
 * Add hreflang tags for SEO - DISABLED UNTIL TRANSLATIONS READY
 * Uncomment add_action when multi-language is enabled
 */
function ioi_hreflang_tags() {
    $languages = ioi_get_languages();
    $base_url = home_url($_SERVER['REQUEST_URI']);
    
    // Remove existing lang param
    $base_url = remove_query_arg('lang', $base_url);
    
    foreach ($languages as $code => $data) {
        $url = add_query_arg('lang', $code, $base_url);
        printf('<link rel="alternate" hreflang="%s" href="%s" />' . "\n", esc_attr($code), esc_url($url));
    }
    printf('<link rel="alternate" hreflang="x-default" href="%s" />' . "\n", esc_url($base_url));
}
// add_action('wp_head', 'ioi_hreflang_tags', 1); // UNCOMMENT WHEN TRANSLATIONS ARE READY

/**
 * Add body class for language
 */
function ioi_body_class($classes) {
    $classes[] = 'lang-' . ioi_get_lang();
    return $classes;
}
add_filter('body_class', 'ioi_body_class');

/**
 * ============================================================
 * DYNAMIC DATA (from CryptoTrader API)
 * ============================================================
 */

/**
 * Get spots remaining from CryptoTrader API
 * Falls back to WordPress option if API is unavailable
 */
function ioi_get_spots() {
    // Try cache first (avoid hitting API on every page load)
    $cache_key = 'ioi_spots_remaining_api';
    $cached = get_transient($cache_key);
    
    if ($cached !== false) {
        return intval($cached);
    }
    
    // Fetch from CryptoTrader API
    $api_url = 'http://135.181.137.243:8001/api/v1/stats/public';
    
    $response = wp_remote_get($api_url, [
        'timeout' => 5,
        'sslverify' => false,
    ]);
    
    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (isset($data['capacity']['free_slots'])) {
            $spots = intval($data['capacity']['free_slots']);
            
            // Cache for 5 minutes
            set_transient($cache_key, $spots, 5 * MINUTE_IN_SECONDS);
            
            return $spots;
        }
    }
    
    // Fallback to WordPress option if API fails
    return intval(get_option('ioi_spots_remaining', 23));
}

/**
 * Get all public stats from CryptoTrader API
 * Useful for displaying win rate, total trades, etc.
 */
function ioi_get_public_stats() {
    $cache_key = 'ioi_public_stats';
    $cached = get_transient($cache_key);
    
    if ($cached !== false) {
        return $cached;
    }
    
    $api_url = 'http://135.181.137.243:8001/api/v1/stats/public';
    
    $response = wp_remote_get($api_url, [
        'timeout' => 5,
        'sslverify' => false,
    ]);
    
    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if ($data && isset($data['capacity'])) {
            // Cache for 5 minutes
            set_transient($cache_key, $data, 5 * MINUTE_IN_SECONDS);
            return $data;
        }
    }
    
    // Return defaults if API fails
    return [
        'capacity' => [
            'total_slots' => 70,
            'free_slots' => get_option('ioi_spots_remaining', 23),
        ],
        'trading' => [
            'rt_win_rate_pct' => 85,
            'total_trades' => 0,
        ],
    ];
}

/**
 * Get default pricing tiers
 */
function ioi_get_default_tiers() {
    return [
        'STARTER' => [
            'name' => 'Starter',
            'price' => 5,
            'budget' => 100,
            'max_bots' => 1,
            'features' => ['$100 trading budget', '1 real bot + 2 test bots', 'Zero platform fees', 'All strategies included'],
            'is_popular' => false,
        ],
        'BASIC' => [
            'name' => 'Basic',
            'price' => 100,
            'budget' => 2500,
            'max_bots' => 3,
            'features' => ['$2,500 trading budget', '3 real bots + 5 test bots', 'Zero platform fees', 'All strategies included'],
            'is_popular' => true,
        ],
        'PRO' => [
            'name' => 'Pro',
            'price' => 250,
            'budget' => 5000,
            'max_bots' => 5,
            'features' => ['$5,000 trading budget', '5 real bots + 10 test bots', 'Zero platform fees', 'All strategies included'],
            'is_popular' => false,
        ],
        'ADVANCED' => [
            'name' => 'Advanced',
            'price' => 500,
            'budget' => 10000,
            'max_bots' => 10,
            'features' => ['$10,000 trading budget', '10 real bots + 15 test bots', 'Zero platform fees', 'Priority support'],
            'is_popular' => false,
        ],
        'ENTERPRISE' => [
            'name' => 'Enterprise',
            'price' => 1000,
            'budget' => 25000,
            'max_bots' => 99,
            'features' => ['$25,000 trading budget', 'Unlimited bots', 'Zero platform fees', 'Dedicated support'],
            'is_popular' => false,
        ],
    ];
}

/**
 * ============================================================
 * SEO HELPER FUNCTIONS
 * ============================================================
 */

/**
 * Get page-specific title for SEO
 */
function ioi_get_page_title() {
    if (is_front_page()) {
        return 'IOI | Automated Crypto Trading Bot for Binance | Android App';
    }
    
    if (is_page('setup-guide')) {
        return 'Setup Guide - Connect Binance to IOI | Crypto Trading Bot';
    }
    
    if (is_page('bot-settings-guide')) {
        return 'Bot Settings Guide | IOI Crypto Trading Bot';
    }
    
    if (is_page('faq')) {
        return 'FAQ - Frequently Asked Questions | IOI Trading Bot';
    }
    
    if (is_page('contact')) {
        return 'Contact Us | IOI Trading Bot';
    }
    
    if (is_page('terms')) {
        return 'Terms of Service | IOI Trading Bot';
    }
    
    if (is_page('privacy')) {
        return 'Privacy Policy | IOI Trading Bot';
    }
    
    if (is_page('risk-disclosure')) {
        return 'Risk Disclosure | IOI Trading Bot';
    }
    
    if (is_page('aml-policy')) {
        return 'AML Policy | IOI Trading Bot';
    }
    
    // Fallback: use WordPress title
    return get_the_title() . ' | IOI Trading Bot';
}

/**
 * Get page-specific meta description
 */
function ioi_get_meta_description() {
    if (is_front_page()) {
        return 'Trade crypto 24/7 with IOI automated bot for Binance. Momentum strategy, client-side encryption, no withdrawal permissions. Free Android app.';
    }
    
    if (is_page('setup-guide')) {
        return 'Set up IOI crypto trading bot in 5 minutes. Connect to Binance, configure your bot, start automated trading. Step-by-step guide.';
    }
    
    if (is_page('bot-settings-guide')) {
        return 'Configure your IOI trading bot. Learn about budget settings, risk levels, token selection, and stop-loss configuration.';
    }
    
    if (is_page('faq')) {
        return 'Frequently asked questions about IOI crypto trading bot. Security, pricing, API setup, and more.';
    }
    
    if (is_page('contact')) {
        return 'Contact the IOI team. Get support for your automated crypto trading bot.';
    }
    
    if (is_page('terms')) {
        return 'Terms of Service for IOI automated cryptocurrency trading platform.';
    }
    
    if (is_page('privacy')) {
        return 'Privacy Policy for IOI. Learn how we protect your data with client-side encryption.';
    }
    
    if (is_page('risk-disclosure')) {
        return 'Risk disclosure for cryptocurrency trading with IOI. Understand the risks before you trade.';
    }
    
    // Fallback
    return 'IOI - Automated crypto trading bot for Binance. Secure, simple, mobile-first.';
}

/**
 * Get canonical URL for current page
 */
function ioi_get_canonical_url() {
    if (is_front_page()) {
        return home_url('/');
    }
    
    $url = get_permalink();
    if ($url) {
        return $url;
    }
    
    return home_url($_SERVER['REQUEST_URI']);
}

/**
 * ============================================================
 * ADMIN: Clear translation cache
 * ============================================================
 */
function ioi_clear_cache() {
    wp_cache_delete('ioi_languages');
    
    $languages = ['en', 'de', 'es', 'fr', 'ro', 'it', 'pt', 'nl'];
    foreach ($languages as $lang) {
        wp_cache_delete('ioi_content_' . $lang);
    }
    
    // Also clear API stats cache
    delete_transient('ioi_spots_remaining_api');
    delete_transient('ioi_public_stats');
}

/**
 * Admin bar button to clear cache
 */
function ioi_admin_bar($wp_admin_bar) {
    if (!current_user_can('manage_options')) return;
    
    $wp_admin_bar->add_node([
        'id'    => 'ioi-clear-cache',
        'title' => '🔄 Clear IOI Cache',
        'href'  => wp_nonce_url(admin_url('admin-post.php?action=ioi_clear_cache'), 'ioi_clear'),
    ]);
}
add_action('admin_bar_menu', 'ioi_admin_bar', 100);

function ioi_handle_clear_cache() {
    if (!current_user_can('manage_options')) wp_die('Unauthorized');
    check_admin_referer('ioi_clear');
    
    ioi_clear_cache();
    
    wp_redirect(wp_get_referer() ?: home_url());
    exit;
}
add_action('admin_post_ioi_clear_cache', 'ioi_handle_clear_cache');

/**
 * ============================================================
 * SETTINGS PAGE
 * ============================================================
 */
function ioi_add_settings_page() {
    add_options_page(
        'IOI Settings',
        'IOI Settings',
        'manage_options',
        'ioi-settings',
        'ioi_settings_page'
    );
}
add_action('admin_menu', 'ioi_add_settings_page');

function ioi_settings_page() {
    if (isset($_POST['ioi_save']) && check_admin_referer('ioi_settings')) {
        update_option('ioi_spots_remaining', intval($_POST['spots']));
        update_option('ioi_apk_url', esc_url_raw($_POST['apk_url']));
        update_option('ioi_galaxy_url', esc_url_raw($_POST['galaxy_url']));
        update_option('ioi_huawei_url', esc_url_raw($_POST['huawei_url']));
        update_option('ioi_show_galaxy', isset($_POST['show_galaxy']) ? 1 : 0);
        update_option('ioi_show_huawei', isset($_POST['show_huawei']) ? 1 : 0);
        
        // Clear API cache when settings saved
        delete_transient('ioi_spots_remaining_api');
        delete_transient('ioi_public_stats');
        
        echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
    }
    
    $show_galaxy = get_option('ioi_show_galaxy', 0);
    $show_huawei = get_option('ioi_show_huawei', 0);
    
    // Get live spots from API for display
    $live_spots = ioi_get_spots();
    ?>
    <div class="wrap">
        <h1>IOI Settings</h1>
        <form method="post">
            <?php wp_nonce_field('ioi_settings'); ?>
            <table class="form-table">
                <tr>
                    <th>Spots Remaining (Fallback)</th>
                    <td>
                        <input type="number" name="spots" value="<?php echo esc_attr(get_option('ioi_spots_remaining', 23)); ?>" min="0" max="999">
                        <p class="description">
                            Used only if API is unavailable. 
                            <strong>Live from API: <?php echo esc_html($live_spots); ?> spots</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th colspan="2"><hr><h2 style="margin: 0;">Download Links</h2></th>
                </tr>
                <tr>
                    <th>APK Download URL</th>
                    <td>
                        <input type="url" name="apk_url" value="<?php echo esc_attr(get_option('ioi_apk_url', '')); ?>" class="regular-text" placeholder="https://...">
                        <p class="description">Direct APK download link (always visible)</p>
                    </td>
                </tr>
                <tr>
                    <th>Galaxy Store URL</th>
                    <td>
                        <input type="url" name="galaxy_url" value="<?php echo esc_attr(get_option('ioi_galaxy_url', '')); ?>" class="regular-text" placeholder="https://...">
                        <br><br>
                        <label style="display: flex; align-items: center; gap: 8px;">
                            <input type="checkbox" name="show_galaxy" value="1" <?php checked($show_galaxy, 1); ?>>
                            <strong>Show Galaxy Store button</strong>
                            <span style="color: #666;">(Enable when store approves the app)</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th>Huawei AppGallery URL</th>
                    <td>
                        <input type="url" name="huawei_url" value="<?php echo esc_attr(get_option('ioi_huawei_url', '')); ?>" class="regular-text" placeholder="https://...">
                        <br><br>
                        <label style="display: flex; align-items: center; gap: 8px;">
                            <input type="checkbox" name="show_huawei" value="1" <?php checked($show_huawei, 1); ?>>
                            <strong>Show Huawei AppGallery button</strong>
                            <span style="color: #666;">(Enable when store approves the app)</span>
                        </label>
                    </td>
                </tr>
            </table>
            <p><input type="submit" name="ioi_save" class="button button-primary" value="Save Settings"></p>
        </form>
        
        <div style="margin-top: 30px; padding: 20px; background: #f0f0f1; border-radius: 8px; border-left: 4px solid #D4AF37;">
            <h3 style="margin-top: 0; color: #1d2327;">📱 Store Approval Status</h3>
            <p><strong>APK Direct:</strong> ✅ Always visible</p>
            <p><strong>Galaxy Store:</strong> <?php echo $show_galaxy ? '✅ Approved & Visible' : '⏳ Pending - Button Hidden'; ?></p>
            <p><strong>Huawei AppGallery:</strong> <?php echo $show_huawei ? '✅ Approved & Visible' : '⏳ Pending - Button Hidden'; ?></p>
            <p style="color: #666; margin-bottom: 0;">Toggle the checkboxes above when each store approves your app.</p>
        </div>
        
        <div style="margin-top: 20px; padding: 20px; background: #f0f0f1; border-radius: 8px; border-left: 4px solid #2271b1;">
            <h3 style="margin-top: 0; color: #1d2327;">📊 Live API Stats</h3>
            <?php
            $stats = ioi_get_public_stats();
            if (isset($stats['capacity'])) {
                echo '<p><strong>Total Slots:</strong> ' . esc_html($stats['capacity']['total_slots'] ?? 'N/A') . '</p>';
                echo '<p><strong>Free Slots:</strong> ' . esc_html($stats['capacity']['free_slots'] ?? 'N/A') . '</p>';
            }
            if (isset($stats['trading'])) {
                echo '<p><strong>Win Rate:</strong> ' . esc_html($stats['trading']['rt_win_rate_pct'] ?? 'N/A') . '%</p>';
                echo '<p><strong>Total Trades:</strong> ' . esc_html(number_format($stats['trading']['total_trades'] ?? 0)) . '</p>';
            }
            ?>
            <p style="color: #666; margin-bottom: 0;">Data refreshes every 5 minutes. <a href="<?php echo wp_nonce_url(admin_url('admin-post.php?action=ioi_clear_cache'), 'ioi_clear'); ?>">Clear cache now</a></p>
        </div>
    </div>
    <?php
}