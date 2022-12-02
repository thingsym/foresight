<?php
/**
 * Panel for Customizer
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Customizer;

/**
 * Class Panel
 *
 * @since 1.0.0
 */
class Panel {

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var string $capability
	 */
	public $capability = 'edit_theme_options';

	public function __construct() {
		add_action( 'customize_register', [ $this, 'register_panel' ] );
	}

	public function register_panel( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$wp_customize->add_panel(
			'font',
			[
				'title'      => __( 'Font', 'foresight' ),
				'priority'   => 51,
				'capability' => $this->capability,
			]
		);

		$wp_customize->add_panel(
			'layout',
			[
				'title'      => __( 'Layout', 'foresight' ),
				'priority'   => 81,
				'capability' => $this->capability,
			]
		);

		$wp_customize->add_panel(
			'advanced_settings',
			[
				'title'    => __( 'Advanced Settings', 'foresight' ),
				'priority' => 300,
			]
		);
	}
}
