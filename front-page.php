<?php
/**
 * Landing Page Template
 * @package IOI
 */

get_header();
$spots = ioi_get_spots();
?>

<!-- Hero -->
<section class="hero" id="hero">
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
                <div class="step-number" style="margin: 0 auto var(--space-lg);">1</div>
                <h3><?php ioi_e('how_it_works', 'step_1_title'); ?></h3>
                <p class="text-gray mt-md"><?php ioi_e('how_it_works', 'step_1_desc'); ?></p>
            </div>
            <div class="card text-center">
                <div class="step-number" style="margin: 0 auto var(--space-lg);">2</div>
                <h3><?php ioi_e('how_it_works', 'step_2_title'); ?></h3>
                <p class="text-gray mt-md"><?php ioi_e('how_it_works', 'step_2_desc'); ?></p>
            </div>
            <div class="card text-center">
                <div class="step-number" style="margin: 0 auto var(--space-lg);">3</div>
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
            <p><?php ioi_e('pricing', 'section_subtitle'); ?></p>
        </div>
        <div class="pricing-grid">
            <!-- Commission -->
            <div class="card pricing-card">
                <h3><?php ioi_e('pricing', 'commission_title'); ?></h3>
                <div class="price"><?php ioi_e('pricing', 'commission_price'); ?><span><?php ioi_e('pricing', 'commission_suffix'); ?></span></div>
                <p class="text-gray"><?php ioi_e('pricing', 'commission_tagline'); ?></p>
                <ul class="pricing-features">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <li>✓ <?php ioi_e('pricing', "commission_f{$i}"); ?></li>
                    <?php endfor; ?>
                </ul>
                <a href="#download" class="btn btn-secondary btn-block"><?php ioi_e('pricing', 'commission_cta'); ?></a>
            </div>
            <!-- Subscription -->
            <div class="card card-highlight pricing-card">
                <span class="badge badge-top"><?php ioi_e('pricing', 'subscription_badge'); ?></span>
                <h3><?php ioi_e('pricing', 'subscription_title'); ?></h3>
                <div class="price"><?php ioi_e('pricing', 'subscription_price'); ?><span><?php ioi_e('pricing', 'subscription_suffix'); ?></span></div>
                <p class="text-gray"><?php ioi_e('pricing', 'subscription_tagline'); ?></p>
                <ul class="pricing-features">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <li>✓ <?php ioi_e('pricing', "subscription_f{$i}"); ?></li>
                    <?php endfor; ?>
                </ul>
                <a href="#download" class="btn btn-primary btn-block"><?php ioi_e('pricing', 'subscription_cta'); ?></a>
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
