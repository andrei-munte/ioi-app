<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr(ioi_t('hero', 'subtitle')); ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="ioi - <?php echo esc_attr(ioi_t('hero', 'title_highlight')); ?>">
    <meta property="og:description" content="<?php echo esc_attr(ioi_t('hero', 'subtitle')); ?>">
    <meta property="og:image" content="<?php echo IOI_THEME_URI; ?>/assets/og-image.jpg">
    <meta property="og:type" content="website">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Determine base URL for section links
$is_front_page = is_front_page();
$section_base = $is_front_page ? '' : home_url('/');
?>

<!-- Navigation -->
<nav class="site-nav">
    <div class="nav-inner">
        <a href="<?php echo home_url('/'); ?>" class="logo">
            <div class="logo-icon">
                <img src="<?php echo IOI_THEME_URI; ?>/assets/images/logo-icon.png" alt="ioi" width="28" height="28">
            </div>
            <span>ioi</span>
        </a>
        
        <ul class="nav-menu" id="primary-menu">
            <li><a href="<?php echo esc_url($section_base); ?>#how-it-works"><?php ioi_e('nav', 'link_how_it_works'); ?></a></li>
            <li><a href="<?php echo esc_url($section_base); ?>#features"><?php ioi_e('nav', 'link_features'); ?></a></li>
            <li><a href="<?php echo esc_url($section_base); ?>#security"><?php ioi_e('nav', 'link_security'); ?></a></li>
            <li><a href="<?php echo esc_url($section_base); ?>#pricing"><?php ioi_e('nav', 'link_pricing'); ?></a></li>
            <li><a href="<?php echo esc_url($section_base); ?>#download"><?php ioi_e('nav', 'link_download'); ?></a></li>
            <li class="has-dropdown">
                <a href="#" class="dropdown-toggle">How To <span class="dropdown-arrow">▾</span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo home_url('/setup-guide/'); ?>">App Setup Guide</a></li>
                    <li><a href="<?php echo home_url('/bot-settings-guide/'); ?>">Bot Settings Guide</a></li>
                </ul>
            </li>
        </ul>
        
        <?php echo ioi_language_switcher(); ?>
        
        <button class="mobile-menu-toggle" aria-label="Menu">☰</button>
    </div>
</nav>

<main id="main-content">