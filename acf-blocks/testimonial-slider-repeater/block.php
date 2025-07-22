<?php
/**
 * Testimonials slider block (repeater)
 *
 * Title:       Testimonial Slider Repeater
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
 * @since cheleyCamps  1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$is_full_width    = get_field( 'full_width' );
$testimonials     = get_field( 'testimonials' );
$testimonials_bg  = get_field( 'bg_image' );
$main_block_class = $is_full_width
	? 'acf-block block-testimonial-slider block-testimonial-slider--fluid'
	: 'acf-block block-testimonial-slider';

if ( ! get_field( 'testimonials' ) && get_theme_setting( 'use_testimonal_post_type' ) ) {
	$testimonial_posts = get_posts(
		array(
			'post_type'      => 'testimonial',
			'posts_per_page' => 10,
			'sortby'         => 'menu_order',
		)
	);

	$testimonials = array_map(
		function( $testimonial ) {
			return array(
				'name'  => $testimonial->post_title,
				'quote' => get_field( 'quote', $testimonial->ID ),
				'label' => get_field( 'label', $testimonial->ID ),
			);
		},
		$testimonial_posts
	);
}
?>

<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="<?php esc_attr_e( $main_block_class ); ?>">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>

	<?php if ( ! empty( $testimonials_bg ) ) : ?>
		<figure class="testimonial-slider__background">
			<?php echo wp_get_attachment_image( $testimonials_bg, 'size-full' ); ?>
		</figure>
	<?php endif ?>
	<?php if ( $is_full_width ) : ?>
		<div class="testimonial-slider">
			<?php foreach ( $testimonials as $testimonial ) : ?>
				<div class="testimonial-slider__slide">
					<div class="container">
						<?php include 'inc/slide-content.php'; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="container">
			<div class="testimonial-slider">
				<?php foreach ( $testimonials as $testimonial ) : ?>
					<div class="testimonial-slider__slide">
						<?php include 'inc/slide-content.php'; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</section>
<?php
