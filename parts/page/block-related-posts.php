<?php
/**
 * Related Posts
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$manual        = get_sub_field( 'manual' );
$block_style   = get_sub_field( 'block_style' );
$section_title = isset( $section_title ) ? $section_title : get_sub_field( 'section_title' );
$filters       = isset( $filters ) ? $filters : get_sub_field( 'filter' );
$related_posts = array();
if ( is_array( $manual ) && count( $manual ) ) {
	$related_posts = $manual;
} else {

	$args = array(
		'posts_per_page' => 3,
	);

	if ( false !== $filters && strlen( $filters['post_type'] ) ) {
		$args['post_type'] = $filters['post_type'];

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
	}

	$related_posts = get_posts( $args );
}

if ( ! empty( $related_posts ) ) :
	$this_post_type = get_post_type_object( $related_posts[0]->post_type );
	?>

	<section
		<?php echo Content_Block::get_block_id_attr(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		class="block-related-posts related-posts block-related-posts--<?php esc_attr_e( $block_style ); ?>"
	>
		<?php echo Content_Block::get_block_spacing(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div class="container">
			<div class="related-posts__top block-title">
				<h2 class="related-posts__title"><?php echo ! empty( $section_title ) ? esc_html( $section_title ) : 'Related Posts'; ?></h2>
				<a class="related-posts__all-link" href="<?php echo esc_url( get_post_type_archive_link( $this_post_type->name ) ); ?>">
					<span class="c-btn-text">All <?php esc_html_e( $this_post_type->label ); ?></span>
					<i class="icon-arrow-forward"></i>
				</a>
			</div>

			<div class="row">
				<?php
				foreach ( $related_posts as $key => $related_post ) {
					$image_id  = get_placeholder_image_id( $related_post );
					$image     = wp_get_attachment_image( $image_id, 'medium' ); // TODO: real image size.
					$permalink = get_permalink( $related_post );
					?>
						<div class="col-sm-12 col-md-4">
							<div class="related-posts__block">
								<?php if ( ! empty( $image ) ) : ?>
									<a
										href="<?php echo esc_url( $permalink ); ?>"
										class="related-posts__image"
										data-mirror-hover="#title-<?php esc_attr_e( get_row_index() . '-' . $key ); ?>"
									>
										<?php echo wp_kses_post( $image ); ?>
									</a>
								<?php endif; ?>

								<?php do_action( 'related_posts_before_title', $related_post ); ?>

								<h3
									class="related-posts__post-title"
								>
									<a
										href="<?php echo esc_url( $permalink ); ?>"
										id="title-<?php esc_attr_e( get_row_index() . '-' . $key ); ?>"
										><?php esc_html_e( $related_post->post_title ); ?></a
									>
								</h3>
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
