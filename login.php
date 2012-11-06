<?php

/**
 * function my_login_css
 * Custom CSS file for the admin panel and login page
 *
 * Enqueing isn't really working on the login page; this method
 * is more reliable. Hopefully this is fixed soon.
 *
 * @since 1.0
 */
function my_login_css() {
	echo '<link rel="stylesheet" type="text/css" href="/path/to/style.css" />';
}
add_action('login_head', 'my_login_css');

/**
 * function my_login_imgurl
 * Set the URL to which the login logo image is linked
 *
 * @since 1.0
 */
function my_login_imgurl() {
	return home_url();
}
add_filter( 'login_headerurl', 'my_login_imgurl');

/**
 * function my_login_imgtitle
 * Set the title of the login page
 *
 * @since 1.0
 */
function my_login_imgtitle() {
	return get_bloginfo('title', 'display');
}
add_filter( 'login_headertitle', 'my_login_imgtitle');