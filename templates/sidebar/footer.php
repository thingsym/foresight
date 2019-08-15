<?php
/**
 * The footer containing the widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ace
 */

if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' )  ) {
	return;
}
?>

<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
<div class="footer-widget">
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
