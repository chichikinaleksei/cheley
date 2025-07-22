<?php
/**
 * Post Archive hero related/featured post.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$related_post  = isset( $related_post ) ? $related_post : false;
$p_url         = get_permalink( $related_post );
$p_thumb_id    = get_post_thumbnail_id( $related_post );
$p_title       = get_the_title( $related_post );
$p_cat         = get_primary_taxonomy_term( $related_post );
$p_excerpt     = get_the_excerpt( $related_post );
$p_author_id   = get_post_field( 'post_author', $related_post );
$p_author_name = get_the_author_meta( 'nickname', $p_author_id );
$p_date        = get_the_date( 'F j, Y' );

?>

<article class="blog-hero-related">
	<div class="row">
		<div class="col-12 col-lg-8">
		<?php if ( wp_attachment_is_image( $p_thumb_id ) ) : ?>
			<a class="blog-hero-related__image-link" aria-label="<?php echo esc_html( $p_cat['title'] ); ?>"href="<?php echo esc_url( $p_url ); ?>" >
				<figure class="blog-hero-related__image"><?php echo wp_get_attachment_image( $p_thumb_id, 'blog-related' ); ?></figure>
			</a>
		<?php endif; ?>
		</div>
		<div class="col-12 col-lg-4">
		<?php if ( ! empty( $p_cat ) ) : ?>
			<a href="<?php echo esc_url( $p_cat['url'] ); ?>" class="blog-hero-related__cat h6">
				<?php echo esc_html( $p_cat['title'] ); ?>
			</a>
		<?php endif; ?>
			<a class="blog-hero-related__link" href="<?php echo esc_url( $p_url ); ?>">
				<h2 class="blog-hero-related__title"><?php echo esc_html( $p_title ); ?></h2>
			</a>
			<?php if ( ! empty( $p_excerpt ) ) : ?>
			<p class="blog-hero-related__excerpt"><?php echo esc_html( $p_excerpt ); ?></p>
			<?php endif; ?>
			<p class="blog-hero-related__author">
			<?php esc_html_e( 'By', 'cheleyCamps' ); ?> <?php echo esc_html( $p_author_name ); ?>
			</p>
			<p class="blog-hero-related__date"><?php echo esc_html( $p_date ); ?></p>
		</div>
	</div>
</article>
