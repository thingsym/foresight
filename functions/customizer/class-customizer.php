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
	public static $default_options = array(
		'display_site_title'    => true,
		'display_title_tagline' => true,
	);

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer' ) );
		add_action( 'customize_register', array( $this, 'site_title_description' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'control_enqueue_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'preview_enqueue_scripts' ) );
	}

	public function customizer( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => array( $this, 'render_partial_blogname' ),
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'render_partial_blogdescription' ),
				)
			);
		}
	}

	public function site_title_description( $wp_customize ) {
		$wp_customize->remove_setting( 'display_header_text' );
		$wp_customize->remove_control( 'display_header_text' );

		$wp_customize->add_setting(
			'foresight_site_header_options[display_site_title]',
			array(
				'default'           => true,
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'foresight_site_header_options[display_site_title]',
			array(
				'label'   => __( 'Display Site Title', 'foresight' ),
				'section' => 'title_tagline',
				'type'    => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'foresight_site_header_options[display_site_description]',
			array(
				'default'           => true,
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'foresight_site_header_options[display_site_description]',
			array(
				'label'    => __( 'Display Tagline', 'foresight' ),
				'section'  => 'title_tagline',
				'type'     => 'checkbox',
				'priority' => 30,
			)
		);
	}

	public static function display_blogname() {
		$option = get_option( 'foresight_site_header_options', self::$default_options );
		return $option['display_site_title'];
	}

	public static function display_blogdescription() {
		$option = get_option( 'foresight_site_header_options', self::$default_options );
		return $option['display_site_description'];
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
			get_template_directory_uri() . '/js/customize-control.bundle.js',
			array(),
			'20191008',
			true
		);
	}

	public function preview_enqueue_scripts() {
		wp_enqueue_script(
			'foresight-customizer-preview',
			get_template_directory_uri() . '/js/customize-preview.bundle.js',
			array( 'customize-preview' ),
			'20151215',
			true
		);
	}
}
