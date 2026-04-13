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
        home_url( '/' )           => 'Home',
        home_url( '/news-feed' )   => 'News Feed',
        home_url( '/gallery' )     => 'Gallery',
        home_url( '/admissions' )  => 'Admissions',
        home_url( '/resources' )   => 'Resources',
        home_url( '/contact-us' )  => 'Contact Us',
    ];

    echo '<ul>';
    foreach ( $items as $url => $label ) {
        echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}

// ── Enqueue Styles & Scripts ──────────────────────────────────
function ktc_enqueue_assets() {
    // Google Fonts — Poppins for headings (clean, geometric, Apple-adjacent)
    wp_enqueue_style(
        'ktc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800;900&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'ktc-main-style',
        get_template_directory_uri() . '/css/style.css',
        [ 'ktc-google-fonts' ],
        '1.2'
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
        'resources'   => 'Resources',
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

// ── Force correct templates by page slug ──────────────────────
// Ensures custom page templates are used even when the page was
// created without the template meta being set in the admin.
add_filter( 'template_include', function ( $template ) {
    $slug_map = [
        'resources'  => 'page-resources.php',
        'admissions' => 'page-admissions.php',
        'contact-us' => 'page-contact.php',
        'news-feed'  => 'page-news-feed.php',
        'gallery'    => 'page-gallery.php',
    ];

    if ( is_page() ) {
        $slug = get_post_field( 'post_name', get_queried_object_id() );
        if ( isset( $slug_map[ $slug ] ) ) {
            $located = locate_template( $slug_map[ $slug ] );
            if ( $located ) {
                return $located;
            }
        }
    }

    return $template;
} );

// ── FileBird: get PDFs from a named folder, keyed by file slug ─
/**
 * Returns an associative array of [ post_name => attachment_url ]
 * for every PDF inside the given FileBird folder.
 *
 * @param string $folder_name  Exact name of the FileBird folder.
 * @return array<string, string>
 */
function ktc_get_filebird_pdfs( string $folder_name ): array {
    global $wpdb;

    // Look up the FileBird folder by name.
    $folder_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}fbv WHERE name = %s LIMIT 1",
            $folder_name
        )
    );

    if ( ! $folder_id ) {
        return [];
    }

    // Get all attachment IDs assigned to that folder.
    $ids = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT attachment_id FROM {$wpdb->prefix}fbv_attachment_folder WHERE folder_id = %d",
            (int) $folder_id
        )
    );

    if ( empty( $ids ) ) {
        return [];
    }

    $result = [];
    foreach ( $ids as $id ) {
        $post = get_post( (int) $id );
        if ( $post ) {
            // Key by sanitized title (lowercase, no extension) so WordPress slug
            // auto-numbering (e.g. ktc-primary-2) never breaks the lookup.
            $title_key = strtolower( pathinfo( $post->post_title, PATHINFO_FILENAME ) );
            $result[ $title_key ] = wp_get_attachment_url( (int) $id );
        }
    }

    return $result;
}

// ── FileBird: get images from a named folder ──────────────────
/**
 * Returns an array of [ 'url' => full-size URL, 'alt' => title ]
 * for every image inside the given FileBird folder.
 *
 * @param string $folder_name  Exact name of the FileBird folder.
 * @return array<int, array{url: string, alt: string}>
 */
function ktc_get_filebird_images( string $folder_name ): array {
    global $wpdb;

    $folder_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}fbv WHERE name = %s LIMIT 1",
            $folder_name
        )
    );

    if ( ! $folder_id ) {
        return [];
    }

    $ids = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT attachment_id FROM {$wpdb->prefix}fbv_attachment_folder WHERE folder_id = %d",
            (int) $folder_id
        )
    );

    if ( empty( $ids ) ) {
        return [];
    }

    $result = [];
    foreach ( $ids as $id ) {
        $url = wp_get_attachment_url( (int) $id );
        $alt = get_post_meta( (int) $id, '_wp_attachment_image_alt', true );
        if ( ! $alt ) {
            $alt = get_the_title( (int) $id );
        }
        if ( $url ) {
            $result[] = [ 'url' => $url, 'alt' => $alt ];
        }
    }

    return $result;
}