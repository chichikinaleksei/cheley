<?php
/**
 * The footer bottom part.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$copyright   = get_field( 'f_copyright', 'options' );
$bottom_menu = get_field( 'f_bottom_menu', 'options' );
$website     = get_field( 'f_website', 'options' );
$social      = get_field( 'f_social', 'options' );

if ( ! empty( $copyright ) || ! empty( $bottom_menu ) || ! empty( $website ) ) :
	?>
	<div class="row main-footer__bottom">
		<?php if ( ! empty( $copyright ) || ! empty( $bottom_menu ) || ! empty( $website ) ) : ?>
			<div class="col-12 col-lg main-footer__bottom-left-wrapper">
				<div class="main-footer__bottom-left">
					<?php if ( ! empty( $copyright ) ) : ?>
						<div class="main-footer__copyrights"><?php echo wp_kses_post( $copyright ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $bottom_menu ) ) : ?>
						<nav class="main-footer__bottom-menu">
						<?php
							echo wp_nav_menu(
								array(
									'menu'      => $bottom_menu,
									'container' => false,
								)
							);
						?>
						</nav>
					<?php endif; ?>
					<?php if ( ! empty( $website ) ) : ?>
						<div class="main-footer__website"><?php echo wp_kses_post( $website ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $social ) ) : ?>
			<div class="col-12 col-lg d-md-none d-xl-block main-footer__social-wrapper">
				<?php get_theme_part( 'footer/footer-social' ); ?>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;
?>
