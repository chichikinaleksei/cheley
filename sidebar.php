<?php
/**
 * Primary widget area
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

?>

<aside class="widget-area">
	<?php

	if ( is_active_sidebar( 'primary_widget_area' ) ) {
		dynamic_sidebar( 'primary_widget_area' );
	}

	?>
</aside>
