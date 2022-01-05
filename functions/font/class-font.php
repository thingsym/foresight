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

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $section_prefix
	 */
	public $section_prefix = 'foresight_font';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $options_name
	 */
	public $options_name = 'foresight_font_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var int $section_priority
	 */
	public $section_priority = 51;

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $capability
	 */
	public $capability = 'edit_theme_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $default_options
	 */
	public $default_options = [
		'font_family_base'                   => '',
		'font_family_site_title'             => '',
		'font_family_headings'               => '',
		'fontset_google_fonts'               => '',
		'use_fontawesome'                    => false,
	];

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_filter( 'script_loader_tag', [ $this, 'add_defer' ], 10, 2 );
	}

	/**
	 * Returns the options array or value.
	 *
	 * @access public
	 *
	 * @param string $option_name  The option name or modification name via argument.
	 * @param string $type         The option or theme_mod.
	 *
	 * @return mixed|null
	 *
	 * @since 1.0.0
	 */
	public function get_options( $option_name = null, $type = 'theme_mod' ) {
		if ( ! $type ) {
			return null;
		}

		$default_options = $this->default_options;
		$options         = null;

		if ( $type == 'option' ) {
			$options = get_option( $this->options_name, $default_options );
		}
		else if ( $type == 'theme_mod' ) {
			$options = get_theme_mod( $this->options_name, $default_options );
		}

		$options = array_merge( $default_options, $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param mixed     $options     The option values or modification values.
			 * @param string    $type        The option or theme_mod.
			 * @param mixed     $default     Default value to return if the option does not exist.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/font/get_options', $options, $type, $default_options );
		}

		if ( array_key_exists( $option_name, $options ) ) {
			/**
			 * Filters the option.
			 *
			 * @param mixed     $option          The option value or modification value.
			 * @param string    $option_name     The option name or modification name via argument.
			 * @param string    $type            The option or theme_mod.
			 * @param mixed     $default         Default value to return if the option does not exist.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/font/get_option', $options[ $option_name ], $option_name, $type, $default_options );
		}
		else {
			return null;
		}
	}

	public function enqueue_styles() {
		$options = $this->get_options();

		if ( $options['fontset_google_fonts'] ) {
			wp_enqueue_style(
				'fontset-google-fonts',
				esc_url_raw( 'https://fonts.googleapis.com/css2?' . $options['fontset_google_fonts'] ),
				[],
				wp_get_theme()->get( 'Version' ),
				'all'
			);
		}

		$style = '';

		if ( $options['font_family_base'] ) {
			$style .= '--custom-font-family-base: ' . wp_strip_all_tags( $options['font_family_base'] ) . ';' . "\n";
		}
		if ( $options['font_family_site_title'] ) {
			$style .= '--custom-font-family-site-title: ' . wp_strip_all_tags( $options['font_family_site_title'] ) . ';' . "\n";
		}
		if ( $options['font_family_headings'] ) {
			$style .= '--custom-font-family-headings: ' . wp_strip_all_tags( $options['font_family_headings'] ) . ';' . "\n";
		}

		if ( $style ) {
			$style = ':root {' . "\n" . $style . '}' . "\n";
			wp_add_inline_style( 'foresight', $style );
		}
	}

	public function enqueue_scripts() {
		$options = $this->get_options();

		if ( $options['use_fontawesome'] ) {
			wp_enqueue_script(
				'fontawesome-bundle',
				get_template_directory_uri() . '/js/fontawesome.min.js',
				[],
				wp_get_theme()->get( 'Version' ),
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
	 * @param object $wp_customize Theme Customizer object.
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function customizer( $wp_customize ) {
		// @phpstan-ignore-next-line
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$default_options = $this->default_options;

		$wp_customize->add_section(
			$this->section_prefix . '_font_family',
			[
				'title'    => __( 'Font Family', 'foresight' ),
				'priority' => 10,
				'panel'    => 'font',
				'description' => __( 'Set CSS rules to specify font families', 'foresight' ) . '<br>' . __( 'e.g. font-family: [font families];', 'foresight' ),
				'capability'  => $this->capability,
			]
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_family_base]',
			[
				'default'           => $default_options['font_family_base'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[font_family_base]',
			[
				'label'   => __( 'Base Font Family', 'foresight' ),
				'section' => $this->section_prefix . '_font_family',
				'type'    => 'text',
			]
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_family_site_title]',
			[
				'default'           => $default_options['font_family_site_title'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[font_family_site_title]',
			[
				'label'   => __( 'Site Title Font Family', 'foresight' ),
				'section' => $this->section_prefix . '_font_family',
				'type'    => 'text',
			]
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_family_headings]',
			[
				'default'           => $default_options['font_family_headings'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[font_family_headings]',
			[
				'label'   => __( 'Headings Font Family', 'foresight' ),
				'section' => $this->section_prefix . '_font_family',
				'type'    => 'text',
			]
		);

		$wp_customize->add_section(
			$this->section_prefix . '_fontset',
			[
				'title'      => __( 'Font Set', 'foresight' ),
				'priority'   => 20,
				'panel'      => 'font',
				'capability' => $this->capability,
				]
		);

		$wp_customize->add_setting(
			'foresight_font_options[fontset_google_fonts]',
			[
				'default'           => $default_options['fontset_google_fonts'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[fontset_google_fonts]',
			[
				'label'   => __( 'Google Fonts Set', 'foresight' ),
				'section' => $this->section_prefix . '_fontset',
				'type'    => 'text',
				'description' => esc_url_raw( 'https://fonts.googleapis.com/css2?' ),
			]
		);

		$wp_customize->add_section(
			$this->section_prefix . '_icon_font',
			[
				'title'      => __( 'Icon Font', 'foresight' ),
				'priority'   => 30,
				'panel'      => 'font',
				'capability' => $this->capability,
			]
		);

		$wp_customize->add_setting(
			'foresight_font_options[use_fontawesome]',
			[
				'default'           => $default_options['use_fontawesome'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[use_fontawesome]',
			[
				'label'   => __( 'Use Font Awesome', 'foresight' ),
				'section' => $this->section_prefix . '_icon_font',
				'type'    => 'checkbox',
			]
		);
	}

}
