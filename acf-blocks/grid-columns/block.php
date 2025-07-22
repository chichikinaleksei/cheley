<?php
/**
 * Grid Columns Block
 *
 * Title:       Grid Columns
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
 * @since cheleyCamps  1.0
 */

$content_block = new Content_Block_Gutenberg( $block );

// Get container width class.
$container_position = get_field( 'container_position' );
$container_width    = get_field( 'container_width' );
$container_class    = $content_block->get_column_classes(
	array(
		'mobile'  => $container_width['mobile'],
		'tablet'  => $container_width['tablet'],
		'desktop' => $container_width['desktop'],
	)
);

$columns              = get_field( 'columns' );
$default_column_width = get_field( 'column_width' );

if ( ! empty( $columns ) ) :
	?>
	<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-grid-columns">
		<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
		<div class="container">
			<div class="row <?php esc_attr_e( "justify-content-$container_position" ); ?>">
				<div class="<?php esc_attr_e( $container_class ); ?>">
					<div class="row">
						<?php
						foreach ( $columns as $column ) {
							$column_class = $content_block->get_column_classes(
								$column['column_width'],
								$default_column_width
							);
							?>

							<div class="grid-columns__column <?php esc_attr_e( $column_class ); ?>">
								<?php echo wp_kses_post( $column['content'] ); ?>
							</div>

							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
