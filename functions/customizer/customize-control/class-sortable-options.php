<?php
/**
 * Sortable Options Customize Control
 *
 * @package Foresight
 * @since 1.2.0
 */

namespace Foresight\Functions\Customizer\Customize_Control;

/**
 * Class Sortable_Options
 *
 * @since 1.2.0
 */
class Sortable_Options extends \WP_Customize_Control {
	public function __construct( $manager = null, $id = null, $args = [] ) {
		if ( isset( $args['options'] ) ) {
			$this->options = $args['options'];
		}
		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_print_styles', [ $this, 'customize_control_enqueue_styles' ] );
	}

	public function render_content() {
		$entry_meta_options = array_unique( array_merge( (array) $this->value(), array_keys( $this->options ) ) );
		$value = implode( ',', $this->value() );
		?>
<span class="customize-control-title"><?php echo esc_html( $this->label ); ?>
		<?php if ( ! empty( $this->description ) ) : ?>
<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>
</span>
		<?php
		if ( 'sortable_multiple_checkbox' === $this->type ) {
			?>
<input type="hidden" class="customize-control-multiple-checkbox" name="_customize-control-multiple-checkbox-<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> value="<?php echo esc_attr( $value ); ?>" />
<div class="sortable-container">
			<?php
			foreach ( $entry_meta_options as $option ) {
				if ( empty( $option ) ) {
					continue;
				}
				?>
<div class="sortable-item">
<label><input type="checkbox" value="<?php echo esc_attr( $option ); ?>" <?php checked( in_array( $option, $this->value() ), 1 ); ?> class="multiple-checkbox-item"> <?php echo esc_html( $this->options[ $option ] ); ?></label>
<div class="ui-handle">
<svg width="100%" height="100%" viewBox="0 0 171 185" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><path d="M85.67,0.438l0.009,-0.009l48.09,48.09l-17.109,17.108l-19.058,-19.058l0,34.463l72.724,0l0,24.196l-72.724,0l0,33.259l19.058,-19.058l17.109,17.109l-36.167,36.167l0,0.247l-0.248,0l-11.675,11.675l-0.009,-0.009l-0.01,0.009l-11.675,-11.675l-0.578,0l0,-0.578l-35.836,-35.836l17.108,-17.109l18.728,18.727l0,-32.928l-72.725,0l0,-24.196l72.725,0l0,-34.132l-18.728,18.727l-17.108,-17.108l48.089,-48.09l0.01,0.009Z"/></svg>
</div>
</div>
				<?php
			}
			?>
</div>
			<?php
		}
		// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedIf
		else if ( 'sortable' === $this->type ) {
		}
	}

	/**
	 * Sanitization callback
	 *
	 * @param string               $input Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 *
	 * @since 1.2.0
	 */
	public static function sanitize_options( $input, $setting ) {
		$sortable_values = ! is_array( $input ) ? explode( ',', $input ) : $input;
		return ! empty( $sortable_values ) ? array_map( 'sanitize_text_field', $sortable_values ) : [];
	}

	public function customize_control_enqueue_styles() {
		?>
<style>
.sortable-item {
	display: flex;
	padding: .4em 0;
	border-bottom: solid 1px #ddd;
}
.sortable-item label {
	line-height: 2;
}
.sortable-item .ui-handle {
	display: inline-block;
	margin-left: auto;
	cursor: move;
	color: #444;
	border: solid 1px #ddd;
	padding: .4em;
	background: #f7f7f7;
	width: 16px;
	height: 16px;
}
.sortable-item svg {
	fill: #8a8a8a;
}
.sortable-container .sortable-placeholder {
	border: dashed 1px #999;
	background: #eee;
	height: 2.4em;
}
.sortable-container .ui-state-highlight {
	border: dashed 1px #999;
	background: #ccc;
}
.sortable-container .ui-sortable-helper {
	border: solid 1px #999;
	background: #ccc;
}
</style>
		<?php
	}
}
