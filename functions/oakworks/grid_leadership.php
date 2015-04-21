<?php

function build_leadership_grid($posts, $cols){
	$output = "";
	$i = 0;
	$ended_on_col_boundary = false;

	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) {
			$ended_on_col_boundary = false;
			$posts->the_post();
			$post_id = get_the_id();

			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail_size' );


			$post = array(
				'id'        => $post_id,
				'title'     => get_the_title(),
				'position'  => get_post_meta( $post_id, '_position_title', true ),
				'confirmed' => get_post_meta( $post_id, '_position_confirmed', true ),
				'content_1' => get_post_meta( $post_id, '_boi_column_1', true ),
				'content_2' => get_post_meta( $post_id, '_boi_column_2', true ),
				'thumbnail' => ''
			);
			if($thumb) {
				$post['thumbnail'] = "<img src='{$thumb['0']}' class='img-responsive' alt='{$post['title']}'/>";
			}

$output .= <<< HTML
	<li class="grid">
		<div class="grid-content">
			<div class="grid-info">
				<ul class="grid-info-list">
					<li><h3>{$post['title']}</h3></li>
					<li>{$post['position']}</li>
					<li>{$post['confirmed']}</li>
				</ul>
			</div>
			<!-- .grid-info -->

			<div class="grid-image">
				{$post['thumbnail']}
			</div>
			<!-- .grid-image -->

			<div class="grid-button" data-id="{$post['id']}"></div>
		</div>
		<!-- .grid-content -->

		<div class="grid-description">
			<ul>
				<li>{$post['title']}</li>
				<li>{$post['position']}</li>
				<li>{$post['confirmed']}</li>
			</ul>
			<p>{$post['content_1']}</p>
			<!-- .left-col -->
		</div>
		<!-- .grid-description -->
	</li>


HTML;

			if( ($i+1) % $cols === 0){
				$output .="<li class='grid-alt'></li>";
				$ended_on_col_boundary = true;
			}
			$i++;

		}
	}

	if(!$ended_on_col_boundary){
		$output .= "<li class='grid-alt'></li>";
	}
	return $output;
}
