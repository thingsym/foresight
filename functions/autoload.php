<?php
/**
 * WordPress Theme Autoloader
 *
 * @package Ace
 * @since 1.0.0
 */

/**
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt
 * to load the \Ace\Functions\Foo\Bar class
 * from /functions/foo/class-bar.php:
 *     new \Ace\Functions\Foo\Bar;
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(
	function( $class ) {
		/* theme-specific namespace prefix */
		$prefix = 'Ace\\';
		$len    = strlen( $prefix );

		if ( 0 !== strncmp( $prefix, $class, $len ) ) {
			return;
		}

		$relative_class = substr( $class, $len );
		$relative_class = str_replace( '\\', '/', $relative_class );

		/**
		 * WordPress Naming Conventions
		 * See https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/#naming-conventions
		 */
		$relative_class = strtolower( $relative_class );
		$relative_class = str_replace( '_', '-', $relative_class );
		$relative_class = preg_replace( '/(.*\/)(.*?)$/', '/$1class-$2', $relative_class );

		$path = get_theme_file_path( $relative_class . '.php' );

		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}
);
