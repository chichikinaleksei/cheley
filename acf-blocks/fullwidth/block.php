<?php
/**
 * Full width content block
 *
 * Title:       Author Callout
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    author, spotlight
 * Post Types:  all
 * Multiple:    true
 * Active:      false
 * CSS Deps:
 * JS Deps:
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$main_sect_class[] = 'acf-block block-fullwidth';

?><section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="<?php esc_attr_e( implode( ' ', $main_sect_class ) ); ?>">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="container-fluid">
		<?php the_field( 'content' ); ?>
	</div>
</section>
<?php
