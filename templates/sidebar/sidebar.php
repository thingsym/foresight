<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ace
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="secondary">
<div class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
</div>
