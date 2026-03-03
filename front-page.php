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
            <span class="badge">⚠️ <?php ioi_e('hero', 'badge'); ?></span>
            <h1><?php ioi_e('hero', 'title_1'); ?> <span class="text-gradient"><?php ioi_e('hero', 'title_highlight'); ?></span></h1>
            <p class="hero-subtitle"><?php ioi_e('hero', 'subtitle'); ?></p>
            <div class="hero-cta">
                <a href="#download" class="btn btn-primary btn-lg"><?php ioi_e('hero', 'cta_primary'); ?></a>
                <a href="#how-it-works" class="btn btn-secondary btn-lg"><?php ioi_e('hero', 'cta_secondary'); ?></a>
            </div>
            <div class="spots-indicator">
                <span class="number"><?php echo esc_html($spots); ?></span>
                <span class="label"><?php ioi_e('hero', 'spots_label'); ?></span>
            </div>
        </div>
        <div class="hero-phone">
            <div class="phone-mockup">
                <img src="<?php echo IOI_THEME_URI; ?>/assets/images/app-screenshot.jpg" alt="IOI App Dashboard">
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-bar">
    <div class="stats-grid">
        <div class="stat-item">
            <div class="value"><?php ioi_e('stats', 'stat_1_value'); ?></div>
            <div class="label"><?php ioi_e('stats', 'stat_1_label'); ?></div>
        </div>
        <div class="stat-item">
            <div class="value"><?php ioi_e('stats', 'stat_2_value'); ?></div>
            <div class="label"><?php ioi_e('stats', 'stat_2_label'); ?></div>
        </div>
        <div class="stat-item">
            <div class="value"><?php ioi_e('stats', 'stat_3_value'); ?></div>
            <div class="label"><?php ioi_e('stats', 'stat_3_label'); ?></div>
        </div>
        <div class="stat-item">
            <div class="value"><?php ioi_e('stats', 'stat_4_value'); ?></div>
            <div class="label"><?php ioi_e('stats', 'stat_4_label'); ?></div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section" id="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2><?php ioi_e('how_it_works', 'section_title'); ?></h2>
            <p><?php ioi_e('how_it_works', 'section_subtitle'); ?></p>
        </div>
        <div class="grid grid-3 gap-xl">
            <div class="card text-center">
                <div class="step-number">1</div>
                <h3><?php ioi_e('how_it_works', 'step_1_title'); ?></h3>
                <p class="text-gray mt-md"><?php ioi_e('how_it_works', 'step_1_desc'); ?></p>
            </div>
            <div class="card text-center">
                <div class="step-number">2</div>
                <h3><?php ioi_e('how_it_works', 'step_2_title'); ?></h3>
                <p class="text-gray mt-md"><?php ioi_e('how_it_works', 'step_2_desc'); ?></p>
            </div>
            <div class="card text-center">
                <div class="step-number">3</div>
                <h3><?php ioi_e('how_it_works', 'step_3_title'); ?></h3>
                <p class="text-gray mt-md"><?php ioi_e('how_it_works', 'step_3_desc'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="section bg-dark-2" id="features">
    <div class="container">
        <div class="section-header">
            <h2><?php ioi_e('features', 'section_title'); ?></h2>
            <p><?php ioi_e('features', 'section_subtitle'); ?></p>
        </div>
        <div class="grid grid-2 gap-xl">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
            <div class="card feature-card">
                <div class="icon-box"><?php ioi_e('features', "feature_{$i}_icon"); ?></div>
                <div class="feature-content">
                    <h3><?php ioi_e('features', "feature_{$i}_title"); ?></h3>
                    <p><?php ioi_e('features', "feature_{$i}_desc"); ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Security -->
<section class="section" id="security">
    <div class="container">
        <div class="security-grid">
            <div class="security-visual">
                <div class="shield-icon">🛡️</div>
                <h3><?php ioi_e('security', 'visual_title'); ?></h3>
                <p class="text-gray mt-md"><?php ioi_e('security', 'visual_desc'); ?></p>
            </div>
            <div class="security-content">
                <h2><?php ioi_e('security', 'section_title'); ?></h2>
                <ul class="security-list mt-xl">
                    <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <li><?php ioi_e('security', "point_{$i}"); ?></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="section bg-dark-2" id="pricing">
    <div class="container">
        <div class="section-header">
            <h2><?php ioi_e('pricing', 'section_title'); ?></h2>
            <p>Choose commission-based trading or subscribe for zero fees.</p>
        </div>
        
        <!-- Two Pricing Models Side by Side -->
        <div class="pricing-models-grid">
            
            <!-- Commission Model -->
            <div class="card pricing-card pricing-commission">
                <h3>Commission</h3>
                <div class="price"><?php echo esc_html($commission_rate); ?>%<span> / trade</span></div>
                <p class="pricing-tagline">Pay per trade, no commitment</p>
                <ul class="pricing-features">
                    <li>✓ $0 monthly subscription</li>
                    <li>✓ <?php echo esc_html($commission_rate); ?>% on every buy & sell</li>
                    <li>✓ Unlimited trading budget</li>
                    <li>✓ All features included</li>
                    <li>✓ Cancel anytime</li>
                </ul>
                <p class="pricing-note">Best for: Testing the platform, smaller budgets, or occasional trading</p>
                <a href="#download" class="btn btn-secondary btn-block">Start with Commission</a>
            </div>
            
            <!-- Subscription Intro -->
            <div class="card pricing-card pricing-subscription-intro">
                <h3>Subscription</h3>
                <div class="price">$5 - $1,000<span> / month</span></div>
                <p class="pricing-tagline">Zero trading fees, fixed cost</p>
                <ul class="pricing-features">
                    <li>✓ 0% commission on all trades</li>
                    <li>✓ 5 tiers from $5 to $1,000/mo</li>
                    <li>✓ Budget limits: $100 - $25,000</li>
                    <li>✓ More bots allowed per tier</li>
                    <li>✓ Upgrade/downgrade anytime</li>
                </ul>
                <p class="pricing-note">Best for: Active traders who want predictable costs</p>
                <a href="#pricing-tiers" class="btn btn-primary btn-block">See All Tiers ↓</a>
            </div>
            
        </div>
        
        <!-- Subscription Tiers Detail -->
        <div class="pricing-tiers-section" id="pricing-tiers">
            <h3 class="text-center mt-3xl mb-xl">Subscription Tiers</h3>
            <div class="pricing-tiers-grid">
                <?php foreach ($pricing_tiers as $code => $tier) : 
                    $is_popular = !empty($tier['is_popular']);
                ?>
                <div class="card pricing-tier-card <?php echo $is_popular ? 'card-highlight' : ''; ?>">
                    <?php if ($is_popular) : ?>
                    <span class="badge badge-top">POPULAR</span>
                    <?php endif; ?>
                    <h4><?php echo esc_html($tier['name']); ?></h4>
                    <div class="tier-price">$<?php echo esc_html($tier['price']); ?><span>/mo</span></div>
                    <div class="tier-budget">$<?php echo number_format($tier['budget']); ?> budget</div>
                    <div class="tier-bots"><?php echo esc_html($tier['max_bots']); ?> <?php echo $tier['max_bots'] >= 99 ? 'unlimited' : 'real'; ?> bot<?php echo $tier['max_bots'] > 1 ? 's' : ''; ?></div>
                    <a href="#download" class="btn <?php echo $is_popular ? 'btn-primary' : 'btn-outline'; ?> btn-sm btn-block">Select</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    </div>
</section>

<!-- Download -->
<section class="section text-center" id="download">
    <div class="container container-md">
        <h2><?php ioi_e('download', 'section_title'); ?></h2>
        <p class="text-gray mt-md mb-xl"><?php ioi_e('download', 'section_subtitle'); ?></p>
        
        <div class="download-buttons">
            <a href="<?php echo esc_url(get_option('ioi_apk_url', '#')); ?>" class="download-btn">
                <span class="icon">📱</span>
                <span class="text">
                    <small><?php ioi_e('download', 'btn_apk_label'); ?></small>
                    <strong><?php ioi_e('download', 'btn_apk_title'); ?></strong>
                </span>
            </a>
            <a href="<?php echo esc_url(get_option('ioi_galaxy_url', '#')); ?>" class="download-btn">
                <span class="icon">🌐</span>
                <span class="text">
                    <small><?php ioi_e('download', 'btn_galaxy_label'); ?></small>
                    <strong><?php ioi_e('download', 'btn_galaxy_title'); ?></strong>
                </span>
            </a>
            <a href="<?php echo esc_url(get_option('ioi_huawei_url', '#')); ?>" class="download-btn">
                <span class="icon">📲</span>
                <span class="text">
                    <small><?php ioi_e('download', 'btn_huawei_label'); ?></small>
                    <strong><?php ioi_e('download', 'btn_huawei_title'); ?></strong>
                </span>
            </a>
        </div>
        
        <div class="playstore-note">
            <strong><?php ioi_e('download', 'playstore_title'); ?></strong>
            <?php ioi_e('download', 'playstore_text'); ?>
            <a href="<?php echo home_url('/why-not-playstore/'); ?>" class="text-gold"><?php ioi_e('download', 'playstore_link'); ?></a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section bg-dark-2" id="faq">
    <div class="container">
        <div class="section-header">
            <h2><?php ioi_e('faq', 'section_title'); ?></h2>
        </div>
        <div class="faq-list">
            <?php for ($i = 1; $i <= 6; $i++) : ?>
            <div class="faq-item">
                <button class="faq-question"><?php ioi_e('faq', "q{$i}"); ?></button>
                <div class="faq-answer"><?php ioi_e('faq', "a{$i}"); ?></div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
