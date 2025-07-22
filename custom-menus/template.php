<?php
/**
 * Menu Item Template: Menu Template
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$this_post_id = $p->ID;

$this_menu_link_href = get_field( 'menu_link', $this_post_id ) ? get_field( 'menu_link', $this_post_id ) : '#' . get_the_title( $this_post_id );
?>

<a href="<?php echo esc_url( $this_menu_link_href ); ?>" rel="nofollow"><?php esc_html_e( get_the_title( $this_post_id ) ); ?></a>
<?php if ( have_rows( 'mega_menu_columns', $this_post_id ) ) : ?>
	<div class="mega-menu-wrapper"><!-- Mega menu wrapper -->
		<div class="container"><!-- Mega menu container -->
			<div class="row"><!-- Mega menu row -->
			<?php
			while ( have_rows( 'mega_menu_columns', $this_post_id ) ) :
				the_row();
				$col_class = 'mega-menu-item col-12 col-xl-3 ' . str_replace( '_', '-', get_row_layout() );
				$width     = get_sub_field( 'width' );
				if ( $width ) {
					$col_class = 'mega-menu-item col-12 col-xl-' . $width . ' ' . str_replace( '_', '-', get_row_layout() );
				}

				if ( 'mmc_wp_menu' === get_row_layout() && ! empty( get_sub_field( 'title' ) ) ) {
					$col_class .= ' mmc-wp-menu-with-title';
				}
				?>
				<div class="<?php esc_attr_e( $col_class ); ?>"><!-- Mega menu column -->
					<?php
					if ( 'mmc_wp_menu' === get_row_layout() ) :
						$block_title      = get_sub_field( 'title' );
						$block_title_link = get_sub_field( 'title_link' );
						$block_menu       = get_sub_field( 'menu' );

						$title_class = '';

						$block_title_link ? $title_class = ' mobile-only' : '';
						?>
						<div class="mega-menu-menus">
							<?php if ( ! empty( $block_title ) ) : ?>
								<div class="mega-menu-menus__title mega-menu-title-trigger">
									<?php
									if ( ! empty( $block_title_link ) ) :
										$link_title = $block_title_link['title'];
										$link_url   = $block_title_link['url'];
										?>
										<a class="mega-menu-menus__title mega-menu-title-link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $block_title ); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( ! empty( $block_menu ) ) : ?>
								<div class="mega-menu-menus__wrapper">
									<?php
									if ( ! empty( $block_menu ) ) :
										echo wp_kses_post( $block_menu );
									endif;
									?>
								</div>
							<?php endif; ?>
						</div>
						<?php
					elseif ( 'mmc_wp_content' === get_row_layout() ) :
						$heading      = get_sub_field( 'heading' );
						$heading_link = get_sub_field( 'heading_link' );
						$contents     = get_sub_field( 'contents' );

						if ( ! empty( $contents || $heading ) ) :
							?>
							<div class="mega-menu-contents">
								<?php if ( ! empty( $heading ) ) : ?>
									<div class="mega-menu-contents__title mega-menu-title-trigger">
										<?php
										if ( ! empty( $heading_link ) ) :
											$link_title = $heading_link['title'];
											$link_url   = $heading_link['url'];
											?>
											<a class="mega-menu-menus__title mega-menu-title-link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a>
										<?php else : ?>
											<?php echo esc_html( $heading ); ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $contents ) ) : ?>
									<div class="mega-menu-contents__contents">
										<?php
										foreach ( $contents as $content ) :
											$content_heading             = $content['heading'];
											$content_heading_link        = $content['heading_link'];
											$content_heading_link_target = ! empty( $content_heading_link['target'] ) ? ' target=_blank rel=noopener' : null;
											$content_links               = $content['links'];
											?>
											<div class="mega-menu-contents__contents-item">
												<?php if ( ! empty( $content_heading ) ) : ?>
													<?php if ( ! empty( $content_heading_link ) ) : ?>
														<a href="<?php echo esc_url( $content_heading_link['url'] ); ?>"<?php echo esc_attr( $content_heading_link_target ); ?>>
													<?php endif; ?>
														<p class="mega-menu-contents__contents-heading">
															<?php echo esc_html( $content_heading ); ?>
														</p>
													<?php if ( ! empty( $content_heading_link ) ) : ?>
														</a>
													<?php endif; ?>
												<?php endif; ?>
												<?php if ( ! empty( $content_links ) ) : ?>
													<div class="mega-menu-contents__contents-text">
														<?php
														foreach ( $content_links as $item ) :
															$item_title = $item['title'];
															$item_links = $item['links'];

															if ( ! empty( $item_title ) ) :
																?>
																<p class="mega-menu-contents__contents-text-title"><?php echo esc_html( $item_title ); ?></p>
																<?php
															endif;
															if ( ! empty( $item_links ) ) :
																?>
																<ul class="mega-menu-contents__contents-text-links">
																	<?php
																	foreach ( $item_links as $item ) :
																		$item_link = $item['link'];
																		?>
																		<li>
																			<?php echo wp_kses_post( Content_Block_Gutenberg::acf_link( $item_link, 'mega-menu-contents__contents-text-link', false ) ); ?>
																		</li>
																		<?php
																	endforeach;
																	?>
																</ul>
																<?php
															endif;
														endforeach;
														?>
													</div>
												<?php endif; ?>
											</div>
											<?php
										endforeach;
										?>
									</div>
								<?php endif; ?>
							</div>
							<?php
						endif;
					elseif ( 'mmc_wp_image_button' === get_row_layout() ) :
						$image  = get_sub_field( 'image' );
						$button = get_sub_field( 'button' );
						if ( ! empty( $image ) || ! empty( $button ) ) :
							?>
							<div class="mega-menu-image">
								<?php if ( ! empty( $image ) ) : ?>
									<figure class="mega-menu-image__img">
										<?php echo wp_get_attachment_image( $image, 'mega-menu' ); ?>
									</figure>
								<?php endif; ?>
								<?php
								if ( ! empty( $button ) ) :
									echo wp_kses_post( Content_Block_Gutenberg::acf_link( $button, 'mega-menu-image__btn', false ) );
								endif;
								?>
							</div>
							<?php
						endif;
					endif;
					?>
				</div><!-- End of mega menu column -->
			<?php endwhile; ?>
			</div><!-- End of mega menu row -->
		</div><!-- End of mega menu container -->
	</div><!-- End of mega menu wrapper -->
	<?php
endif;
