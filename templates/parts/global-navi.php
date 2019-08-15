<?php
/**
 * Global navi
 *
 * @package Ace
 */

?>
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
