<?php
/**
 * The search page hero.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$args = wp_parse_args(
	$args,
	array(
		'search_query' => '',
		'found_posts'  => 0,
	)
);
?>

<div class="search-hero">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 mx-auto">
				<form action="/" method="GET" id="search-form">

					<?php if ( function_exists( 'wpes_use_autocomplete' ) && wpes_use_autocomplete() ) : ?>

						<div
							id="wpes-autocomplete"
							data-name="s"
							data-query="<?php esc_attr_e( $args['search_query'] ); ?>"
						></div>

					<?php else : ?>

						<div class="search-field">
							<input
								type="search"
								class="search-field__input"
								name="s"
								placeholder="Search"
								aria-label="Term to search"
								value="<?php esc_html_e( $args['search_query'] ); ?>"
							/>

							<button class="search-field__submit" role="submit">
								<span class="sr-only">Search the website</span>
							</button>
						</div>

					<?php endif; ?>

				</form>

				<p>
					<?php if ( ! empty( $args['search_query'] ) ) : ?>
						<?php esc_html_e( $args['found_posts'] ); ?> results for "<?php esc_html_e( $args['search_query'] ); ?>"
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
</div>
