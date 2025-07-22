<?php
/**
 * Image Composition Block - 2 half partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$fields = get_sub_field( 'fluid_5050_fields' );

if ( ! empty( $fields ) ) :
	$img_left_id    = $fields['image_left'];
	$img_right_id   = $fields['image_right'];
	$img_left       = wp_get_attachment_image( $img_left_id, 'standard-width-block' );
	$img_right      = wp_get_attachment_image( $img_right_id, 'standard-width-block' );
	$img_capt       = wp_get_attachment_caption( $img_left_id );
	$img_capt_right = wp_get_attachment_caption( $img_right_id );

	$col_class = 'col-12 col-md-6';
	?>
	<div class="row fluid-half">
		<?php if ( ! empty( $img_left_id ) ) : ?>
			<div class="<?php esc_attr_e( $col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_left ); ?>
				<?php if ( $img_capt ) : ?>
					<figcaption class="wp-caption-text"><?php esc_html_e( $img_capt ); ?></figcaption>
				<?php endif; ?>
				</figure>
			</div>
			<?php
		endif;
		if ( ! empty( $img_right_id ) ) :
			?>
			<div class="<?php esc_attr_e( $col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_right ); ?>
				<?php if ( $img_capt_right ) : ?>
					<figcaption class="wp-caption-text"><?php esc_html_e( $img_capt_right ); ?></figcaption>
				<?php endif; ?>
				</figure>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;
