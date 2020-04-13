<?php
/**
 * Font
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Font;

/**
 * Class Font
 *
 * @since 1.0.0
 */
class Font {
	protected $section_id       = 'foresight_font';
	protected $option_name      = 'foresight_font_options';
	protected $section_priority = 51;
	protected $capability       = 'manage_options';

	protected $default_options = array(
		'font_family_base'                   => '',
		'font_family_site_title'             => '',
		'font_family_headings'               => '',
		'fontset_google_fonts'               => '',
		'use_fontawesome'                    => false,
	);

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_filter( 'script_loader_tag', array( $this, 'add_defer' ), 10, 2 );
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
			return apply_filters( 'foresight/functions/font/get_options', $options );
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
			return apply_filters( 'foresight/functions/font/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function enqueue_style() {
		$options = $this->get_options();

		if ( $options['fontset_google_fonts'] ) {
			wp_enqueue_style(
				'fontset-google-fonts',
				esc_url_raw( 'https://fonts.googleapis.com/css2?' . $options['fontset_google_fonts'] ),
				array(),
				'all'
			);
		}

		$style = '';

		$style .= ':root {';
		if ( $options['font_family_base'] ) {
			$style .= '--custom-font-family-base: ' . wp_strip_all_tags( $options['font_family_base'] ) . ';';
		}
		if ( $options['font_family_site_title'] ) {
			$style .= '--custom-font-family-site-title: ' . wp_strip_all_tags( $options['font_family_site_title'] ) . ';';
		}
		if ( $options['font_family_headings'] ) {
			$style .= '--custom-font-family-headings: ' . wp_strip_all_tags( $options['font_family_headings'] ) . ';';
		}
		$style .= '}';

		wp_add_inline_style( 'foresight', $style );
	}

	public function enqueue_scripts() {
		$options = $this->get_options();

		if ( $options['use_fontawesome'] ) {
			wp_enqueue_script(
				'fontawesome-bundle',
				get_template_directory_uri() . '/js/fontawesome.min.js',
				array(),
				'20191107',
				true
			);
		}
	}

	public function add_defer( $tag, $handle ) {
		if ( 'fontawesome-bundle' === $handle ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		return $tag;
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

		$default_options = $this->default_options;

		$wp_customize->add_section(
			$this->section_id . '_font_family',
			array(
				'title'    => __( 'Font Family', 'foresight' ),
				'priority' => 10,
				'panel'    => 'font',
				'description' => __( 'Set CSS rules to specify font families', 'foresight' ) . '<br>' . __( 'e.g. font-family: [font families];', 'foresight' ),
			)
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_family_base]',
			array(
				'default'           => $default_options['font_family_base'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'foresight_font_options[font_family_base]',
			array(
				'label'   => __( 'Base Font Family', 'foresight' ),
				'section' => $this->section_id . '_font_family',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_family_site_title]',
			array(
				'default'           => $default_options['font_family_site_title'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'foresight_font_options[font_family_site_title]',
			array(
				'label'   => __( 'Site Title Font Family', 'foresight' ),
				'section' => $this->section_id . '_font_family',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_family_headings]',
			array(
				'default'           => $default_options['font_family_headings'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'foresight_font_options[font_family_headings]',
			array(
				'label'   => __( 'Headings Font Family', 'foresight' ),
				'section' => $this->section_id . '_font_family',
				'type'    => 'text',
			)
		);

		$wp_customize->add_section(
			$this->section_id . '_fontset',
			array(
				'title'    => __( 'Font Set', 'foresight' ),
				'priority' => 20,
				'panel'    => 'font',
			)
		);

		$wp_customize->add_setting(
			'foresight_font_options[fontset_google_fonts]',
			array(
				'default'           => $default_options['fontset_google_fonts'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'foresight_font_options[fontset_google_fonts]',
			array(
				'label'   => __( 'Google Fonts Set', 'foresight' ),
				'section' => $this->section_id . '_fontset',
				'type'    => 'text',
				'description' => esc_url_raw( 'https://fonts.googleapis.com/css2?' ),
			)
		);

		$wp_customize->add_section(
			$this->section_id . '_icon_font',
			array(
				'title'    => __( 'Icon Font', 'foresight' ),
				'priority' => 30,
				'panel'    => 'font',
			)
		);

		$wp_customize->add_setting(
			'foresight_font_options[use_fontawesome]',
			array(
				'default'           => $default_options['use_fontawesome'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => array( 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'foresight_font_options[use_fontawesome]',
			array(
				'label'   => __( 'Use Font Awesome', 'foresight' ),
				'section' => $this->section_id . '_icon_font',
				'type'    => 'checkbox',
			)
		);
	}

}
