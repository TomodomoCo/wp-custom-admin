<?php

/**
 * function my_remove_dashboard_widgets
 * Unset dashboard widgets
 *
 * @since 1.0
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
 * @since 1.0
 */
function my_blog_rss_output() {
	echo '<div class="rss-widget">';

	wp_widget_rss_output( array(
		'url' 			=> 'http://www.website.com/path/to/feed/',
		'title' 		=> 'Widget Title',
		'items' 		=> 2, // Number of items to display
		'show_summary' 	=> 1, // Boolean: show article excerpt
		'show_author' 	=> 1, // Boolean: show article author
		'show_date' 	=> 1, // Boolean: show article date
	) );

	echo "</div>";
}

/**
 * function my_blog_rss_widget
 * Display the RSS widget you built above
 *
 * @since 1.0
 */
function my_blog_rss_widget() {
	add_meta_box( 'my-blog-rss', 'Widget Title', 'my_blog_rss_output', 'dashboard', 'side', 'high' );
}
add_action('wp_dashboard_setup', 'my_blog_rss_widget');