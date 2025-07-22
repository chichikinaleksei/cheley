<?php
/**
 * Hook Block
 *
 * Title:       Hook (Anchor)
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        button
 * Keywords:    hook, anchor
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:
 * JS Deps:
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$main_block_class = 'block-hook';

$block_hook = get_field( 'anchor' ) ? get_field( 'anchor' ) : 'hook_missing';

if ( ! empty( $block_hook ) ) :
	?>
	<div id="<?php esc_attr_e( $block_hook ); ?>" class="<?php esc_attr_e( $main_block_class ); ?>">
		<?php
		if ( is_admin() ) {
			echo wp_kses_post( '<p><i>Hook: ' . $block_hook . ' (only displays in admin)</i></p>' );
		}
		?>
	</div>
	<?php
endif;
