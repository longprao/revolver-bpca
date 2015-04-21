<?php
function revolver_teaser_meta_box() {
	add_meta_box(
		'revolver_teaser_metabox',
		__( 'Teaser Data', 'revolver_metabox' ),
		'revolver_teaser_metabox_func',
		'teaser',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'revolver_teaser_meta_box' );


function teaser_save_postdata() {
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$post_id = $_POST['post_ID'];

	$title = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$read_more_link = $_POST['read_more_link'];

	update_post_meta( $post_id, '_title', $title );
	update_post_meta( $post_id, '_subtitle', $subtitle );
	update_post_meta( $post_id, '_read_more_link', $read_more_link );

	return $post_id;
}
add_action( 'save_post', 'teaser_save_postdata' );

function revolver_teaser_metabox_func() {
	$post_id = $_REQUEST['post'];

	$title = get_post_meta( $post_id, '_title', true );
	$subtitle = get_post_meta( $post_id, '_subtitle', true );
	$read_more_link = get_post_meta( $post_id, '_read_more_link', true );

?>
<table width="100%">
	<tr>
		<td>
			<label for="web">Title</label>
			<textarea class="widefat" name="title" id="title" /><?php echo $title; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<label for="web">Subtitle</label>
			<textarea class="widefat" name="subtitle" id="subtitle" value="<?php echo $subtitle; ?>" /><?php echo $subtitle; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<label for="map_address">"Read More" link</label>
			<input type="text" class="widefat" name="read_more_link" id="read_more_link" value="<?php echo $read_more_link; ?>" />
		</td>
		<td></td>
		<td></td>
	</tr>
</table>
<?php
}
?>
