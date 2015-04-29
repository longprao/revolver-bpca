<?php

/**
 * Template Name: Search page
 */

get_header();

// array of selected categories
// $filter = array(
	// 'post_type'      => array(
		// 'post',
		// 'page'
	// ),
	// 'orderby'        => 'post_date',
	// 'order'          => 'DESC',
	// 'posts_per_page' => 8,
	// 'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
// );
  
// try to parse the date from the query param
$filter_tags  = (array_key_exists('tags', $_GET)) ? $_GET['tags'] : false;
// var_dump('<pre>', $filter_tags);

global $wp_query;
?>

<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">
		<div class="content white_bg">

            <div class="row header" style="margin-bottom:40px;">
                <div class="col-md-4 col" style="background: #19a6e2; padding: 51px 30px 27px 30px;">
                  <div class="content header-content blue">
                    <h1 style="color:white;">BPCA's website is aimed to provide a comprehensive resource of public information as well as a valuable reference tool for the community. If you have any questions or are unable to find what you need here, please do not hesitate to contact us.</h1>
                    <h3></h3>
                    <h5></h5>
                    <h5></h5>
                  </div>
                </div>
                <div class="col-md-8 col">
                  <img src='http://www.thevantoshgroup.com/bpca/wp-content/uploads/2015/04/search_header_image.jpg' class='img-responsive' alt=''/>                </div>
              </div>
            <!--
			<div class="filter events-filter row">
				<div class="col-md-12 filter-header"><?= post_image(get_the_id()); ?></div>
			</div> -->
			<div class="news">
				<?php
				
				if ( $wp_query->have_posts() ) {
					while ( $wp_query->have_posts() ) {
						$wp_query->the_post();

						// $start_date = get_the_date('m/d');
						// $post_categories = wp_get_post_categories(get_the_id());

						// foreach( $post_categories as $cat ) {
							// $cat = get_category( $cat );
							// $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
						// }

						// $tags_html = build_tags_html( $cats, $start_date );
						// $cats = array();
							$id=get_the_ID();
							$post_type=get_post_type($id);
						?>
						<div class="row result result_padding">
							<?php 
							$url= get_the_permalink();
							
							
							$sendto = "";
							// echo $post_type;
							switch ($post_type) {
								case 'leadership':
									$sendto = "/about/leadership/#bio-area-box-" . get_the_ID();
									break;
								case 'school':
									$sendto = "/residential-life/schools/#bio-area-box-" . get_the_ID();
									break;
								case 'place':
									$category = get_the_terms(get_the_ID(), 'pcategory');
									//print_r($category);
									//echo $category[0]->name;
									$thiscat = "";
									foreach ($category as $catslug) {
										// only grab the primary category
										$thiscat = $catslug->slug;
										break;
									}
									$sendto = "/places/";
									switch ($thiscat) {
										case 'get-around':
											$sendto .= "get-around";
											break;
										case 'museums-memorials':
											$sendto .= "museums-memorials";
											break;
										case 'parks':
											$sendto .= "parks";
											break;
										case 'public-art':
											$sendto .= "public-art";
											break;
										case 'public-spaces':
											$sendto .= "public-spaces";
											break;
									}
									$sendto .= "#descr-area-box-" . get_the_ID();
									break;
								case 'resident':
									$sendto = "/residential-life/";
									$category = get_the_terms(get_the_ID(), 'resident_categories');
									$thiscat = "";
									foreach ($category as $catslug) {
										// only grab the primary category
										$thiscat = $catslug->slug;
										break;
									}
									switch($thiscat) {
										case 'buildings':
										case 'apartments':
										case 'apt-green':
										case 'condos':
										case 'condo-green':
											$sendto .= "buildings";
											break;
										case 'schools':
											$sendto .= "schools";
											break;
									}
									$sendto .= "#descr-area-box-" . get_the_ID();
									break;
								case 'attachment':
									$sendto = get_the_guid();
									break;
								case 'tribe_events':
									$sendto = "/news/events#descr-area-box-" . get_the_ID();
									break;
								case 'timeline':
									$sendto = "/about-2/who-we-are";
									break;
							}
							
							
							
							if ($sendto != "") {
								$url=get_bloginfo('url').$sendto;
							} else {
								
								$url=get_the_permalink();
							}
							
							
							// if($post_type=='place'){
								// $categories = get_the_terms( $id, 'pcategory' );
								// $category  = $categories->term_id;
								// echo $category;
								// var_dump($categories);
								// $url=get_bloginfo('url').'/places';
							// } else if($post_type!='page'){
								// $url=get_bloginfo('url').'/'.$post_type;
							// }
							$exclude =array (get_bloginfo('url').'/about/',get_bloginfo('url').'/places/',get_bloginfo('url').'/news/',get_bloginfo('url').'/apply/',get_bloginfo('url').'/residential-life/');
							if(!in_array($url,$exclude)):
							?>
							<h1><a href="<?php echo $url; ?>"><?= get_the_title() ?></a></h1>
							<p><?= the_excerpt() ?></p>
							<?php endif;?>
						</div>
						<?php
					}

					wp_reset_postdata();
					?>
					<div class="row pagination">
						<ul>
							<?php
							if ( $previous_posts = get_previous_posts_link( '<i class="fa fa-angle-left"></i>' ) )
							{
								?>
								<li class="next"><?php echo $previous_posts; ?></li>
								<?php
							} // END if

							$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
							$total_pages  = $wp_query->max_num_pages;
							?>
							<li>
								<form>
									<input type="text" name="paged" placeholder="<?php echo absint( $current_page ); ?>" id="paged"/>
									of <?php echo absint( $total_pages ); ?>
								</form>
							</li>
							<?php

							if ( $next_posts = get_next_posts_link( '<i class="fa fa-angle-right"></i>' ) )
							{
								?>
								<li class="previous"><?php echo $next_posts; ?></li>
								<?php
							} // END if
							?>
						</ul>
					</div>
					<?php
				} else{
				?>
					<div class="row result result_padding"></div>
					<div class="row result result_padding">
					Sorry, there are no results for your search.
					</div>
				<?php
				}

				?>
			</div>

		</div>

	</main>
</div>


<?php get_footer(); ?>
