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
        '1.3'
    );

    // Main script
    wp_enqueue_script(
        'ktc-main-script',
        get_template_directory_uri() . '/js/script.js',
        [],
        '1.2',
        true   // load in footer
    );

    // Pass AJAX URL + nonce to the resources page
    if ( is_page( 'resources' ) ) {
        wp_localize_script(
            'ktc-main-script',
            'KTC_RESOURCES',
            [
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'ktc_resources_nonce' ),
            ]
        );
    }
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

// ── AJAX: fetch all media from a named FileBird folder ────────
// Supports both flat folders (Additional) and nested folders (Grade X → Term Y).
function ktc_ajax_get_folder_media() {
    check_ajax_referer( 'ktc_resources_nonce', 'nonce' );

    $parent_name = sanitize_text_field( wp_unslash( $_POST['parent_folder'] ?? '' ) );
    $child_name  = sanitize_text_field( wp_unslash( $_POST['child_folder']  ?? '' ) );

    if ( empty( $parent_name ) ) {
        wp_send_json_error( 'Missing folder name', 400 );
    }

    global $wpdb;

    // Look up the top-level folder (Grade / Additional / ECD).
    $parent_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}fbv WHERE name = %s AND parent = 0 LIMIT 1",
            $parent_name
        )
    );

    if ( ! $parent_id ) {
        wp_send_json_success( [] );
        return;
    }

    // If a child folder (term) was specified, drill into it.
    if ( ! empty( $child_name ) ) {
        $folder_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id FROM {$wpdb->prefix}fbv WHERE name = %s AND parent = %d LIMIT 1",
                $child_name,
                (int) $parent_id
            )
        );
    } else {
        $folder_id = $parent_id;
    }

    if ( ! $folder_id ) {
        wp_send_json_success( [] );
        return;
    }

    $ids = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT attachment_id FROM {$wpdb->prefix}fbv_attachment_folder WHERE folder_id = %d",
            (int) $folder_id
        )
    );

    if ( empty( $ids ) ) {
        wp_send_json_success( [] );
        return;
    }

    $files = [];
    foreach ( $ids as $attachment_id ) {
        $attachment_id = (int) $attachment_id;
        $url = wp_get_attachment_url( $attachment_id );
        if ( ! $url ) {
            continue;
        }

        $post      = get_post( $attachment_id );
        $mime      = get_post_mime_type( $attachment_id );
        $file_path = get_attached_file( $attachment_id );
        $file_size = ( $file_path && file_exists( $file_path ) ) ? filesize( $file_path ) : 0;
        $title     = $post ? $post->post_title : pathinfo( basename( $url ), PATHINFO_FILENAME );

        $files[] = [
            'id'       => $attachment_id,
            'name'     => $title,
            'url'      => esc_url( $url ),
            'mime'     => $mime,
            'size'     => $file_size,
            'filename' => basename( $url ),
        ];
    }

    wp_send_json_success( $files );
}
add_action( 'wp_ajax_ktc_get_folder_media',        'ktc_ajax_get_folder_media' );
add_action( 'wp_ajax_nopriv_ktc_get_folder_media', 'ktc_ajax_get_folder_media' );