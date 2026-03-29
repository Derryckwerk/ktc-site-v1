/* KTC – Mobile Navigation Toggle */
document.addEventListener( 'DOMContentLoaded', function () {
    var toggle = document.getElementById( 'ktcMenuToggle' );
    var nav    = document.getElementById( 'ktcMainNav' );

    if ( toggle && nav ) {
        toggle.addEventListener( 'click', function () {
            var isOpen = nav.classList.toggle( 'is-open' );
            toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
        } );

        // Close menu when a link is tapped on mobile
        nav.querySelectorAll( 'a' ).forEach( function ( link ) {
            link.addEventListener( 'click', function () {
                nav.classList.remove( 'is-open' );
                toggle.setAttribute( 'aria-expanded', 'false' );
            } );
        } );
    }
} );

