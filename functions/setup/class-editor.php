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
		add_action( 'after_setup_theme', [ $this, 'editor_font_sizes' ] );
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

		$editor_color_palette[] = [
			'name'  => __( 'Neutral', 'foresight' ),
			'slug'  => 'neutral',
			'color' => '#d3d3d3',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Success', 'foresight' ),
			'slug'  => 'success',
			'color' => '#28a745',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Warning', 'foresight' ),
			'slug'  => 'warning',
			'color' => '#ffc107',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Important', 'foresight' ),
			'slug'  => 'important',
			'color' => '#dc3545',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Info', 'foresight' ),
			'slug'  => 'info',
			'color' => '#33b5e5',
		];
		$editor_color_palette[] = [
			'name'  => __( 'Notice', 'foresight' ),
			'slug'  => 'notice',
			'color' => '#007bff',
		];

		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	public function editor_font_sizes() {
		$base_size = 18;

		$editor_font_sizes[] = [
			'name' => esc_attr__( 'Small', 'foresight' ),
			'size' => floor( $base_size * 6 / 7 * 10 ) / 10,
			'slug' => 'small'
		];
		$editor_font_sizes[] = [
			'name' => esc_attr__( 'Medium', 'foresight' ),
			'size' => floor( $base_size * 6 / 6 * 10 ) / 10,
			'slug' => 'medium'
		];
		$editor_font_sizes[] = [
			'name' => esc_attr__( 'Large', 'foresight' ),
			'size' => floor( $base_size * 6 / 5 * 10 ) / 10,
			'slug' => 'large'
		];
		$editor_font_sizes[] = [
			'name' => esc_attr__( 'Extra Large', 'foresight' ),
			'size' => floor( $base_size * 6 / 4 * 10 ) / 10,
			'slug' => 'extra-large'
		];

		add_theme_support( 'editor-font-sizes', $editor_font_sizes );
	}
}
