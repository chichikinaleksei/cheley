<?php
/**
 * Interact with ACF functionality.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Set brand colors for the color picker.
 */
function etn_acf_js_api() {
	wp_enqueue_script(
		'acf-js-api',
		get_template_directory_uri() . '/includes/acf-js-api/acf-js-api.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
		filemtime( get_template_directory() . '/includes/acf-js-api/acf-js-api.js' ),
		false
	);
}
add_action( 'enqueue_block_editor_assets', 'etn_acf_js_api' );
