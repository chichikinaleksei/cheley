<?php
/**
 * Image Composition Block - full width partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$fields = get_sub_field( 'fluid_full_width_fields' );
$img    = $fields['image'];

if ( ! empty( $fields ) ) :
	$img_id = $fields['image'];

	if ( ! empty( $img_id ) ) :
		$img       = wp_get_attachment_image( $img_id, 'large' );
		$img_capt  = wp_get_attachment_caption( $img_id );
		$col_class = 'col-12';
		?>
		<div class="row fluid-full">
			<div class="<?php echo is_admin() ? esc_attr( 'editor-full-width ' ) : esc_attr( '' ); ?><?php esc_attr_e( $col_class ); ?>">
				<figure class="block-img-single"><?php echo wp_kses_post( $img ); ?>
					<?php if ( $img_capt ) : ?>
						<figcaption class="wp-caption-text"><?php esc_html_e( $img_capt ); ?></figcaption>
					<?php endif; ?>
				</figure>
			</div>
		</div>
		<?php
	endif;
endif;
