<?php
/**
 * Related Posts
 *
 * Title:       Related Posts
 * Description: A custom block.
 * Category:    etn-blocks
 * Icon:        admin-comments
 * Keywords:    author, spotlight
 * Post Types:  all
 * Multiple:    true
 * Active:      true
 * CSS Deps:
 * JS Deps:
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$manual        = isset( $manual ) ? $manual : get_field( 'manual' );
$block_style   = isset( $block_style ) ? $block_style : get_sub_field( 'block_style' );
$section_title = isset( $section_title ) ? $section_title : get_field( 'section_title' );
$filters       = isset( $filters ) ? $filters : get_field( 'filter' );
$related_posts = array();
if ( is_array( $manual ) && count( $manual ) ) {
	$related_posts = $manual;
} else {

	$args = array(
		'posts_per_page' => 3,
	);

	if ( strlen( $filters['post_type'] ) ) {
		$args['post_type'] = $filters['post_type'];
	}

	if ( ! empty( $filters['terms'] ) ) {
		// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		$args['tax_query'] = array(
			array(
				'taxonomy' => $filters['taxonomy'],
				'field'    => 'slug',
				'terms'    => $filters['terms'],
			),
		);
	}

	$related_posts = get_posts( $args );
}

if ( ! empty( $related_posts ) ) :
	$this_post_type = get_post_type_object( $related_posts[0]->post_type );
	?>

	<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-related-posts related-posts block-related-posts--<?php esc_attr_e( $block_style ); ?>">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<div class="related-posts__top block-title">
				<h2 class="related-posts__title"><?php esc_html_e( $section_title ); ?></h2>
				<a class="related-posts__all-link c-btn c-btn-tertiary c-btn-color-normal c-btn-icon-right" href="<?php echo esc_url( get_post_type_archive_link( $this_post_type->name ) ); ?>"
					><span class="c-btn-text">All <?php esc_html_e( $this_post_type->label ); ?></span><i class="icon-arrow-forward"></i></a
				>
			</div>

			<div class="row">
				<?php
				foreach ( $related_posts as $key => $related_post ) {
					$image_id          = get_placeholder_image_id( $related_post );
					$image             = wp_get_attachment_image( $image_id, 'post-card' ); // TODO: real image size.
					$permalink         = get_permalink( $related_post );
					$author_id         = get_post_field( 'post_author', $related_post );
					$author_first_name = get_the_author_meta( 'first_name', $author_id );
					$author_last_name  = get_the_author_meta( 'last_name', $author_id );
					?>
						<div class="col-sm-12 col-md-4">
							<div class="post-card">
								<?php if ( ! empty( $image ) ) : ?>
									<a 
										href="<?php echo esc_url( $permalink ); ?>" 
										class="post-card__image"
										data-mirror-hover="#title-<?php esc_attr_e( get_row_index() . '-' . $key ); ?>"
										aria-label="Post Image"
									>
										<?php echo wp_kses_post( $image ); ?>
									</a>
								<?php endif; ?>

								<?php do_action( 'related_posts_before_title', $related_post ); ?>

								<h3 class="post-card__title">
									<a 
										href="<?php echo esc_url( $permalink ); ?>"
										id="title-<?php esc_attr_e( get_row_index() . '-' . $key ); ?>" 
										><?php esc_html_e( $related_post->post_title ); ?></a
									>
								</h3>
								<p class="post-card__author"><?php echo esc_html__( 'By', 'cheleyCamps' ) . ' ' . esc_html( $author_first_name . ' ' . $author_last_name ); ?></p>
								<p class="post-card__date"><?php echo esc_html( get_the_date() ); ?></p>
							</div>
						</div>

					<?php
				}
				?>
			</div>
		</div>
	</section>

	<?php
endif;
