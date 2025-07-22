<?php
/**
 * Set thumbnail after save activity post.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Set thumbnail after save activity post.
 *
 * @param mixed      $value The field value.
 * @param int|string $post_id The post ID where the value is saved.
 * @param array      $field The field array containing all settings.
 */
function cheley_set_featured_image( $value, $post_id, $field ) {
	$current_post_type = get_post_type( $post_id );

	if ( 'activity' === $current_post_type ) {
		if ( '' !== $value ) {
			delete_post_thumbnail( $post_id );
			add_post_meta( $post_id, '_thumbnail_id', $value[0] );
		} else {
			delete_post_thumbnail( $post_id );
		}
		return $value;
	}
}

add_filter( 'acf/update_value/name=image_slider', 'cheley_set_featured_image', 10, 3 );
