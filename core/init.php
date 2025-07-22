<?php
/**
 * Initialize core functionality.
 *
 * This file prepares all the core functionality that is required by the theme
 * to function. It should contain only includes, and Theme_Core class setup.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

// Give access to all publicly visible functions offered by the core.
require_once 'functions.php';
recursive_include( __DIR__ . DIRECTORY_SEPARATOR . 'includes' );

// Load all core components.
require_once 'class-theme-core-component.php';
recursive_include( __DIR__ . DIRECTORY_SEPARATOR . 'components' );

// Load theme core itself.
require_once 'class-theme-core.php';

// Setup the core and initialize components.
Theme_Core::setup();
