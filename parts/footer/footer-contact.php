<?php
/**
 * The footer contact part.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$contact_title   = get_field( 'f_contact_title', 'options' );
$contact_content = get_field( 'f_contact_content', 'options' );
$social          = get_field( 'f_social', 'options' );

if ( ! empty( $contact_title ) || ! empty( $contact_content ) ) :
	?>
	<div class="col-12 col-md-4 col-xl-2 main-footer__contact-content-wrapper">
		<div class="main-footer__contact-content">
			<?php if ( ! empty( $contact_title ) ) : ?>
				<p class="is-style-overline overline main-footer__contact-title">
					<?php echo esc_html( $contact_title ); ?>
			<?php endif; ?>
			<?php if ( ! empty( $contact_content ) ) : ?>
				<div class="main-footer__contact-contents">
				<?php
				foreach ( $contact_content as $content ) :
					$text = $content['content'];

					if ( ! empty( $text ) ) :
						?>
						<div class="main-footer__contact-contents-item">
							<?php echo wp_kses_post( $text ); ?>
						</div>
						<?php
					endif;
				endforeach;
				?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $social ) ) : ?>
			<div class="main-footer__social-wrapper d-none d-md-block d-xl-none">
				<?php get_theme_part( 'footer/footer-social' ); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php
endif;
?>
