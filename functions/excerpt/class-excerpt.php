<?php
/**
 * Excerpt
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Excerpt;

/**
 * Class Excerpt
 *
 * @since 1.0.0
 */
class Excerpt {

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $section_id
	 */
	protected $section_id = 'foresight_layout_archive';

	/**
	 * Protected value.
	 *
	 * @access protected
	 *
	 * @var string $option_name
	 */
	protected $option_name = 'foresight_excerpt_options';

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
	 * @var array $default_options
	 */
	protected $default_options = [
		'excerpt_type'      => 'fulltext',
		'excerpt_length'    => 55,
		'more_reading_link' => true,
	];

	public function __construct() {
		add_action( 'customize_register', [ $this, 'customizer' ] );

		add_filter( 'excerpt_length', [ $this, 'get_excerpt_length' ] );
		add_filter( 'excerpt_mblength', [ $this, 'get_excerpt_mblength' ] );
		add_filter( 'excerpt_more', [ $this, 'auto_excerpt_more' ] );
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
		// @phpstan-ignore-next-line
		$options = get_theme_mod( $this->option_name, $this->default_options );
		$options = array_merge( $this->default_options, $options );

		if ( is_null( $option_name ) ) {
			/**
			 * Filters the options.
			 *
			 * @param array    $options     The options.
			 *
			 * @since 1.0.0
			 */
			return apply_filters( 'foresight/functions/excerpt/get_options', $options );
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
			return apply_filters( 'foresight/functions/excerpt/get_option', $options[ $option_name ], $option_name );
		}
		else {
			return null;
		}
	}

	public function get_excerpt_length( $length = 55 ) {
		if ( is_admin() ) {
			return $length;
		}

		$length = $this->get_options( 'excerpt_length' );
		return $length;
	}

	public function get_excerpt_mblength( $length = 110 ) {
		if ( is_admin() ) {
			return $length;
		}

		$length = $this->get_options( 'excerpt_length' );
		return $length;
	}

	public function get_excerpt_type() {
		return $this->get_options( 'excerpt_type' );
	}

	/**
	 * Returns a "Continue Reading" link for excerpts
	 */
	public function render_continue_reading_link() {
		global $post;
		if ( 'attachment' == $post->post_type ) {
			return '';
		}

		$length = $this->get_options( 'excerpt_length' );
		if ( ! $length ) {
			return '';
		}

		$more_reading_link = $this->get_options( 'more_reading_link' );
		if ( ! $more_reading_link ) {
			return '';
		}

		$link_html = ' <span class="more-reading"> &hellip; <a href="' . esc_url( get_permalink() ) . '" class="more-reading-link">' . __( 'Continue reading', 'foresight' ) . '</a></span>';
		/**
		 * Filters the option.
		 *
		 * @param string   $link_html      The html of "Continue Reading" link.
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'foresight/functions/excerpt/render_continue_reading_link', $link_html );
	}

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and render_continue_reading_link().
	 *
	 * To override this in a child theme, remove the filter and add your own
	 * function tied to the excerpt_more filter hook.
	 */
	public function auto_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		return $this->render_continue_reading_link();
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

		$wp_customize->add_setting(
			'foresight_excerpt_options[excerpt_type]',
			[
				'default'           => $default_options['excerpt_type'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_radio' ],
			]
		);

		$wp_customize->add_control(
			'foresight_excerpt_options[excerpt_type]',
			[
				'label'   => __( 'Archive Excerpt', 'foresight' ),
				'section' => $this->section_id,
				'type'    => 'radio',
				'choices' => [
					'none'     => __( 'None', 'foresight' ),
					'fulltext' => __( 'Full text', 'foresight' ),
					'summary'  => __( 'Summary', 'foresight' ),
				],
			]
		);

		$wp_customize->add_setting(
			'foresight_excerpt_options[excerpt_length]',
			[
				'default'           => $default_options['excerpt_length'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_number' ],
			]
		);

		$wp_customize->add_control(
			'foresight_excerpt_options[excerpt_length]',
			[
				'label'   => __( 'Maximum number of words', 'foresight' ),
				'section' => $this->section_id,
				'type'    => 'number',
				'description' => __( '<strong>Number of characters</strong>, if multibyte is supported.', 'foresight' ),
			]
		);

		$wp_customize->add_setting(
			'foresight_excerpt_options[more_reading_link]',
			[
				'default'           => $default_options['more_reading_link'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ 'Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_excerpt_options[more_reading_link]',
			[
				'label'   => __( 'Show more reading link', 'foresight' ),
				'section' => $this->section_id,
				'type'    => 'checkbox',
			]
		);

	}
}
