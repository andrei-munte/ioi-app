<?php
/**
 * Template Name: Internal Page
 * Generic template for legal and resource pages
 * @package IOI
 */

get_header();
?>

<main class="internal-page">
    <div class="page-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <?php if (get_field('page_subtitle')) : ?>
            <p class="page-subtitle"><?php the_field('page_subtitle'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="page-content">
        <div class="container container-md">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
            
            <?php if (get_field('last_updated')) : ?>
            <p class="last-updated">Last updated: <?php the_field('last_updated'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
