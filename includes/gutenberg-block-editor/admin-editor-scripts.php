<?php
/**
 * Enqueue scripts for the Block Editor.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Enqueue Block Editor scripts.
 */
function enqueue_block_editor_assets() {
	wp_enqueue_style(
		'editor-styles',
		get_template_directory_uri() . '/css/dist/editor.css',
		array( 'wp-edit-blocks' ),
		filemtime( get_template_directory() . '/css/dist/editor.css' )
	);
	wp_enqueue_script(
		'remove-formats',
		get_template_directory_uri() . '/js/dist/remove-formats.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( get_template_directory() . '/js/dist/remove-formats.js' ),
		true
	);
	wp_enqueue_script(
		'highlight-text',
		get_template_directory_uri() . '/js/dist/highlight-text.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( get_template_directory() . '/js/dist/highlight-text.js' ),
		true
	);
	wp_enqueue_script(
		'icon-list',
		get_template_directory_uri() . '/js/dist/icon-list.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( get_template_directory() . '/js/dist/icon-list.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'enqueue_block_editor_assets' );
