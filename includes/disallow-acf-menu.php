<?php
/**
 * Unility to deter access to ACF Field Groups.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Removes Custom Fields from WP Admin Menu
 *
 * @return void
 */
function remove_acf_menu() {
	if ( defined( 'DISALLOW_ACF_MENU' ) && DISALLOW_ACF_MENU === true ) :
		remove_menu_page( 'edit.php?post_type=acf-field-group' );
	endif;
}

	add_action( 'admin_menu', 'remove_acf_menu' );
