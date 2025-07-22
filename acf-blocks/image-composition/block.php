<?php
/**
 * Image Composition Block
 *
 * Title:       Image Composition
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
?>
<section id="<?php esc_attr_e( $content_block->get_block_id() ); ?>" class="acf-block block-img-comp">
	<?php echo wp_kses( $content_block->get_block_spacing(), 'inline-style' ); ?>
	<div class="container-fluid">
		<?php
		if ( have_rows( 'image_layouts_row' ) ) :
			while ( have_rows( 'image_layouts_row' ) ) :
				the_row();
				$layout = get_sub_field( 'select_row_layout' );
				switch ( $layout ) {
					case 'fluid_50_50':
						include 'inc/two-half.php';
						break;
					case 'fluid_full_width':
						include 'inc/full-width.php';
						break;
					case 'fluid_2small_1large':
						include 'inc/two-small-one-large.php';
						break;
					case 'fluid_2_3_a_1_3':
						include 'inc/two-third-one-third.php';
						break;
					case 'fluid_1_3_columns':
						include 'inc/one-third-cols.php';
						break;
				}
			endwhile;
		endif;
		?>
	</div>
</section>
<?php
