<?php
/**
 * Plugin Name: IOI Content Manager
 * Description: Full admin control for IOI landing page content, sections, and settings
 * Version: 1.2.0
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
        add_action('admin_init', [$this, 'handle_tier_actions']);
        add_action('wp_ajax_ioi_save_content', [$this, 'ajax_save_content']);
        add_action('wp_ajax_ioi_save_settings', [$this, 'ajax_save_settings']);
        add_action('wp_ajax_ioi_save_translation', [$this, 'ajax_save_translation']);
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
        if (strpos($hook, 'ioi-') === false && strpos($hook, 'ioi-manager') === false) return;
        
        wp_enqueue_media();
        wp_enqueue_style('ioi-admin', plugin_dir_url(__FILE__) . 'assets/admin.css', [], '1.2.0');
        wp_enqueue_script('ioi-admin', plugin_dir_url(__FILE__) . 'assets/admin.js', ['jquery'], '1.2.0', true);
        wp_localize_script('ioi-admin', 'ioiAdmin', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ioi_admin'),
        ]);
    }
    
    public function handle_tier_actions() {
        if (isset($_GET['page']) && $_GET['page'] === 'ioi-pricing' && isset($_GET['action']) && $_GET['action'] === 'delete_tier') {
            $tier_code = sanitize_text_field($_GET['tier']);
            if (wp_verify_nonce($_GET['_wpnonce'], 'delete_tier_' . $tier_code)) {
                $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
                unset($tiers[$tier_code]);
                update_option('ioi_pricing_tiers', $tiers);
                wp_redirect(admin_url('admin.php?page=ioi-pricing&deleted=1'));
                exit;
            }
        }
        
        if (isset($_POST['save_tier']) && isset($_POST['ioi_tier_nonce'])) {
            if (wp_verify_nonce($_POST['ioi_tier_nonce'], 'ioi_save_tier')) {
                $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
                
                $code = strtoupper(sanitize_text_field($_POST['tier_code']));
                $features_raw = sanitize_textarea_field($_POST['tier_features']);
                $features = array_filter(array_map('trim', explode("\n", $features_raw)));
                
                $tiers[$code] = [
                    'name' => sanitize_text_field($_POST['tier_name']),
                    'price' => intval($_POST['tier_price']),
                    'budget' => intval($_POST['tier_budget']),
                    'max_bots' => intval($_POST['tier_max_bots']),
                    'features' => $features,
                    'is_popular' => !empty($_POST['tier_popular']),
                ];
                
                update_option('ioi_pricing_tiers', $tiers);
                
                $mode = sanitize_text_field($_POST['tier_mode']);
                $msg = ($mode === 'edit') ? 'updated' : 'added';
                wp_redirect(admin_url('admin.php?page=ioi-pricing&' . $msg . '=1'));
                exit;
            }
        }
        
        if (isset($_POST['save_pricing_header']) && isset($_POST['_wpnonce'])) {
            if (wp_verify_nonce($_POST['_wpnonce'], 'ioi_save_pricing_header')) {
                update_option('ioi_pricing_title', sanitize_text_field($_POST['pricing_title']));
                update_option('ioi_pricing_subtitle', sanitize_text_field($_POST['pricing_subtitle']));
                wp_redirect(admin_url('admin.php?page=ioi-pricing&header_saved=1'));
                exit;
            }
        }
        
        if (isset($_POST['save_commission']) && isset($_POST['_wpnonce'])) {
            if (wp_verify_nonce($_POST['_wpnonce'], 'ioi_save_commission')) {
                update_option('ioi_commission_title', sanitize_text_field($_POST['commission_title']));
                update_option('ioi_commission_rate', sanitize_text_field($_POST['commission_rate']));
                update_option('ioi_commission_tagline', sanitize_text_field($_POST['commission_tagline']));
                update_option('ioi_commission_features', sanitize_textarea_field($_POST['commission_features']));
                update_option('ioi_commission_note', sanitize_text_field($_POST['commission_note']));
                wp_redirect(admin_url('admin.php?page=ioi-pricing&commission_saved=1'));
                exit;
            }
        }
        
        if (isset($_POST['save_subscription']) && isset($_POST['_wpnonce'])) {
            if (wp_verify_nonce($_POST['_wpnonce'], 'ioi_save_subscription')) {
                update_option('ioi_subscription_title', sanitize_text_field($_POST['subscription_title']));
                update_option('ioi_subscription_price_range', sanitize_text_field($_POST['subscription_price_range']));
                update_option('ioi_subscription_tagline', sanitize_text_field($_POST['subscription_tagline']));
                update_option('ioi_subscription_features', sanitize_textarea_field($_POST['subscription_features']));
                update_option('ioi_subscription_note', sanitize_text_field($_POST['subscription_note']));
                wp_redirect(admin_url('admin.php?page=ioi-pricing&subscription_saved=1'));
                exit;
            }
        }
    }
    
    public function render_dashboard() {
        ?>
        <div class="wrap ioi-admin">
            <h1>IOI Content Manager</h1>
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
                    <strong><?php echo count($this->get_languages()); ?></strong>
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
    
    private function get_languages() {
        global $wpdb;
        $table = $wpdb->prefix . 'ioi_languages';
        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") === $table) {
            return $wpdb->get_results("SELECT * FROM $table WHERE is_active = 1");
        }
        return [['code' => 'en', 'name' => 'English']];
    }
    
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
    
    public function render_pricing_editor() {
        if (isset($_GET['added'])) echo '<div class="notice notice-success"><p>Tier added successfully!</p></div>';
        if (isset($_GET['updated'])) echo '<div class="notice notice-success"><p>Tier updated successfully!</p></div>';
        if (isset($_GET['deleted'])) echo '<div class="notice notice-success"><p>Tier deleted successfully!</p></div>';
        if (isset($_GET['header_saved'])) echo '<div class="notice notice-success"><p>Section header saved!</p></div>';
        if (isset($_GET['commission_saved'])) echo '<div class="notice notice-success"><p>Commission card saved!</p></div>';
        if (isset($_GET['subscription_saved'])) echo '<div class="notice notice-success"><p>Subscription card saved!</p></div>';
        
        $tiers = get_option('ioi_pricing_tiers', $this->get_default_tiers());
        ?>
        <div class="wrap ioi-admin">
            <h1>Pricing</h1>
            
            <h2>Section Header</h2>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_pricing_header'); ?>
                <table class="form-table">
                    <tr>
                        <th>Section Title</th>
                        <td><input type="text" name="pricing_title" value="<?php echo esc_attr(get_option('ioi_pricing_title', 'Simple, Transparent Pricing')); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th>Section Subtitle</th>
                        <td><input type="text" name="pricing_subtitle" value="<?php echo esc_attr(get_option('ioi_pricing_subtitle', 'Choose commission-based trading or subscribe for zero fees')); ?>" class="large-text"></td>
                    </tr>
                </table>
                <?php submit_button('Save Header', 'secondary', 'save_pricing_header'); ?>
            </form>
            
            <hr style="margin: 30px 0;">
            
            <h2>Commission Card</h2>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_commission'); ?>
                <table class="form-table">
                    <tr>
                        <th>Card Title</th>
                        <td><input type="text" name="commission_title" value="<?php echo esc_attr(get_option('ioi_commission_title', 'Commission')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Rate</th>
                        <td>
                            <input type="text" name="commission_rate" value="<?php echo esc_attr(get_option('ioi_commission_rate', '0.065')); ?>" class="small-text">
                            <span>% per trade</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Tagline</th>
                        <td><input type="text" name="commission_tagline" value="<?php echo esc_attr(get_option('ioi_commission_tagline', 'Pay per trade, no commitment')); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th>Features (one per line)</th>
                        <td><textarea name="commission_features" rows="4" class="large-text"><?php echo esc_textarea(get_option('ioi_commission_features', "\$0 monthly subscription\n0.065% on every buy and sell\nUnlimited trading budget\nAll features included")); ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Note (bottom text)</th>
                        <td><input type="text" name="commission_note" value="<?php echo esc_attr(get_option('ioi_commission_note', 'Best for testing or occasional trading')); ?>" class="large-text"></td>
                    </tr>
                </table>
                <?php submit_button('Save Commission Card', 'secondary', 'save_commission'); ?>
            </form>
            
            <hr style="margin: 30px 0;">
            
            <h2>Subscription Card</h2>
            <form method="post" class="ioi-form">
                <?php wp_nonce_field('ioi_save_subscription'); ?>
                <table class="form-table">
                    <tr>
                        <th>Card Title</th>
                        <td><input type="text" name="subscription_title" value="<?php echo esc_attr(get_option('ioi_subscription_title', 'Subscription')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Price Range Display</th>
                        <td><input type="text" name="subscription_price_range" value="<?php echo esc_attr(get_option('ioi_subscription_price_range', '$5-$1k')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Tagline</th>
                        <td><input type="text" name="subscription_tagline" value="<?php echo esc_attr(get_option('ioi_subscription_tagline', 'Zero trading fees, fixed monthly cost')); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th>Features (one per line)</th>
                        <td><textarea name="subscription_features" rows="4" class="large-text"><?php echo esc_textarea(get_option('ioi_subscription_features', "0% commission on all trades\n5 tiers to choose from\nBudget limits \$100 to \$25,000\nUpgrade or downgrade anytime")); ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Note (bottom text)</th>
                        <td><input type="text" name="subscription_note" value="<?php echo esc_attr(get_option('ioi_subscription_note', 'Best for active traders wanting predictable costs')); ?>" class="large-text"></td>
                    </tr>
                </table>
                <?php submit_button('Save Subscription Card', 'secondary', 'save_subscription'); ?>
            </form>
            
            <hr style="margin: 30px 0;">
            
            <h2>Subscription Tiers (Carousel)</h2>
            <p class="description">These tiers appear in the 3D carousel. Zero trading fees when subscribed.</p>
            
            <table class="wp-list-table widefat fixed striped ioi-tier-table" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th style="width: 18%;">Tier Name</th>
                        <th style="width: 10%;">Price/Month</th>
                        <th style="width: 12%;">Budget Limit</th>
                        <th style="width: 8%;">Max Bots</th>
                        <th style="width: 32%;">Features</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tiers as $code => $tier) : 
                        $features_text = is_array($tier['features']) ? implode("\n", $tier['features']) : $tier['features'];
                        $features_html = is_array($tier['features']) ? implode('<br>', array_map('esc_html', $tier['features'])) : nl2br(esc_html($tier['features']));
                    ?>
                    <tr data-tier-code="<?php echo esc_attr($code); ?>"
                        data-tier-name="<?php echo esc_attr($tier['name']); ?>"
                        data-tier-price="<?php echo esc_attr($tier['price']); ?>"
                        data-tier-budget="<?php echo esc_attr($tier['budget']); ?>"
                        data-tier-max-bots="<?php echo esc_attr($tier['max_bots']); ?>"
                        data-tier-features="<?php echo esc_attr($features_text); ?>"
                        data-tier-popular="<?php echo !empty($tier['is_popular']) ? '1' : '0'; ?>">
                        <td>
                            <?php echo esc_html($tier['name']); ?>
                            <?php if (!empty($tier['is_popular'])) : ?>
                                <span style="background: #D4AF37; color: #000; padding: 2px 6px; border-radius: 3px; font-size: 10px; margin-left: 5px;">★ Popular</span>
                            <?php endif; ?>
                            <br><code style="font-size: 11px; color: #888;"><?php echo esc_html($code); ?></code>
                        </td>
                        <td>$<?php echo esc_html($tier['price']); ?>/mo</td>
                        <td>$<?php echo number_format($tier['budget']); ?></td>
                        <td><?php echo esc_html($tier['max_bots']); ?></td>
                        <td style="font-size: 12px; line-height: 1.6;"><?php echo $features_html; ?></td>
                        <td>
                            <button type="button" class="button edit-tier-btn">Edit</button>
                            <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=ioi-pricing&action=delete_tier&tier=' . $code), 'delete_tier_' . $code); ?>" 
                               class="button delete-tier-btn"
                               onclick="return confirm('Are you sure you want to delete the <?php echo esc_js($tier['name']); ?> tier?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div id="tier-form" style="margin-top: 30px; padding: 20px; background: #1e1e1e; border: 1px solid #333; border-radius: 8px;">
                <h3 id="tier-form-title">Add New Tier</h3>
                
                <form method="post" action="">
                    <?php wp_nonce_field('ioi_save_tier', 'ioi_tier_nonce'); ?>
                    <input type="hidden" id="tier-form-mode" name="tier_mode" value="add">
                    
                    <table class="form-table">
                        <tr>
                            <th><label for="tier_code">Tier Code</label></th>
                            <td>
                                <input type="text" id="tier_code" name="tier_code" class="regular-text" 
                                       placeholder="e.g., STARTER" style="text-transform: uppercase;" required>
                                <p class="description">Unique identifier (uppercase, no spaces). Cannot be changed after creation.</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="tier_name">Display Name</label></th>
                            <td>
                                <input type="text" id="tier_name" name="tier_name" class="regular-text" 
                                       placeholder="e.g., Starter" required>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="tier_price">Price (USD/month)</label></th>
                            <td>
                                <input type="number" id="tier_price" name="tier_price" class="small-text" 
                                       min="0" step="1" placeholder="5" required>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="tier_budget">Budget Limit (USD)</label></th>
                            <td>
                                <input type="number" id="tier_budget" name="tier_budget" class="regular-text" 
                                       min="0" step="100" placeholder="100" required>
                                <p class="description">Maximum monthly trading budget for this tier.</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="tier_max_bots">Max Real Bots</label></th>
                            <td>
                                <input type="number" id="tier_max_bots" name="tier_max_bots" class="small-text" 
                                       min="1" step="1" placeholder="1" required>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="tier_features">Features</label></th>
                            <td>
                                <textarea id="tier_features" name="tier_features" rows="4" class="large-text" 
                                          placeholder="$100 trading budget&#10;1 real bot + 2 test bots&#10;Zero platform fees&#10;All strategies included"></textarea>
                                <p class="description">One feature per line. These appear on the pricing cards.</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="tier_popular">Mark as Popular</label></th>
                            <td>
                                <label>
                                    <input type="checkbox" id="tier_popular" name="tier_popular" value="1">
                                    Show "Popular" badge on this tier
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" id="tier-submit-btn" name="save_tier" class="button button-primary" value="Add Tier">
                        <button type="button" id="tier-cancel-btn" class="button" style="display: none;">Cancel Edit</button>
                    </p>
                </form>
            </div>
        </div>
        <?php
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
                'features' => ['$2,500 trading budget', '3 real bots + 5 bots', 'Zero platform fees', 'All strategies included'],
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
                <div class="ioi-feature-card" style="background: #1e1e1e; padding: 15px; margin: 15px 0; border-radius: 8px;">
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
                <div class="ioi-faq-item" style="background: #1e1e1e; padding: 15px; margin: 15px 0; border-radius: 8px;">
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
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($logo_id, 'thumbnail')); ?>" style="max-width: 100px; margin-bottom: 10px; display: block;">
                                <?php endif; ?>
                                <input type="hidden" name="logo_id" id="logo_id" value="<?php echo esc_attr($logo_id); ?>">
                                <button type="button" class="button ioi-upload-btn" data-target="#logo_id">Select Image</button>
                                <button type="button" class="button ioi-remove-btn">Remove</button>
                            </div>
                            <p class="description">Square logo, recommended 512x512px</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Favicon</th>
                        <td>
                            <div class="ioi-image-upload" data-target="favicon_id">
                                <?php if ($favicon_id) : ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($favicon_id, 'thumbnail')); ?>" style="max-width: 32px; margin-bottom: 10px; display: block;">
                                <?php endif; ?>
                                <input type="hidden" name="favicon_id" id="favicon_id" value="<?php echo esc_attr($favicon_id); ?>">
                                <button type="button" class="button ioi-upload-btn" data-target="#favicon_id">Select Image</button>
                                <button type="button" class="button ioi-remove-btn">Remove</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>OG Image (Social sharing)</th>
                        <td>
                            <div class="ioi-image-upload" data-target="og_image_id">
                                <?php if ($og_image_id) : ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($og_image_id, 'medium')); ?>" style="max-width: 300px; margin-bottom: 10px; display: block;">
                                <?php endif; ?>
                                <input type="hidden" name="og_image_id" id="og_image_id" value="<?php echo esc_attr($og_image_id); ?>">
                                <button type="button" class="button ioi-upload-btn" data-target="#og_image_id">Select Image</button>
                                <button type="button" class="button ioi-remove-btn">Remove</button>
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
            
            <hr style="margin: 30px 0;">
            
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
    
    public function render_translations() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ioi_languages';
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            echo '<div class="wrap"><h1>Translations</h1><p>Translation tables not found. Please ensure the database is set up correctly.</p></div>';
            return;
        }
        
        $languages = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ioi_languages WHERE is_active = 1 ORDER BY sort_order");
        $current_lang = isset($_GET['lang']) ? sanitize_text_field($_GET['lang']) : 'en';
        ?>
        <div class="wrap ioi-admin">
            <h1>Translations</h1>
            
            <form method="get" style="margin-bottom: 20px;">
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
                        <th style="width: 12%;">Section</th>
                        <th style="width: 15%;">Key</th>
                        <th style="width: 33%;">English (source)</th>
                        <th style="width: 40%;">Translation</th>
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
        
        $lang_row = $wpdb->get_row($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}ioi_languages WHERE code = %s",
            $lang
        ));
        
        if (!$lang_row) return '<tr><td colspan="4">Language not found.</td></tr>';
        
        $lang_id = $lang_row->id;
        
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
        
        if (empty($results)) {
            return '<tr><td colspan="4">No strings found.</td></tr>';
        }
        
        $html = '';
        foreach ($results as $row) {
            $html .= sprintf(
                '<tr>
                    <td><code>%s</code></td>
                    <td><code>%s</code></td>
                    <td>%s</td>
                    <td><input type="text" class="translation-input large-text" 
                               data-section="%s" data-key="%s" data-lang="%s" 
                               value="%s" style="width: 100%%;"></td>
                </tr>',
                esc_html($row->section_key),
                esc_html($row->string_key),
                esc_html($row->english ?? ''),
                esc_attr($row->section_key),
                esc_attr($row->string_key),
                esc_attr($lang),
                esc_attr($row->translation ?? '')
            );
        }
        
        return $html;
    }
    
    private function get_string($section, $key) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ioi_translations';
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            return '';
        }
        
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
        
        if (isset($_POST['ioi_spots_remaining'])) {
            update_option('ioi_spots_remaining', intval($_POST['ioi_spots_remaining']));
        }
        
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST["stat_{$i}_value"])) {
                $this->update_string('stats', "stat_{$i}_value", sanitize_text_field($_POST["stat_{$i}_value"]));
            }
            if (isset($_POST["stat_{$i}_label"])) {
                $this->update_string('stats', "stat_{$i}_label", sanitize_text_field($_POST["stat_{$i}_label"]));
            }
        }
        
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['ioi_section', '_wpnonce', '_wp_http_referer', 'submit', 'ioi_spots_remaining'])) continue;
            if (strpos($key, 'stat_') === 0) continue;
            
            $this->update_string($section, $key, sanitize_textarea_field($value));
        }
        
        echo '<div class="notice notice-success"><p>Section saved!</p></div>';
    }
    
    private function update_string($section, $key, $value) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'ioi_strings';
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            return;
        }
        
        $string_id = $wpdb->get_var($wpdb->prepare("
            SELECT str.id FROM {$wpdb->prefix}ioi_strings str
            JOIN {$wpdb->prefix}ioi_sections s ON s.id = str.section_id
            WHERE s.section_key = %s AND str.string_key = %s
        ", $section, $key));
        
        if (!$string_id) return;
        
        $wpdb->query($wpdb->prepare("
            INSERT INTO {$wpdb->prefix}ioi_translations (string_id, language_id, content, is_approved)
            VALUES (%d, 1, %s, 1)
            ON DUPLICATE KEY UPDATE content = %s, updated_at = NOW()
        ", $string_id, $value, $value));
    }
    
    public function ajax_save_content() {
        check_ajax_referer('ioi_admin', 'nonce');
        wp_send_json_success();
    }
    
    public function ajax_save_settings() {
        check_ajax_referer('ioi_admin', 'nonce');
        wp_send_json_success();
    }
    
    public function ajax_save_translation() {
        check_ajax_referer('ioi_admin', 'nonce');
        
        global $wpdb;
        
        $section = sanitize_text_field($_POST['section']);
        $key = sanitize_text_field($_POST['key']);
        $lang = sanitize_text_field($_POST['lang']);
        $value = sanitize_textarea_field($_POST['value']);
        
        $lang_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}ioi_languages WHERE code = %s",
            $lang
        ));
        
        if (!$lang_id) {
            wp_send_json_error('Language not found');
            return;
        }
        
        $string_id = $wpdb->get_var($wpdb->prepare("
            SELECT str.id FROM {$wpdb->prefix}ioi_strings str
            JOIN {$wpdb->prefix}ioi_sections s ON s.id = str.section_id
            WHERE s.section_key = %s AND str.string_key = %s
        ", $section, $key));
        
        if (!$string_id) {
            wp_send_json_error('String not found');
            return;
        }
        
        $wpdb->query($wpdb->prepare("
            INSERT INTO {$wpdb->prefix}ioi_translations (string_id, language_id, content, is_approved)
            VALUES (%d, %d, %s, 1)
            ON DUPLICATE KEY UPDATE content = %s, updated_at = NOW()
        ", $string_id, $lang_id, $value, $value));
        
        wp_send_json_success();
    }
}

IOI_Content_Manager::instance();