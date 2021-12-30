<?php
/**
 * Color
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Color;

/**
 * Class Color
 *
 * @since 1.0.0
 */
class Color {

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $section_id
	 */
	public $section_id = 'colors';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $options_name
	 */
	public $options_name = 'foresight_color_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $capability
	 */
	public $capability = 'manage_options';

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_styles' ] );
	}

	public function get_default_options() {
		$default_options = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];

		return $default_options;
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

		$default_options = $this->get_default_options();
		$options         = null;

		if ( $type == 'option' ) {
			$options = get_option( $this->options_name, $default_options );
		}
		else if ( $type == 'theme_mod' ) {
			// @phpstan-ignore-next-line
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
			return apply_filters( 'foresight/functions/color/get_options', $options, $type, $default_options );
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
			return apply_filters( 'foresight/functions/color/get_option', $options[ $option_name ], $option_name, $type, $default_options );
		}
		else {
			return null;
		}
	}

	public function enqueue_styles() {
		$style = $this->generate_inline_style();
		if ( $style ) {
			$style = ':root {' . "\n" . $style . '}' . "\n";
			wp_add_inline_style( 'foresight', $style );
		}
	}

	public function enqueue_block_editor_styles() {
		$style = $this->generate_inline_style();
		if ( $style ) {
			$style = ':root .editor-styles-wrapper {' . "\n" . $style . '}' . "\n";
			wp_add_inline_style( 'foresight-block-editor', $style );
		}
	}

	public function generate_inline_style() {
		$style = '';

		$custom_background_color = get_background_color();
		if ( $custom_background_color ) {
			$style .= '--custom-background-color: #' . esc_html( $custom_background_color ) . ';' . "\n";
		}

		$custom_header_text_color = get_header_textcolor();
		if ( $custom_header_text_color ) {
			$style .= '--custom-header-text-color: #' . esc_html( $custom_header_text_color ) . ';' . "\n";
		}

		if ( $this->get_options( 'header-background-color' ) ) {
			$style .= '--custom-header-background-color: #' . esc_html( $this->get_options( 'header-background-color' ) ) . ';' . "\n";
		}
		if ( $this->get_options( 'footer-background-color' ) ) {
			$style .= '--custom-footer-background-color: #' . esc_html( $this->get_options( 'footer-background-color' ) ) . ';' . "\n";
		}
		if ( $this->get_options( 'primary-color' ) ) {
			$style .= '--custom-primary-color: #' . esc_html( $this->get_options( 'primary-color' ) ) . ';' . "\n";
		}
		if ( $this->get_options( 'secondary-color' ) ) {
			$style .= '--custom-secondary-color: #' . esc_html( $this->get_options( 'secondary-color' ) ) . ';' . "\n";
			$style .= '--custom-link-text-color: #' . esc_html( $this->get_options( 'secondary-color' ) ) . ';' . "\n";
		}
		if ( $this->get_options( 'tertiary-color' ) ) {
			$style .= '--custom-tertiary-color: #' . esc_html( $this->get_options( 'tertiary-color' ) ) . ';' . "\n";
			$style .= '--custom-link-text-hover-color: #' . esc_html( $this->get_options( 'tertiary-color' ) ) . ';' . "\n";
		}

		return $style;
	}

	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$default_options = $this->get_default_options();

		$wp_customize->add_setting(
			'foresight_color_options[header-background-color]',
			[
				'default'              => $default_options['header-background-color'],
				'type'                 => 'theme_mod',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',

			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'foresight_color_options[header-background-color]',
				[
					'label'   => __( 'Header Background Color', 'foresight' ),
					'section' => 'colors',
				]
			)
		);

		$wp_customize->add_setting(
			'foresight_color_options[footer-background-color]',
			[
				'default'              => $default_options['footer-background-color'],
				'type'                 => 'theme_mod',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'foresight_color_options[footer-background-color]',
				[
					'label'   => __( 'Footer Background Color', 'foresight' ),
					'section' => 'colors',
				]
			)
		);

		$wp_customize->add_setting(
			'foresight_color_options[primary-color]',
			[
				'default'              => $default_options['primary-color'],
				'type'                 => 'theme_mod',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'foresight_color_options[primary-color]',
				[
					'label'   => __( 'Primary Color (Main)', 'foresight' ),
					'section' => 'colors',
					'description' => __( 'Set navigation color', 'foresight' ),
				]
			)
		);

		$wp_customize->add_setting(
			'foresight_color_options[secondary-color]',
			[
				'default'              => $default_options['secondary-color'],
				'type'                 => 'theme_mod',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'foresight_color_options[secondary-color]',
				[
					'label'   => __( 'Secondary Color (Accent)', 'foresight' ),
					'section' => 'colors',
					'description' => __( 'Set link text color', 'foresight' ),
				]
			)
		);

		$wp_customize->add_setting(
			'foresight_color_options[tertiary-color]',
			[
				'default'              => $default_options['tertiary-color'],
				'type'                 => 'theme_mod',
				'transport'            => 'postMessage',
				'capability'           => 'manage_options',
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
			]
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'foresight_color_options[tertiary-color]',
				[
					'label'   => __( 'Tertiary Color (Sub)', 'foresight' ),
					'section' => 'colors',
					'description' => __( 'Set link text color when the user mouse over', 'foresight' ),
				]
			)
		);
	}
}
