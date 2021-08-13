<?php
/**
 * Widget
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Setup;

/**
 * Class Widget
 *
 * @since 1.0.0
 */
class Widget {

	public function __construct() {
		add_action( 'widgets_init', [ $this, 'init' ] );
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 *
	 * @since 1.0.0
	 */
	public function init() {

		register_sidebar(
			[
				'name'          => esc_html__( 'Page Sidebar', 'foresight' ),
				'id'            => 'sidebar-page',
				'description'   => esc_html__( 'Add widgets here.', 'foresight' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);

		register_sidebar(
			[
				'name'          => esc_html__( 'Blog Sidebar', 'foresight' ),
				'id'            => 'sidebar-post',
				'description'   => esc_html__( 'Add widgets here.', 'foresight' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);

		register_sidebar(
			[
				'name'          => esc_html__( 'Footer 1 (Deprecated)', 'foresight' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here.', 'foresight' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);

		register_sidebar(
			[
				'name'          => esc_html__( 'Footer 2 (Deprecated)', 'foresight' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here.', 'foresight' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);

	}

}
