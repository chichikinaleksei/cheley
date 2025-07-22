<?php
/**
 * Hook into related posts block.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

add_action(
	'related_posts_before_title',
	function( $post ) {
		if ( 'post' === $post->post_type ) {
			$cat_ids    = wp_get_post_categories( $post->ID );
			$categories = array();
			foreach ( $cat_ids as $cat_id ) {
				if ( 1 !== $cat_id ) {
					$categories[] = get_cat_name( $cat_id );
				}
			}
			?>
			<div class="post-card__category">
				<?php esc_html_e( implode( ', ', $categories ) ); ?>
			</div>
			<?php
		}
	}
);
