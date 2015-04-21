<?php
function revolver_residential_meta_box() {
	add_meta_box(
		'revolver_residential_metabox',
		__( 'Residential Data', 'revolver_metabox' ),
		'revolver_residential_metabox_func',
		'residential',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'revolver_residential_meta_box' );


function residence_save_postdata() {
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
		$snippet = $_POST['snippet'];
		$leed_level = $_POST['leed_level'];

		update_post_meta( $post_id, '_park_web', $park_web );
		update_post_meta( $post_id, '_web', $web );
		update_post_meta( $post_id, '_map_address', $map_address );
		update_post_meta( $post_id, '_address', $address );
		update_post_meta( $post_id, '_snippet', $snippet );
		update_post_meta( $post_id, '_leed_level', $leed_level );
	}

	return $post_id;
}
add_action( 'save_post', 'residence_save_postdata' );

function revolver_residential_metabox_func() {
	$post_id = $_REQUEST['post'];

	$park_web = get_post_meta( $post_id, '_park_web', true );
	$web = get_post_meta( $post_id, '_web', true );
	$map_address = get_post_meta( $post_id, '_map_address', true );
	$address = get_post_meta( $post_id, '_address', true );
	$snippet = get_post_meta( $post_id, '_snippet', true );
	$leed_level = get_post_meta( $post_id, '_leed_level', true );

?>
<table width="100%">
	<tr>
		<td>
			<label for="leed_level">LEED Level (for Green buildings)</label>
			<input type="text" class="widefat" name="leed_level" id="leed_level" value="<?php echo $leed_level; ?>" /><br /><br />
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>
			<label for="web">Website</label>
			<input type="text" class="widefat" name="web" id="web" value="<?php echo $web; ?>" /><br /><br />
		</td>
		<td></td>
		<td>
			<label for="park_web">Park Website</label>
			<input type="text" class="widefat" name="park_web" id="park_web" value="<?php echo $park_web; ?>" /><br /><br />
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
			<label for="snippet">Snippet</label>
			<textarea class="widefat" name="snippet" id="snippet" style="height: 100px;"><?php echo $snippet; ?></textarea><br /><br />
		</td>
		<td width="2%"></td>
		<td width="49%"></td>
	</tr>
</table>
<?php
}
?>
