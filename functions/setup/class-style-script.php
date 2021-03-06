<?php
/**
 * Style and script
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Setup;

/**
 * Class Style_Script
 *
 * @since 1.0.0
 */
class Style_Script {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_block_asset_styles' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_styles' ] );
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
			'foresight',
			$style_uri,
			[],
			wp_get_theme()->get( 'Version' ),
			'all'
		);

		if ( is_rtl() ) {
			$style_rtl_uri = get_stylesheet_directory() . 'style-rtl.min.css';

			if ( is_dir( get_stylesheet_directory() . '/css' ) && is_file( get_stylesheet_directory() . '/css/style-rtl.min.css' ) ) {
				$style_rtl_uri = get_stylesheet_directory_uri() . '/css/style-rtl.min.css';
			}
			elseif ( is_dir( get_stylesheet_directory() . '/css' ) && is_file( get_stylesheet_directory() . '/css/style-rtl.css' ) ) {
				$style_rtl_uri = get_stylesheet_directory_uri() . '/css/style-rtl.css';
			}

			wp_enqueue_style(
				'foresight-rtl',
				$style_rtl_uri,
				[],
				wp_get_theme()->get( 'Version' ),
				'all'
			);
		}
	}

	/**
	 * Enqueue scripts for front-end.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'foresight-bundle',
			get_template_directory_uri() . '/js/main.min.js',
			[],
			wp_get_theme()->get( 'Version' ),
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Enqueue styles for Frondend and Block Editor
	 */
	public function enqueue_block_asset_styles() {
		wp_enqueue_style(
			'foresight-block-asset',
			get_stylesheet_directory_uri() . '/css/block-asset.min.css',
			[],
			wp_get_theme()->get( 'Version' ),
			'all'
		);
	}

	/**
	 * Enqueue styles for Gutenberg
	 */
	public function enqueue_block_editor_styles() {
		wp_enqueue_style(
			'foresight-block-editor',
			get_stylesheet_directory_uri() . '/css/block-editor-style.css',
			[],
			wp_get_theme()->get( 'Version' ),
			'all'
		);
	}

}
