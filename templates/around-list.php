<?php
	global $wp_query;
	
	$args = array( 'post_type' => 'place', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'pcategory' => 'get-around' );
	
	query_posts( $args );
	
	$n = 1;
	$m = 1;
	
	$mod_compare = is_tablet() || is_mobile() ? (is_tablet() ? 2 : 1) : 3;
	
	$museums_bio = array();
?>
<ul class="museum-list full-list">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<li>
		<div class="content">
			<h3><?php the_title(); ?></h3>
			
			<p><?php echo get_post_meta( get_the_id(), '_address', true ); ?></p>
			
			<p class="img">
				<?php
					if( class_exists('Dynamic_Featured_Image') ) {
						global $dynamic_featured_image;
						
						$featured_images = $dynamic_featured_image->get_featured_images( $postId );
						
						if ( $featured_images ) {
							echo '<img src="'.$featured_images[0]['full'].'" alt="" />';
						}
					}
				?>
			</p>
		</div>
		
		<a href="javascript:void(0);" class="read-more" data-id="<?php the_ID(); ?>">+</a>
	</li>
	<?php
		$museum_content = (object)array( 
			'id' => get_the_id(),
			'title' => get_the_title(),
			'park_web' => get_post_meta( get_the_id(), '_park_web', true ),
			'web' => get_post_meta( get_the_id(), '_web', true ),
			'map_address' => get_post_meta( get_the_id(), '_map_address', true ),
			'address' => get_post_meta( get_the_id(), '_address', true ),
			'description_tags' => get_post_meta( get_the_id(), '_description_tags', true ),
			'content' => get_the_content(),
			'url' => get_permalink()
		);
		
		array_push($museums_bio, $museum_content);
		
		if ( $n == $mod_compare * $m ) {
			?>
</ul>

<?php foreach ( $museums_bio as $bio ) {
	?>
<div class="museum-content museum-content-<?php echo $bio->id; ?>">
	<div class="museum-container row">
		<div class="col-md-8 col"><?php if ( has_post_thumbnail() ) { echo get_the_post_thumbnail( $bio->id, 'full' ); }  ?></div>
		
		<div class="col-md-4 col">
			<?php
				if( class_exists('Dynamic_Featured_Image') ) {
					global $dynamic_featured_image;
					
					$featured_images = $dynamic_featured_image->get_featured_images( $bio->id );
					
					if ( $featured_images ) {
						echo '<a href="http://maps.google.com/maps/?daddr='.$bio->map_address.'" target="_blank"><img src="'.$featured_images[0]['full'].'" alt="" /></a>';
					}
				}
			?>
		</div>
	</div>
	
	<div class="museum-container row">
		<div class="museum-column col-md-8">
			<p><?php echo $bio->content; ?></p>
		</div>
		
		<div class="museum-column col-md-4">
			<p><?php echo $bio->description_tags; ?></p>
			
			<ul class="action-links">
				<li><a href="#">Forward to Friends</a></li>
				<li class="twitter"><a href="javascript:void(0);" onclick="window.open('https://twitter.com/home?status=<?php echo $bio->url; ?>');">Share on Twitter</a></li>
				<li class="facebook"><a href="javascript:void(0);" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo $bio->url; ?>')">Share on Facebook</a></li>
				<?php if ( !empty( $bio->park_web ) ) : ?>
				<li class="read_more_at_bpc"><a href="<?php echo $bio->park_web; ?>" target="_blank">Read More at BPC Parks</a></li>
				<?php endif; ?>
				<?php if ( !empty( $bio->web ) ) : ?>
				<li class="visit_site"><a href="<?php echo $bio->web; ?>" target="_blank">Visit the Site</a></li>
				<?php endif; ?>
				<li class="personalized_directions"><a href="#">Get Personalized Directions</a></li>
			</ul>
			
			<form action="https://www.google.com/maps/" method="get" class="form" target="_blank">
				<input type="text" id="saddr" name="saddr" placeholder="ENTER START ADDRESS" />
				<input type="hidden" id="daddr" name="daddr" value="<?php echo $bio->map_address; ?>" />
				
				<input type="submit" value="Go" />
			</form>
		</div>
	</div>
</div>
	<?php
}
?>

<ul class="museum-list full-list">
			<?php
			
			$m++;
			$museums_bio = array();
		}
		
		$n++;
	?>
<?php endwhile; endif; ?>
<?php if ( $wp_query->found_posts % $mod_compare != 0 ) : ?>
</ul>
<?php foreach ( $museums_bio as $bio ) {
	?>
<div class="museum-content museum-content-<?php echo $bio->id; ?>">
	<div class="museum-container row">
		<div class="col-md-8 col"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); }  ?></div>
		
		<div class="col-md-4 col">
			<?php
				if( class_exists('Dynamic_Featured_Image') ) {
					global $dynamic_featured_image;
					
					$featured_images = $dynamic_featured_image->get_featured_images( $postId );
					
					if ( $featured_images ) {
						echo '<a href="http://maps.google.com/maps/?daddr='.$bio->map_address.'" target="_blank"><img src="'.$featured_images[0]['full'].'" alt="" /></a>';
					}
				}
			?>
		</div>
	</div>
	
	<div class="museum-container row">
		<div class="museum-column col-md-8">
			<p><?php echo $bio->content; ?></p>
		</div>
		
		<div class="museum-column col-md-4">
			<p><?php echo $bio->description_tags; ?></p>
			
			<ul class="action-links">
				<li><a href="#">Forward to Friends</a></li>
				<li class="twitter"><a href="javascript:void(0);" onclick="window.open('https://twitter.com/home?status=<?php echo $bio->url; ?>');">Share on Twitter</a></li>
				<li class="facebook"><a href="javascript:void(0);" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo $bio->url; ?>')" target="_blank">Share on Facebook</a></li>
				<?php if ( !empty( $bio->park_web ) ) : ?>
				<li class="read_more_at_bpc"><a href="<?php echo $bio->park_web; ?>" target="_blank">Read More at BPC Parks</a></li>
				<?php endif; ?>
				<?php if ( !empty( $bio->web ) ) : ?>
				<li class="visit_site"><a href="<?php echo $bio->web; ?>" target="_blank">Visit the Site</a></li>
				<?php endif; ?>
				<li class="personalized_directions"><a href="#">Get Personalized Directions</a></li>
			</ul>
			
			<form action="https://www.google.com/maps/" method="get" class="form" target="_blank">
				<input type="text" id="saddr" name="saddr" placeholder="ENTER START ADDRESS" />
				<input type="hidden" id="daddr" name="daddr" value="<?php echo $bio->map_address; ?>" />
				
				<input type="submit" value="Go" />
			</form>
		</div>
	</div>
</div>
	<?php
}
?>
<?php endif; ?>
<?php wp_reset_query(); ?>
<div class="clear"></div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".museum-list.full-list .read-more").click(function () {
			var id = $(this).data('id');
			var hasClass = $(this).parent().hasClass('active');
			
			$(".museum-list.full-list li.active").removeClass('active');
			$(".museum-content.active").removeClass('active');
			
			$(".museum-list.full-list .read-more").each(function () {
				$(this).html('+');
			});
			
			if (!hasClass) {
				$(this).html('-');
				
				$(this).parent().addClass('active');
				$('.museum-content-' + id).addClass('active');
			}
		});
	});
</script>