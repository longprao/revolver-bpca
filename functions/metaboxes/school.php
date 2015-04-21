<?php
function revolver_school_meta_box() {
	add_meta_box(
		'revolver_school_metabox',
		__( 'School Data', 'revolver_metabox' ),
		'revolver_school_metabox_func',
		'school',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'revolver_school_meta_box' );


function school_save_postdata() {
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$post_id = $_POST['post_ID'];

	if ( isset( $_POST['park_web'] ) ) {
		$park_web = $_POST['park_web'];
		$web = $_POST['web'];
		$map_address = $_POST['map_address'];
		$address = $_POST['address'];
		$description_tags = $_POST['description_tags'];

		update_post_meta( $post_id, '_park_web', $park_web );
		update_post_meta( $post_id, '_web', $web );
		update_post_meta( $post_id, '_map_address', $map_address );
		update_post_meta( $post_id, '_address', $address );
		update_post_meta( $post_id, '_description_tags', $description_tags );
	}

	return $post_id;
}
add_action( 'save_post', 'school_save_postdata' );

function revolver_school_metabox_func() {
	$post_id = $_REQUEST['post'];

	$park_web = get_post_meta( $post_id, '_park_web', true );
	$web = get_post_meta( $post_id, '_web', true );
	$map_address = get_post_meta( $post_id, '_map_address', true );
	$address = get_post_meta( $post_id, '_address', true );
	$description_tags = get_post_meta( $post_id, '_description_tags', true );

?>
<table width="100%">
	<tr>
		<td>
			<label for="park_web">Park Website</label>
			<input type="text" class="widefat" name="park_web" id="park_web" value="<?php echo $park_web; ?>" /><br /><br />
		</td>
		<td></td>
		<td>
			<label for="web">Website</label>
			<input type="text" class="widefat" name="web" id="web" value="<?php echo $web; ?>" /><br /><br />
		</td>
	</tr>
	<tr>
		<td>
			<label for="map_address">Map Address</label>
			<input type="text" class="widefat" name="map_address" id="map_address" value="<?php echo $map_address; ?>" /><br /><br />
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>
			<label for="address">Address (Display)</label>
			<textarea class="widefat" name="address" id="address" style="height: 100px;"><?php echo $address; ?></textarea><br /><br />
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td width="49%">
			<label for="description_tags">Description Tags</label>
			<textarea class="widefat" name="description_tags" id="description_tags" style="height: 100px;"><?php echo $description_tags; ?></textarea><br /><br />
		</td>
		<td width="2%"></td>
		<td width="49%"></td>
	</tr>
</table>
<?php
}
?>
