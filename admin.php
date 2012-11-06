<?php

/**
 * Throw this in your wp-config.php to disable file editors.
 */
define( 'DISALLOW_FILE_EDIT', true

/**
 * function my_alert
 * Add a custom alert to the WordPress admin panel
 *
 * @since 1.0
 */
function my_alert() {
	echo '<div class="error">';
	echo '<p>Your alert message here.</p>';
	echo '</div>';
}
add_action('admin_notices', 'my_alert');

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