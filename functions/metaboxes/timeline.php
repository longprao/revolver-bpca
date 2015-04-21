<?php
function revolver_timeline_meta_box() {
	add_meta_box( 
		'revolver_timeline_metabox',
		__( 'Timeline Data', 'revolver_metabox' ),
		'revolver_timeline_metabox_func',
		'timeline',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'revolver_timeline_meta_box' );


function timeline_save_postdata() {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	$post_id = $_POST['post_ID'];
	
	if ( isset( $_POST['year'] ) ) {
		$year = $_POST['year'];
		
		update_post_meta( $post_id, '_year', $year );
	}
	
	return $post_id;
}
add_action( 'save_post', 'timeline_save_postdata' );

function revolver_timeline_metabox_func() {
	$post_id = $_REQUEST['post'];
	
	$year = get_post_meta( $post_id, '_year', true );

?>
<table width="100%">
	<tr>
		<td>
			<label for="year">Year</label>
			<input type="text" class="widefat" name="year" id="year" value="<?php echo $year; ?>" /><br /><br />			
		</td>
		<td></td>
		<td></td>
	</tr>
</table>
<?php
}
?>