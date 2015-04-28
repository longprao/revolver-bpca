<?php

function post_terms( $post_id=null, $category="" ){
	if(empty($category)) $category = 'rcategory';
	$wp_terms = get_the_terms( $post_id, $category );
	$terms = array();

	if( $wp_terms ){
		foreach( $wp_terms as $term ){
			$terms[] = $term->name;
		}
	}

	return $terms;
}


function build_tags_html($categories= array(), $category_header="", $filter=false){
	$cats = "";
	if ( count($categories) ){
		$cats .= "<ul class='grid-info-tags'>";
		if($category_header){
			$cats .= "<li class='category-header'>" .  $category_header . "</li>";
		}
		foreach ( $categories as $cat ) {
			$slug = '';
			$name = '';
			if(is_array($cat)){
				// name and slug should be in the category
				$slug = $cat['slug'];
				$name = $cat['name'];
			}else{
				$slug = sanitize_title($cat);
				$name = strip_tags($cat);
			}

			if($filter){
				$cats .= "<li class='{$slug}'><input type='checkbox' value='{$slug}' id='{$slug}' class='filter-values' /><label for='{$slug}'></label><span>{$name}</span></li>";
			}else{
		  	$cats .= "<li class='{$slug}'>{$name}</li>";
			}
		}
		$cats .= "</ul>";
	}
	return $cats;
}

function post_image( $post_id=null, $title=''){
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

	if($img) {
		return "<img src='{$img['0']}' class='img-responsive' alt='{$title}'/>";
	}else{
		return '';
	}
}

function featured_image( $post_id, $img_number=0 ){
	if( class_exists('Dynamic_Featured_Image') ) {
		global $dynamic_featured_image;

		$image = '';

		$featured_images = $dynamic_featured_image->get_featured_images( $post_id );

		if ( $featured_images ) {
			$image = $featured_images[$img_number]['full'];
			if ( $image ){
				$image = "<img class='img-responsive' src='{$image}'>";
			}
		}

		return $image;
	}
}

function build_grid($posts=array(), $cols=1, $events=false){
	$output = "";
	$i = 0;
	$ended_on_col_boundary = false;
	$site_url = get_site_url();

	$posts_array = array();
	if($events){
			foreach ($posts as $post) {
			// Events are from tribe_events and have to be handled differently than a regular WP_POST
			$post_id = $post->ID;

			$start_date = date_create(apply_filters( 'EventStartDate', $post->EventStartDate ));
			$end_date = date_create(apply_filters( 'EventEndDate', $post->EventEndDate ));
			

			$post = array(
				'id'            => $post_id,
				'title'         => apply_filters( 'post_title', $post->post_title ),
				'category_head' => date_format($start_date,"m/d"),
				'sub_head'      => date_format($start_date,"g:ia") . ' - ' . date_format($end_date,"g:ia"),
				'start_date_cal'  => date_format($start_date,"Ymd\\THi00\\Z") ,
				'end_date_cal'   => date_format($end_date,"Ymd\\THi00\\Z"),
				'content'       => apply_filters( 'post_content', $post->post_content ),
				'address'       => '',
				'map_address'   => '',
				'map_img'       => featured_image( $post_id ),
				'img'           => post_image($post_id),
				'tags_html'     => '',
				'web'           => get_post_meta( $post_id, '_EventURL', true ),
				'content_cal'           => strip_tags(apply_filters( 'post_content', $post->post_content )),
				'location_cal'           => sp_get_venue( $post_id ),
				'snippet'				=> '',
				'transport_img' => '',
				'status' => '',
			);

			$post['tags_html'] = build_tags_html(array(tribe_get_event_taxonomy($post_id, '', '', '')), $post['category_head']);

			$post['map_address']	= tribe_get_address($post_id) . ',' . tribe_get_city($post_id) . ',' . tribe_get_zip($post_id);

			// Do additions to content
			$prepend_content = '';

			if ( sp_has_venue( $post_id ) )
			{
					$prepend_content .= 'Location: ' . sp_get_venue( $post_id ) . '<br />';
			} // END if
			
			$prepend_content .= 'Time: ' . $post['sub_head'] . '<br />';
			
			if ( $cost = sp_get_cost( $post_id ) )
			{
				$prepend_content .= 'Cost: ' . get_post_meta( $post_id, '_EventCurrencySymbol', true ) . $cost . '<br />';
			} // END if
			
			$button = '';
			
			if ( $buy_tickets = get_post_meta( $post_id, '_ecp_custom_3', true ) )
			{
				$button = '<a href="' . esc_url( $buy_tickets ) . '" title="Buy Tickets" class="btn-bpca white">Buy Tickets</a>';
			} // END if

			if ( $status = get_post_meta( $post_id, '_ecp_custom_2', true ) )
			{
				$status = '<h4>' . $status . '</h4>';
			} // END if

			
			$post['content'] = $status . '<p>' . $prepend_content . '</p>' . $button . '<p>' . $post['content'] . '</p>';
			
			$posts_array[] = $post;
		}
	}else{
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) {
				$posts->the_post();
				$post_id = get_the_id();

				// $start_date_cal = date_create(apply_filters( 'EventStartDate', $post->EventStartDate ));
				// $end_date_cal = date_create(apply_filters( 'EventEndDate', $post->EventEndDate ));

				$post = array(
					'id'          			=> $post_id,
					'title'							=> get_the_title(),
					'content'						=> get_the_content(),
					'park_web' 					=> get_post_meta( $post_id, '_park_web', true ),
					'web' 							=> get_post_meta( $post_id, '_web', true ),
					'map_address' 			=> get_post_meta( $post_id, '_map_address', true ),
					'description'           => wpautop(get_post_meta( $post_id, '_description_tags', true )),
					// formatted for display on screen
					'address' 					=> get_post_meta( $post_id, '_address', true ),
					// Currently only used for LEED
					'category_head'			=> get_post_meta( $post_id, '_leed_level', true),
					'snippet'						=> get_post_meta( $post_id, '_snippet', true),
					'terms'							=> post_terms( $post_id ),
					'img'								=> post_image( $post_id, get_the_title()),
					// The first featured image (image 2) should be a map screenshot
					'map_img'						=> featured_image( $post_id ),
					// The second featured image (image 3) should be a map screenshot
					'transport_img'			=> featured_image( $post_id, 1),
					'tags_html'         => '',
					'sub_head'          => ''
				);
				$post['tags_html'] = build_tags_html(post_terms($post_id), $post['category_head']);
				$posts_array[] = $post;
			}
		}
	}
	foreach ($posts_array as $post) {
		$ended_on_col_boundary = false;

        $http = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $url = strtok($_SERVER["REQUEST_URI"],'?');
        $permalink = urlencode($http . $_SERVER['HTTP_HOST'] . $url . '?selected_id=' . $post['id']);

		$post_description = '';
		
		if ( isset( $post['description'] ) && '' != $post['description'] )
		{
			$post_description = '<div class="description-tags">' . $post['description'] . '</div>';
		} // END if

$output .= <<< HTML
	<li class="grid">
		<div class="grid-content">
			<div class="grid-info">
				{$post['tags_html']}
				<ul class="grid-info-list">
					<li><h3>{$post['title']}</h3></li>
					<li>{$post['address']}</li>
					<li>{$post['sub_head']}</li>
					<li class="transport-img">{$post['transport_img']}</li>
				</ul>
			</div>
			<!-- .grid-info -->

			<div class="grid-image">
				<img src="{$site_url}/wp-content/themes/revolver/images/filler-image.jpg" width="400" height="350" />
			</div>
			<!-- .grid-image -->

		</div>
		<!-- .grid-content -->

		<div class="grid-button" data-id="{$post['id']}"></div>

		<div class="grid-description">
			<div class="grid-description-images">
				<ul>
					<li class="grid-thumbnail places">{$post['img']}</li>
					<li class="grid-map places">
						<a href="http://maps.google.com/maps/?daddr={$post['address']}" target="_blank">
							{$post['map_img']}
						</a>
					</li>
				</ul>
			</div>
			<!-- .grid-description-images -->

			<div class="grid-description-content places">
				<div class="left-col places pull-left">
					{$post['content']}
				</div>
				<div class="right-col places pull-right">
					<div class="grid-aside-content aside-share-button">
						{$post_description}
						<ul>
							<li class="snippet">{$post['snippet']}</li>
							<li>
								<a href="mailto:?subject={$post['title']}&body={$permalink}">
									<i class="fa fa-envelope-o"></i>Forward to Friends
								</a>
							</li>
HTML;

        if( $events ) {
            $output .= <<< HTML

							<li>
								<a href="#" target="_blank">
									<i class="fa fa-calendar"></i>Add to iCal
								</a>
							</li>

							<li>
								<a href="http://www.google.com/calendar/event?action=TEMPLATE&text={$post['title']}&dates={$post['start_date_cal']}/{$post['end_date_cal']}&details={$post['content_cal']}&location={$post['location_cal']}&trp=false" target="_blank">
									<i class="fa fa-google"></i>Add to Google Calendar
								</a>
							</li>
HTML;
        }//end if

        $output .= <<< HTML
							<li>
								<a href="http://twitter.com/share?text={$post['title']}&url={$permalink}"" target="_blank">
									<i class="fa fa-twitter"></i>Share on Twitter
								</a>
							</li>

							<li>
								<a href="https://www.facebook.com/sharer/sharer.php?u={$permalink}" target="_blank">
									<i class="fa fa-facebook"></i>Share on Facebook
								</a>
							</li>
HTML;

if( ! empty( $post['park_web'] ) ){
$output .= <<< HTML

							<li>
								<a href="{$post['park_web']}" target="_blank">
									<i class="fa fa-leaf"></i>Read More at BPC Parks
								</a>
							</li>
HTML;
}//end if

if( ! empty( $post['web'] ) ){
$output .= <<< HTML

							<li>
								<a href="{$post['web']}" target="_blank">
									<i class="fa fa-laptop"></i>Visit the Site
								</a>
							</li>
HTML;
}//end if

$output .= <<< HTML

							<li>
								<div class="link-dir-area-black short">
									<i class="fa fa-map-marker"></i>Get Personalized Directions

									<form id="gdirects-black" action="http://maps.google.com/maps" method="get" target="_blank">
										<input type="text" name="saddr" placeholder="ENTER START ADDRESS" />
										<input type="hidden" name="daddr" value="{$post['map_address']}" />
										<input type="submit" value="GO" />
									</form>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>
		<!-- .grid-description -->
	</li>
HTML;

			if( ($i+1) % $cols === 0){
				$output .="<li class='grid-alt places'></li>";
				$ended_on_col_boundary = true;
			}
			$i++;

		}

		if(!$ended_on_col_boundary){
			$output .= "<li class='grid-alt places'></li>";
		}
	return $output;
}

?>
