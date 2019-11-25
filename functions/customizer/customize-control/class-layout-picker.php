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
	public function __construct( $manager, $id, $args = array() ) {
		$this->options = $args['options'];
		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_print_styles', array( $this, 'enqueue_styles' ) );
	}

	public function render_content() {
		?>
<span class="customize-control-title"><?php echo esc_attr( $this->label ); ?>
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
<label>
<input type="radio" name="_customize-radio-<?php echo esc_attr( $this->id ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( $this->value(), $key ); ?>>
<div>
<img src="<?php echo esc_url( $value['thumbnail'] ); ?>" width="68" alt="<?php echo esc_html( $value['label'] ); ?>" title="<?php echo esc_html( $value['label'] ); ?>"><br>
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

		wp_add_inline_script( 'jquery-ui-button', $js, 'after' );
	}

	public function enqueue_styles() {
		?>
<style>
.customize-control-layout .ui-buttonset label {
	display: block;
	float: left;
	position: relative;
	margin: 0 1em 1em 0;
	padding: 0;
}
.customize-control-layout .ui-buttonset label img {
	border: 2px solid #ddd;
	background: #fff;
	padding: .1rem;
}
.customize-control-layout .ui-buttonset label:hover img {
	border: 2px solid #999;
}
.customize-control-layout .ui-buttonset label input[type="radio"]:checked + div img {
	border: 2px solid #1f73c6;
}
</style>
		<?php
	}
}
