<?php
/**
 * Plugin Name: IOI Content Manager
 * Description: Full admin control for IOI landing page content, sections, and settings
 * Version: 1.0.0
 * Author: IOI Team
 */

defined('ABSPATH') || exit;

class IOI_Content_Manager {
    
    private static $instance = null;
    
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menus']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('wp_ajax_ioi_save_content', [$this, 'ajax_save_content']);
        add_action('wp_ajax_ioi_save_settings', [$this, 'ajax_save_settings']);
        add_action('wp_ajax_ioi_add_pricing_tier', [$this, 'ajax_add_pricing_tier']);
        add_action('wp_ajax_ioi_delete_pricing_tier', [$this, 'ajax_delete_pricing_tier']);
    }
    
    public function add_admin_menus() {
        add_menu_page(
            'IOI Content',
            'IOI Manager',
            'manage_options',
            'ioi-manager',
            [$this, 'render_dashboard'],
            'dashicons-analytics',
            30
        );
        
        add_submenu_page('ioi-manager', 'Dashboard', 'Dashboard', 'manage_options', 'ioi-manager');
        add_submenu_page('ioi-manager', 'Hero Section', 'Hero', 'manage_options', 'ioi-hero', [$this, 'render_hero_editor']);
        add_submenu_page('ioi-manager', 'Features', 'Features', 'manage_options', 'ioi-features', [$this, 'render_features_editor']);
        add_submenu_page('ioi-manager', 'Security', 'Security', 'manage_options', 'ioi-security', [$this, 'render_security_editor']);
        add_submenu_page('ioi-manager', 'Pricing', 'Pricing', 'manage_options', 'ioi-pricing', [$this, 'render_pricing_editor']);
        add_submenu_page('ioi-manager', 'FAQ', 'FAQ', 'manage_options', 'ioi-faq', [$this, 'render_faq_editor']);
        add_submenu_page('ioi-manager', 'Downloads', 'Downloads', 'manage_options', 'ioi-downloads', [$this, 'render_downloads_editor']);
        add_submenu_page('ioi-manager', 'Navigation', 'Nav & Footer', 'manage_options', 'ioi-nav', [$this, 'render_nav_editor']);
        add_submenu_page('ioi-manager', 'Branding', 'Branding', 'manage_options', 'ioi-branding', [$this, 'render_branding_editor']);
        add_submenu_page('ioi-manager', 'Translations', 'Translations', 'manage_options', 'ioi-translations', [$this, 'render_translations']);
    }
    
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'ioi-') === false) return;
        
        wp_enqueue_media(); // For logo upload
        wp_enqueue_style('ioi-admin', plugin_dir_url(__FILE__) . 'assets/admin.css', [], '1.0.0');
        wp_enqueue_script('ioi-admin', plugin_dir_url(__FILE__) . 'assets/admin.js', ['jquery'], '1.0.0', true);
        wp_localize_script('ioi-admin', 'ioiAdmin', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ioi_admin'),
        ]);
    }
    
    // =========================================================
    // DASHBOARD
    // =========================================================
    public function render_dashboard() {
        ?>
        <div class="wrap ioi-admin">
            <h1>🚀 IOI Content Manager</h1>
            <p>Manage all landing page content from one place.</p>
            
            <div class="ioi-dashboard-grid">
                <a href="<?php echo admin_url('admin.php?page=ioi-hero'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-megaphone"></span>
                    <h3>Hero Section</h3>
                    <p>Headline, subtitle, CTAs, spots remaining</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-features'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-star-filled"></span>
                    <h3>Features</h3>
                    <p>Feature cards with icons and descriptions</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-pricing'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-money-alt"></span>
                    <h3>Pricing</h3>
                    <p>Commission & subscription tiers</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-faq'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-editor-help"></span>
                    <h3>FAQ</h3>
                    <p>Questions and answers</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-downloads'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-download"></span>
                    <h3>Downloads</h3>
                    <p>APK, store links, Play Store explanation</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-branding'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-admin-appearance"></span>
                    <h3>Branding</h3>
                    <p>Logo, colors, site identity</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-nav'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-menu"></span>
                    <h3>Navigation</h3>
                    <p>Header menu & footer links</p>
                </a>
                
                <a href="<?php echo admin_url('admin.php?page=ioi-translations'); ?>" class="ioi-card">
                    <span class="dashicons dashicons-translation"></span>
                    <h3>Translations</h3>
                    <p>Multi-language content</p>
                </a>
            </div>
            
            <div class="ioi-stats-bar">
                <div class="stat">
                    <strong><?php echo esc_html(get_option('ioi_spots_remaining', 23)); ?></strong>
                    <span>Spots Remaining</span>
                </div>
                <div class="stat">
                    <strong><?php echo count(ioi_get_languages()); ?></strong>
                    <span>Languages</span>
                </div>
                <div class="stat">
                    <strong><?php echo $this->count_pricing_tiers(); ?></strong>
                    <span>Pricing Tiers</span>
                </div>
            </div>
        </div>
        <?php
    }
    
    // =========================================================
    // HERO EDITOR
    // =========================================================
    public function render_hero_editor() {
        $this->save_section_if_posted('hero');
        ?>
        <div class="wrap ioi-admin">
            <h1>Hero Section</h1>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_hero'); ?>
                <input type="hidden" name="ioi_section" value="hero">
                
                <table class="form-table">
                    <tr>
                        <th>Badge Text</th>
                        <td>
                            <input type="text" name="badge" value="<?php echo esc_attr($this->get_string('hero', 'badge')); ?>" class="regular-text">
                            <p class="description">Small text above headline (e.g., "Warning")</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Headline Part 1</th>
                        <td>
                            <input type="text" name="title_1" value="<?php echo esc_attr($this->get_string('hero', 'title_1')); ?>" class="regular-text">
                            <p class="description">First part of headline (white text)</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Headline Part 2 (Gold)</th>
                        <td>
                            <input type="text" name="title_highlight" value="<?php echo esc_attr($this->get_string('hero', 'title_highlight')); ?>" class="regular-text">
                            <p class="description">Second part of headline (gold/highlighted)</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Subtitle</th>
                        <td>
                            <textarea name="subtitle" rows="3" class="large-text"><?php echo esc_textarea($this->get_string('hero', 'subtitle')); ?></textarea>
                            <p class="description">Value proposition text below headline</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Primary Button</th>
                        <td><input type="text" name="cta_primary" value="<?php echo esc_attr($this->get_string('hero', 'cta_primary')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Secondary Button</th>
                        <td><input type="text" name="cta_secondary" value="<?php echo esc_attr($this->get_string('hero', 'cta_secondary')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Spots Remaining</th>
                        <td>
                            <input type="number" name="ioi_spots_remaining" value="<?php echo esc_attr(get_option('ioi_spots_remaining', 23)); ?>" min="0" max="999" class="small-text">
                            <p class="description">Dynamic scarcity indicator</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Spots Label</th>
                        <td><input type="text" name="spots_label" value="<?php echo esc_attr($this->get_string('hero', 'spots_label')); ?>" class="regular-text"></td>
                    </tr>
                </table>
                
                <h2>Stats Bar</h2>
                <table class="form-table">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <tr>
                        <th>Stat <?php echo $i; ?></th>
                        <td>
                            <input type="text" name="stat_<?php echo $i; ?>_value" value="<?php echo esc_attr($this->get_string('stats', "stat_{$i}_value")); ?>" placeholder="Value (e.g., 85%)" class="small-text">
                            <input type="text" name="stat_<?php echo $i; ?>_label" value="<?php echo esc_attr($this->get_string('stats', "stat_{$i}_label")); ?>" placeholder="Label" class="regular-text">
                        </td>
                    </tr>
                    <?php endfor; ?>
                </table>
                
                <?php submit_button('Save Hero Section'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // PRICING EDITOR
    // =========================================================
    public function render_pricing_editor() {
        ?>
        <div class="wrap ioi-admin">
            <h1>Pricing</h1>
            
            <h2>Commission Model (Default)</h2>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_commission'); ?>
                <table class="form-table">
                    <tr>
                        <th>Commission Rate</th>
                        <td>
                            <input type="text" name="commission_rate" value="<?php echo esc_attr(get_option('ioi_commission_rate', '0.065')); ?>" class="small-text">
                            <span>% per trade</span>
                            <p class="description">Applied to every trade (buy & sell). NOT profit-based.</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Commission Description</th>
                        <td>
                            <textarea name="commission_description" rows="2" class="large-text"><?php echo esc_textarea(get_option('ioi_commission_description', 'No subscription required. Pay 0.065% on every trade.')); ?></textarea>
                        </td>
                    </tr>
                </table>
                <?php submit_button('Save Commission Settings', 'secondary'); ?>
            </form>
            
            <hr>
            
            <h2>Subscription Tiers</h2>
            <p>Zero trading fees when subscribed. Each tier has a monthly budget limit.</p>
            
            <table class="wp-list-table widefat fixed striped" id="pricing-tiers">
                <thead>
                    <tr>
                        <th>Tier Name</th>
                        <th>Price/Month</th>
                        <th>Budget Limit</th>
                        <th>Max Bots</th>
                        <th>Features</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $this->render_pricing_tiers_rows(); ?>
                </tbody>
            </table>
            
            <h3>Add New Tier</h3>
            <form method="post" id="add-tier-form">
                <?php wp_nonce_field('ioi_add_tier'); ?>
                <table class="form-table">
                    <tr>
                        <th>Tier Code</th>
                        <td><input type="text" name="tier_code" placeholder="STARTER" class="small-text" required></td>
                    </tr>
                    <tr>
                        <th>Display Name</th>
                        <td><input type="text" name="tier_name" placeholder="Starter" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th>Price (USD/month)</th>
                        <td><input type="number" name="price" placeholder="5" min="0" step="1" class="small-text" required></td>
                    </tr>
                    <tr>
                        <th>Budget Limit (USD)</th>
                        <td><input type="number" name="budget" placeholder="100" min="0" step="1" class="small-text" required></td>
                    </tr>
                    <tr>
                        <th>Max Real Bots</th>
                        <td><input type="number" name="max_bots" placeholder="1" min="1" step="1" class="small-text" required></td>
                    </tr>
                    <tr>
                        <th>Features (one per line)</th>
                        <td><textarea name="features" rows="4" class="large-text" placeholder="$100 trading budget&#10;1 real bot&#10;Zero platform fees"></textarea></td>
                    </tr>
                    <tr>
                        <th>Popular?</th>
                        <td><label><input type="checkbox" name="is_popular" value="1"> Mark as "Most Popular"</label></td>
                    </tr>
                </table>
                <?php submit_button('Add Tier', 'primary'); ?>
            </form>
        </div>
        <?php
    }
    
    private function render_pricing_tiers_rows() {
        $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
        $html = '';
        
        foreach ($tiers as $code => $tier) {
            $popular = !empty($tier['is_popular']) ? ' <span class="popular-badge">★ Popular</span>' : '';
            $features = is_array($tier['features']) ? implode('<br>', $tier['features']) : $tier['features'];
            
            $html .= sprintf(
                '<tr data-tier="%s">
                    <td><strong>%s</strong>%s<br><code>%s</code></td>
                    <td>$%s/mo</td>
                    <td>$%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>
                        <button class="button edit-tier">Edit</button>
                        <button class="button delete-tier" data-tier="%s">Delete</button>
                    </td>
                </tr>',
                esc_attr($code),
                esc_html($tier['name']),
                $popular,
                esc_html($code),
                esc_html($tier['price']),
                esc_html($tier['budget']),
                esc_html($tier['max_bots']),
                $features,
                esc_attr($code)
            );
        }
        
        return $html;
    }
    
    private function get_default_tiers() {
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
    
    private function count_pricing_tiers() {
        $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
        return count($tiers);
    }
    
    // =========================================================
    // FEATURES EDITOR
    // =========================================================
    public function render_features_editor() {
        $this->save_section_if_posted('features');
        ?>
        <div class="wrap ioi-admin">
            <h1>Features Section</h1>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_features'); ?>
                <input type="hidden" name="ioi_section" value="features">
                
                <table class="form-table">
                    <tr>
                        <th>Section Title</th>
                        <td><input type="text" name="section_title" value="<?php echo esc_attr($this->get_string('features', 'section_title')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Section Subtitle</th>
                        <td><input type="text" name="section_subtitle" value="<?php echo esc_attr($this->get_string('features', 'section_subtitle')); ?>" class="large-text"></td>
                    </tr>
                </table>
                
                <h2>Feature Cards</h2>
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                <div class="ioi-feature-card">
                    <h3>Feature <?php echo $i; ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>Icon (emoji)</th>
                            <td><input type="text" name="feature_<?php echo $i; ?>_icon" value="<?php echo esc_attr($this->get_string('features', "feature_{$i}_icon")); ?>" class="small-text"></td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td><input type="text" name="feature_<?php echo $i; ?>_title" value="<?php echo esc_attr($this->get_string('features', "feature_{$i}_title")); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><textarea name="feature_<?php echo $i; ?>_desc" rows="2" class="large-text"><?php echo esc_textarea($this->get_string('features', "feature_{$i}_desc")); ?></textarea></td>
                        </tr>
                    </table>
                </div>
                <?php endfor; ?>
                
                <?php submit_button('Save Features'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // SECURITY EDITOR
    // =========================================================
    public function render_security_editor() {
        $this->save_section_if_posted('security');
        ?>
        <div class="wrap ioi-admin">
            <h1>Security Section</h1>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_security'); ?>
                <input type="hidden" name="ioi_section" value="security">
                
                <table class="form-table">
                    <tr>
                        <th>Section Title</th>
                        <td><input type="text" name="section_title" value="<?php echo esc_attr($this->get_string('security', 'section_title')); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th>Visual Box Title</th>
                        <td><input type="text" name="visual_title" value="<?php echo esc_attr($this->get_string('security', 'visual_title')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Visual Box Description</th>
                        <td><textarea name="visual_desc" rows="2" class="large-text"><?php echo esc_textarea($this->get_string('security', 'visual_desc')); ?></textarea></td>
                    </tr>
                </table>
                
                <h2>Security Points (checkmarks)</h2>
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                <p>
                    <label>Point <?php echo $i; ?>:</label><br>
                    <input type="text" name="point_<?php echo $i; ?>" value="<?php echo esc_attr($this->get_string('security', "point_{$i}")); ?>" class="large-text">
                </p>
                <?php endfor; ?>
                
                <?php submit_button('Save Security Section'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // FAQ EDITOR
    // =========================================================
    public function render_faq_editor() {
        $this->save_section_if_posted('faq');
        ?>
        <div class="wrap ioi-admin">
            <h1>FAQ Section</h1>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_faq'); ?>
                <input type="hidden" name="ioi_section" value="faq">
                
                <table class="form-table">
                    <tr>
                        <th>Section Title</th>
                        <td><input type="text" name="section_title" value="<?php echo esc_attr($this->get_string('faq', 'section_title')); ?>" class="regular-text"></td>
                    </tr>
                </table>
                
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                <div class="ioi-faq-item">
                    <h3>FAQ <?php echo $i; ?></h3>
                    <p>
                        <label>Question:</label><br>
                        <input type="text" name="q<?php echo $i; ?>" value="<?php echo esc_attr($this->get_string('faq', "q{$i}")); ?>" class="large-text">
                    </p>
                    <p>
                        <label>Answer:</label><br>
                        <textarea name="a<?php echo $i; ?>" rows="2" class="large-text"><?php echo esc_textarea($this->get_string('faq', "a{$i}")); ?></textarea>
                    </p>
                </div>
                <?php endfor; ?>
                
                <?php submit_button('Save FAQ'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // DOWNLOADS EDITOR
    // =========================================================
    public function render_downloads_editor() {
        if (isset($_POST['ioi_save_downloads']) && check_admin_referer('ioi_save_downloads')) {
            update_option('ioi_apk_url', esc_url_raw($_POST['apk_url']));
            update_option('ioi_galaxy_url', esc_url_raw($_POST['galaxy_url']));
            update_option('ioi_huawei_url', esc_url_raw($_POST['huawei_url']));
            echo '<div class="notice notice-success"><p>Download links saved!</p></div>';
        }
        ?>
        <div class="wrap ioi-admin">
            <h1>Download Section</h1>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_downloads'); ?>
                
                <h2>Download URLs</h2>
                <table class="form-table">
                    <tr>
                        <th>APK Direct Download</th>
                        <td><input type="url" name="apk_url" value="<?php echo esc_attr(get_option('ioi_apk_url', '')); ?>" class="large-text" placeholder="https://..."></td>
                    </tr>
                    <tr>
                        <th>Galaxy Store</th>
                        <td><input type="url" name="galaxy_url" value="<?php echo esc_attr(get_option('ioi_galaxy_url', '')); ?>" class="large-text" placeholder="https://..."></td>
                    </tr>
                    <tr>
                        <th>Huawei AppGallery</th>
                        <td><input type="url" name="huawei_url" value="<?php echo esc_attr(get_option('ioi_huawei_url', '')); ?>" class="large-text" placeholder="https://..."></td>
                    </tr>
                </table>
                
                <input type="hidden" name="ioi_save_downloads" value="1">
                <?php submit_button('Save Download Links'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // BRANDING EDITOR
    // =========================================================
    public function render_branding_editor() {
        if (isset($_POST['ioi_save_branding']) && check_admin_referer('ioi_save_branding')) {
            update_option('ioi_logo_id', intval($_POST['logo_id']));
            update_option('ioi_favicon_id', intval($_POST['favicon_id']));
            update_option('ioi_og_image_id', intval($_POST['og_image_id']));
            echo '<div class="notice notice-success"><p>Branding saved!</p></div>';
        }
        
        $logo_id = get_option('ioi_logo_id', 0);
        $favicon_id = get_option('ioi_favicon_id', 0);
        $og_image_id = get_option('ioi_og_image_id', 0);
        ?>
        <div class="wrap ioi-admin">
            <h1>Branding</h1>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_branding'); ?>
                
                <table class="form-table">
                    <tr>
                        <th>Logo</th>
                        <td>
                            <div class="ioi-image-upload" data-target="logo_id">
                                <?php if ($logo_id) : ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($logo_id, 'thumbnail')); ?>" style="max-width: 100px;">
                                <?php endif; ?>
                                <input type="hidden" name="logo_id" id="logo_id" value="<?php echo esc_attr($logo_id); ?>">
                                <button type="button" class="button upload-image">Select Image</button>
                                <button type="button" class="button remove-image">Remove</button>
                            </div>
                            <p class="description">Square logo, recommended 512x512px</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Favicon</th>
                        <td>
                            <div class="ioi-image-upload" data-target="favicon_id">
                                <?php if ($favicon_id) : ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($favicon_id, 'thumbnail')); ?>" style="max-width: 32px;">
                                <?php endif; ?>
                                <input type="hidden" name="favicon_id" id="favicon_id" value="<?php echo esc_attr($favicon_id); ?>">
                                <button type="button" class="button upload-image">Select Image</button>
                                <button type="button" class="button remove-image">Remove</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>OG Image (Social sharing)</th>
                        <td>
                            <div class="ioi-image-upload" data-target="og_image_id">
                                <?php if ($og_image_id) : ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($og_image_id, 'medium')); ?>" style="max-width: 300px;">
                                <?php endif; ?>
                                <input type="hidden" name="og_image_id" id="og_image_id" value="<?php echo esc_attr($og_image_id); ?>">
                                <button type="button" class="button upload-image">Select Image</button>
                                <button type="button" class="button remove-image">Remove</button>
                            </div>
                            <p class="description">1200x630px recommended for social media</p>
                        </td>
                    </tr>
                </table>
                
                <input type="hidden" name="ioi_save_branding" value="1">
                <?php submit_button('Save Branding'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // NAV & FOOTER EDITOR
    // =========================================================
    public function render_nav_editor() {
        $this->save_section_if_posted('nav');
        $this->save_section_if_posted('footer');
        ?>
        <div class="wrap ioi-admin">
            <h1>Navigation & Footer</h1>
            
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_nav'); ?>
                <input type="hidden" name="ioi_section" value="nav">
                
                <h2>Header Navigation</h2>
                <table class="form-table">
                    <tr><th>How It Works Link</th><td><input type="text" name="link_how_it_works" value="<?php echo esc_attr($this->get_string('nav', 'link_how_it_works')); ?>" class="regular-text"></td></tr>
                    <tr><th>Features Link</th><td><input type="text" name="link_features" value="<?php echo esc_attr($this->get_string('nav', 'link_features')); ?>" class="regular-text"></td></tr>
                    <tr><th>Security Link</th><td><input type="text" name="link_security" value="<?php echo esc_attr($this->get_string('nav', 'link_security')); ?>" class="regular-text"></td></tr>
                    <tr><th>Pricing Link</th><td><input type="text" name="link_pricing" value="<?php echo esc_attr($this->get_string('nav', 'link_pricing')); ?>" class="regular-text"></td></tr>
                    <tr><th>Download Link</th><td><input type="text" name="link_download" value="<?php echo esc_attr($this->get_string('nav', 'link_download')); ?>" class="regular-text"></td></tr>
                    <tr><th>Setup Guide Link</th><td><input type="text" name="link_guide" value="<?php echo esc_attr($this->get_string('nav', 'link_guide')); ?>" class="regular-text"></td></tr>
                </table>
                
                <?php submit_button('Save Navigation'); ?>
            </form>
            
            <hr>
            
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_footer'); ?>
                <input type="hidden" name="ioi_section" value="footer">
                
                <h2>Footer</h2>
                <table class="form-table">
                    <tr><th>Brand Tagline</th><td><input type="text" name="brand_tagline" value="<?php echo esc_attr($this->get_string('footer', 'brand_tagline')); ?>" class="large-text"></td></tr>
                    <tr><th>Copyright</th><td><input type="text" name="copyright" value="<?php echo esc_attr($this->get_string('footer', 'copyright')); ?>" class="regular-text"></td></tr>
                    <tr><th>Risk Disclaimer</th><td><textarea name="disclaimer" rows="2" class="large-text"><?php echo esc_textarea($this->get_string('footer', 'disclaimer')); ?></textarea></td></tr>
                </table>
                
                <?php submit_button('Save Footer'); ?>
            </form>
        </div>
        <?php
    }
    
    // =========================================================
    // TRANSLATIONS
    // =========================================================
    public function render_translations() {
        global $wpdb;
        
        $languages = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ioi_languages WHERE is_active = 1 ORDER BY sort_order");
        $current_lang = isset($_GET['lang']) ? sanitize_text_field($_GET['lang']) : 'en';
        ?>
        <div class="wrap ioi-admin">
            <h1>Translations</h1>
            
            <form method="get">
                <input type="hidden" name="page" value="ioi-translations">
                <label>Language: 
                    <select name="lang" onchange="this.form.submit()">
                        <?php foreach ($languages as $lang) : ?>
                        <option value="<?php echo esc_attr($lang->code); ?>" <?php selected($current_lang, $lang->code); ?>>
                            <?php echo esc_html($lang->name); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </form>
            
            <p>Edit translations for <strong><?php echo esc_html(strtoupper($current_lang)); ?></strong>. Changes save automatically.</p>
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Section</th>
                        <th>Key</th>
                        <th>English (source)</th>
                        <th>Translation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $this->render_translation_rows($current_lang); ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    private function render_translation_rows($lang) {
        global $wpdb;
        
        $lang_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}ioi_languages WHERE code = %s",
            $lang
        ));
        
        $results = $wpdb->get_results($wpdb->prepare("
            SELECT s.section_key, str.id, str.string_key, 
                   t_en.content as english,
                   t.content as translation
            FROM {$wpdb->prefix}ioi_strings str
            JOIN {$wpdb->prefix}ioi_sections s ON s.id = str.section_id
            LEFT JOIN {$wpdb->prefix}ioi_translations t_en ON t_en.string_id = str.id AND t_en.language_id = 1
            LEFT JOIN {$wpdb->prefix}ioi_translations t ON t.string_id = str.id AND t.language_id = %d
            ORDER BY s.sort_order, str.id
        ", $lang_id));
        
        $html = '';
        foreach ($results as $row) {
            $html .= sprintf(
                '<tr>
                    <td><code>%s</code></td>
                    <td><code>%s</code></td>
                    <td>%s</td>
                    <td><input type="text" class="translation-input large-text" data-id="%d" data-lang="%s" value="%s"></td>
                </tr>',
                esc_html($row->section_key),
                esc_html($row->string_key),
                esc_html($row->english),
                $row->id,
                esc_attr($lang),
                esc_attr($row->translation ?? '')
            );
        }
        
        return $html;
    }
    
    // =========================================================
    // HELPERS
    // =========================================================
    private function get_string($section, $key) {
        global $wpdb;
        
        $result = $wpdb->get_var($wpdb->prepare("
            SELECT t.content
            FROM {$wpdb->prefix}ioi_translations t
            JOIN {$wpdb->prefix}ioi_strings str ON str.id = t.string_id
            JOIN {$wpdb->prefix}ioi_sections s ON s.id = str.section_id
            WHERE s.section_key = %s AND str.string_key = %s AND t.language_id = 1
        ", $section, $key));
        
        return $result ?? '';
    }
    
    private function save_section_if_posted($section) {
        if (!isset($_POST['ioi_section']) || $_POST['ioi_section'] !== $section) return;
        if (!check_admin_referer("ioi_save_{$section}")) return;
        
        global $wpdb;
        
        // Handle options
        if (isset($_POST['ioi_spots_remaining'])) {
            update_option('ioi_spots_remaining', intval($_POST['ioi_spots_remaining']));
        }
        
        // Handle stats (they're in 'stats' section)
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST["stat_{$i}_value"])) {
                $this->update_string('stats', "stat_{$i}_value", sanitize_text_field($_POST["stat_{$i}_value"]));
            }
            if (isset($_POST["stat_{$i}_label"])) {
                $this->update_string('stats', "stat_{$i}_label", sanitize_text_field($_POST["stat_{$i}_label"]));
            }
        }
        
        // Handle other strings
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['ioi_section', '_wpnonce', '_wp_http_referer', 'submit', 'ioi_spots_remaining'])) continue;
            if (strpos($key, 'stat_') === 0) continue; // Already handled
            
            $this->update_string($section, $key, sanitize_textarea_field($value));
        }
        
        echo '<div class="notice notice-success"><p>Section saved!</p></div>';
    }
    
    private function update_string($section, $key, $value) {
        global $wpdb;
        
        // Get string ID
        $string_id = $wpdb->get_var($wpdb->prepare("
            SELECT str.id FROM {$wpdb->prefix}ioi_strings str
            JOIN {$wpdb->prefix}ioi_sections s ON s.id = str.section_id
            WHERE s.section_key = %s AND str.string_key = %s
        ", $section, $key));
        
        if (!$string_id) return;
        
        // Update English translation
        $wpdb->query($wpdb->prepare("
            INSERT INTO {$wpdb->prefix}ioi_translations (string_id, language_id, content, is_approved)
            VALUES (%d, 1, %s, 1)
            ON DUPLICATE KEY UPDATE content = %s, updated_at = NOW()
        ", $string_id, $value, $value));
    }
    
    // AJAX handlers
    public function ajax_save_content() {
        check_ajax_referer('ioi_admin', 'nonce');
        // Handle inline saves
        wp_send_json_success();
    }
    
    public function ajax_add_pricing_tier() {
        check_ajax_referer('ioi_add_tier');
        
        $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
        
        $code = strtoupper(sanitize_text_field($_POST['tier_code']));
        $tiers[$code] = [
            'name' => sanitize_text_field($_POST['tier_name']),
            'price' => intval($_POST['price']),
            'budget' => intval($_POST['budget']),
            'max_bots' => intval($_POST['max_bots']),
            'features' => array_filter(array_map('trim', explode("\n", sanitize_textarea_field($_POST['features'])))),
            'is_popular' => !empty($_POST['is_popular']),
        ];
        
        update_option('ioi_pricing_tiers', $tiers);
        wp_redirect(admin_url('admin.php?page=ioi-pricing&saved=1'));
        exit;
    }
    
    public function ajax_delete_pricing_tier() {
        check_ajax_referer('ioi_admin', 'nonce');
        
        $tier_code = sanitize_text_field($_POST['tier']);
        $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
        
        unset($tiers[$tier_code]);
        update_option('ioi_pricing_tiers', $tiers);
        
        wp_send_json_success();
    }
}

// Initialize
IOI_Content_Manager::instance();
