<?php
/**
 * ACF Hooks & Filters
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Tell ACF to use wp_block as a post type.
 *
 * @param array $field       ACF field array.
 */
add_filter(
	'acf/get_post_types',
	function( $post_types ) {
		$post_types[] = 'wp_block';

		return $post_types;
	},
	PHP_INT_MAX
);
