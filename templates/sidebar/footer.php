<?php
/**
 * The footer containing the widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foresight
 */

if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) ) {
	return;
}

global $foresight_fn_layout;
?>

<div class="footer-widget"<?php $foresight_fn_layout->data_attr_footer_widget_column_ratio(); ?>>
<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
<div class="widget-area">
	<?php dynamic_sidebar( 'footer-1' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
<div class="widget-area">
	<?php dynamic_sidebar( 'footer-2' ); ?>
</div>
<?php endif; ?>
</div>
