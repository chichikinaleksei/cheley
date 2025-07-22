<?php
/**
 * Block Image Content Tabs
 *
 * Title:       Image Content Tabs
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    image, content, tabs
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

$bicc_tabs = get_field( 'tabs' );

if ( ! empty( $bicc_tabs ) ) : ?>

<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-image-content-tabs tabs">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="tabs__link-list-wrapper">
		<div class="tab-head-wrap">
			<div class="tab-head">
				<ul class="tabs__link-list">
				<?php
				foreach ( $bicc_tabs as $iter => $bicc_tab ) :

					$el_class = 'tabs__link';
					if ( 0 === $iter ) {
						$el_class .= ' active';
					}
					?>
					<li class="<?php esc_attr_e( $el_class ); ?>">
						<a class="tabs_link--inner" href="<?php esc_attr_e( '#' . $iter ); ?>">
						<?php echo esc_html( $bicc_tab['title'] ); ?>
						</a>
					</li>
					<?php
				endforeach;
				?>
				</ul>
			</div>
		</div>
	</div>
	<div class="tabs__tab-content-wrapper">
		<?php include 'inc/tab-content.php'; ?>
	</div>
</section>
	<?php
endif;
