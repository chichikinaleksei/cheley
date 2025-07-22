<?php
/**
 * The main template file.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

get_header();

$this_post_type = get_post_type();
?>

	<main class="page-content page-content--archive page-content--archive-<?php echo esc_attr( $this_post_type ); ?>">
		<?php
		switch ( $this_post_type ) {
			case 'activity':
				get_theme_part( 'archive/activity/main' );
				break;
			case 'staff':
				get_theme_part( 'archive/staff/main' );
				break;
			default:
				get_theme_part( 'archive/post/main' );
		}
		?>
	</main>

<?php
get_footer();
