<?php
/**
 * The footer menu part.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$current_menu = ! empty( $menu ) ? $menu : '';

if ( ! empty( $menu ) ) :
	?>
	<nav class="main-footer__menu">
	<?php
		echo wp_nav_menu(
			array(
				'menu'      => $current_menu,
				'container' => false,
			)
		);
	?>
	</nav>
	<?php
endif;
