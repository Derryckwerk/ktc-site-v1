<?php
/**
 * Front Page (Homepage) Template
 * Used when WordPress is set to show a static front page.
 */
get_header();
?>

<!-- ══ HERO ══════════════════════════════════════════════════ -->
<section class="hero-section">
    <div class="hero-inner">
        <div class="hero-badge">&#127891; Welcome to KTC</div>
        <h1 class="hero-title">
            <span>Kuruman</span> Tuition Centre
        </h1>
        <p class="hero-subtitle">
            Registered Independent Primary School &mdash; Nurturing Future Leaders Since 2016
        </p>
        <a href="#about" class="hero-btn">Discover Our Story &#8595;</a>
    </div>
</section>

<!-- ══ PHOTO PLACEHOLDERS ══════════════════════════════════ -->
<section class="gallery-section">
    <div class="section-header">
        <h2>&#128247; Life at KTC</h2>
        <div class="section-divider"></div>
        <p>Moments from our school community &mdash; photos coming soon!</p>
    </div>

    <div class="gallery-grid">
        <div class="photo-placeholder">
            <div class="ph-icon">&#127979;</div>
            <span>Classroom Life</span>
        </div>
        <div class="photo-placeholder">
            <div class="ph-icon">&#9917;</div>
            <span>Sports &amp; Activities</span>
        </div>
        <div class="photo-placeholder">
            <div class="ph-icon">&#127912;</div>
            <span>Arts &amp; Culture</span>
        </div>
        <div class="photo-placeholder">
            <div class="ph-icon">&#127891;</div>
            <span>Achievements</span>
        </div>
        <div class="photo-placeholder">
            <div class="ph-icon">&#127775;</div>
            <span>School Events</span>
        </div>
        <div class="photo-placeholder">
            <div class="ph-icon">&#129293;</div>
            <span>Our Community</span>
        </div>
    </div>
</section>

<!-- ══ ABOUT US ════════════════════════════════════════════ -->
<section class="about-section" id="about">
    <div class="about-inner">

        <div class="about-img-placeholder">
            <div class="ph-icon">&#127968;</div>
            <span>School Photo Coming Soon</span>
        </div>

        <div class="about-content">
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
    <div class="section-header">
        <h2>&#127775; Our Pillars</h2>
        <div class="section-divider"></div>
        <p>The foundations we build every learner upon.</p>
    </div>

    <div class="values-grid">
        <div class="value-card">
            <div class="value-icon">&#128218;</div>
            <h3>CAPS Aligned</h3>
            <p>A challenging, nationally aligned curriculum designed to unlock each learner&#8217;s full potential.</p>
        </div>
        <div class="value-card">
            <div class="value-icon">&#9917;</div>
            <h3>Sports</h3>
            <p>Encouraging physical development, teamwork and a healthy, active lifestyle in every learner.</p>
        </div>
        <div class="value-card">
            <div class="value-icon">&#127912;</div>
            <h3>Arts &amp; Culture</h3>
            <p>Celebrating creativity and self-expression to mold well-rounded future leaders.</p>
        </div>
        <div class="value-card">
            <div class="value-icon">&#10024;</div>
            <h3>Values</h3>
            <p>Instilling love, respect and Christ-centred values in every learner, every single day.</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
