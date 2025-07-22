<?php
/**
 * Functions related to 829 Filters plugin.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

// phpcs:disable

/**
 * Sample data for filter plugin (this should be formatted as an associative array).
 *
 * Read plugin readme (https://bitbucket.org/829studios/829-blog-category-filters-react/src/master/) for instructions.
 */

/**
 * Pass data to filter plugin here.
 */
if ( class_exists( 'eight29_filters' ) ) {
	add_filter(
		'eight29_filters/set_post_data',
		function( $data ) {
			$data = array(
				"post" => [
					"category" => [
						"label" => "All Categories",
						"type"  => "accordion-single-select",
						"dropdown" => true
					],
					"blog_author" => [
						"label" => "All Authors",
						"type"  => "accordion-single-select",
						"dropdown" => true
					]
				],
				"activity" => [
					"activity_category" => [
						"type"     	   => "accordion-single-select" ,
						"dropdown" 	   => true,
						"label"    	   => "All",
					]
				],
				"staff" => [
					"staff_category" => [
						"type"     	   => "accordion-single-select" ,
						"dropdown" 	   => true,
						"label"    	   => "All",
					]
				]
			);

			return $data;
		}
	);

	// Image Data
	add_filter('eight29_filters/set_image_data', function($data) {
		$data = [
			'post' => ['medium'],
			'activity' => ['activity-card'],
			'staff' => ['activity-card'],
		];

		return $data;
	});

	//Endpoint Global Data
	add_filter('eight29_filters/set_global_data', function($data) {
		$post_placeholder_image = get_field( 'placeholder_image', 'options' );
		if ( ! empty( $post_placeholder_image ) ) {
			$data['post_img_placeholder']['medium']['src'] =  wp_get_attachment_image_src( $post_placeholder_image, 'medium')[0];
			$data['post_img_placeholder']['medium']['srcset'] =  wp_get_attachment_image_srcset( $post_placeholder_image, 'medium');
			$data['post_img_placeholder']['medium']['alt'] =  get_post_meta( $post_placeholder_image, '_wp_attachment_image_alt', TRUE);
			$data['post_img_placeholder']['activity-card']['src'] =  wp_get_attachment_image_src( $post_placeholder_image, 'activity-card')[0];
			$data['post_img_placeholder']['activity-card']['srcset'] =  wp_get_attachment_image_srcset( $post_placeholder_image, 'activity-card');
			$data['post_img_placeholder']['activity-card']['alt'] =  get_post_meta( $post_placeholder_image, '_wp_attachment_image_alt', TRUE);
		}

		return $data;
	});

	add_filter( 'rest_staff_collection_params', 'gmws_add_rest_orderby_params', 10, 1 );
	add_filter( 'rest_activity_collection_params', 'gmws_add_rest_orderby_params', 10, 1 );

	/**
	 * Fix order by menu
	 *
	 * @param  array $params JSON Schema-formatted collection parameter.
	 * @return array $params JSON Schema-formatted collection parameter.
	 */
	function gmws_add_rest_orderby_params( $params ) {

		$params['orderby']['enum'][] = 'menu_order';

		return $params;
	}
}

// phpcs:enable
