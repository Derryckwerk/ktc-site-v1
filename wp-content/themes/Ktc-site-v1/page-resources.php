<?php
/**
 * Template Name: Resources
 * Grade-based downloadable resources page for KTC.
 */
get_header();
?>

<section class="resources-section">

  <!-- Decorative floating background shapes -->
  <div class="bg-shapes" aria-hidden="true">
    <i class="bg-shape bfa" style="font-size:3.8rem;top:5%;left:3%;animation-duration:13s;animation-delay:-2s;">📚</i>
    <i class="bg-shape bfb hide-mobile" style="font-size:3.0rem;top:12%;right:5%;animation-duration:11s;animation-delay:-5s;">✏️</i>
    <i class="bg-shape bda" style="font-size:2.4rem;bottom:28%;left:8%;animation-duration:15s;animation-delay:-3s;">🌟</i>
    <i class="bg-shape bdb hide-mobile" style="font-size:3.2rem;bottom:14%;right:7%;animation-duration:17s;animation-delay:-7s;">🎓</i>
    <i class="bg-shape bsw hide-mobile" style="font-size:2.0rem;top:50%;left:1.5%;animation-duration:9s;animation-delay:-1s;">📄</i>
  </div>

  <div class="resources-inner">

    <!-- ── Section heading ─────────────────────────────────── -->
    <div class="section-header reveal">
      <span class="resources-eyebrow">LEARNING MATERIALS</span>
      <h2>Resources</h2>
      <div class="section-divider"></div>
      <p>Select your grade below, then choose a term to access worksheets and learning materials.</p>
    </div>

    <!-- ── Grade selector grid ─────────────────────────────── -->
    <div class="res-grade-grid reveal reveal-delay-1" role="group" aria-label="Select a grade">
      <button class="res-grade-btn" data-grade="Grade 1">Grade 1</button>
      <button class="res-grade-btn" data-grade="Grade 2">Grade 2</button>
      <button class="res-grade-btn" data-grade="Grade 3">Grade 3</button>
      <button class="res-grade-btn" data-grade="Grade 4">Grade 4</button>
      <button class="res-grade-btn" data-grade="Grade 5">Grade 5</button>
      <span class="res-grade-nobreak">
        <button class="res-grade-btn" data-grade="Grade 6">Grade 6</button>
        <button class="res-grade-btn" data-grade="Grade 7">Grade 7</button>
      </span>
      <button class="res-grade-btn res-grade-btn--ecd" data-grade="ECD">ECD</button>
      <button class="res-grade-btn res-grade-btn--all" data-grade="all">All</button>
    </div>

    <!-- ── Term panel (revealed after grade selection) ─────── -->
    <div class="res-term-panel" id="resTermPanel" aria-hidden="true">
      <p class="res-term-label" id="resTermLabel"></p>
      <div class="res-term-grid" role="group" aria-label="Select a term">
        <button class="res-term-btn" data-term="Term 1">Term 1</button>
        <button class="res-term-btn" data-term="Term 2">Term 2</button>
        <button class="res-term-btn" data-term="Term 3">Term 3</button>
        <button class="res-term-btn" data-term="Term 4">Term 4</button>
        <button class="res-term-btn" data-term="Others">Others</button>
      </div>
    </div>

  </div><!-- /resources-inner -->

</section>

<!-- ══ Resources Modal ═══════════════════════════════════════ -->
<div class="res-modal-overlay" id="resModalOverlay" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="resModalTitle">
  <div class="res-modal">
    <button class="res-modal-close" id="resModalClose" aria-label="Close modal">&#10005;</button>
    <h2 class="res-modal-title" id="resModalTitle"></h2>
    <div class="section-divider" style="margin-bottom:28px;"></div>
    <div class="res-modal-body">
      <p class="res-modal-empty">No resources available yet &mdash; check back soon!</p>
    </div>
  </div>
</div>

<?php get_footer(); ?>
