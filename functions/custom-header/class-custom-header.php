<?php
/**
 * Custom Header
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Custom_Header;

use \Ace\Functions\Customizer\Customizer;

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
		add_action( 'wp_enqueue_scripts', array( $this, 'header_style' ) );
	}

	/**
	 * Styles the header image and text displayed on the blog.
	 */
	public static function header_style() {
		$custom_header_text_color = get_header_textcolor();

		// If we get this far, we have custom styles. Let's do this.

		$style = '';

		$style .= ':root {';
		if ( $custom_header_text_color ) {
			$style .= '--custom-header-text-color: #' . $custom_header_text_color . ';';
		}
		$style .= '}';

		wp_add_inline_style( 'ace', $style );
	}
}
