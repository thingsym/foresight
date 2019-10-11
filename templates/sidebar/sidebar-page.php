<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ace
 */

if ( ! is_active_sidebar( 'sidebar-page' ) ) {
	return;
}
?>

<aside class="secondary">
<div class="widget-area">
	<?php dynamic_sidebar( 'sidebar-page' ); ?>
</div>
</aside>
