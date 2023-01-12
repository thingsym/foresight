<?php
/**
 * Load up our theme options, functions and related code.
 *
 * @package Foresight
 * @since 1.0.0
 */

$foresight_setup_theme        = new \Foresight\Functions\Setup\Theme();
$foresight_setup_style_script = new \Foresight\Functions\Setup\Style_Script();
$foresight_setup_menu         = new \Foresight\Functions\Setup\Menu();
$foresight_setup_widget       = new \Foresight\Functions\Setup\Widget();
$foresight_setup_editor       = new \Foresight\Functions\Setup\Editor();

new \Foresight\Functions\Template\Template();
new \Foresight\Functions\Customizer\Customizer();
new \Foresight\Functions\Customizer\Panel();
new \Foresight\Functions\Customizer\Sanitize();
new \Foresight\Functions\Theme_Hook\Theme_Hook();

new \Foresight\Functions\Custom_Header\Custom_Header();
new \Foresight\Functions\Post_Thumbnail\Post_Thumbnail();
new \Foresight\Functions\Color\Color();
new \Foresight\Functions\Font\Font();

$foresight_fn_layout     = new \Foresight\Functions\Layout\Layout();
$foresight_fn_excerpt    = new \Foresight\Functions\Excerpt\Excerpt();
$foresight_fn_entry_meta = new \Foresight\Functions\Custom_Entry_Meta\Custom_Entry_Meta();
$foresight_fn_copyright  = new \Foresight\Functions\Copyright\Copyright();

new \Foresight\Functions\SEO\Meta_Description();

new \Foresight\Functions\Image_Srcset\Image_Srcset();
new \Foresight\Functions\Emoji\Emoji();
new \Foresight\Functions\Wp_Custom_Css\Wp_Custom_Css();
