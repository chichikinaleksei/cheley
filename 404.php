<?php
/**
 * The 404 page template.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$x404_preheader = get_field( 'x404_preheader', 'options' );
$x404_header    = get_field( 'x404_header', 'options' );
$x404_buttons   = get_field( 'x404_buttons', 'options' );

get_header();

?>
	<main>
		<section class="page-404">
			<div class="container">
				<?php if ( ! empty( $x404_preheader ) ) : ?>
					<p class="page-404__preheader overline"><?php echo esc_html( $x404_preheader ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $x404_header ) ) : ?>
					<h1 class="page-404__header"><?php echo esc_html( $x404_header ); ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $x404_buttons ) ) : ?>
					<div class="page-404__buttons">
						<?php
						foreach ( $x404_buttons as $button ) {
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
						?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</main>
<?php
get_footer();
