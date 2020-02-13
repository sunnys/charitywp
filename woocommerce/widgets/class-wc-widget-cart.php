<?php
/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author        WooThemes
 * @category      Widgets
 * @package       WooCommerce/Widgets
 * @version       2.0.0
 * @extends       WP_Widget
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Thim_Custom_WC_Widget_Cart extends WC_Widget_Cart {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;
  	function widget( $args, $instance ) {
		extract( $args );

		if ( is_cart() || is_checkout() ) {
			return;
		}
		echo ent2ncr($before_widget);
		$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
		echo '<div class="minicart_hover" id="header-mini-cart">';
		list( $cart_items ) = thim_get_current_cart_info();
		echo '<span class="cart-items-number"><i class="fa fa-fw fa-shopping-cart"></i><span class="wrapper-items-number"><span class="items-number">' . $cart_items . '</span></span></span>';

		echo '<div class="clear"></div>';
		echo '</div>';
		if ( $hide_if_empty ) {
			echo '<div class="hide_cart_widget_if_empty">';
		}
		// Insert cart widget placeholder - code in woocommerce.js will update this on page load
		echo '<div class="widget_shopping_cart_content" style="display: none;"></div>';
		if ( $hide_if_empty ) {
			echo '</div>';
		}
 		echo ent2ncr($after_widget);
	}

}