<?php
/**
 * Post Thumbnail
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Post_Thumbnail;

/**
 * Class Post_Thumbnail
 *
 * @since 1.0.0
 */
class Post_Thumbnail {

	/**
	 * Static value.
	 *
	 * @access public
	 *
	 * @var array $thumbnail_size
	 */
	public static $thumbnail_size = [
		'thumbnail'    => [
			'width'  => 150,
			'height' => 150,
		],
		'medium'       => [
			'width'  => 300,
			'height' => 300,
		],
		'medium_large' => [
			'width'  => 768,
			'height' => 768,
		],
		'large'        => [
			'width'  => 1028,
			'height' => 1028,
		],
		'full'         => [
			'width'  => null,
			'height' => null,
		],
	];

	public function __construct() {}

	public static function alternative_post_thumbnail( $size = 'thumbnail' ) {
		$html = '';

		if ( class_exists( 'Foresight\Functions\Layout\Layout' ) ) {
			global $foresight_fn_layout;
			if ( method_exists( $foresight_fn_layout, 'get_archive_image_id' ) ) {
				$attachment_id = $foresight_fn_layout->get_archive_image_id();
				if ( $attachment_id ) {
					$html = wp_get_attachment_image(
						$attachment_id,
						$size,
						false,
						[ 'class' => "attachment-$size size-$size wp-post-image wp-post-archive-image" ]
					);

					return $html;
				}
			}
		}

		if ( ! $html ) {
			$thumbnail_directory = get_stylesheet_directory() . '/img/thumbnail-4x3/';
			$thumbnail_uri       = get_stylesheet_directory_uri() . '/img/thumbnail-4x3/' . $size . '.png';

			if ( is_dir( $thumbnail_directory ) && is_file( $thumbnail_directory . $size . '.png' ) ) {
				$width    = self::$thumbnail_size[ $size ]['width'];
				$height   = self::$thumbnail_size[ $size ]['height'];
				$hwstring = image_hwstring( $width, $height );

				$attr = [
					'src'   => $thumbnail_uri,
					'class' => "attachment-$size size-$size wp-post-image wp-post-preset-image",
					'alt'   => '',
				];

				if ( wp_lazy_loading_enabled( 'img', 'wp_get_attachment_image' ) ) {
					$attr['loading'] = 'lazy';
				}

				$attr = array_map( 'esc_attr', $attr );

				$html = rtrim( "<img $hwstring" );
				foreach ( $attr as $name => $value ) {
					$html .= " $name=" . '"' . $value . '"';
				}
				$html .= ' />';

				return $html;
			}
		}

		return $html;
	}

	public static function post_thumbnail( $size = 'thumbnail', $alternative = false ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		$html = '';

		if ( has_post_thumbnail() ) {
			if ( is_singular() ) {
				$html = get_the_post_thumbnail( null, $size, [] );
			}
			else {
				$html = get_the_post_thumbnail(
					null,
					$size,
					[
						'alt' => the_title_attribute( [ 'echo' => false ] ),
					]
				);
			}
		}
		else {
			if ( $alternative ) {
				$html = self::alternative_post_thumbnail( $size );
			}
		}

		if ( ! $html ) {
			return;
		}
		?>
<div class="post-thumbnail">
		<?php
		if ( is_singular() ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $html;
		} else {
		?>
<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $html;
?>
</a>
			<?php
		}
		?>
</div>
		<?php
	}

	public static function post_thumbnail_background_style() {
		if ( ! has_post_thumbnail() ) {
			return;
		}

		$style  = 'style="';
		$style .= "background-image: url('" . esc_url( get_the_post_thumbnail_url() ) . "')";
		$style .= '"';

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $style;
	}
}
