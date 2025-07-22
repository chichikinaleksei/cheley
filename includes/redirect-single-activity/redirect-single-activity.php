<?php
/**
 * Redirect from single event
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

add_action(
	'template_redirect',
	function () {
		global $post;
		if ( is_singular( 'activity' ) ) {
			global $wp_query;
			$wp_query->posts = array();
			$wp_query->post  = null;
			$wp_query->set_404();
			status_header( 404 );
			nocache_headers();
		}
	}
);
