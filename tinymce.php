<?php

/**
 * function my_mce_buttons_1
 * Set the buttons for the top row in TinyMCE
 *
 * This example shows a custom row, altered from the WordPress
 * defaults I've included in a comment block below.
 *
 * A full list of buttons you can choose from is available at the
 * TinyMCE website: http://www.tinymce.com/wiki.php/Buttons/controls
 *
 * @since 1.0
 */
function my_mce_buttons_1( $buttons ) {
	return array(
		'styleselect', 'formatselect', 'separator',
		'bold', 'italic', 'separator',
		'bullist', 'numlist', 'separator',
		'link', 'unlink', 'separator',
		'undo', 'redo', 'removeformat', 'separator',
		'wp_more'
	);

	/* WordPress Default
	return array(
		'bold', 'italic', 'strikethrough', 'separator',
		'bullist', 'numlist', 'blockquote', 'separator',
		'justifyleft', 'justifycenter', 'justifyright', 'separator',
		'link', 'unlink', 'wp_more', 'separator',
		'spellchecker', 'fullscreen', 'wp_adv'
	); */
}
add_filter('mce_buttons', 'my_mce_buttons_1', 0);

/**
 * function my_mce_buttons_2
 * Set the buttons for the second row in TinyMCE
 *
 * This example shows how to disable the second row. The WordPress
 * defaults are in a comment block below.
 *
 * @since 1.0
 */
function my_mce_buttons_2( $buttons ) {
	return array();

	/* WordPress default
	return array(
		'formatselect', 'underline', 'justifyfull', 'forecolor', 'separator',
		'pastetext', 'pasteword', 'removeformat', 'separator',
		'media', 'charmap', 'separator',
		'outdent', 'indent', 'separator',
		'undo', 'redo', 'wp_help', 'styleselect'
	); */
}
add_filter('mce_buttons_2', 'my_mce_buttons_2', 0);

/**
 * function my_mce
 * Set custom styles and settings
 *
 * @since 1.0
 */
function my_mce( $settings ) {

	/**
	 * Set custom style formats in the style selector
	 * Read more: http://www.vanpattenmedia.com/2012/tinymce-wordpress-style-selector/
	 */
	$style_formats = array(
		array(
			'title'   => 'Pull Quote',
			'block'   => 'aside',
			'classes' => 'pull-quote',
			'wrapper' => true,
			'styles'  => array(
				'float'      => 'right',
				'width'      => '40%',
				'borderLeft' => '4px solid black',
				'margin'     => '0 0 0 20px',
				'padding'    => '0 0 0 15px',
				'fontStyle'  => 'italic'
			)
		),
		array(
			'title'    => 'Call to action',
			'selector' => 'div',
			'classes'  => 'cta-main',
			'wrapper'  => true,
		)
	);
	$settings['style_formats'] = json_encode( $style_formats );

	/**
	 * Determine which elements appear in the Format selector
	 * This option shows only `<h3>` enabled.
	 */
	$settings['theme_advanced_blockformats'] = 'h3';

	/**
	 * Return the settings to TinyMCE
	 */
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'my_mce' );