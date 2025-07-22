<?php
/**
 * Disallow indexing of your site on non-production environments.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

if ( function_exists( 'env' ) !== false && env( 'DISALLOW_INDEXING' ) !== false ) {
	add_action( 'pre_option_blog_public', '__return_zero' );
}
