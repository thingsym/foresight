<?php
/**
 * Theme
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Setup;

/**
 * Class Theme
 *
 * @since 1.0.0
 */
class Theme {
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'load_textdomain' ] );
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
		add_action( 'after_setup_theme', [ $this, 'content_width' ] );
		add_action( 'wp_head', [ $this, 'print_meta' ], 1 );
		add_action( 'wp_body_open', [ $this, 'add_skip_link' ] );
		add_filter( 'image_size_names_choose', [ $this, 'add_image_size_option_medium_large' ] );

		add_filter( 'get_custom_logo_image_attributes', [ $this, 'add_custom_logo_image_attributes' ], 10, 3 );

		add_filter( 'comment_form_defaults', [ $this, 'setup_comment_form' ] );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 */
	public function setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			]
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'foresight/functions/setup/custom-background/args',
				[
					'default-color' => 'ffffff',
					'default-image' => '',
				]
			)
		);

		// Set up the WordPress core custom header feature.
		add_theme_support(
			'custom-header',
			apply_filters(
				'foresight/functions/setup/custom-header/args',
				[
					'default-image'      => '',
					'default-text-color' => '000000',
					'width'              => 1280,
					'height'             => 640,
					'flex-width'         => true,
					'flex-height'        => true,
					'wp-head-callback'   => '',
				]
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'width'       => 280,
				'height'      => 120,
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => [
					'site-title',
					'site-description',
				],
			]
		);

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'css/editor-style.css' );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide alignment.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'custom-line-height' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'appearance-tools' );
		add_theme_support( 'border' );
		add_theme_support( 'link-color' );

		add_post_type_support( 'page', 'excerpt' );

	}

	/**
	 * Load textdomain
	 *
	 * @access public
	 *
	 * @return boolean
	 *
	 * @since 2.1.2
	 */
	public function load_textdomain() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Foresight, use a find and replace
		 * to change 'foresight' to the name of your theme in all the template files.
		 */
		return load_theme_textdomain(
			'foresight',
			get_template_directory() . '/languages'
		);
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'foresight/functions/setup/content_width', 1024 );
	}

	public function print_meta() {
		get_template_part( 'templates/parts/meta' );
	}

	public function add_skip_link() {
		get_template_part( 'templates/parts/skip-link' );
	}

	public function add_custom_logo_image_attributes( $custom_logo_attr = [], $custom_logo_id = null, $blog_id = null ) {
		$custom_logo_attr['loading'] = 'lazy';
		return $custom_logo_attr;
	}

	public function add_image_size_option_medium_large( $imagesizes ) {
		$medium_large = [
			'medium_large' => __( 'Medium Large', 'foresight' ),
		];

		return array_merge( $imagesizes, $medium_large );
	}

	public function setup_comment_form( $args ) {
		$args['title_reply']    = __( 'Leave a Reply', 'foresight' );
		$args['title_reply_to'] = __( 'Leave a Reply', 'foresight' );
		$args['label_submit']   = __( 'Post Comment', 'foresight' );

		return $args;
	}

}
