<?php
/**
 * Menu
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Setup;

/**
 * Class Menu
 *
 * @since 1.0.0
 */
class Menu {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init' ) );
	}

	/**
	 * Register menus.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu(
			'menu-1',
			esc_html__( 'Primary', 'ace' )
		);

	}

}
