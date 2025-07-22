<?php
/**
 * Block for CTA
 *
 * Title:       Call To Action
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

$section_title    = get_field( 'title' );
$description      = get_field( 'description' );
$actions          = get_field( 'action' );
$color_scheme     = get_field( 'color_scheme' );
$button_color     = 'dark' === $color_scheme ? ' c-btn-color-alt' : null;
$full_width       = get_field( 'full_width' );
$full_width_class = '';

$full_width ? $full_width_class = ' full-width' : '';
?>
<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-call-to-action block-call-to-action--<?php esc_attr_e( $color_scheme ); ?><?php echo esc_html( $full_width_class ); ?>">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="container">
		<div class="row">
			<div class="<?php echo is_admin() ? esc_attr( 'editor-full-width ' ) : esc_attr( '' ); ?>col-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
				<div class="block-call-to-action__wrapper">
					<h2 class="block-call-to-action__title">
						<?php esc_html_e( $section_title ); ?>
					</h2>

					<?php if ( ! empty( $description ) ) : ?>
						<p class="block-call-to-action__description"><?php esc_html_e( $description ); ?></p>
					<?php endif; ?>

					<?php
					if ( ! empty( $actions ) ) {
						$first_action = $actions[0];

						if ( 'buttons' === $first_action['acf_fc_layout'] ) {
							echo '<div class="c-btn-group">';
							echo wp_kses_post( $content_block->acf_link( $first_action['primary_button'], 'c-btn c-btn-primary' . $button_color ) );
							echo wp_kses_post( $content_block->acf_link( $first_action['secondary_button'], 'c-btn c-btn-secondary' . $button_color ) );
							echo '</div>';
						} elseif ( 'gravity_form' === $first_action['acf_fc_layout'] ) {
							echo '<div class="cta-form">';
							echo do_shortcode( '[gravityform id="' . $first_action['form'] . '" title="false" description="false" ajax="true"]' );
							echo '</div>';
						} elseif ( 'other' === $first_action['acf_fc_layout'] ) {
							echo '<div class="cta-form">';
							echo do_shortcode( $first_action['form'] );
							echo '</div>';
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
