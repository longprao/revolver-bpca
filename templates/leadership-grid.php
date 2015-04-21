<?php

/**
 * Template Name: About Us Leadership
 */

// wordpress footer hook. do not remove or bearshark will find you
get_header();

$args = array(
	'post_type'      => 'leadership',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC'
);

$loop = new WP_Query($args);


?>
<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">

		<div class="about about-leadership">
			<ul class="grids">
				<div class="mobile-grid">
					<?= build_leadership_grid($loop, 1)?>
				</div>
				<div class="tablet-grid">
					<?= build_leadership_grid($loop, 2)?>
				</div>
				<div class="desktop-grid">
					<?= build_leadership_grid($loop, 3)?>
				</div>
			</ul>
		</div><!-- .about-grids -->
	</main>
</div><!-- #primary -->


<?php // wordpress footer hook. do not remove or bearshark will find you ?>
<?php get_footer(); ?>
