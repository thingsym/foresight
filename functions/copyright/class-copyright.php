<?php
/**
 * Copyright
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Copyright;

/**
 * Class Copyright
 *
 * @since 1.0.0
 */
class Copyright {
	protected $section_id       = 'ace_copyright';
	protected $option_name      = 'ace_copyright_options';
	protected $section_priority = 30;
	protected $capability       = 'manage_options';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var array $default_options {
	 *   default options
	 *
	 *   @type string copyright
	 *   @type bool   theme_info
	 * }
	 */
	protected $default_options = array(
		'copyright'  => 'Copyright &copy; <a href="https://wordpress.org/themes/ace/">Ace</a> WordPress theme, All rights reserved.',
		'theme_info' => true,
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
			return apply_filters( 'ace/functions/copyright/get_options', $options );
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
			return apply_filters( 'ace/functions/copyright/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function render() {
		if ( $this->get_options( 'copyright' ) ) {
			echo '<small>' . $this->get_options( 'copyright' ) . '</small>';
		}
	}

	public function has_theme_info() {
		return $this->get_options( 'theme_info' );
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
			$this->section_id,
			array(
				'title'    => __( 'Copyright', 'ace' ),
				'priority' => $this->section_priority,
				'panel'    => 'layout',
			)
		);

		$default_options = $this->default_options;

		$wp_customize->add_setting(
			'ace_copyright_options[copyright]',
			array(
				'default'           => $default_options['copyright'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array(),
			)
		);

		$wp_customize->add_control(
			'ace_copyright_options[copyright]',
			array(
				'label'   => __( 'Copyright Text', 'ace' ),
				'section' => $this->section_id,
				'type'    => 'textarea',
			)
		);

		$wp_customize->add_setting(
			'ace_copyright_options[theme_info]',
			array(
				'default'           => $default_options['theme_info'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( 'Ace\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'ace_copyright_options[theme_info]',
			array(
				'label'   => __( 'Show Theme info', 'ace' ),
				'section' => $this->section_id,
				'type'    => 'checkbox',
			)
		);
	}

}
