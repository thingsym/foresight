<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
<?php do_action( 'ace/theme_hook/body/prepend' ); ?>
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
if ( have_posts() ) {
	do_action( 'ace/theme_hook/content/archive/prepend' );
	while ( have_posts() ) :
		the_post();
		/**
		 * Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-search.php and that will be used instead.
		 */
		get_template_part( 'templates/content/search' );
	endwhile;
	do_action( 'ace/theme_hook/content/archive/append' );
}
else {
	get_template_part( 'templates/content/not-found' );
}
do_action( 'ace/theme_hook/content/append' );
?>
</div>
</div>
<?php get_template_part( 'templates/sidebar/sidebar' ); ?>
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
