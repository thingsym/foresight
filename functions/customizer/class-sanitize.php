<?php
/**
 * Customizer Sanitize
 *
 * @package Foresight
 * @since 1.0.0
 * @see https://codex.wordpress.org/Function_Reference/sanitize_key
 */

namespace Foresight\Functions\Customizer;

/**
 * Class Sanitize
 *
 * @since 1.0.0
 */
class Sanitize {
	public function __construct() {}

	/**
	 * Checkbox boolean sanitization callback.
	 *
	 * Sanitization callback for 'checkbox' type controls.
	 * This callback sanitizes `$checked` as a boolean value, either TRUE or FALSE.
	 *
	 * @static
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	public static function sanitize_checkbox_boolean( $checked, $setting ) {
		// @phpstan-ignore-next-line
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	public static function sanitize_number( $number, $setting ) {
		if ( ! is_numeric( $number ) ) {
			if ( isset( $setting->default ) ) {
				return $setting->default;
			}

			return '';
		}

		$number = (int) $number;

		return $number;
	}

	/**
	 * Number Range sanitization callback.
	 *
	 * Sanitization callback for 'number' or 'tel' type text inputs.
	 * This callback sanitizes `$number` as an absolute integer within a defined min-max range.
	 *
	 * @static
	 * @param int                  $number  Number to check within the numeric range defined by the setting.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise, the setting default.
	 */
	public static function sanitize_number_absint( $number, $setting ) {
		if ( ! is_numeric( $number ) ) {
			if ( isset( $setting->default ) ) {
				return $setting->default;
			}

			return '';
		}

		$number = absint( $number );

		if ( $number ) {
			return $number;
		}
		else {
			if ( isset( $setting->default ) && 0 === $setting->default ) {
				return 0;
			}
			elseif ( isset( $setting->default ) ) {
				return $setting->default;
			}

			return '';
		}
	}

	public static function sanitize_positive_number( $number, $setting ) {
		if ( ! is_numeric( $number ) ) {
			if ( isset( $setting->default ) ) {
				return $setting->default;
			}

			return '';
		}

		$number = (int) $number;

		if ( $number <= 0 ) {
			return 1;
		}

		return $number;
	}

	/**
	 * Select sanitization callback.
	 *
	 * Sanitization callback for 'select' and 'radio' type controls.
	 * This callback sanitizes `$input` as a slug, and then validates `$input` against the choices defined for the control.
	 *
	 * @static
	 * @param string               $input Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 */
	public static function sanitize_select( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return array_key_exists( $input, $choices ) ? $input : $setting->default;
	}

	/**
	 * Radio sanitization callback.
	 * Alias sanitize_select().
	 *
	 * Sanitization callback for 'select' and 'radio' type controls.
	 * This callback sanitizes `$input` as a slug, and then validates `$input` against the choices defined for the control.
	 *
	 * @static
	 * @param string               $input Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 */
	public static function sanitize_radio( $input, $setting ) {
		return self::sanitize_select( $input, $setting );
	}

}
