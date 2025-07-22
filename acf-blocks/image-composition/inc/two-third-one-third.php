<?php
/**
 * Image Composition Block - 2/3 + 1/3 partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$fields = get_sub_field( 'fluid_23_and_13_fields' );

if ( ! empty( $fields ) ) :
	$img_large_id = $fields['image_large'];
	$img_small_id = $fields['image_small'];

	$img_large = wp_get_attachment_image( $img_large_id, 'large' );
	$img_small = wp_get_attachment_image( $img_small_id, 'standard-width-block' );

	$small_col_pos = $fields['small_image_pos'];

	$first_col_class = 'col-12 col-md-4';
	$last_col_class  = 'col-12 col-md-8';
	if ( 'right' === $small_col_pos ) {
		$first_col_class .= ' order-last';
		$last_col_class  .= ' order-first';
	}

	?>
	<div class="row fluid-two-small">
		<?php if ( ! empty( $img_small_id ) ) : ?>
			<div class="<?php esc_attr_e( $first_col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_small ); ?></figure>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $img_large_id ) ) : ?>
			<div class="<?php esc_attr_e( $last_col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_large ); ?></figure>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;
