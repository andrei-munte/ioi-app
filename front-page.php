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

<!-- PRICING SECTION - 3D CAROUSEL
     Replace the existing pricing section in front-page.php with this -->
<section id="pricing" class="pricing">
    <div class="container">
        <div class="section-header">
            <h2>Subscription Tiers</h2>
            <p>Zero trading fees. Choose the budget that fits your goals.</p>
        </div>
        
        <div class="pricing-carousel-wrapper">
            <div class="pricing-carousel" id="pricingCarousel">
                <?php
                $tiers = get_option('ioi_pricing_tiers', [
                    'STARTER' => ['name' => 'Starter', 'price' => 5, 'budget' => 100, 'max_bots' => 1, 'features' => ['$100 trading budget', '1 real bot', 'Zero platform fees'], 'is_popular' => false],
                    'BASIC' => ['name' => 'Basic', 'price' => 100, 'budget' => 2500, 'max_bots' => 3, 'features' => ['$2,500 trading budget', '3 real bots', 'Zero platform fees'], 'is_popular' => true],
                    'PRO' => ['name' => 'Pro', 'price' => 250, 'budget' => 5000, 'max_bots' => 5, 'features' => ['$5,000 trading budget', '5 real bots', 'Zero platform fees'], 'is_popular' => false],
                    'ADVANCED' => ['name' => 'Advanced', 'price' => 500, 'budget' => 10000, 'max_bots' => 10, 'features' => ['$10,000 trading budget', '10 real bots', 'Priority support'], 'is_popular' => false],
                    'ENTERPRISE' => ['name' => 'Enterprise', 'price' => 1000, 'budget' => 25000, 'max_bots' => 99, 'features' => ['$25,000 trading budget', 'Unlimited bots', 'Dedicated support'], 'is_popular' => false],
                ]);
                
                $index = 0;
                foreach ($tiers as $code => $tier) :
                    $is_popular = !empty($tier['is_popular']);
                    $features = is_array($tier['features']) ? $tier['features'] : explode("\n", $tier['features']);
                ?>
                <div class="carousel-card" data-index="<?php echo $index; ?>">
                    <?php if ($is_popular) : ?>
                    <span class="popular-badge">POPULAR</span>
                    <?php endif; ?>
                    
                    <h3 class="tier-name"><?php echo esc_html($tier['name']); ?></h3>
                    <div class="tier-price">
                        <span class="currency">$</span>
                        <span class="amount"><?php echo esc_html($tier['price']); ?></span>
                        <span class="period">/mo</span>
                    </div>
                    
                    <ul class="tier-features">
                        <li class="budget">$<?php echo number_format($tier['budget']); ?> budget</li>
                        <li class="bots"><?php echo $tier['max_bots'] >= 99 ? 'Unlimited' : $tier['max_bots']; ?> real bot<?php echo $tier['max_bots'] > 1 ? 's' : ''; ?></li>
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
