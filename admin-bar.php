<?php

/**
 * function vpm_admin_bar_remove
 * Remove the WordPress menu from the admin bar.
 *
 * This will remove the WordPress logo from the admin bar; you
 * may wish to add your own alternative menu in its place.
 *
 * @since 1.0
 */
function my_admin_bar_remove() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_node('wp-logo');
}
add_action('wp_before_admin_bar_render', 'vmy_admin_bar_remove');
