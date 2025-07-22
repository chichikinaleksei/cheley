<?php
/**
 * Force the hero block as the first block on the page.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Force the hero block as the first block on the page.
 *
 * @return void
 */
function register_template() {
	$post_type_object = get_post_type_object( 'page' );

	$post_type_object->template = array(
		array( 'acf/hero' ),
	);
}
add_action( 'init', 'register_template' );
