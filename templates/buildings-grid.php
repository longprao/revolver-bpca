<?php

/**
 * Template Name: Residential Buildings Grid
 */

// wordpress footer hook. do not remove or bearshark will find you
get_header();

$args = array(
	'post_type'      => 'residential',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC'
);

// try to parse the tags from the query param
$filter_tags  = (array_key_exists('tags', $_GET)) ? $_GET['tags'] : false;

if ( $filter_tags ) {
	//if we have tags, filter our query - must include all tags
	$args[tax_query]  = array(
		array(
			'taxonomy' => 'rcategory',
			'field'    => 'slug',
			'terms'    => $filter_tags,
			'operator' => 'AND'
		)
	);
}//end if

$loop = new WP_Query($args);

function get_building_categories_html(){
	$terms = get_terms("rcategory");
	$flattended = array();
	foreach($terms as $term){
		$flattended[] = $term->name;
	}
	return build_tags_html($flattended, '', true);
}


?>
<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">


		<div class="filter building-filter row">
			<div class="col-md-8 filter-header"><?= post_image(get_the_id()); ?></div>
			<div class="col-md-4 filter-controls">
				<div class="row">
					<h3>FILTER BY BUILDING TYPE</h3>
				</div>
				<div class="row post-filter">
					<?= get_building_categories_html() ?>
				</div>
				<!--<button class="go-button">GO</button>-->
			</div>
		</div>

		<div class="residential residential-buildings">
			<ul class="grids">
				<div class="mobile-grid">
					<?= build_grid($loop, 1)?>
				</div>
				<div class="tablet-grid">
					<?= build_grid($loop, 2)?>
				</div>
				<div class="desktop-grid">
					<?= build_grid($loop, 3)?>
				</div>
			</ul>
		</div><!-- .about-grids -->
		<div class="building-loading"><i class="fa fa-refresh fa-spin"></i> LOADING RESULTS...</div>
	</main>
</div><!-- #primary -->


<?php // wordpress footer hook. do not remove or bearshark will find you ?>
<?php get_footer(); ?>
