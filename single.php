<?php
/**
 * The single post page template.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

get_header();
the_post();

$category_ids = wp_get_post_categories( $post->ID );

$categories = array_reduce(
	$category_ids,
	function( $array, $category_id ) {
		if ( 1 !== $category_id ) {
			$array[] = get_cat_name( $category_id );
		}

		return $array;
	}
);

$tags                   = get_tags();
$thumbnail              = get_the_post_thumbnail( get_the_ID(), 'post-hero' );
$blog_archive_back_link = get_field( 'blog_archive_back_link', 'options' );
$related_title          = get_field( 'ps_related_posts_title', 'options' );
$related_link           = get_field( 'ps_all_posts_link', 'options' );

?>
	<article class="post-single">
		<div class="post-single__top">
			<div class="container">
				<header>
					<?php if ( ! empty( $blog_archive_back_link ) ) : ?>
						<?php
						$archive_back_link_url    = $blog_archive_back_link['url'];
						$archive_back_link_target = $blog_archive_back_link['target'] ? ' target="_blank" rel="noopener"' : null;
						$archive_back_link_title  = $blog_archive_back_link['title'];
						?>
					<a class="post-single__back-link c-btn btn-tertiary icon-left" href="<?php echo esc_url( $archive_back_link_url ); ?>" <?php echo wp_kses_post( $archive_back_link_target ); ?>>
						<i class="icon-chev-left"></i>
						<span class="c-btn-text"><?php echo esc_html( $archive_back_link_title ); ?>
					</a>
					<?php endif; ?>
					<div class="row">
						<div class="col-12 col-md-10 col-lg-8 mx-auto">
							<div class="post-single__top-content-wrapper">
								<?php if ( ! empty( $categories ) ) : ?>
									<div class="post-single__categories"><?php esc_html_e( implode( ', ', $categories ) ); ?></div>
								<?php endif; ?>

								<h1 class="post-single__title"><?php the_title(); ?></h1>

								<div class="post-single__tagline">
									<address class="post-single__author">By <a rel="author"><?php the_author(); ?></a></address>
									<time class="post-single__date"><?php the_date(); ?></time>
								</div>
							</div>
						</div>
					</div>
					<?php if ( ! empty( $thumbnail ) ) : ?>
						<figure class="post-single__thumbnail">
							<?php echo wp_kses_post( $thumbnail ); ?>
						</figure>
					<?php endif; ?>
				</header>
			</div>
		</div>

		<div class="post-single__content page-content">
			<?php default_content(); ?>
		</div>

		<footer class="post-single__footer">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6 offset-lg-1 col-lg-4 offset-xl-2">
						<?php if ( ! empty( $tags ) ) : ?>
							<div class="post-single__tags">
								<div class="post-single__tags-title overline">Tags</div>
								<div class="d-flex flex-wrap">
									<?php foreach ( $tags as $item ) : ?>
										<a class="post-single__tag" href="<?php echo esc_url( get_tag_link( $item ) ); ?>"><?php esc_html_e( $item->name ); ?></a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-12 col-md-6 col-xl-4">
						<?php get_theme_part( 'global/share-icons' ); ?>
					</div>
				</div>
			</div>
		</footer>
	</article>
	<?php
	$category   = wp_get_post_terms( get_the_ID(), 'category' );
	$categories = array();

	if ( has_category() ) {
		foreach ( $category as $single ) {
			array_push( $categories, $single->term_id );
		}
	}

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => array( get_queried_object()->ID ),
	);

	if ( ! empty( $categories ) ) {
		// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $categories,
			),
		);
	}

	$related_posts = get_posts( $args );
	if ( ! empty( $related_posts ) ) :
		add_block_css( 'related-posts' );
		get_theme_part(
			'../acf-blocks/related-posts/block',
			array(
				'block'              => array( 'id' => 'block_' . get_queried_object()->ID . '_related' ),
				'manual'             => $related_posts,
				'related_posts_link' => $related_link,
				'section_title'      => $related_title,
			)
		);
	endif;
	?>
	<?php
	get_footer();
