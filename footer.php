<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package thim
 */
?>
<?php if ( !(is_page() && basename(get_page_template()) == 'comingsoon.php') ) : ?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<?php if ( is_active_sidebar( 'footer' ) ) : ?>
			<?php dynamic_sidebar( 'footer' ); ?>
		<?php endif; ?>
	</div>
</footer><!-- #colophon -->

<?php thim_back_to_top() ?>

</div><!--end main-content-->

<div id="footer-bottom">
	<div class="container">
		<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
			<?php dynamic_sidebar( 'footer-bottom' ); ?>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>


</div>
</div><!-- .wrapper-container -->

<?php wp_footer(); ?>
</body>
</html>

