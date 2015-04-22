<?php

if ( ! isset( $content_width ) )
	$content_width = 640;

add_action( 'after_setup_theme', 'revolver_setup' );

if ( ! function_exists( 'revolver_setup' ) ):
function revolver_setup() {
	global $revolver_options;
	
	add_editor_style();

	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	set_post_thumbnail_size( 160, 194, true );
	
	$revolver_options = get_option( 'revolver_theme_options' );
	
	add_image_size('gallery-image', 800, 525);
	//add_image_size('post-thumb-img', 103, 100, true);
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'revolver' ),
	) );
	
	register_nav_menus( array(
		'top' => __( 'Top Navigation', 'revolver' ),
	) );
	
	register_nav_menus( array(
		'resources' => __( 'Resources', 'revolver' ),
	) );
	
	register_nav_menus( array(
		'footer' => __( 'Footer Navigation', 'revolver' ),
	) );
}
endif;

add_filter('the_content', 'remove_empty_p', 20, 1);
function remove_empty_p($content){
	$content = force_balance_tags($content);
	return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}

function revolver_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'revolver_page_menu_args' );

function revolver_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'revolver_excerpt_length' );

function revolver_continue_reading_link() {
	return __( '', 'revolver' );
}

function revolver_auto_excerpt_more( $more ) {
	return ' &hellip;' . revolver_continue_reading_link();
}
add_filter( 'excerpt_more', 'revolver_auto_excerpt_more' );

function revolver_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= revolver_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'revolver_custom_excerpt_more' );

function revolver_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'revolver' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'revolver' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 2, Located in the bottom right of the footer (Contact Us area)
	register_sidebar( array(
		'name' => __( 'Footer Bottom Right', 'revolver' ),
		'id' => 'footer-right-widget-area',
		'description' => __( 'The bottom right footer widget area', 'revolver' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}


add_action( 'widgets_init', 'revolver_widgets_init' );

add_filter( 'widget_text', 'do_shortcode' );

function next_link_attributes( $output ) {
	$code = 'class="next"';
	
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
add_filter('next_post_link', 'next_link_attributes');

function previous_link_attributes( $output ) {
	$code = 'class="prev"';
	
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
add_filter('previous_post_link', 'previous_link_attributes');

function next_posts_link_attributes() {
    return 'class="nextpostslink"';
}
add_filter('next_posts_link_attributes', 'next_posts_link_attributes');

function prev_posts_link_attributes() {
    return 'class="previouspostslink"';
}
add_filter('previous_posts_link_attributes', 'prev_posts_link_attributes');

function revolver_comment_form($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
?>
<li>
	<div class="comment-author vcard">
	<div class="post-avtar"><?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
	</div>
    <div class="post-body">
	<div class="comment-meta"><?php echo get_comment_author_link(); ?><span class="bullet time-ago-bullet" aria-hidden="true">•</span></div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php
			/* translators: 1: date, 2: time */
			 echo short_time_diff( get_comment_time('U'),current_time('timestamp') ); 
			//printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
		?>
	</div>

	<div class="comment-text"><?php comment_text(); ?></div>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	</div>
    </li>
<?php
}

function short_time_diff( $from, $to = '' ) {
    $diff = human_time_diff($from,$to);

    $replace = array(
        'hour' => 'h',
        'hours' => 'h',
        'day' => 'd',
        'days' => 'd',
		'mins' => 'm',
		' ' =>''
    );

    return strtr($diff,$replace);
}

//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

require_once ( get_template_directory() . '/functions/index.php' );

//enable placeholder for gravity forms
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
//enable anchor for gravity forms
add_filter( 'gform_confirmation_anchor', '__return_true' );



function gallery_share_shortcode( $atts ){

	$links = '';

	$a = shortcode_atts( array(
		'links' => ''
	), $atts);

	foreach( explode(',',$a['links']) as $type){
		$links .= "<a class='$type'></a>";
	}

	return '<div class="archive-share-buttons">'.$links.'</div>';
}

add_shortcode( 'bpca_share' , 'gallery_share_shortcode');


/*add_filter("gform_validation_message", "change_message", 10, 2);
function change_message($message, $form){
    return "To Download RFP Forms, please enter the required information, marked red below";
} */

/* Added By Hire Jordan Smith - 4/22/2015 */

// Anchor all Gravity Forms on submission
add_filter( 'gform_confirmation_anchor', '__return_true' ); 
