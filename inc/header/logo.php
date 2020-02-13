<?php
add_action( 'thim_logo', 'thim_logo', 1 );
if ( ! function_exists( 'thim_logo' ) ) :
	function thim_logo() {
		$thim_logo_src        = get_template_directory_uri( 'template_directory' ) . "/assets/images/logo_white.png";
		$thim_sticky_logo_src = get_template_directory_uri( 'template_directory' ) . "/assets/images/logo.png";
		$thim_mobile_logo_src = get_template_directory_uri( 'template_directory' ) . "/assets/images/logo.png";
		if ( get_theme_mod( 'logo' ) ) {
			$thim_logo_src = get_theme_mod( 'logo' );
			if ( is_numeric( $thim_logo_src ) ) {
				$logo_attachment = wp_get_attachment_image_src( $thim_logo_src, 'full' );
				$thim_logo_src   = $logo_attachment[0];
			}
		}
		if ( get_theme_mod( 'sticky_logo' ) ) {
			$thim_sticky_logo_src = get_theme_mod( 'sticky_logo' );
			if ( is_numeric( $thim_sticky_logo_src ) ) {
				$logo_attachment      = wp_get_attachment_image_src( $thim_sticky_logo_src, 'full' );
				$thim_sticky_logo_src = $logo_attachment[0];
			}
		}
		if ( get_theme_mod( 'mobile_logo' ) ) {
			$thim_mobile_logo_src = get_theme_mod( 'mobile_logo' );
			if ( is_numeric( $thim_mobile_logo_src ) ) {
				$logo_attachment      = wp_get_attachment_image_src( $thim_mobile_logo_src, 'full' );
				$thim_mobile_logo_src = $logo_attachment[0];
			}
		}
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
		echo '<img class="logo" src="' . esc_url( $thim_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
		echo '<img class="sticky-logo" src="' . esc_url( $thim_sticky_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
		echo '<img class="mobile-logo" src="' . esc_url( $thim_mobile_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
		echo '</a>';
	}
endif;


add_action( 'thim_logo_mobile', 'thim_logo_mobile', 1 );
if ( ! function_exists( 'thim_logo_mobile' ) ) :
	function thim_logo_mobile() {
		$thim_mobile_logo_src = get_template_directory_uri( 'template_directory' ) . "/assets/images/logo.png";

		if ( get_theme_mod( 'mobile_logo' ) ) {
			$thim_mobile_logo_src = get_theme_mod( 'mobile_logo' );
			if ( is_numeric( $thim_mobile_logo_src ) ) {
				$logo_attachment      = wp_get_attachment_image_src( $thim_mobile_logo_src, 'full' );
				$thim_mobile_logo_src = $logo_attachment[0];
			}
		}
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
		echo '<img class="mobile-logo" src="' . esc_url( $thim_mobile_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
		echo '</a>';
	}
endif;
