<?php
/**
 * Layout
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Layout;

use Foresight\Functions\Customizer\Customize_Control\Layout_Picker;
use Foresight\Functions\Customizer\Customize_Control\Image_Picker;
use Foresight\Functions\Customizer\Sanitize;

/**
 * Class Layout
 *
 * @since 1.0.0
 */
class Layout {

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $section_prefix
	 */
	public $section_prefix = 'foresight_layout';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $options_name
	 */
	public $options_name = 'foresight_layout_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $section_priority
	 */
	public $section_priority = 81;

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $capability
	 */
	public $capability = 'edit_theme_options';

	/**
	 * Public variable.
	 *
	 * @access public
	 *
	 * @var array $default_options {
	 *   default options
	 *
	 *   @type string archive
	 * }
	 */
	public $default_options = [
		'archive_sidebar'          => false,
		'archive'                  => 'article-all',
		'archive_image'            => null,
		'footer_area_column_ratio' => 'one-to-one',
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

		if ( $type == 'option' ) {
			$options = get_option( $this->options_name, $default_options );
		}
		else if ( $type == 'theme_mod' ) {
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
			return apply_filters( 'foresight/functions/layout/get_options', $options, $type, $default_options );
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
			return apply_filters( 'foresight/functions/layout/get_option', $options[ $option_name ], $option_name, $type, $default_options );
		}
		else {
			return null;
		}
	}

	/**
	 * Return an array of layout options registered.
	 *
	 * @since 1.0.0
	 */
	public function get_archive_options() {
		$options = [
			'article-all' => [
				'label' => __( 'Article with featured image', 'foresight' ),
				'svg'   => '<svg width="100%" height="100%" viewBox="0 0 130 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g id="article-all"><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><path d="M71.991,103.987l-55.993,0l0,-1l55.993,0l0,1Zm40.995,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm-19.998,-3.999l-76.99,0l0,-1l76.99,0l0,1Zm19.998,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-0.999l96.988,0l0,0.999Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-59.992l0,53.993l-96.988,0l0,-53.993l96.988,0Zm-38.995,-5l-57.993,0l0,-3.999l57.993,0l0,3.999Z" style="fill:#fff;"/></g></svg>',
			],
			'article-only' => [
				'label' => __( 'Article Only', 'foresight' ),
				'svg'   => '<svg width="100%" height="100%" viewBox="0 0 130 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g id="article-only"><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><path d="M92.988,101.987l-76.99,0l0,-1l76.99,0l0,1Zm19.998,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm-49.994,-4l-46.994,0l0,-1l46.994,0l0,1Zm49.994,-2l-96.988,0l0,-0.999l96.988,0l0,0.999Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm-40.995,-3.999l-55.993,0l0,-1l55.993,0l0,1Zm40.995,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-0.999l96.988,0l0,0.999Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm-19.998,-4l-76.99,0l0,-0.999l76.99,0l0,0.999Zm19.998,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm-49.994,-3.999l-46.994,0l0,-1l46.994,0l0,1Zm49.994,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-0.999l96.988,0l0,0.999Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-2l-96.988,0l0,-1l96.988,0l0,1Zm0,-1.999l-96.988,0l0,-1l96.988,0l0,1Zm-38.995,-7l-57.993,0l0,-3.999l57.993,0l0,3.999Z" style="fill:#fff;"/></g></svg>',
			],
			'article-left' => [
				'label' => __( 'Article with Right-aligned featured image', 'foresight' ),
				'svg'   => '<svg width="100%" height="100%" viewBox="0 0 130 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g id="article-left"><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><path d="M89.989,52.038l-73.991,0l0,-1.177l73.991,0l0,1.177Zm22.997,-2.354l-96.988,0l0,-1.177l96.988,0l0,1.177Zm0,-2.354l-96.988,0l0,-1.177l96.988,0l0,1.177Zm-46.994,-2.354l-49.994,0l0,-1.176l49.994,0l0,1.176Zm0,-2.353l-49.994,0l0,-1.177l49.994,0l0,1.177Zm3.999,-31.777l42.995,0l0,31.777l-42.995,0l0,-31.777Zm-3.999,29.423l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.353l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.353l-49.994,0l0,-1.177l49.994,0l0,1.177Zm-4.082,-3.531l-45.912,0l0,-4.708l45.912,0l0,4.708Z" style="fill:#fff;"/><path d="M89.989,102.645l-73.991,0l0,-1.177l73.991,0l0,1.177Zm22.997,-2.354l-96.988,0l0,-1.177l96.988,0l0,1.177Zm0,-2.354l-96.988,0l0,-1.177l96.988,0l0,1.177Zm-46.994,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm3.999,-34.13l42.995,0l0,31.776l-42.995,0l0,-31.776Zm-3.999,31.776l-49.994,0l0,-1.176l49.994,0l0,1.176Zm0,-2.353l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.176l49.994,0l0,1.176Zm0,-2.353l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm0,-2.354l-49.994,0l0,-1.177l49.994,0l0,1.177Zm-1.954,-3.53l-48.04,0l0,-4.708l48.04,0l0,4.708Z" style="fill:#fff;"/></g></svg>',
			],
			'article-right' => [
				'label' => __( 'Article with Left-aligned featured image', 'foresight' ),
				'svg'   => '<svg width="100%" height="100%" viewBox="0 0 130 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g id="article-right"><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><path d="M15.998,18.998l26.997,0l0,24.996l-26.997,0l0,-24.996Zm80.99,16.997l-46.994,0l0,-0.999l46.994,0l0,0.999Zm15.998,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm-38.995,-6l-57.993,0l0,-3.999l57.993,0l0,3.999Z" style="fill:#fff;"/><path d="M96.988,100.987l-46.994,0l0,-0.999l46.994,0l0,0.999Zm15.998,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm-96.988,-24.997l26.997,0l0,24.997l-26.997,0l0,-24.997Zm96.988,22.997l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-0.999l62.992,0l0,0.999Zm0,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-2l-62.992,0l0,-1l62.992,0l0,1Zm0,-1.999l-62.992,0l0,-1l62.992,0l0,1Zm-38.995,-6l-57.993,0l0,-3.999l57.993,0l0,3.999Z" style="fill:#fff;"/></g></svg>',
			],
			'card' => [
				'label' => __( 'Card', 'foresight' ),
				'svg'   => '<svg width="100%" height="100%" viewBox="0 0 130 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g id="card"><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><g ><path d="M47.653,56.779l-31.655,0l0,-46.78l31.655,0l0,46.78Zm-30.87,-45.995l0,45.21l30.085,0l0,-45.21l-30.085,0Z" style="fill:#fff;"/><path d="M38.224,52.366l-19.532,0l0,-0.883l19.532,0l0,0.883Zm6.735,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm-4.041,-3.531l-22.226,0l0,-3.53l22.226,0l0,3.53Zm-24.92,-28.244l31.655,0l0,22.066l-31.655,0l0,-22.066Z" style="fill:#fff;"/></g><g><path d="M82.002,56.779l-31.655,0l0,-46.78l31.655,0l0,46.78Zm-30.87,-45.995l0,45.21l30.085,0l0,-45.21l-30.085,0Z" style="fill:#fff;"/><path d="M72.573,52.366l-19.532,0l0,-0.883l19.532,0l0,0.883Zm6.735,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm-4.041,-3.531l-22.226,0l0,-3.53l22.226,0l0,3.53Zm-24.92,-28.244l31.655,0l0,22.066l-31.655,0l0,-22.066Z" style="fill:#fff;"/></g><g><path d="M47.653,109.738l-31.655,0l0,-46.781l31.655,0l0,46.781Zm-30.87,-45.995l0,45.21l30.085,0l0,-45.21l-30.085,0Z" style="fill:#fff;"/><path d="M38.224,105.324l-19.532,0l0,-0.882l19.532,0l0,0.882Zm6.735,-1.765l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm-4.041,-3.531l-22.226,0l0,-3.53l22.226,0l0,3.53Zm-24.92,-28.245l31.655,0l0,22.067l-31.655,0l0,-22.067Z" style="fill:#fff;"/></g><g><path d="M82.002,109.738l-31.655,0l0,-46.781l31.655,0l0,46.781Zm-30.87,-45.995l0,45.21l30.085,0l0,-45.21l-30.085,0Z" style="fill:#fff;"/><path d="M72.573,105.324l-19.532,0l0,-0.882l19.532,0l0,0.882Zm6.735,-1.765l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm-4.041,-3.531l-22.226,0l0,-3.53l22.226,0l0,3.53Zm-24.92,-28.245l31.655,0l0,22.067l-31.655,0l0,-22.067Z" style="fill:#fff;"/></g><g><path d="M116.351,56.779l-31.655,0l0,-46.78l31.655,0l0,46.78Zm-30.87,-45.995l0,45.21l30.085,0l0,-45.21l-30.085,0Z" style="fill:#fff;"/><path d="M106.922,52.366l-19.532,0l0,-0.883l19.532,0l0,0.883Zm6.735,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm-4.041,-3.531l-22.226,0l0,-3.53l22.226,0l0,3.53Zm-24.92,-28.244l31.655,0l0,22.066l-31.655,0l0,-22.066Z" style="fill:#fff;"/></g><g><path d="M116.351,109.738l-31.655,0l0,-46.781l31.655,0l0,46.781Zm-30.87,-45.995l0,45.21l30.085,0l0,-45.21l-30.085,0Z" style="fill:#fff;"/><path d="M106.922,105.324l-19.532,0l0,-0.882l19.532,0l0,0.882Zm6.735,-1.765l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.766l-26.267,0l0,-0.882l26.267,0l0,0.882Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm0,-1.765l-26.267,0l0,-0.883l26.267,0l0,0.883Zm-4.041,-3.531l-22.226,0l0,-3.53l22.226,0l0,3.53Zm-24.92,-28.245l31.655,0l0,22.067l-31.655,0l0,-22.067Z" style="fill:#fff;"/></g></g></svg>',
			],
			'topics' => [
				'label' => __( 'Topics', 'foresight' ),
				'svg'   => '<svg width="100%" height="100%" viewBox="0 0 130 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g id="topics"><rect x="0" y="0" width="129.984" height="116.985" style="fill:currentColor;"/><path d="M29.996,93.856l0,12.579l-13.998,0l0,-12.579l13.998,0Zm55.993,8.386l-49.993,0l0,-1.048l49.993,0l0,1.048Zm-1,-4.193l-48.993,0l0,-4.193l48.993,0l0,4.193Zm-54.993,-25.157l0,12.579l-13.998,0l0,-12.579l13.998,0Zm55.993,8.386l-49.993,0l0,-1.049l49.993,0l0,1.049Zm25.997,-4.193l-75.99,0l0,-4.193l75.99,0l0,4.193Zm-81.99,-25.157l0,12.578l-13.998,0l0,-12.578l13.998,0Zm55.993,8.385l-49.993,0l0,-1.048l49.993,0l0,1.048Zm-11.998,-4.193l-37.995,0l0,-4.192l37.995,0l0,4.192Zm-43.995,-25.157l0,12.579l-13.998,0l0,-12.579l13.998,0Zm55.993,8.386l-49.993,0l0,-1.048l49.993,0l0,1.048Zm20.998,-4.193l-70.991,0l0,-4.193l70.991,0l0,4.193Zm-76.991,-25.157l0,12.578l-13.998,0l0,-12.578l13.998,0Zm55.993,8.386l-49.993,0l0,-1.049l49.993,0l0,1.049Zm7.999,-4.193l-57.992,0l0,-4.193l57.992,0l0,4.193Z" style="fill:#fff;"/></g></svg>',
			],
		];

		return apply_filters( 'foresight/functions/layout/get_archive_options', $options );
	}

	/**
	 * Return current archive layout.
	 *
	 * @since 1.0.0
	 */
	public function get_archive_layout() {
		if ( ! ( is_archive() || is_search() || is_home() ) ) {
			return;
		}

		$archive = $this->get_options( 'archive' );

		return apply_filters( 'foresight/functions/layout/get_archive_layout', $archive );
	}

	/**
	 * Echo data attribute 'data-archive-layout'
	 */
	public function data_attr_archive_layout() {
		$archive_layout = $this->get_archive_layout();
		if ( $archive_layout ) {
			echo ' data-archive-layout="' . esc_attr( $archive_layout ) . '"';
		}
	}

	/**
	 * Return an array of layout options registered.
	 *
	 * @since 1.0.0
	 */
	public function get_footer_area_column_ratio_options() {
		$options = [
			'one-to-one' => [
				'label'     => __( '1:1', 'foresight' ),
				'svg' => '<svg width="100%" height="100%" viewBox="0 0 130 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g><rect x="66.776" y="-0.017" width="63" height="72" style="fill:currentColor;"/><rect x="-0.224" y="-0.017" width="63" height="72" style="fill:currentColor;"/></g></svg>',
			],
			'two-to-one' => [
				'label'     => __( '2:1', 'foresight' ),
				'svg' => '<svg width="100%" height="100%" viewBox="0 0 130 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g><rect x="87.8" y="-0.017" width="42" height="72" style="fill:currentColor;"/><rect x="0" y="-0.017" width="84" height="72" style="fill:currentColor;"/></g></svg>',
			],
			'one-to-two' => [
				'label'     => __( '1:2', 'foresight' ),
				'svg' => '<svg width="100%" height="100%" viewBox="0 0 130 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g><rect x="45.8" y="-0.017" width="84" height="72" style="fill:currentColor;"/><rect x="-0.224" y="-0.017" width="42" height="72" style="fill:currentColor;"/></g></svg>',
			],
		];

		return apply_filters( 'foresight/functions/layout/get_footer_area_column_ratio_options', $options );
	}

	/**
	 * Return current footer widget column.
	 *
	 * @since 1.0.0
	 */
	public function get_footer_area_column_ratio() {
		$ratio = $this->get_options( 'footer_area_column_ratio' );
		return apply_filters( 'foresight/functions/layout/get_footer_area_column_ratio', $ratio );
	}

	/**
	 * Echo data attribute of footer widget column ratio.
	 *
	 * @since 1.0.0
	 */
	public function data_attr_footer_area_column_ratio() {
		$data_attribute = apply_filters( 'foresight/functions/layout/footer_area_column_ratio', $this->get_footer_area_column_ratio() );
		echo ' data-column-ratio="' . esc_attr( $data_attribute ) . '"';
	}

	/**
	 * Return boolean with archive_sidebar.
	 *
	 * @since 1.0.0
	 */
	public function has_archive_sidebar() {
		return apply_filters( 'foresight/functions/layout/has_archive_sidebar', $this->get_options( 'archive_sidebar' ) );
	}

	/**
	 * Return madia id or url.
	 *
	 * @since 1.0.0
	 */
	public function get_archive_image_id() {
		return apply_filters( 'foresight/functions/layout/get_archive_image_id', $this->get_options( 'archive_image' ) );
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
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		$default_options = $this->default_options;

		$wp_customize->add_section(
			$this->section_prefix . '_archive',
			[
				'title'      => __( 'Archive', 'foresight' ),
				'priority'   => 10,
				'panel'      => 'layout',
				'capability' => $this->capability,
			]
		);

		$wp_customize->add_setting(
			'foresight_layout_options[archive_sidebar]',
			[
				'default'           => $default_options['archive_sidebar'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_checkbox_boolean' ],
			]
		);

		$wp_customize->add_control(
			'foresight_layout_options[archive_sidebar]',
			[
				'label'   => __( 'Add sidebar to Archive', 'foresight' ),
				'section' => $this->section_prefix . '_archive',
				'type'    => 'checkbox',
			]
		);

		$wp_customize->add_setting(
			'foresight_layout_options[archive]',
			[
				'default'           => $default_options['archive'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Customize_Control\Layout_Picker', 'sanitize_layout' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker(
				$wp_customize,
				'foresight_layout_options[archive]',
				[
					'label'   => __( 'Archive Layout', 'foresight' ),
					'section' => $this->section_prefix . '_archive',
					'type'    => 'layout',
					'options' => $this->get_archive_options(),
				]
			)
		);

		$wp_customize->add_setting(
			'foresight_layout_options[archive_image]',
			[
				'default'           => $default_options['archive_image'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Sanitize', 'sanitize_number' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Image_Picker(
				$wp_customize,
				'foresight_layout_options[archive_image]',
				[
					'label'   => __( 'Archive Image', 'foresight' ),
					'section' => $this->section_prefix . '_archive',
					'type'    => 'media',
				]
			)
		);

		$wp_customize->add_section(
			$this->section_prefix . '_footer',
			[
				'title'      => __( 'Footer', 'foresight' ),
				'priority'   => 30,
				'panel'      => 'layout',
				'capability' => $this->capability,
			]
		);

		$wp_customize->add_setting(
			'foresight_layout_options[footer_area_column_ratio]',
			[
				'default'           => $default_options['footer_area_column_ratio'],
				'type'              => 'theme_mod',
				'capability'        => $this->capability,
				'sanitize_callback' => [ '\Foresight\Functions\Customizer\Customize_Control\Layout_Picker', 'sanitize_layout' ],
			]
		);

		$wp_customize->add_control(
			new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker(
				$wp_customize,
				'foresight_layout_options[footer_area_column_ratio]',
				[
					'label'   => __( 'Footer Area Column Width Ratio (Deprecated)', 'foresight' ),
					'section' => $this->section_prefix . '_footer',
					'type'    => 'layout',
					'options' => $this->get_footer_area_column_ratio_options(),
				]
			)
		);
	}

}
