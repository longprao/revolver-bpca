<?php

/**
 * Template Name: News Events Grid
 */

// wordpress footer hook. do not remove or bearshark will find you
get_header();

function get_all_event_categories_html(){
	$terms = get_terms("tribe_events_cat");
	$flattended = array();
	foreach($terms as $term){
		$flattended[] = $term->name;
	}
	return build_tags_html($flattended, '', true);
}


// array of selected categories
$filter = array(
	'start_date'      => date('j M Y'),
	'eventDisplay'    => 'list',
	'posts_per_page'  => 30
);
// try to parse the date from the query param
$filter_date  = (array_key_exists('date', $_GET)) ? date_create_from_format('m-d-Y', $_GET['date']) : false;
$filter_tags  = (array_key_exists('tags', $_GET)) ? $_GET['tags'] : false;
// var_dump('<pre>', $filter_tags);

if ($filter_date){
	// make sure the date wasn't previously selected
	$filter['eventDisplay'] = 'custom';
	$filter['start_date'] = $filter_date->format('j M Y');
}


if($filter_tags){
	// tags need a prefix of 'event-' in them for this to work properly so we add it below
	foreach ($filter_tags as $tag) {
		$filter_tags[] = "event-{$tag}";
	}

	$filter['tax_query']  = array(
		array(
			'taxonomy' => 'tribe_events_cat',
			'field'    => 'slug',
			'terms'    => $filter_tags,
		)
	);
}

$loop = tribe_get_events($filter);

?>



<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">

			<div class="filter events-filter row">
				<div class="col-md-8 filter-header"><?= post_image(get_the_id()); ?></div>
				<div class="col-md-4 filter-controls">
					<div class="row">
						<h3>FILTER BY FOCUS AREA</h3>
					</div>
					<div class="row post-filter">
						<?= get_all_event_categories_html() ?>
					</div>
					<!--<button class="go-button">GO</button>-->
					<div class="row">
						<div class="calendar-container">
							<div class="calendar">
								<header>
									<h2 class="month"></h2>
									<a class="btn-prev fa fa-angle-left" href="#"></a>
									<a class="btn-next fa fa-angle-right" href="#"></a>
								</header>
								<table>
									<thead class="event-days">
										<tr></tr>
									</thead>
									<tbody class="event-calendar">
										<tr class="1"></tr>
										<tr class="2"></tr>
										<tr class="3"></tr>
										<tr class="4"></tr>
										<tr class="5"></tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="news news-events">
				<ul class="grids">
					<div class="mobile-grid">
						<?= build_grid($loop, 1, true)?>
					</div>
					<div class="tablet-grid">
						<?= build_grid($loop, 2, true)?>
					</div>
					<div class="desktop-grid">
						<?= build_grid($loop, 3, true)?>
					</div>
				</ul>
			</div>
	</main>
</div><!-- #primary -->


<?php // wordpress footer hook. do not remove or bearshark will find you ?>
<?php get_footer(); ?>
