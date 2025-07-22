<?php
/**
 * Block Program Cards
 *
 * Title:       Program Cards
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    program, cards
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

$bpc_side_heading = get_field( 'bpc_side_heading' );
$bpc_cards        = get_field( 'bpc_cards' );

if ( ! empty( $bpc_side_heading ) || ! empty( $bpc_cards ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-program-cards">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="block-program-cards__logos-wrapper"></div> 
		<?php if ( ! empty( $bpc_side_heading ) ) : ?>
			<div class="block-program-cards__side-heading-wrapper">
				<h2 class="block-program-cards__side-heading"><?php echo esc_html( $bpc_side_heading ); ?></h2>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $bpc_cards ) ) : ?>
			<div class="container">
				<?php
				foreach ( $bpc_cards as $index => $card ) :
					$location_preheader = $card['location_preheader'];
					$heading            = $card['heading'];
					$description        = $card['description'];
					$image_links        = $card['image_links'];
					$col_text_class     = 0 === $index % 2 ? 'block-program-cards__text-col order-lg-last' : 'block-program-cards__text-col';
					?>
					<div class="block-program-cards__row-wrapper">
						<div class="row">
							<div class="col-12 col-lg-4 <?php echo esc_attr( $col_text_class ); ?>">
								<div class="block-program-cards__text-wrapper">
								<?php if ( ! empty( $location_preheader ) ) : ?>
									<p class="block-program-cards__location-pre-heading"><?php echo esc_html( $location_preheader ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $heading ) ) : ?>
									<h3 class="block-program-cards__heading"><?php echo esc_html( $heading ); ?></h3>
								<?php endif; ?>
								<?php if ( ! empty( $description ) ) : ?>
									<div class="block-program-cards__description"><?php echo wp_kses_post( $description ); ?></div>
								<?php endif; ?>
								</div>
							</div>
							<?php
							if ( ! empty( $image_links ) ) :
								foreach ( $image_links as $image_link ) :
									$link_image  = wp_get_attachment_image( $image_link['image'], 'tab-img-link' );
									$link_link   = $image_link['link'];
									$link_title  = $link_link['title'];
									$link_url    = $link_link['url'];
									$link_target = $link_link['target'] ? ' target="_blank" rel="noopener"' : null;
									?>
									<div class="col-12 col-md-6 col-lg-4 block-program-cards__image-link-col">
										<div class="block-program-cards__image-link-wrapper">
											<a class="block-program-cards__image-link" href="<?php echo esc_url( $link_url ); ?>" <?php echo esc_attr( $link_target ); ?> aria-label="<?php echo esc_attr( $link_title ); ?>">
												<figure class="block-program-cards__link-image">
												<?php echo wp_kses_post( $link_image ); ?>
													<span class="c-btn c-btn-tertiary c-btn-color-alt c-btn-icon-right block-program-cards__image-link-text">
														<span class="c-btn-text"><?php echo esc_html( $link_title ); ?></span><i class="icon-arrow-forward"></i>
													</span>
												</figure>
											</a>
										</div>
									</div>
									<?php
								endforeach;
							endif;
							?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php
endif;
