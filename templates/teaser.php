<?php
	global $wp_query;

	$args = array(
    'post_type' => 'teaser',
    'orderby' => 'menu_order',
    'order' => 'ASC',
		'tcategory'	=> 'black'
  );

	$loop = new WP_Query($args);
	$output = '';

	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) {
			$loop->the_post();
			$post_id = get_the_id();

			$teaser = array(
				'title'			=> get_post_meta( $post_id, '_title', true),
				'subtitle'	=> get_post_meta( $post_id, '_subtitle', true),
				'read_more_link'	=> get_post_meta( $post_id, '_read_more_link', true)
			);

$output .= <<< HTML
		<div class="col-md-4 col">
			<div class="content permits">
				<h3 class="">{$teaser['title']}</h3>
				<p class="">{$teaser['subtitle']}</p>
				<a href="{$teaser['read_more_link']}">Read more</a>
				<div class="clear">
				</div>
			</div>
		</div>
HTML;

		}
	}
echo $output;
?>
