<?php
/**
 * Block for Home Page Hero
 *
 * Title:       Hero Home Page
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    hero, home page
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

$hero_heading        = get_field( 'custom_title' );
$hero_script         = get_field( 'hero_script' );
$hero_buttons        = get_field( 'hero_buttons' );
$hero_bg_video       = get_field( 'hero_bg_video' );
$hero_video_button   = get_field( 'hero_video_button' );
$hero_lightbox_video = get_field( 'hero_lightbox_video' );
$image_id            = get_post_thumbnail_id( get_the_ID() );

$hero_heading_check = array();
foreach ( $hero_heading as $key => $value ) {
	if ( strlen( $value ) && null !== $value ) {
		$hero_heading_check[] = $value;
	}
}

?>

<section id="<?php esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-hero-home">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="block-hero-home__wrapper">		
		<div class="block-hero-home__content-wrapper">
			<?php
			if ( ! empty( $hero_bg_video ) ) {
				get_theme_part(
					'elements/video-background',
					array(
						'video' => $hero_bg_video,
					)
				);
			} else {
				?>
					<figure class="block-hero-home__video-placeholder">
							<?php echo wp_get_attachment_image( $image_id, 'size-full' ); ?>
					</figure>
				<?php
			}
			?>
			<div class="block-hero-home__text-wrapper">
				<?php if ( ! empty( $image_id ) ) : ?>
					<figure class="block-hero-home__image">
						<?php echo wp_get_attachment_image( $image_id, 'size-full' ); ?>
					</figure>
				<?php endif; ?>
				<div class="block-hero-home__text">
				<?php if ( empty( $hero_heading_check ) ) : ?>
					<h1 class="block-hero-home__title"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php else : ?>
					<h1 class="block-hero-home__title">
						<?php foreach ( $hero_heading as $heading_line ) : ?>
							<span class="block-hero-home__title-line"><?php echo esc_html( $heading_line ); ?></span>
						<?php endforeach; ?>
					</h1>
				<?php endif; ?>
				<?php if ( ! empty( $hero_script ) ) : ?>
					<p class="block-hero-home__script"><?php echo esc_html( $hero_script ); ?></p>
				<?php endif; ?>
				</div>
			</div>
			<div class="block-hero-home__buttons-wrapper">
				<?php if ( ! empty( $hero_buttons ) ) : ?>
					<div class="block-hero-home__buttons">
						<?php
						foreach ( $hero_buttons as $button ) {
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
				<?php
				if ( ! empty( $hero_lightbox_video ) ) :
					$embed = wp_oembed_get( $hero_lightbox_video );
					preg_match( '/src="(.+?)"/', $embed, $matches );
					$video_src = $matches[1];
					?>
					<button data-video="<?php echo esc_html( $video_src ); ?>" class="c-btn c-btn-secondary c-btn-color-alt btn-play-lightbox js-play-lightbox-video">
						<i class="icon-play"></i>
						<span class="c-btn-text"><?php echo esc_html( $hero_video_button ); ?></span>
					</button>
				<?php endif; ?>
			</div>
		</div>

	</div>
	<?php
	if ( ! empty( $hero_lightbox_video ) ) {
		get_theme_part( 'elements/video-lightbox' );
	}
	?>
</section>
