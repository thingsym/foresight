<?php
/**
 * Layout Picker Customize Control
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Customizer\Customize_Control;

/**
 * Class Layout_Picker
 *
 * @since 1.0.0
 */
class Layout_Picker extends \WP_Customize_Control {
	/**
	 * Constructor.
	 *
	 * @uses WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string $id
	 * @param array  $args
	 */
	public function __construct( $manager = null, $id = null, $args = [] ) {
		if ( isset( $args['options'] ) ) {
			$this->options = $args['options'];
		}
		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_print_styles', [ $this, 'customize_control_enqueue_styles' ] );
	}

	public function render_content() {
		?>
<span class="customize-control-title"><?php echo esc_html( $this->label ); ?>
		<?php if ( ! empty( $this->description ) ) : ?>
<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
<?php endif; ?>
</span>
<div class="buttonset">
		<?php
		foreach ( $this->options as $key => $value ) {
			if ( empty( $key ) ) {
				continue;
			}
			?>
<label title="<?php echo esc_html( $value['label'] ); ?>" aria-label="<?php echo esc_html( $value['label'] ); ?>">
<input type="radio" name="_customize-radio-<?php echo esc_attr( $this->id ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $this->value(), $key ); ?>>
<div>
			<?php
			if ( isset( $value['svg'] ) ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $value['svg'];
			}
			elseif ( isset( $value['thumbnail'] ) ) {
			?>
<img src="<?php echo esc_url( $value['thumbnail'] ); ?>" width="68" alt="<?php echo esc_html( $value['label'] ); ?>"><br>
			<?php
			}
			else {
			?>
			<!-- TODO: サイズ調整 -->
<svg width="100%" height="100%" viewBox="0 0 130 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g><rect x="0" y="0.1" width="130" height="72" style="fill:#ebebeb;"/></g></svg>
			<?php
			}
			?>
</div>
</label>
			<?php
		}
		?>
</div>

		<?php
	}

	/**
	 * Sanitization callback for layout
	 *
	 * @static
	 * @param string               $input Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 *
	 * @since 1.0.0
	 */
	public static function sanitize_layout( $input, $setting ) {
		$options = $setting->manager->get_control( $setting->id )->options;
		return ( array_key_exists( $input, $options ) ? $input : $setting->default );
	}

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );

		$js = <<< JS_EOM
(function($) {
	$(document).ready(function() {
		$( '[class="buttonset"]' ).buttonset();
	});
})(jQuery);
JS_EOM;

		return wp_add_inline_script( 'jquery-ui-button', $js, 'after' );
	}

	public function customize_control_enqueue_styles() {
		?>
<style>
.customize-control-layout .buttonset,
.customize-control-layout .ui-buttonset {
	display: flex;
	flex-wrap: wrap;
}
.customize-control-layout .buttonset label,
.customize-control-layout .ui-buttonset label {
	position: relative;
	margin: 0 1em 1em 0;
	padding: 0;
}
.customize-control-layout .buttonset label img,
.customize-control-layout .buttonset label svg,
.customize-control-layout .ui-buttonset label img,
.customize-control-layout .ui-buttonset label svg {
	border: 2px solid;
	border-color: #ddd;
	background: #fff;
	padding: 2px;
	width: 68px;
	height: auto;
}
.customize-control-layout .buttonset label:hover img,
.customize-control-layout .buttonset label:hover svg,
.customize-control-layout .ui-buttonset label:hover img,
.customize-control-layout .ui-buttonset label:hover svg {
	border-color: #999;
}
.customize-control-layout .buttonset label input[type="radio"]:checked + div img,
.customize-control-layout .buttonset label input[type="radio"]:checked + div svg,
.customize-control-layout .ui-buttonset label input[type="radio"]:checked + div img,
.customize-control-layout .ui-buttonset label input[type="radio"]:checked + div svg {
	border-color: #1f73c6;
}
.customize-control-layout .buttonset label svg,
.customize-control-layout .ui-buttonset label svg {
	color: #ebebeb;
}
</style>
		<?php
	}
}
