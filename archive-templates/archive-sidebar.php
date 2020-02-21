<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
<div class="main-container"<?php global $foresight_fn_layout; $foresight_fn_layout->data_attr_archive_layout(); ?> id="main-container">
<?php
do_action( 'foresight/theme_hook/content/prepend' );
if ( have_posts() ) {
	do_action( 'foresight/theme_hook/content/archive/prepend' );

	$archive_layout = 'article-all';
	if ( class_exists( 'Foresight\Functions\Layout\Layout' ) ) {
		global $foresight_fn_layout;
		if ( method_exists( $foresight_fn_layout, 'get_archive_layout' ) ) {
			$archive_layout = $foresight_fn_layout->get_archive_layout();
		}
	}

	while ( have_posts() ) :
		the_post();
		get_template_part( 'templates/archive/' . $archive_layout );
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
<?php get_template_part( 'templates/sidebar/sidebar-post' ); ?>
</div>
<?php do_action( 'foresight/theme_hook/site/content/after' ); ?>

<?php get_footer() ?>
