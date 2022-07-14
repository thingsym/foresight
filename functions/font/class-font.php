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
		'font_feature_settings'  => 'normal',
		'line_break'             => 'auto',
		'font_family_base'       => '',
		'font_family_site_title' => '',
		'font_family_headings'   => '',
	];

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
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

		$root = '';

		if ( $options['font_family_base'] ) {
			$root .= '--custom-font-family-base: ' . wp_strip_all_tags( $options['font_family_base'] ) . ';' . "\n";
		}
		if ( $options['font_family_site_title'] ) {
			$root .= '--custom-font-family-site-title: ' . wp_strip_all_tags( $options['font_family_site_title'] ) . ';' . "\n";
		}
		if ( $options['font_family_headings'] ) {
			$root .= '--custom-font-family-headings: ' . wp_strip_all_tags( $options['font_family_headings'] ) . ';' . "\n";
		}

		if ( $root ) {
			$root = ':root {' . "\n" . $root . '}' . "\n";
		}

		$body = '';

		if ( $options['font_feature_settings'] && $options['font_feature_settings'] != 'normal' ) {
			$body .= 'font-feature-settings: "' . wp_strip_all_tags( $options['font_feature_settings'] ) . '" 1;' . "\n";
		}
		if ( $options['line_break'] && $options['line_break'] != 'auto' ) {
			$body .= 'line-break: ' . wp_strip_all_tags( $options['line_break'] ) . ';' . "\n";
		}

		if ( $body ) {
			$body = 'body {' . "\n" . $body . '}' . "\n";
		}

		$style = $root . $body;

		wp_add_inline_style( 'foresight', $style );
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
			$this->section_prefix . '_font_basic',
			[
				'title'    => __( 'Basic', 'foresight' ),
				'priority' => 10,
				'panel'    => 'font',
			]
		);

		$wp_customize->add_setting(
			'foresight_font_options[font_feature_settings]',
			[
				'default'           => $default_options['font_feature_settings'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_select' ],
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[font_feature_settings]',
			[
				'label'   => __( 'font-feature-settings', 'foresight' ),
				'section' => $this->section_prefix . '_font_basic',
				'type'    => 'select',
				'choices' => [
					'normal' => 'normal',
					'palt'   => 'palt',
					'pkna'   => 'pkna',
					'pwid'   => 'pwid',
				],
			]
		);

		$wp_customize->add_setting(
			'foresight_font_options[line_break]',
			[
				'default'           => $default_options['line_break'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_select' ],
			]
		);

		$wp_customize->add_control(
			'foresight_font_options[line_break]',
			[
				'label'   => __( 'line-break', 'foresight' ),
				'section' => $this->section_prefix . '_font_basic',
				'type'    => 'select',
				'choices' => [
					'auto'     => 'auto',
					'loose'    => 'loose',
					'normal'   => 'normal',
					'strict'   => 'strict',
					'anywhere' => 'anywhere',
				],
			]
		);

		$wp_customize->add_section(
			$this->section_prefix . '_font_family',
			[
				'title'       => __( 'Font Family', 'foresight' ),
				'priority'    => 20,
				'panel'       => 'font',
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
				'priority'   => 30,
				'panel'      => 'font',
				'capability' => $this->capability,
				]
		);

	}

}
