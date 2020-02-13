<?php
/**
 * Template Name: Home Page Wide
 *
 **/
get_header();?>
	<div class="home-page site-content">
		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>
	</div><!-- #main-content -->
<?php get_footer();
