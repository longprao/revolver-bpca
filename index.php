<?php

if ( is_search() || isset( $_GET['s'] ) )
{
	require dirname( __FILE__ ) . '/search.php';
} // END if

/**
 * Template Name: Blog index
 */

get_header();

function get_all_event_categories_html(){
	$terms = get_terms("category");
	$flattended = array();
	foreach($terms as $term){
		$flattended[] = $term->name;
	}
	return build_tags_html($flattended, '', true);
}

// array of selected categories
$filter = array(
	'post_type'      => 'post',
	'orderby'        => 'post_date',
	'order'          => 'DESC',
	'posts_per_page' => 8,
	'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
);

// try to parse the date from the query param
$filter_tags  = (array_key_exists('tags', $_GET)) ? $_GET['tags'] : false;
// var_dump('<pre>', $filter_tags);

if( $filter_tags ) {
	foreach ( $filter_tags as $tag ) {
		$filter_tags[] = "{$tag}";
	}

	$filter['tax_query']  = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $filter_tags,
		)
	);
}

$loop = new WP_Query( $filter );

global $wp_query;

$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $loop;
?>

<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">
		<div class="content">

			<div class="filter events-filter row">
				<div class="col-md-8 filter-header"><?= post_image(get_the_id()); ?></div>
				<div class="col-md-4 filter-controls">
					<div class="row">
						<h3>Filter by Focus Area</h3>
					</div>
					<div class="row post-filter">
						<?= get_all_event_categories_html() ?>
					</div>
<!--					<a class="btn-bpca go-button" href="#">Go</a>-->
				</div>
			</div>
			<div class="news news-blog">
				<?php
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) {
						$loop->the_post();

						$start_date = get_the_date('m/d');
						$post_categories = wp_get_post_categories(get_the_id());

						foreach( $post_categories as $cat ) {
							$cat = get_category( $cat );
							$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
						}

						$tags_html = build_tags_html( $cats, $start_date );
						$cats = array();

						?>
						<div class="row">
							<div class="col-md-8 teaser">
								<div class="grid-info">
									<?php echo $tags_html; ?>
									<div>
										<h1><a href="<?= the_permalink() ?>"><?= get_the_title() ?></a></h1>
										<p><?= the_excerpt() ?></p>
										<?= the_post_thumbnail('blog-thumbnail') ?>

							      <a class="btn-bpca" href="<?= get_permalink() ?>">Read more</a>
									</div>
							  </div>
							</div>
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
									<input type="text" name="paged" placeholder="<?php echo absint( $current_page ); ?>" id="paged" />
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

				$wp_query = NULL;
				$wp_query = $temp_query;
				?>
			</div>

		</div>

	</main>
</div>


<?php get_footer(); ?>
