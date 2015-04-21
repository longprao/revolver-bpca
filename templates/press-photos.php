<?php

/**
* Template Name: News - Press
*
*/
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
    header('Content-disposition: attachment; filename=bpca-press-photos.zip');
    header('Content-type: application/zip');
    readfile($tmp_file);

    // remove the tmp file after we download it
    unlink($tmp_file);
}

get_header(); ?>

<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
<?php endwhile; endif; ?>


    <div class="press-tab-content" id="press-cont-3">
        <form name="downloadform" id="downloadform" method='post'>
            <ul id="all-files">
        <?php
            // show downloadable press photos
            $args = array( 'post_type' => 'attachment',
                   'post_status' => 'inherit',
                   'posts_per_page' => -1,
                   'tax_query' => array(
                            array(
                                    'taxonomy' => 'attachment_category',
                                    'field'    => 'slug',
                                    'terms'    => 'press-photos',
                            ),
                    ),
                   'orderby' => 'id',
                   'order' => 'ASC'
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
            echo '<li><div class="checker">';
            echo '<span class="">';
            echo '<br /><input type="checkbox" id="link' . get_the_ID() . '" name="downlink[]" value="' . get_the_guid() . '" />';
            echo '</span>';
            echo '</div>';
            echo '<div class="styled-checks">';
            echo '<label for="link' . get_the_ID() . '">';
            echo get_the_title() . '</label>';
            echo '</div></li>';
            endwhile;
        ?>
        <input type='hidden' name='down-files' value='1' />
        <input type='hidden' id='current_page' />
        <input type='hidden' id='show_per_page' />
            </ul>
        <div id='page_navigation'></div>
        </form><br />
        <div class="download-link-area">
        <a href="#" onclick="javascript:document.downloadform.submit();"><i class="fa fa-share-square-o"></i>&nbsp;&nbsp;Download</a><br />
        <a href="#" onclick="emailChecked()"><i class="fa fa-envelope-o"></i>&nbsp&nbsp;Forward to Friends</a><br />
        <!--<a href="#" onclick="printChecked()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>-->
        </div>
    </div>

</main>
</div><!-- #primary -->

<?php get_footer(); ?>
