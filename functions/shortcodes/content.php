<?php
function clear_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
	), $atts ) );
	
	return '<div class="clear"></div>';
}
add_shortcode( 'clear', 'clear_func' );

function container_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	return '<div class="container2 '.$class.'">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'container', 'container_func' );

function content_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	return '<div class="content '.$class.'">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'content', 'content_func' );

function wrapper_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	return '<div class="wrapper '.$class.'">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'wrapper', 'wrapper_func' );

function row_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	return '<div class="row '.$class.'">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'row', 'row_func' );

function column_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	return '<div class="'.$class.'">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'column', 'column_func' );

function header_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'type' => '',
		'class' => ''
	), $atts ) );
	
	return '<h'.$type.' class="'.$class.'">'.do_shortcode( $content ).'</h'.$type.'>';
}
add_shortcode( 'header', 'header_func' );

function paragraph_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	return '<p class="'.$class.'">'.do_shortcode( $content ).'</p>';
}
add_shortcode( 'p', 'paragraph_func' );

function template_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'type' => '',
		'subtype' => '',
	), $atts ) );
	
	ob_start();  
    
	get_template_part( 'templates/'.$type, $subtype );  
    
    $output = ob_get_contents();
			
    ob_end_clean();  
    
    return $output;
}
add_shortcode( 'template', 'template_func' );



function acc_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => '',
		'title' => 'Please Set a title'
	), $atts ) );

	$str = '<div class="accordion one"><h4 class="acctoggle">'.$title.'</h4>'.do_shortcode( $content ).'</div>';
	
	$str = preg_replace( '%<p>&nbsp;\s*</p>%', '', $str ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$str = str_replace( $Old, $New, $str);

	return $str;
}
add_shortcode( 'accordion', 'acc_func' );

function acc_func2( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => '',
		'title' => 'Please Set a title'
	), $atts ) );

	$str = '<div class="accordion two"><h4 class="acctoggle">'.$title.'</h4>'.do_shortcode( $content ).'</div>';
	
	$str = preg_replace( '%<p>&nbsp;\s*</p>%', '', $str ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$str = str_replace( $Old, $New, $str);

	return $str;
}
add_shortcode( 'accordion-two', 'acc_func2' );

function acc_func3( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => '',
		'title' => 'Please Set a title'
	), $atts ) );

	$str = '<div class="accordion three"><h4 class="acctoggle">'.$title.'</h4>'.do_shortcode( $content ).'</div>';
	
	$str = preg_replace( '%<p>&nbsp;\s*</p>%', '', $str ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$str = str_replace( $Old, $New, $str);

	return $str;
}
add_shortcode( 'accordion-three', 'acc_func3' );

function acc_child_func( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	$str = '<div class="accordion-child">'.do_shortcode( $content ).'</div>';

	$str = preg_replace( '%<p>&nbsp;\s*</p>%', '', $str ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$str = str_replace( $Old, $New, $str);

	return $str;
}
add_shortcode( 'accordion-child', 'acc_child_func' );

function acc_child_func2( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	$str = '<div class="accordion-child">'.do_shortcode( $content ).'</div>';

	$str = preg_replace( '%<p>&nbsp;\s*</p>%', '', $str ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$str = str_replace( $Old, $New, $str);

	return $str;
}
add_shortcode( 'accordion-child-two', 'acc_child_func2' );

function acc_child_func3( $atts, $content = NULL ) {
	extract( shortcode_atts( array (
		'class' => ''
	), $atts ) );
	
	$str = '<div class="accordion-child">'.do_shortcode( $content ).'</div>';

	$str = preg_replace( '%<p>&nbsp;\s*</p>%', '', $str ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$str = str_replace( $Old, $New, $str);

	return $str;
}
add_shortcode( 'accordion-child-three', 'acc_child_func3' );

function bpca_shortcode_button( $atts ) {
	$atts = shortcode_atts(
		array(
			'color' => 'clear',
			'url'   => '',
			'text'  => '',
		),
		$atts
	);

	return '<a href="' . esc_url( $atts['url'] ) . '" class="btn-bpca ' . esc_attr( $atts['color'] ) . '">' . esc_html( $atts['text'] ) . '</a>';
}
add_shortcode( 'button', 'bpca_shortcode_button' );