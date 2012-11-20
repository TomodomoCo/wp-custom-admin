<?php

/**
 * function my_remove_dashboard_widgets
 * Unset dashboard widgets
 *
 * @author chrisvanpatten
 */
function my_remove_dashboard_widgets() {
	// Left column
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );

	// Right column
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}
add_action('wp_dashboard_setup', 'my_remove_dashboard_widgets' );

/**
 * function my_blog_rss_output
 * Build an RSS feed widget
 *
 * @author chrisvanpatten
 */
function my_blog_rss_output() {
	echo '<div class="rss-widget">';

	wp_widget_rss_output( array(
		'url'          => 'http://www.website.com/path/to/feed/',
		'title'        => 'Widget Title',
		'items'        => 2, // Number of items to display
		'show_summary' => 1, // Boolean: show article excerpt
		'show_author'  => 1, // Boolean: show article author
		'show_date'    => 1, // Boolean: show article date
	) );

	echo "</div>";
}

/**
 * function my_blog_rss_widget
 * Display the RSS widget you built above
 *
 * @author chrisvanpatten
 */
function my_blog_rss_widget() {
	add_meta_box( 'my-blog-rss', 'Widget Title', 'my_blog_rss_output', 'dashboard', 'side', 'high' );
}
add_action('wp_dashboard_setup', 'my_blog_rss_widget');

/**
 * function my_custom_right_now_widget
 * Add Custom Post Types and Taxonomies to the 'Right Now' Dashboard Widget
 *
 * @link http://wpsnipp.com/index.php/functions-php/include-custom-post-types-in-right-now-admin-dashboard-widget/
 */
function my_custom_right_now_widget() {
	$args = array(
		'public'   => true,
		'_builtin' => false,
	);
	$output   = 'object';
	$operator = 'and';
	
	$post_types = get_post_types( $args , $output , $operator );
	foreach( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num       = number_format_i18n( $num_posts->publish );
		$text      = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$num  = "<a href = 'edit.php?post_type = $post_type->name'>$num</a>";
			$text = "<a href = 'edit.php?post_type = $post_type->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
		echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
	}

	$taxonomies = get_taxonomies( $args , $output , $operator ); 
	foreach( $taxonomies as $taxonomy ) {
		$num_terms = wp_count_terms( $taxonomy->name );
		$num       = number_format_i18n( $num_terms );
		$text      = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ));
		if ( current_user_can( 'manage_categories' ) ) {
			$num  = "<a href = 'edit-tags.php?taxonomy = $taxonomy->name'>$num</a>";
			$text = "<a href = 'edit-tags.php?taxonomy = $taxonomy->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
		echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
	}
}
add_action( 'right_now_content_table_end' , 'my_custom_right_now_widget' );
