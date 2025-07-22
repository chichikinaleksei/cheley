<?php
/**
 * Tabs block for page
 *
 * Title:       Tabs
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    author, spotlight
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

$main_block_class = 'acf-block block-tabs tabs';
$default_bg_id    = get_field( 'default_tab_bg_image', 'options' );
$side_heading     = get_field( 'side_heading' );
$default_bg       = wp_get_attachment_image( $default_bg_id, 'size-full' );

?>
<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="<?php esc_attr_e( $main_block_class ); ?>">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<?php if ( ! empty( $side_heading ) ) : ?>
			<h2 class="tabs__side-heading"><?php echo esc_html( $side_heading ); ?></h2>
	<?php endif; ?>
	<div class="tabs__link-list-wrapper">
		<div class="container">
			<div class="row section-without-title">
				<div class="<?php echo is_admin() ? esc_attr( 'editor-full-width ' ) : esc_attr( '' ); ?>col-12 col-md-12">
					<div class="tab-head-wrap">
						<div class="tab-head">
							<ul class="tabs__link-list">
								<?php
								$iter = 0;
								while ( have_rows( 'tabs' ) ) :
									the_row();
									$el_class = 'tabs__link';
									if ( 0 === $iter ) {
										$el_class .= ' active';
									}
									?>
									<li class="<?php esc_attr_e( $el_class ); ?>">
										<a class="tabs_link--inner" href="<?php esc_attr_e( '#' . ( $iter++ ) ); ?>">
											<?php the_sub_field( 'title' ); ?>
										</a>
									</li>
									<?php
								endwhile;
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tabs__tab-content-wrapper">
		<?php
		$iter = 0;
		while ( have_rows( 'tabs' ) ) :
			the_row();
			$el_class = 'tabs__tab-content';
			if ( 0 === $iter ) {
				$el_class .= ' active';
			}
			?>
			<div class="<?php esc_attr_e( $el_class ); ?>" data-tab-id="<?php esc_attr_e( '#' . ( $iter ) ); ?>" id="<?php esc_attr_e( '#' . ( $iter++ ) ); ?>">
				<?php
				$location_pre_heading = get_sub_field( 'location_pre-header' );
				$tab_heading          = get_sub_field( 'heading' );
				$tab_description      = get_sub_field( 'description' );
				$tab_image_id         = get_sub_field( 'image' );
				$tab_image            = wp_get_attachment_image( $tab_image_id, 'tab-img' );
				$tab_bg_id            = get_sub_field( 'bg_image' );
				$tab_bg               = ( ! empty( $tab_bg_id ) ) ? wp_get_attachment_image( $tab_bg_id, 'size-full' ) : $default_bg;
				?>
				<?php if ( ! empty( $location_pre_heading || $tab_heading || $tab_description || $tab_image ) ) : ?>
					<?php if ( ! empty( $tab_bg ) ) : ?>
				<figure class="tabs__bg">
						<?php echo wp_kses_post( $tab_bg ); ?>
				</figure>
					<?php endif; ?>
				<div class="container">
					<div class="row">
						<div class="tabs__text-col col-12 col-sm-12 col-md-6 col-xl-5">
							<?php if ( ! empty( $location_pre_heading ) ) : ?>
								<p class="tabs__location-pre-heading"><?php echo esc_html( $location_pre_heading ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $tab_heading ) ) : ?>
								<h3 class="tabs__heading"><?php echo esc_html( $tab_heading ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $tab_description ) ) : ?>
								<div class="tabs__description"><?php echo wp_kses_post( $tab_description ); ?></div>
							<?php endif; ?>
						</div>
						<?php if ( ! empty( $tab_image ) ) : ?>
						<div class="col-12 col-sm-12 col-md-6">
							<figure class="tabs__image">
								<?php echo wp_kses_post( $tab_image ); ?>
							</figure>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<?php
		endwhile;
		?>
	</div>
</section>
<?php
