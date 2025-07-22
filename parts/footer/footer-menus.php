<?php
/**
 * The footer menus part.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$menu_1         = get_field( 'f_menu_1', 'options' );
$menu_1_buttons = get_field( 'f_menu_1_buttons', 'options' );
$menu_2         = get_field( 'f_menu_2', 'options' );
$menu_2_buttons = get_field( 'f_menu_2_buttons', 'options' );

if ( ! empty( $menu_1 ) || ! empty( $menu_1_buttons ) || ! empty( $menu_2 ) || ! empty( $menu_2_buttons ) ) :
	?>
	<div class="col-12 col-md-8 col-xl-5 offset-xl-1 main-footer__menus">
		<?php if ( ! empty( $menu_1 ) || ! empty( $menu_1_buttons ) ) : ?>
			<div class="main-footer__menu-col-wrapper main-footer__menu-col-wrapper--first">
				<?php
				if ( ! empty( $menu_1 ) ) {
					get_theme_part(
						'footer/footer-menu',
						array(
							'menu' => $menu_1,
						)
					);
				}
				?>
				<?php if ( ! empty( $menu_1_buttons ) ) : ?>
					<div class="main-footer__buttons">
						<?php
						foreach ( $menu_1_buttons as $item ) :
							$button = $item['button'];

							if ( ! empty( $button ) ) :
								get_theme_part(
									'global/button',
									array(
										'button'  => $button,
										'class'   => 'c-btn c-btn-secondary c-btn-color-alt',
										'wrapper' => true,
									)
								);
							endif;
						endforeach;
						?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $menu_2 ) || ! empty( $menu_2_buttons ) ) : ?>
			<div class="main-footer__menu-col-wrapper main-footer__menu-col-wrapper--second">
				<?php
				if ( ! empty( $menu_2 ) ) {
					get_theme_part(
						'footer/footer-menu',
						array(
							'menu' => $menu_2,
						)
					);
				}
				?>
				<?php if ( ! empty( $menu_2_buttons ) ) : ?>
					<div class="main-footer__buttons">
					<?php
					foreach ( $menu_2_buttons as $item ) :
						$button = $item['button'];

						if ( ! empty( $button ) ) :
							get_theme_part(
								'global/button',
								array(
									'button'  => $button,
									'class'   => 'c-btn c-btn-tertiary c-btn-color-alt c-btn-icon-right',
									'i'       => '<i class="icon-launch-external"></i>',
									'wrapper' => true,
								)
							);
						endif;
					endforeach;
					?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;
?>
