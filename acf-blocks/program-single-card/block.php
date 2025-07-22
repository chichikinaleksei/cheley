<?php
/**
 * Block Program Single Card
 *
 * Title:       Program Single Card
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    program, single, card
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

$bpsc_side_heading       = get_field( 'bpsc_side_heading' );
$bpsc_image              = wp_get_attachment_image( get_field( 'bpsc_image' ), 'program-single-card' );
$bpsc_location_preheader = get_field( 'bpsc_location_preheader' );
$bpsc_header             = get_field( 'bpsc_header' );
$bpsc_description        = get_field( 'bpsc_description' );

if ( ! empty( $bpsc_image ) || ! empty( $bpsc_location_preheader ) || ! empty( $bpsc_header ) || ! empty( $bpsc_description ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-program-single-card">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<?php if ( ! empty( $bpsc_side_heading ) ) : ?>
			<div class="block-program-single-card__side-heading-wrapper">
				<h2 class="block-program-single-card__side-heading"><?php echo esc_html( $bpsc_side_heading ); ?></h2>
			</div>
		<?php endif; ?>
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-12 col-xl-6 col-lg-6 image-left block-program-single-card__col-img">
				<?php if ( ! empty( $bpsc_image ) ) : ?>	
					<figure class="block-program-single-card__image"><?php echo wp_kses_post( $bpsc_image ); ?></figure>
				<?php endif; ?>
				</div>
				<div class="col-12 col-lg-6 content-right block-program-single-card__col-text">
					<div class="block-program-single-card__content-wrapper">
					<?php if ( ! empty( $bpsc_location_preheader ) ) : ?>
						<p class="block-program-single-card__location-pre-heading"><?php echo esc_html( $bpsc_location_preheader ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $bpsc_header ) ) : ?>
						<h3 class="block-program-single-card__heading"><?php echo esc_html( $bpsc_header ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $bpsc_description ) ) : ?>
						<div class="block-program-single-card__content"><?php echo wp_kses_post( $bpsc_description ); ?></div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
