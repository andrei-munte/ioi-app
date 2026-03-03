<?php
/**
 * Page Template
 * @package IOI
 */
get_header();
?>

<section class="hero" style="min-height: 40vh; padding-top: 120px;">
    <div class="hero-content">
        <h1><?php the_title(); ?></h1>
    </div>
</section>

<section class="section">
    <div class="container container-md">
        <div class="card page-content" style="padding: var(--space-3xl);">
            <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
        </div>
    </div>
</section>

<style>
.page-content { color: var(--ioi-gray-4); line-height: 1.8; }
.page-content h2 { color: #fff; margin: var(--space-2xl) 0 var(--space-md); font-size: 1.5rem; }
.page-content h3 { color: #fff; margin: var(--space-xl) 0 var(--space-sm); font-size: 1.25rem; }
.page-content p { margin-bottom: var(--space-md); }
.page-content ul, .page-content ol { margin-bottom: var(--space-md); padding-left: var(--space-xl); }
.page-content li { margin-bottom: var(--space-sm); list-style: disc; }
.page-content ol li { list-style: decimal; }
.page-content a { color: var(--ioi-gold); }
.page-content strong { color: #fff; }
.page-content table { width: 100%; border-collapse: collapse; margin: var(--space-lg) 0; }
.page-content th, .page-content td { padding: var(--space-sm) var(--space-md); border: 1px solid var(--ioi-gray-1); text-align: left; }
.page-content th { background: var(--ioi-dark-3); color: #fff; }
</style>

<?php get_footer(); ?>
