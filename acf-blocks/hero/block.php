<?php
/**
 * Block for page Hero
 *
 * Title:       Hero
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

$hero_style             = get_field( 'image_style' );
$hero_heading           = ! empty( get_field( 'custom_title' ) ) ? get_field( 'custom_title' ) : get_the_title();
$description            = get_field( 'description' );
$thumbnail_id           = get_post_thumbnail_id();
$block_class            = ( ! empty( $thumbnail_id ) ) ? 'block-hero--' . $hero_style : 'block-hero--no-image';
$show_inpage_navigation = get_field( 'show_inpage_navigation' );

if ( 'full-width' === $hero_style && ! empty( $thumbnail_id ) ) {
	$thumbnail = wp_get_attachment_image( $thumbnail_id, 'full-image' );
} elseif ( 'small-image' === $hero_style && ! empty( $thumbnail_id ) ) {
	$thumbnail = wp_get_attachment_image( $thumbnail_id, 'hero-small' );
} elseif ( 'content-image' === $hero_style && ! empty( $thumbnail_id ) ) {
	$thumbnail = wp_get_attachment_image( $thumbnail_id, 'size-half-full' );
	$bg_image  = get_field( 'background_image' ) ?? false;
	if ( $bg_image ) {
		$bg_image = wp_get_attachment_image( $bg_image, 'size-half-full', false, array( 'class' => 'block-hero__content-bg' ) );
	}
}

$col_class = ( 'content-image' === $hero_style && ! empty( $thumbnail_id ) ) ? 'col-12 col-lg-5 col-content' : 'col-12';
?>

<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-hero <?php echo esc_attr( $block_class ); ?>">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>

	<?php if ( ! empty( $thumbnail ) ) : ?>

		<?php if ( 'small-image' === $hero_style ) : ?>
			<div class="block-hero__thumbnail-wrapper container">
		<?php endif; ?>

		<figure class="block-hero__thumbnail">
			<?php echo wp_kses_post( $thumbnail ); ?>
		</figure>

		<?php if ( 'small-image' === $hero_style ) : ?>
			</div>
		<?php endif; ?>

		<div class="block-hero__content">
			<?php
			if ( $bg_image ) {
				echo wp_kses_post( $bg_image );
			}
			?>
			<div class="container">
				<div class="row">
					<div class="<?php echo esc_attr( $col_class ); ?>">
						<?php if ( ! empty( $hero_heading ) ) : ?>
							<h1 class="block-hero__title"><?php echo esc_html( $hero_heading ); ?></h1>
						<?php endif; ?>
						<?php if ( ! empty( $description ) ) : ?>
							<div class="block-hero__description"><?php echo wp_kses_post( $description ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

	<?php else : ?>

		<?php if ( ! empty( $hero_heading ) ) : ?>
			<h1 class="block-hero__title"><?php echo esc_html( $hero_heading ); ?></h1>
		<?php endif; ?>

	<?php endif; ?>

</section>

<?php
if ( true === $show_inpage_navigation ) {
	get_theme_part( 'page/inpagenav' );
}
