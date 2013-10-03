<?php

//Add Thumbnail Support
add_theme_support( 'post-thumbnails' );

//add image sizes
add_image_size( 'homepage', '797', '302');
add_image_size( 'homepage-top', '721', '192');

//Register the menu areas
register_nav_menu( 'primary', 'Primary Menu' );
register_nav_menu( 'footer_one', 'Footer One Menu' );
register_nav_menu( 'footer_two', 'Footer Two Menu' );
register_nav_menu( 'footer_three', 'Footer Three Menu' );
register_nav_menu( 'footer_four', 'Footer Four Menu' );

//widget support for right sidebar
register_sidebar(array(
  'name' => 'Right SideBar',
  'id' => 'right-sidebar',
  'description' => 'Widgets in this area will be shown on the right-hand side.',
  'before_widget' => '<div id="%1$s">',
  'after_widget'  => '</div>',  
  'before_title' => '<h4>',
  'after_title' => '</h4>'
));

//widget support for the header sidebar
register_sidebar(array(
  'name' => 'Header SideBar',
  'id' => 'header-sidebar',
  'description' => 'Widgets in this area will be shown on header.',
  'before_widget' => '',
  'after_widget'  => '',  
  'before_title' => '<h4>',
  'after_title' => '</h4>'
));

//widget support for the homepage news section
register_sidebar(array(
  'name' => 'Homepage News Section',
  'id' => 'homepage_news_section',
  'description' => 'Widgets in this area will be shown on the homepage news section.',
  'before_widget' => '',
  'after_widget'  => '',  
  'before_title' => '<h4>',
  'after_title' => '</h4>'
));

//widget support for the homepage box Advert
register_sidebar(array(
  'name' => 'Homepage Box Advert',
  'id' => 'homepage_box_advert',
  'description' => 'Widgets in this area will be shown on the homepage third box.',
  'before_widget' => '',
  'after_widget'  => '',  
  'before_title' => '<h4>',
  'after_title' => '</h4>'
));

//widget support for the homepage slider sidebar
register_sidebar(array(
  'name' => 'Homepage Slider Sidebar',
  'id' => 'homepage_slider_sidebar',
  'description' => 'Widgets in this area will be shown on the homepage slider sidebar.',
  'before_widget' => '',
  'after_widget'  => '',  
  'before_title' => '<h4>',
  'after_title' => '</h4>'
));

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="more" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//The Slider
function set_flexslider_hg_rotators( $rotators = array() )
{
    $rotators['homepage']         = array( 'size' => 'homepage', 'heading_tag' => 'h1', 'options' => "{slideshowSpeed: 7000, direction: 'horizontal'}" );
    $rotators['homepage-top']         = array( 'size' => 'homepage-top', 'heading_tag' => 'h1', 'options' => "{slideshowSpeed: 7000, direction: 'horizontal'}" );
 
    return $rotators;
}
add_filter('flexslider_hg_rotators', 'set_flexslider_hg_rotators');

function ajax($category,$no_of_post = 1){
    $c = 0;
query_posts('post_type=shoutout&showposts='.$no_of_post.'');

echo '<ul>';
while (have_posts()) : the_post();
$c++;
echo "<li class=";
if($c == 1){echo 'first';} if($c == 2){echo 'second';} if($c == 3){echo 'last';}
echo " style=\"width: 100%; height: 22px; right: -960px;\">
<span>";
$cont = get_the_content();
$contr = strip_tags($cont);
	echo $contr; echo ' - '; the_title();
echo '</span>
</li>';
endwhile;
echo '</ul>';
wp_reset_query();
 }
 
function ajax2($category,$no_of_post = 1){
echo '<ul>';
query_posts('post_type=text-messages&showposts='.$no_of_post.'');
while (have_posts()) : the_post();
echo '	<li>';
		the_content();
echo '	</li>';
endwhile;
echo '</ul>';
wp_reset_query();
 }
 
function do_insert($title,$description) {	

if(!empty($title) && !empty($description)){
    
		//$tags = trim( 'shoutouts' );
		// Get the array of selected categories as multiple cats can be selected
		//$cat = array( 13 );
		
		// Add the content of the form to $post as an array
		$post = array(
			'post_title'	=> $title,
			'post_content'	=> $description,
			//'post_category'	=> $cat, // Usable for custom taxonomies too
			//'tags_input'	=> $tags,
			'post_status'	=> 'pending',//'publish', // Choose: publish, preview, future, etc.
			'post_type'		=> 'shoutout' // Set the post type based on the IF is post_type X
		);
		$status = wp_insert_post($post);  // Pass  the value of $post to WordPress the insert function
								// http://codex.wordpress.org/Function_Reference/wp_insert_post
	return $status;
    
    }
}

// Do the wp_insert_post action to insert it
//do_action('wp_insert_post', 'do_insert');

function create_post_types() {
  $labels = array(
    'name' => 'Podcasts',
    'singular_name' => 'Podcast',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Podcast',
    'edit_item' => 'Edit Podcast',
    'new_item' => 'New Podcast',
    'all_items' => 'All Podcasts',
    'view_item' => 'View Podcast',
    'search_items' => 'Search Podcasts',
    'not_found' =>  'No Podcasts found',
    'not_found_in_trash' => 'No Podcasts found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Podcasts'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'podcast' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    'menu_icon' => get_template_directory_uri().'/images/podcast_ico.png'
  ); 

  register_post_type( 'sm_podcast', $args );
  
    $labels = array(
    'name' => 'Text Messages',
    'singular_name' => 'Text Message',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Text Message',
    'edit_item' => 'Edit Text Message',
    'new_item' => 'New Text Message',
    'all_items' => 'All Text Messages',
    'view_item' => 'View Text Message',
    'search_items' => 'Search Text Messages',
    'not_found' =>  'No Text Messages found',
    'not_found_in_trash' => 'No Text Messages found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Text Messages'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'text-message' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'editor' ),
    'menu_icon' => get_template_directory_uri().'/images/text_ico.png'
  ); 

  register_post_type( 'text-messages', $args );
  
    $labels = array(
    'name' => 'Shoutouts',
    'singular_name' => 'Shoutout',
    'add_new' => 'Add New',
    'add_new_item' => 'Name',
    'edit_item' => 'Edit shoutout',
    'new_item' => 'New shoutout',
    'all_items' => 'All shoutouts',
    'view_item' => 'View shoutout',
    'search_items' => 'Search shoutouts',
    'not_found' =>  'No shoutouts found',
    'not_found_in_trash' => 'No shoutouts found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Shoutouts'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'shoutout' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor' ),
    'menu_icon' => get_template_directory_uri().'/images/shoutout_ico.png'
  ); 

  register_post_type( 'shoutout', $args );
  
    $labels = array(
    'name' => 'Shows',
    'singular_name' => 'Show',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New show',
    'edit_item' => 'Edit show',
    'new_item' => 'New show',
    'all_items' => 'All shows',
    'view_item' => 'View show',
    'search_items' => 'Search shows',
    'not_found' =>  'No shows found',
    'not_found_in_trash' => 'No shows found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Shows'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'show' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    'menu_icon' => get_template_directory_uri().'/images/show_ico.png'
  ); 

  register_post_type( 'show', $args );
  
    $labels = array(
    'name' => 'Presenters',
    'singular_name' => 'Presenter',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New presenter',
    'edit_item' => 'Edit presenter',
    'new_item' => 'New presenter',
    'all_items' => 'All presenters',
    'view_item' => 'View presenter',
    'search_items' => 'Search presenters',
    'not_found' =>  'No presenters found',
    'not_found_in_trash' => 'No presenters found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Presenters'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'presenter' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    'menu_icon' => get_template_directory_uri().'/images/presenter_ico.png'
  ); 

  register_post_type( 'sm_presenter', $args );
  flush_rewrite_rules();
}
add_action( 'init', 'create_post_types' );

add_action( 'init', 'create_taxonomies', 0 );
function create_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
        	$labels = array(
		'name'              => _x( 'Days', 'taxonomy general name' ),
		'singular_name'     => _x( 'Day', 'taxonomy singular name' ),
		'search_items'      => __( 'Search days' ),
		'all_items'         => __( 'All days' ),
		'parent_item'       => __( 'Parent day' ),
		'parent_item_colon' => __( 'Parent day:' ),
		'edit_item'         => __( 'Edit day' ),
		'update_item'       => __( 'Update day' ),
		'add_new_item'      => __( 'Add New day' ),
		'new_item_name'     => __( 'New day Name' ),
		'menu_name'         => __( 'Days' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'day' ),
	);
    
    register_taxonomy( 'weekday', array( 'show' ), $args );  
    
            	$labels = array(
		'name'              => _x( 'Days', 'taxonomy general name' ),
		'singular_name'     => _x( 'Day', 'taxonomy singular name' ),
		'search_items'      => __( 'Search days' ),
		'all_items'         => __( 'All days' ),
		'parent_item'       => __( 'Parent day' ),
		'parent_item_colon' => __( 'Parent day:' ),
		'edit_item'         => __( 'Edit day' ),
		'update_item'       => __( 'Update day' ),
		'add_new_item'      => __( 'Add New day' ),
		'new_item_name'     => __( 'New day Name' ),
		'menu_name'         => __( 'Days' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'published-day' ),
	);
    
    register_taxonomy( 'sm-podday', array( 'sm_podcast' ), $args );  
    
                	$labels = array(
		'name'              => _x( 'Months', 'taxonomy general name' ),
		'singular_name'     => _x( 'Month', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Months' ),
		'all_items'         => __( 'All Months' ),
		'parent_item'       => __( 'Parent Month' ),
		'parent_item_colon' => __( 'Parent Month:' ),
		'edit_item'         => __( 'Edit Month' ),
		'update_item'       => __( 'Update Month' ),
		'add_new_item'      => __( 'Add New Month' ),
		'new_item_name'     => __( 'New Month Name' ),
		'menu_name'         => __( 'Months' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'published-month' ),
	);
    
    register_taxonomy( 'sm-podmonth', array( 'sm_podcast' ), $args );  
    
                    	$labels = array(
		'name'              => _x( 'Years', 'taxonomy general name' ),
		'singular_name'     => _x( 'Year', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Years' ),
		'all_items'         => __( 'All Years' ),
		'parent_item'       => __( 'Parent Year' ),
		'parent_item_colon' => __( 'Parent Year:' ),
		'edit_item'         => __( 'Edit Year' ),
		'update_item'       => __( 'Update Year' ),
		'add_new_item'      => __( 'Add New Year' ),
		'new_item_name'     => __( 'New Year Name' ),
		'menu_name'         => __( 'Years' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'published-year' ),
	);
    
    register_taxonomy( 'sm-podyear', array( 'sm_podcast' ), $args );  
    
                        	$labels = array(
		'name'              => _x( 'Shows', 'taxonomy general name' ),
		'singular_name'     => _x( 'Show', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Shows' ),
		'all_items'         => __( 'All Shows' ),
		'parent_item'       => __( 'Parent Show' ),
		'parent_item_colon' => __( 'Parent Show:' ),
		'edit_item'         => __( 'Edit Show' ),
		'update_item'       => __( 'Update Show' ),
		'add_new_item'      => __( 'Add New Show' ),
		'new_item_name'     => __( 'New Show Name' ),
		'menu_name'         => __( 'Shows' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'podcast-show' ),
	);
    
    register_taxonomy( 'sm-podshow', array( 'sm_podcast','show' ), $args );  
    
        	$labels = array(
		'name'              => _x( 'Times (Format: 00:00AM)', 'taxonomy general name' ),
		'singular_name'     => _x( 'Time (Format: 00:00AM)', 'taxonomy singular name' ),
		'search_items'      => __( 'Search times' ),
		'all_items'         => __( 'All times' ),
		'parent_item'       => __( 'Parent time' ),
		'parent_item_colon' => __( 'Parent time:' ),
		'edit_item'         => __( 'Edit time' ),
		'update_item'       => __( 'Update time' ),
		'add_new_item'      => __( 'Add New time (Format: 00:00AM)' ),
		'new_item_name'     => __( 'New time Name (Format: 00:00AM)' ),
		'menu_name'         => __( 'Times' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'time' ),
	);

	register_taxonomy( 'time', array( 'show' ), $args );  
    
    	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Genres' ),
		'all_items'         => __( 'All Genres' ),
		'parent_item'       => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item'         => __( 'Edit Genre' ),
		'update_item'       => __( 'Update Genre' ),
		'add_new_item'      => __( 'Add New Genre' ),
		'new_item_name'     => __( 'New Genre Name' ),
		'menu_name'         => __( 'Genres' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'section', array( 'sm_podcast' ), $args );   
    
        	$labels = array(
		'name'              => _x( 'Titles', 'taxonomy general name' ),
		'singular_name'     => _x( 'Title', 'taxonomy singular name' ),
		'search_items'      => __( 'Search titles' ),
		'all_items'         => __( 'All titles' ),
		'parent_item'       => __( 'Parent title' ),
		'parent_item_colon' => __( 'Parent title:' ),
		'edit_item'         => __( 'Edit title' ),
		'update_item'       => __( 'Update title' ),
		'add_new_item'      => __( 'Add New title' ),
		'new_item_name'     => __( 'New title Name' ),
		'menu_name'         => __( 'Titles' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'title' ),
	);

	register_taxonomy( 'title', array( 'text-messages' ), $args );   
    
   	$labels = array(
		'name'              => _x( 'Presenters', 'taxonomy general name' ),
		'singular_name'     => _x( 'Presenter', 'taxonomy singular name' ),
		'search_items'      => __( 'Search presenters' ),
		'all_items'         => __( 'All presenters' ),
		'parent_item'       => __( 'Parent presenter' ),
		'parent_item_colon' => __( 'Parent presenter:' ),
		'edit_item'         => __( 'Edit presenter' ),
		'update_item'       => __( 'Update presenter' ),
		'add_new_item'      => __( 'Add New presenter' ),
		'new_item_name'     => __( 'New presenter Name' ),
		'menu_name'         => __( 'Presenters' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'presenters' ),
	);

	register_taxonomy( 'showpresenter', array( 'sm_presenter','show' ), $args );   
    flush_rewrite_rules();
    }
    
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

//reduce the excerpt lenght
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * @name the_show_header
 * @author Olanipekun Olufemi
 * @copyright GPL V3
 * */
 function the_show_header(){
    date_default_timezone_set('Africa/Lagos');
    $currentDate = getdate();
    query_posts('post_type=show&weekday='.strtolower($currentDate['weekday']).'');
    while (have_posts()) : the_post();
    global $post;
    $times = wp_get_post_terms( $post->ID, 'time' );
    $taa = count($times);
    for($t = 0; $t < $taa; $t++){
        $ar_time[] = strtoupper($times[$t]->name);
    }
    foreach($ar_time as $time_){
        $split = explode('-',$time_);
        $singletime['start'] = strtotime(trim($split[0]));
        $singletime['end'] = strtotime(trim($split[1]));
        $currentTime = strtotime(date('h:iA'));
    }
    if(($singletime['start'] <= $currentTime) && ($currentTime <= $singletime['end'])  ){
               echo '<a href="#" onclick="livePlayer();" title="'.get_the_title().'"><img src="'.get_field('header_image').'" /></a>';
               return true;
         }
    unset($singletime,$ar_time,$currentTime,$split,$taa,$times);
    endwhile;
    wp_reset_query();
}


/**
 * @name the_show_sidebar
 * @author Olanipekun Olufemi
 * @copyright GPL V3
 * */
 function the_show_sidebar(){
    date_default_timezone_set('Africa/Lagos');
    $currentDate = getdate();
    query_posts('post_type=show&weekday='.strtolower($currentDate['weekday']).'');
    while (have_posts()) : the_post();
    global $post;
    $times = wp_get_post_terms( $post->ID, 'time' );
    $taa = count($times);
    for($t = 0; $t < $taa; $t++){
        $ar_time[] = strtoupper($times[$t]->name);
    }
    foreach($ar_time as $time_){
        $split = explode('-',$time_);
        $singletime['start'] = strtotime(trim($split[0]));
        $singletime['end'] = strtotime(trim($split[1]));
        $currentTime = strtotime(date('h:iA'));
    }
    if(($singletime['start'] <= $currentTime) && ($currentTime <= $singletime['end'])  ){
               echo '<a href="#" onclick="livePlayer();" title="'.get_the_title().'"><img src="'.get_field('side_image').'" /></a>';
               return true;
         }
    unset($singletime,$ar_time,$currentTime,$split,$taa,$times);
    endwhile;
    wp_reset_query();
}

//some lazy work
function thethemelocaton(){
    return get_template_directory_uri();
}

add_shortcode( 'theme_folder', 'thethemelocaton' );
add_shortcode( 'now_playing', 'the_show_sidebar' );

?>