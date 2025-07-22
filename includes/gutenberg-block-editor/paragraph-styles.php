<?php
/**
 * Register Custom Block Styles
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles for paragrpahs
	 */
	function block_styles_register_block_styles() {
		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'body-2',
				'label' => 'Body 2',
			)
		);

		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'lead',
				'label' => 'Lead',
			)
		);

		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'lead-large-first-letter',
				'label' => 'Lead Large First Letter',
			)
		);

		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'subtitle',
				'label' => 'Subtitle',
			)
		);
	}

	add_action( 'init', 'block_styles_register_block_styles' );
}
