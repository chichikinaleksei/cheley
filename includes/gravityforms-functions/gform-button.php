<?php
/**
 * Input to button change.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
/**
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 */
function input_to_button( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( $button );
	$input      = $dom->getElementsByTagName( 'input' )->item( 0 );
	$new_button = $dom->createElement( 'button' );
	$new_button->appendChild( $dom->createElement( 'span', $input->getAttribute( 'value' ) ) );
	$input->removeAttribute( 'value' );
	foreach ( $input->attributes as $attribute ) {
		if ( 'class' === $attribute->name ) {
			$attribute->value = 'c-btn c-btn-primary ' . $attribute->value;
		}
		$new_button->setAttribute( $attribute->name, $attribute->value );
	}
	// phpcs:ignore
	$input->parentNode->replaceChild( $new_button, $input );
	return $dom->saveHtml( $new_button );
}
