<?php
/**
 * Mobile header
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$next_steps = get_field( 'h_next_steps_menu', 'options' );
$cta        = get_field( 'h_cta', 'options' );
$menu = wp_get_nav_menu_object("12" );
?>

<div class="main-header__overlay">
	<div class="main-header__overlay-top">
		<button class="c-btn c-btn-back main-header__back" aria-label="Back"></button>
		<p class="main-header__mobile-title"></p>
	</div>
	<div class="main-header__overlay-wrapper">
		<div class="main-header__overlay-wrapper-content">
			<div class="main-header__overlay-wrapper-content-menu">
				<nav class="main-header__nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
						)
					);
					?>
				</nav>
			</div>
			<?php if ( ! empty( $cta ) ) : ?>
				<div class="main-header__cta">
					<?php
					foreach ( $cta as $item ) :
						$item_button = $item['button'];

						if ( ! empty( $item_button ) ) :
							echo wp_kses_post( Content_Block_Gutenberg::acf_link( $item_button, 'main-header__cta-link', false ) );
						endif;
						?>
						<?php
					endforeach;
					?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $next_steps ) ) : ?>
			<div class="main-header__steps">
				<button class="main-header__steps-button c-btn c-btn-primary c-btn-color-normal"><?php echo $menu->name; ?></button>
				<div class="main-header__steps-submenu">
					<nav class="main-header__steps-menu">
						<?php echo wp_kses_post( $next_steps ); ?>
					</nav>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
