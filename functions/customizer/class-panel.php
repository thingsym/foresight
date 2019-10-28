<?php
/**
 * Panel for Customizer
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Customizer;

/**
 * Class Panel
 *
 * @since 1.0.0
 */
class Panel {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_panel' ) );
	}

	public function register_panel( $wp_customize ) {
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$wp_customize->add_panel( 'layout', array(
			'title' => __( 'Layout' ),
			'priority' => 81,
		) );
	}
}
