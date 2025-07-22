<?php
/**
 * Staff archive custom post type hero.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$archive_post_type = get_post_type_object( get_post_type() );
$heading           = get_field( 'staff_heading', 'options' ) ? get_field( 'staff_heading', 'options' ) : $archive_post_type->labels->name;
$background_image  = get_field( 'staff_background_image', 'options' );
$description       = get_field( 'staff_description', 'options' );

?>

<section class="activities-hero">
	<div class="activities-hero__top">
	<?php if ( wp_attachment_is_image( $background_image ) ) : ?>
		<figure class="activities-hero__image"><?php echo wp_get_attachment_image( $background_image, 'size-full' ); ?></figure>
	<?php endif; ?>
		<div class="container">
			<h1 class="activities-hero__title"><?php echo esc_html( $heading ); ?></h1>
		</div>
	</div>
	<?php if ( ! empty( $description ) ) : ?>
	<div class="activities-hero__bottom">
		<div class="container">
			<p class="activities-hero__desc"><?php echo esc_html( $description ); ?></p>
		</div>
	</div>
	<?php endif; ?>
</section>
