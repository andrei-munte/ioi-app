</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?php echo home_url('/'); ?>" class="logo">
                    <div class="logo-icon">
                        <img src="<?php echo IOI_THEME_URI; ?>/assets/images/logo-icon.png" alt="ioi" width="28" height="28">
                    </div>
                    <span>ioi</span>
                </a>
                <p><?php ioi_e('footer', 'brand_tagline'); ?></p>
            </div>
            
            <div class="footer-col">
                <h4><?php ioi_e('footer', 'col_product'); ?></h4>
                <ul>
                    <li><a href="#how-it-works"><?php ioi_e('nav', 'link_how_it_works'); ?></a></li>
                    <li><a href="#features"><?php ioi_e('nav', 'link_features'); ?></a></li>
                    <li><a href="#pricing"><?php ioi_e('nav', 'link_pricing'); ?></a></li>
                    <li><a href="#download"><?php ioi_e('nav', 'link_download'); ?></a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h4><?php ioi_e('footer', 'col_resources'); ?></h4>
                <ul>
                    <li><a href="<?php echo home_url('/how-to/'); ?>"><?php ioi_e('nav', 'link_guide'); ?></a></li>
                    <li><a href="<?php echo home_url('/faq/'); ?>">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h4><?php ioi_e('footer', 'col_legal'); ?></h4>
                <ul>
                    <li><a href="<?php echo home_url('/terms/'); ?>"><?php ioi_e('footer', 'link_terms'); ?></a></li>
                    <li><a href="<?php echo home_url('/privacy/'); ?>"><?php ioi_e('footer', 'link_privacy'); ?></a></li>
                    <li><a href="<?php echo home_url('/risk/'); ?>"><?php ioi_e('footer', 'link_risk'); ?></a></li>
                    <li><a href="<?php echo home_url('/aml/'); ?>"><?php ioi_e('footer', 'link_aml'); ?></a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <span><?php ioi_e('footer', 'copyright'); ?></span>
            <span><?php ioi_e('footer', 'disclaimer'); ?></span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
