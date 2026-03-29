<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-logo-img">
            <img
                src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo-full.png"
                alt="Kuruman Tuition Centre Crest"
                width="90"
                height="90"
            >
        </div>
        <div class="footer-logo">Kuruman Tuition Centre</div>
        <p class="footer-tagline">Registered Independent Primary School &mdash; Educating Future Leaders Since 2016</p>

        <nav class="footer-nav" aria-label="Footer navigation">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <?php
            $ktc_pages = [
                'news-feed'   => 'News Feed',
                'gallery'     => 'Gallery',
                'admissions'  => 'Admissions',
                'contact-us'  => 'Contact Us',
            ];
            foreach ( $ktc_pages as $slug => $label ) {
                $page = get_page_by_path( $slug );
                if ( $page ) {
                    echo '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( $label ) . '</a>';
                }
            }
            ?>
        </nav>

        <p class="footer-copy">
            &copy; <?php echo esc_html( date( 'Y' ) ); ?> Kuruman Tuition Centre &mdash; All rights reserved.
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
