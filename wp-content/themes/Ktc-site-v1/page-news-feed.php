<?php
/**
 * Template Name: News Feed
 * Shows the KTC Facebook page feed using Meta's official Page Plugin.
 */
get_header();
?>

<section class="newsfeed-section">

  <!-- Decorative floating background shapes -->
  <div class="bg-shapes" aria-hidden="true">
    <i class="bg-shape bfa" style="font-size:3.5rem;top:6%;left:4%;animation-duration:13s;animation-delay:-2s;">📰</i>
    <i class="bg-shape bfb hide-mobile" style="font-size:3rem;top:15%;right:6%;animation-duration:11s;animation-delay:-5s;">📣</i>
    <i class="bg-shape bda" style="font-size:2.4rem;bottom:20%;left:9%;animation-duration:16s;animation-delay:-4s;">🌟</i>
    <i class="bg-shape bdb hide-mobile" style="font-size:3rem;bottom:10%;right:8%;animation-duration:18s;animation-delay:-8s;">🎓</i>
    <i class="bg-shape bsw hide-mobile" style="font-size:2rem;top:48%;left:2%;animation-duration:10s;animation-delay:-1s;">✏️</i>
  </div>

  <div class="newsfeed-inner">

    <!-- Section heading -->
    <div class="section-header reveal">
      <span class="newsfeed-eyebrow">STAY UP TO DATE</span>
      <h2>News &amp; Updates</h2>
      <div class="section-divider"></div>
      <p>Follow along with the latest news, events, and highlights from Kuruman Tuition Centre. You can also visit and like our page directly on Facebook.</p>
    </div>

    <!-- Facebook Page Plugin -->
    <div class="newsfeed-fb-wrap newsfeed-fb-enter">

      <!-- Header bar: covers any FB heading bleed and holds the Visit buttons -->
      <div class="newsfeed-fb-header">
        <div class="newsfeed-social-btns">
          <a
            href="https://www.facebook.com/ktckur"
            target="_blank"
            rel="noopener noreferrer"
            class="btn-visit-fb"
            aria-label="Visit KTC on Facebook (opens in a new tab)"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.592 1.323-1.324V1.324C24 .593 23.407 0 22.676 0"/></svg>
            Facebook
          </a>
          <a
            href="https://www.instagram.com/kuruman_tuition_centre/"
            target="_blank"
            rel="noopener noreferrer"
            class="btn-visit-ig"
            aria-label="Visit KTC on Instagram (opens in a new tab)"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            Instagram
          </a>
        </div>
      </div>

      <div class="newsfeed-fb-clip">
        <iframe
          class="newsfeed-iframe"
          src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fktckur&tabs=timeline&width=500&height=2000&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false"
          width="500"
          height="2000"
          frameborder="0"
          allowfullscreen="true"
          allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
          title="KTC Kuruman Tuition Centre Facebook Page"
          loading="lazy"
        ></iframe>
      </div>
    </div>



  </div><!-- /newsfeed-inner -->

</section>

<?php get_footer(); ?>
