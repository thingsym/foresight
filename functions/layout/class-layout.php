<?php
/**
 * Layout
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Layout;

use Foresight\Functions\Customizer\Customize_Control\Layout_Picker;
use Foresight\Functions\Customizer\Sanitize;

/**
 * Class Layout
 *
 * @since 1.0.0
 */
class Layout {
	protected $section_id       = 'foresight_layout';
	protected $option_name      = 'foresight_layout_options';
	protected $section_priority = 81;
	protected $capability       = 'manage_options';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var array $default_options {
	 *   default options
	 *
	 *   @type string archive
	 * }
	 */
	protected $default_options = [
		'archive_sidebar'            => false,
		'archive'                    => 'article-all',
		'footer_widget_column_ratio' => 'one-to-one',
	];

	/**
	 * Constructor
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
	}

	/**
	 * Return the options array or value.
	 *
	 * @access public
	 *
	 * @param string $option_name Optional. The option name.
	 *
	 * @return array|null
	 *
	 * @since 1.0.0
	 */
	public function get_options( $option_name = null ) {
		$options = get_theme_mod( $this->option_name, $this->default_options );
		$options = array_merge( $this->default_options, $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param array    $options     The options.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/layout/get_options', $options );
		}

		if ( array_key_exists( $option_name, $options ) ) {
			/**
			 * Filters the option.
			 *
			 * @param mixed   $option           The value of option.
			 * @param string  $option_name      The option name via argument.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/layout/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	/**
	 * Return an array of layout options registered.
	 *
	 * @since 1.0.0
	 */
	public function get_archive_options() {
		$thumbnail_uri = get_template_directory_uri() . '/functions/layout/images/archive/';

		$options = [
			'article-all'   => [
				'label'     => __( 'Article, All image', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'article-all.png',
			],
			'article-only'  => [
				'label'     => __( 'Article Only', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'article-only.png',
			],
			'article-left'  => [
				'label'     => __( 'Article, Image', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'article-left.png',
			],
			'article-right' => [
				'label'     => __( 'Image, Article', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'article-right.png',
			],
			'card'          => [
				'label'     => __( 'Card', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'card.png',
			],
			'topics'        => [
				'label'     => __( 'Topics', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'topics.png',
			],
		];

		return apply_filters( 'foresight/functions/layout/get_archive_options', $options );
	}

	/**
	 * Return current archive layout.
	 *
	 * @since 1.0.0
	 */
	public function get_archive_layout() {
		if ( ! ( is_archive() || is_search() || is_home() ) ) {
			return;
		}

		if ( 'post' === get_post_type() ) {
			$archive = $this->get_options( 'archive' );
		}
		else {
			$archive = 'archive';
		}

		return apply_filters( 'foresight/functions/layout/get_archive_layout', $archive );
	}

	/**
	 * Echo data attribute 'data-archive-layout'
	 */
	public function data_attr_archive_layout() {
		echo ' data-archive-layout="' . esc_attr( $this->get_archive_layout() ) . '"';
	}

	/**
	 * Return an array of layout options registered.
	 *
	 * @since 1.0.0
	 */
	public function get_footer_widget_column_ratio_options() {
		$thumbnail_uri = get_template_directory_uri() . '/functions/layout/images/footer/';

		$options = [
			'one-to-one' => [
				'label'     => __( '1:1', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'one-to-one.svg',
			],
			'two-to-one' => [
				'label'     => __( '2:1', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'two-to-one.svg',
			],
			'one-to-two' => [
				'label'     => __( '1:2', 'foresight' ),
				'thumbnail' => $thumbnail_uri . 'one-to-two.svg',
			],
		];

		return apply_filters( 'foresight/functions/layout/get_footer_widget_column_ratio_options', $options );
	}

	/**
	 * Return current footer widget column.
	 *
	 * @since 1.0.0
	 */
	public function get_footer_widget_column_ratio() {
		$archive = $this->get_options( 'footer_widget_column_ratio' );
		return apply_filters( 'foresight/functions/layout/get_footer_widget_column_ratio', $archive );
	}

	/**
	 * Echo data attribute of footer widget column ratio.
	 *
	 * @since 1.0.0
	 */
	public function data_attr_footer_widget_column_ratio() {
		$data_attribute = apply_filters( 'foresight/functions/layout/footer_widget_column_ratio', $this->get_footer_widget_column_ratio() );
		echo ' data-column-ratio="' . esc_attr( $data_attribute ) . '"';
	}

	/**
	 * Return boolean with archive_sidebar.
	 *
	 * @since 1.0.0
	 */
	public function has_archive_sidebar() {
		return apply_filters( 'foresight/functions/layout/has_archive_sidebar', $this->get_options( 'archive_sidebar' ) );
	}

	/**
	 * Implements theme options into Theme Customizer
	 *
	 * @param object $wp_customize Theme Customizer object
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$wp_customize->add_section(
			$this->section_id . '_archive',
			[
				'title'    => __( 'Archive', 'foresight' ),
				'priority' => 10,
				'panel'    => 'layout',
			]
		);

		$default_options = $this->default_options;

		$wp_customize->add_setting(
			'foresight_layout_options[archive_sidebar]',
			[
				'default'           => $default_options['archive_sidebar'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_layout_options[archive_sidebar]',
			[
				'label'   => __( 'Add sidebar to Archive', 'foresight' ),
				'section' => $this->section_id . '_archive',
				'type'    => 'checkbox',
			]
		);

		$wp_customize->add_setting(
			'foresight_layout_options[archive]',
			[
				'default'           => $default_options['archive'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Customize_Control\Layout_Picker', 'sanitize_layout' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker(
				$wp_customize,
				'foresight_layout_options[archive]',
				[
					'label'   => __( 'Archive Layout', 'foresight' ),
					'section' => $this->section_id . '_archive',
					'type'    => 'layout',
					'options' => $this->get_archive_options(),
				]
			)
		);

		$wp_customize->add_section(
			$this->section_id . '_footer',
			[
				'title'    => __( 'Footer', 'foresight' ),
				'priority' => 20,
				'panel'    => 'layout',
			]
		);

		$wp_customize->add_setting(
			'foresight_layout_options[footer_widget_column_ratio]',
			[
				'default'           => $default_options['footer_widget_column_ratio'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Customize_Control\Layout_Picker', 'sanitize_layout' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker(
				$wp_customize,
				'foresight_layout_options[footer_widget_column_ratio]',
				[
					'label'   => __( 'Footer Widget Column Width Ratio', 'foresight' ),
					'section' => $this->section_id . '_footer',
					'type'    => 'layout',
					'options' => $this->get_footer_widget_column_ratio_options(),
				]
			)
		);
	}

}
