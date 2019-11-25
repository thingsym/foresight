<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foresight
 */

if ( ! is_active_sidebar( 'sidebar-post' ) ) {
	return;
}
?>

<aside class="secondary">
<div class="widget-area">
	<?php dynamic_sidebar( 'sidebar-post' ); ?>
</div>
</aside>
