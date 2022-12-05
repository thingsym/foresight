<?php
/**
 * Image Picker Customize Control
 *
 * @package Foresight
 * @since 1.7.0
 */

namespace Foresight\Functions\Customizer\Customize_Control;

/**
 * Class Image_Picker
 *
 * @since 1.7.0
 */
class Image_Picker extends \WP_Customize_Image_Control {
	public $type = 'image';

	/**
	 * Constructor.
	 *
	 * @uses WP_Customize_Image_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string $id
	 * @param array  $args
	 */
	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct( $manager = null, $id = null, $args = [] ) {
		parent::__construct( $manager, $id, $args );
	}
}
