=== Foresight ===

Contributors: thingsym
Link: https://github.com/thingsym/foresight
Donate link: https://github.com/sponsors/thingsym
Stable tag: 2.5.0
Tested up to: 6.5.4
Requires at least: 5.9
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: one-column, block-styles, wide-blocks, two-columns, right-sidebar, custom-background, custom-logo, custom-menu, featured-images, threaded-comments, editor-style, theme-options, rtl-language-support, footer-widgets, translation-ready

Foresight is a business website or a one page WordPress theme for the Block Editor.

== Description ==

Foresight is a business website WordPress theme for the Block Editor. It is also a one page WordPress theme that designed to take full advantage of the Block Editor. This theme is well suited for business, landing page, branding or marketing. It provides a fast way to build website easily customizable for companies or freelancers. You can focus on content or webpage creation using the Block Editor.

= Support =

If you have any trouble, you can use the forums or report bugs.

* Forum: [https://wordpress.org/support/theme/foresight/](https://wordpress.org/support/theme/foresight/)
* Issues: [https://github.com/thingsym/foresight/issues](https://github.com/thingsym/foresight/issues)

= Contribution =

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

Translating a theme takes a lot of time, effort, and patience. I really appreciate the hard work from these contributors.

If you have created or updated your own language pack, you can send gettext PO and MO files to author. I can bundle it into theme.

* [VCS - GitHub](https://github.com/thingsym/foresight)
* [Homepage - WordPress Theme](https://wordpress.org/themes/foresight/)
* [Translate Foresight into your language.](https://translate.wordpress.org/projects/wp-themes/foresight)


You can also contribute by answering issues on the forums.

* Forum: [https://wordpress.org/support/theme/foresight/](https://wordpress.org/support/theme/foresight/)
* Issues: [https://github.com/thingsym/foresight/issues](https://github.com/thingsym/foresight/issues)

= Patches and Bug Fixes =

Forking on Github is another good way. You can send a pull request.

1. Fork [Foresight WordPress Theme](https://github.com/thingsym/foresight) from GitHub repository
2. Create a feature branch: git checkout -b my-new-feature
3. Commit your changes: git commit -am 'Add some feature'
4. Push to the branch: git push origin my-new-feature
5. Create new Pull Request

= Contribute guidlines =

If you would like to contribute, here are some notes and guidlines.

* All development happens on the **develop** branch, so it is always the most up-to-date
* The **master** branch only contains tagged releases
* If you are going to be submitting a pull request, please submit your pull request to the **develop** branch
* See about [forking](https://help.github.com/articles/fork-a-repo/) and [pull requests](https://help.github.com/articles/using-pull-requests/)

= Test Matrix =

For operation compatibility between PHP version and WordPress version, see below [GitHub Actions](https://github.com/thingsym/foresight/actions).

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

= 2.5.0 - 2024.06.12 =
* update japanese translation
* update pot
* update npm dependencies
* add editor font sizes
* replace from word-break to overflow-wrap
* improve css using modern css
* add theme support
* fix search page
* fix inline magic space
* remove footer area column ratio
* [BREAKING CHANGE]remove footer widgets area to replace with Block editor
* [BREAKING CHANGE]remove copyright to replace with Block editor
* fix github workflows

= 2.4.2 - 2024.04.18 =
* tested up to 6.5.2
* change to Requires at least WordPress 5.9, php 7.2
* fix github workflows
* add phpcs job for ci
* update japanese translation
* update pot
* update npm dependencies
* add test case
* fix archive layout with no excerpt
* improve header layout
* allow wrap for pagination
* add min-width for admin bar
* fix width using css min()
* change hook name
* improve code with phpcs
* fix comment form
* add search results pagination
* fix search result page layout
* bump up version cpy-cli and fix npm scripts

= 2.4.1 - 2023.11.17 =
* tested up to 6.4.1
* fix phpunit.xml config
* phpunit and phpunit-polyfills bump up
* fix github workflows
* change to Requires at least WordPress 5.2
* fix scss

= 2.4.0 - 2023.04.06 =
* update npm dependencies
* fix scss
* fix filter name
* add tearDown to unittest
* fix archive_container
* add add_post_class for excerpt-type
* remove functions, Wp_Custom_Css, Emoji, Image_Srcset
* fix filter name
* change method name
* remove wp head control for plugin-territory
* screenshot.png image compress

= 2.3.0 - 2023.01.12 =
* update japanese translation
* update pot
* add option that place custom CSS in the footer
* add emoji resource control
* add meta description
* add aria-label
* update github actions, Node.js 12 actions are deprecated

= 2.2.0 - 2022.12.05 =
* tested up to 6.1.0
* fix phpcs.ruleset.xml
* imporve code with phpcs
* update japanese translation
* update pot
* add test case
* fix scss
* fix archive layout
* fix sanitize_callback
* add sanitize_positive_number and change function from is_int to is_numeric
* improve entry_meta
* fix wp-theme-unit-test.yml
* fix composer scripts
* fix npm scripts
* fix scss
* remove helper.scss
* fix default_options value
* fix data-archive-layout
* fix return value for testability
* add default argument
* rewrite ToggleMenu with es6
* change to button tag and add aria for drawer
* improve error page
* add image srcset
* add Advanced Settings panel to customizer
* add load_textdomain method for testability
* add msgmerge to npm scripts
* add support section and enhance contribution section
* fix license

= 2.1.1 - 2022.09.06 =
* fix thumbnail size settings
* add Upgrade Notice
* fix Requires at least PHP 7.1
* fix compatible with setUp(): void for php 8
* fix padding with media-text block
* rename default-editor-breakpoint
* add default-editor-breakpoint for is-stacked-on-mobile
* add editor scss

= 2.1.0 - 2022.07.19 =
* update npm dependencies
* fix search form layout
* remove google fonts and fontawesome
* fix comment form layout

= 2.0.2 - 2022.06.22 =
* tested up to 6.0.0
* fix scss
* fix search block design
* fix button design
* fix wp-theme-unit-test.yml
* fix sub menu space
* remove clearfix
* fix hr tag
* fix editor scss

= 2.0.1 - 2022.03.04 =
* fix scss
* fix stack
* rename to helper mixin
* fix typography settings
* improve sass function
* fix test case
* replace assert from assertEquals to assertSame

= 2.0.0 - 2022.02.09 =
* update npm dependencies
* change scss library from LibSass to dart sass
* fix wp-theme-unit-test.yml
* bump up yoast/phpunit-polyfills version
* change os to ubuntu-20.04 for ci

= 1.9.0 - 2022.01.06 =
* update japanese translation
* update pot
* fix scss
* add font_feature_settings and line_break options to the font customizer
* fix sanitize_select method
* add test case
* improve sanitize method
* change capability from manage_options to edit_theme_options
* add capability options to customizer settings

= 1.8.1 - 2021.11.10 =
* fix html5 with add_theme_support
* enable custom-line-height
* fix heading styles
* change font size, improve stack and line-height
* remove hook for blank-page-without-header template
* fix block css
* change content_width
* add timeout-minutes to workflows
* fix .editorconfig

= 1.8.0 - 2021.09.17 =
* update japanese translation
* update pot
* remove list style
* fix code and kbd tags style
* fix editor style
* fix wp-block-separator and wp-block-table style
* add color palette
* add PHPUnit Polyfills library
* fix default option value
* change method name
* fix default_options

= 1.7.0 - 2021.08.16 =
* update japanese translation
* update pot
* change protected values to public values for unit test
* fix css selector
* deprecated Footer Area Column Width Ratio
* deprecated other footer widgets area
* integrate widget area into one
* add post featured image block css
* add Blank Page without header Template
* add Blank Page Template to post
* add custom archive thumbnail
* fix get_options
* fix card archive layout

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

== Upgrade Notice ==

= 2.4.2 =
* Requires at least WordPress 5.9
* Requires at least PHP 7.2

= 2.4.1 =
* Requires at least WordPress 5.2

= 2.1.1 =
* Requires at least PHP 7.1 for PHP 8

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
