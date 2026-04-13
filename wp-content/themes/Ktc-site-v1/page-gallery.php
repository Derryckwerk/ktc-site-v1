<?php
/**
 * Template Name: Gallery
 * Photo gallery page — book viewer + filmstrip.
 */
get_header();

$images = ktc_get_filebird_images( 'Gallery' );
// PHP shuffle so both book and filmstrip start randomised; JS re-shuffles on every visit too.
shuffle( $images );
$json_images = wp_json_encode( array_values( $images ) );
?>

<section class="gallery-pg-section">

  <!-- Decorative bg shapes -->
  <div class="bg-shapes" aria-hidden="true">
    <i class="bg-shape bfa" style="font-size:3.5rem;top:4%;left:2%;animation-duration:14s;animation-delay:-2s;">📷</i>
    <i class="bg-shape bfb hide-mobile" style="font-size:2.8rem;top:10%;right:4%;animation-duration:11s;animation-delay:-5s;">🌟</i>
    <i class="bg-shape bda hide-mobile" style="font-size:2.2rem;bottom:22%;left:3%;animation-duration:16s;animation-delay:-8s;">🎓</i>
    <i class="bg-shape bdb hide-mobile" style="font-size:2.6rem;bottom:10%;right:5%;animation-duration:13s;animation-delay:-3s;">🖼️</i>
  </div>

  <div class="gallery-pg-inner">

    <!-- ── Heading ── -->
    <div class="section-header reveal">
      <span class="gallery-pg-eyebrow">OUR SCHOOL</span>
      <h2>Photo Gallery</h2>
      <div class="section-divider"></div>
      <p>A glimpse into life at Kuruman Tuition Centre &mdash; moments worth remembering.</p>
    </div>

    <?php if ( empty( $images ) ) : ?>
      <p class="gallery-pg-empty">Photos coming soon &mdash; check back shortly!</p>
    <?php else : ?>

      <!-- ════ BOOK + SIDE STRIPS LAYOUT ══════════════════════ -->
      <div class="gallery-stage reveal reveal-delay-1">

        <!-- Left vertical filmstrip (top → bottom) -->
        <div class="gallery-vstrip gallery-vstrip--left" aria-hidden="true">
          <div class="vstrip-holes vstrip-holes--left" aria-hidden="true">
            <?php for ( $i = 0; $i < 30; $i++ ) : ?><span></span><?php endfor; ?>
          </div>
          <div class="vstrip-track" id="vstripTrackLeft"><!-- JS --></div>
          <div class="vstrip-holes vstrip-holes--right" aria-hidden="true">
            <?php for ( $i = 0; $i < 30; $i++ ) : ?><span></span><?php endfor; ?>
          </div>
        </div>

        <!-- Centre: book + controls -->
        <div class="gallery-book-wrap" aria-label="Photo book">
          <div class="gallery-book">
            <div class="book-page book-page--left">
              <div class="book-img-wrap">
                <img id="bookImgLeft" src="" alt="" loading="eager">
              </div>
              <span class="book-page-num" id="bookNumLeft"></span>
            </div>
            <div class="book-spine" aria-hidden="true"></div>
            <div class="book-page book-page--right">
              <div class="book-img-wrap">
                <img id="bookImgRight" src="" alt="" loading="eager">
              </div>
              <span class="book-page-num" id="bookNumRight"></span>
            </div>
          </div>

          <!-- Controls -->
          <div class="book-controls">
            <button class="book-btn" id="bookPrev" aria-label="Previous photos">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <span class="book-counter" id="bookCounter"></span>
            <button class="book-btn" id="bookNext" aria-label="Next photos">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>

        </div>

        <!-- Right vertical filmstrip (bottom → top) -->
        <div class="gallery-vstrip gallery-vstrip--right" aria-hidden="true">
          <div class="vstrip-holes vstrip-holes--left" aria-hidden="true">
            <?php for ( $i = 0; $i < 30; $i++ ) : ?><span></span><?php endfor; ?>
          </div>
          <div class="vstrip-track" id="vstripTrackRight"><!-- JS --></div>
          <div class="vstrip-holes vstrip-holes--right" aria-hidden="true">
            <?php for ( $i = 0; $i < 30; $i++ ) : ?><span></span><?php endfor; ?>
          </div>
        </div>

      </div><!-- /gallery-stage -->

    <?php endif; ?>

  </div><!-- /gallery-pg-inner -->
</section>

<!-- ── Lightbox overlay ── -->
<div class="glb-overlay" id="glbOverlay" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Photo lightbox">
  <button class="glb-close" id="glbClose" aria-label="Close lightbox">&#10005;</button>
  <button class="glb-arrow glb-arrow--prev" id="glbPrev" aria-label="Previous photo">&#8249;</button>
  <div class="glb-img-wrap">
    <img id="glbImg" src="" alt="">
  </div>
  <button class="glb-arrow glb-arrow--next" id="glbNext" aria-label="Next photo">&#8250;</button>
  <p class="glb-caption" id="glbCaption"></p>
</div>

<script>
/* Pass PHP image array to JS */
window.KTC_GALLERY = <?php echo $json_images; ?>;
</script>
<?php get_footer(); ?>
