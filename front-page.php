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

<!-- PRICING SECTION - 3D CAROUSEL -->
<section id="pricing" class="pricing">
    <div class="container">
        <div class="section-header">
            <h2>Simple, Transparent Pricing</h2>
            <p>Choose commission-based trading or subscribe for zero fees</p>
        </div>
        
        <div class="pricing-models">
            <div class="pricing-model-card">
                <div class="model-header">
                    <h3>Commission</h3>
                    <div class="model-price">
                        <span class="amount"><?php echo esc_html($commission_rate); ?>%</span>
                        <span class="period">per trade</span>
                    </div>
                </div>
                <p class="model-tagline">Pay per trade, no commitment</p>
                <ul class="model-features">
                    <li>$0 monthly subscription</li>
                    <li><?php echo esc_html($commission_rate); ?>% on every buy and sell</li>
                    <li>Unlimited trading budget</li>
                    <li>All features included</li>
                </ul>
                <p class="model-note">Best for testing or occasional trading</p>
            </div>
            
            <div class="pricing-model-card">
                <div class="model-header">
                    <h3>Subscription</h3>
                    <div class="model-price">
                        <span class="amount">$5-$1k</span>
                        <span class="period">per month</span>
                    </div>
                </div>
                <p class="model-tagline">Zero trading fees, fixed monthly cost</p>
                <ul class="model-features">
                    <li>0% commission on all trades</li>
                    <li>5 tiers to choose from</li>
                    <li>Budget limits $100 to $25,000</li>
                    <li>Upgrade or downgrade anytime</li>
                </ul>
                <p class="model-note">Best for active traders wanting predictable costs</p>
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
                    <span class="hint-icon">&#128070;</span>
                    <span>Drag to explore tiers</span>
                </div>
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
