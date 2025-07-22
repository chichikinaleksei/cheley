<?php
/**
 * Add CSS & JS from ACF Block
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Add block css
 *
 * @param  string $block_name Block name.
 * @param  array  $css_deps_elements Name of registered stylesheet.
 */
function add_block_css( $block_name, $css_deps_elements = '' ) {
	$css_deps           = array_filter( array_merge( array( 'theme-styles' ), explode( ',', $css_deps_elements ) ) );
	$main_css_directory = get_template_directory() . '/acf-blocks/' . $block_name . '/dist/style.css';
	$main_css           = get_template_directory_uri() . '/acf-blocks/' . $block_name . '/dist/style.css';

	if ( file_exists( $main_css_directory ) && ! is_admin() ) {
		wp_enqueue_style( $block_name . '-style', $main_css, $css_deps, filemtime( $main_css_directory ) );

	}
}

/**
 * Add block js
 *
 * @param  string $block_name Block name.
 * @param  array  $js_deps_elements Name of registered script.
 */
function add_block_js( $block_name, $js_deps_elements = '' ) {
	$js_deps           = array_filter( array_merge( array( 'jquery' ), explode( ',', $js_deps_elements ) ) );
	$main_js_directory = get_template_directory() . '/js/dist/' . $block_name . '.js';
	$main_js           = get_template_directory_uri() . '/js/dist/' . $block_name . '.js';

	if ( file_exists( $main_js_directory ) && ! is_admin() ) {
		wp_enqueue_script( $block_name . '-script', $main_js, $js_deps, filemtime( $main_js_directory ), false );
	}
}
