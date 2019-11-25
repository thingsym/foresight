<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Foresight
 */

/* That's all, stop editing! Happy blogging. */

// Load up WordPress Theme Autoloader.
require_once get_template_directory() . '/functions/autoload.php';

// Load up our theme options, functions and related code.
require_once get_template_directory() . '/functions/loadup.php';

// Load up Composer autoloader if exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}
