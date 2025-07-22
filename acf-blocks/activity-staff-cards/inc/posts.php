<?php
/**
 * Activity Staff Cards - posts partial
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps  1.0
 */

$items       = $args['items'];
$is_staff    = $args['is_staff'];
$is_lightbox = $args['is_lightbox'];

foreach ( $items as $key => $item ) :
	$item_label                = $is_staff ? $item['optional_card_tag'] : get_field( 'card_label', $item );
	$image_slider              = $is_staff ? $item['image_slider_gallery'] : get_field( 'image_slider', $item );
	$item_image                = ! empty( $image_slider ) ? wp_get_attachment_image( $image_slider[0], 'activity-card' ) : null;
	$item_title                = $is_staff ? $item['staff_name'] : get_the_title( $item );
	$item_category             = $is_staff ? $item['position'] : get_yoast_primary_term( 'activity_category', $item );
	$item_text                 = $is_staff ? $item['description'] : apply_filters( 'the_content', get_post( $item )->post_content );
	$item_duration             = ! $is_staff ? get_field( 'activity_duration', $item ) : null;
	$item_fav_activities       = $is_staff ? $item['favorite_activities'] : get_field( 'unit_availability_links', $item );
	$item_fav_activities_title = $is_staff ? $item_title . '\'s ' . esc_html__( 'favorite activities', 'cheleyCamps' ) : get_field( 'unit_availability_title', $item );

	if ( $is_lightbox ) :
		?>
		<div class="activities-lightbox-item-wraper">
			<div class="activities-lightbox-item">
				<div class="activities-lightbox-item__images">
					<?php if ( ! empty( $item_label ) ) : ?>
							<p class="activities-lightbox-item__label"><?php echo esc_html( $item_label ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $image_slider ) ) : ?>
						<div class="activities-lightbox-item__slider">
							<?php
							foreach ( $image_slider as $item ) :
								$image = wp_get_attachment_image( $item, 'activity-slider' );
								?>
								<figure class="activities-lightbox-item__slide">
									<?php echo wp_kses_post( $image ); ?>
								</figure>
								<?php
							endforeach;
							?>
						</div>
					<?php endif; ?>
				</div>
				<div class="activities-lightbox-item__content">
					<div class="activities-lightbox-item__content-wrapper">
						<?php if ( ! empty( $item_category ) ) : ?>
							<p class="activities-lightbox-item__category"><?php echo esc_html( $item_category ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $item_title ) ) : ?>
							<h2 class="activities-lightbox-item__title"><?php echo esc_html( $item_title ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $item_duration ) ) : ?>
							<p class="activities-lightbox-item__duration"><?php echo esc_html( $item_duration ); ?></p>
						<?php endif; ?>
							<div class="activities-lightbox-item__text"><?php echo wp_kses_post( $item_text ); ?></div>
						<?php if ( ! empty( $item_fav_activities ) ) : ?>
							<div class="activities-lightbox-item__activities">
								<p class="activities-lightbox-item__activities-title"><?php echo esc_html( $item_fav_activities_title ); ?></p>
							</div>
							<ul class="is-style-default activities-lightbox-item__activities-lists">
								<?php
								foreach ( $item_fav_activities as $item ) :
									echo '<li>';
									if ( $is_staff ) :
										$item_link  = get_permalink( $item );
										$item_title = get_the_title( $item );
										?>
										<a href="<?php echo esc_url( $item_link ); ?>"><?php echo esc_html( $item_title ); ?></a>
										<?php
									else :
										echo wp_kses_post( Content_Block_Gutenberg::acf_link( $item['link'], false, false ) );
									endif;
									echo '</li>';
								endforeach;
								?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		else :
			?>
			<div class="col-12 col-lg-4 activity-card-wrapper">
				<div class="activity-card" data-item="#<?php echo esc_html( $key ); ?>" data-lightbox-trigger>
					<?php if ( ! empty( $item_label ) || ! empty( $item_image ) ) : ?>
						<div class="activity-card__header">
							<?php if ( ! empty( $item_label ) ) : ?>
								<p class="activity-card__label"><?php echo esc_html( $item_label ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $item_image ) ) : ?>
								<figure class="activity-card__image"><?php echo wp_kses_post( $item_image ); ?></figure>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<div class="activity-card__content">
						<?php if ( ! empty( $item_category ) ) : ?>
							<p class="activity-card__category"><?php echo esc_html( $item_category ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $item_title ) ) : ?>
							<h4 class="activity-card__title"><?php echo esc_html( $item_title ); ?></h4>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
		endif;
endforeach;
