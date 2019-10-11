<?php
/**
 * Layout
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Layout;

/**
 * Class Layout
 *
 * @since 1.0.0
 */
class Layout {
	protected $section_id       = 'ace_layout';
	protected $option_name      = 'ace_layout_options';
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
	protected $default_options = array(
		'archive_sidebar'            => false,
		'archive'                    => 'article-all',
		'footer_widget_column_ratio' => 'one-to-one',
	);

	/**
	 * Constructor
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer' ) );
	}

	/**
	 * Returns the options array or value.
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
		$options = get_option( $this->option_name, $this->default_options );
		$options = array_merge( $this->default_options, $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param array    $options     The options.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'ace/functions/layout/get_options', $options );
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
			return apply_filters( 'ace/functions/layout/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	/**
	 * Returns an array of layout options registered.
	 *
	 * @since 1.0.0
	 */
	public function get_archive_options() {
		$thumbnail_uri = get_template_directory_uri() . '/functions/layout/images/archive/';

		$options = array(
			'article-all' => array(
				'label' => __( 'Article, All image', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'article-all.png',
			),
			'article-only' => array(
				'label' => __( 'Article Only', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'article-only.png',
			),
			'article-left' => array(
				'label' => __( 'Article, Image', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'article-left.png',
			),
			'article-right' => array(
				'label' => __( 'Image, Article', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'article-right.png',
			),
			'card' => array(
				'label' => __( 'Card', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'card.png',
			),
			'topics' => array(
				'label' => __( 'Topics', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'topics.png',
			),
		);

		return apply_filters( 'ace/functions/layout/get_archive_options', $options );
	}

	/**
	 * return current archive layout
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

		return apply_filters( 'ace/functions/layout/get_archive_layout', $archive );
	}

	/**
	 * echo data attribute 'data-archive-layout'
	 */
	public function data_attr_archive_layout() {
		echo ' data-archive-layout="' . $this->get_archive_layout() . '"';
	}

	/**
	 * Returns an array of layout options registered.
	 *
	 * @since 1.0.0
	 */
	public function get_footer_widget_column_ratio_options() {
		$thumbnail_uri = get_template_directory_uri() . '/functions/layout/images/footer/';

		$options = array(
			'one-to-one' => array(
				'label' => __( '1:1', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'one-to-one.svg',
			),
			'two-to-one' => array(
				'label' => __( '2:1', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'two-to-one.svg',
			),
			'one-to-two' => array(
				'label' => __( '1:2', 'ace' ),
				'thumbnail' => $thumbnail_uri . 'one-to-two.svg',
			),
		);

		return apply_filters( 'ace/functions/layout/get_footer_widget_column_ratio_options', $options );
	}

	/**
	 * return current footer widget column
	 *
	 * @since 1.0.0
	 */
	public function get_footer_widget_column_ratio() {
		$archive = $this->get_options( 'footer_widget_column_ratio' );
		return apply_filters( 'ace/functions/layout/get_footer_widget_column_ratio', $archive );
	}

	/**
	 * echo data attribute of footer widget column ratio
	 *
	 * @since 1.0.0
	 */
	public function data_attr_footer_widget_column_ratio() {
		$data_attribute = ' data-column-ratio="' . $this->get_footer_widget_column_ratio() . '"';
		echo apply_filters( 'ace/functions/layout/footer_widget_column_ratio', $data_attribute );
	}

	/**
	 * return boolean with archive_sidebar
	 *
	 * @since 1.0.0
	 */
	public function has_archive_sidebar() {
		return apply_filters( 'ace/functions/layout/has_archive_sidebar', $this->get_options( 'archive_sidebar' ) );
	}

	/**
	 * Implements theme options into Theme Customizer
	 *
	 * @param $wp_customize Theme Customizer object
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$wp_customize->add_section(
			$this->section_id,
			array(
				'title'    => __( 'Layout', 'ace' ),
				'priority' => $this->section_priority,
			)
		);

		$default_options = $this->default_options;

		$wp_customize->add_setting(
			'ace_layout_options[archive_sidebar]',
			array(
				'default'           => $default_options['archive_sidebar'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( '\Ace\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'ace_layout_options[archive_sidebar]',
			array(
				'label'    => __( 'Add sidebar to Archive', 'ace' ),
				'section'  => $this->section_id,
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'ace_layout_options[archive]',
			array(
				'default'           => $default_options['archive'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( '\Ace\Functions\Customizer\Customize_Control\Layout_Picker', 'layout_sanitize' ),
			)
		);

		$wp_customize->add_control(
			new \Ace\Functions\Customizer\Customize_Control\Layout_Picker(
				$wp_customize,
				'ace_layout_options[archive]',
				array(
					'label'      => __( 'Archive Layout', 'ace' ),
					'section'    => $this->section_id,
					'type'       => 'layout',
					'options'    => $this->get_archive_options(),
				)
			)
		);

		$wp_customize->add_setting(
			'ace_layout_options[footer_widget_column_ratio]',
			array(
				'default'           => $default_options['footer_widget_column_ratio'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( '\Ace\Functions\Customizer\Customize_Control\Layout_Picker', 'layout_sanitize' ),
			)
		);

		$wp_customize->add_control(
			new \Ace\Functions\Customizer\Customize_Control\Layout_Picker(
				$wp_customize,
				'ace_layout_options[footer_widget_column_ratio]',
				array(
					'label'      => __( 'Footer Widget Column Ratio', 'ace' ),
					'section'    => $this->section_id,
					'type'       => 'layout',
					'options'    => $this->get_footer_widget_column_ratio_options(),
				)
			)
		);
	}

}
