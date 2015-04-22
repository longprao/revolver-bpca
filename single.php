<?php get_header(); ?>

<?php if ( !is_front_page() ) : ?>
	<div class="breadcrumb wrapper">
		<p><?php if(function_exists('bcn_display')) { bcn_display(); } ?></p>
	</div>
<?php endif; ?>

<div class="wrapper">
	<div class="content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="row header">
				<div class="col-md-4 col pull-right">
					<div class="content header-content <?= get_field('quote_box_color') ?>">
						<h1><?= get_field('quote') ?></h1>
						<h3><?= get_field('quote_by') ?></h3>
						<h5><?= get_field('quote_title_1') ?></h5>
						<h5><?= get_field('quote_title_2') ?></h5>
					</div>
				</div>
				<div class="col-md-8 col">
					<?= post_image(get_the_id()) ?>
				</div>
			</div>
			  
			<?php
			$start_date = get_the_date('m/d');
			$post_categories = wp_get_post_categories(get_the_id());

			foreach( $post_categories as $cat ) {
				$cat = get_category( $cat );
				$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
			}

			$tags_html = build_tags_html( $cats, $start_date );
			?>
			<div class="row blog">
				<div class="col-md-8 teaser blog-post">
					<div class="grid-info">
						<?php echo $tags_html; ?>
						<div>
							<h1><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h1>
							<?php the_content(); ?>
							<div class="grid-aside-content">
								<ul>
									<li>
										<a href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank">
											<i class="fa fa-facebook"></i>Share on Facebook
										</a>
									</li>
									<li>
										<a href="http://twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>" target="_blank">
											<i class="fa fa-twitter"></i>Share on Twitter
										</a>
									</li>
									<li>
										<a href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo urlencode( get_the_permalink() ); ?>">
											<i class="fa fa-envelope-o"></i>Forward to Friends
										</a>
									</li>
								</ul>
							</div>
							<a href="<?php echo get_site_url(); ?>/news/blog/" title="Blog Homepage" class="btn-bpca">Back to Blog Homepage</a>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>

	<div class="clear"></div>
</div>

<?php get_footer(); ?>
