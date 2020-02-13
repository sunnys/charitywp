<?php
/**
 * The Template for displaying all archive products.
 *
 * Override this template by copying it to yourtheme/tp-donate/templates/archive-campaign.php
 *
 * @author 		ThimPress
 * @package 	tp-donate/templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (isset($_GET['style'])){
	$_SESSION['thim_donate_layout_filter'] = $_GET['style'];
}
$layout = isset($_SESSION['thim_donate_layout_filter']) ? $_SESSION['thim_donate_layout_filter'] : 'grid';

?>

	<?php
		/**
		 * campaign_before_main_content hook
		 *
		 * @hooked campaign_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked campaign_breadcrumb - 20
		 */
		do_action( 'campaign_before_main_content' );
	?>

		<?php
			/**
			 * campaign_archive_description hook
			 *
			 * @hooked campaign_taxonomy_archive_description - 10
			 * @hooked campaign_campaign_archive_description - 10
			 */
			do_action( 'campaign_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * campaign_before_shop_loop hook
				 *
				 * @hooked campaign_result_count - 20
				 * @hooked campaign_catalog_ordering - 30
				 */
				do_action( 'campaign_before_archive_loop' );
			?>
	
			<div id="donate_main_content" class="<?php echo esc_attr($layout); ?>">

				<div class="archive-content row">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php donate_get_template_part( 'content', 'campaign' ); ?>

					<?php endwhile; // end of the loop. ?>

				</div>

			</div>
			<?php
				/**
				 * campaign_after_shop_loop hook
				 *
				 * @hooked campaign_pagination - 10
				 */
				do_action( 'campaign_after_archive_loop' );
			?>

		<?php endif; ?>

	<?php
		/**
		 * campaign_after_main_content hook
		 *
		 * @hooked campaign_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'campaign_after_main_content' );
	?>

	<?php
		/**
		 * campaign_sidebar hook
		 *
		 * @hooked campaign_get_sidebar - 10
		 */
		do_action( 'campaign_sidebar' );
	?>
