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
			'height' => null,
		],
		'large'        => [
			'width'  => 1028,
			'height' => null,
		],
		'full'         => [
			'width'  => null,
			'height' => null,
		],
	];

	public function __construct() {}

	public static function post_thumbnail( $size = 'thumbnail', $alternative = false ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( ! has_post_thumbnail() ) {
			if ( $alternative ) {
				$thumbnail_directory = get_stylesheet_directory() . '/img/thumbnail/';
				$thumbnail_uri       = get_stylesheet_directory_uri() . '/img/thumbnail/' . $size . '.png';

				if ( is_dir( $thumbnail_directory ) && is_file( $thumbnail_directory . $size . '.png' ) ) {
					$width  = self::$thumbnail_size[ $size ]['width'];
					$height = self::$thumbnail_size[ $size ]['height'];
					?>
<div class="post-thumbnail">
					<?php if ( ! is_singular() ) : ?>
<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php endif; ?>
<img width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" src="<?php echo esc_attr( $thumbnail_uri ); ?>" alt="<?php the_title_attribute( [ 'echo' => true ] ); ?>" class="attachment-<?php echo esc_attr( $size ); ?> wp-post-image wp-post-no-image">
					<?php if ( ! is_singular() ) : ?>
</a>
					<?php endif; ?>
</div>
					<?php
				}
			}

			return;
		}
		?>
<div class="post-thumbnail">
		<?php
		if ( is_singular() ) :
			the_post_thumbnail( $size );
		else :
			?>

<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				$size,
				[
					'alt' => the_title_attribute(
						[
							'echo' => false,
						]
					),
				]
			);
			?>
</a>

			<?php
		endif; // End is_singular().
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

		echo $style;
	}
}
