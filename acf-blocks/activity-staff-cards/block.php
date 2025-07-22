<?php
/**
 * Block Activity and Staff Cards
 *
 * Title:       Activity and Staff Cards
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    activity, staff, cards
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

$block_title = get_field( 'title' );
$block_type  = get_field( 'type' );
$activities  = get_field( 'activities' );
$staff_cards = get_field( 'staff_cards' );
$is_staff    = 'staff' === $block_type ? true : false;
$items       = $is_staff ? $staff_cards : $activities;

if ( ! empty( $block_title ) || ! empty( $activities ) || ! empty( $staff_cards ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-activity-staff block-activity-staff--<?php echo esc_attr( $block_type ); ?>" data-lightbox-wrapper>
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<?php if ( ! empty( $block_title ) ) : ?>
				<h2 class="block-activity-staff__title"><?php echo esc_html( $block_title ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $items ) ) : ?>
				<div class="row activities-posts">
					<?php
					get_template_part(
						'acf-blocks/activity-staff-cards/inc/posts',
						false,
						array(
							'items'    => $items,
							'is_staff' => $is_staff,
						)
					);
					?>
				</div>
				<div class="activities-lightbox" data-lightbox>
					<button class="activities-lightbox__close" aria-label="Close Lightbox" data-lightbox-close></button>
					<div class="activities-lightbox__container">
						<div class="activities-lightbox__wrapper" data-lightbox-slider>
							<?php
							get_template_part(
								'acf-blocks/activity-staff-cards/inc/posts',
								false,
								array(
									'items'       => $items,
									'is_staff'    => $is_staff,
									'is_lightbox' => true,
								)
							);
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;
