// wait for document to load before running script
jQuery(document).ready(function ($) {
    // cache some variables
    var $grid = $('.grid');

	var active_grid_items = {};

	count = 1;
	
	$grid.each(function() {
		$(this).data( 'count', count );
		$(this).addClass( 'number_' + count );
		count++;
	})

    // setup click action on .grid-button element
    $grid.on('click', function () {
        
		var grid_number = $(this).data('count');

        // define some variables
        var $target = jQuery(this).find('.grid-description').parent().nextAll('.grid-alt:first');
        // copy description and append it to container
        var $content = jQuery(this).find('.grid-description').html();

        $(this).nextAll('.grid-alt:first').slideUp(300);

        // if a user clicks on the same active .grid element
        if ( $(this).hasClass('active') ) {
            // hide any open descriptions
            $(this).nextAll('.grid-alt:first').slideUp(300).promise().done(function(){
                // remove any active classes
                $(this).prevAll('.active:first').removeClass('active');
                //$(this).prevAll('.imgactive:first').removeClass('imgactive');
            });

        // if this is the initial click
        } else if ( ! $grid.hasClass( 'active' ) ) {
            // add the active class to the current element
            jQuery(this).addClass('active');
            //jQuery(this).addClass('imgactive');
            // add content to section
            setTimeout(function(){
				$target.data('grid_number', grid_number);
                $target.html($content).slideDown(300);
            }, 100);

        // if the users clicks a second, different .grid element
        } else {
            var $new = jQuery(this);
            // remove any active classes
            var $old = jQuery('.active');
			
            //var count = jQuery.inArray(jQuery(this).offset().top, rows);
            //console.log (parseInt(count));

			if ( $target.is(':visible') ) {
				$( '.number_' + $target.data('grid_number') ).removeClass('active');
			}


            setTimeout(function(){
                // show new content
                $target.html($content).slideDown(300);
				$target.data('grid_number', grid_number);
                // switch the active class to the current element
                $new.addClass('active');
				//$old.removeClass('active');
                //jQuery('html, body').animate({scrollTop: jQuery(".active").offset().top - 40}, 200);
            }, 300);    

        }
    });

    jQuery('.filter .grid-info-tags li span').on('click', function(){
      jQuery(this).prev().prev().click();
    });

    jQuery('.building-filter input[type=checkbox]').change(function(){

      var checked = [];

      // build an array of selected filters
      jQuery('.filter :checked').each(function(){
        checked.push( '.' + jQuery(this).val() );
      });

      if(checked.length){
        // hide everything to start out
        var grids = jQuery('.grid').hide();
        // loop through to find elements with all of the selected filters
        jQuery(checked).each( function(){
          grids = grids.has(this);
        });
        grids.show();

      }else{
        // show everything
        jQuery('.grid').show();
      }

    });

});
