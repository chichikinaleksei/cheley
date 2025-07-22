<?php
/**
 * Add custom WYSIWYG editor buttons for admin panel.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Set up filters for TinyMCE.
 */
function editor_buttons() {
	// TODO: is this necessary to be inside an action?
	add_filter( 'mce_external_plugins', 'editor_add_buttons' );
	add_filter( 'mce_buttons', 'editor_register_buttons' );
}
add_action( 'init', 'editor_buttons' );

/**
 * Define the JS file for TinyMCE configuration.
 *
 * @param array $plugin_array An array of external TinyMCE plugins.
 */
function editor_add_buttons( $plugin_array ) {
	$plugin_array['default_theme'] = get_template_directory_uri() . '/includes/editor-buttons/editor-buttons-plugin.js';
	return $plugin_array;
}

/**
 * Add buttons to TinyMCE editor.
 *
 * @param array $buttons First-row list of buttons.
 */
function editor_register_buttons( $buttons ) {
	array_push( $buttons, 'images', 'elements', 'columns' );
	return $buttons;
}

/**
 * Get a list of custom posts provided a post type.
 */
function get_custom_posts_list() {
	// TODO: What is this? Do we need this? If we keep it we need to verify nonce.
	$args       = array(
		'post_type' => isset( $_POST['post_type'] ) ? sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) : 'post', // phpcs:ignore WordPress.Security.NonceVerification.Missing
	);
	$posts      = get_posts( $args );
	$posts_list = array();

	foreach ( $posts as $post ) {
		$posts_list[] = array(
			'text'  => $post->post_title,
			'value' => $post->ID,
		);
	}
	wp_send_json( $posts_list );
}
add_action( 'wp_ajax_get_custom_posts_list', 'get_custom_posts_list' );
add_action( 'wp_ajax_nopriv_get_custom_posts_list', 'get_custom_posts_list' );
