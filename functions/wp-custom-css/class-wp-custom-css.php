<?php
/**
 * WP Custom css
 *
 * @package Foresight
 * @since 2.3.0
 */

namespace Foresight\Functions\Wp_Custom_Css;

/**
 * class Wp_Custom_Css
 *
 * @since 1.4.0
 */
class Wp_Custom_Css {

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $section_id
	 */
	public $section_id = 'custom_css';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $options_name
	 */
	public $options_name = 'foresight_wp_custom_css_options';

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
	 * @var array $default_options
	 */
	public $default_options = [
		'footer' => false,
	];

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
		add_action( 'after_setup_theme', [ $this, 'init' ] );
		add_action( 'customize_controls_print_styles', [ $this, 'customize_control_enqueue_styles' ] );
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

		if ( $type === 'option' ) {
			$options = get_option( $this->options_name, $default_options );
		}
		elseif ( $type === 'theme_mod' ) {
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
			return apply_filters( 'foresight/functions/wp_custom_css/get_options', $options, $type, $default_options );
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
			return apply_filters( 'foresight/functions/wp_custom_css/get_option', $options[ $option_name ], $option_name, $type, $default_options );
		}
		else {
			return null;
		}
	}

	public function init() {
		$footer = $this->get_options( 'footer' );

		if ( $footer ) {
			remove_action( 'wp_head', 'wp_custom_css_cb', 101 );
			add_action( 'wp_footer', 'wp_custom_css_cb', 9999 );
		}
	}

	public function customize_control_enqueue_styles() {
		?>
<style>
.customize-section-description-container + #customize-control-custom_css {
	margin-left: -12px;
}
.customize-control-code_editor .CodeMirror {
	height: calc(100vh - 240px);
}
</style>
		<?php
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

		$wp_customize->add_setting(
			'foresight_wp_custom_css_options[footer]',
			[
				'default'           => $default_options['footer'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_wp_custom_css_options[footer]',
			[
				'label'    => __( 'Place custom CSS in the footer', 'foresight' ),
				'section'  => $this->section_id,
				'type'     => 'checkbox',
			]
		);
	}
}
