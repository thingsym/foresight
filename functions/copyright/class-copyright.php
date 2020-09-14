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
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $section_id
	 */
	protected $section_id = 'foresight_copyright';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $option_name
	 */
	protected $option_name = 'foresight_copyright_options';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var int $section_priority
	 */
	protected $section_priority = 30;

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $capability
	 */
	protected $capability = 'manage_options';

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
	protected $default_options = [
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
	 * @param string $option_name Optional. The option name.
	 *
	 * @return array|null
	 *
	 * @since 1.0.0
	 */
	public function get_options( $option_name = null ) {
		$default_options = $this->default_options;
		$default_options['copyright'] = preg_replace( '/SOMEONE/', esc_html( get_bloginfo( 'name' ) ), $default_options['copyright'] );

		// @phpstan-ignore-next-line
		$options = get_theme_mod( $this->option_name, $default_options );
		$options = array_merge( $this->default_options, $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param array    $options     The options.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/copyright/get_options', $options );
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
			return apply_filters( 'foresight/functions/copyright/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function render() {
		if ( $this->get_options( 'copyright' ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<small>' . $this->get_options( 'copyright' ) . '</small>'; // @phpstan-ignore-line
		}
	}

	public function has_theme_info() {
		return $this->get_options( 'theme_info' );
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

		$wp_customize->add_section(
			$this->section_id,
			[
				'title'    => __( 'Copyright', 'foresight' ),
				'priority' => $this->section_priority,
				'panel'    => 'layout',
			]
		);

		$default_options = $this->default_options;
		$default_options['copyright'] = preg_replace( '/SOMEONE/', esc_html( get_bloginfo( 'name' ) ), $default_options['copyright'] );

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
