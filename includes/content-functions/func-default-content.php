<?php
/**
 * Display the deafult content.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Display the deafult content.
 */
function default_content() {
	if ( has_blocks() ) : ?>
		<?php the_content(); ?>
	<?php else : ?>
		<div class="default-content">
			<?php the_content(); ?>
		</div>
		<?php
	endif;
}
