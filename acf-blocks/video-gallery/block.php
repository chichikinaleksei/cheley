<?php
/**
 * Block with image gallery
 *
 * Title:       Video Gallery
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    author, spotlight
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:    slick
 * JS Deps:     slick
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$main_block_class = 'acf-block block-video-gallery';

$videos = get_field( 'videos' );

if ( ! empty( $videos ) ) :
	?>
	<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="<?php esc_attr_e( $main_block_class ); ?>">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<div class="row">
				<?php
				foreach ( $videos as $video ) :
					$width  = ! empty( $video['width'] ) ? $video['width'] : 16;
					$height = ! empty( $video['height'] ) ? $video['height'] : 9;
					$ratio  = $height / $width * 100;
					?>
					<div class="col-12 col-sm-6 col-md-4">
						<div 
							class="video-gallery__card" 
							data-embed-url="<?php esc_attr_e( $video['video_embed_url'] ); ?>" 
							data-ratio="<?php esc_attr_e( $ratio ); ?>"
							data-id="<?php esc_attr_e( get_row_index() ); ?>"
						>
							<div class="video-gallery__card-thumb">
								<?php echo wp_get_attachment_image( $video['image'], 'medium' ); ?>
								<button class="play-btn"><div class="sr-only">Open video</div></button>
							</div>
							<?php if ( ! empty( $video['title'] ) ) : ?>
								<div class="video-gallery__card-title"><?php esc_html_e( $video['title'] ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div 
			class="video-gallery__lightbox" 
			id="video-gallery-lightbox-<?php esc_attr_e( get_row_index() ); ?>" 
			aria-hidden="true"
		>
			<button class="video-gallery__close">
				<span class="icon-clear"></span
				><span class="sr-only">Close video</span>
			</button>
			<div class="container">
				<div class="video-gallery__iframe-wrapper">
					<iframe frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
