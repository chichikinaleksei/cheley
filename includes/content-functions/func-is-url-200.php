<?php
/**
 * Determine if a url will return a 200 response.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Determine if a url will return a 200 response.
 *
 * @param string $url The url in question.
 */
function is_url_200( $url ) {
	$headers = get_headers( $url, 1 );

	if ( strpos( $headers[0], '200' ) === false ) {
		return false;
	} else {
		return true;
	}
}
