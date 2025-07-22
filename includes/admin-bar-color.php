<?php
/**
 * Utility to change adminbar color based on environment.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Utility to change adminbar color based on environment
 *
 * @return void
 */
function admin_bar_color() {
	if ( ! function_exists( 'env' ) ) {
		return;
	}

	if ( env( 'WP_ENV' ) === 'development' ) {
		echo '<style>#wpadminbar {background: #650100;}</style>';
	}

	if ( env( 'WP_ENV' ) === 'staging' ) {
		echo '<style>#wpadminbar {background: #0d4b00;}</style>';
	}
}
add_action( 'wp_head', 'admin_bar_color' );
add_action( 'admin_head', 'admin_bar_color' );
