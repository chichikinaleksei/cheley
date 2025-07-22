<?php
/**
 * Gform File Custom Functionality
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

/**
 * Gform File Custom
 *
 * @param  string $input HTML structure.
 * @param  object $field Current field.
 * @return string HTML structure.
 */
function file_input( $input, $field ) {
	if ( 'fileupload' === $field->type && ! is_admin() ) {
		$id = $field->id;
		// phpcs:ignore
        $formId         = $field->formId;
		// phpcs:ignore
        $max_file_sizes = $field->maxFileSize;
		$max_file_bytes = ! empty( $max_file_sizes ) ? $max_file_sizes * 1024 * 1024 : 128 * 1024 * 1024;
		$label          = __( 'No file chosen', 'womack' );
		$label_button   = __( 'Choose File', 'womack' );
		// phpcs:ignore
		$id_input       = "custom_input_${formId}_${id}";

		$input = "<div class='ginput_container ginput_container_fileupload'>
            <input name='input_${id}' id='${id_input}' class='custom-file' type='file' onchange='javascript:gformValidateFileSize( this, ${max_file_bytes} );'><label for='${id_input}' data-button='${label_button}'>${label}</label>
            <script>var ${id_input} = document.querySelector('#${id_input}');${id_input}.addEventListener('change', e => {var target = e.target;var fileName = target.files[0].name;target.nextElementSibling.innerHTML = fileName;});</script>
        </div>";

	}

	return $input;
}
add_filter( 'gform_field_input', 'file_input', 10, 5 );
