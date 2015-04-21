<?php
	global $wp_query;
	
	$args = array( 'post_type' => 'leadership', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' );
	
	query_posts( $args );
	
	$n = 1;
	$m = 1;
	
	$leader_bios = array();
	
	include( dirname(__FILE__) . '/includes/leaderships/desktop.php' );
	include( dirname(__FILE__) . '/includes/leaderships/tablet.php' );
	include( dirname(__FILE__) . '/includes/leaderships/mobile.php' );
?>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".leadership-list.full-list .read-more").click(function () {
			var id = $(this).data('id');
			var setClass = $(this).parent().data('set');
			var hasClass = $(this).parent().hasClass('active');
			
			
			$(".leadership-list.full-list li.leadership-set-" + setClass + ".active .read-more").each(function () {
				$(this).html('+');
			});
			
			$(".leadership-list.full-list li.leadership-set-" + setClass + ".active").removeClass('active');
			$(".bio-container.leadership-set-" + setClass + ".active").removeClass('active');
			
			if (!hasClass) {
				$(this).html('-');
				
				$(this).parent().addClass('active');
				$('.bio-content-' + id).addClass('active');
			} else {
				$(this).html('+');
				
				$(this).parent().removeClass('active');
				$('.bio-content-' + id).removeClass('active');
			}
		});
	});
</script>