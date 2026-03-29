<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-inner">

        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-full.png"
                    alt="Kuruman Tuition Centre Crest"
                    class="header-logo-img"
                    width="58"
                    height="58"
                >
                <div class="logo-text-wrap">
                    <div class="school-name">Kuruman Tuition Centre</div>
                    <div class="school-tag">Soli Deo Gloria</div>
                </div>
            </a>
        </div>

        <button class="menu-toggle" id="ktcMenuToggle" aria-label="Open navigation menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" id="ktcMainNav" aria-label="Primary navigation">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'ktc_fallback_menu',
            ] );
            ?>
        </nav>

    </div>
</header>
