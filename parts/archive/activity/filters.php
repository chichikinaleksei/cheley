<?php
/**
 * Activity archive custom post type filters.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

if ( class_exists( 'eight29_filters' ) && ! is_search() ) :

	// phpcs:disable WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
	$args = array(
		'post_type'          => get_post_type(),
		'pagination_style'   => 'more',
		'posts_per_page'     => get_option( 'posts_per_page' ),
		'posts_per_row'      => 4,
		'hide_uncategorized' => 'true',
		'display_search'     => 'false',
		'display_excerpt'    => 'false',
		'display_date'       => 'false',
		'order_by'					 => 'menu_order',
		'order'							 => 'ASC'
	);
	// phpcs:enable

	$parsed_args = http_build_query( $args, '', ' ' );
	?>

<section class="activities-archive-filters">
	<div class="container">
		<?php echo do_shortcode( "[eight29_filters $parsed_args]" ); ?>
	</div>
</section>

	<?php
endif;
