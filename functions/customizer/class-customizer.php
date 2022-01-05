<?php
/**
 * Customizer
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Customizer;

/**
 * Class Customizer
 *
 * @since 1.0.0
 */
class Customizer {

	/**
	 * Static value.
	 *
	 * @access public
	 *
	 * @var array $default_options
	 */
	public static $default_options = [
		'display_site_title'       => true,
		'display_site_description' => true,
	];

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );
		add_action( 'customize_register', [ $this, 'site_title_description' ] );
		add_action( 'customize_controls_enqueue_scripts', [ $this, 'control_enqueue_scripts' ] );
		add_action( 'customize_preview_init', [ $this, 'preview_enqueue_scripts' ] );
	}

	public function customizer( $wp_customize ) {
		if ( $wp_customize->get_setting( 'blogname' ) ) {
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		}
		if ( $wp_customize->get_setting( 'blogdescription' ) ) {
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		}
		if ( $wp_customize->get_setting( 'header_textcolor' ) ) {
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		}

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				[
					'selector'        => '.site-title a',
					'render_callback' => [ $this, 'render_partial_blogname' ],
				]
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				[
					'selector'        => '.site-description',
					'render_callback' => [ $this, 'render_partial_blogdescription' ],
				]
			);
		}
	}

	public function site_title_description( $wp_customize ) {
		$wp_customize->add_setting(
			'foresight_site_header_options[display_site_title]',
			[
				'default'           => true,
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_site_header_options[display_site_title]',
			[
				'label'   => __( 'Display Site Title', 'foresight' ),
				'section' => 'title_tagline',
				'type'    => 'checkbox',
			]
		);

		$wp_customize->add_setting(
			'foresight_site_header_options[display_site_description]',
			[
				'default'           => true,
				'type'              => 'theme_mod',
				'transport'         => 'postMessage',
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_site_header_options[display_site_description]',
			[
				'label'    => __( 'Display Tagline', 'foresight' ),
				'section'  => 'title_tagline',
				'type'     => 'checkbox',
				'priority' => 30,
			]
		);
	}

	public static function display_blogname() {
		if ( ! display_header_text() ) {
			return false;
		}

		// @phpstan-ignore-next-line
		$options = get_theme_mod( 'foresight_site_header_options', self::$default_options );

		if ( is_null( $options['display_site_title'] ) ) {
			return self::$default_options['display_site_title'];
		}

		return $options['display_site_title'];
	}

	public static function display_blogdescription() {
		if ( ! display_header_text() ) {
			return false;
		}

		// @phpstan-ignore-next-line
		$options = get_theme_mod( 'foresight_site_header_options', self::$default_options );

		if ( is_null( $options['display_site_description'] ) ) {
			return self::$default_options['display_site_description'];
		}

		return $options['display_site_description'];
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function render_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function render_partial_blogdescription() {
		bloginfo( 'description' );
	}

	public function control_enqueue_scripts() {
		wp_enqueue_script(
			'foresight-customizer-control',
			get_template_directory_uri() . '/js/customize-control.min.js',
			[],
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	public function preview_enqueue_scripts() {
		wp_enqueue_script(
			'foresight-customizer-preview',
			get_template_directory_uri() . '/js/customize-preview.min.js',
			[ 'customize-preview' ],
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
}
