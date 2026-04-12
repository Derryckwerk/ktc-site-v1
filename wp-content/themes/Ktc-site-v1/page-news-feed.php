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

      <!-- Header bar: covers any FB heading bleed and holds the Visit button -->
      <div class="newsfeed-fb-header">
        <a
          href="https://www.facebook.com/ktckur"
          target="_blank"
          rel="noopener noreferrer"
          class="btn-visit-fb"
          aria-label="Visit KTC on Facebook (opens in a new tab)"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.592 1.323-1.324V1.324C24 .593 23.407 0 22.676 0"/></svg>
          Visit Our Facebook Page
        </a>
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
