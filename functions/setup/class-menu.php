<?php
/**
 * Menu
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Setup;

/**
 * Class Menu
 *
 * @since 1.0.0
 */
class Menu {

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'init' ] );
	}

	/**
	 * Register menus.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu(
			'global',
			esc_html__( 'Global Menu', 'foresight' )
		);

	}

}
