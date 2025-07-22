<?php
/**
 * Rest API ACF Fields
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * ACF Activity fields for REST API
 *
 * @param WP_REST_Response $response   The response object.
 * @param WP_Post          $post       Post object.
 * @param WP_REST_Request  $request    Request object.
 */
function acf_activity( $response, $post, $request ) {
	$images_slider = get_field( 'image_slider', $post );
	$images        = array();

	if ( $images_slider ) {
		foreach ( $images_slider as $image ) {
			$images[] = wp_get_attachment_image( $image, 'activity-slider' );
		}
	}

	$response->data['acf_images_slider'] = $images;
	return $response;
}
add_filter( 'rest_prepare_activity', 'acf_activity', 10, 3 );
