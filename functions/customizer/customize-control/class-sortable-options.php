<?php
/**
 * Sortable Options Customize Control
 *
 * @package Things_CMS
 * @since 1.0.0
 */

namespace Foresight\Functions\Customizer\Customize_Control;

/**
 * Class Sortable_Options
 *
 * @since 1.2.0
 */
class Sortable_Options extends \WP_Customize_Control {
	public function __construct( $manager, $id, $args = [] ) {
		$this->options = $args['options'];
		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_enqueue_scripts', [ $this, 'customize_control_enqueue_styles' ] );
	}

	public function render_content() {
		$entry_meta_options = array_unique( array_merge( (array) $this->value(), array_keys( $this->options ) ) );
		$value = implode( ',', $this->value() );
		?>
<span class="customize-control-title"><?php echo esc_attr( $this->label ); ?>
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
<label><input type="checkbox" value="<?php echo esc_attr( $option ); ?>" <?php checked( in_array( $option, $this->value() ), 1 ); ?> class="multiple-checkbox-item"> <?php esc_html_e( $this->options[ $option ] ); ?></label>
<div class="ui-handle"><i class="dashicons dashicons-leftright"></i></div>
</div>
				<?php
			}
			?>
</div>
			<?php
		}
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
	 * @since 1.0.0
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
	border: solid 1px #ccc;
	padding: .2em;
	background: #f7f7f7;
	transform: rotate(90deg);
}
.sortable-item .dashicons {
	vertical-align: middle;
}
.sortable-container .sortable-placeholder {
	border: dotted 1px #999;
	background: #eee;
	height: 2.4em;
}
.sortable-container .ui-state-highlight {
	border: dotted 1px #999;
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
