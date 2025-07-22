<?php
/**
 * Hooks for use with the ACF Icon Picker plugin.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

add_filter(
	'acf/icon-picker-path',
	function() {
		return get_template_directory() . '/css/dist/iconfont.css';
	},
	100
);

add_filter(
	'acf/icon-picker-uri',
	function() {
		return get_template_directory_uri() . '/css/dist/iconfont.css';
	},
	100
);
