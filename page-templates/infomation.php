<?php
/**
 * Template Name: Information
 *
 **/
get_header();?>
	<div class="home-page container site-content">
		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>
	</div><!-- #main-content -->
<?php get_footer();
