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
		'theme_location'  => 'menu-1',
		'container'       => 'nav',
		'container_class' => 'site-navi',
		'menu_class'      => 'global-menu',
		'fallback_cb'     => false,
	)
);
