<?php
/**
 * KTC Site v1 – Theme Functions
 */

// ── Theme Support ─────────────────────────────────────────────
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
add_theme_support( 'menus' );

// ── Register Nav Menus ────────────────────────────────────────
function ktc_register_menus() {
    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'ktc-site-v1' ),
    ] );
}
add_action( 'init', 'ktc_register_menus' );

// ── Fallback nav (shown before a menu is assigned in WP Admin) ─
function ktc_fallback_menu() {
    $items = [
        home_url( '/' )         => 'Home',
        home_url( '/news-feed' )  => 'News Feed',
        home_url( '/gallery' )    => 'Gallery',
        home_url( '/admissions' ) => 'Admissions',
        home_url( '/contact-us' ) => 'Contact Us',
    ];

    echo '<ul>';
    foreach ( $items as $url => $label ) {
        echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}

// ── Enqueue Styles & Scripts ──────────────────────────────────
function ktc_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'ktc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'ktc-main-style',
        get_template_directory_uri() . '/css/style.css',
        [ 'ktc-google-fonts' ],
        '1.1'
    );

    // Main script
    wp_enqueue_script(
        'ktc-main-script',
        get_template_directory_uri() . '/js/script.js',
        [],
        '1.1',
        true   // load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'ktc_enqueue_assets' );

// ── Helper: auto-create the coming-soon pages on theme activation ─
function ktc_create_default_pages() {
    $pages = [
        'news-feed'   => 'News Feed',
        'gallery'     => 'Gallery',
        'admissions'  => 'Admissions',
        'contact-us'  => 'Contact Us',
    ];

    foreach ( $pages as $slug => $title ) {
        if ( ! get_page_by_path( $slug ) ) {
            wp_insert_post( [
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ] );
        }
    }
}
add_action( 'after_switch_theme', 'ktc_create_default_pages' );
