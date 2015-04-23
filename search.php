<?php

/**
 * Template Name: Search page
 */

get_header();

// array of selected categories
$filter = array(
	'post_type'      => array(
		'post',
		'page'
	),
	'orderby'        => 'post_date',
	'order'          => 'DESC',
	'posts_per_page' => 8,
	'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
);

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

						$start_date = get_the_date('m/d');
						$post_categories = wp_get_post_categories(get_the_id());

						foreach( $post_categories as $cat ) {
							$cat = get_category( $cat );
							$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
						}

						$tags_html = build_tags_html( $cats, $start_date );
						$cats = array();

						?>
						<div class="row result result_padding">
							<h1><a href="<?= the_permalink() ?>"><?= get_the_title() ?></a></h1>
							<p><?= the_excerpt() ?></p>
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
				}

				?>
			</div>

		</div>

	</main>
</div>


<?php get_footer(); ?>
