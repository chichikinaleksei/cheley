<?php
/**
 * The search form template.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

?>

<form method="get" action="<?php bloginfo( 'url' ); ?>">
	<input type="search" name="s" id="s"/>
	<input type="submit" value="search"/>
</form>
