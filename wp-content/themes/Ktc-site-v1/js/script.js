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

    /* ── Resources page: grade → term → modal ───────────── */
    var gradeButtons = document.querySelectorAll( '.res-grade-btn' );
    var termPanel    = document.getElementById( 'resTermPanel' );
    var termLabel    = document.getElementById( 'resTermLabel' );
    var termButtons  = document.querySelectorAll( '.res-term-btn' );
    var modalOverlay = document.getElementById( 'resModalOverlay' );
    var modalTitle   = document.getElementById( 'resModalTitle' );
    var modalClose   = document.getElementById( 'resModalClose' );

    if ( gradeButtons.length && termPanel ) {

        var selectedGrade = '';

        /* Step 1 — click a grade button */
        gradeButtons.forEach( function ( btn ) {
            btn.addEventListener( 'click', function () {
                /* Highlight the chosen grade */
                gradeButtons.forEach( function ( b ) { b.classList.remove( 'is-active' ); } );
                btn.classList.add( 'is-active' );

                selectedGrade = btn.getAttribute( 'data-grade' );

                /* "All" skips the term panel and opens the modal directly */
                if ( selectedGrade === 'all' ) {
                    termPanel.classList.remove( 'is-visible' );
                    termPanel.setAttribute( 'aria-hidden', 'true' );
                    modalTitle.innerHTML = 'All<br><span class="res-modal-subtitle">Resources</span>';
                    openModal();
                    return;
                }

                /* Update the label and reveal the term panel */
                termLabel.textContent = 'Select a term for ' + selectedGrade + ':';
                termPanel.setAttribute( 'aria-hidden', 'false' );
                termPanel.classList.add( 'is-visible' );

                /* Smooth scroll to term panel */
                termPanel.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
            } );
        } );

        /* Step 2 — click a term button → open modal */
        termButtons.forEach( function ( btn ) {
            btn.addEventListener( 'click', function () {
                var term = btn.getAttribute( 'data-term' );
                modalTitle.innerHTML = selectedGrade + ' &ndash; ' + term + '<br><span class="res-modal-subtitle">Resources</span>';
                openModal();
            } );
        } );

        /* Close modal helpers */
        function openModal() {
            modalOverlay.setAttribute( 'aria-hidden', 'false' );
            modalOverlay.classList.add( 'is-open' );
            document.body.style.overflow = 'hidden';
            modalClose.focus();
        }

        function closeModal() {
            modalOverlay.classList.remove( 'is-open' );
            modalOverlay.setAttribute( 'aria-hidden', 'true' );
            document.body.style.overflow = '';
        }

        if ( modalClose ) {
            modalClose.addEventListener( 'click', closeModal );
        }

        if ( modalOverlay ) {
            /* Close on backdrop click */
            modalOverlay.addEventListener( 'click', function ( e ) {
                if ( e.target === modalOverlay ) { closeModal(); }
            } );
        }

        /* Close on Escape key */
        document.addEventListener( 'keydown', function ( e ) {
            if ( e.key === 'Escape' && modalOverlay && modalOverlay.classList.contains( 'is-open' ) ) {
                closeModal();
            }
        } );
    }

} );

/* ══════════════════════════════════════════════════════════════
   GALLERY PAGE — Book viewer + Filmstrip + Lightbox
   ══════════════════════════════════════════════════════════════ */
(function () {
    if ( typeof window.KTC_GALLERY === 'undefined' ) { return; }

    /* ── Fisher-Yates shuffle ───────────────────────────── */
    function shuffle( arr ) {
        var a = arr.slice();
        for ( var i = a.length - 1; i > 0; i-- ) {
            var j = Math.floor( Math.random() * ( i + 1 ) );
            var t = a[i]; a[i] = a[j]; a[j] = t;
        }
        return a;
    }

    var allPhotos    = shuffle( window.KTC_GALLERY );
    var total        = allPhotos.length;

    /* ──────────────────────────────────────────────────────
       BOOK VIEWER
    ────────────────────────────────────────────────────── */
    var imgLeft    = document.getElementById( 'bookImgLeft' );
    var imgRight   = document.getElementById( 'bookImgRight' );
    var numLeft    = document.getElementById( 'bookNumLeft' );
    var numRight   = document.getElementById( 'bookNumRight' );
    var btnPrev    = document.getElementById( 'bookPrev' );
    var btnNext    = document.getElementById( 'bookNext' );
    var counter    = document.getElementById( 'bookCounter' );
    var bookPhotos = shuffle( allPhotos );  /* separate shuffle for book */
    var page       = 0;                     /* each page = 2 photos */
    var turning    = false;

    function renderBook() {
        var iL = page * 2;
        var iR = page * 2 + 1;

        var wrapL = imgLeft  && imgLeft.closest( '.book-img-wrap' );
        var wrapR = imgRight && imgRight.closest( '.book-img-wrap' );

        if ( wrapL ) { wrapL.classList.add( 'is-turning' ); }
        if ( wrapR ) { wrapR.classList.add( 'is-turning' ); }

        setTimeout( function () {
            if ( imgLeft )  {
                imgLeft.src = bookPhotos[iL] ? bookPhotos[iL].url : '';
                imgLeft.alt = bookPhotos[iL] ? bookPhotos[iL].alt : '';
            }
            if ( imgRight ) {
                imgRight.src = bookPhotos[iR] ? bookPhotos[iR].url : '';
                imgRight.alt = bookPhotos[iR] ? bookPhotos[iR].alt : '';
            }
            if ( numLeft )  { numLeft.textContent  = bookPhotos[iL] ? ( iL + 1 ) + ' / ' + total : ''; }
            if ( numRight ) { numRight.textContent = bookPhotos[iR] ? ( iR + 1 ) + ' / ' + total : ''; }

            if ( wrapL ) { wrapL.classList.remove( 'is-turning' ); }
            if ( wrapR ) { wrapR.classList.remove( 'is-turning' ); }
            turning = false;
        }, 300 );

        var maxPage = Math.ceil( total / 2 ) - 1;
        if ( btnPrev ) { btnPrev.disabled = ( page === 0 ); }
        if ( btnNext ) { btnNext.disabled = ( page >= maxPage ); }
        if ( counter ) { counter.textContent = 'Page ' + ( page + 1 ) + ' of ' + Math.ceil( total / 2 ); }
    }

    /* count badge removed */

    if ( btnPrev ) {
        btnPrev.addEventListener( 'click', function () {
            if ( turning || page === 0 ) { return; }
            turning = true; page--; renderBook();
        } );
    }
    if ( btnNext ) {
        btnNext.addEventListener( 'click', function () {
            if ( turning || page >= Math.ceil( total / 2 ) - 1 ) { return; }
            turning = true; page++; renderBook();
        } );
    }

    /* Click photo to open lightbox */
    [ imgLeft, imgRight ].forEach( function ( img, idx ) {
        if ( ! img ) { return; }
        img.closest( '.book-img-wrap' ).addEventListener( 'click', function () {
            openLightbox( bookPhotos, page * 2 + idx );
        } );
    } );

    renderBook();

    /* ──────────────────────────────────────────────────────
       VERTICAL FILMSTRIPS (left = top→bottom, right = bottom→top)
    ────────────────────────────────────────────────────── */
    var trackLeft  = document.getElementById( 'vstripTrackLeft' );
    var trackRight = document.getElementById( 'vstripTrackRight' );
    var stripWrapL = trackLeft  && trackLeft.closest( '.gallery-vstrip' );
    var stripWrapR = trackRight && trackRight.closest( '.gallery-vstrip' );

    function buildVStrip( track, photos, direction ) {
        if ( ! track ) { return; }
        /* Triple so the loop is seamless */
        var tripled = photos.concat( photos ).concat( photos );
        var frag = document.createDocumentFragment();

        tripled.forEach( function ( photo, i ) {
            var div = document.createElement( 'div' );
            div.className = 'vstrip-photo';
            var img = document.createElement( 'img' );
            img.src     = photo.url;
            img.alt     = photo.alt;
            img.loading = 'lazy';
            div.appendChild( img );
            div.addEventListener( 'click', function () {
                openLightbox( photos, i % photos.length );
            } );
            frag.appendChild( div );
        } );
        track.appendChild( frag );

        /* Strips are position:fixed full viewport height — use photo count for loop length */
        var photoH   = 87;  /* 82px photo + 5px gap */
        var setH     = photoH * photos.length;
        var duration = photos.length * 2.4; /* ~2.4s per photo */
        var animName = 'ktcVStrip_' + direction;

        var style = document.createElement( 'style' );
        if ( direction === 'down' ) {
            style.textContent =
                '@keyframes ' + animName + ' {' +
                '  0%   { transform: translateY(0); }' +
                '  100% { transform: translateY(-' + setH + 'px); }' +
                '}';
        } else {
            /* up direction: start translated, animate back to 0 */
            style.textContent =
                '@keyframes ' + animName + ' {' +
                '  0%   { transform: translateY(-' + setH + 'px); }' +
                '  100% { transform: translateY(0); }' +
                '}';
        }
        document.head.appendChild( style );

        track.style.animation = animName + ' ' + duration + 's linear infinite';
    }

    var stripPhotosL = shuffle( allPhotos );
    var stripPhotosR = shuffle( allPhotos );

    buildVStrip( trackLeft,  stripPhotosL, 'down' );
    buildVStrip( trackRight, stripPhotosR, 'up' );

    /* ──────────────────────────────────────────────────────
       LIGHTBOX
    ────────────────────────────────────────────────────── */
    var overlay  = document.getElementById( 'glbOverlay' );
    var glbImg   = document.getElementById( 'glbImg' );
    var glbCap   = document.getElementById( 'glbCaption' );
    var glbClose = document.getElementById( 'glbClose' );
    var glbPrev  = document.getElementById( 'glbPrev' );
    var glbNext  = document.getElementById( 'glbNext' );
    var lbPhotos = [];
    var lbIndex  = 0;

    function openLightbox( photos, index ) {
        lbPhotos = photos;
        lbIndex  = index;
        showLbPhoto();
        overlay.classList.add( 'is-open' );
        overlay.setAttribute( 'aria-hidden', 'false' );
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        overlay.classList.remove( 'is-open' );
        overlay.setAttribute( 'aria-hidden', 'true' );
        document.body.style.overflow = '';
    }

    function showLbPhoto() {
        var p = lbPhotos[ lbIndex ];
        if ( ! p ) { return; }
        glbImg.style.opacity = '0';
        setTimeout( function () {
            glbImg.src = p.url;
            glbImg.alt = p.alt;
            glbImg.style.opacity = '1';
        }, 150 );
        if ( glbCap ) { glbCap.textContent = ( lbIndex + 1 ) + ' / ' + lbPhotos.length; }
        if ( glbPrev ) { glbPrev.disabled = ( lbIndex === 0 ); }
        if ( glbNext ) { glbNext.disabled = ( lbIndex === lbPhotos.length - 1 ); }
    }

    if ( glbClose )  { glbClose.addEventListener( 'click', closeLightbox ); }
    if ( glbPrev )   { glbPrev.addEventListener( 'click', function () { if ( lbIndex > 0 ) { lbIndex--; showLbPhoto(); } } ); }
    if ( glbNext )   { glbNext.addEventListener( 'click', function () { if ( lbIndex < lbPhotos.length - 1 ) { lbIndex++; showLbPhoto(); } } ); }

    if ( overlay ) {
        overlay.addEventListener( 'click', function ( e ) {
            if ( e.target === overlay ) { closeLightbox(); }
        } );
    }

    document.addEventListener( 'keydown', function ( e ) {
        if ( ! overlay || ! overlay.classList.contains( 'is-open' ) ) { return; }
        if ( e.key === 'Escape' )      { closeLightbox(); }
        if ( e.key === 'ArrowLeft' )   { if ( lbIndex > 0 ) { lbIndex--; showLbPhoto(); } }
        if ( e.key === 'ArrowRight' )  { if ( lbIndex < lbPhotos.length - 1 ) { lbIndex++; showLbPhoto(); } }
    } );

}());


