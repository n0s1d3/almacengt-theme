/* live-search.js — product search dropdown for desktop */
( function ( $ ) {
	'use strict';

	var $form  = $( '.search-bar' );
	var $input = $form.find( 'input[name="s"]' );

	if ( ! $input.length ) return;

	// Inject dropdown container into the form
	var $drop = $( '<div class="search-dropdown" role="listbox" aria-live="polite"></div>' ).appendTo( $form );

	var timer;
	var lastQ = '';

	// ── Helpers ──────────────────────────────────────────────────────────────

	function escHtml( str ) {
		return String( str )
			.replace( /&/g,  '&amp;'  )
			.replace( /</g,  '&lt;'   )
			.replace( />/g,  '&gt;'   )
			.replace( /"/g,  '&quot;' );
	}

	function close() {
		$drop.removeClass( 'is-open' ).empty();
		lastQ = '';
	}

	function truncate( str, max ) {
		return str.length > max ? str.substring( 0, max - 1 ) + '…' : str;
	}

	function renderResults( results, q ) {
		if ( ! results.length ) {
			return '<div class="sdrop-empty">Sin resultados para <strong>&ldquo;' + escHtml( q ) + '&rdquo;</strong></div>';
		}

		var isMobile = window.innerWidth < 768;
		var maxChars = isMobile ? 30 : 45;

		var html = '<ul class="sdrop-list">';
		$.each( results, function ( i, p ) {
			var img = p.image
				? '<img class="sdrop-img" src="' + escHtml( p.image ) + '" alt="" loading="lazy">'
				: '<span class="sdrop-img sdrop-img--placeholder"></span>';
			var cat = p.cat ? '<span class="sdrop-cat">' + escHtml( p.cat ) + '</span>' : '';
			html +=
				'<li class="sdrop-item">' +
					'<a href="' + escHtml( p.url ) + '" class="sdrop-link">' +
						img +
						'<span class="sdrop-info">' +
							'<span class="sdrop-name">' + escHtml( truncate( p.title, maxChars ) ) + '</span>' +
							cat +
						'</span>' +
						'<span class="sdrop-price">' + escHtml( p.price ) + '</span>' +
					'</a>' +
				'</li>';
		} );
		html += '</ul>';

		html +=
			'<div class="sdrop-footer">' +
				'<a href="' + agtSearch.searchUrl + encodeURIComponent( q ) + '" class="sdrop-all">' +
					'Ver todos los resultados para &ldquo;' + escHtml( q ) + '&rdquo; &rarr;' +
				'</a>' +
			'</div>';

		return html;
	}

	// ── Input handler ─────────────────────────────────────────────────────────

	$input.on( 'input', function () {
		clearTimeout( timer );
		var q = $.trim( $( this ).val() );

		if ( q.length < 2 ) { close(); return; }
		if ( q === lastQ  ) return;

		timer = setTimeout( function () {
			lastQ = q;
			$drop
				.html( '<div class="sdrop-loading"><span></span><span></span><span></span></div>' )
				.addClass( 'is-open' );

			$.ajax( {
				url:    agtSearch.ajaxUrl,
				method: 'GET',
				data:   { action: 'agt_live_search', nonce: agtSearch.nonce, q: q },
				success: function ( res ) {
					if ( res.success ) {
						$drop.html( renderResults( res.data, q ) );
					} else {
						close();
					}
				},
				error: close,
			} );
		}, 280 );
	} );

	// ── Close triggers ────────────────────────────────────────────────────────

	// Click outside
	$( document ).on( 'click', function ( e ) {
		if ( ! $( e.target ).closest( '.search-bar' ).length ) close();
	} );

	// Escape key
	$input.on( 'keydown', function ( e ) {
		if ( e.key === 'Escape' ) { close(); $( this ).blur(); }
	} );

	// Form submit — let it go through normally
	$form.on( 'submit', function () { close(); } );

} )( jQuery );
