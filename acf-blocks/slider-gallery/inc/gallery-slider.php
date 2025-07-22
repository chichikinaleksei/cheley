<?php
/**
 * Slider Gallery block - slider partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$captions_modifier = false;
if ( ! $flexible_widths ) {
	foreach ( $gallery as $slide ) {
		if ( ! empty( $slide['caption'] ) ) {
			$captions_modifier = ' gallery-slider--has-captions';
			break;
		}
	}
}
?>

<div class="gallery-slider
<?php
echo $is_fluid ? ' gallery-slider--fluid' : '';
esc_attr_e( $captions_modifier );
?>
">
	<div class="container<?php echo $is_fluid ? '-fluid-slider' : ''; ?>">
		<div class="gallery-slider__slider<?php echo $is_fluid ? '-fluid' : ''; ?>">
			<?php
			foreach ( $gallery as $slide ) {
				$image_size    = $flexible_widths ? 'slider-image-flexible' : 'slider-image-hard';
				$slide_img     = wp_get_attachment_image( $slide['image'], $image_size );
				$slide_caption = $slide['caption'];

				if ( ! empty( $slide_img ) ) :
					?>
					<div class="gallery-slider__single-slide">
						<figure class="gallery-slider__image">
							<div class="gallery-slider__image-container">
								<?php echo wp_kses_post( $slide_img ); ?>
							</div>
							<?php if ( ! empty( $slide_caption ) && ! $flexible_widths ) : ?>
								<figcaption class="gallery-slider__caption"><?php esc_html_e( $slide_caption ); ?></figcaption>
							<?php endif; ?>
						</figure>
					</div>
					<?php
				endif;
			}
			?>
		</div>
	</div>
</div>
