<?php
/**
 * Template Name: Blank Page without header Template
 * Template Post Type: page
 *
 * The page template
 *
 * @package Foresight
 */

?>
<?php get_header(); ?>

<div class="container">
<div class="site-content">
<main class="primary">
<div class="main-container" id="main-container">
<?php
global $posttype;
$posttype = get_post_type();
if ( in_array( $posttype, [ 'post' ], true ) ) {
	$posttype = 'single';
}

while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content/blank', $posttype );
	do_action( 'foresight/theme_hook/content/' . $posttype . '/append' );
endwhile;
do_action( 'foresight/theme_hook/content/append' );
?>
</div>
</main>
</div>
<?php do_action( 'foresight/theme_hook/site/content/after' ); ?>

<?php get_footer(); ?>
