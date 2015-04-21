<?php

/**
 * Template Name: Residential Schools Grid
 */

get_header();

$args = array(
	'post_type'      => 'school',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC'
);

$loop = new WP_Query($args);

?>
<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">

		<div class="residential residential-schools">
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
	</main>
</div><!-- #primary -->


<?php ?>
<?php get_footer(); ?>
