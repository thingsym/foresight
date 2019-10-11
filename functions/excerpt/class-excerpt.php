<?php
/**
 * Excerpt
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Excerpt;

/**
 * class Excerpt
 *
 * @since 1.0.0
 */
class Excerpt {
	protected $section_id   = 'ace_layout';
	protected $option_name  = 'ace_excerpt_options';
	protected $capability   = 'manage_options';

	protected $default_options = array(
		'excerpt_type'     => 'fulltext',
		'excerpt_length'   => 55,
		'excerpt_mblength' => 110,
	);

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer' ) );

		add_filter( 'excerpt_length', array( $this, 'get_excerpt_length' ) );
		add_filter( 'excerpt_mblength', array( $this, 'get_excerpt_mblength' ) );
		add_filter( 'excerpt_more', array( $this, 'auto_excerpt_more' ) );
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
			return apply_filters( 'ace/functions/layout/get_options', $options );
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
			return apply_filters( 'ace/functions/layout/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function get_excerpt_length( $length ) {
		$length = $this->get_options( 'excerpt_length' );
		return $length;
	}

	public function get_excerpt_mblength( $length ) {
		$length = $this->get_options( 'excerpt_mblength' );
		return $length;
	}

	public function get_excerpt_type() {
		return $this->get_options( 'excerpt_type' );
	}

	/**
	 * Returns a "Continue Reading" link for excerpts
	 */
	public static function render_continue_reading_link() {
		global $post;
		if ( 'attachment' == $post->post_type ) {
			return '';
		}
		return ' <span class="more-reading"><a href="' . esc_url( get_permalink() ) . '" class="more-reading-link">' . __( 'Continue reading', 'thingscms' ) . '</a></span>';
	}

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and render_continue_reading_link().
	 *
	 * To override this in a child theme, remove the filter and add your own
	 * function tied to the excerpt_more filter hook.
	 */
	public function auto_excerpt_more( $more ) {
		return ' &hellip;' . self::render_continue_reading_link();
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

		$wp_customize->add_setting(
			'ace_excerpt_options[excerpt_type]',
			array(
				'default'           => $default_options['excerpt_type'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( '\Ace\Functions\Customizer\Sanitize', 'sanitize_radio' ),
			)
		);

		$wp_customize->add_control(
			'ace_excerpt_options[excerpt_type]',
			array(
				'label'    => __( 'Archive Excerpt', 'ace' ),
				'section'  => $this->section_id,
				'type'     => 'radio',
				'choices'  =>array(
					'fulltext' => __( 'Full text', 'ace' ),
					'summary'  => __( 'Summary', 'ace' ),
				),
			)
		);

		$wp_customize->add_setting(
			'ace_excerpt_options[excerpt_length]',
			array(
				'default'           => $default_options['excerpt_length'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( '\Ace\Functions\Customizer\Sanitize', 'sanitize_number_absint' ),
			)
		);

		$wp_customize->add_control(
			'ace_excerpt_options[excerpt_length]',
			array(
				'label'    => __( 'Excerpt length', 'ace' ),
				'section'  => $this->section_id,
				'type'     => 'number',
			)
		);

		$wp_customize->add_setting(
			'ace_excerpt_options[excerpt_mblength]',
			array(
				'default'           => $default_options['excerpt_mblength'],
				'type'              => 'option',
				'capability'        => $this->capability,
				'sanitize_callback' => array( '\Ace\Functions\Customizer\Sanitize', 'sanitize_number_absint' ),
			)
		);

		$wp_customize->add_control(
			'ace_excerpt_options[excerpt_mblength]',
			array(
				'label'    => __( 'Excerpt multibyte length', 'ace' ),
				'section'  => $this->section_id,
				'type'     => 'number',
			)
		);

	}
}
