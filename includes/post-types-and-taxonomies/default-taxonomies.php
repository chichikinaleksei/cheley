<?php
/**
 * Set default taxonomies
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Set the Blog Post Author term on saving the Post.
 *
 * @param  int     $post_id Post ID to relate to.
 * @param  WP_Post $post    The object to relate to.
 */
function set_default_post_author( $post_id, $post ) {
	if ( 'publish' === $post->post_status && 'post' === $post->post_type ) {

		$terms = wp_get_post_terms( $post_id, 'blog_author' );

		$author_id = get_post_field( 'post_author', $post_id ) ?? get_the_author_meta( 'ID' );

		// If this is a 829 user, replace with the default author.
		$author_email = get_the_author_meta( 'user_email', $author_id );
		$etn_domain   = '829';
		$is_829_user  = strpos( $author_email, $etn_domain );
		if ( false !== $is_829_user ) {
			$author_name = get_bloginfo( 'name' );
		} else {
			$author_name = get_the_author_meta( 'display_name', $author_id );
		}

		if ( empty( $terms ) ) {
			// The function will create a new term if no matching term is found.
			wp_set_object_terms( $post_id, $author_name, 'blog_author' );
		}
	}
}
add_action( 'save_post', 'set_default_post_author', 100, 2 );
