// wait for document to load before running script

var filter_date;

jQuery(document).ready(function ($) {

  //hide this
  $('.building-loading').hide();

  var params = $.deparam.querystring();

  var select_grid_item = function(id){
    if(id){ jQuery(".grid-button[data-id='" + id + "']:visible").click(); }
  };


  var set_checked = function(tags){
    if(tags){
      jQuery.each(tags, function(i, tag){
        jQuery('.filter-values').each(function(){
          $el = jQuery(this);
          if($el.val() === tag){
            $el.attr('checked', true);
          }
        });
      });
    }
  };
  

  var get_checked = function(){
    var checked = [];
    jQuery('.filter-values:checked').each(function(){
      checked.push(jQuery(this).val());
    });
    return checked;
  };

  set_checked(params.tags);
  select_grid_item(params.selected_id);

  var add_click_handlers = function(){
    $('.calendar td').click(function(){
      var $date = $(this);
      var day = $date.attr('date-day');
      var month = $date.attr('date-month');
      var year = $date.attr('date-year');
      filter_date = month + '-' + day + '-' + year;
      jQuery('.current-day').removeClass('current-day');
      $date.addClass('current-day');
    });
  };

  //Add filter change event
  $(".post-filter input[type='checkbox']").on('click', function() {
    var ischecked = !$(this).is(":checked");
    //uncheck the other boxes
    $("input[type='checkbox']").attr('checked', false);   

    //check this box 
    if (ischecked){
      $(this).attr('checked', false);
    } else {
      $(this).attr('checked', true);
    }

    //Submit and reload
    var checked = get_checked();
    var queryParams = {tags: checked, date: filter_date};
    $('.building-loading').show();
    location.href = get_url()+'?' + decodeURI(jQuery.param(queryParams));
      
  });

  //Add calendar filter change event
  $(".event-calendar").on('click', function() {
    //Submit and reload
    var checked = get_checked();
    var queryParams = {tags: checked, date: filter_date};
    $('.building-loading').show();
    location.href = get_url()+'?' + decodeURI(jQuery.param(queryParams));
      
  });


  calendar.init(params.date);

  add_click_handlers();

  $('.btn-prev').on('click', function(e) {
    e.preventDefault();
    add_click_handlers();

  });

  $('.btn-next').on('click', function(e) {
    e.preventDefault();
    add_click_handlers();

  });

  $('.checker').live('click', function(e) {
      if ( $(this).parent().hasClass('checked') ) {
            
            $(this).parent().removeClass('checked');
            if ( $(this).parent().siblings().hasClass('checked') ) {
                $(this).closest('.downloadform').nextAll('.download-link-area').removeClass('unclickable');
            } else {
                $(this).closest('.downloadform').nextAll('.download-link-area').addClass('unclickable');
            }
          
      } else {
          $(this).parent().addClass('checked');
          $(this).closest('.downloadform').nextAll('.download-link-area').removeClass('unclickable');
      }
  });

/*
$('html, body').animate({
    scrollTop: $(".validation_error").offset().top
}, 1000);
*/
/*
   // RFP FORM Actions
   $("#gform_1").submit(function(event) {
       //Add validation before submit

       //if validation passes show downloads
       $('.hidelayer').hide();
        
       //return false;
    });


   $("#gform_1").bind('ajax:complete', function() {

         // tasks to do 
        $('.hidelayer').hide();

   });
*/
 if( $('#gform_confirmation_wrapper_1').length )
  {
       // it exists
       $('.hidelayer').hide();
       $('.hideuntilsubmit').addClass('showlayer');
	   jQuery('#gform_fields_1 input').val('');
		jQuery('#gform_1 .gform_title').after(jQuery('.form_success_message'));
  }

  $(".accordion-child > .downloadform ul li").closest('.accordion').addClass('show');

	var message_error=jQuery('#input_1_6').parent().next().text();
	console.log("1",message_error);
	if(message_error=="Please put a valid Email"){
		jQuery('.error_msg_form').append('<span class="error_email">Please enter a valid email address.</span>')
	}




 

});
function get_url(){
var protocol =document.location.protocol,
   host =document.location.host,
pathname=document.location.pathname;
pathname_arr =pathname.split("page/");
pathname = pathname_arr[0];
url= protocol+host+pathname;
return url;
}