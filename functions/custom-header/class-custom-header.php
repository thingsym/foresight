<?php
/**
 * Custom Header
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Custom_Header;

use \Foresight\Functions\Customizer\Customizer;

/**
 * Class Custom_Header
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @since 1.0.0
 */
class Custom_Header {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'header_style' ] );
	}

	/**
	 * Styles the header image and text displayed on the blog.
	 */
	public static function header_style() {

		// If we get this far, we have custom styles. Let's do this.

		$style = '';

		if ( ! \Foresight\Functions\Customizer\Customizer::display_blogname() ) {
			$style .= '.site-title {position: absolute;clip: rect(1px, 1px, 1px, 1px);}' . "\n";
		}
		if ( ! \Foresight\Functions\Customizer\Customizer::display_blogdescription() ) {
			$style .= '.site-description {position: absolute;clip: rect(1px, 1px, 1px, 1px);}' . "\n";
		}

		if ( $style ) {
			return wp_add_inline_style( 'foresight', $style );
		}

		return false;
	}
}
