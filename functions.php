<?php 
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */

// drag and drop menu support
register_nav_menu( 'primary', 'Primary Menu' );
register_nav_menu( 'footer1', 'Footer One' );
register_nav_menu( 'footer2', 'Footer Two' );
register_nav_menu( 'footer3', 'Footer Three' );


//widget support for a right sidebar
register_sidebar(array(
  'name' => 'Right SideBar',
  'id' => 'right-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//widget support for the footer
register_sidebar(array(
  'name' => 'Footer SideBar',
  'id' => 'footer-sidebar',
  'description' => 'Widgets in this area will be shown in the footer.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',
  'before_title' => '<h3>',
  'after_title' => '</h3>'
));

//This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );


//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');


/**
 * MANAGE REMOVING OR ADDING STUFF (aka Function Snippets)
 * comment in or out what you want
 */

// remove stuff,  uncomment to enable
//require_once( get_template_directory() . '/snippets/remove-stuff.php' );

// add stuff
//require_once( get_template_directory() . '/snippets/add-stuff.php' );
//
//

/**
 * function my_admin_bar_remove
 * Remove the WordPress menu from the admin bar.
 *
 * This will remove the WordPress logo from the admin bar; you
 * may wish to add your own alternative menu in its place.
 *
 * @since 1.5
 */
function my_admin_bar_remove() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_node('wp-logo');
}
add_action('wp_before_admin_bar_render', 'my_admin_bar_remove');

/**
 * function my_howdy_replacer
 * Tweak the "Howdy" text in the admin bar.
 *
 * This replaces the "Howdy" text with your own text,
 * in this case "Logged in as".
 * This snippet was borrowed from wp-snippets.com
 *
 * @since 1.5
 */
function my_howdy_replacer( $wp_admin_bar ) {
	$my_account = $wp_admin_bar->get_node('my-account');
	$newtitle   = str_replace( 'Howdy,', 'Logged in as', $my_account->title );
	$wp_admin_bar->add_node( array(
		'id'    => 'my-account',
		'title' => $newtitle,
	) );
}
add_filter( 'admin_bar_menu', 'my_howdy_replacer',  25 );

/**
 * function my_admin_footer
 * Rewrite the text in the bottom-left footer area
 *
 * @since 1.0
 */
function my_admin_footer() {
	echo 'Designed and Developed by <a href="http://www.ennovatenigeria.com" target="_blank">Ennovate Nigeria</a>';
}
add_filter('admin_footer_text', 'my_admin_footer');


// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * function variable excerpt
 * Vary the lenght of excerpts for a post. must be used within a loop. 
 * 
 * */
 function excerpt($lenght = 300){
    $rawcontent = get_the_content();
    $treatcontent = strip_tags($rawcontent);
    $content = substr($treatcontent,0,$lenght);
    return $content;
 }
 
 /**
 * function variable excerpt
 * Add appropriate more link. must be used within a loop. 
 * 
 * */
 function more($class = ""){
    return '<a class="more '.$class.'" href="'. get_permalink() . '">READ MORE</a>';
 }
 
 /**
  * function get page id with title
  * get the page id of a page through its title
  * */
  function get_page_id_with_title($title) {
    $page = get_page_by_title($title);
    return $page->ID;
    }
?>