<?php
/**
 * Main Index / Blog Loop (fallback template)
 */
get_header();
?>

<div class="coming-soon-wrap">
    <div class="coming-soon-box">
        <div class="cs-icon">&#127968;</div>
        <h1>Kuruman Tuition Centre</h1>
        <p>Welcome! Our site is being set up. Please check back soon.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home">
            &#8592; Go Home
        </a>
    </div>
</div>

<?php get_footer(); ?>

