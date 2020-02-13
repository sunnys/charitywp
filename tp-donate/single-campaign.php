<?php
/**
 * Template Single dn_campaign post type
 */
?>

	<?php
		/**
		 * donate_before_main_content hook
		 */
		do_action( 'donate_before_main_content' );
	?>

		<div id="donate_main_content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php donate_get_template_part( 'content', 'single-campaign' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</div>

	<?php
		/**
		 * hotel_booking_after_main_content hook
		 *
		 * @hooked donate_after_main_content - 10 (outputs closing divs for the content)
		 */
		do_action( 'donate_after_main_content' );
	?>