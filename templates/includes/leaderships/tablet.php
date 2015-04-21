<?php
	global $wp_query;
	
	$args = array( 'post_type' => 'leadership', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' );
	
	query_posts( $args );
	
	$n = 1;
	$m = 1;
	
	$leader_bios = array();
	 
	$mod_compare = 2;
?>
<div class="grid-tablet">
	<ul class="leadership-list full-list">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<li class="leadership-set-<?php echo $m; ?>" data-set="<?php echo $m; ?>">
			<div class="content">
				<h3><?php the_title(); ?></h3>
				
				<p><?php echo get_post_meta( get_the_id(), '_position_title', true ); ?></p>
				
				<p><?php echo get_post_meta( get_the_id(), '_position_confirmed', true ); ?></p>
			</div>
			
			<div class="thumb"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); }  ?></div>
			
			<a href="javascript:void(0);" class="read-more" data-id="<?php the_ID(); ?>">+</a>
		</li>
		<?php
			$leader_content = (object)array( 
				'id' => get_the_id(),
				'set' => $m,
				'title' => get_the_title(),
				'position' => get_post_meta( get_the_id(), '_position_title', true ),
				'confirmed' => get_post_meta( get_the_id(), '_position_confirmed', true ),
				'content_1' => get_post_meta( get_the_id(), '_boi_column_1', true ),
				'content_2' => get_post_meta( get_the_id(), '_boi_column_2', true ), 
			);
			
			array_push($leader_bios, $leader_content);
			
			if ( $n == $mod_compare * $m ) {
				?>
	</ul>
	
	<?php foreach ( $leader_bios as $bio ) {
		?>
	<div class="bio-container row bio-content-<?php echo $bio->id; ?> leadership-set-<?php echo $bio->set; ?>">
		<div class="bio-column col-md-6">
			<p><span><?php echo $bio->title; ?></span><br /><?php echo $bio->position; ?><br /><?php echo $bio->confirmed; ?></p>
			
			<p>&nbsp;</p>
			
			<p><?php echo $bio->content_1; ?></p>
		</div>
		
		<div class="bio-column col-md-6">
			<p><?php echo $bio->content_2; ?></p>
		</div>
	</div>
		<?php
	}
	?>
	
	<ul class="leadership-list full-list">
				<?php
				
				$m++;
				$leader_bios = array();
			}
			
			$n++;
		?>
	<?php endwhile; endif; ?>
	<?php if ( $wp_query->found_posts % $mod_compare != 0 ) : ?>
	</ul>
	<?php foreach ( $leader_bios as $bio ) {
		?>
	<div class="bio-container row bio-content-<?php echo $bio->id; ?>">
		<div class="bio-column col-md-6">
			<p><span><?php echo $bio->title; ?></span><br /><?php echo $bio->position; ?><br /><?php echo $bio->confirmed; ?></p>
			
			<p>&nbsp;</p>
			
			<p><?php echo $bio->content_1; ?></p>
		</div>
		
		<div class="bio-column col-md-6">
			<p><?php echo $bio->content_2; ?></p>
		</div>
	</div>
		<?php
	}
	?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>