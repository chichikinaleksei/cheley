<?php
/**
 * Content Section
 *
 * Title:       Content Section
 * Description: A stylelized block with inner blocks.
 * Category:    etn-blocks
 * Icon:        align-wide
 * Keywords:    content, section, innerblocks
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:
 * JS Deps:
 * InnerBlocks: true
 * Mode:        preview
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$template = array(
	array(
		'core/heading',
		array(
			'level'   => 2,
			'content' => 'Add heading here.',
		),
	),
	array(
		'core/paragraph',
		array(
			'content' => 'Add text or additional blocks here.',
		),
	),
);

$allowed_blocks = e29_allowed_block_types_all( array() );

$content_block = new Content_Block_Gutenberg( $block );

?>
<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-content-section">
	<InnerBlocks allowedBlocks="<?php esc_attr_e( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php esc_attr_e( wp_json_encode( $template ) ); ?>" />
</section>
<?php
