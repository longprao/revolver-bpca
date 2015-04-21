<?php get_header(); ?>

			<?php if ( !is_front_page() ) : ?>
			<div class="breadcrumb wrapper">
				<p><?php if(function_exists('bcn_display')) { bcn_display(); } ?></p>
			</div>
			<?php endif; ?>

			<div class="wrapper">
            	<div class="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                	<?php the_content(); ?>
<?php endwhile; endif; ?>
                </div>
                
                <div class="clear"></div>
			</div>

<?php get_footer(); ?>