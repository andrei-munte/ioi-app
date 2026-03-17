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
    </script>

    <!-- Microsoft Bing UET Tag -->
    <script>
        (function(w, d, t, u, o) {
            w[u] = w[u] || [];
            o.ts = (new Date).getTime();
            var n = d.createElement(t);
            n.src = "https://bat.bing.net/bat.js?ti=" + o.ti + ("uetq" != u ? "&q=" + u : "");
            n.async = 1;
            n.onload = n.onreadystatechange = function() {
                var s = this.readyState;
                s && "loaded" !== s && "complete" !== s || (o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad"), n.onload = n.onreadystatechange = null)
            };
            var i = d.getElementsByTagName(t)[0];
            i.parentNode.insertBefore(n, i);
        })(window, document, "script", "uetq", {ti: "343239474", enableAutoSpaTracking: true});
    </script>
    <script>
        // Default: deny ad storage until consent
        window.uetq = window.uetq || [];
        window.uetq.push('consent', 'default', {'ad_storage': 'denied'});
    </script>
    
    <!-- SEO Meta Tags -->
    <title><?php echo esc_attr(ioi_get_page_title()); ?></title>
    <meta name="description" content="<?php echo esc_attr(ioi_get_meta_description()); ?>">
    <meta name="keywords" content="crypto trading bot, binance trading bot, automated crypto trading, crypto bot android, momentum trading bot, automated trading app, passive income crypto, IOI">
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
    <meta property="og:site_name" content="IOI - Automated Crypto Trading Bot">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(ioi_get_page_title()); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(ioi_get_meta_description()); ?>">
    <meta name="twitter:image" content="<?php echo IOI_THEME_URI; ?>/assets/images/og-image.jpg">
    
    <!-- App Meta -->
    <meta name="application-name" content="IOI">
    <meta name="theme-color" content="#0a0a0a">
    <meta name="msapplication-TileColor" content="#0a0a0a">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IOI_THEME_URI; ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo IOI_THEME_URI; ?>/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo IOI_THEME_URI; ?>/assets/images/apple-touch-icon.png">
    
    <!-- Language Alternates (for international SEO) - UNCOMMENT WHEN TRANSLATIONS ARE READY
    <link rel="alternate" hreflang="en" href="<?php echo home_url('/'); ?>">
    <link rel="alternate" hreflang="de" href="<?php echo home_url('/de/'); ?>">
    <link rel="alternate" hreflang="es" href="<?php echo home_url('/es/'); ?>">
    <link rel="alternate" hreflang="fr" href="<?php echo home_url('/fr/'); ?>">
    <link rel="alternate" hreflang="it" href="<?php echo home_url('/it/'); ?>">
    <link rel="alternate" hreflang="pt" href="<?php echo home_url('/pt/'); ?>">
    <link rel="alternate" hreflang="ro" href="<?php echo home_url('/ro/'); ?>">
    <link rel="alternate" hreflang="ru" href="<?php echo home_url('/ru/'); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo home_url('/'); ?>">
    -->
    
    <!-- Schema.org Structured Data - SoftwareApplication -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "IOI Crypto Trading Bot",
        "operatingSystem": "Android",
        "applicationCategory": "FinanceApplication",
        "description": "Automated crypto trading bot for Binance with momentum-based strategy. Client-side encryption protects your API keys. Trade 24/7 while you sleep.",
        "offers": {
            "@type": "AggregateOffer",
            "lowPrice": "0",
            "highPrice": "1000",
            "priceCurrency": "USD",
            "offerCount": "6",
            "offers": [
                {
                    "@type": "Offer",
                    "name": "Commission-Based",
                    "price": "0",
                    "priceCurrency": "USD",
                    "description": "Free to start, 0.065% commission per profitable trade"
                },
                {
                    "@type": "Offer",
                    "name": "Starter Subscription",
                    "price": "5",
                    "priceCurrency": "USD",
                    "description": "Monthly subscription with zero platform commission"
                }
            ]
        },
        "featureList": [
            "24/7 automated trading on Binance",
            "Momentum-based token selection",
            "Client-side API key encryption",
            "No withdrawal permissions required",
            "Dry-run testing mode",
            "Real-time performance tracking"
        ],
        "screenshot": "<?php echo IOI_THEME_URI; ?>/assets/images/app-screenshot.png",
        "downloadUrl": "https://play.google.com/store/apps/details?id=app.getioi.ioi",
        "softwareVersion": "1.0",
        "author": {
            "@type": "Organization",
            "name": "IOI",
            "url": "https://getioi.app"
        }
    }
    </script>
    
    <!-- Schema.org - Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "IOI",
        "url": "https://getioi.app",
        "logo": "<?php echo IOI_THEME_URI; ?>/assets/images/logo-icon.png",
        "description": "Automated crypto trading bot for Binance",
        "sameAs": []
    }
    </script>
    
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
        
        <?php // Language switcher - UNCOMMENT WHEN TRANSLATIONS ARE READY
        // echo ioi_language_switcher(); 
        ?>
        
        <button class="mobile-menu-toggle" aria-label="Menu">☰</button>
    </div>
</nav>

<main id="main-content">