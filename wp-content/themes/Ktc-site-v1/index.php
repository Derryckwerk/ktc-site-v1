<?php
/**
 * Main Index / Blog Loop (fallback template)
 */
get_header();
?>

<div class="coming-soon-wrap">
    <div class="coming-soon-box">
        <div class="cs-logo">
            <img
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-full.png"
                alt="Kuruman Tuition Centre Crest"
                width="100"
                height="100"
            >
        </div>
        <h1>Kuruman Tuition Centre</h1>
        <p>Welcome! Our site is being set up. Please check back soon.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home">
            &#8592; Go Home
        </a>
    </div>
</div>

<?php get_footer(); ?>

