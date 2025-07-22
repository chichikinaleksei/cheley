<?php
/**
 * Block Image Content Tabs - Tab
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

foreach ( $bicc_tabs as $iter => $bicc_tab ) :
	$el_class = 'tabs__tab-content';
	if ( 0 === $iter ) {
		$el_class .= ' active';
	}
	?>
	<div class="<?php esc_attr_e( $el_class ); ?>" data-tab-id="<?php esc_attr_e( '#' . $iter ); ?>" id="<?php esc_attr_e( '#' . $iter ); ?>">
		<?php
		$tab_selector         = $bicc_tab['image_cards'];
		$location_pre_heading = $bicc_tab['location_pre-header'];
		$tab_heading          = $bicc_tab['heading'];
		$tab_content          = $bicc_tab['description'];
		$tab_image_id         = $bicc_tab['image'];
		$tab_image            = wp_get_attachment_image( $tab_image_id, 'full-width-block' );
		$tab_image_links      = $bicc_tab['image_links'];
		$text_col_class       = true === $tab_selector ? 'tabs__text-col col-12 col-lg-6' : 'tabs__text-col tabs__text-col--cards col-12 col-lg-5';
		$img_col_class        = true === $tab_selector ? 'tabs__img-col col-12 col-lg-6' : 'tabs__img-col tabs__img-col--cards col-12 col-lg-7';
		if ( ! empty( $location_pre_heading || $tab_heading || $tab_content || $tab_image || $tab__image_links ) ) :
			?>
			<div class="row">
				<div class="<?php echo esc_attr( $text_col_class ); ?>">
					<div class="tabs__content-wrapper">
					<?php if ( ! empty( $location_pre_heading ) ) : ?>
						<p class="tabs__location-pre-heading"><?php echo esc_html( $location_pre_heading ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $tab_heading ) ) : ?>
						<h2 class="tabs__heading"><?php echo esc_html( $tab_heading ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $tab_content ) ) : ?>
						<div class="tabs__content"><?php echo wp_kses_post( $tab_content ); ?></div>
					<?php endif; ?>
					</div>
				</div>
				<?php if ( ! empty( $tab_image ) || ! empty( $tab_image_links ) ) : ?>
					<div class="<?php echo esc_attr( $img_col_class ); ?>">
						<?php if ( ! empty( $tab_image ) ) : ?>
						<figure class="tabs__image">
							<?php echo wp_kses_post( $tab_image ); ?>
						</figure>
							<?php if ( ! empty( wp_get_attachment_caption( $tab_image_id ) ) ) : ?>
								<p class="tabs__image-caption"><?php esc_html_e( wp_get_attachment_caption( $tab_image_id ) ); ?></p>
							<?php endif; ?>
						<?php endif; ?>
						<?php
						if ( ! empty( $tab_image_links ) ) :
							foreach ( $tab_image_links as $item ) :
								$link_image = wp_get_attachment_image( $item['image'], 'tab-img-link' );
								$link_link  = $item['link'];
								?>
								<div class="tabs__image-link-wrapper">
									<figure class="tabs__link-image">
									<?php echo wp_kses_post( $link_image ); ?>
									<?php
										get_theme_part(
											'global/button',
											array(
												'button' => $link_link,
												'class'  => 'c-btn c-btn-tertiary c-btn-color-alt c-btn-icon-right',
												'i'      => '<i class="icon-arrow-forward"></i>',
											)
										);
									?>
									</figure>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				<?php endif; ?>
			</div>
			<?php
		endif;
		?>
	</div>
	<?php
endforeach;
