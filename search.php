<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Foresight
 */

?>
<?php get_header() ?>

<div class="container">
<?php do_action( 'foresight/theme_hook/site/header/before' ); ?>
<header class="site-header">
<div class="header-container">
<?php do_action( 'foresight/theme_hook/site/header' ); ?>
</div>
</header>
<?php do_action( 'foresight/theme_hook/site/header/after' ); ?>

<?php do_action( 'foresight/theme_hook/site/content/before' ); ?>
<div class="site-content">
<main class="primary">
<div class="main-container">
<?php
do_action( 'foresight/theme_hook/content/prepend' );
if ( have_posts() ) {
	do_action( 'foresight/theme_hook/content/archive/prepend' );
	while ( have_posts() ) :
		the_post();
		/**
		 * Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-search.php and that will be used instead.
		 */
		get_template_part( 'templates/content/search' );
	endwhile;
	do_action( 'foresight/theme_hook/content/archive/append' );
}
else {
	get_template_part( 'templates/content/not-found' );
}
do_action( 'foresight/theme_hook/content/append' );
?>
</div>
</main>
</div>
<?php do_action( 'foresight/theme_hook/site/content/after' ); ?>

<?php get_footer() ?>
