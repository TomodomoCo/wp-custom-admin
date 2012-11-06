<?php

/**
 * function my_admin_footer
 * Rewrite the text in the bottom-left footer area
 *
 * @since 1.0
 */
function my_admin_footer() {
	echo 'Built by <a href="#">My Company</a> with <a href="http://wordpress.org">WordPress</a>. &bull; <a href="' . admin_url() . 'freedoms.php">Freedoms</a> &bull; <a href="' . admin_url() . 'credits.php">Credits</a>';
}
add_filter('admin_footer_text', 'my_admin_footer');