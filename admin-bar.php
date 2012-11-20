<?php

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
