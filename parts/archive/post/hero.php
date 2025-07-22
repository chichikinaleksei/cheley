<?php
/**
 * Post Archive hero.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

$archive_post_type = get_post_type_object( get_post_type() );
$is_category       = is_category() ? true : false;
$is_tag            = is_tag() ? true : false;
$is_author         = is_author() ? true : false;
$is_blog           = ( ! $is_category && ! $is_tag && ! $is_author ) ? true : false;

$archive_title        = '';
$archive_subtitle     = '';
$archive_back_link    = get_field( 'blog_archive_back_link', 'options' );
$archive_related_post = get_field( 'blog_archive_related_post', 'option' );

$classes[] = 'blog-hero';

if ( $is_category ) {
	$archive_title = single_cat_title( '', false );
	$classes[]     = 'blog-hero--category';
} elseif ( $is_tag ) {
	$archive_title    = single_tag_title( '', false );
	$archive_subtitle = 'Tagged as';
	$classes[]        = 'blog-hero--tax';
} elseif ( $is_author ) {
	$archive_title    = get_the_author_meta( 'nickname' );
	$archive_subtitle = 'Written by';
	$classes[]        = 'blog-hero--author';
} else {
	$archive_title = get_field( 'blog_archive_title', 'option' ) ? get_field( 'blog_archive_title', 'option' ) : $archive_post_type->labels->name;
}

?>

<section class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
	<div class="container">
	<?php if ( $is_blog ) : ?>
		<h3 class="blog-hero__title"><?php echo esc_html( $archive_title ); ?></h3>
	<?php endif; ?>

	<?php
	if ( ! $is_blog && ! empty( $archive_back_link ) ) :
			$archive_back_link_url    = $archive_back_link['url'];
			$archive_back_link_target = $archive_back_link['target'] ? ' target="_blank" rel="noopener"' : null;
			$archive_back_link_title  = $archive_back_link['title'];
		?>
		<a class="blog-hero__back-link c-btn btn-tertiary icon-left" href="<?php echo esc_url( $archive_back_link_url ); ?>" <?php echo wp_kses_post( $archive_back_link_target ); ?>>
			<i class="icon-chev-left"></i>
			<span class="c-btn-text"><?php echo esc_html( $archive_back_link_title ); ?></span>
		</a>
	<?php endif; ?>

	<?php
	if ( $is_blog && ! empty( $archive_related_post ) ) {
			get_theme_part(
				'archive/post/hero-related-post',
				array(
					'related_post' => $archive_related_post[0],
				)
			);
	}
	?>

	<?php
	if ( $is_category ) :
		$category_description = get_the_archive_description();
		?>
		<div class="row">
			<div class="col-12 col-lg-6">
				<h1 class="blog-hero__archive-title"><?php echo esc_html( $archive_title ); ?></h1>
			</div>
			<?php if ( ! empty( $category_description ) ) : ?>
			<div class="col-12 col-lg-6">
				<div class="blog-hero__archive-description"><?php echo wp_kses_post( $category_description ); ?></div>
			</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $is_tag || $is_author ) : ?>
		<?php if ( ! empty( $archive_subtitle ) ) : ?>
		<p class="blog-hero__tax-subtitle h5"><?php echo esc_html( $archive_subtitle ); ?></p>
		<?php endif; ?>
		<h1 class="blog-hero__tax-title"><?php echo esc_html( $archive_title ); ?></h1>
	<?php endif; ?>
	</div>
</section>
