<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RCPXNFE066"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-RCPXNFE066');
        
        // Track download button clicks
        function trackDownload(source) {
            gtag('event', 'download_click', {
                'event_category': 'Downloads',
                'event_label': source,
                'value': 1
            });
        }
        
        // Track outbound links
        function trackOutbound(url, label) {
            gtag('event', 'click', {
                'event_category': 'Outbound',
                'event_label': label || url,
                'transport_type': 'beacon'
            });
        }
    </script>
    
    <!-- SEO Meta Tags -->
    <title><?php echo esc_attr(ioi_get_page_title()); ?></title>
    <meta name="description" content="<?php echo esc_attr(ioi_get_meta_description()); ?>">
    <meta name="keywords" content="crypto trading bot, automated trading, Binance bot, cryptocurrency, trading algorithm, passive income crypto, IOI">
    <meta name="author" content="IOI">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url(ioi_get_canonical_url()); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(ioi_get_canonical_url()); ?>">
    <meta property="og:title" content="<?php echo esc_attr(ioi_get_page_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr(ioi_get_meta_description()); ?>">
    <meta property="og:image" content="<?php echo IOI_THEME_URI; ?>/assets/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="IOI - Crypto Trading Bot">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(ioi_get_page_title()); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(ioi_get_meta_description()); ?>">
    <meta name="twitter:image" content="<?php echo IOI_THEME_URI; ?>/assets/images/og-image.jpg">
    
    <!-- App Meta -->
    <meta name="application-name" content="IOI">
    <meta name="apple-mobile-web-app-title" content="IOI">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#0a0a0a">
    <meta name="msapplication-TileColor" content="#0a0a0a">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IOI_THEME_URI; ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo IOI_THEME_URI; ?>/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo IOI_THEME_URI; ?>/assets/images/apple-touch-icon.png">
    
    <!-- Geo Tags (Global targeting) -->
    <meta name="geo.region" content="GLOBAL">
    <meta name="geo.placename" content="Worldwide">
    
    <!-- Language Alternates -->
    <link rel="alternate" hreflang="en" href="<?php echo home_url('/'); ?>">
    <link rel="alternate" hreflang="de" href="<?php echo home_url('/de/'); ?>">
    <link rel="alternate" hreflang="es" href="<?php echo home_url('/es/'); ?>">
    <link rel="alternate" hreflang="fr" href="<?php echo home_url('/fr/'); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo home_url('/'); ?>">
    
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
                <img src="<?php echo IOI_THEME_URI; ?>/assets/images/logo-icon.png" alt="IOI Crypto Trading Bot" width="28" height="28">
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
        
        <button class="mobile-menu-toggle" aria-label="Toggle navigation menu">☰</button>
    </div>
</nav>

<main id="main-content">