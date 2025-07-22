<?php
/**
 * Block Full-Width Background
 *
 * Title:       Full-Width Background
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    full-width, background
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:
 * JS Deps:
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$background_image = ! empty( get_field( 'background_image' ) ) ? wp_get_attachment_image( get_field( 'background_image' ), 'full' ) : null;
$header           = get_field( 'header' );
$content          = get_field( 'content' );

if ( ! empty( $header ) || ! empty( $background_image ) || ! empty( $content ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-full-width-background">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<?php if ( ! empty( $background_image ) ) : ?>
			<figure class="block-full-width-background__image"><?php echo wp_kses_post( $background_image ); ?></figure>
		<?php endif; ?>
		<div class="container-fluid">
			<?php if ( ! empty( $header ) || ! empty( $content ) ) : ?>
				<div class="block-full-width-background__content">
					<?php if ( ! empty( $header ) ) : ?>
						<h2 class="block-full-width-background__title"><?php echo esc_html( $header ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $content ) ) : ?>
						<div class="block-full-width-background__text"><?php echo wp_kses_post( $content ); ?></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;
