<?php
/**
 * Default Page Template
 * All inner pages (News Feed, Gallery, Admissions, Contact Us) display
 * a friendly "Coming Soon" message until content is added.
 */
get_header();
?>

<div class="coming-soon-wrap">
    <div class="coming-soon-box">
        <div class="cs-icon">&#127959;</div>
        <h1><?php the_title(); ?></h1>
        <p>
            We&#8217;re busy building something great for you!<br>
            This page is under construction and will be ready very soon.
        </p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home">
            &#8592; Back to Home
        </a>
    </div>
</div>

<?php get_footer(); ?>
