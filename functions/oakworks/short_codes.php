<?php

if (array_key_exists('down-files', $_POST)) {
    //Took out the if for signle file downloads, it simply zips all now.   Set this back to 2 instead of 0 to return functionality
    if (count($_POST['file-list']) >= 0) {
      //create zip bundle of selected pdfs.
      # create new zip opbject
      $zip = new ZipArchive();

      # create a temp file & open it
      $tmp_file = tempnam('.','');
      $zip->open($tmp_file, ZipArchive::CREATE);

      # loop through each file
      foreach($_POST['file-list'] as $file){
        # download file
        $download_file = file_get_contents($file);
        #add it to the zip
        $zip->addFromString(basename($file),$download_file);
      }

      # close zip
      $zip->close();
/*
      # send the file to the browser as a download
      header('Content-disposition: attachment; filename=bpca-file-download.zip');
      header('Content-type: application/zip');
      readfile($tmp_file);
*/

      // set example variables
      $filename = "RAWR.zip";
      //$filepath = "/var/www/domain/httpdocs/download/path/";

      // http headers for zip downloads
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: public");
      header("Content-Description: File Transfer");
      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"".$filename."\"");
      header("Content-Transfer-Encoding: binary");
      header("Content-Length: ".filesize($tmp_file));
      ob_end_flush();
      @readfile($tmp_file);

    // remove the tmp file after we download it
      //unlink($tmp_file);
      //end zip bundle
    } else {
      //download sing pdf file
      //echo $_POST['file-list'][0];

      //Fix for multiple content types of sgle file downloads....
      /*orginal code
      header("Content-disposition: attachment; filename=bpca-download.pdf");
      header("Content-type:application/pdf");
      readfile($_POST['file-list'][0]);
      */

      $filename = $_POST['file-list'][0];

      // required for IE, otherwise Content-disposition is ignored
      if(ini_get('zlib.output_compression'))
         ini_set('zlib.output_compression', 'Off');

      $file_extension = strtolower(substr(strrchr($filename,"."),1));

      switch( $file_extension )
      {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        default: $ctype="application/force-download";
      }
      header("Pragma: public"); // required
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: private",false); // required for certain browsers 
      header("Content-Type: $ctype");
      header("Content-Disposition: attachment; filename=\"".basename($filename)."\"");
      header("Content-Transfer-Encoding: Binary");
      header("Content-Length: ".filesize($filename));
      readfile("$filename");
   }

    
}

// [bpca_teasers categories="black,blue,gold"]
function build_teaser_row($atts){
  $a = shortcode_atts( array(
      'categories' => 'black,blue,gold',
      'governor'   => '<pre>Specify "governor=\'NAME\'" in the bpca_teasers widget</pre>'
  ), $atts );

  $tcategory = explode(',',$a['categories']);

  $args = array(
    'post_type' => 'teaser',
    'orderby' => 'menu_order',
    'tax_query' => array(
        array(
          'taxonomy' => 'tcategory',
          'field' => 'slug',
          'terms' => $tcategory
        )
      )
  );

  $loop = new WP_Query($args);
  $output = '<div class="row">';
  $teasers = array();

  if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) {
      $loop->the_post();
      $post_id = get_the_id();
      $cats = post_terms($post_id, 'tcategory');
      $cat = '';
      if($cats) $cat = strtolower($cats[0]);
      $teasers[] = array(
        'title'			=> get_post_meta( $post_id, '_title', true),
        'subtitle'	=> get_post_meta( $post_id, '_subtitle', true),
        'read_more_link'	=> get_post_meta( $post_id, '_read_more_link', true),
        'category' => $cat,
        'class'    => preg_replace('/[^a-z]/', '', $cat)
      );
      }
    }
    // Annoying but necessary loop in order to output everything in the proper order (that was passsed in)
    foreach ($tcategory as $category) {
      if($category == 'twitter'){
        // Get Twitter widget
        $output .= "<div class='col-sm-6 col-md-4 teaser teaser-twitter'><div class='content twitter'>";
        $output .= "<a class='bpca-twitter' href='https://twitter.com/bpca_ny' target='_new'>Twitter    <i class='fa fa-twitter'></i></a>";
        $output .= do_shortcode("[AIGetTwitterFeeds ai_username='bpca_ny' ai_numberoftweets='2' ai_tweet_title='Twitter']");
        $output .= "<a class='bpca-twitter' href='https://twitter.com/intent/user?screen_name=bpca_ny' target='_new'>Follow us @bpca_ny</a>";
        $output .= "</div></div>";
        continue;
      }else if($category == 'social'){
        $slider = get_masterslider( 5 );
        $output .= "<div class='col-sm-6 col-md-4 teaser teaser-social'>" . $slider . "</div>";
        continue;

      }else if($category == 'leadership'){

        $args = array( 'post_type' => 'leadership', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC' );
        query_posts( $args );

        $output .= "<div class='content teaser teaser-leadership leadership'><h6>Leadership</h6>";
        $output .= "<ul class='leadership-list'>";
        $output .= "<li class='leadership-governnor'><a href='https://www.governor.ny.gov' target='_blank'>{$a['governor']}</a> - Governor</li>";

        if ( have_posts() ) : while ( have_posts() ) : the_post();
          $post_id = get_the_id();
          $leader_name = get_the_title();
          $position = get_post_meta( $post_id, '_position_title', true );

          $output .= "<li><a href='" . get_site_url() .  "/about/leadership?selected_id={$post_id}'>{$leader_name}</a> - {$position}</li>";
        endwhile; endif;
        $output .= "</ul>";

        wp_reset_query();

        $output .= "<a href='about/leadership' class='btn-bpca white'>Read More</a></div>";

      }else if($category == 'events'){
        $output .= events_widget();
        continue;
      }else{
        foreach ($teasers as $teaser) {
          if($category == $teaser['category']){
            // handle any additional teasers with numbers in them
$output .= <<< HTML
          <div class="col-sm-6 col-md-4 teaser {$teaser['class']}">
              <h6>{$teaser['title']}</h6>
              <p>{$teaser['subtitle']}</p>
              <a class="btn-bpca {$teaser['class']}" href="{$teaser['read_more_link']}?selected_id=334">Read more</a>
              <div class="clear">
            </div>
          </div>
HTML;
          continue;

          }
        }
      }

    }
  $output .= '</div>';

  return $output;
}

add_shortcode( 'bpca_teasers', 'build_teaser_row' );



// [download_form category="press-photos"]
function downloadable_items($atts){
  $a = shortcode_atts( array(
      'category' => 'photos',
      'show'     => 5,
      'actions'  => true,
      'subtitle' => '',
      'tag'      => ''
  ), $atts );

  if($a['show'] == 'all'){
    $a['show'] = -1;
  }

  if ($a['tag'] <> ''){
    //args with tags
    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'posts_per_page' => $a['show'],
      'orderby' => 'date',
      'order' => 'DESC',
      'tax_query' => array(
          array(
            'taxonomy' => 'attachment_category',
            'field' => 'slug',
            'terms' => $a['category']
          ),
          array(
            'taxonomy' => 'attachment_tag',
            'field'    => 'slug',
            'terms'    => $a['tag']
          )
        )
    );
  } else {
    //args without tag
    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'posts_per_page' => $a['show'],
      'orderby' => 'date',
      'order' => 'DESC',
      'tax_query' => array(
          array(
            'taxonomy' => 'attachment_category',
            'field' => 'slug',
            'terms' => $a['category']
          )
        )
    );
  } 

  $loop = new WP_Query($args);
  $output .= "<form name='downloadform' class='downloadform' method='post'><ul class='{$ap['category']}'>";
  $teasers = array();

  if($a['subtitle'] !== ''){
    //show subtitle if supplied
    $output .= "<h4>".$a['subtitle']."</h4>";
  }

  if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) {
      $loop->the_post();
      $id = get_the_ID();
      $class = "link-{$id}";
      $title = get_the_title();
      $guid  = get_the_guid();
$output .= <<< HTML
      <li>
        <div class="checker"><input type="checkbox" id="{$class}" class="downloadable-items" name="downlink[]" value="{$guid}" />
        <div class="checkcheck"></div></div>
        <label for='{$class}'>{$title}</label>
          
      </li>
HTML;

    }

  }
$output .= <<< HTML
      <input type='hidden' name='down-files' value='1' />
      <input type='hidden' id='current_page' />
      <input type='hidden' id='show_per_page' />
      </form>
    </ul>
<div id='page_navigation'></div>
<br/>

HTML;

if($a['actions'] == true){
    //show action buttons
    $output .= <<< HTML

    <div class="download-link-area unclickable">
      <a class="download-items"><i class="fa fa-share-square-o"></i>Download</a>
      <a class="forward-to-friends"><i class="fa fa-envelope-o"></i>Forward to Friends</a><br />
    </div>
    <div class="invisi-click">
    </div>

HTML;
}

  return $output;
}


add_shortcode( 'download_form', 'downloadable_items' );



