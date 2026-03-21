<?php
/**
 * Landing Page Template
 * @package IOI
 */

get_header();
$spots = ioi_get_spots();
$pricing_tiers = get_option('ioi_pricing_tiers', ioi_get_default_tiers());
$commission_rate = get_option('ioi_commission_rate', '0.065');
?>

<!-- Hero -->
<section class="hero" id="hero">
    <div class="hero-grid">
        <div class="hero-content">
            <span class="badge">⚠️ <?php echo esc_html(ioi_t('hero', 'badge', 'Early Access - Limited Spots')); ?></span>
            <h1><?php echo esc_html(ioi_t('hero', 'title_1', 'Let Your Crypto')); ?> <span class="text-gradient"><?php echo esc_html(ioi_t('hero', 'title_highlight', 'Work For You')); ?></span></h1>
            <p class="hero-subtitle"><?php echo esc_html(ioi_t('hero', 'subtitle', 'Automated momentum trading on Binance. Your keys stay encrypted on your device. No withdrawal permissions needed.')); ?></p>
            <div class="hero-cta">
                <a href="#download" class="btn btn-primary btn-lg"><?php echo esc_html(ioi_t('hero', 'cta_primary', 'Download App')); ?></a>
                <a href="#how-it-works" class="btn btn-secondary btn-lg"><?php echo esc_html(ioi_t('hero', 'cta_secondary', 'How It Works')); ?></a>
            </div>
            <div class="spots-indicator">
                <span class="number"><?php echo esc_html($spots); ?></span>
                <span class="label">Early Access Accounts Left</span>
            </div>
        </div>
        <div class="hero-phone">
            <div class="phone-mockup">
                <img src="<?php echo IOI_THEME_URI; ?>/assets/images/app-screenshot.jpg" 
                     alt="IOI Crypto Trading Bot App - Dashboard showing automated Binance trading with momentum strategy"
                     width="300" 
                     height="600"
                     loading="eager">
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-bar">
    <div class="stats-grid">
        <div class="stat-item">
            <div class="value"><?php echo esc_html(ioi_t('stats', 'stat_1_value', '82-85%')); ?></div>
            <div class="label"><?php echo esc_html(ioi_t('stats', 'stat_1_label', 'Win Rate')); ?></div>
        </div>
        <div class="stat-item">
            <div class="value"><?php echo esc_html(ioi_t('stats', 'stat_2_value', '24/7')); ?></div>
            <div class="label"><?php echo esc_html(ioi_t('stats', 'stat_2_label', 'Automated Trading')); ?></div>
        </div>
        <div class="stat-item">
            <div class="value"><?php echo esc_html(ioi_t('stats', 'stat_3_value', '5 min')); ?></div>
            <div class="label"><?php echo esc_html(ioi_t('stats', 'stat_3_label', 'Setup Time')); ?></div>
        </div>
        <div class="stat-item">
            <div class="value"><?php echo esc_html(ioi_t('stats', 'stat_4_value', '$0')); ?></div>
            <div class="label"><?php echo esc_html(ioi_t('stats', 'stat_4_label', 'To Start')); ?></div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section" id="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html(ioi_t('how_it_works', 'section_title', 'How It Works')); ?></h2>
            <p><?php echo esc_html(ioi_t('how_it_works', 'section_subtitle', 'Start automated trading in three simple steps')); ?></p>
        </div>
        <div class="grid grid-3 gap-xl">
            <div class="card text-center">
                <div class="step-number">1</div>
                <h3><?php echo esc_html(ioi_t('how_it_works', 'step_1_title', 'Connect Binance')); ?></h3>
                <p class="text-gray mt-md"><?php echo esc_html(ioi_t('how_it_works', 'step_1_desc', 'Create API keys on Binance with trading permissions only. No withdrawal access needed.')); ?></p>
            </div>
            <div class="card text-center">
                <div class="step-number">2</div>
                <h3><?php echo esc_html(ioi_t('how_it_works', 'step_2_title', 'Configure Bot')); ?></h3>
                <p class="text-gray mt-md"><?php echo esc_html(ioi_t('how_it_works', 'step_2_desc', 'Set your budget, risk level, and trading parameters. Start with dry-run mode to test.')); ?></p>
            </div>
            <div class="card text-center">
                <div class="step-number">3</div>
                <h3><?php echo esc_html(ioi_t('how_it_works', 'step_3_title', 'Start Trading')); ?></h3>
                <p class="text-gray mt-md"><?php echo esc_html(ioi_t('how_it_works', 'step_3_desc', 'Your bot trades 24/7 using momentum strategy. Monitor performance in the app.')); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="section bg-dark-2" id="features">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html(ioi_t('features', 'section_title', 'Why Choose IOI')); ?></h2>
            <p><?php echo esc_html(ioi_t('features', 'section_subtitle', 'Built for security, simplicity, and performance')); ?></p>
        </div>
        <div class="grid grid-2 gap-xl">
            <div class="card feature-card">
                <div class="icon-box"><?php echo esc_html(ioi_t('features', 'feature_1_icon', '🔐')); ?></div>
                <div class="feature-content">
                    <h3><?php echo esc_html(ioi_t('features', 'feature_1_title', 'Client-Side Encryption')); ?></h3>
                    <p><?php echo esc_html(ioi_t('features', 'feature_1_desc', 'Your Binance API keys are encrypted on your device with your PIN. We never store your unencrypted credentials.')); ?></p>
                </div>
            </div>
            <div class="card feature-card">
                <div class="icon-box"><?php echo esc_html(ioi_t('features', 'feature_2_icon', '📈')); ?></div>
                <div class="feature-content">
                    <h3><?php echo esc_html(ioi_t('features', 'feature_2_title', 'Momentum Strategy')); ?></h3>
                    <p><?php echo esc_html(ioi_t('features', 'feature_2_desc', 'Buy tokens showing upward momentum, sell when targets are hit. Automatic stop-loss protection included.')); ?></p>
                </div>
            </div>
            <div class="card feature-card">
                <div class="icon-box"><?php echo esc_html(ioi_t('features', 'feature_3_icon', '🧪')); ?></div>
                <div class="feature-content">
                    <h3><?php echo esc_html(ioi_t('features', 'feature_3_title', 'Dry-Run Mode')); ?></h3>
                    <p><?php echo esc_html(ioi_t('features', 'feature_3_desc', 'Test strategies with simulated trades before risking real money. See exactly how your bot would perform.')); ?></p>
                </div>
            </div>
            <div class="card feature-card">
                <div class="icon-box"><?php echo esc_html(ioi_t('features', 'feature_4_icon', '💰')); ?></div>
                <div class="feature-content">
                    <h3><?php echo esc_html(ioi_t('features', 'feature_4_title', 'Flexible Pricing')); ?></h3>
                    <p><?php echo esc_html(ioi_t('features', 'feature_4_desc', 'Start free with commission-based trading, or subscribe for zero platform fees. No hidden costs.')); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Security -->
<section class="section" id="security">
    <div class="container">
        <div class="security-grid">
            <div class="security-visual">
                <div class="shield-icon">🛡️</div>
                <h3><?php echo esc_html(ioi_t('security', 'visual_title', 'Your Keys, Your Control')); ?></h3>
                <p class="text-gray mt-md"><?php echo esc_html(ioi_t('security', 'visual_desc', 'We designed IOI with security as the foundation, not an afterthought.')); ?></p>
            </div>
            <div class="security-content">
                <h2><?php echo esc_html(ioi_t('security', 'section_title', 'Security First')); ?></h2>
                <ul class="security-list mt-xl">
                    <li><?php echo esc_html(ioi_t('security', 'point_1', 'API keys encrypted on your device with your PIN')); ?></li>
                    <li><?php echo esc_html(ioi_t('security', 'point_2', 'No withdrawal permissions required - we can only trade')); ?></li>
                    <li><?php echo esc_html(ioi_t('security', 'point_3', 'Your PIN never leaves your device')); ?></li>
                    <li><?php echo esc_html(ioi_t('security', 'point_4', 'IP whitelist support for extra protection')); ?></li>
                    <li><?php echo esc_html(ioi_t('security', 'point_5', 'Open API - verify exactly what we access')); ?></li>
                    <li><?php echo esc_html(ioi_t('security', 'point_6', 'Funds always stay in your Binance account')); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- PRICING SECTION -->
<section id="pricing" class="pricing">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html(get_option('ioi_pricing_title', 'Simple, Transparent Pricing')); ?></h2>
            <p><?php echo esc_html(get_option('ioi_pricing_subtitle', 'Choose commission-based trading or subscribe for zero fees')); ?></p>
        </div>
        
        <div class="pricing-models">
            <div class="pricing-model-card">
                <div class="model-header">
                    <h3><?php echo esc_html(get_option('ioi_commission_title', 'Commission')); ?></h3>
                    <div class="model-price">
                        <span class="amount"><?php echo esc_html(get_option('ioi_commission_rate', '0.065')); ?>%</span>
                        <span class="period">per trade</span>
                    </div>
                </div>
                <p class="model-tagline"><?php echo esc_html(get_option('ioi_commission_tagline', 'Pay per trade, no commitment')); ?></p>
                <ul class="model-features">
                    <?php 
                    $comm_features = explode("\n", get_option('ioi_commission_features', "\$0 monthly subscription\n0.065% on every buy and sell\nUnlimited trading budget\nAll features included"));
                    foreach ($comm_features as $feature) :
                        $feature = trim($feature);
                        if (empty($feature)) continue;
                    ?>
                    <li><?php echo esc_html($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="model-note"><?php echo esc_html(get_option('ioi_commission_note', 'No limits. No commitments. Pay only for results.')); ?></p>
            </div>
            
            <div class="pricing-model-card">
                <div class="model-header">
                    <h3><?php echo esc_html(get_option('ioi_subscription_title', 'Subscription')); ?></h3>
                    <div class="model-price">
                        <span class="amount"><?php echo esc_html(get_option('ioi_subscription_price_range', '$5-$1k')); ?></span>
                        <span class="period">per month</span>
                    </div>
                </div>
                <p class="model-tagline"><?php echo esc_html(get_option('ioi_subscription_tagline', 'Zero trading fees, fixed monthly cost')); ?></p>
                <ul class="model-features">
                    <?php 
                    $sub_features = explode("\n", get_option('ioi_subscription_features', "0% commission on all trades\n5 tiers to choose from\nBudget limits \$100 to \$25,000\nUpgrade or downgrade anytime"));
                    foreach ($sub_features as $feature) :
                        $feature = trim($feature);
                        if (empty($feature)) continue;
                    ?>
                    <li><?php echo esc_html($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="model-note"><?php echo esc_html(get_option('ioi_subscription_note', 'Best for active traders wanting predictable costs')); ?></p>
            </div>
        </div>
        
        <div class="subscription-tiers-section">
            <h3 class="tiers-title">Subscription Tiers</h3>
            <p class="tiers-subtitle">Drag to explore all options</p>
            
            <div class="pricing-carousel-wrapper">
                <div class="pricing-carousel" id="pricingCarousel">
                    <?php 
                    $index = 0;
                    foreach ($pricing_tiers as $code => $tier) :
                        $is_popular = !empty($tier['is_popular']);
                        $features = is_array($tier['features']) ? $tier['features'] : explode("\n", $tier['features']);
                    ?>
                    <div class="carousel-card" data-index="<?php echo $index; ?>">
                        <?php if ($is_popular) : ?>
                        <span class="popular-badge">POPULAR</span>
                        <?php endif; ?>
                        
                        <h4 class="tier-name"><?php echo esc_html($tier['name']); ?></h4>
                        <div class="tier-price">
                            <span class="currency">$</span>
                            <span class="amount"><?php echo esc_html($tier['price']); ?></span>
                            <span class="period">/mo</span>
                        </div>
                        
                        <ul class="tier-features">
                            <li class="feature-budget">$<?php echo number_format($tier['budget']); ?> budget</li>
                            <li class="feature-bots"><?php echo $tier['max_bots'] >= 99 ? 'Unlimited' : $tier['max_bots']; ?> real bot<?php echo $tier['max_bots'] > 1 ? 's' : ''; ?></li>
                            <?php foreach ($features as $feature) : 
                                $feature = trim($feature);
                                if (empty($feature)) continue;
                                if (stripos($feature, 'budget') !== false) continue;
                                if (stripos($feature, 'bot') !== false && stripos($feature, 'real') !== false) continue;
                            ?>
                            <li><?php echo esc_html($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php 
                        $index++;
                    endforeach; 
                    ?>
                </div>
                
                <div class="carousel-hint">
                    <span class="hint-icon">👆</span>
                    <span>Drag to explore tiers</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Download -->
<section class="section text-center" id="download">
    <div class="container container-md">
        <h2><?php echo esc_html(ioi_t('download', 'section_title', 'Download IOI')); ?></h2>
        <p class="text-gray mt-md mb-xl"><?php echo esc_html(ioi_t('download', 'section_subtitle', 'Available for Android. Start trading in minutes.')); ?></p>
        
        <?php
        // Get download URLs and visibility settings
        $apk_url = get_option('ioi_apk_url', '#');
        $galaxy_url = get_option('ioi_galaxy_url', '#');
        $huawei_url = get_option('ioi_huawei_url', '#');
        $show_galaxy = get_option('ioi_show_galaxy', 0);
        $show_huawei = get_option('ioi_show_huawei', 0);
        
        // Count visible buttons for layout
        $button_count = 1; // APK always visible
        if ($show_galaxy && $galaxy_url && $galaxy_url !== '#') $button_count++;
        if ($show_huawei && $huawei_url && $huawei_url !== '#') $button_count++;
        ?>
        
        <div class="download-buttons buttons-<?php echo $button_count; ?>">
            <!-- APK Download - Always visible -->
            <a href="<?php echo esc_url($apk_url); ?>" 
               class="download-btn primary-download" 
               onclick="trackDownload('APK Direct')"
               <?php echo ($apk_url && $apk_url !== '#') ? '' : 'style="pointer-events: none; opacity: 0.5;"'; ?>>
                <span class="icon">📱</span>
                <span class="text">
                    <small><?php echo esc_html(ioi_t('download', 'btn_apk_label', 'Direct Download')); ?></small>
                    <strong><?php echo esc_html(ioi_t('download', 'btn_apk_title', 'Download APK')); ?></strong>
                </span>
            </a>
            
            <?php if ($show_galaxy && $galaxy_url && $galaxy_url !== '#') : ?>
            <!-- Galaxy Store - Conditional -->
            <a href="<?php echo esc_url($galaxy_url); ?>" 
               class="download-btn" 
               target="_blank" 
               rel="noopener"
               onclick="trackDownload('Galaxy Store')">
                <span class="icon">🌐</span>
                <span class="text">
                    <small><?php echo esc_html(ioi_t('download', 'btn_galaxy_label', 'Samsung')); ?></small>
                    <strong><?php echo esc_html(ioi_t('download', 'btn_galaxy_title', 'Galaxy Store')); ?></strong>
                </span>
            </a>
            <?php endif; ?>
            
            <?php if ($show_huawei && $huawei_url && $huawei_url !== '#') : ?>
            <!-- Huawei AppGallery - Conditional -->
            <a href="<?php echo esc_url($huawei_url); ?>" 
               class="download-btn" 
               target="_blank" 
               rel="noopener"
               onclick="trackDownload('Huawei AppGallery')">
                <span class="icon">📲</span>
                <span class="text">
                    <small><?php echo esc_html(ioi_t('download', 'btn_huawei_label', 'Huawei')); ?></small>
                    <strong><?php echo esc_html(ioi_t('download', 'btn_huawei_title', 'AppGallery')); ?></strong>
                </span>
            </a>
            <?php endif; ?>
        </div>
        
        <div class="playstore-note">
            <strong><?php echo esc_html(ioi_t('download', 'playstore_title', 'Why not Google Play?')); ?></strong>
            <?php echo esc_html(ioi_t('download', 'playstore_text', 'Google restricts crypto trading apps. We offer direct APK download instead.')); ?>
            <a href="<?php echo home_url('/why-not-playstore/'); ?>" class="text-gold"><?php echo esc_html(ioi_t('download', 'playstore_link', 'Learn more')); ?></a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section bg-dark-2" id="faq">
    <div class="container">
        <div class="section-header">
            <h2>Frequently Asked Questions</h2>
            <p>Everything you need to know about IOI crypto trading bot</p>
        </div>
        <div class="faq-list">
            <!-- FAQ 1: Safety -->
            <div class="faq-item">
                <button class="faq-question">Is IOI safe to use with my Binance account?</button>
                <div class="faq-answer">
                    Yes. IOI uses client-side encryption - your API keys are encrypted on your device with your PIN before being sent to our servers. We never see your unencrypted credentials. Additionally, you create API keys with trading permissions only - no withdrawal access. Your funds always stay in your Binance account.
                </div>
            </div>
            
            <!-- FAQ 2: Expected Returns - UPDATED -->
            <div class="faq-item">
                <button class="faq-question">What returns can I expect?</button>
                <div class="faq-answer">
                    The app has been in development and testing for over a year. Results vary significantly based on market conditions and your bot configuration. In our testing, we've seen anywhere from 10% to 45% monthly returns during favorable market conditions. However, crypto markets are volatile - losses are possible, especially during downtrends. We recommend starting with dry-run mode to test different bot setups and find what works best for current market conditions. Past performance doesn't guarantee future results.
                </div>
            </div>
            
            <!-- FAQ 3: Getting Started -->
            <div class="faq-item">
                <button class="faq-question">How do I get started?</button>
                <div class="faq-answer">
                    Download the app, create an account, and follow the setup guide to connect your Binance account. You'll create API keys on Binance (with trading permissions only), then enter them in the app. Start with dry-run mode to test the bot without risking real money. When you're ready, switch to real trading. The whole setup takes about 5 minutes.
                </div>
            </div>
            
            <!-- FAQ 4: Minimum Investment -->
            <div class="faq-item">
                <button class="faq-question">What's the minimum amount I need to start?</button>
                <div class="faq-answer">
                    With commission-based pricing, you can start with any amount - there's no minimum. If you choose a subscription plan, the Starter tier allows up to $100 trading budget for just $5/month. We recommend starting small while you learn how the bot performs with your chosen settings.
                </div>
            </div>
            
            <!-- FAQ 5: Pricing -->
            <div class="faq-item">
                <button class="faq-question">How does pricing work?</button>
                <div class="faq-answer">
                    You have two options: Commission-based (0.065% per trade, no monthly fee) or Subscription ($5-$1,000/month with zero platform commission). Commission-based is great for testing or smaller budgets. Subscriptions make sense for active traders who want predictable costs. You can switch between models anytime.
                </div>
            </div>
            
            <!-- FAQ 6: Support -->
            <div class="faq-item">
                <button class="faq-question">What if I need help?</button>
                <div class="faq-answer">
                    We offer in-app support and email support at support@getioi.app. Check our setup guide and bot settings guide for detailed instructions. Enterprise subscribers get priority support with faster response times.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Download button layout styles -->
<style>
.download-buttons.buttons-1 {
    justify-content: center;
}
.download-buttons.buttons-1 .download-btn {
    min-width: 280px;
}
.download-buttons.buttons-2 {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
.primary-download {
    border-color: var(--ioi-gold) !important;
    background: rgba(212, 175, 55, 0.1) !important;
}
</style>

<?php get_footer(); ?>