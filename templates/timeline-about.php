<?php
	$args = array( 'post_type' => 'timeline', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' );

	query_posts( $args );
?>
<div id="timeline_years" class="flexslider">
	<ul class="slides timeline-years">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<li><a href="javascript:void(0);" data-id="<?php the_ID(); ?>"><?php echo get_post_meta( get_the_id(), '_year', true ); ?></a></li>
		<?php endwhile; endif; ?>
	</ul>
</div>

<div class="clear"></div>

<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>

<div class="timeline-page-container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="timeline-page row timeline-page-<?php the_ID(); ?>">
			<div class="col-md-8 col"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); }  ?></div>

			<div class="col-md-4 col">
				<div class="content-wrapper">
					<h4><span class="year"><?php echo str_replace('S' ,'', get_post_meta( get_the_id(), '_year', true )); ?> — </span><?php the_title(); ?></h4>

					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
	<div class="prev-slide"><i class="fa fa-angle-left"></i></div>
    <div class="next-slide"><i class="fa fa-angle-right"></i></div>
</div>

<?php wp_reset_query(); ?>
<div class="clear"></div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".timeline-years li:first-child").addClass('active');
		$(".timeline-page-container .timeline-page:first-child").addClass('active');

		$('#timeline_years').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: true,
			slideshow: false,
			itemWidth: 300,
			itemMargin: 0,
			move: 4,
			startAt: 0,
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
			minItems: 1,
			maxItems: 4,
		    start: function(slider){
		        $('.flexslider').resize();
	          $('.next-slide').click(function(event){
				var cur = $(".timeline-page-container .timeline-page.active");
			    cur.removeClass('active');
			    next = cur.next('.timeline-page');
			    if(next.length == 0){ next = cur.prevAll('.timeline-page').last()}
			    next.addClass('active');
		      });
		      $('.prev-slide').click(function(event){
				var cur = $(".timeline-page-container .timeline-page.active");
			    cur.removeClass('active');
			    prev = cur.prev('.timeline-page');
			    if(prev.length == 0){ prev = cur.nextAll('.timeline-page').last()}
			    prev.addClass('active');
		      });
			}
		});

		$(".timeline-years li a").click(function () {
			var id = $(this).data('id');

			$(".timeline-years li.active").removeClass('active');
			$(".timeline-page-container .timeline-page.active").removeClass('active');

			$(this).parent().addClass('active');
			$(".timeline-page-container .timeline-page-" + id).addClass("active");
		});
	});
</script>