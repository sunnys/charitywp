<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

do_action( 'woocommerce_before_main_content' );
?>

<?php if ( have_posts() ) { ?>

	<?php
	$terms        = get_terms( 'product_cat' );
	$current_term = get_queried_object();
	if ( ! empty( $terms ) ) {
		$all_link = get_post_type_archive_link( 'product' );
		echo '<div class="list-product-cat"><ul class="product-cat">';
		if ( ! empty( $all_link ) ) {
			echo '<li><a href="', $all_link, '"', ( ! isset( $current_term->term_id ) ) ? ' class="active"' : ' class="inactive"', '>', esc_html__( 'All', 'charitywp' ), '</a></li>';
		}
		foreach ( $terms as $key => $term ) {
			$link = get_term_link( $term, 'product_cat' );
			if ( ! is_wp_error( $link ) ) {
				$class_string = "";
				if ( ! empty( $current_term->name ) && $current_term->name === $term->name ) {
					$class_string = ' class="active"';
				} else {
					$class_string = ' class="inactive"';
				}
				echo '<li><a href="', $link, '"', $class_string, '>', $term->name, '</a></li>';
			}
		}
		echo '</ul></div>';
	}
	?>

	<?php woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end(); ?>

	<?php
	/**
	 * woocommerce_after_shop_loop hook
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	?>

<?php } elseif ( ! woocommerce_product_subcategories( array(
	'before' => woocommerce_product_loop_start( false ),
	'after'  => woocommerce_product_loop_end( false )
) ) ) { ?>

	<?php
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
	?>

<?php } ?>

<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>