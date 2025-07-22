<?php
/**
 * Hero part for default page
 *
 * Title:       Accordion
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        align-full-width
 * Keywords:    intro, heading
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:
 * JS Deps:
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$main_block_class = 'acf-block block-accordion';

$block_accordion = get_field( 'accordion' );

if ( ! empty( $block_accordion ) ) :
	?><section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="<?php esc_attr_e( $main_block_class ); ?>">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="page-accordion">
			<div class="container">
				<div class="row">
					<div class="<?php echo is_admin() ? esc_attr( 'editor-full-width ' ) : esc_attr( '' ); ?>col-12 col-md-12 col-lg-10 col-xl-8 mx-auto">

						<?php foreach ( $block_accordion as $row ) { ?>
							<div class="bellow<?php echo $row['accordion_item_default_open'] ? ' active' : ''; ?>">
								<div class="bellow__title"><h3 class="h4"><?php esc_html_e( $row['heading'] ); ?></h3></div>
								<div class="bellow__content"<?php echo $row['accordion_item_default_open'] ? ' style="display:block;"' : ''; ?>><?php echo do_shortcode( $row['content'] ); ?></div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</section>
	<?php

endif;
