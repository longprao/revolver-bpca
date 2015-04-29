<?php

/**
* Template Name: Quote Page
*
*/


/*
if (array_key_exists('down-files', $_POST)) {
    // download each file selected
    # create new zip opbject
    $zip = new ZipArchive();

    # create a temp file & open it
    $tmp_file = tempnam('.','');
    $zip->open($tmp_file, ZipArchive::CREATE);

    # loop through each file
    foreach($_POST['downlink'] as $file){

        # download file
        $download_file = file_get_contents($file);

        #add it to the zip
        $zip->addFromString(basename($file),$download_file);

    }

    # close zip
    $zip->close();

    # send the file to the browser as a download
    header('Content-disposition: attachment; filename=bpcarfpfiles.zip');
    header('Content-type: application/octet-stream');
    readfile($tmp_file);
}
*/
?>

<?php get_header(); ?>

			<?php if ( !is_front_page() ) : ?>
      <?php if(function_exists('bcn_display')): ?>
      <div class="breadcrumb wrapper">
				<p><?php bcn_display(); ?></p>
			</div>
      <?php endif; ?>
			<?php endif; ?>

			<div class="wrapper">
            	<div class="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <div class="row header">
                <div class="col-md-4 col">
                  <div class="content header-content header-content-fixed <?= get_field('quote_box_color') ?>">
                    <h1><?= get_field('quote') ?></h1>
                    <h3><?= get_field('quote_by') ?></h3>
                    <h5><?= get_field('quote_title_1') ?></h5>
                    <h5><?= get_field('quote_title_2') ?></h5>
                  </div>
                </div>
                <div class="col-md-8 col">
                  <?= post_image(get_the_id()) ?>
                </div>
              </div>

                	<?php the_content(); ?>
<?php endwhile; endif; ?>
                
<?php if(is_page('Public Information')): ?>
                <div id="gallery" class="row">
                    <div class="archive-tab-content" id="archive-cont-2">
                    <div class="photo-container">
                    <div id="slider" class="flexslider2">
                        <ul class="archive-slides">
                            <?php
                            $imagedata = array();
                            $first = true;
                        // show downloadable press photos
                        $args = array( 'post_type' => 'archivephoto',
                               'posts_per_page' => -1,
                               'meta_key' => 'photo_order', 
                               'orderby' => 'meta_value_num', 
                               'order' => 'ASC'
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        // save the image data and build the slides
                        $thisdata = new stdClass();
                        $thisdata->img = get_the_post_thumbnail($post->ID, 'gallery-image');
                        $thisdata->imglink = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                        $thisdata->caption = get_the_title();
                        $thisdata->descr = get_the_content();

                        if ($first) {
                            $thiscaption = $thisdata->caption;
                            $thisdescr = $thisdata->descr;
                            $first = false;
                        }
                        array_push($imagedata, $thisdata);
                        echo '<li>';
                        the_post_thumbnail('gallery-image');
                        //echo '<img src="' . get_the_guid() . '" />';
                        echo '</li>';
                        endwhile;
                    ?>
                        </ul>
                      </div>

                        <div class="prev-slide"><i class="fa fa-angle-left"></i></div>
                        <div class="next-slide"><i class="fa fa-angle-right"></i></div>
                    </div>

                    <div class="photo-caption-container">
                      <div class="slides-counter"><span class="current-slide">1</span> of <span class="total-slides"></span></div>
                        <div class="photo-caption-text">
                            <?php echo "<strong>" . $thiscaption . "</strong>";?>
                             <?php echo "<br />" . $thisdescr;?>
                        </div>
                        <div class="archive-share-buttons">

                          <a href="<?php echo $imagedata[0]->imglink;?>" download="<?php echo basename($imagedata[0]->imglink);?>"><div class="social-icon"><i class="fa fa-share-square-o"></i></div><div class="share-text-black">Download</div></a><br />
                          <a target="_blank" href="mailto:?subject=<?php echo $thiscaption;?>&amp;body=<?php echo $imagedata[0]->imglink;?>" class="share-email">
         <div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-black">Forward to Friends</div></a><br />
         <a target="_blank" href="http://twitter.com/share?text=<?php echo $thiscaption;?>&url=<?php echo $imagedata[0]->imglink;?>">
         <div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-black">Share on Twitter</div>
         </a><br />
                            <a target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?u='<?php echo $imagedata[0]->imglink; ?>">
                                <div class="social-icon"><i class="fa fa-facebook"></i></div>
                                <div class="share-text-black">Share on Facebook</div>
                            </a><br/>
         
                        </div>
                        <iframe id="downframe" style="display:none"></iframe>
                    </div>
                    <div class="photo-nav-container">
                    <div id="carousel" class="flexslider3">
                            <ul class="archive-slides">
                             <?php
                             foreach ($imagedata as $imginfo)
                             {
                                echo '<li>';
                                echo $imginfo->img;
                                //echo '<img src="' . $imginfo . '" />';
                                echo '<input type="hidden" id="caption-title" value="' . $imginfo->caption . '" />';
                                echo '<input type="hidden" id="caption-descr" value="' . $imginfo->descr . '" />';
                                echo '</li>'; 
                             }
                             ?>
                              <!-- items mirrored twice, total of 12 -->
                            </ul>
                          </div>
                </div><!-- photo-nav-container -->
                </div> <!-- #archive-cont-2 -->
                </div>
                

<script type="text/javascript">
    // image slider

jQuery('.teaser-events').parent().before(jQuery('#gallery'));

  jQuery('#carousel').flexslider({
    namespace: "archive-",
    selector: ".archive-slides > li",
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 100,
    itemMargin: 0,
    move: 7,
    startAt: 0,
    prevText: '&nbsp;',
    nextText: '&nbsp;',
    asNavFor: "#slider",
    minItems: 1
  });
   
  jQuery('#slider').flexslider({
    namespace: "archive-",
    selector: ".archive-slides > li",
    animation: "fade",
    controlNav: false,
    directionNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 800,
    animationSpeed: 0,
    itemMargin: 0,
    sync: "#carousel",
    minItems: 1,
    maxItems: 1,
    start: function(slider) {
      jQuery('.next-slide').click(function(event){
          event.preventDefault();
          slider.flexAnimate(slider.getTarget("next"));
      });
      jQuery('.prev-slide').click(function(event){
          event.preventDefault();
          slider.flexAnimate(slider.getTarget("prev"));
      });
      jQuery('.total-slides').text(slider.count);
    },
    before: function(slider) {
      update_carousel(slider.animatingTo);
      jQuery('.current-slide').text(slider.animatingTo+1);
    }
  });

  update_carousel = function(slide_number){
    jQuery('#carousel .archive-slides li:nth-of-type('+(slide_number+1)+')').click();
  }
  
  //fixFlexsliderHeight();

jQuery('.archive-slides li').click(function (){
    // retrieve the caption information
    setTimeout(function () {
        var captiontitle = jQuery('.archive-active-slide #caption-title').val();
        jQuery('.photo-caption-text').html(captiontitle);

        // share buttons
        var imgsrc = jQuery('.archive-active-slide img').attr('src');
        var filename = imgsrc.substring(imgsrc.lastIndexOf('/')+1);

//        var sharebtns = '<a href="#" onclick="javascript:downloadfile(\'' + imgsrc + '\');"><div class="social-icon"><i class="fa fa-share-square-o"></i></div><div class="share-text-black">Download</div></a><br />';
        var sharebtns = '<a href="' + imgsrc + '" download="' + filename + '"><div class="social-icon"><i class="fa fa-share-square-o"></i></div><div class="share-text-black">Download</div></a><br />';
        sharebtns += '<a target="_blank" href="mailto:?subject=' + captiontitle + '&amp;body=' + captiontitle + '%20-%20' + imgsrc + '" class="share-email">';
        sharebtns += '<div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-black">Forward to Friends</div></a><br />';
        sharebtns += '<a target="_blank" href="http://twitter.com/share?text=' + captiontitle + '&url=' + imgsrc + '">';
        sharebtns += '<div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-black">Share on Twitter</div>';
        sharebtns += '</a><br />';
        sharebtns += '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' + imgsrc + '">';
        sharebtns += '<div class="social-icon"><i class="fa fa-facebook"></i></div><div class="share-text-black">Share on Facebook</div>';
        sharebtns += '</a><br />';
        jQuery('.archive-share-buttons').html(sharebtns); 
        }, 10);
});

// for downloading archive photos
function downloadfile(path) {
     var ifrm = document.getElementById('downframe');
     ifrm.src = "<?php echo get_template_directory_uri(); ?>/download.php?path="+path;
}
</script>

<?php endif; ?>

                </div>

                <div class="clear"></div>
      </div>
<?php get_footer(); ?>
