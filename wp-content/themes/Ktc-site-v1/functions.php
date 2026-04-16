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


// ══════════════════════════════════════════════════════════════
// FORM HANDLERS – Contact Us & Admissions
// ══════════════════════════════════════════════════════════════

/**
 * Returns a human-readable label for a given admissions form-type slug.
 */
function ktc_form_type_label( string $type ): string {
    $labels = [
        'application-form'     => 'Application Form',
        'transport-form'       => 'Transport Form',
        'mandate-debit-order'  => 'Mandate – Debit Order',
        'application-form-ecd' => 'Application Form ECD',
    ];
    return $labels[ $type ] ?? ucwords( str_replace( '-', ' ', $type ) );
}

// ── Contact Us form processor ─────────────────────────────────
add_action( 'template_redirect', 'ktc_process_contact_form' );
function ktc_process_contact_form(): void {
    if ( ! is_page( 'contact-us' ) || 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
        return;
    }

    // Nonce check
    if ( ! isset( $_POST['ktc_contact_nonce'] ) ||
         ! wp_verify_nonce(
             sanitize_text_field( wp_unslash( $_POST['ktc_contact_nonce'] ) ),
             'ktc_contact_form'
         ) ) {
        wp_safe_redirect( add_query_arg( 'sent', 'error', get_permalink() ) );
        exit;
    }

    $first   = sanitize_text_field( wp_unslash( $_POST['first_name']  ?? '' ) );
    $last    = sanitize_text_field( wp_unslash( $_POST['last_name']   ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email']            ?? '' ) );
    $cell    = sanitize_text_field( wp_unslash( $_POST['cell_number'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( ! $first || ! $last || ! $message || ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'sent', 'error', get_permalink() ) );
        exit;
    }

    $subject = 'Contact Form Submitted – ' . $first . ' ' . $last;
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: KTC-Kuruman Website <admin@ktcschool.com>',
        'Reply-To: ' . str_replace( [ "\r", "\n" ], '', $first . ' ' . $last ) . ' <' . $email . '>',
    ];

    $sent = wp_mail(
        'info@ktcschool.com',
        $subject,
        ktc_contact_email_html( $first, $last, $email, $cell, $message ),
        $headers
    );

    wp_safe_redirect( add_query_arg( 'sent', $sent ? 'success' : 'error', get_permalink() ) );
    exit;
}

// ── Admissions form processor ─────────────────────────────────
add_action( 'template_redirect', 'ktc_process_admissions_form' );
function ktc_process_admissions_form(): void {
    if ( ! is_page( 'admissions' ) || 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
        return;
    }

    // Nonce check
    if ( ! isset( $_POST['ktc_admissions_nonce'] ) ||
         ! wp_verify_nonce(
             sanitize_text_field( wp_unslash( $_POST['ktc_admissions_nonce'] ) ),
             'ktc_admissions_submit'
         ) ) {
        wp_safe_redirect( add_query_arg( 'sent', 'error', get_permalink() ) );
        exit;
    }

    $first     = sanitize_text_field( wp_unslash( $_POST['first_name']   ?? '' ) );
    $last      = sanitize_text_field( wp_unslash( $_POST['last_name']    ?? '' ) );
    $email     = sanitize_email( wp_unslash( $_POST['email']             ?? '' ) );
    $cell      = sanitize_text_field( wp_unslash( $_POST['cell_number']  ?? '' ) );
    $learner   = sanitize_text_field( wp_unslash( $_POST['learner_name'] ?? '' ) );
    $form_type = sanitize_text_field( wp_unslash( $_POST['form_type']    ?? '' ) );

    $allowed_slugs = [ 'application-form', 'transport-form', 'mandate-debit-order', 'application-form-ecd' ];

    if ( ! $first || ! $last || ! $learner || ! is_email( $email )
         || ! in_array( $form_type, $allowed_slugs, true ) ) {
        wp_safe_redirect( add_query_arg( 'sent', 'error', get_permalink() ) );
        exit;
    }

    // ── Handle optional file attachment ───────────────────────
    $tmp_attachment = '';

    if ( isset( $_FILES['form_attachment'] ) &&
         UPLOAD_ERR_OK === (int) $_FILES['form_attachment']['error'] ) {

        $allowed_mimes = [
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
        ];

        $orig_name = sanitize_file_name( wp_unslash( $_FILES['form_attachment']['name'] ) );
        $check     = wp_check_filetype_and_ext(
            $_FILES['form_attachment']['tmp_name'],
            $orig_name,
            $allowed_mimes
        );

        if ( $check['ext'] && $check['type'] ) {
            $upload    = wp_upload_dir();
            $safe_name = 'ktc-' . wp_generate_password( 10, false ) . '.' . $check['ext'];
            $dest      = trailingslashit( $upload['basedir'] ) . $safe_name;

            if ( move_uploaded_file( $_FILES['form_attachment']['tmp_name'], $dest ) ) {
                $tmp_attachment = $dest;
            }
        }
    }

    $type_label  = ktc_form_type_label( $form_type );
    $subject     = 'Admissions Application – ' . $first . ' ' . $last . ' | ' . $type_label;
    $headers     = [
        'Content-Type: text/html; charset=UTF-8',
        'From: KTC-Kuruman Website <admin@ktcschool.com>',
        'Reply-To: ' . str_replace( [ "\r", "\n" ], '', $first . ' ' . $last ) . ' <' . $email . '>',
    ];
    $attachments = $tmp_attachment ? [ $tmp_attachment ] : [];

    $sent = wp_mail(
        'admissions@ktcschool.com',
        $subject,
        ktc_admissions_email_html( $first, $last, $email, $cell, $learner, $type_label ),
        $headers,
        $attachments
    );

    // Clean up temp file immediately after sending
    if ( $tmp_attachment && file_exists( $tmp_attachment ) ) {
        wp_delete_file( $tmp_attachment );
    }

    wp_safe_redirect( add_query_arg( 'sent', $sent ? 'success' : 'error', get_permalink() ) );
    exit;
}


// ══════════════════════════════════════════════════════════════
// FORM FEEDBACK PAGE RENDERER
// ══════════════════════════════════════════════════════════════

/**
 * Renders the success or error feedback block shown after a form submission.
 *
 * @param string $status     'success' or 'error'
 * @param string $page_label Human-readable page name (e.g. 'Contact Us')
 * @param string $back_url   URL of the page to link back to
 */
function ktc_render_form_feedback( string $status, string $page_label, string $back_url ): void {
    $is_ok    = ( 'success' === $status );
    $logo_url = esc_url( get_template_directory_uri() . '/images/logo-full.png' );
    ?>
    <section class="feedback-section">
      <div class="feedback-inner">

        <img
          src="<?php echo $logo_url; ?>"
          alt="Kuruman Tuition Centre logo"
          class="feedback-logo"
        >

        <?php if ( $is_ok ) : ?>
          <div class="feedback-icon feedback-icon--success" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
          </div>
          <h2 class="feedback-title">Sent Successfully!</h2>
          <p class="feedback-msg">
            Thank you for reaching out. We&#8217;ve received your submission
            and will get back to you as soon as possible.
          </p>
        <?php else : ?>
          <div class="feedback-icon feedback-icon--error" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
          </div>
          <h2 class="feedback-title">Something Went Wrong</h2>
          <p class="feedback-msg">
            We couldn&#8217;t send your submission right now. Please try again,
            or reach us directly at
            <a href="mailto:info@ktcschool.com">info@ktcschool.com</a>.
          </p>
        <?php endif; ?>

        <a href="<?php echo esc_url( $back_url ); ?>" class="btn-back-feedback">
          &#8592; Back to <?php echo esc_html( $page_label ); ?>
        </a>

      </div>
    </section>
    <?php
}


// ══════════════════════════════════════════════════════════════
// HTML EMAIL TEMPLATES
// ══════════════════════════════════════════════════════════════

/**
 * Builds the HTML email body for the Contact Us form.
 */
function ktc_contact_email_html(
    string $first,
    string $last,
    string $email,
    string $cell,
    string $message
): string {
    $year  = esc_html( gmdate( 'Y' ) );
    $name  = esc_html( $first . ' ' . $last );
    $e     = esc_html( $email );
    $c     = esc_html( $cell ?: '—' );
    $msg   = nl2br( esc_html( $message ) );

    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Contact Form Submitted</title>
</head>
<body style="margin:0;padding:0;background:#ECECEC;font-family:Arial,Helvetica,sans-serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
  style="background:#ECECEC;padding:40px 16px;">
  <tr><td align="center">

    <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
      style="max-width:600px;width:100%;border-radius:16px;overflow:hidden;
             box-shadow:0 6px 28px rgba(0,0,0,0.14);">

      <!-- ── Header ─────────────────────────────────────────── -->
      <tr>
        <td style="background:#111113;padding:40px 40px 28px;text-align:center;">
          <!-- Gold icon -->
          <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 20px;">
            <tr>
              <td width="80" height="80" align="center" valign="middle"
                style="width:80px;height:80px;border-radius:50%;
                       background:linear-gradient(135deg,#FFB830 0%,#C98A00 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" style="display:block;margin:0 auto;">
                  <path fill="#111113" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
              </td>
            </tr>
          </table>
          <div style="display:inline-block;background:linear-gradient(135deg,#FFB830 0%,#C98A00 100%);
                      padding:5px 20px;border-radius:100px;margin-bottom:14px;">
            <span style="color:#111113;font-size:10px;font-weight:700;
                         letter-spacing:1.6px;text-transform:uppercase;">
              Web Form Submission
            </span>
          </div>
          <h1 style="margin:0;color:#FFB830;font-size:24px;font-weight:700;line-height:1.3;">
            Contact Form Submitted
          </h1>
          <p style="margin:8px 0 0;color:#9898A4;font-size:13px;">
            A visitor on the KTC website has sent you a message.
          </p>
        </td>
      </tr>

      <!-- Gold accent line -->
      <tr>
        <td style="background:linear-gradient(90deg,#FFB830,#C98A00);height:3px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
      </tr>

      <!-- ── Body ───────────────────────────────────────────── -->
      <tr>
        <td style="background:#ffffff;padding:36px 40px;">

          <!-- From summary card -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:24px;
                   overflow:hidden;border-left:4px solid #FFB830;">
            <tr>
              <td style="padding:18px 22px;">
                <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                           text-transform:uppercase;color:#9898A4;">Submitted by</p>
                <p style="margin:0;font-size:20px;font-weight:700;color:#111113;">
                  <?php echo $name; ?>
                </p>
                <p style="margin:5px 0 0;font-size:13px;color:#555555;">
                  <a href="mailto:<?php echo $e; ?>"
                     style="color:#C98A00;text-decoration:none;"><?php echo $e; ?></a>
                </p>
              </td>
            </tr>
          </table>

          <!-- Email -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:12px;overflow:hidden;">
            <tr><td style="padding:14px 18px;">
              <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                         text-transform:uppercase;color:#9898A4;">Email Address</p>
              <p style="margin:0;font-size:14px;color:#111113;word-break:break-all;">
                <a href="mailto:<?php echo $e; ?>"
                   style="color:#C98A00;text-decoration:none;"><?php echo $e; ?></a>
              </p>
            </td></tr>
          </table>

          <!-- Cell -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:24px;overflow:hidden;">
            <tr><td style="padding:14px 18px;">
              <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                         text-transform:uppercase;color:#9898A4;">Cell Number</p>
              <p style="margin:0;font-size:14px;color:#111113;"><?php echo $c; ?></p>
            </td></tr>
          </table>

          <!-- Message label -->
          <p style="margin:0 0 10px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                     text-transform:uppercase;color:#9898A4;">Message</p>

          <!-- Message body -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:32px;
                   overflow:hidden;border-left:4px solid #FFB830;">
            <tr>
              <td style="padding:20px 22px;font-size:15px;color:#2c2c2c;line-height:1.75;">
                <?php echo $msg; ?>
              </td>
            </tr>
          </table>

          <!-- Reply CTA -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td align="center">
                <a href="mailto:<?php echo $e; ?>"
                   style="display:inline-block;
                          background:linear-gradient(135deg,#FFB830 0%,#C98A00 100%);
                          color:#111113;text-decoration:none;font-size:15px;font-weight:700;
                          padding:14px 38px;border-radius:100px;letter-spacing:0.3px;">
                  Reply to <?php echo $name; ?> &rarr;
                </a>
              </td>
            </tr>
          </table>

        </td>
      </tr>

      <!-- ── Footer ─────────────────────────────────────────── -->
      <tr>
        <td style="background:#111113;padding:22px 40px;text-align:center;
                   border-top:1px solid #2C2C31;">
          <p style="margin:0 0 5px;font-size:11px;color:#6E6E7A;">
            This email was automatically generated from the KTC website contact form.
          </p>
          <p style="margin:0;font-size:11px;color:#6E6E7A;">
            &copy; <?php echo $year; ?> Kuruman Tuition Centre &nbsp;&bull;&nbsp; Soli Deo Gloria
          </p>
        </td>
      </tr>

    </table>

  </td></tr>
</table>

</body>
</html>
    <?php
    return (string) ob_get_clean();
}


/**
 * Builds the HTML email body for the Admissions form.
 */
function ktc_admissions_email_html(
    string $first,
    string $last,
    string $email,
    string $cell,
    string $learner,
    string $form_type
): string {
    $year       = esc_html( gmdate( 'Y' ) );
    $name       = esc_html( $first . ' ' . $last );
    $e          = esc_html( $email );
    $c          = esc_html( $cell ?: '—' );
    $learner_e  = esc_html( $learner );
    $type_e     = esc_html( $form_type );

    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admissions Application</title>
</head>
<body style="margin:0;padding:0;background:#ECECEC;font-family:Arial,Helvetica,sans-serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
  style="background:#ECECEC;padding:40px 16px;">
  <tr><td align="center">

    <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
      style="max-width:600px;width:100%;border-radius:16px;overflow:hidden;
             box-shadow:0 6px 28px rgba(0,0,0,0.14);">

      <!-- ── Header ─────────────────────────────────────────── -->
      <tr>
        <td style="background:#111113;padding:40px 40px 28px;text-align:center;">
          <!-- Gold icon -->
          <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 20px;">
            <tr>
              <td width="80" height="80" align="center" valign="middle"
                style="width:80px;height:80px;border-radius:50%;
                       background:linear-gradient(135deg,#FFB830 0%,#C98A00 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" style="display:block;margin:0 auto;">
                  <path fill="#111113" d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                </svg>
              </td>
            </tr>
          </table>
          <div style="display:inline-block;background:linear-gradient(135deg,#FFB830 0%,#C98A00 100%);
                      padding:5px 20px;border-radius:100px;margin-bottom:14px;">
            <span style="color:#111113;font-size:10px;font-weight:700;
                         letter-spacing:1.6px;text-transform:uppercase;">
              Web Form Submission
            </span>
          </div>
          <h1 style="margin:0;color:#FFB830;font-size:24px;font-weight:700;line-height:1.3;">
            New Admissions Application
          </h1>
          <p style="margin:8px 0 0;color:#9898A4;font-size:13px;">
            A parent / guardian has submitted an admissions form via the KTC website.
          </p>
        </td>
      </tr>

      <!-- Gold accent line -->
      <tr>
        <td style="background:linear-gradient(90deg,#FFB830,#C98A00);height:3px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
      </tr>

      <!-- ── Body ───────────────────────────────────────────── -->
      <tr>
        <td style="background:#ffffff;padding:36px 40px;">

          <!-- Form type badge -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="margin-bottom:24px;">
            <tr>
              <td>
                <span style="display:inline-block;background:linear-gradient(135deg,#FFB830,#C98A00);
                             color:#111113;font-size:12px;font-weight:700;letter-spacing:0.8px;
                             padding:7px 22px;border-radius:100px;">
                  <?php echo $type_e; ?>
                </span>
              </td>
            </tr>
          </table>

          <!-- Parent/Guardian card -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:24px;
                   overflow:hidden;border-left:4px solid #FFB830;">
            <tr>
              <td style="padding:18px 22px;">
                <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                           text-transform:uppercase;color:#9898A4;">Parent / Guardian</p>
                <p style="margin:0;font-size:20px;font-weight:700;color:#111113;">
                  <?php echo $name; ?>
                </p>
                <p style="margin:5px 0 0;font-size:13px;color:#555555;">
                  <a href="mailto:<?php echo $e; ?>"
                     style="color:#C98A00;text-decoration:none;"><?php echo $e; ?></a>
                </p>
              </td>
            </tr>
          </table>

          <!-- Learner card -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:24px;
                   overflow:hidden;border-left:4px solid #C98A00;">
            <tr>
              <td style="padding:18px 22px;">
                <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                           text-transform:uppercase;color:#9898A4;">Learner&#8217;s Name</p>
                <p style="margin:0;font-size:20px;font-weight:700;color:#111113;">
                  <?php echo $learner_e; ?>
                </p>
              </td>
            </tr>
          </table>

          <!-- Email -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:12px;overflow:hidden;">
            <tr><td style="padding:14px 18px;">
              <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                         text-transform:uppercase;color:#9898A4;">Email Address</p>
              <p style="margin:0;font-size:14px;color:#111113;word-break:break-all;">
                <a href="mailto:<?php echo $e; ?>"
                   style="color:#C98A00;text-decoration:none;"><?php echo $e; ?></a>
              </p>
            </td></tr>
          </table>

          <!-- Cell -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#F7F7F7;border-radius:10px;margin-bottom:32px;overflow:hidden;">
            <tr><td style="padding:14px 18px;">
              <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1.2px;
                         text-transform:uppercase;color:#9898A4;">Cell Number</p>
              <p style="margin:0;font-size:14px;color:#111113;"><?php echo $c; ?></p>
            </td></tr>
          </table>

          <!-- Attachment note -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
            style="background:#FFF9EC;border-radius:10px;margin-bottom:32px;
                   overflow:hidden;border:1px solid #FFB830;">
            <tr>
              <td style="padding:16px 22px;">
                <p style="margin:0;font-size:13px;color:#7A5B00;">
                  <strong>&#128206; Document attached:</strong>
                  The completed <?php echo $type_e; ?> is attached to this email.
                  If no attachment is visible, the applicant may not have included a file.
                </p>
              </td>
            </tr>
          </table>

          <!-- Reply CTA -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td align="center">
                <a href="mailto:<?php echo $e; ?>"
                   style="display:inline-block;
                          background:linear-gradient(135deg,#FFB830 0%,#C98A00 100%);
                          color:#111113;text-decoration:none;font-size:15px;font-weight:700;
                          padding:14px 38px;border-radius:100px;letter-spacing:0.3px;">
                  Reply to <?php echo $name; ?> &rarr;
                </a>
              </td>
            </tr>
          </table>

        </td>
      </tr>

      <!-- ── Footer ─────────────────────────────────────────── -->
      <tr>
        <td style="background:#111113;padding:22px 40px;text-align:center;
                   border-top:1px solid #2C2C31;">
          <p style="margin:0 0 5px;font-size:11px;color:#6E6E7A;">
            This email was automatically generated from the KTC website admissions form.
          </p>
          <p style="margin:0;font-size:11px;color:#6E6E7A;">
            &copy; <?php echo $year; ?> Kuruman Tuition Centre &nbsp;&bull;&nbsp; Soli Deo Gloria
          </p>
        </td>
      </tr>

    </table>

  </td></tr>
</table>

</body>
</html>
    <?php
    return (string) ob_get_clean();
}