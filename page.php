<?php
/**
 * The static page template.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

get_header();
the_post();
?>
	<main class="page-content">
	<?php
		default_content();
	?>
	</main>
<?php
get_footer();
