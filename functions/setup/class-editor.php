<?php
/**
 * Editor
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Setup;

/**
 * Class Editor
 *
 * @since 1.0.0
 */
class Editor {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'editor_color_palette' ] );
	}

	/**
	 * Sets up Block Editor Color Palette.
	 *
	 * @since 1.0.0
	 */
	public function editor_color_palette() {
		$editor_color_palette = [];

		$editor_color_palette[] = [
			'name'  => __( 'Crimson', 'foresight' ),
			'slug'  => 'crimson',
			'color' => '#dc143c',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Light Pink', 'foresight' ),
			'slug'  => 'light-pink',
			'color' => '#ffb6c1',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Dark orange', 'foresight' ),
			'slug'  => 'dark-orange',
			'color' => '#ff8c00',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Medium Seagreen', 'foresight' ),
			'slug'  => 'medium-seagreen',
			'color' => '#3cb371',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Deep Skyblue', 'foresight' ),
			'slug'  => 'deep-skyblue',
			'color' => '#00bfff',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Blue Violet', 'foresight' ),
			'slug'  => 'blue-violet',
			'color' => '#8a2be2',
		];

		$editor_color_palette[] = [
			'name'  => __( 'White', 'foresight' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Snow', 'foresight' ),
			'slug'  => 'snow',
			'color' => '#fffafa',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Very light gray', 'foresight' ),
			'slug'  => 'very-light-gray',
			'color' => '#eeeeee',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Light Gray', 'foresight' ),
			'slug'  => 'light-gray',
			'color' => '#abb8c3',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Dark Gray', 'foresight' ),
			'slug'  => 'dark-gray',
			'color' => '#a9a9a9',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Black', 'foresight' ),
			'slug'  => 'black',
			'color' => '#000000',
		];

		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

}
