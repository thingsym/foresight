=== Foresight ===

Contributors: thingsym
Link: https://github.com/thingsym/foresight
Donate link: https://github.com/sponsors/thingsym
Stable tag: 1.6.1
Tested up to: 5.8.0
Requires at least: 5.1
Requires PHP: 7.0
License: GPL2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: one-column, block-styles, wide-blocks, two-columns, right-sidebar, custom-background, custom-logo, custom-menu, featured-images, threaded-comments, editor-style, theme-options, rtl-language-support, footer-widgets, translation-ready

Foresight is a business website or a one page WordPress theme for the Block Editor.

== Description ==

Foresight is a business website WordPress theme for the Block Editor. It is also a one page WordPress theme that designed to take full advantage of the Block Editor. This theme is well suited for business, landing page, branding or marketing. It provides a fast way to build website easily customizable for companies or freelancers. You can focus on content or webpage creation using the Block Editor.

== Installation ==

= Case of using WordPress theme installer =

1. Go the Appearance > Themes menu in WordPress and click the Add New button.
2. Put keyword and search theme.
3. Click Install button.
4. Activate the theme through the Appearance > Themes menu in WordPress.
5. Have fun!

= Case of uploading theme zip file =

1. Download theme's zip file.
2. Go the Appearance > Themes menu in WordPress and click the Add New button.
3. Click the Upload Theme button and Choose theme's zip file
4. Click Install Now.
5. Activate the theme through the Appearance > Themes menu in WordPress.
6. Have fun!

= Case of uploading theme to directory via FTP =

1. Download and unzip theme's zip file.
2. Upload theme folder to the "/wp-content/themes/" directory.
3. Activate the theme through the Appearance > Themes menu in WordPress.
4. Have fun!

== Frequently Asked Questions ==

= Where does the Custom Header Image appear? =

The Custom Header Image only shows in the page template `Top Page Template`.
We recommend using Image Block and Cover Block instead of the Custom Header Image for other page templates Page and Posts.

= Where does the sidebar with the sidebar widget appear? =

The widget area "Sidebar" is displayed on the Pages or Posts when the page template `Sidebar Page Template` is selected.
The sidebar is displayed on the archive page when "Add sidebar to Archive" is enabled in the "Archive" sub-panel in the "Layout" panel in the customizer.


== Changelog ==

= 1.6.1 - 2021.06.28 =
* fix workflow
* update dependencies with package.json
* fix sass
* fix css with latest comments widget block
* enable excerpt with page type
* change the hook to customize_controls_print_styles

= 1.6.0 - 2021.05.26 =
* add asset-release workflow
* add image size option for medium_large
* update japanese translation
* update pot
* improve stack for inner container
* fix css custom properties
* change css custom properties for color palette
* add custom color properties to block editor
* fix post_thumbnail
* rename option name and prefix
* fix section priority
* add section to customizer panel

= 1.5.1 - 2021.03.29 =
* tested up to 5.7.0
* fix font weight for editor post title
* fix npm script
* fix webpack config for webpack 5
* update package.json
* imporve code with phpcs, phpmd and phpstan
* restructure code
* remove unused variables
* change method name
* add css class name 'buttonset' for customize-control-layout
* add test case
* update wordpress-test-matrix
* edit README
* add FUNDING.yml
* add source repository link
* add donate link
* fix workflow

= 1.5.0 - 2020.11.23 =
* fix layout structure for flexbox
* remove .travis.yml, change CI/CD to Github Actions
* add workflow for unit test
* fix menu-arrow-icon
* fix table width for align-wide
* fix caption text-align
* change version number with wp_enqueue_*
* fix: fix word-break
* fix button margin
* fix quote style

= 1.4.0 - 2020.10.19 =
* fix button style, align the height according to is-style-outline
* fix form, quote, table and calendar style
* fix word break
* fix stack
* change thumbnail to inline svg
* replace from dashicon to original svg icon
* add svg output to Layout Picker Customize Control

= 1.3.0 - 2020.09.29 =
* change stack to css custom properties
* fix stylesheet output
* fix comment form width
* change escape function
* fix form, table and password form style
* fix enqueue tag
* change method name
* fix npm scripts
* add block-asset.css, divide css for block assets
* add loading="lazy" with image tag	and custom logo

= 1.2.0 - 2020.09.14 =
* add Custom Entry Meta to customizer
* imporve code with phpcs, phpmd and phpstan

= 1.1.4 - 2020.08.27 =
* fix scss
* update japanese translation
* update pot
* update testunit configuration
* fix composer.json
* fix webpack.config.js, generate compressed and uncompressed files
* fix npm scripts
* update package.json
* add customize option that show more reading link
* fix hook tags

= 1.1.3 - 2020.08.03 =
* fix Uncaught TypeError on landing-page

= 1.1.2 - 2020.07.27 =
* add Blank Page Template instead of Featured image Header Page Template
* remove Featured image Header Page Template
* change Theme URI
* fix iframe width in the wp-block
* trim white space below wp-block-image

= 1.1.1 - 2020.07.13 =
* fix Tags: is either empty or missing in style.css header
* add Tested up to in style.css header [Automated Theme Scanning: Fail]
* fix escaping
* fix phpcs.ruleset
* fix composer.json

= 1.1.0 - 2020.07.13 =
* remove wp-block-group padding
* fix iframe width in wrapper with embed blocks for alignfull
* add hooks to entry meta for custom post type
* fix archive layout for custom post type
* fix entry meta output for custom post type
* fix hooks priority
* fix wp-block-button hover
* add _editor-color-palette.scss
* assign object to variable for child theme
* update japanese translation
* update pot
* fix labels of archive layout
* fix wp-block-table style
* replace from eyecatch to featured image

= 1.0.9 - 2020.06.08 =
* replace array() to short array syntax []
* remove jQuery dependency, replace jQuery to pure javascript

= 1.0.8 - 2020.06.02 =
* update japanese translation
* update pot
* fix card layout
* integrate excerpt_mblength into excerpt_length

= 1.0.7 - 2020.05.19 =
* fix scss
* fix README

= 1.0.6 - 2020.05.18 =
* reformat with phpcs
* fix scss
* fix method name
* add note and FAQ about setting The Custom Header Image

= 1.0.5 - 2020.04.22 =
* bump up phpunit version 7.x
* fix version with wp_enqueue_style
* fix returns value in case is_admin
* fix copyright statement

= 1.0.4 - 2020.04.13 =
* update japanese translation
* update pot
* change screenshot image
* add the description with the customize controls
* fix overflow the content area
* change live customize preview
* add hover and focus styles with drawer menus for the keyboard navigation
* add focus style with buttons for the keyboard navigation
* adjust the drawer position by the height of the wp admin bar
* fix the burger menu overlaps with the wp admin bar
* fix display_header_text customize
* change from global scope to Immediate function
* add sanitize_callback
* change google fonts url
* remove CDN with web font
* add html escape
* fix footer credit
* fix copyright statement
* fix header image
* move test case directory

= 1.0.3 - 2020.03.10 =
* update japanese translation
* update pot
* add submenu focus for keyboard control to global navi
* add keyboard control to ToggleMenu
* move template parts files to page-header dir

= 1.0.2 - 2020.02.21 =
* update japanese translation
* update pot
* change theme options from option to theme_mod
* add skip link
* add non minified javascript files for theme review
* change javascript minifiy via terser
* add header.php and footer.php
* move template files to root

= 1.0.1 - 2020.02.11 =
* fix npm script
* fix landing page layout
* fix scss
* remove link rel="profile"
* improve display_site_title and display_site_description

= 1.0.0 - 2019.11.25 =
* initial release

== License and Resources ==

Foresight WordPress Theme, Copyright 2019-2020 thingsym

Foresight is distributed under the terms of GNU General Public License V2 or later.

Foresight bundles the following third-party resources:

* Based on [WP Theme Boilerplate](https://github.com/thingsym/wp-theme-boilerplate), [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* CSS reset by [normalize.css](https://necolas.github.io/normalize.css/), [MIT](https://opensource.org/licenses/MIT)
* [Font Awesome Free](https://github.com/FortAwesome/Font-Awesome), [MIT](https://opensource.org/licenses/MIT), [SIL OFL 1.1](https://opensource.org/licenses/OFL-1.1), [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/deed)

Header image for theme screenshot, Copyright Kaique Rocha
License: [StockSnap's CC0 License](https://stocksnap.io/license)
Source: [https://stocksnap.io/photo/UTLSND0DES](https://stocksnap.io/photo/UTLSND0DES)
