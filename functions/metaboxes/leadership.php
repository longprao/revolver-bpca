<?php
function revolver_leader_meta_box() {
	add_meta_box(
		'revolver_leader_metabox',
		__( 'Leader Data', 'revolver_metabox' ),
		'revolver_leader_metabox_func',
		'leadership',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'revolver_leader_meta_box' );

function leadership_subpage_save_postdata() {
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$post_id = $_POST['post_ID'];

	if ( isset( $_POST['position_title'] ) ) {
		$position_title = $_POST['position_title'];
		$position_confirmed = $_POST['position_confirmed'];
		$quote = $_POST['quote'];
		// bio was misspelled early on. Leaving so we don't have to re-enter/migrate existing bio data
		$boi_column_1 = $_POST['boi_column_1'];
		$boi_column_2 = $_POST['boi_column_2'];

		update_post_meta( $post_id, '_position_title', $position_title );
		update_post_meta( $post_id, '_position_confirmed', $position_confirmed );
		update_post_meta( $post_id, '_quote', $quote );
		update_post_meta( $post_id, '_boi_column_1', $boi_column_1 );
		update_post_meta( $post_id, '_boi_column_2', $boi_column_2 );
	}

	return $post_id;
}
add_action( 'save_post', 'leadership_subpage_save_postdata' );

function revolver_leader_metabox_func() {
	$post_id = $_REQUEST['post'];

	$position_title = get_post_meta( $post_id, '_position_title', true );
	$position_confirmed = get_post_meta( $post_id, '_position_confirmed', true );
	$quote = get_post_meta( $post_id, '_quote', true );
	$boi_column_1 = get_post_meta( $post_id, '_boi_column_1', true );
	$boi_column_2 = get_post_meta( $post_id, '_boi_column_2', true );

?>
<table width="100%">
	<tr>
		<td>
			<label for="position_title">Position Title</label>
			<input type="text" class="widefat" name="position_title" id="position_title" value="<?php echo $position_title; ?>" /><br /><br />
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>
			<label for="position_confirmed">Confirmed/Hired/Appointed</label>
			<input type="text" class="widefat" name="position_confirmed" id="position_confirmed" value="<?php echo $position_confirmed; ?>" /><br /><br />
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td width="49%">
			<label for="boi_column_1">Bio Column 1</label>
			<textarea class="widefat" name="boi_column_1" id="boi_column_1" style="height: 100px;"><?php echo $boi_column_1; ?></textarea><br /><br />
		</td>
		<td width="2%"></td>
		<td width="49%">
		</td>
	</tr>
</table>
<?php
}
?>
