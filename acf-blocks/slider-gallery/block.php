<?php
/**
 * Block with image gallery
 *
 * Title:       Slider Gallery
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    author, spotlight
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:    slick
 * JS Deps:     slick
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$gallery         = '';
$gallery_id      = get_field( 'gallery' );
$gallery_type    = get_field( 'gallery_type' );
$flexible_widths = get_field( 'flexible_widths' );
$flexible_class  = $flexible_widths ? 'flexible' : 'hard';

$is_fluid = get_field( 'fluid' );
if ( $flexible_widths ) {
	$is_fluid = true;
}

if ( ! empty( $gallery_id ) ) {
	$gallery        = get_field( 'gallery_slides', $gallery_id );
	$gallery_length = ! empty( $gallery ) ? count( $gallery ) : 0;
}

if ( ! empty( $gallery ) ) :
	?>
	<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-slider-gallery <?php esc_attr_e( $gallery_type . " block-slider-gallery--$flexible_class" ); ?>">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<?php if ( 'lightbox-gallery' === $gallery_type ) : ?>
			<div class="container">
				<div class="lightbox-gallery__thumbnails-wrapper">
					<div class="row">
						<?php for ( $i = 0; $i < $gallery_length; $i++ ) : ?>
							<a
								href="<?php echo '#' . esc_attr( $i ); ?>"
								data-slide-id="<?php echo esc_attr( $i ); ?>"
								class="lightbox-gallery__single-thumb col-6 col-md-4"
								aria-label="Lightbox Gallery Thumbnail"
								><?php echo wp_get_attachment_image( $gallery[ $i ]['image'], 'medium' ); ?></a
							>
						<?php endfor; ?>
					</div>
				</div>
			</div>

			<div class="lightbox-gallery__gallery-wrapper">
				<button class="lightbox-gallery__close">
					<span class="icon-clear"></span
					><span class="sr-only">Close video</span>
				</button>
				<?php include 'inc/gallery-slider.php'; ?>
			</div>

			<?php
		else :
			include 'inc/gallery-slider.php';
		endif;
		?>
	</section>
	<?php
endif;
