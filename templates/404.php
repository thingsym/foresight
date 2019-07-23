<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ace
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
else {
	do_action( 'wp_body_open' );
}
?>
<div class="container">
<?php do_action( 'ace/theme_hook/site/header/before' ); ?>
<header class="site-header">
<?php do_action( 'ace/theme_hook/site/header' ); ?>
</header>
<?php do_action( 'ace/theme_hook/site/header/after' ); ?>

<?php do_action( 'ace/theme_hook/site/content/before' ); ?>
<div class="site-content">
<div class="primary">
<div class="content-container">
<?php
do_action( 'ace/theme_hook/content/prepend' );
get_template_part( 'templates/content/404' );
do_action( 'ace/theme_hook/content/append' );
?>
</div>
</div>
</div>
<?php do_action( 'ace/theme_hook/site/content/after' ); ?>

<?php do_action( 'ace/theme_hook/site/footer/before' ); ?>
<footer class="site-footer">
<?php do_action( 'ace/theme_hook/site/footer' ); ?>
</footer>
<?php do_action( 'ace/theme_hook/site/footer/after' ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
