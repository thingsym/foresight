<?php
/**
 * Widget
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Setup;

/**
 * Class Widget
 *
 * @since 1.0.0
 */
class Widget {

	public function __construct() {
		add_action( 'widgets_init', array( $this, 'init' ) );
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
			array(
				'name'          => esc_html__( 'Blog Sidebar', 'ace' ),
				'id'            => 'sidebar-post',
				'description'   => esc_html__( 'Add widgets here.', 'ace' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'ace' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here.', 'ace' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'ace' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here.', 'ace' ),
				'before_widget' => '<section class="widget %2$s %1$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

	}

}
