<?php
/**
 * Standardize page and post content.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Fix any abnormalities in the content caused by mixing Gutenberg Blocks and Shortcodes.
 *
 * @param string $content Content of the current post.
 */
function standardize_content( $content ) {
	return preg_replace( '/<div class="container">[\s]*<div class="row">[\s]*<div class="col-12 col-md-12 col-lg-10 col-xl-8 mx-auto">[\s]*<\/div>[\s]*<\/div>[\s]*<\/div>/', '', $content );
}
add_filter( 'the_content', 'standardize_content', 100 );
