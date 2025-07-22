<?php
/**
 * Block Activities Highlights
 *
 * Title:       Activities Highlights
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    activities, highlights
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

$bah_header      = get_field( 'bah_header' );
$bah_description = get_field( 'bah_description' );
$bah_buttons     = get_field( 'bah_buttons' );
$bah_posts       = get_field( 'bah_posts' );

if ( ! empty( $bah_header ) || ! empty( $bah_description ) || ! empty( $bah_buttons ) || ! empty( $bah_posts ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-activities-highlights">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="block-activities-highlights__wrapper">
			<div class="container">
				<div class="block-activities-highlights__top">
					<?php if ( ! empty( $bah_header ) ) : ?>
						<h2 class="block-activities-highlights__header"><?php echo esc_html( $bah_header ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $bah_description ) ) : ?>
						<p class="block-activities-highlights__description"><?php echo esc_html( $bah_description ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $bah_buttons ) ) : ?>
						<div class="block-activities-highlights__buttons">
							<?php
							foreach ( $bah_buttons as $button ) {
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
				</div>
			</div>
			<div class="block-activities-highlights__activities-wrapper">
				<?php if ( ! empty( $bah_posts ) ) : ?>
					<div class="block-activities-highlights__activities">
						<?php
						foreach ( $bah_posts as $bah_post ) :
							$bah_post_id         = $bah_post->ID;
							$post_img            = get_post_thumbnail_id( $bah_post_id );
							$post_title          = $bah_post->post_title;
							$post_terms          = get_the_terms( $bah_post_id, 'activity_category' );
							$post_category_id    = $post_terms[0]->term_id;
							$card_archive_link   = get_post_type_archive_link( 'activity' );
							$card_archive_link  .= "?e29_activity_category=$post_category_id";
							$post_category_term  = get_term( $post_terms[0]->term_id );
							$post_category_title = $post_category_term->name;
							?>
							<div class="block-activities-highlights__card-wrapper">
								<a class="block-activities-highlights__link" href="<?php echo esc_url( $card_archive_link ); ?>" aria-label="<?php esc_attr_e( 'Go to the archive page', 'cheleyCamps' ); ?> - <?php esc_attr_e( $post_category_title ); ?>">
									<figure class="block-activities-highlights__card-image">
										<?php echo wp_get_attachment_image( $post_img, 'activities-card' ); ?>
									</figure>
									<p class="block-activities-highlights__card-title"><?php echo esc_html( $post_category_title ); ?></p>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
