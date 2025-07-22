<?php
/**
 * Add to the main body class.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

add_filter(
	'body_class',
	function( $classes ) {

		// If page has the hide hero field and it's set to false.
		if ( ( is_singular() && false === get_field( 'hide_hero' ) ) || is_post_type_archive( 'library_block' ) ) {
			$classes[] = 'page-has-hero';
		}

		return $classes;
	}
);
