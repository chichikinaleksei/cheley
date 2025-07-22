<?php
/**
 * The footer logos part.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$logos = get_field( 'f_logos', 'options' );

if ( ! empty( $logos ) ) :
	?>
	<div class="col-12 col-xl-4 main-footer__logos-wrapper">
		<div class="main-footer__logos">
		<?php
		foreach ( $logos as $item ) :
			$logo     = wp_get_attachment_image( $item['logo'], 'footer-logo' );
			$img_link = $item['link'];

			if ( ! empty( $img_link ) ) {
				$img_link_url    = $item['link']['url'];
				$img_link_title  = $item['link']['title'];
				$img_link_target = $item['link']['target'] ? ' target="_blank" rel="noopener"' : 'target="_self"';
			}
			?>
			<?php if ( ! empty( $img_link ) ) : ?>
				<a class="main-footer__logos-link" href="<?php echo esc_url( $img_link_url ); ?>"<?php echo wp_kses_post( $img_link_target ); ?> aria-label="<?php echo esc_html( $img_link_title ); ?>">
			<?php endif; ?>
				<?php if ( ! empty( $logo ) ) : ?>
					<figure class="main-footer__logos-image"><?php echo wp_kses_post( $logo ); ?></figure>
				<?php endif; ?>
			<?php if ( ! empty( $img_link ) ) : ?>
				</a>
			<?php endif; ?>
				<?php
		endforeach;
		?>
		</div>
	</div>
	<?php
endif;
?>
