<?php
/**
 * Turn off autocomplete for date input
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Disable autocomplete for date input
 *
 * @param  string $field_content HTML structure.
 * @param  object $field Current field.
 * @return string HTML structure.
 */
function disable_autocomplete_date( $field_content, $field ) {
	if ( 'date' === $field->type ) {
		return str_replace( 'type=', "autocomplete='off' type=", $field_content );
	}
	return $field_content;
}
add_filter( 'gform_field_content', 'disable_autocomplete_date', 10, 2 );
