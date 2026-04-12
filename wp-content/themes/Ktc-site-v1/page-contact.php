<?php
/**
 * Template Name: Contact Us
 * The full Contact Us page for Kuruman Tuition Centre.
 */
get_header();
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

        <!-- Facebook button -->
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
          Find Us on Facebook
        </a>

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
