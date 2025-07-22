<?php
/**
 * Block Library
 *
 * Title:       Block Library
 * Description: Displays all block library blocks with sortable interface..
 * Category:    etn-blocks
 * Icon:        block-default
 * Keywords:    block, library, stylesheet
 * Post Types:  none
 * Multiple:    false
 * Active:      true
 * CSS Deps:
 * JS Deps:
 * Mode:        preview
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

$section_classes = '';

$args = array(
	'post_type'      => 'library_block',
	'post_status'    => array( 'publish' ),
	'posts_per_page' => -1,
	'order'          => 'ASC',
);

$block_posts = get_posts( $args );

if ( ! empty( $block_posts ) ) : ?>
	<?php
	$block_data = array(
		__( '829 Blocks', 'cheleyCamps' ) => array(),
	);

	foreach ( $block_posts as $block_post ) {
		if ( ! empty( $block_post->post_content ) ) {
			$category = __( 'Core Blocks', 'cheleyCamps' );

			if ( false !== strpos( $block_post->post_content, 'acf/' ) ) {
				$category = __( '829 Blocks', 'cheleyCamps' );
			}

			$block_data[ $category ][ $block_post->ID ] = array(
				'title' => $block_post->post_title,
				'ID'    => $block_post->ID,
			);

			if ( empty( $_GET ) || ( ! empty( $_GET[ $block_post->ID ] ) && 'v' === $_GET[ $block_post->ID ] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$block_data[ $category ][ $block_post->ID ]['visibility'] = 'visible';
				$section_classes .= ' visible-' . $block_post->ID;
			} else {
				$block_data[ $category ][ $block_post->ID ]['visibility'] = 'hidden';
			}
		}
	}

	$hover_label_button_classes = '';

	if ( ! empty( $_GET['hide-hover-labels'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$hover_label_button_classes = ' active';
		$section_classes           .= ' hide-hover-labels';
	}
	?>

	<?php if ( ! empty( $block_data ) ) : ?>
		<section class="block-library<?php esc_attr_e( $section_classes ); ?>">
			<?php if ( ! empty( $block_data ) ) : ?>
				<style>
					<?php foreach ( $block_data as $block_category ) : ?>
						<?php if ( ! empty( $block_category ) ) : ?>
							<?php foreach ( $block_category as $this_block_data ) : ?>
								.block-library:not(.visible-<?php esc_attr_e( $this_block_data['ID'] ); ?>) ~ .page-content > *[data-block-id="<?php esc_attr_e( $this_block_data['ID'] ); ?>"] {
									display: none !important;
								}
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</style>

				<ul class="block-library__nav">
					<?php $category_count = 0; ?>

					<?php foreach ( $block_data as $block_category_name => $block_category ) : ?>
						<?php if ( ! empty( $block_category ) ) : ?>
							<?php $category_count++; ?>

							<li>
								<div class="block-library__nav-heading-wrapper">
									<h2 class="block-library__nav-heading overline"><?php esc_html_e( $block_category_name ); ?></h2>

									<button type="button" class="block-library__toggle-button block-library__show-all" data-category="<?php esc_attr_e( $block_category_name ); ?>"><?php esc_html_e( '(Show All)', 'cheleyCamps' ); ?></button>

									<button type="button" class="block-library__toggle-button block-library__hide-all" data-category="<?php esc_attr_e( $block_category_name ); ?>"><?php esc_html_e( '(Hide All)', 'cheleyCamps' ); ?></button>

									<?php if ( 1 === $category_count ) : ?>
										<button type="button" class="block-library__hover-labels-toggle-button<?php esc_attr_e( $hover_label_button_classes ); ?>" data-category="<?php esc_attr_e( $block_category_name ); ?>"><span><?php esc_html_e( '(Hide Hover Labels)', 'cheleyCamps' ); ?></span><span><?php esc_html_e( '(Show Hover Labels)', 'cheleyCamps' ); ?></span></button>
									<?php endif; ?>
								</div>

								<ul class="block-library__nav-submenu" data-category="<?php esc_attr_e( $block_category_name ); ?>">
									<?php foreach ( $block_category as $this_block_data ) : ?>
										<li class="block-library__nav-item">
											<?php if ( ! empty( $this_block_data['title'] ) ) : ?>
												<?php
												$input_atts = '';

												if ( ! empty( $this_block_data['visibility'] ) && 'visible' === $this_block_data['visibility'] ) {
													$input_atts .= ' checked';
												}
												?>

												<input class="block-library__input" type="checkbox" id="block-library-input__<?php esc_attr_e( $this_block_data['ID'] ); ?>" name="<?php esc_html_e( $this_block_data['ID'] ); ?>"<?php echo wp_kses_post( $input_atts ); ?>>
												<label class="block-library__label" for="block-library-input__<?php esc_attr_e( $this_block_data['ID'] ); ?>"><?php esc_html_e( $this_block_data['title'] ); ?></label>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</section>

		<main class="page-content">
			<?php foreach ( $block_posts as $block_post ) : ?>
				<div class="block-library__section-placeholder" data-block-id="<?php esc_attr_e( $block_post->ID ); ?>" data-block-title="<?php esc_html_e( $block_post->post_title ); ?>"></div>

				<?php echo apply_filters( 'the_content', $block_post->post_content ); //phpcs:ignore ?>
			<?php endforeach; ?>
		</main>
	<?php endif; ?>
<?php endif; ?>
