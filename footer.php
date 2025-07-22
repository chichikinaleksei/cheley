<?php
/**
 * The footer for theme.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$footer_background     = get_field( 'footer_background_color' );
$disable_footer_margin = get_field( 'disable_footer_margin' );
$main_sect_class[]     = 'main-footer';

if ( 'gray' === $footer_background ) {
	$main_sect_class[] = 'main-footer--gray';
}

if ( $disable_footer_margin ) {
	$main_sect_class[] = 'main-footer--disable-margin';
}

?>

			<footer class="<?php echo esc_attr( implode( ' ', $main_sect_class ) ); ?>">
				<div class="main-footer__wrapper">
					<div class="container">
						<?php
						get_theme_part( 'footer/footer-top' );
						get_theme_part( 'footer/footer-bottom' );
						?>
					</div>
				</div>
			</footer>
		</div> <!-- /#page -->

		<span class="tablet-checker"></span>

		<?php wp_footer(); ?>

	</body>
</html>
