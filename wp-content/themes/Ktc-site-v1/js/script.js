/* KTC – Mobile Navigation Toggle + Scroll Reveal */
document.addEventListener( 'DOMContentLoaded', function () {

    /* ── Mobile nav toggle ───────────────────────────────── */
    var toggle = document.getElementById( 'ktcMenuToggle' );
    var nav    = document.getElementById( 'ktcMainNav' );

    if ( toggle && nav ) {
        toggle.addEventListener( 'click', function () {
            var isOpen = nav.classList.toggle( 'is-open' );
            toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
        } );

        nav.querySelectorAll( 'a' ).forEach( function ( link ) {
            link.addEventListener( 'click', function () {
                nav.classList.remove( 'is-open' );
                toggle.setAttribute( 'aria-expanded', 'false' );
            } );
        } );
    }

    /* ── Scroll reveal ───────────────────────────────────── */
    var revealEls = document.querySelectorAll( '.reveal' );
    if ( revealEls.length && 'IntersectionObserver' in window ) {
        var observer = new IntersectionObserver(
            function ( entries ) {
                entries.forEach( function ( entry ) {
                    if ( entry.isIntersecting ) {
                        entry.target.classList.add( 'is-visible' );
                        observer.unobserve( entry.target );
                    }
                } );
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
        );
        revealEls.forEach( function ( el ) { observer.observe( el ); } );
    } else {
        /* Fallback: just show everything */
        revealEls.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
    }

} );

