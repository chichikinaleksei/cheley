<?php
/**
 * The Header for theme.
 *
 * Displays all of the <head> section and page header
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

get_theme_part( 'html-head' );
?>

<body <?php body_class(); ?>>
	<div id="page">
		<header class="main-header">
			<div class="main-header__wrapper">
				<?php get_theme_part( 'header/header-alert-bar' ); ?>
				<?php get_theme_part( 'header/header-bottom' ); ?>
			</div>
		</header>
