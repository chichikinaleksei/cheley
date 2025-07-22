<?php
/**
 * Video Lightbox Template
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

?>
<div class="video-lightbox">
	<button class="video-lightbox__close" tabindex="0" aria-label="<?php echo esc_html( __( 'Close Lightbox', 'cheleyCamps' ) ); ?>"></button>
	<div class="video-lightbox__video-wrapper container">
		<div class="video-lightbox__video"></div>
		<img src="<?php echo wp_kses_post( get_stylesheet_directory_uri() . '/images/video-spacer.jpg' ); ?>" alt="video-spacer" class="video-lightbox__video-spacer">
	</div>
</div>
