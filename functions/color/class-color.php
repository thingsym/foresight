<?php
/**
 * Color
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Color;

/**
 * class Color
 *
 * @since 1.0.0
 */
class Color {
	protected $section_id  = 'colors';
	protected $option_name = 'ace_color_options';
	protected $capability  = 'manage_options';

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
	}

	public function get_default_options() {
		$default_options = array(
			'header-background-color'   => '',
			'footer-background-color'   => '',
			'primary-color'   => '',
			'secondary-color' => '',
			'tertiary-color'  => '',
		);

		return $default_options;
	}

	public function get_options( $option_name = null ) {
		$options = get_option( $this->option_name, $this->get_default_options() );
		$options = array_merge( $this->get_default_options(), $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param array    $options     The options.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'ace/functions/color/get_options', $options );
		}

		if ( array_key_exists( $option_name, $options ) ) {
			/**
			 * Filters the option.
			 *
			 * @param mixed    $option           The value of option.
			 * @param string   $option_name      The option name via argument.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'ace/functions/color/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function enqueue_styles() {
		$style = '';

		$style .= ':root {';

		if ( $this->get_options( 'header-background-color' ) ) {
			$style .= '--custom-header-background-color: #' . $this->get_options( 'header-background-color' ) . ';';
		}
		if ( $this->get_options( 'footer-background-color' ) ) {
			$style .= '--custom-footer-background-color: #' . $this->get_options( 'footer-background-color' ) . ';';
		}
		if ( $this->get_options( 'primary-color' ) ) {
			$style .= '--custom-primary-color: #' . $this->get_options( 'primary-color' ) . ';';
		}
		if ( $this->get_options( 'secondary-color' ) ) {
			$style .= '--custom-secondary-color: #' . $this->get_options( 'secondary-color' ) . ';';
		}
		if ( $this->get_options( 'tertiary-color' ) ) {
			$style .= '--custom-tertiary-color: #' . $this->get_options( 'tertiary-color' ) . ';';
		}

		$style .= '}';

		wp_add_inline_style( 'ace', $style );
	}

	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$default_options = $this->get_default_options();

		$wp_customize->add_setting(
			'ace_color_options[header-background-color]',
			array(
				'default'              => $default_options['header-background-color'],
				'type'                 => 'option',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',

			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'ace_color_options[header-background-color]',
				array(
					'label'   => __( 'Header Background Color', 'ace' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'ace_color_options[footer-background-color]',
			array(
				'default'              => $default_options['footer-background-color'],
				'type'                 => 'option',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'ace_color_options[footer-background-color]',
				array(
					'label'   => __( 'Footer Background Color', 'ace' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'ace_color_options[primary-color]',
			array(
				'default'              => $default_options['primary-color'],
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'ace_color_options[primary-color]',
				array(
					'label'   => __( 'Primary Color (Main)', 'ace' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'ace_color_options[secondary-color]',
			array(
				'default'              => $default_options['secondary-color'],
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'ace_color_options[secondary-color]',
				array(
					'label'   => __( 'Secondary Color (Accent)', 'ace' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'ace_color_options[tertiary-color]',
			array(
				'default'              => $default_options['tertiary-color'],
				'type'                 => 'option',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'ace_color_options[tertiary-color]',
				array(
					'label'   => __( 'Tertiary Color (Sub)', 'ace' ),
					'section' => 'colors',
				)
			)
		);
	}
}