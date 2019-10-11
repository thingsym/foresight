<?php
/**
 * Editor
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Setup;

/**
 * Class Editor
 *
 * @since 1.0.0
 */
class Editor {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'block_editor_settings' ) );
	}

	/**
	 * Sets up Block Editor settings.
	 *
	 * @since 1.0.0
	 */
	public function block_editor_settings() {
		$editor_color_palette[] = array(
			'name'  => __( 'Crimson', 'ace' ),
			'slug'  => 'crimson',
			'color' => '#dc143c',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Light Pink', 'ace' ),
			'slug'  => 'light-pink',
			'color' => '#ffb6c1',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Dark orange', 'ace' ),
			'slug'  => 'dark-orange',
			'color' => '#ff8c00',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Medium Seagreen', 'ace' ),
			'slug'  => 'medium-seagreen',
			'color' => '#3cb371',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Deep Skyblue', 'ace' ),
			'slug'  => 'deep-skyblue',
			'color' => '#00bfff',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Blue Violet', 'ace' ),
			'slug'  => 'blue-violet',
			'color' => '#8a2be2',
		);

		$editor_color_palette[] = array(
			'name'  => __( 'White', 'ace' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Snow', 'ace' ),
			'slug'  => 'snow',
			'color' => '#fffafa',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Very light gray', 'ace' ),
			'slug'  => 'very-light-gray',
			'color' => '#eeeeee',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Light Gray', 'ace' ),
			'slug'  => 'light-gray',
			'color' => '#abb8c3',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Dark Gray', 'ace' ),
			'slug'  => 'dark-gray',
			'color' => '#a9a9a9',
		);
		$editor_color_palette[] = array(
			'name'  => __( 'Black', 'ace' ),
			'slug'  => 'black',
			'color' => '#000000',
		);

		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

}
