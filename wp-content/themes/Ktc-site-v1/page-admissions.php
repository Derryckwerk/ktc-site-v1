<?php
/**
 * Template Name: Admissions
 * Admissions 2027 page for Kuruman Tuition Centre.
 */
get_header();

// Pull PDFs from the FileBird "Admissions" folder, keyed by file slug.
$admissions_pdfs = ktc_get_filebird_pdfs( 'Admissions' );

/**
 * Helper: render a single download button.
 * If the URL exists the button is live; otherwise it shows "Coming Soon".
 */
function ktc_download_btn( string $url, string $label ): void {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 16l-5-5h3V4h4v7h3l-5 5zm-7 3h14v2H5v-2z"/></svg>';
    if ( $url ) {
        printf(
            '<a href="%s" class="btn-download" download>%s %s</a>',
            esc_url( $url ),
            $svg,
            esc_html( $label )
        );
    } else {
        printf(
            '<a href="#" class="btn-download btn-download--soon" aria-disabled="true" tabindex="-1">%s %s</a>',
            $svg,
            esc_html( $label )
        );
    }
}
?>

<section class="admissions-section">

  <!-- Decorative floating background shapes -->
  <div class="bg-shapes" aria-hidden="true">
    <i class="bg-shape bfa" style="font-size:4rem;top:6%;left:4%;animation-duration:14s;animation-delay:-3s;">📄</i>
    <i class="bg-shape bfb hide-mobile" style="font-size:3.2rem;top:14%;right:6%;animation-duration:12s;animation-delay:-6s;">✏️</i>
    <i class="bg-shape bda" style="font-size:2.6rem;bottom:26%;left:10%;animation-duration:16s;animation-delay:-4s;">🌟</i>
    <i class="bg-shape bdb hide-mobile" style="font-size:3.5rem;bottom:12%;right:8%;animation-duration:18s;animation-delay:-8s;">🎓</i>
    <i class="bg-shape bsw hide-mobile" style="font-size:2.2rem;top:48%;left:2%;animation-duration:10s;animation-delay:-2s;">📚</i>
  </div>

  <div class="admissions-inner">

    <!-- ── Section heading ─────────────────────────────────── -->
    <div class="section-header reveal">
      <span class="admissions-eyebrow">ENROLMENTS OPEN</span>
      <h2>Admissions 2027</h2>
      <div class="section-divider"></div>
    </div>

    <!-- ── Download forms grid ─────────────────────────────── -->
    <div class="admissions-forms-grid">

      <div class="admissions-form-card reveal reveal-delay-1">
        <span class="afc-icon" aria-hidden="true">📋</span>
        <div class="afc-details">
          <span class="afc-label">Form 1</span>
          <h3>Application Form</h3>
        </div>
        <?php ktc_download_btn( $admissions_pdfs['ktc-primary'] ?? '', 'Download' ); ?>
      </div>

      <div class="admissions-form-card reveal reveal-delay-2">
        <span class="afc-icon" aria-hidden="true">🚌</span>
        <div class="afc-details">
          <span class="afc-label">Form 2</span>
          <h3>Transport Form</h3>
        </div>
        <?php ktc_download_btn( $admissions_pdfs['ktc-transport'] ?? '', 'Download' ); ?>
      </div>

      <div class="admissions-form-card reveal reveal-delay-3">
        <span class="afc-icon" aria-hidden="true">🏦</span>
        <div class="afc-details">
          <span class="afc-label">Form 3</span>
          <h3>Mandate &ndash; Debit Order</h3>
        </div>
        <?php ktc_download_btn( $admissions_pdfs['ktc-debit-order'] ?? '', 'Download' ); ?>
      </div>

      <div class="admissions-form-card reveal reveal-delay-4">
        <span class="afc-icon" aria-hidden="true">🧒</span>
        <div class="afc-details">
          <span class="afc-label">Form 4</span>
          <h3>Application Form ECD</h3>
        </div>
        <?php ktc_download_btn( $admissions_pdfs['ktc-ecd'] ?? '', 'Download' ); ?>
      </div>

    </div><!-- /admissions-forms-grid -->

    <!-- ── Info banner ─────────────────────────────────────── -->
    <div class="admissions-info-row reveal reveal-delay-1">

      <div class="admissions-info-item">
        <span class="aii-icon" aria-hidden="true">📄</span>
        <div class="aii-text">
          <strong>Download the Forms</strong>
          <span>Select and download the relevant documents from the cards below.</span>
        </div>
      </div>

      <div class="admissions-info-divider" aria-hidden="true"></div>

      <div class="admissions-info-item">
        <span class="aii-icon" aria-hidden="true">✉️</span>
        <div class="aii-text">
          <strong>Submit Your Documents</strong>
          <span>Choose whichever option works best for you:</span>
          <ul class="aii-options">
            <li>
              <span class="aii-option-icon" aria-hidden="true">📧</span>
              <span>Email to:<br><a href="mailto:admissions@ktcschool.com">admissions@ktcschool.com</a></span>
            </li>
            <li>
              <span class="aii-option-icon" aria-hidden="true">🏫</span>
              <span>Drop off at our offices</span>
            </li>
            <li>
              <span class="aii-option-icon" aria-hidden="true">📎</span>
              <span>Attach &amp; send via the form below</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="admissions-info-divider" aria-hidden="true"></div>

      <div class="admissions-info-item">
        <span class="aii-icon" aria-hidden="true">💬</span>
        <div class="aii-text">
          <strong>Need Help?</strong>
          <span>Please feel free to <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">contact us</a> for further information.</span>
        </div>
      </div>

    </div>

    <!-- ── Submit completed form via site ─────────────────── -->
    <div class="admissions-submit-wrap reveal">

      <div class="section-header" style="margin-bottom:40px;">
        <h2 style="font-size:clamp(1.5rem,2.8vw,2rem);">Submit Your Completed Form</h2>
        <div class="section-divider"></div>
        <p>Fill in your contact details below, select which form you are attaching, add your child&#8217;s name, and attach the completed document.</p>
      </div>

      <div class="admissions-form-card-wrap">
        <form class="admissions-submit-form" method="post" action="#" enctype="multipart/form-data">
          <?php wp_nonce_field( 'ktc_admissions_submit', 'ktc_admissions_nonce' ); ?>

          <!-- Parent/Guardian name row -->
          <div class="form-row">
            <div class="form-group">
              <label for="af-first-name">First Name</label>
              <input
                type="text"
                id="af-first-name"
                name="first_name"
                placeholder="e.g. John"
                autocomplete="given-name"
                required
              >
            </div>
            <div class="form-group">
              <label for="af-last-name">Last Name</label>
              <input
                type="text"
                id="af-last-name"
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
              <label for="af-email">Email</label>
              <input
                type="email"
                id="af-email"
                name="email"
                placeholder="your@email.com"
                autocomplete="email"
                required
              >
            </div>
            <div class="form-group">
              <label for="af-cell">Cell Number</label>
              <input
                type="tel"
                id="af-cell"
                name="cell_number"
                placeholder="e.g. 082 000 0000"
                autocomplete="tel"
              >
            </div>
          </div>

          <!-- Learner name + Form type row -->
          <div class="form-row">
            <div class="form-group">
              <label for="af-learner">Learner&#8217;s Name</label>
              <input
                type="text"
                id="af-learner"
                name="learner_name"
                placeholder="Full name of the learner"
                required
              >
            </div>
            <div class="form-group">
              <label for="af-form-type">Form Type</label>
              <select id="af-form-type" name="form_type" required>
                <option value="" disabled selected>Select the form you are attaching&hellip;</option>
                <option value="application-form">Application Form</option>
                <option value="transport-form">Transport Form</option>
                <option value="mandate-debit-order">Mandate &ndash; Debit Order</option>
                <option value="application-form-ecd">Application Form ECD</option>
              </select>
            </div>
          </div>

          <!-- File attachment -->
          <div class="form-group">
            <label for="af-attachment">Attach Completed Form</label>
            <div class="file-upload-wrap">
              <input
                type="file"
                id="af-attachment"
                name="form_attachment"
                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                required
              >
              <label for="af-attachment" class="file-upload-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M9 16h6v-6h4l-7-7-7 7h4v6zm-4 2h14v2H5v-2z"/></svg>
                <span>Choose file&hellip;</span>
              </label>
              <span class="file-name-display">No file chosen</span>
            </div>
            <p class="form-helper">Accepted formats: PDF, DOC, DOCX, JPG, PNG</p>
          </div>

          <button type="submit" class="btn-submit">Send Application &#8594;</button>

        </form>
      </div><!-- /admissions-form-card-wrap -->

    </div><!-- /admissions-submit-wrap -->

  </div><!-- /admissions-inner -->

</section>

<script>
/* Show selected filename in the custom file input label */
(function () {
  var input = document.getElementById('af-attachment');
  var display = document.querySelector('.file-name-display');
  if (input && display) {
    input.addEventListener('change', function () {
      display.textContent = this.files.length ? this.files[0].name : 'No file chosen';
    });
  }
})();
</script>

<?php get_footer(); ?>
