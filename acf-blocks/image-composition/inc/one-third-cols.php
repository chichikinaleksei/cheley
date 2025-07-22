<?php
/**
 * Image Composition Block - 3 thirds partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$fields = get_sub_field( 'fluid_13_columns_fields' );

if ( ! empty( $fields ) ) :
	$img_left_id   = $fields['image_left'];
	$img_middle_id = $fields['image_middle'];
	$img_right_id  = $fields['image_right'];

	$img_left   = wp_get_attachment_image( $img_left_id, 'medium' );
	$img_middle = wp_get_attachment_image( $img_middle_id, 'medium' );
	$img_right  = wp_get_attachment_image( $img_right_id, 'medium' );

	$col_class = 'col-12 col-md-4';
	?>
	<div class="row fluid-one-third">
		<?php if ( ! empty( $img_left_id ) ) : ?>
			<div class="<?php esc_attr_e( $col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_left ); ?></figure>
			</div>
			<?php
		endif;
		if ( ! empty( $img_left_id ) ) :
			?>
			<div class="<?php esc_attr_e( $col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_middle ); ?></figure>
			</div>
			<?php
		endif;
		if ( ! empty( $img_right_id ) ) :
			?>
			<div class="<?php esc_attr_e( $col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img_right ); ?></figure>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;
