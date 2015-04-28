// accordion toggles
var year="All",category="All";
jQuery(document).ready(function (jQuery) {
    // jQuery('.acctoggle').on("click", function(){
    	// if (jQuery(this).nextAll('.accordion-child').hasClass('opened')) {
    		// jQuery('.accordion-child').removeClass('opened');
    	// } else {
    		// jQuery('.accordion.two .accordion-child').slideUp();
           
		   // jQuery("input[type='checkbox']").attr('checked', false);  
    		// jQuery('.accordion-child').removeClass('opened');
    	// }	
	       // jQuery(this).nextAll('.accordion-child').first().slideToggle();
	       // jQuery(this).nextAll('.accordion-child').first().addClass('opened');
    // })
	
jQuery('.accor_title').die('click').live('click',function(){
  jQuery(this).parent().find('.accor_list').slideToggle();
  if(jQuery(this).parent().find('.accor_list').hasClass('opened')){
    jQuery(this).parent().find('.accor_list').removeClass('opened');
    jQuery(this).parent().find('i:first').removeClass('fa-angle-right fa-angle-down').addClass('fa-angle-right');
  }else{
    jQuery(this).parent().find('.accor_list').addClass('opened');
    jQuery(this).parent().find('i:first').removeClass('fa-angle-right fa-angle-down').addClass('fa-angle-down');
  }
})

jQuery('.acctoggle').die('click').live('click',function(){
  var sel=jQuery(this),
  acc_val=jQuery(this).text();
  jQuery(this).parents(".content-wrapper").find('.accor_title span').html(acc_val);
  jQuery(this).parents(".content-wrapper").find('.accor_title span').addClass('activeted');
  jQuery(this).parents(".content-wrapper").find('.accor_list').slideUp();
  // console.log(jQuery(this).parents(".content-wrapper"));
  if(jQuery(this).parents(".content-wrapper").find('.accor_list').hasClass('first')){
    // console.log(111);
	year = jQuery(this).text();
    jQuery('.accor_list.second').parent().find('.accor_title span').html('CATEGORY');
    jQuery('.accor_list.second').parent().find('.accor_list').slideUp(function(){
      if(year=="All"){show_all_category(); }
		else{
			jQuery('.accor_list.second').html('<div class="accordion two show all"><h4 class="acctoggle">All</h4></div>').append(sel.parent().find('.accordion-child:first> *').clone()); 
    	}
	  
	});
    
    
    // jQuery('.accor_list.third').hide();
  } else  if(jQuery(this).parents(".content-wrapper").find('.accor_list').hasClass('second')){
		category = jQuery(this).text();
	}	
	jQuery(this).parents('.accor_list').parent().find('.accor_list').removeClass('opened');
	jQuery(this).parents('.accor_list').parent().find('i:first').removeClass('fa-angle-right fa-angle-down').addClass('fa-angle-right');
   
  show_result();
  
})

// show_result();
show_all_category();

});
function show_result(){
	console.log(year,category);
		res_list= "";
		jQuery('.accor_list.first .accordion.one').each(function(){
		  var curr_year =jQuery(this).find('> .acctoggle').text();
		  
		  if(year=="All" || year==curr_year){
		   
			jQuery(this).find('> .accordion-child .accordion.two.show').each(function(){
			  var curr_category = jQuery(this).find('> .acctoggle').text();
			  // console.log(curr_category);
			   if(category=="All" || category==curr_category){
				 jQuery(this).find('form li').each(function(){
				 res_list += '<li>'+jQuery(this).html()+'</li>';
				 })
				 
			   }
			})
		  }
		})

		
		// jQuery('.accor_list.third').html(sel.parent().find('.accordion-child:first> form').clone());	
		jQuery('.accor_list.third').html('<form method="post" class="downloadform" name="downloadform">\
												<ul id="all-files-11">'+res_list+'   \
													<input type="hidden" value="1" name="down-files">\
													<input type="hidden" id="current_page11">\
													<input type="hidden" id="show_per_page11">\
												</ul>\
											</form>\
											<div class="download-link-area unclickable">\
												<a class="download-items">\
													<i class="fa fa-share-square-o"></i>Download\
												</a>\
												<a class="forward-to-friends">\
												<i class="fa fa-envelope-o"></i>Forward to Friends\
												</a>\
											</div><div id="filepages11"></div>');
		jQuery('.accor_list.third').slideDown();
		
		jQuery('.accor_list.third li').each(function(){
			var selec= jQuery(this);
			  jQuery(this).find('.checker input').attr('id',selec.find('.checker input').attr('id')+"_");
			  jQuery(this).find(' label').attr('for',selec.find('label').attr('for')+"_");
		})
		setPagination(11);
}
function show_all_category(){
	jQuery('.accor_list.second').html('<div class="accordion two show all"><h4 class="acctoggle">All</h4></div>').append(jQuery('.accor_list.first').parent().find('.accordion-child:first> *').clone()); 
	if(year=="All"){jQuery('.accor_list.second .accordion').addClass('show'); }
}


function setPagination(pagenumber) {
    //how much items per page to show  
    var show_per_page = 15;  
    //getting the amount of elements inside content div  
    var number_of_items = jQuery('#all-files-' + pagenumber+' li').size();  
	console.log(number_of_pages);
		//calculate the number of pages we are going to have  
		var number_of_pages = Math.ceil(number_of_items/show_per_page);  
	  
    if(number_of_pages>1){
		//set the value of our hidden input fields  
		jQuery('#current_page' + pagenumber).val(0);  
		jQuery('#show_per_page' + pagenumber).val(show_per_page);  
	  
		//now when we got all we need for the navigation let's make it '  
	  
		/* 
		what are we going to have in the navigation? 
			- link to previous page 
			- links to specific pages 
			- link to next page 
		*/  
		var navigation_html = '<a class="previous_link" href="javascript:previous(' + pagenumber + ');"><i class="fa fa-angle-left"></i></a>&nbsp;&nbsp;&nbsp;';
		var go_to_page_last= number_of_pages-1;
		navigation_html +='<span class="curr_ind"><a href="javascript:go_to_page(0,' + pagenumber + ')" longdesc="0">1</a></span> of '+'<a href="javascript:go_to_page(' + go_to_page_last +',' + pagenumber + ')" longdesc="' + go_to_page_last +'">'+number_of_pages+' ';
		navigation_html += '&nbsp;&nbsp;<a class="next_link" href="javascript:next(' + pagenumber + ');"><i class="fa fa-angle-right"></i></a>';
	  
		var current_link = 0;  
		while(number_of_pages > current_link){  
			navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +',' + pagenumber + ')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>&nbsp;&nbsp;&nbsp;';  
			current_link++;  
		}
		
		jQuery('#filepages' + pagenumber).html(navigation_html);  
	  
		//add active_page class to the first page link  
		jQuery('#filepages' + pagenumber + ' .page_link:first').addClass('active_page');  
	  
		//hide all the elements inside content div  
		jQuery('#all-files-' + pagenumber).children().css('display', 'none');  
	  
		//and show the first n (show_per_page) elements  
		jQuery('#all-files-' + pagenumber).children().slice(0, show_per_page).css('display', 'block');
	}
}

function previous(pagenumber){  
  
    new_page = parseInt(jQuery('#current_page' + pagenumber).val()) - 1;
    //console.log(new_page);
    //if there is an item before the current active link run the function 
    if(jQuery('.active_page').prev('.page_link').length > 0){  
        go_to_page(new_page, pagenumber);  
    } 
  
}  
  
function next(pagenumber){  
    new_page = parseInt(jQuery('#current_page' + pagenumber).val()) + 1; 
    //console.log(new_page);
    //if there is an item after the current active link run the function
    //go_to_page(new_page, pagenumber); 
    
    if(jQuery('.active_page').next('.page_link').length > 0){ 
       // console.log('clicked');
        go_to_page(new_page, pagenumber);  
    } 
        
  
}  
function go_to_page(page_num, pagenumber){  
	console.log(page_num);
	var go_to_page_n= page_num+1;
	jQuery('.curr_ind').html('<a  href="javascript:go_to_page(' + page_num +',' + pagenumber + ')" longdesc="' + page_num +'">'+go_to_page_n+'</a>');
    //get the number of items shown per page  
    var show_per_page = parseInt(jQuery('#show_per_page' + pagenumber).val());  
  
    //get the element number where to start the slice from  
    start_from = page_num * show_per_page;  
  
    //get the element number where to end the slice  
    end_on = start_from + show_per_page;  
  
    //hide all children elements of content div, get specific items and show them  
    jQuery('#all-files-' + pagenumber).children().css('display', 'none').slice(start_from, end_on).css('display', 'block');  
  
    /*get the page link that has longdesc attribute of the current page and add active_page class to it 
    and remove that class from previously active page link*/  
    jQuery('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  
    //update the current page input field  
    jQuery('#current_page' + pagenumber).val(page_num);  
	goToByScroll('public_info_anchor');
} 


function goToByScroll(id){
      // Remove "link" from the ID
    id = id.replace("link", "");
      // Scroll
    jQuery('html,body').animate({
        scrollTop: jQuery("#"+id).offset().top},
        0);
}