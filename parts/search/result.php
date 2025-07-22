<?php
/**
 * The search result partial.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$args = wp_parse_args(
	$args,
	array(
		'subtitle' => '',
		'title'    => '',
		'url'      => '',
		'content'  => '',
		'img'      => '',
	)
);
?>

<div class="search-result">
	<div class="search-result__text">
		<?php if ( ! empty( $args['subtitle'] ) ) : ?>
			<div class="search-result__subtitle"><?php esc_html_e( $args['subtitle'] ); ?></div>
		<?php endif; ?>

		<h2 class="search-result__title">
			<a href="<?php echo esc_url( $args['url'] ); ?>"><?php echo wp_kses_post( $args['title'] ); ?></a>
		</h2>

		<div class="search-result__excerpt"><?php echo wp_kses_post( $args['content'] ); ?></div>
	</div>

	<?php if ( ! empty( $args['img'] ) ) : ?>
		<div class="search-result__image">
		<?php echo wp_kses_post( $args['img'] ); ?>
		</div>
	<?php endif; ?>
</div>
