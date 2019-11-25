<?php
/**
 * Load up our theme options, functions and related code.
 *
 * @package Foresight
 * @since 1.0.0
 */

new \Foresight\Functions\Setup\Theme();
new \Foresight\Functions\Setup\Style_Script();
new \Foresight\Functions\Setup\Menu();
new \Foresight\Functions\Setup\Widget();
new \Foresight\Functions\Setup\Editor();

new \Foresight\Functions\Template\Template();
new \Foresight\Functions\Customizer\Customizer();
new \Foresight\Functions\Customizer\Panel();
new \Foresight\Functions\Customizer\Sanitize();
new \Foresight\Functions\Theme_Hook\Theme_Hook();

new \Foresight\Functions\Custom_Header\Custom_Header();
new \Foresight\Functions\Entry_Meta\Entry_Meta();
new \Foresight\Functions\Post_Thumbnail\Post_Thumbnail();
new \Foresight\Functions\Color\Color();
new \Foresight\Functions\Font\Font();

$foresight_fn_layout    = new \Foresight\Functions\Layout\Layout();
$foresight_fn_excerpt   = new \Foresight\Functions\Excerpt\Excerpt();
$foresight_fn_copyright = new \Foresight\Functions\Copyright\Copyright();
