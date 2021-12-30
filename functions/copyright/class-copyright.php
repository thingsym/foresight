<?php
/**
 * Copyright
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Copyright;

/**
 * Class Copyright
 *
 * @since 1.0.0
 */
class Copyright {

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $section_id
	 */
	public $section_id = 'foresight_copyright';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $options_name
	 */
	public $options_name = 'foresight_copyright_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var int $section_priority
	 */
	public $section_priority = 40;

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $capability
	 */
	public $capability = 'manage_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $default_options {
	 *   default options
	 *
	 *   @type string copyright
	 *   @type bool   theme_info
	 * }
	 */
	public $default_options = [
		'copyright'  => 'Copyright &copy; <strong>SOMEONE</strong>, All rights reserved.',
		'theme_info' => true,
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

		$options['copyright'] = preg_replace( '/SOMEONE/', esc_html( get_bloginfo( 'name' ) ), $options['copyright'] );

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
			return apply_filters( 'foresight/functions/copyright/get_options', $options, $type, $default_options );
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
			return apply_filters( 'foresight/functions/copyright/get_option', $options[ $option_name ], $option_name, $type, $default_options );
		}
		else {
			return null;
		}
	}

	/**
	 * @since 1.5.0
	 */
	public function get_html() {
		if ( ! $this->get_options( 'copyright' ) ) {
			return;
		}

		return '<small>' . $this->get_options( 'copyright' ) . '</small>'; // @phpstan-ignore-line
	}

	public function render() {
		$copyright = $this->get_html();

		if ( ! $copyright ) {
			return;
		}

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $copyright;
	}

	public function has_theme_info() {
		$checked = $this->get_options( 'theme_info' );

		return ( ( isset( $checked ) && $checked ) ? true : false );
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
		$default_options['copyright'] = preg_replace( '/SOMEONE/', esc_html( get_bloginfo( 'name' ) ), $default_options['copyright'] );

		$wp_customize->add_section(
			$this->section_id,
			[
				'title'    => __( 'Copyright', 'foresight' ),
				'priority' => $this->section_priority,
				'panel'    => 'layout',
			]
		);

		$wp_customize->add_setting(
			'foresight_copyright_options[copyright]',
			[
				'default'           => $default_options['copyright'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => 'wp_kses_post',
			]
		);

		$wp_customize->add_control(
			'foresight_copyright_options[copyright]',
			[
				'label'   => __( 'Copyright Text', 'foresight' ),
				'section' => $this->section_id,
				'type'    => 'textarea',
			]
		);

		$wp_customize->add_setting(
			'foresight_copyright_options[theme_info]',
			[
				'default'           => $default_options['theme_info'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_copyright_options[theme_info]',
			[
				'label'   => __( 'Show Theme info', 'foresight' ),
				'section' => $this->section_id,
				'type'    => 'checkbox',
			]
		);
	}

}
