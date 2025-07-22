<?php
/**
 * Block Side Content + Image Descriptions
 *
 * Title:       Side Content + Image Descriptions
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    side, content, image, descriptions
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

$header             = get_field( 'header' );
$text               = get_field( 'text' );
$image_descriptions = get_field( 'image_descriptions' );

if ( ! empty( $header ) || ! empty( $text ) || ! empty( $image_descriptions ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-side-content">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<div class="row">
				<?php if ( ! empty( $header ) || ! empty( $text ) ) : ?>
					<div class="col-12 col-lg-5 block-side-content__text-wrapper">
						<div class="block-side-content__text">
							<?php if ( ! empty( $header ) ) : ?>
								<h2 class="block-side-content__title"><?php echo esc_html( $header ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $text ) ) : ?>
								<div class="block-side-content__content"><?php echo wp_kses_post( $text ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $image_descriptions ) ) : ?>
					<div class="col-12 col-lg-7 block-side-content__descriptions">
					<?php
					foreach ( $image_descriptions as $item ) :
						$image   = wp_get_attachment_image( $item['image'], 'side-content-' . $item['orientation'] );
						$header  = $item['header'];
						$content = $item['content'];
						?>
						<div class="block-side-content__description block-side-content__description--<?php echo esc_attr( $item['orientation'] ); ?>">
							<?php if ( ! empty( $image ) ) : ?>
								<figure class="block-side-content__description-image"><?php echo wp_kses_post( $image ); ?></figure>
							<?php endif; ?>
							<?php if ( ! empty( $header ) || ! empty( $content ) ) : ?>
								<div class="block-side-content__description-content">
									<?php if ( ! empty( $header ) ) : ?>
										<h3 class="block-side-content__description-title"><?php echo esc_html( $header ); ?></h3>
									<?php endif; ?>
									<?php if ( ! empty( $content ) ) : ?>
										<div class="block-side-content__description-text"><?php echo wp_kses_post( $content ); ?></div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
						<?php
					endforeach;
					?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
