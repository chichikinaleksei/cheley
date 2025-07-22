<?php
/**
 * The button parial.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$default_classes = '';
$button          = isset( $button ) ? $button : null;
$class           = isset( $class ) ? $default_classes . ' ' . $class : $default_classes;
$i               = isset( $i ) ? $i : null;
$wrapper         = isset( $wrapper ) ? $wrapper : null;

if ( ! empty( $button ) ) {
	$link_title  = $button['title'];
	$link_url    = $button['url'];
	$link_target = $button['target'] ? ' target="_blank" rel="noopener"' : null;

	?>
	<?php if ( ! empty( $wrapper ) ) : ?>
		<div class="c-btn-wrapper">
	<?php endif; ?>
		<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $link_url ); ?>"<?php echo esc_attr( $link_target ); ?>><span class="c-btn-text"><?php echo esc_html( $link_title ); ?></span><?php echo wp_kses_post( $i ); ?></a>
	<?php if ( ! empty( $wrapper ) ) : ?>
		</div>
	<?php endif; ?>
	<?php
}

