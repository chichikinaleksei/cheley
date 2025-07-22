<?php
/**
 * Allow only certain core blocks.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Allow only certain core blocks.
 *
 * Gets a list of registered ACF blocks and combines that with a list of allowed core blocks.
 *
 * @param  array $allowed_blocks The current allowed blocks.
 * @return array The modified list of allowed blocks.
 */
function e29_allowed_block_types_all( $allowed_blocks ) {
	$acf_blocks = acf_get_block_types();
	$acf_blocks = array_keys( $acf_blocks );

	$allowed_core_blocks = array(
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/list',
		// phpcs:disable
		'core/quote',
		// 'core/table',
		// 'core/freeform',
		// 'core/pullquote',
		// phpcs:enable
		'core/separator',
		'core/shortcode',
		'core/embed',
		'core/block',
		'gravityforms/form',
		'core/html',
	);

	// phpcs:disable
	// ToDO:
	// - add Gravity Form support
	// - add The events Calendar support
	// - add Tablepress Support
	// phpcs:enable

	$allowed_blocks = array_merge( $acf_blocks, $allowed_core_blocks );

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'e29_allowed_block_types_all', 10, 2 );
