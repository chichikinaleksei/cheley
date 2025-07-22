<?php
/**
 * Register theme post types
 *
 * Post types should always support revisions.
 * Please follow the same format for registering new post types.
 *
 * Reference: https://developer.wordpress.org/reference/functions/register_post_type/
 * Dashicons for menu_icon: https://developer.wordpress.org/resource/dashicons/
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

namespace BaseTheme\BlockLibrary;

/**
 * Register Block Library post type.
 */
function library_block() {
	$labels = array(
		'name'                  => __( 'Block Library', 'cheleyCamps' ),
		'singular_name'         => __( 'Library Block', 'cheleyCamps' ),
		'menu_name'             => __( 'Block Library', 'cheleyCamps' ),
		'name_admin_bar'        => __( 'Block Library', 'cheleyCamps' ),
		'add_new'               => __( 'Add New', 'cheleyCamps' ),
		'add_new_item'          => __( 'Add New Library Block', 'cheleyCamps' ),
		'new_item'              => __( 'New Library Block', 'cheleyCamps' ),
		'edit_item'             => __( 'Edit Library Block', 'cheleyCamps' ),
		'view_item'             => __( 'View Library Block', 'cheleyCamps' ),
		'all_items'             => __( 'All Library Blocks', 'cheleyCamps' ),
		'search_items'          => __( 'Search Block Library', 'cheleyCamps' ),
		'parent_item_colon'     => __( 'Parent Block Library:', 'cheleyCamps' ),
		'not_found'             => __( 'No library blocks found.', 'cheleyCamps' ),
		'not_found_in_trash'    => __( 'No library blocks found in Trash.', 'cheleyCamps' ),
		'featured_image'        => __( 'Library Block Cover Image', 'cheleyCamps' ),
		'archives'              => __( 'Block library archives', 'cheleyCamps' ),
		'insert_into_item'      => __( 'Insert into library block', 'cheleyCamps' ),
		'uploaded_to_this_item' => __( 'Uploaded to this library block', 'cheleyCamps' ),
		'filter_items_list'     => __( 'Filter block library list', 'cheleyCamps' ),
		'items_list_navigation' => __( 'Block library list navigation', 'cheleyCamps' ),
		'items_list'            => __( 'Block library list', 'cheleyCamps' ),
	);

	register_post_type(
		'library_block',
		array(
			'label'               => __( 'Block Library', 'cheleyCamps' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'revisions', 'editor' ),
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-block-default',
			'has_archive'         => true,
			'show_in_rest'        => true,
			'rewrite'             => array(
				'with_front' => false,
				'slug'       => 'block-library',
			),
		)
	);
}
add_action( 'init', 'BaseTheme\BlockLibrary\library_block' );

/**
 * Exclude library blocks from sitemap.
 *
 * @param bool   $exclude   Default false.
 * @param string $post_type Post type name.
 */
function exclude_from_sitemap( $exclude, $post_type ) {
	if ( 'library_block' === $post_type ) {
		return true;
	}

	return $exclude;
}
add_filter( 'wpseo_sitemap_exclude_post_type', 'BaseTheme\BlockLibrary\exclude_from_sitemap', 10, 2 );

/**
 * Create custom post type links pointing back to the archive.
 *
 * @param string  $post_link The post's permalink.
 * @param WP_Post $post      The post in question.
 * @param bool    $leavename Whether to keep the post name.
 * @param bool    $sample    Is it a sample permalink.
 */
function post_type_link( $post_link, $post, $leavename, $sample ) {
	if ( ! is_a( $post, 'WP_Post' ) ) {
		return $permalink;
	}

	if ( 'library_block' === $post->post_type ) {
		$post_link = get_post_type_archive_link( 'library_block' );
		$content   = get_the_content( null, false, $post->ID );

		if ( ! empty( $content ) ) {
			$post_link = add_query_arg( $post->ID, 'v', $post_link );
		}
	}

	return $post_link;
}
add_filter( 'post_type_link', 'BaseTheme\BlockLibrary\post_type_link', 10, 4 );

/**
 * Redirect single library blocks to block library archive.
 */
function redirect_single_library_blocks() {
	if ( is_singular( 'library_block' ) ) {
		$post_link = get_post_type_archive_link( 'library_block' );
		wp_safe_redirect( $post_link );
		exit;
	}
}
add_action( 'wp', 'BaseTheme\BlockLibrary\redirect_single_library_blocks', 10, 4 );
