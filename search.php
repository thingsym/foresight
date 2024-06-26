<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Foresight
 */

?>
<?php get_header(); ?>

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
<div class="main-container" id="main-container">
<?php
do_action( 'foresight/theme_hook/content/prepend' );
if ( have_posts() ) {
	$archive_layout = 'article-all';
	if ( class_exists( 'Foresight\Functions\Layout\Layout' ) ) {
		global $foresight_fn_layout;
		if ( method_exists( $foresight_fn_layout, 'get_archive_layout' ) ) {
			$archive_layout = $foresight_fn_layout->get_archive_layout();
		}
	}

	do_action( 'foresight/theme_hook/content/search/prepend' );
	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/content/search' );
	endwhile;
	do_action( 'foresight/theme_hook/content/search/append' );
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

<?php get_footer(); ?>
