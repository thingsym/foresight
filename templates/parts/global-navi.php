<?php
/**
 * Global navi
 *
 * @package Foresight
 */

?>

<div id="js-drawer-btn" class="drawer-btn" tabindex="0">
<svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" style="pointer-events: none; display: block;">
<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
</svg>
</div>

<div class="drawer-overlay"></div>

<?php
wp_nav_menu(
	array(
		'theme_location'  => 'global',
		'container'       => 'nav',
		'container_class' => 'site-navi drawer',
		'menu_class'      => 'global-menu',
		'fallback_cb'     => false,
	)
);
