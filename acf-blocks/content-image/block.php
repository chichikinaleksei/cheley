<?php
/**
 * Block fluid with content and image
 *
 * Title:       Content & Image
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

$main_sect_class[] = 'acf-block';
$main_sect_class[] = 'block-content-image';
$block_img         = wp_get_attachment_image( get_field( 'block_image' ), 'full-width-block' );


$container_bool     = get_field( 'display_in_container' );
$container_class    = 'container-fluid';
$aligment           = get_field( 'block_image_alignment' );
$photo_texture_bool = get_field( 'block_photo_texture' );
$img_texture_class  = $photo_texture_bool ? 'img-textured' : '';
$single_col_class   = 'b-content-images__col col-12';
$single_col_wide    = 'col-xl-6 col-lg-6 image-right order-first order-lg-last ';
$single_col_short   = 'col-lg-6 content-left order-last order-lg-first';

if ( 'left' === $aligment ) {
	$single_col_wide  = 'col-xl-6 col-lg-6 image-left order-first';
	$single_col_short = 'col-lg-6 content-right order-last';
}


if ( $container_bool ) {
	$container_class   = 'container';
	$main_sect_class[] = 'has-container';
	$single_col_wide   = 'col-lg-6 image-right order-first order-lg-last';
	$single_col_short  = 'col-lg-6 content-left order-last order-lg-first';
	$block_img         = wp_get_attachment_image( get_field( 'block_image' ), 'standard-width-block' );
	if ( 'left' === $aligment ) {
		$single_col_wide  = 'col-lg-6 image-left order-first';
		$single_col_short = 'col-lg-6 content-right order-last';
	}
}

$sect_bg    = get_field( 'block_background_color' );
$attr_style = '';
if ( ! empty( $sect_bg ) ) {
	$attr_style .= 'background-color:' . $sect_bg . ';';
}
$sect_bg_img = get_field( 'block_background_image_pattern' );
if ( ! empty( $sect_bg_img ) ) {
	$attr_style .= 'background-image: url(' . $sect_bg_img . ')';
}
?><section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="<?php esc_attr_e( implode( ' ', $main_sect_class ) ); ?>" style="<?php esc_attr_e( $attr_style ); ?>">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="<?php esc_attr_e( $container_class ); ?>">
		<div class="row align-items-center">
			<div class="<?php esc_attr_e( $single_col_class . ' ' . $single_col_short . ' b-content-images__col-text' ); ?>">
				<div class="b-content-images__content-wrapper">
					<?php the_field( 'block_content' ); ?>
				</div>
			</div>
			<div class="<?php esc_attr_e( $single_col_class . ' ' . $single_col_wide . ' b-content-images__col-img' ); ?>">
				<figure class="<?php esc_attr_e( 'b-content-images__image ' . $img_texture_class ); ?>"><?php echo wp_kses_post( $block_img ); ?></figure>
			</div>
		</div>
	</div>
</section>
<?php
