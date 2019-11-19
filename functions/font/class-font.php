<?php
/**
 * Font
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Font;

/**
 * class Font
 *
 * @since 1.0.0
 */
class Font {
	protected $section_id       = 'ace_font';
	protected $option_name      = 'ace_font_options';
	protected $section_priority = 51;
	protected $capability       = 'manage_options';

	protected $default_options = array(
		'font_family_base'       => '',
		'font_family_site_title'  => '',
		'font_family_headings'   => '',
		'fontset_google_fonts'   => '',
		'use_fontawesome'        => false,
		'use_fontawesome_kit'    => false,
		'fontawesome_kit_id'     => '',
		'replace_fontawesome_to_lineawesome' => false,
		'use_lineawesome'       => false,
	);

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
		add_filter( 'script_loader_tag', array( $this, 'add_defer' ), 10, 2 );
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
			return apply_filters( 'ace/functions/font/get_options', $options );
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
			return apply_filters( 'ace/functions/font/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function enqueue_style() {
		$options = $this->get_options();

		if ( $options['fontset_google_fonts'] ) {
			wp_enqueue_style(
				'fontset-google-fonts',
				'https://fonts.googleapis.com/css?family=' . esc_html__( $options['fontset_google_fonts'] ),
				array(),
				'all'
			);
		}

		if ( $options['use_fontawesome'] && $options['replace_fontawesome_to_lineawesome'] ) {
			wp_enqueue_style(
				'iconset-replaced-fontawesome-line-awesome',
				'https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css',
				array(),
				'all'
			);
		}

		if ( $options['use_lineawesome'] ) {
			wp_enqueue_style(
				'iconset-line-awesome',
				'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.1.0/css/line-awesome.min.css',
				array(),
				'all'
			);
		}

		$style = '';

		$style .= ':root {';
		if ( $options['font_family_base'] ) {
			$style .= '--custom-font-family-base: ' . $options['font_family_base'] . ';';
		}
		if ( $options['font_family_site_title'] ) {
			$style .= '--custom-font-family-site-title: ' . $options['font_family_site_title'] . ';';
		}
		if ( $options['font_family_headings'] ) {
			$style .= '--custom-font-family-headings: ' . $options['font_family_headings'] . ';';
		}
		$style .= '}';

		wp_add_inline_style( 'ace', $style );
	}

	public function enqueue_scripts() {
		$options = $this->get_options();

		if ( $options['use_fontawesome'] ) {
			if ( ! $options['replace_fontawesome_to_lineawesome'] ) {
				if ( $options['use_fontawesome_kit'] && $options['fontawesome_kit_id'] ) {
					wp_enqueue_script(
						'fontawesome-kit',
						'https://kit.fontawesome.com/' . esc_html__( $options['fontawesome_kit_id'] ) . '.js',
						array(),
						'20191113',
						true
					);
				}
				else {
					wp_enqueue_script(
						'fontawesome-bundle',
						get_template_directory_uri() . '/js/fontawesome.bundle.js',
						array(),
						'20191107',
						true
					);
				}
			}
		}
	}

	public function add_defer( $tag, $handle ) {
		if ( 'fontawesome-bundle' === $handle ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		if ( 'fontawesome-kit' === $handle ) {
			return str_replace( ' src', ' crossorigin="anonymous" src', $tag );
		}

		return $tag;
	}

	/**
	 * Implements theme options into Theme Customizer
	 *
	 * @param $wp_customize Theme Customizer object
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function customizer( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$default_options = $this->default_options;

		$wp_customize->add_section(
			$this->section_id . '_font_family',
			array(
				'title'    => __( 'Font Family', 'ace' ),
				'priority' => 10,
				'panel' => 'font',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[font_family_base]',
			array(
				'default'           => $default_options['font_family_base'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array(),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[font_family_base]',
			array(
				'label'      => __( 'Base Font Family', 'ace' ),
				'section'    => $this->section_id . '_font_family',
				'type'       => 'text',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[font_family_site_title]',
			array(
				'default'           => $default_options['font_family_site_title'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array(),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[font_family_site_title]',
			array(
				'label'      => __( 'Site Title Font Family', 'ace' ),
				'section'    => $this->section_id . '_font_family',
				'type'       => 'text',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[font_family_headings]',
			array(
				'default'           => $default_options['font_family_headings'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array(),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[font_family_headings]',
			array(
				'label'      => __( 'Headings Font Family', 'ace' ),
				'section'    => $this->section_id . '_font_family',
				'type'       => 'text',
			)
		);

		$wp_customize->add_section(
			$this->section_id . '_fontset',
			array(
				'title'    => __( 'Font Set', 'ace' ),
				'priority' => 20,
				'panel' => 'font',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[fontset_google_fonts]',
			array(
				'default'           => $default_options['fontset_google_fonts'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array(),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[fontset_google_fonts]',
			array(
				'label'      => __( 'Google Fonts Set', 'ace' ),
				'section'    => $this->section_id . '_fontset',
				'type'       => 'text',
			)
		);

		$wp_customize->add_section(
			$this->section_id . '_icon_font',
			array(
				'title'    => __( 'Icon Font', 'ace' ),
				'priority' => 30,
				'panel' => 'font',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[use_fontawesome]',
			array(
				'default'           => $default_options['use_fontawesome'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( 'Ace\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[use_fontawesome]',
			array(
				'label'      => __( 'Use Font Awesome', 'ace' ),
				'section'    => $this->section_id . '_icon_font',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[use_fontawesome_kit]',
			array(
				'default'           => $default_options['use_fontawesome_kit'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( 'Ace\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[use_fontawesome_kit]',
			array(
				'label'      => __( 'Use Font Awesome Kit (Replace bundle version)', 'ace' ),
				'section'    => $this->section_id . '_icon_font',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[fontawesome_kit_id]',
			array(
				'default'           => $default_options['fontawesome_kit_id'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array(),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[fontawesome_kit_id]',
			array(
				'label'    => __( 'Font Awesome Kit ID', 'ace' ),
				'section'  => $this->section_id . '_icon_font',
				'type'     => 'text',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[replace_fontawesome_to_lineawesome]',
			array(
				'default'           => $default_options['replace_fontawesome_to_lineawesome'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( 'Ace\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[replace_fontawesome_to_lineawesome]',
			array(
				'label'      => __( 'Replace Font Awesome to Line Awesome', 'ace' ),
				'section'    => $this->section_id . '_icon_font',
				'type'       => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'ace_font_options[use_lineawesome]',
			array(
				'default'           => $default_options['use_lineawesome'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( 'Ace\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ),
			)
		);

		$wp_customize->add_control(
			'ace_font_options[use_lineawesome]',
			array(
				'label'      => __( 'Use Line Awesome (New project version)', 'ace' ),
				'section'    => $this->section_id . '_icon_font',
				'type'       => 'checkbox',
			)
		);
	}

}
