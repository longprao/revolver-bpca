// accordion toggles
jQuery(document).ready(function ($) {
    $('.acctoggle').on("click", function(){
    	if ($(this).nextAll('.accordion-child').hasClass('opened')) {
    		$('.accordion-child').removeClass('opened');
    	} else {
    		$('.accordion.two .accordion-child').slideUp();
            //Ucheck boxes on accordion close
            $("input[type='checkbox']").attr('checked', false);  
    		$('.accordion-child').removeClass('opened');
    	}	
	       $(this).nextAll('.accordion-child').first().slideToggle();
	       $(this).nextAll('.accordion-child').first().addClass('opened');
    })
  
});

/*
// accordion toggles
jQuery(document).ready(function ($) {
    $('.accordion.one > .acctoggle').on("click", function(){
    	if ($(this).nextAll('.accordion-child').hasClass('opened')) {
    		$('.accordion-child').removeClass('opened');
    	} else {
    		$('.accordion.one > .accordion-child').slideUp();
    		$('.accordion-child').removeClass('opened');
    	}	
	       $(this).nextAll('.accordion-child').first().slideToggle();
	       $(this).nextAll('.accordion-child').first().addClass('opened');
    })
  
});
*/
