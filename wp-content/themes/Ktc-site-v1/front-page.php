<?php
/**
 * Front Page (Homepage) Template
 * Used when WordPress is set to show a static front page.
 */
get_header();
?>

<!-- ══ HERO ══════════════════════════════════════════════════ -->
<section class="hero-section">

    <!-- Animated background shapes -->
    <div class="bg-shapes" aria-hidden="true">
        <span class="bg-shape bfa" style="top:7%;left:3%;font-size:3.2rem;animation-duration:11s;animation-delay:0s;">&#9999;</span>
        <span class="bg-shape bfb" style="top:5%;right:4%;font-size:3.6rem;animation-duration:13s;animation-delay:-3s;">&#9733;</span>
        <span class="bg-shape bda hide-mobile" style="bottom:14%;left:4%;font-size:2.8rem;animation-duration:15s;animation-delay:-6s;">&#128218;</span>
        <span class="bg-shape bdb hide-mobile" style="top:42%;right:3%;font-size:2.4rem;animation-duration:12s;animation-delay:-2s;">&#9986;</span>
        <span class="bg-shape bpu" style="bottom:18%;right:6%;font-size:2rem;animation-duration:9s;animation-delay:-8s;">&#10010;</span>
        <span class="bg-shape bsw hide-mobile" style="top:65%;left:2%;font-size:2.2rem;animation-duration:14s;animation-delay:-4s;">&#127891;</span>
        <span class="bg-shape bfa hide-mobile" style="top:28%;left:7%;font-size:1.8rem;animation-duration:10s;animation-delay:-1s;">&#9830;</span>
        <span class="bg-shape bfb hide-mobile" style="bottom:8%;left:38%;font-size:1.6rem;animation-duration:16s;animation-delay:-9s;">&#9834;</span>
    </div>

    <div class="hero-inner">
        <div class="hero-logo reveal">
            <img
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-full.png"
                alt="Kuruman Tuition Centre Crest"
            >
        </div>
        <div class="hero-badge reveal reveal-delay-1">Welcome to KTC</div>
        <h1 class="hero-title reveal reveal-delay-2">
            <span>Kuruman</span> Tuition Centre
        </h1>
        <p class="hero-subtitle reveal reveal-delay-3">
            Registered Independent Primary School &mdash; Nurturing Future Leaders Since 2016
        </p>
        <a href="#about" class="hero-btn reveal reveal-delay-4">Discover Our Story &#8595;</a>
    </div>
</section>

<?php
$_ktc_home_gallery      = ktc_get_filebird_images( 'Gallery' );
$_ktc_home_gallery_json = wp_json_encode( array_values( $_ktc_home_gallery ) );
?>
<!-- ══ HORIZONTAL FILMSTRIP ═════════════════════════════════ -->
<section class="home-filmstrip-section">

    <!-- Animated background shapes -->
    <div class="bg-shapes" aria-hidden="true">
        <span class="bg-shape bda" style="top:14%;right:3%;font-size:2.8rem;animation-duration:16s;animation-delay:-4s;">&#128247;</span>
        <span class="bg-shape bfb" style="top:18%;left:2%;font-size:2.4rem;animation-duration:11s;animation-delay:-7s;">&#9733;</span>
    </div>

    <div class="section-header reveal">
        <h2>&#128247; Life at KTC</h2>
        <div class="section-divider"></div>
        <p>Moments from our school community.</p>
    </div>

    <!-- Film strip — bleeds edge-to-edge, no user interaction -->
    <div class="home-filmstrip" aria-hidden="true">
        <div class="hstrip-holes hstrip-holes--top">
            <?php for ( $i = 0; $i < 80; $i++ ) : ?><span></span><?php endfor; ?>
        </div>
        <div class="hstrip-track-wrap">
            <div class="hstrip-track" id="homeStripTrack"></div>
        </div>
        <div class="hstrip-holes hstrip-holes--bottom">
            <?php for ( $i = 0; $i < 80; $i++ ) : ?><span></span><?php endfor; ?>
        </div>
    </div>

    <script>window.KTC_HOME_GALLERY = <?php echo $_ktc_home_gallery_json; ?>;</script>

</section>

<!-- ══ ABOUT US ════════════════════════════════════════════ -->
<section class="about-section" id="about">

    <!-- Animated background shapes -->
    <div class="bg-shapes" aria-hidden="true">
        <span class="bg-shape bdb" style="top:8%;right:2%;font-size:2.6rem;animation-duration:14s;animation-delay:-3s;">&#128214;</span>
        <span class="bg-shape bfa" style="bottom:10%;right:4%;font-size:2rem;animation-duration:10s;animation-delay:-8s;">&#10024;</span>
        <span class="bg-shape bsw hide-mobile" style="top:52%;left:1%;font-size:2.4rem;animation-duration:15s;animation-delay:-1s;">&#9999;</span>
        <span class="bg-shape bfb hide-mobile" style="bottom:22%;left:5%;font-size:1.8rem;animation-duration:12s;animation-delay:-6s;">&#9830;</span>
    </div>

    <div class="about-inner">

        <div class="about-logo-wrap reveal">
            <img
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-black.png"
                alt="Kuruman Tuition Centre Crest"
                class="about-logo-img"
            >
        </div>

        <div class="about-content reveal reveal-delay-2">
            <h2>&#128218; About Us</h2>

            <p>KTC is a registered independent primary school. KTC was founded in 2016, after we discovered a need for quality education.</p>

            <p>We provide our learners with a challenging curriculum, which is CAPS aligned.</p>

            <p>Our education style incorporates a high standard of academic excellence, sports and arts/culture, to mold our learners into future leaders.</p>

            <div class="about-highlight">
                &#10024; Our mission is to see a child&#8217;s potential and to improve it &mdash; to focus and enhance their strengths and to equip them for life.
            </div>

            <p>We love to see a child achieve success in whatever his/her talent may be.</p>

            <p>It is our privilege to instill the values of Christ in our learners, so that they can one day be responsible adults. These values include love and respect to all humans and animals, no matter what the background, race or circumstances may be.</p>

            <p>By implementing all the aforementioned goals we strive to lift the level of awareness of each child that is enrolled in our school.</p>
        </div>

    </div>
</section>

<!-- ══ OUR PILLARS ═══════════════════════════════════════════ -->
<section class="values-section">

    <!-- Animated background shapes -->
    <div class="bg-shapes" aria-hidden="true">
        <span class="bg-shape bfb" style="top:7%;left:3%;font-size:2.8rem;animation-duration:12s;animation-delay:-5s;">&#127942;</span>
        <span class="bg-shape bda" style="bottom:9%;right:3%;font-size:2.4rem;animation-duration:14s;animation-delay:-2s;">&#9733;</span>
        <span class="bg-shape bpu hide-mobile" style="top:47%;right:2%;font-size:2rem;animation-duration:11s;animation-delay:-9s;">&#9834;</span>
        <span class="bg-shape bsw hide-mobile" style="bottom:25%;left:2%;font-size:2.2rem;animation-duration:16s;animation-delay:-4s;">&#9999;</span>
        <span class="bg-shape bfa hide-mobile" style="top:20%;right:5%;font-size:1.8rem;animation-duration:18s;animation-delay:-1s;">&#9829;</span>
    </div>

    <div class="section-header reveal">
        <h2>&#127775; Our Pillars</h2>
        <div class="section-divider"></div>
        <p>The foundations we build every learner upon.</p>
    </div>

    <div class="values-grid">
        <div class="value-card reveal reveal-delay-1">
            <div class="value-icon">&#128218;</div>
            <h3>CAPS Aligned</h3>
            <p>A challenging, nationally aligned curriculum designed to unlock each learner&#8217;s full potential.</p>
        </div>
        <div class="value-card reveal reveal-delay-2">
            <div class="value-icon">&#9917;</div>
            <h3>Sports</h3>
            <p>Encouraging physical development, teamwork and a healthy, active lifestyle in every learner.</p>
        </div>
        <div class="value-card reveal reveal-delay-3">
            <div class="value-icon">&#127912;</div>
            <h3>Arts &amp; Culture</h3>
            <p>Celebrating creativity and self-expression to mold well-rounded future leaders.</p>
        </div>
        <div class="value-card reveal reveal-delay-4">
            <div class="value-icon">&#10024;</div>
            <h3>Values</h3>
            <p>Instilling love, respect and Christ-centred values in every learner, every single day.</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
