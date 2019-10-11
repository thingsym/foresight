<?php
/**
 * Load up our theme options, functions and related code.
 *
 * @package Ace
 * @since 1.0.0
 */

new \Ace\Functions\Setup\Theme();
new \Ace\Functions\Setup\Style_Script();
new \Ace\Functions\Setup\Menu();
new \Ace\Functions\Setup\Widget();

new \Ace\Functions\Template\Template();
new \Ace\Functions\Customizer\Customizer();
new \Ace\Functions\Customizer\Sanitize();
new \Ace\Functions\Theme_Hook\Theme_Hook();

new \Ace\Functions\Custom_Header\Custom_Header();
new \Ace\Functions\Entry_Meta\Entry_Meta();
new \Ace\Functions\Post_Thumbnail\Post_Thumbnail();

$ace_fn_layout    = new \Ace\Functions\Layout\Layout();
$ace_fn_excerpt   = new \Ace\Functions\Excerpt\Excerpt();
