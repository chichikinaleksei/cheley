<?php
/**
 * Block for icon and description columns
 *
 * Title:       Icons + Descriptions
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    icons, descriptions
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:    slick
 * JS Deps:     slick
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$pre_header        = get_field( 'pre-header' );
$icon_descriptions = get_field( 'icon_descriptions' );

?>
<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-icon-descriptions">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="container">
	<?php if ( ! empty( $pre_header ) ) : ?>
		<h2 class="block-icon-descriptions__section-title">
			<?php echo wp_kses_post( $pre_header ); ?>
		</h2>
	<?php endif; ?>
	<?php if ( ! empty( $icon_descriptions ) ) : ?>
		<div class="block-icon-descriptions__slider row">
		<?php
		foreach ( $icon_descriptions as $icon_description ) :
			$icon_id     = $icon_description['image'];
			$icon        = wp_get_attachment_image( $icon_id, 'icon-lg' );
			$pre_header  = $icon_description['pre-header'];
			$header      = $icon_description['header'];
			$description = $icon_description['description'];
			?>
			<div class="block-icon-descriptions__icon-col col-12 col-sm-12 col-md-4">
			<?php if ( ! empty( $icon ) ) : ?>
				<figure class="block-icon-descriptions__icon">
					<?php echo wp_kses_post( $icon ); ?>
				</figure>
			<?php endif; ?>
			<div class="block-icon-descriptions__icon-col-text-wrap">
				<?php if ( ! empty( $pre_header ) ) : ?>
					<p class="block-icon-descriptions__pre-header overline">
						<?php echo esc_html( $pre_header ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $header ) ) : ?>
					<h3 class="block-icon-descriptions__header">
						<?php echo esc_html( $header ); ?>
					</h3>
				<?php endif; ?>
				<?php if ( ! empty( $description ) ) : ?>
					<p class="block-icon-descriptions__description">
						<?php echo esc_html( $description ); ?>
					</p>
				<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
	</div>
</section>
