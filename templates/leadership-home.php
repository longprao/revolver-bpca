<?php
	$args = array( 'post_type' => 'leadership', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC' );
	
	query_posts( $args );
?>
<ul class="leadership-list">
	<li><a href="https://www.governor.ny.gov/" target="_blank">ANDREW M. CUOMO</a> - Governor</li>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<li><a href="#"><?php the_title(); ?></a> - <?php echo get_post_meta( get_the_id(), '_position_title', true ); ?></li>
	<?php endwhile; endif; ?>
</ul>
<?php wp_reset_query(); ?>
<a href="about/leadership" class="read-more">Read More</a>
<div class="clear"></div>
