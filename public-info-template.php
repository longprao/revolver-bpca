<?php

/**
* Template Name: Public Information Template from other site
* 
*/



	ob_start();
    // download each file selected
    // only zip up the files if there is more than one
 if (array_key_exists('down-files', $_POST)) {
    // download each file selected
    # create new zip opbject
if(count($_POST['downlink'])>1)
{
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
	else
	{

	$file=$_POST['downlink'][0];

	echo '<script type="text/javascript" language="Javascript">window.open("'.$file.'");</script>';
	}

}

// what page did the user come from to see more?
if (array_key_exists('id', $_GET)) {
    $thisslug = $_GET['id'];
}
get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/public_info.css?ver=1.8" media="all">
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <?php if(function_exists('bcn_display') && !is_home())
                {
                    bcn_display();
                }?>
        </div>
        <?php
                $page_data = get_page(get_the_ID());
                $fulldescrtext = apply_filters('the_content', $page_data->post_content);
        ?>
        <div class="section-title">
                <?php echo strtoupper(get_field('archive_section_1'));?>
        </div>
        <div class="page-descr-container rfp">
            <div class="descr-text-box one-column">
                <span class="email-black"> <?php echo $fulldescrtext;?></span>
            </div>
        </div>
        <div class="foil-container">
            <div class="foil-title">
                <?php the_field('archive_foil_title'); ?>
            </div>
            <div class="foil-descr">
                <?php the_field('archive_foil_text'); ?>
            </div>
        </div>
        <div class="download-area-archive">
            <form method="POST" name="downloadform" id="downloadform">
                <div class="checker">
                    <span class="">

                <input type="checkbox" id="link1" name="downlink[]" value="<?php the_field('archive_foil_file');?>" />
                    </span>
                </div>
                <div class="styled-checks">
                <label for="link1"><?php the_field('archive_foil_file_name');?></label>
                </div>
            </form>
            <br />
            <div class="foil-down">
            <a href="#" onclick="printChecked()"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
            <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
            <!--<a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>-->
            </div>
        </div>
            <div class="section-title">
                <?php echo strtoupper(get_field('archive_section_2'));?>
            </div>
            <div id="tab-container-archive">
                <ul class="archive-tabs main-tabs">
                    <li class="archive-tab active" id="archive-tab1">
                        <a href="#archive-cont-1">
                            <div class="archive-text">
                            PDFs
                            </div>
                        </a>
                    </li>
                    <li class="archive-tab" id="archive-tab2">
                        <a href="#archive-cont-2">
                             <div class="archive-text">PHOTOS
                             </div>
                        </a>
                    </li>
                </ul>
                <div class="archive-tab-content" id="archive-cont-1">
                    <form name="downloadform2" id="downloadform2" method='post'>
                    <div id="tab-container-pub-info">
                        <?php
                            // grab 10 years to build the year tabs
                            $alldates = array(); // holds every date to use
                            $thisyear = date('Y');
                            array_push($alldates, $thisyear);
                            $styear1 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -1 year");
                            $year1 = date('Y', $styear1);
                            array_push($alldates, $year1);
                            $styear2 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -2 years");
                            $year2 = date('Y', $styear2);
                            array_push($alldates, $year2);
                            $styear3 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -3 years");
                            $year3 = date('Y', $styear3);
                            array_push($alldates, $year3);
                            $styear4 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -4 years");
                            $year4 = date('Y', $styear4);
                            array_push($alldates, $year4);
                            $styear5 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -5 years");
                            $year5 = date('Y', $styear5);
                            array_push($alldates, $year5);
                            $styear6 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -6 years");
                            $year6 = date('Y', $styear6);
                            array_push($alldates, $year6);
                            $styear7 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -7 years");
                            $year7 = date('Y', $styear7);
                            array_push($alldates, $year7);
                            $styear8 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -8 years");
                            $year8 = date('Y', $styear8);
                            array_push($alldates, $year8);
                            $styear9 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -9 years");
                            $year9 = date('Y', $styear9);
                            array_push($alldates, $year9);
                            $styear10 = strtotime(date("Y-m-d", strtotime($thisyear)) . " -10 years");
                            $year10 = date('Y', $styear10);
                            array_push($alldates, $year10);
                        ?>
                        <ul class="archive-tabs vertical-tabs">
                            <li class="archive-vertical-tab" id="pub-info-tab-1">
                                <a href="#pub-info-cont-1">ALL</a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-2">
                                <a href="#pub-info-cont-2"><?php echo $thisyear;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-3">
                                <a href="#pub-info-cont-3"><?php echo $year1;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-4">
                                <a href="#pub-info-cont-4"><?php echo $year2;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-5">
                                <a href="#pub-info-cont-5"><?php echo $year3;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-6">
                                <a href="#pub-info-cont-6"><?php echo $year4;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-7">
                                <a href="#pub-info-cont-7"><?php echo $year5;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-8">
                                <a href="#pub-info-cont-8"><?php echo $year6;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-9">
                                <a href="#pub-info-cont-9"><?php echo $year7;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-10">
                                <a href="#pub-info-cont-10"><?php echo $year8;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-11">
                                <a href="#pub-info-cont-11"><?php echo $year9;?></a>
                            </li>
                            <li class="archive-vertical-tab" id="pub-info-tab-12">
                                <a href="#pub-info-cont-12"><?php echo $year10;?></a>
                            </li>
                        </ul>
                        <?php
                            // grab all of the attachment categories to fill in those tabs for each year + all
                            $taxonomy = 'attachment_category';
                            $tax_terms = get_terms($taxonomy);
                            $allcats = array();
                            foreach($tax_terms as $tax_term) {
                                if ($tax_term->slug != "homepage-fullwidth" && $tax_term->slug != "homepage-800" && $tax_term->slug != "press-photos" && $tax_term->slug != "homepage-mobile" && $tax_term->slug != "homepage-800-mobile") {
                                       array_push($allcats, $tax_term->slug);
                                }
                            }
                            // call the function to grab all of the archival data
                            $archivedata = getArchiveData($allcats, $alldates);
                            $pageddivs = array(); // holds the divs that need to have pagination added to them
                            // 12 tabs all together
                            for ($i = 1; $i <= 12; $i++)
                            {
                        ?>
                               <div class="archive-side-content" id="pub-info-cont-<?php echo $i;?>">
                                   <div id="tab-container-pub-info-<?php echo $i?>">
                                        <ul class="archive-tabs vertical-tabs">
                                           <li class="archive-vertical-tab mobile" id="pub-info-<?php echo $i;?>-tab-1">
                                                <a href="#pub-info-<?php echo $i;?>-cont-1">ALL</a>
                                           </li> 
                        <?php
                                        // loop through the categories and build the tabs for those
                                        // tab count will start at 2
                                        $tabcount = 1;
                                        $slugorder = array(); // tracks the order of the categories for use when adding files to tabs
                                        foreach($tax_terms as $tax_term) {
                                                if ($tax_term->slug != "homepage-fullwidth" && $tax_term->slug != "homepage-800" && $tax_term->slug != "press-photos" && $tax_term->slug != "homepage-mobile" && $tax_term->slug != "homepage-800-mobile") {
                                                $tabcount++;
                                                echo '<li class="archive-vertical-tab mobile" id="pub-info-' . $i . '-tab-' . $tabcount . '">';
                                                echo '  <a href="#pub-info-' . $i . '-cont-' . $tabcount . '">';
                                                echo $tax_term->name;
                                                echo '  </a>';
                                                echo '</li>';
                                                $slugorder[$tabcount] = $tax_term->slug;
                                            }
                                        }
                        ?>
                                        </ul>
                        <?php
                                        // create content divs based on the total number of tabs
                                        $MAX_ITEMS = 20; // maximum number of items per page
                                        for ($j = 1; $j<= $tabcount; $j++) {
                                            echo '<div class="archive-side-content all-files" id="pub-info-' . $i . '-cont-' . $j . '">';
                                            echo '<ul id="all-files-' . $i . $j . '">';
                                            $thisindex = 0;
                                            if ($i == 1) {
                                                // this is the all section, every file needs to be categorized regardless of year
                                                if ($j == 1) {
                                                    // show all files
                                                    foreach ($archivedata as $thisdata) {
                                                        foreach ($thisdata as $catdata) {
                                                            foreach ($catdata as $info) {
                                                                echo '<li>';
                                                                echo '<div class="checker">';
                                                                echo '<span class="">';
                                                                echo '<input type="checkbox" id="link' . $i . $j . $thisindex . '" name="downlink[]" value="' . $info->url . '" />';
                                                                echo '</span>';
                                                                echo '</div>';
                                                                echo '<div class="styled-checks">';
                                                                echo '<label for="link' . $i . $j . $thisindex . '">' . $info->title . '</label>';
                                                                echo '</div>';
                                                                echo '</li>';
                                                                $thisindex++; 
                                                            }
                                                 
                                                        }
                                                    }
                                                } else {
                                                    foreach ($archivedata as $thisdata) {
                                                        $thiscat = $thisdata[$slugorder[$j]];
                                                        foreach ($thiscat as $info) {
                                                                echo '<li>';
                                                                echo '<div class="checker">';
                                                                echo '<span class="">';
                                                                echo '<input type="checkbox" id="link' . $i . $j . $thisindex . '" name="downlink[]" value="' . $info->url . '" />';
                                                                echo '</span>';
                                                                echo '</div>';
                                                                echo '<div class="styled-checks">';
                                                                echo '<label for="link' . $i . $j . $thisindex . '">' . $info->title . '</label>';
                                                                echo '</div>';
                                                                echo '</li>';
                                                                $thisindex++; 
                                                        }
                                                   
                                                    }
                                                }
                                                
                                            } else {
                                                // add the files to the archive list
                                                if ($j == 1) {
                                                    // all files for the current year show here regardless of category
                                                    $thisinfo = $archivedata[$alldates[$i - 2]];
                                                    foreach($thisinfo as $info) {
                                                        foreach($info as $allinfo) {
                                                            echo '<li>';
                                                            echo '<div class="checker">';
                                                            echo '<span class="">';
                                                            echo '<input type="checkbox" id="link' . $i . $j . $thisindex . '" name="downlink[]" value="' . $allinfo->url . '" />';
                                                            echo '</span>';
                                                            echo '</div>';
                                                            echo '<div class="styled-checks">';
                                                            echo '<label for="link' . $i . $j . $thisindex . '">' . $allinfo->title . '</label>';
                                                            echo '</div>';
                                                            echo '</li>';
                                                            $thisindex++;
                                                        }
                                                    }
                                                } else {
                                                    // filter by year and category
                                                    $thisinfo = $archivedata[$alldates[$i - 2]][$slugorder[$j]]; // current year and category
                                                    // loop through and show all files
                                                    foreach($thisinfo as $info) {
                                                        echo '<li>';
                                                        echo '<div class="checker">';
                                                        echo '<span class="">';
                                                        echo '<input type="checkbox" id="link' . $i . $j . $thisindex . '" name="downlink[]" value="' . $info->url . '" />';
                                                        echo '</span>';
                                                        echo '</div>';
                                                        echo '<div class="styled-checks">';
                                                        echo '<label for="link' . $i . $j . $thisindex . '">' . $info->title . '</label>';
                                                        echo '</div>';
                                                        echo '</li>';
                                                        $thisindex++;
                                                    }
                                                    

                                                    // grab anything labeled "All" for the category
                                                    $thisinfo = $archivedata['All'][$slugorder[$j]];
                                                    foreach($thisinfo as $info) {
                                                        echo '<li>';
                                                        echo '<div class="checker">';
                                                        echo '<span class="">';
                                                        echo '<input type="checkbox" id="link' . $i . $j . $thisindex . '" name="downlink[]" value="' . $info->url . '" />';
                                                        echo '</span>';
                                                        echo '</div>';
                                                        echo '<div class="styled-checks">';
                                                        echo '<label for="link' . $i . $j . $thisindex . '">' . $info->title . '</label>';
                                                        echo '</div>';
                                                        echo '</li>';
                                                        $thisindex++;
                                                    }
                                                   if ($thisindex == 0) {
                                                            // show no results message if index is still zero
                                                            echo '<li>';
                                                            echo "There are no results for the year and category you selected";
                                                            echo '</li>';
                                                            }
                                                }
                                            }
                                            echo '</ul>';
                                            ?>
                                                                              <div class="archive-options">
                                    <a href="#" onclick="javascript:document.downloadform2.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
                                    <a href="#" onclick="emailChecked2()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
                                    <!-- <a href="#" onclick="printChecked2()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a> -->
                        </div>
                                       <?php
                                       
                                            // are there more items than the maximum number allowed per page?
                                            if ($thisindex > $MAX_ITEMS) {
                                                // save the container name and add a pagination div
                                                array_push($pageddivs, 'all-files-' . $i . $j);
        
                                                echo '<input type="hidden" id="current_page' . $i . $j . '" />';  
                                                echo '<input type="hidden" id="show_per_page' . $i . $j . '" />'; 
                                                echo '<div id="filepages' . $i . $j . '"></div>';
                                            }
                                            echo '</div>';
                                        }
                        ?>
                                   </div>
                               </div>
                        <?php
                            }
                        ?>                    
                       </div> <!-- #tab-container-pub-info -->
                       <input type='hidden' name='down-files' value='1' />
                    </form>
                </div> <!-- #archive-cont-1 -->
                <div class="archive-tab-content" id="archive-cont-2">
                    <div class="photo-container">
                    <div id="slider" class="flexslider2">
                        <ul class="archive-slides">
                            <?php
                            $imagedata = array();
                            $first = true;
                        // show downloadable press photos
                        $args = array( 'post_type' => 'archive_photos',
                               'posts_per_page' => -1,
                               'meta_key' => 'photo_order', 
                               'orderby' => 'meta_value_num', 
                               'order' => 'ASC'
                        );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        // save the image data and build the slides
                        $thisdata = new stdClass();
                        $thisdata->img = get_the_post_thumbnail();
                        $thisdata->caption = get_the_title();
                        $thisdata->descr = get_the_content();
                        if ($first) {
                            $thiscaption = $thisdata->caption;
                            $thisdescr = $thisdata->descr;
                            $first = false;
                        }
                        array_push($imagedata, $thisdata);
                        echo '<li>';
                        echo get_the_post_thumbnail();
                        //echo '<img src="' . get_the_guid() . '" />';
                        echo '</li>';
                        endwhile;
                    ?>
                        </ul>
                      </div>
                    </div>

                    <div class="photo-caption-container">
                        <div class="photo-caption-text">
                            <?php echo "<strong>" . $thiscaption . "</strong>";?>
                             <?php echo "<br />" . $thisdescr;?>
                        </div>
                        <div class="archive-share-buttons">

                            <a href="<?php echo $imagedata[0]->imglink;?>" download="<?php echo basename($imagedata[0]->imglink);?>"><div class="social-icon"><i class="fa fa-share-square-o"></i></div><div class="share-text-black">Download</div></a><br />
         <a href="https://www.facebook.com/sharer/sharer.php?u='<?php echo $imagedata[0]->img;?>">
         <div class="social-icon"><i class="fa fa-facebook"></i></div><div class="share-text-black">Share on Facebook</div>
         </a><br />
         <a href="http://twitter.com/share?text=<?php echo strip_tags($thiscaption);?>&url=<?php echo $imagedata[0]->img;?>">
         <div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-black">Share on Twitter</div>
         </a><br />
         <a href="mailto:?subject=<?php echo strip_tags($thiscaption);?>&amp;body=<?php echo $imagedata[0]->img;?>" class="share-email">
         <div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-black">Forward to Friends</div></a><br />
         <a href="#" onclick="javascript:window.open('<?php echo $imagedata[0]->img;?>');">
         <div class="social-icon"><i class="fa fa-print"></i></div><div class="share-text-black">Print</div>
         </a>
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
            </div> <!-- tab-container-archive -->
    </main>
</div>
<script type="text/javascript">
    // image slider
$('#archive-tab2').click(function() {
    $('#archive-cont-2').show();
    
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
    animation: "slide",
    controlNav: false,
    directionNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 800,
    itemMargin: 0,
    sync: "#carousel",
    minItems: 1,
    maxItems: 1
  });
  
  //fixFlexsliderHeight();
});

$('.archive-slides li').click(function (){
    // retrieve the caption information
    setTimeout(function () {
        var captiontitle = '<strong>' + $('.archive-active-slide #caption-title').val() + '</strong>';
        captiontitle += '<br />' + $('.archive-active-slide #caption-descr').val();
        $('.photo-caption-text').html(captiontitle);

        // share buttons
        var imgsrc = jQuery('.archive-active-slide img').attr('src');
        var filename = imgsrc.substring(imgsrc.lastIndexOf('/')+1);

        var sharebtns = '<a href="' + imgsrc + '" download="' + filename + '"><div class="social-icon"><i class="fa fa-share-square-o"></i></div><div class="share-text-black">Download</div></a><br />';
        sharebtns += '<a href="https://www.facebook.com/sharer/sharer.php?u=' + imgsrc + '">';
        sharebtns += '<div class="social-icon"><i class="fa fa-facebook"></i></div><div class="share-text-black">Share on Facebook</div>';
        sharebtns += '</a><br />';
        sharebtns += '<a href="http://twitter.com/share?text=' + captiontitle + '&url=' + imgsrc + '">';
        sharebtns += '<div class="social-icon"><i class="fa fa-twitter"></i></div><div class="share-text-black">Share on Twitter</div>';
        sharebtns += '</a><br />';
        sharebtns += '<a href="mailto:?subject=' + captiontitle + '&amp;body=' + captiontitle + '%20-%20' + imgsrc + '" class="share-email">';
        sharebtns += '<div class="social-icon"><i class="fa fa-envelope-o"></i></div><div class="share-text-black">Forward to Friends</div></a><br />';
        sharebtns += '<a href="#" onclick="javascript:window.open(\'' + imgsrc + '\');">';
        sharebtns += '<div class="social-icon"><i class="fa fa-print"></i></div><div class="share-text-black">Print</div>';
        sharebtns += '</a>';
        $('.archive-share-buttons').html(sharebtns); 
        }, 1000);
});

// for downloading archive photos
function downloadfile(path) {
     var ifrm = document.getElementById('downframe');
     ifrm.src = "<?php echo get_template_directory_uri(); ?>/download.php?path="+path;
}
    // click event for checkboxes
    $('.checker span').click(function (){
        if ($(this).hasClass('checked')) {
            $(this).removeClass('checked');
            $(':checkbox', this).prop('checked', false);
        } else {
            $(this).addClass('checked');
            $(':checkbox', this).prop('checked', true);
        }
    });
            // function to initiate multiple downloads
            function makeFrame( url ) 
            { 
                ifrm = document.createElement( "IFRAME" ); 
                ifrm.setAttribute( "style", "display:none;" ) ;
                ifrm.setAttribute( "src", url ) ; 
                ifrm.style.width = 0+"px"; 
                ifrm.style.height = 0+"px"; 
                document.body.appendChild( ifrm ) ; 
            }  
            
            // force download of selected pdf files
            function downloadChecked( )
            {
                for( i = 0 ; i < document.downloadform.elements.length ; i++ )
                {
                      foo = document.downloadform.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            console.log(foo.value);
                            makeFrame(foo.value);
                      }
                }
            }
            
            // force download of selected pdf files
            function downloadChecked2( )
            {
                for( i = 0 ; i < document.downloadform2.elements.length ; i++ )
                {
                      foo = document.downloadform2.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            console.log(foo.value);
                            makeFrame(foo.value);
                      }
                }
            }
            
            // open new windows to print selected files
            function printChecked() {
                for( i = 0 ; i < document.downloadform.elements.length ; i++ )
                {
                      foo = document.downloadform.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            window.open(foo.value);
                      }
                }
            }
            
            // open new windows to print selected files
            function printChecked2() {
                for( i = 0 ; i < document.downloadform2.elements.length ; i++ )
                {
                      foo = document.downloadform2.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            window.open(foo.value);
                      }
                }
            }
            
            // email links to the checked off files
            function emailChecked() {
                var emailbody = "";
                for( i = 0 ; i < document.downloadform.elements.length ; i++ )
                {
                      foo = document.downloadform.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            emailbody += foo.value + "%0D%0A";
                            //window.open(foo.value);
                      }
                }
                // open up the user's email client
                window.location.href = "mailto:?subject=FOIL Subject Matter List&body=" + emailbody; 
            }
            
            // email links to the checked off files
            function emailChecked2() {
                var emailbody = "";
                for( i = 0 ; i < document.downloadform2.elements.length ; i++ )
                {
                      foo = document.downloadform2.elements[ i ] ;
                      if( foo.type == "checkbox" && foo.checked == true )
                      {
                            emailbody += foo.value + "%0D%0A";
                            //window.open(foo.value);
                      }
                }
                // open up the user's email client
                window.location.href = "mailto:?subject=BPCA Public Information Archive Files&body=" + emailbody; 
            }
</script>
<script language="javascript">
// jQuery EasyTabs
$('#tab-container-archive').easytabs({
              collapsible: false,
              updateHash: false
            });
            
$('#tab-container-pub-info').easytabs({
              collapsible: false,
              updateHash: false,
              defaultTab: 'li#pub-info-tab-2'
            });

$('#tab-container-pub-info-1').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-1-tab-2'
});

$('#tab-container-pub-info-2').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-2-tab-2'
});

$('#tab-container-pub-info-3').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-3-tab-2'
});

$('#tab-container-pub-info-4').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-4-tab-2'
});

$('#tab-container-pub-info-5').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-5-tab-2'
});

$('#tab-container-pub-info-6').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-6-tab-2'
});

$('#tab-container-pub-info-7').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-7-tab-2'
});

$('#tab-container-pub-info-8').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-8-tab-2'
});

$('#tab-container-pub-info-9').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-9-tab-2'
});

$('#tab-container-pub-info-10').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-10-tab-2'
});

$('#tab-container-pub-info-11').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-11-tab-2'
});

$('#tab-container-pub-info-12').easytabs({
    collapsible: false,
    updateHash: false,
    defaultTab: 'li#pub-info-12-tab-2'
});
</script>
<script type="text/javascript">
// jPages
<?php
// build pagination for the elements that need it
foreach ($pageddivs as $newpage) {
    $finditemnum = explode("-", $newpage);
    $itemnum = $finditemnum[2];
?>
setPagination(<?php echo $itemnum;?>);
<?php
}
?>
function setPagination(pagenumber) {
    //how much items per page to show  
    var show_per_page = 20;  
    //getting the amount of elements inside content div  
    var number_of_items = $('#all-files-' + pagenumber).children().size();  
    //calculate the number of pages we are going to have  
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  
  
    //set the value of our hidden input fields  
    $('#current_page' + pagenumber).val(0);  
    $('#show_per_page' + pagenumber).val(show_per_page);  
  
    //now when we got all we need for the navigation let's make it '  
  
    /* 
    what are we going to have in the navigation? 
        - link to previous page 
        - links to specific pages 
        - link to next page 
    */  
    var navigation_html = '<a class="previous_link" href="javascript:previous(' + pagenumber + ');"><i class="fa fa-angle-left"></i></a>&nbsp;&nbsp;&nbsp;';
    
    var current_link = 0;  
    while(number_of_pages > current_link){  
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +',' + pagenumber + ')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>&nbsp;&nbsp;&nbsp;';  
        current_link++;  
    }
    navigation_html += '<a class="next_link" href="javascript:next(' + pagenumber + ');"><i class="fa fa-angle-right"></i></a>';
  
    $('#filepages' + pagenumber).html(navigation_html);  
  
    //add active_page class to the first page link  
    $('#filepages' + pagenumber + ' .page_link:first').addClass('active_page');  
  
    //hide all the elements inside content div  
    $('#all-files-' + pagenumber).children().css('display', 'none');  
  
    //and show the first n (show_per_page) elements  
    $('#all-files-' + pagenumber).children().slice(0, show_per_page).css('display', 'block');
}

function previous(pagenumber){  
  
    new_page = parseInt($('#current_page' + pagenumber).val()) - 1;
    //console.log(new_page);
    //if there is an item before the current active link run the function 
    if($('.active_page').prev('.page_link').length > 0){  
        go_to_page(new_page, pagenumber);  
    } 
  
}  
  
function next(pagenumber){  
    new_page = parseInt($('#current_page' + pagenumber).val()) + 1; 
    //console.log(new_page);
    //if there is an item after the current active link run the function
    //go_to_page(new_page, pagenumber); 
    
    if($('.active_page').next('.page_link').length > 0){ 
       // console.log('clicked');
        go_to_page(new_page, pagenumber);  
    } 
        
  
}  
function go_to_page(page_num, pagenumber){  
    //get the number of items shown per page  
    var show_per_page = parseInt($('#show_per_page' + pagenumber).val());  
  
    //get the element number where to start the slice from  
    start_from = page_num * show_per_page;  
  
    //get the element number where to end the slice  
    end_on = start_from + show_per_page;  
  
    //hide all children elements of content div, get specific items and show them  
    $('#all-files-' + pagenumber).children().css('display', 'none').slice(start_from, end_on).css('display', 'block');  
  
    /*get the page link that has longdesc attribute of the current page and add active_page class to it 
    and remove that class from previously active page link*/  
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  
    //update the current page input field  
    $('#current_page' + pagenumber).val(page_num);  
} 
</script>
<?php 
// function to retrieve all archival data from the system
function getArchiveData($cats, $dates) {
    // construct the tag query of which years and categories to grab files from
    array_push($dates, 'All');
    // create the array objects to hold all of the data
    $allfiles = array();
    foreach($dates as $date) {
        $allfiles[$date] = array();
        foreach($cats as $cat) {
            $allfiles[$date][$cat] = array();
        }
    }


     $args = array( 'post_type' => 'attachment', 
                        'post_status' => 'inherit',
                               'posts_per_page' => -1,
                               'tax_query' => array(
                                        array(
                                                'taxonomy' => 'attachment_category',
                                                'field'    => 'slug',
                                                'terms'    => $cats,
                                        ),
                                        array(
                                            'taxonomy' => 'attachment_tag',
                                                'field'    => 'slug',
                                                'terms'    => $dates,
                                        )
                                ),
                               //'meta_key' => 'places_page_order', 
                               'orderby' => 'post_date', 
                               'order' => 'DESC'
                );
     $loop = new WP_Query( $args );
     while ( $loop->have_posts() ) : $loop->the_post();
        $cat_object = get_taxonomy( 'attachment_category' );
        $cats = wp_get_object_terms( get_the_ID(), 'attachment_category');
        foreach ($cats as $cat) {
            $tax_object = get_taxonomy( 'attachment_tag' );
            $terms = wp_get_object_terms( get_the_ID(), 'attachment_tag' );
            foreach ($terms as $term) {
                $thisid = get_the_ID();
                $allfiles[$term->name][$cat->slug][$thisid] = new stdClass();
                $allfiles[$term->name][$cat->slug][$thisid]->title = get_the_title();
                $allfiles[$term->name][$cat->slug][$thisid]->url = get_the_guid();
            }
        }
     endwhile;
    return $allfiles;
}
get_footer(); ?>
