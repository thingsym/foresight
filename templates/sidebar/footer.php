<?php
/**
 * The footer containing the widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foresight
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
}

global $foresight_fn_layout;
?>

<?php if ( is_active_sidebar( 'footer' ) ) : ?>
<div class="footer-widget">
<div class="widget-area">
	<?php dynamic_sidebar( 'footer' ); ?>
</div>
</div>
<?php endif; ?>
