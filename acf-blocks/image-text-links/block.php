<?php
/**
 * Block for images & text links
 *
 * Title:       Image & Text Links
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    author, spotlight
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

$cards = get_field( 'cards' );
$text  = get_field( 'image_text_links_text' );
if ( ! empty( $cards ) ) :
	?>
<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-image-text-links">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="container">
	<?php if ( ! empty( $text ) ) : ?>
		<div class="block-image-text-links__text">
			<?php echo wp_kses_post( $text ); ?>
		</div>
	<?php endif; ?>
		<div class="block-image-text-links__cards">
			<div class="row justify-content-start">
			<?php
			foreach ( $cards as $item ) :
				$link_card  = $item['link'];
				$width      = $item['column_width'];
				$img_id     = $item['image'];
				$img        = wp_get_attachment_image( $img_id, 'text-image-link', false, 'data-object-fit' );
				$class      = 'block-image-links__col';
				$link_class = 'block-image-text-links__link';
				if ( ! empty( $img ) ) {
					$link_class .= ' link-image';
				}

				if ( $link_card ) :
					$link_title  = $link_card['title'];
					$link_url    = $link_card['url'];
					$link_target = $link_card['target'] ? 'target="_blank" rel="noopener"' : 'target="_self"';
					?>

				<div class="col-12 col-sm-6 col-lg-<?php esc_attr_e( $width ); ?>">
					<a class="block-image-text-links__block" href="<?php echo esc_url( $link_url ); ?>" <?php echo wp_kses_post( $link_target ); ?>>
					<?php if ( ! empty( $img ) ) : ?>
						<figure class="block-image-text-links__image-container">
							<?php echo wp_kses_post( $img ); ?>
						</figure>
					<?php endif; ?>
					<?php
					if ( ! empty( $link_title ) ) :
						?>
					<div class="<?php echo esc_attr( $link_class ); ?>">
						<?php esc_html_e( $link_title ); ?>
					</div>
						<?php
					endif;
					?>
					</a>
				</div>
					<?php
				endif;
			endforeach;
			?>
			</div>
		</div>
	</div>
</section>
	<?php
endif;
