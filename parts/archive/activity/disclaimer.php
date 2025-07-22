<?php
/**
 * Activity archive disclaimer.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$disclaimer_title = get_field( 'aa_disc_title', 'option' );
$disclaimer_desc  = get_field( 'aa_disc_description', 'option' );

if ( ! empty( $disclaimer_title ) || ! empty( $disclaimer_desc ) ) :
	?>
<section class="activities-archive-disclaimer">
	<div class="container">
		<div class="activities-archive-disclaimer__wrapper">
		<?php if ( ! empty( $disclaimer_title ) ) : ?>
			<p class="activities-archive-disclaimer__title overline"><?php echo esc_html( $disclaimer_title ); ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $disclaimer_desc ) ) : ?>
			<p class="activities-archive-disclaimer__text"><?php echo esc_html( $disclaimer_desc ); ?></p>
		<?php endif; ?>
		</div>
	</div>
</section>
	<?php
endif;
