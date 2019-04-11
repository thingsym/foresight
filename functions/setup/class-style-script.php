<?php
/**
 * Style and script
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Setup;

/**
 * Class Style_Script
 *
 * @since 1.0.0
 */
class Style_Script {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_styles' ) );
	}

	/**
	 * Enqueue styles for front-end.
	 */
	public function enqueue_styles() {

		$style_uri = get_stylesheet_uri();

		if ( is_dir( get_stylesheet_directory() . '/css' ) && is_file( get_stylesheet_directory() . '/css/style.min.css' ) ) {
			$style_uri = get_stylesheet_directory_uri() . '/css/style.min.css';
		}
		elseif ( is_dir( get_stylesheet_directory() . '/css' ) && is_file( get_stylesheet_directory() . '/css/style.css' ) ) {
			$style_uri = get_stylesheet_directory_uri() . '/css/style.css';
		}

		wp_enqueue_style(
			'ace',
			$style_uri,
			false,
			wp_get_theme()->get( 'Version' ),
			'all'
		);
	}

	/**
	 * Enqueue scripts for front-end.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'ace-navigation',
			get_template_directory_uri() . '/js/navigation.min.js',
			array(),
			'20151215',
			true
		);

		wp_enqueue_script(
			'ace-skip-link-focus-fix',
			get_template_directory_uri() . '/js/skip-link-focus-fix.min.js',
			array(),
			'20151215',
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Enqueue styles for Gutenberg
	 */
	public function block_editor_styles() {
		wp_enqueue_style(
			'ace-block-editor',
			get_stylesheet_directory_uri() . '/css/block-editor-style.css',
			false,
			'1.0',
			'all'
		);
	}

}
