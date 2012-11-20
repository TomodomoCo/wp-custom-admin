<?php

/**
 * Throw this in your wp-config.php to disable file editors.
 */
define( 'DISALLOW_FILE_EDIT', true);

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
