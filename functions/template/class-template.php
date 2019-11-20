<?php
/**
 * Template
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Template;

/**
 * Class Template
 *
 * @since 1.0.0
 */
class Template {
	protected $templates_dir = 'templates/';

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'custom_template_hierarchy' ) );
		add_action( 'get_search_form', array( $this, 'get_search_form' ) );
		add_action( 'body_class', array( $this, 'add_archive_template_name' ) );
	}

	/**
	 * Custom template hierarchy
	 *
	 * @since 1.0.0
	 */
	public function custom_template_hierarchy() {
		$types = array(
			'index',
			'404',
			'archive',
			'author',
			'category',
			'tag',
			'taxonomy',
			'date',
			'embed',
			'home',
			'frontpage',
			'page',
			'paged',
			'search',
			'single',
			'singular',
			'attachment',
		);

		foreach ( $types as $type ) {
			add_filter(
				"{$type}_template_hierarchy",
				function( $templates ) {
					$custom_templates = array();

					foreach ( $templates as $template ) {
						if ( class_exists( 'Ace\Functions\Layout\Layout' ) ) {
							global $ace_fn_layout;
							if ( method_exists( $ace_fn_layout, 'has_archive_sidebar' ) ) {
								if ( $ace_fn_layout->has_archive_sidebar() ) {
									if ( is_home() ) {
										$custom_templates[] = 'archive-templates/index-sidebar.php';
									}
									if ( is_archive() ) {
										$custom_templates[] = 'archive-templates/archive-sidebar.php';
									}
								}
							}
						}

						$custom_templates[] = $this->templates_dir . $template;
						$custom_templates[] = $template;
					}

					return $custom_templates;
				}
			);
		}
	}

	/**
	 * Get search_form from templates/parts
	 *
	 * @since 1.0.0
	 */
	public function get_search_form( $form ) {
		do_action( 'pre_get_search_form' );

		ob_start();
		get_template_part( 'templates/parts/search_form' );
		$tmp_form = ob_get_clean();

		if ( empty( $tmp_form ) ) {
			return $form;
		}

		return $tmp_form;
	}

	/**
	 * Add archive-template name to body_class
	 *
	 * @since 1.0.0
	 */
	public function add_archive_template_name( $classes ) {
		$template = '';

		if ( class_exists( 'Ace\Functions\Layout\Layout' ) ) {
			global $ace_fn_layout;
			if ( method_exists( $ace_fn_layout, 'has_archive_sidebar' ) ) {
				if ( $ace_fn_layout->has_archive_sidebar() ) {
					if ( is_home() ) {
						$template = get_index_template();
					}
					if ( is_archive() ) {
						$template = get_archive_template();
					}
				}
			}
		}

		if ( preg_match( '/archive\-templates/', $template ) ) {
			$template  = preg_replace( '/(.*\/)(.*?)\.php$/', '$2', $template );
			$classes[] = 'archive-template-' . $template;
		}

		return $classes;
	}

}
