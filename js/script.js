

(function( $ ) {
	'use strict';

	bpca_script.init = function() {
		bpca_script.menu();
		bpca_script.search();
		bpca_script.pagination();
		bpca_script.alerts();
	};

	bpca_script.menu = function() {
		$(".current_page_item .sub-menu").addClass('show');
		// Commenting this out for now since they don't want this behavior actually
		//$(".current_page_item").parent().addClass('show');

		$('.menu-item-has-children>a').on( "click", function(e) {
			e.preventDefault();
			$(".sub-menu").removeClass('show');

            if ($(this).parent().hasClass('current-menu-open')) {
                $(".current-menu-open").removeClass('current-menu-open');
            } else {
                $(this).next(".sub-menu").addClass('show');
                $(".current-menu-open").removeClass('current-menu-open');
                $(this).parent('li').addClass('current-menu-open');
            }
		});
	};

	bpca_script.search = function() {
		var $menu        = $( '#menu .menu' ),
		    $mobile_menu = $( '#mobile-menu .menu' ),
		    $hamburger   = $( 'a.mmenu' );

		var previous_search = bpca_script.get_query_string_value( 's' ),
		    search_icon     = '<a href="#search"><img src="' + bpca_script.theme_url + '/images/search.png" alt="Search" width="22" height="22" /></a>',
			search_icon_m   = '<a href="#search"><img src="' + bpca_script.theme_url + '/images/search-mobile.png" alt="Search" width="22" height="22" /> Search</a>';

		// Mobile needs to be treated differently because it's a hamburger menu
		if ( $hamburger.is( ':visible' ) ) {
			$mobile_menu.append( '<li class="search"><input type="text" name="s" value="' + previous_search + '" class="input keyword" />' + search_icon_m + '</li>' );

			var $input = $mobile_menu.find( '.search input' ),
			    $search_button = $mobile_menu.find( '.search a' );

			$search_button.on( 'click', function( event ) {
				event.preventDefault();
				window.location.replace( '?s=' + encodeURIComponent( $input.attr( 'value' ) ) );
			});

			return false;
		}

		$menu.append( '<li class="search">' + search_icon + '<input type="text" name="s" value="' + previous_search + '" style="display: none;" class="input keyword" /></li>' );

		var $input = $menu.find( '.search input' );

		$input.on('keyup', function( event ) {
			if ( 13 == event.keyCode ) {
				window.location.replace( '?s=' + encodeURIComponent( $input.attr( 'value' ) ) );
			}
		});

		if ( '' != previous_search ) {
			$input.show();
		}

		var $search_button = $menu.find( '.search a' );

		$search_button.on( 'click', function( event ) {
			event.preventDefault();

			$input.toggle( 'slow' );
		});

		$input.on('keyup', function( event ) {
			if ( 13 === event.keyCode ) {
				window.location.replace( bpca_script.site_url + '/?s=' + encodeURIComponent( $input.attr( 'value' ) ) );
			}
		});
	};

	bpca_script.get_query_string_value = function( name ) {
		name = name.replace( /[\[]/, "\\[" ).replace( /[\]]/, "\\]" );

		var regex   = new RegExp( "[\\?&]" + name + "=([^&#]*)" ),
		    results = regex.exec(location.search);

		return results === null ? "" : decodeURIComponent( results[1].replace( /\+/g, " " ) );
	};

	bpca_script.pagination = function() {
		var $paged = $( '#paged' );

		$paged.on( 'keydown', function( event ) {
			console.log(event.keyCode)
			if (
				event.keyCode !== 46 && event.keyCode !== 8 &&
				( parseInt( event.keyCode ) < 48 || parseInt( event.keyCode ) > 57 )
			) {
				event.preventDefault();
			}

			if ( event.keyCode === 13 ) {
				window.location.replace( bpca_script.site_url + '/page/' + $paged.attr( 'value' ) +  '?s=' + encodeURIComponent( $( 'input[name="s"]' ).attr( 'value' ) ) );
			}
		});
	}

	bpca_script.alerts = function() {
		$(".mc4wp-form").addClass("downloadform");

		var $input = $( "#RFP-BID" );

		bpca_script.alerts_toggle( $input );

		$input.change(function() {
			bpca_script.alerts_toggle( $input );
		});
	};

	bpca_script.alerts_toggle = function( input ) {		
		if( input.is(':checked') ) {
			$( ".sub-tags input" ).prop( 'disabled', false );
			$( ".sub-tags li" ).removeClass( 'disabled' );
		} else {
			$( ".sub-tags input" ).prop( 'disabled', true );
			$( ".sub-tags input" ).prop( 'checked', false );
			$( ".sub-tags li" ).addClass( 'disabled' );
		}
	};

	$( function() {
		bpca_script.init();
	} );


	$(document).ready(function(){
		$('.gfield_checkbox input[type="checkbox"]').wrap('<div class="checker"></div>').after('<div class="checkcheck"></div>');
        
    
	});
    
    
})( jQuery );

/*
This was already commented out.  Leaving it here in case it's important.
$("li.menu-item").addClass('off');
$(".sub-menu").hide();
$(".current_page_item .sub-menu").show();
$("li.menu-item.menu-item-type-custom").click(function (event) { // mouse CLICK instead of hover
// Only prevent the click on the topmost buttons
//if ($('.sub-menu', this).length >=1) {
	//event.preventDefault();
	//}
	$(".sub-menu").hide(); // First hide any open menu items
	$(this).find(".sub-menu").show(); // display child
	if ($("li.menu-item.menu-item-type-custom").hasClass('off')) {
		$("li.menu-item.menu-item-type-custom").removeClass('on'); // remove previous on link
		$(this).removeClass('off');
		$(this).addClass('on');
	}
	//event.stopPropagation();
	//$(this).off('mouselevea mounseover');
});
*/