// wait for document to load before running script



jQuery(document).ready(function ($) {


  $('.download-link-area:last').show();

  $('.download-items').live("click",function(e){

    
    e.preventDefault();
    if (  $(this).parent().hasClass('unclickable')  ) {
        // Sned a message tellign the user to select something

    } else {
        //remove any previously added hidden fields
        $('.file-list-remove').remove();

        var checked = [];
        jQuery('.downloadable-items:checked').each(function(){
          var checked_val = jQuery(this).val();
          jQuery('.downloadform').each(function(){
            jQuery(this).append('<input type="hidden" name="file-list[]" class="file-list-remove" value="' + checked_val + '"/>');
          });
      jQuery(this).click(); 

        });

        $('[name=downloadform]').submit();
    }
   

/*
    e.preventDefault();
    //remove any previously added hidden fields
    $('.file-list-remove').remove();

    var checked = [];
    jQuery('.downloadable-items:checked').each(function(){
      var checked_val = jQuery(this).val();
      jQuery('.downloadform').each(function(){
        jQuery(this).append('<input type="hidden" name="file-list[]" class="file-list-remove" value="' + checked_val + '"/>');
      });

    });

    $('[name=downloadform]').submit();
*/

    
  });

  $('.forward-to-friends').live('click',function(e){
    e.preventDefault();
    if (  $(this).parent().hasClass('unclickable')  ) {
        // Sned a message tellign the user to select something

    } else {
          var checked = [];

          var mailto = '';
          jQuery('.downloadable-items:checked').each(function(){
            var checked_val = jQuery(this).val();

            var found = jQuery.inArray(checked_val, checked);
            if (found == -1) {
              checked.push(checked_val);
              mailto += checked_val + '                         ';
            }
      jQuery(this).click(); 

          });
         // var href = '<a style="<!--visibility: hidden;-->" class="mailto-link" href="mailto:?subject=Check out these links on the BPCA website&body=' +  encodeURIComponent(mailto) + '">click</a>';

         // var el = jQuery(href).appendTo('.download-link-area').last().click();
          window.location = "mailto:?subject=Check out these links on the BPCA website&body='" +  encodeURIComponent(mailto) + "'";
    }


  });


});
