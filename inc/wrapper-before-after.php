<?php
if ( ! function_exists( 'thim_wrapper_layout' ) ) :
	function thim_wrapper_layout() {
		global $wp_query;
		$using_custom_layout = $wrapper_layout = $cat_ID = '';
		$wrapper_class_col   = 'col-sm-9 alignright';
		switch ( get_post_type() ) {
			case 'product':
				if ( is_single() ) {
					$prefix = 'woo_single';
				} else {
					$prefix = 'woo_archive';
				}
				break;
			case 'our_team':
				$prefix = 'our_team';
				break;

			case 'tp_event':
				$prefix = 'event';
				break;

			case 'dn_campaign':
				$prefix = 'donate';
				break;

			case 'portfolio':
				if ( is_single() ) {
					$prefix = 'portfolio_single';
				} else {
					$prefix = 'portfolio';
				}
				break;

			default:
				if ( is_front_page() || is_home() ) {
					$prefix = 'front_page';
				} else if ( is_single() ) {
					$prefix = 'blog_single';
				} else if ( is_page() ) {
					$prefix = 'page';
				} else {
					$prefix = 'blog_archive';
				}
				break;
		}


		// get id category
		$cat_obj = $wp_query->get_queried_object();
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}

		$layout_get = isset( $_GET['layout'] ) ? $_GET['layout'] : false;
		// get layout
		if ( is_page() || is_single() || is_front_page() || is_home() ) {
			$postid = get_the_ID();
			/***********custom layout*************/
			$using_custom_layout = get_post_meta( $postid, 'thim_mtb_custom_layout', true );
			if ( $using_custom_layout == 1 ) {
				$wrapper_layout = get_post_meta( $postid, 'thim_mtb_layout', true );
			} else {
				if ( get_theme_mod( $prefix . '_layout' ) ) {
					$wrapper_layout = get_theme_mod( $prefix . '_layout' );
				}
			}
		} else {
			/***********custom layout*************/
			$using_custom_layout = get_tax_meta( $cat_ID, 'thim_mtb_custom_layout', true );
			if ( $using_custom_layout == 1 ) {
				$wrapper_layout = get_tax_meta( $cat_ID, 'thim_mtb_layout', true );
			} else {
				if ( get_theme_mod( $prefix . '_layout' ) ) {
					$wrapper_layout = get_theme_mod( $prefix . '_layout' );
				}
			}
		}

		if ( $layout_get ) {
			$wrapper_layout = $layout_get;
		}

		if ( $wrapper_layout == 'full-content' ) {
			$wrapper_class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$wrapper_class_col = "col-sm-9 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$wrapper_class_col = 'col-sm-9 alignright';
		}

		return $wrapper_class_col;
	}
endif;

add_action( 'thim_wrapper_loop_start', 'thim_wrapper_loop_start' );
if ( ! function_exists( 'thim_wrapper_loop_start' ) ) :
	function thim_wrapper_loop_start() {
		$class_no_padding = '';
		if ( is_page() || is_single() ) {
			$mtb_no_padding = get_post_meta( get_the_ID(), 'thim_mtb_no_padding', true );
			if ( $mtb_no_padding ) {
				$class_no_padding = 'no-padding';
			}
		}
		$wrapper_class_col = thim_wrapper_layout();

		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
			get_template_part( '/inc/templates/heading', 'top' );
		}
		echo '<div class="container site-content"><div class="row"><main id="main" class="site-main ' . $wrapper_class_col . ' ' . $class_no_padding . '">';
	}
endif;

//
add_action( 'thim_wrapper_loop_end', 'thim_wrapper_loop_end' );

if ( ! function_exists( 'thim_wrapper_loop_end' ) ) :
	function thim_wrapper_loop_end() {
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '</main>';
		if ( $wrapper_class_col != 'col-sm-12 full-width' ) {
			if ( get_post_type() == "product" ) {
				do_action( 'woocommerce_sidebar' );
			} else {
				get_sidebar();
			}
		}
		echo '</div></div>';
	}
endif;