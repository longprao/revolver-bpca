<?php

/**
 * Template Name: Places Get Around Grid
 */

get_header();

$args = array(
	'post_type' => 'place',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'pcategory' => 'get-around'
);


$loop = new WP_Query($args);

?>
<div id="primary" class="content-area wrapper">
	<main id="main" class="site-main" role="main">
	<?php 
	if (have_posts()) : while (have_posts()) : the_post();
        the_content(); 
    endwhile; endif; 
    ?>
		<div class="places-pn places-get-around">
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
