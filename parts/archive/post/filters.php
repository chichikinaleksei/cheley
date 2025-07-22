<?php
/**
 * Post Archive filters.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

if ( class_exists( 'eight29_filters' ) && ! is_search() ) :

	$is_cat        = is_category() || is_tag() || is_author();
	$is_tax        = get_queried_object()->taxonomy;
	$excluded_post = get_field( 'blog_archive_related_post', 'option' );

	// phpcs:disable WordPress.WP.PostsPerPage.posts_per_page_posts_per_page
	$args = array(
		'post_type'          => get_post_type(),
		'pagination_style'   => 'pagination',
		'posts_per_page'     => get_option( 'posts_per_page' ),
		'posts_per_row'      => 3,
		'display_sidebar'    => $is_cat || $is_tax ? 'false' : 'true',
		'taxonomy'           => is_tag() || is_category() || $is_tax ? $is_tax : null,
		'term_id'            => is_category() || $is_tax ? get_queried_object()->term_id : null,
		'tag_id'             => is_tag() ? get_queried_object()->term_id : null,
		'author_id'          => is_author() ? get_queried_object()->ID : null,
		'hide_uncategorized' => 'true',
		'display_search'     => 'true',
		'display_date'       => 'true',
		'exclude_posts'      => ! $is_cat || ! $is_tax ? $excluded_post[0] : null,
	);
	// phpcs:enable

	$parsed_args = http_build_query( $args, '', ' ' );
	?>

<section class="blog-archive-filters">
	<div class="container">
		<?php echo do_shortcode( "[eight29_filters $parsed_args]" ); ?>
	</div>
</section>

	<?php
endif;
