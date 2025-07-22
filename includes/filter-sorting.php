<?php 

function e29_menu_order_available($params) {
	$fields = array('menu_order');
	foreach ($fields as $value) {
		$params['orderby']['enum'][] = $value;
	}
	return $params;
}
add_filter('rest_staff_collection_params', 'e29_menu_order_available', 10, 1);
add_filter('rest_activity_collection_params', 'e29_menu_order_available', 10, 1);

