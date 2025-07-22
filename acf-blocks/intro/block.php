<?php
/**
 * Block Intro
 *
 * Title:       Intro
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    intro
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

$bi_logo        = get_field( 'bi_logo' );
$bi_preheader   = get_field( 'bi_preheader' );
$bi_description = get_field( 'bi_description' );
$bi_buttons     = get_field( 'bi_buttons' );

if ( ! empty( $bi_logo ) || ! empty( $bi_preheader ) || ! empty( $bi_description ) || ! empty( $bi_buttons ) ) :
	?>

	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-intro">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<div class="block-intro__content">
				<?php if ( ! empty( $bi_logo ) ) : ?>
				<figure class="block-intro__image">
					<?php echo wp_get_attachment_image( $bi_logo, 'intro-logo' ); ?>
				</figure>
				<?php endif; ?>
				<?php if ( ! empty( $bi_preheader ) ) : ?>
				<p class="block-intro__preheader"><?php echo esc_html( $bi_preheader ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $bi_description ) ) : ?>
				<p class="block-intro__description"><?php echo esc_html( $bi_description ); ?></p>
				<?php endif; ?>
				<?php
				if ( ! empty( $bi_buttons ) ) {
					foreach ( $bi_buttons as $button ) {
						$btn_class  = 'c-btn c-btn-' . $button['button_type'] . ' c-btn-color-' . $button['button_color'];
						$btn_class .= $button['button_icon'] ? ' c-btn-icon-' . $button['button_icon'] : null;
						$i          = $button['button_icon'] ? '<i class="icon-arrow-forward"></i>' : null;
						get_theme_part(
							'global/button',
							array(
								'button' => $button['button'],
								'class'  => $btn_class,
								'i'      => $i,
							)
						);
					}
				}
				?>
			</div>
		</div>
	</section>
	<?php
endif;
