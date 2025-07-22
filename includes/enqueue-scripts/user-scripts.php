<?php
/**
 * User added scripts.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Register and enqueue scripts defined in `load_assets()`.
 *
 * @param string $acf_field_name The ACF field name.
 */
function user_scripts( $acf_field_name ) {
	$in_footer = 'footer_scripts' === $acf_field_name ? true : false;

	$field = get_field( $acf_field_name, 'option' );
	if ( ! empty( $field ) ) :
		while ( have_rows( $acf_field_name, 'option' ) ) :
			the_row();

			$script_name = get_sub_field( 'script_name' );
			$script_name = str_replace( ' ', '_', $script_name );
			$script_name = strtolower( $script_name );
			$script_type = get_sub_field( 'script_type' );

			if ( 'internal' === $script_type ) {
				$script = get_sub_field( 'internal_script' );
				wp_register_script( $script_name, '', '', '1.0', $in_footer );
				wp_enqueue_script( $script_name );
				wp_add_inline_script( $script_name, $script );
			} elseif ( 'external' === $script_type ) {
				$script = get_sub_field( 'external_script' );
				wp_enqueue_script( $script_name, $script, '', '1.0', $in_footer );
			}
	endwhile;
endif;
}

/**
 * Load assets as defined by the user in the WP admin.
 */
function load_assets() {
	user_scripts( 'header_scripts' );
	user_scripts( 'footer_scripts' );
}

add_action( 'wp_enqueue_scripts', 'load_assets' );
