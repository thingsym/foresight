<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foresight
 */
?>
<?php do_action( 'foresight/theme_hook/site/footer/before' ); ?>
<footer class="site-footer">
<div class="footer-container">
<?php do_action( 'foresight/theme_hook/site/footer' ); ?>
</div>
</footer>
<?php do_action( 'foresight/theme_hook/site/footer/after' ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
