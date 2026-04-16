<?php
/**
 * Template Name: Contact Us
 * The full Contact Us page for Kuruman Tuition Centre.
 */
get_header();

// Show success / error feedback after form submission and exit early.
$_ktc_sent = isset( $_GET['sent'] ) ? sanitize_key( $_GET['sent'] ) : '';
if ( 'success' === $_ktc_sent || 'error' === $_ktc_sent ) {
    ktc_render_form_feedback( $_ktc_sent, 'Contact Us', home_url( '/contact-us' ) );
    get_footer();
    return;
}
?>

<section class="contact-section">

  <!-- Decorative floating background shapes -->
  <div class="bg-shapes" aria-hidden="true">
    <i class="bg-shape bfa" style="font-size:4rem;top:8%;left:5%;animation-duration:13s;animation-delay:-2s;">✏️</i>
    <i class="bg-shape bfb hide-mobile" style="font-size:3rem;top:18%;right:7%;animation-duration:11s;animation-delay:-5s;">📚</i>
    <i class="bg-shape bda" style="font-size:2.4rem;bottom:22%;left:12%;animation-duration:15s;animation-delay:-3s;">🌟</i>
    <i class="bg-shape bdb hide-mobile" style="font-size:3.5rem;bottom:10%;right:9%;animation-duration:17s;animation-delay:-7s;">🎓</i>
    <i class="bg-shape bsw hide-mobile" style="font-size:2rem;top:50%;left:3%;animation-duration:9s;animation-delay:-1s;">📞</i>
  </div>

  <div class="contact-inner">

    <!-- Section heading -->
    <div class="section-header reveal">
      <span class="contact-eyebrow">GET IN TOUCH</span>
      <h2>Contact Us</h2>
      <div class="section-divider"></div>
      <p>We&#8217;d love to hear from you. Reach out directly or send us a message below and we&#8217;ll get back to you as soon as possible.</p>
    </div>

    <div class="contact-grid">

      <!-- ── Left column: contact details ──────────────────── -->
      <div class="contact-info-card reveal reveal-delay-1">

        <h3>Reach Us Directly</h3>

        <!-- Phone -->
        <div class="contact-detail">
          <span class="contact-icon" aria-hidden="true">📞</span>
          <div class="contact-detail-text">
            <span class="detail-label">Phone</span>
            <a href="tel:+27872929454">087 292 9454</a>
          </div>
        </div>

        <!-- Email -->
        <div class="contact-detail">
          <span class="contact-icon" aria-hidden="true">✉️</span>
          <div class="contact-detail-text">
            <span class="detail-label">Email</span>
            <a href="mailto:info@ktcschool.com">info@ktcschool.com</a>
          </div>
        </div>

        <!-- Social buttons -->
        <div class="contact-social-btns">
          <a
            href="https://www.facebook.com/ktckur"
            target="_blank"
            rel="noopener noreferrer"
            class="btn-facebook"
            aria-label="Visit KTC on Facebook (opens in a new tab)"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.592 1.323-1.324V1.324C24 .593 23.407 0 22.676 0"/>
            </svg>
            Facebook
          </a>
          <a
            href="https://www.instagram.com/kuruman_tuition_centre/"
            target="_blank"
            rel="noopener noreferrer"
            class="btn-instagram"
            aria-label="Visit KTC on Instagram (opens in a new tab)"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
            Instagram
          </a>
        </div>

        <!-- Google Maps embed -->
        <div class="contact-map">
          <iframe
            src="https://maps.google.com/maps?q=Kuruman+Tuition+Centre+KTC,+Summerdown,+Kuruman,+8460,+South+Africa&output=embed"
            width="100%"
            height="260"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="KTC – Kuruman Tuition Centre location on Google Maps"
          ></iframe>
        </div>

      </div><!-- /contact-info-card -->

      <!-- ── Right column: enquiry form ────────────────────── -->
      <div class="contact-form-card reveal reveal-delay-2">

        <h3>Send Us a Message</h3>

        <form class="contact-form" method="post" action="#">
          <?php wp_nonce_field( 'ktc_contact_form', 'ktc_contact_nonce' ); ?>

          <!-- Name row -->
          <div class="form-row">
            <div class="form-group">
              <label for="cf-first-name">First Name</label>
              <input
                type="text"
                id="cf-first-name"
                name="first_name"
                placeholder="e.g. John"
                autocomplete="given-name"
                required
              >
            </div>
            <div class="form-group">
              <label for="cf-last-name">Last Name</label>
              <input
                type="text"
                id="cf-last-name"
                name="last_name"
                placeholder="e.g. Doe"
                autocomplete="family-name"
                required
              >
            </div>
          </div>

          <!-- Email + Cell row -->
          <div class="form-row">
            <div class="form-group">
              <label for="cf-email">Email</label>
              <input
                type="email"
                id="cf-email"
                name="email"
                placeholder="your@email.com"
                autocomplete="email"
                required
              >
            </div>
            <div class="form-group">
              <label for="cf-cell">Cell Number</label>
              <input
                type="tel"
                id="cf-cell"
                name="cell_number"
                placeholder="e.g. 082 000 0000"
                autocomplete="tel"
              >
            </div>
          </div>

          <!-- Message -->
          <div class="form-group">
            <label for="cf-message">Write a Message</label>
            <textarea
              id="cf-message"
              name="message"
              rows="6"
              placeholder="Tell us how we can help&#8230;"
              required
            ></textarea>
          </div>

          <button type="submit" class="btn-submit">Send Message &#8594;</button>
        </form>

      </div><!-- /contact-form-card -->

    </div><!-- /contact-grid -->

  </div><!-- /contact-inner -->

</section>

<?php get_footer(); ?>
