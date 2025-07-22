<?php
/**
 * Gets the placeholder image ID
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Gets the placeholder image ID
 *
 * @param  WP_Post|int $post The post object or post ID.
 * @return string            The posts image or featured image.
 */
function get_placeholder_image_id( $post = '' ) {
	if ( ! empty( $post ) ) {
		$image_id = get_post_thumbnail_id( $post );

		if ( 0 !== $image_id ) {
			return $image_id;
		}
	}

	return get_field( 'placeholder_image', 'option' );
}
