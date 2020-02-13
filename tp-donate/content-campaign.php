<?php 
/**
 * The Template for displaying all archive products.
 *
 * Override this template by copying it to yourtheme/tp-donate/templates/content-campaign.php
 *
 * @author 		ThimPress
 * @package 	tp-donate/templates
 * @version     1.0
 */

	$col = 'col-xs-6 col-md-'. (12 / (int)DN_Settings::instance()->donate->get( 'archive_column', '4' ) );

?>

<article id="campaign-<?php the_ID(); ?>" <?php post_class($col); ?>>

	<div class="content-inner">

		<div class="entry-thumbnail">

			<?php

				/**
				 * donate_loop_campaign_thumbnail hook
				 * <!-- Thumbnail Campaign -->
				 */
				do_action( 'donate_loop_campaign_thumbnail' );
			?>

		</div>

		<div class="event-content">
			<div class="dn-content-inner">
				<?php
					/**
					 * donate_loop_campaign_title hook
					 * <!-- Title Campaign -->
					 */
					do_action( 'donate_loop_campaign_title' );

					/**
					 * donate_loop_campaign_countdown
					 * <!-- Description Campaign -->
					 */
					do_action( 'donate_loop_campaign_excerpt' );
				?>
			</div>
			<div class="dn-content-countdown-box">
				<?php
					/**
					 * donate_loop_campaign_countdown
					 * <!-- Countdown Campaign -->
					 */
					do_action( 'donate_loop_campaign_countdown' );

					/**
					 * donate_loop_campaign_goal_raised hook
					 * <!-- Goal and Raised Campaign -->
					 */
					do_action( 'donate_loop_campaign_goal_raised' );
				?>
				<a href="#" class="donate_load_form thim-button style3" data-campaign-id="<?php echo esc_attr( get_the_ID() ) ?>"><?php esc_html_e( 'DONATE NOW', 'charitywp' ); ?></a>
			</div>
			<?php
				/**
				 * donate_loop_campaign_posted hook
				 * <!-- Posted Campaign -->
				 */
				do_action( 'donate_loop_campaign_posted' );
			?>

		</div>

	</div>

</article>
