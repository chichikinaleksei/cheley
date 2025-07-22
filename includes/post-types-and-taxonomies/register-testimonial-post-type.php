<?php
/**
 * Testimonial Post Type.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

if ( get_theme_setting( 'use_testimonal_post_type' ) ) {
	$labels = array(
		'name'                  => __( 'Testimonials', 'cheleyCamps' ),
		'singular_name'         => __( 'Testimonial', 'cheleyCamps' ),
		'menu_name'             => __( 'Testimonials', 'cheleyCamps' ),
		'name_admin_bar'        => __( 'Testimonial', 'cheleyCamps' ),
		'add_new'               => __( 'Add New', 'cheleyCamps' ),
		'add_new_item'          => __( 'Add New Testimonial', 'cheleyCamps' ),
		'new_item'              => __( 'New Testimonial', 'cheleyCamps' ),
		'edit_item'             => __( 'Edit Testimonial', 'cheleyCamps' ),
		'view_item'             => __( 'View Testimonial', 'cheleyCamps' ),
		'all_items'             => __( 'All Testimonials', 'cheleyCamps' ),
		'search_items'          => __( 'Search Testimonials', 'cheleyCamps' ),
		'parent_item_colon'     => __( 'Parent Testimonials:', 'cheleyCamps' ),
		'not_found'             => __( 'No testimonials found.', 'cheleyCamps' ),
		'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'cheleyCamps' ),
		'featured_image'        => __( 'Testimonial Cover Image', 'cheleyCamps' ),
		'archives'              => __( 'Testimonial archives', 'cheleyCamps' ),
		'insert_into_item'      => __( 'Insert into testimonial', 'cheleyCamps' ),
		'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'cheleyCamps' ),
		'filter_items_list'     => __( 'Filter testimonials list', 'cheleyCamps' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'cheleyCamps' ),
		'items_list'            => __( 'Testimonials list', 'cheleyCamps' ),
	);

	$args = array(
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-format-chat',
		'public'              => false,
		'has_archive'         => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'exclude_from_search' => true,
		'supports'            => array( 'title' ),
		'rewrite'             => array( 'slug' => 'testimonial' ),
	);

	register_post_type( 'testimonial', $args );
}
