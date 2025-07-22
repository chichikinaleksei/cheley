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

namespace BaseTheme\PostTypes;

/**
 * Get post type labels
 *
 * @param  string $singular  Singular name for the post type.
 * @param  string $plural    Plural name for the post type.
 * @param  string $menu_name Name the post type will appear as in the admin sidebar.
 * @return array             Lables for registering a post type.
 */
function get_labels( string $singular, string $plural = '', string $menu_name = '' ) : array {
	if ( empty( $plural ) ) {
		$plural = $singular . 's';
	}

	if ( empty( $menu_name ) ) {
		$menu_name = $plural;
	}

	return array(
		'name'                  => _x( $plural, 'Post Type General Name', 'cheleyCamps' ),
		'singular_name'         => _x( $singular, 'Post Type Singular Name', 'cheleyCamps' ),
		'menu_name'             => __( $menu_name, 'cheleyCamps' ),
		'name_admin_bar'        => __( $singular, 'cheleyCamps' ),
		'archives'              => __( $singular . ' Archives', 'cheleyCamps' ),
		'attributes'            => __( $singular . ' Attributes', 'cheleyCamps' ),
		'parent_item_colon'     => __( 'Parent ' . $singular, 'cheleyCamps' ),
		'all_items'             => __( 'All ' . $plural, 'cheleyCamps' ),
		'add_new_item'          => __( 'Add New ' . $singular, 'cheleyCamps' ),
		'add_new'               => __( 'Add New', 'cheleyCamps' ),
		'new_item'              => __( 'New ' . $singular, 'cheleyCamps' ),
		'edit_item'             => __( 'Edit ' . $singular, 'cheleyCamps' ),
		'update_item'           => __( 'Update ' . $singular, 'cheleyCamps' ),
		'view_item'             => __( 'View ' . $singular, 'cheleyCamps' ),
		'view_items'            => __( 'View ' . $plural, 'cheleyCamps' ),
		'search_items'          => __( 'Search ' . $singular, 'cheleyCamps' ),
		'not_found'             => __( 'Not found', 'cheleyCamps' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cheleyCamps' ),
		'featured_image'        => __( 'Featured Image', 'cheleyCamps' ),
		'set_featured_image'    => __( 'Set featured image', 'cheleyCamps' ),
		'remove_featured_image' => __( 'Remove featured image', 'cheleyCamps' ),
		'use_featured_image'    => __( 'Use as featured image', 'cheleyCamps' ),
		'insert_into_item'      => __( 'Insert into ' . strtolower( $singular ), 'cheleyCamps' ),
		'uploaded_to_this_item' => __( 'Uploaded to this ' . strtolower( $singular ), 'cheleyCamps' ),
		'items_list'            => __( $plural . ' list', 'cheleyCamps' ),
		'items_list_navigation' => __( $plural . ' list navigation', 'cheleyCamps' ),
		'filter_items_list'     => __( 'Filter ' . strtolower( $plural ) . ' list', 'cheleyCamps' ),
	);
}

/**
 * Register Gallery post type.
 */
function gallery() {
	register_post_type(
		'gallery',
		array(
			'label'               => __( 'Gallery', 'cheleyCamps' ),
			'labels'              => get_labels( 'Gallery', 'Galleries' ),
			'supports'            => array( 'title', 'revisions' ),
			'taxonomies'          => array(),
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-format-gallery',
			'has_archive'         => false,
		)
	);
}
add_action( 'init', 'BaseTheme\PostTypes\gallery' );

/**
 * Register Activities post type.
 */
function activities() {
	register_post_type(
		'activity',
		array(
			'label'        => __( 'Activity', 'cheleyCamps' ),
			'labels'       => get_labels( 'Activity', 'Activities' ),
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'taxonomies'   => array(),
			'public'       => true,
			'menu_icon'    => 'dashicons-games',
			'has_archive'  => true,
			'show_in_rest' => true,
			'rewrite'      => array(
				'slug'       => 'activities',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'BaseTheme\PostTypes\activities' );

/**
 * Register Staff  post type.
 */
function staff() {
	register_post_type(
		'staff',
		array(
			'label'        => __( 'Staff', 'cheleyCamps' ),
			'labels'       => get_labels( 'Staff', 'Staff' ),
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'taxonomies'   => array(),
			'public'       => true,
			'menu_icon'    => 'dashicons-businessperson',
			'has_archive'  => true,
			'show_in_rest' => true,
			'rewrite'      => array(
				'slug'       => 'staff',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'BaseTheme\PostTypes\staff' );
