<?php
/**
 * Register theme taxonomies
 *
 * Please follow the same format for registering new taxonomies.
 *
 * Reference: https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

namespace BaseTheme\Taxonomies;

/**
 * Get taxonomy labels
 *
 * @param  string $singular  Singular name for the taxonomy.
 * @param  string $plural    Plural name for the taxonomy.
 * @param  string $menu_name Name the taxonomy will appear as in the admin sidebar.
 * @return array             Lables for registering a taxonomy.
 */
function get_labels( string $singular, string $plural = '', string $menu_name = '' ) : array {
	if ( empty( $plural ) ) {
		$plural = $singular . 's';
	}

	if ( empty( $menu_name ) ) {
		$menu_name = $plural;
	}

	return array(
		'name'                       => _x( $plural, 'Taxonomy General Name', 'cheleyCamps' ),
		'singular_name'              => _x( $singular, 'Taxonomy Singular Name', 'cheleyCamps' ),
		'menu_name'                  => __( $menu_name, 'cheleyCamps' ),
		'all_items'                  => __( 'All ' . $plural, 'cheleyCamps' ),
		'parent_item'                => __( 'Parent ' . $singular, 'cheleyCamps' ),
		'parent_item_colon'          => __( 'Parent ' . $singular . ':', 'cheleyCamps' ),
		'new_item_name'              => __( 'New ' . $singular . ' Name', 'cheleyCamps' ),
		'add_new_item'               => __( 'Add New ' . $singular, 'cheleyCamps' ),
		'edit_item'                  => __( 'Edit ' . $singular, 'cheleyCamps' ),
		'update_item'                => __( 'Update ' . $singular, 'cheleyCamps' ),
		'view_item'                  => __( 'View ' . $singular, 'cheleyCamps' ),
		'separate_items_with_commas' => __( 'Separate ' . strtolower( $plural ) . ' with commas', 'cheleyCamps' ),
		'add_or_remove_items'        => __( 'Add or remove ' . strtolower( $plural ), 'cheleyCamps' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'cheleyCamps' ),
		'popular_items'              => __( 'Popular ' . $plural, 'cheleyCamps' ),
		'search_items'               => __( 'Search ' . $plural, 'cheleyCamps' ),
		'not_found'                  => __( 'Not Found', 'cheleyCamps' ),
		'no_terms'                   => __( 'No ' . strtolower( $plural ), 'cheleyCamps' ),
		'items_list'                 => __( $plural . ' list', 'cheleyCamps' ),
		'items_list_navigation'      => __( $plural . ' list navigation', 'cheleyCamps' ),
	);
}

/**
 * Type
 */
function type() {
	$args = array(
		'labels'            => get_labels( 'Type' ),
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
	);

	register_taxonomy( 'type', array( 'post', 'gallery' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\type' );

/**
 * Activities Category
 */
function activity_category() {
	$args = array(
		'labels'            => get_labels( 'Category', 'Categories' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rewrite'           => array(
			'slug'       => 'activity-category',
			'with_front' => false,
		),
	);

	register_taxonomy( 'activity_category', array( 'activity' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\activity_category' );

/**
 * Activities Category
 */
function staff_category() {
	$args = array(
		'labels'            => get_labels( 'Category', 'Categories' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rewrite'           => array(
			'slug'       => 'activity-category',
			'with_front' => false,
		),
	);

	register_taxonomy( 'staff_category', array( 'staff' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\staff_category' );

/**
 * Blog Post Authors
 */
function blog_author() {
	$args = array(
		'labels'            => get_labels( 'Author', 'Authors' ),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rewrite'           => array(
			'slug'       => 'blog-author',
			'with_front' => false,
		),
	);

	register_taxonomy( 'blog_author', array( 'post' ), $args );
}
add_action( 'init', 'BaseTheme\Taxonomies\blog_author' );
