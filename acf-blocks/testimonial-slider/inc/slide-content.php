<?php
/**
 * Testimonials slider block (post type) - testimonial partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

?>

<div class="testimonial-slider__content-wrapper row">
	<?php if ( ! empty( $testimonial['image'] ) ) : ?>
	<figure class="testimonial-slider__image">
		<?php echo wp_get_attachment_image( $testimonial['image'], 'testimonial' ); ?>
		<p class="testimonial-slider__image-caption"><?php esc_html_e( wp_get_attachment_caption( $testimonial['image'] ) ); ?></p>
	</figure>
	<?php endif ?>
	<div class="testimonial-slider__quote-wrapper">
		<div class="testimonial-slider__quote-icon icon-quote"></div>
		<blockquote class="testimonial-slider__quote">
			<?php echo wp_kses_post( $testimonial['quote'] ); ?>
			<footer>
				<?php if ( ! empty( $testimonial['name'] ) ) : ?>
					<cite class="testimonial-slider__name"><?php esc_html_e( $testimonial['name'] ); ?></cite>
				<?php endif; ?>

				<?php if ( ! empty( $testimonial['label'] ) ) : ?>
					<cite class="testimonial-slider__label"><?php esc_html_e( $testimonial['label'] ); ?></cite>
				<?php endif; ?>
			</footer>
		</blockquote>
	</div>
</div>
