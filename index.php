<?php
/**
 * Index Template (Fallback)
 * @package IOI
 */
get_header();
?>

<section class="section" style="padding-top: 120px;">
    <div class="container container-md text-center">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="card mt-xl" style="text-align: left; padding: var(--space-2xl);">
                <?php the_content(); ?>
            </div>
        <?php endwhile; else : ?>
            <h1>Page Not Found</h1>
            <p class="text-gray mt-md">The page you're looking for doesn't exist.</p>
            <a href="<?php echo home_url('/'); ?>" class="btn btn-primary mt-xl">Go Home</a>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
