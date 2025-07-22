<?php
/**
 * Block Enrollment Countdown
 *
 * Title:       Enrollment Countdown
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    enrollment, countdown
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

$header          = get_field( 'header' );
$countdown       = get_field( 'countdown' );
$cta_first_link  = get_field( 'enroll_cta_first_link' );
$cta_second_link = get_field( 'enroll_cta_second_link' );

if ( ! empty( $header ) || ! empty( $countdown ) || ! empty( $cta_first_link ) || ! empty( $cta_second_link ) ) :
	?>
	<section id="<?php echo esc_attr( $content_block->get_block_id() ); ?>" class="acf-block block-enrollment-countdown">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<?php if ( ! empty( $header ) ) : ?>
				<h2 class="block-enrollment-countdown__title"><?php echo esc_html( $header ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $countdown ) ) : ?>
				<div class="row block-enrollment-countdown__counters">
					<?php
					$today = gmdate( 'Y-m-d' );

					foreach ( $countdown as $item ) :
						$item_date        = ! empty( $item['date'] ) ? $item['date'] : 0;
						$interval         = strtotime( $item_date ) - strtotime( $today );
						$days             = $interval / 86400;
						$day_string       = $days > 1 ? esc_html__( 'days', 'cheleyCamps' ) : esc_html__( 'day', 'cheleyCamps' );
						$item_description = $item['description'];

						?>
						<div class="col-12 col-md-6 col-lg-3 block-enrollment-countdown__counter-wrapper">
							<div class="block-enrollment-countdown__counter">
								<?php if ( ! empty( $item_date ) ) : ?>
									<div class="block-enrollment-countdown__counter-days">
									<?php echo esc_html( $days >= 0 ? $days : 0 ) . ' ' . esc_html( $day_string ); ?>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $item_description ) ) : ?>
									<p class="block-enrollment-countdown__counter-description"><?php echo esc_html( $item_description ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<?php
					endforeach;
					?>
					<?php if ( ! empty( $cta_first_link ) || ! empty( $cta_second_link ) ) : ?>
						<div class="col-12 col-md-6 col-lg-3 block-enrollment-countdown__buttons-wrapper">
							<div class="block-enrollment-countdown__buttons">
								<?php
								if ( ! empty( $cta_first_link ) ) :
									echo wp_kses_post( Content_Block_Gutenberg::acf_link( $cta_first_link, 'c-btn c-btn-primary', false ) );
								endif;
								if ( ! empty( $cta_second_link ) ) :
									echo wp_kses_post( Content_Block_Gutenberg::acf_link( $cta_second_link, 'c-btn c-btn-secondary', false ) );
								endif;
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;
