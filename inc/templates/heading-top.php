<?php
global $wp_query;
/***********custom Top Images*************/
$text_color = $custom_title = $subtitle = $bg_color = $bg_header = $class_full = $text_color_header =
$bg_image = $thim_custom_heading = $cate_top_image_src = $front_title = '';

$hide_breadcrumbs = $hide_title = 0;
// color theme options
$cat_obj = $wp_query->get_queried_object();

if ( isset( $cat_obj->term_id ) ) {
	$cat_ID = $cat_obj->term_id;
} else {
	$cat_ID = "";
}

// get data for theme customizer
if ( get_post_type() == 'portfolio' ) {
	$thim_heading_top_img = get_theme_mod( 'portfolio_top_image' );
} elseif ( get_post_type() == 'tp_event' ) {
	$thim_heading_top_img = get_theme_mod( 'event_top_image' );
} elseif ( is_post_type_archive( 'product' ) ) {
	$thim_heading_top_img = get_theme_mod( 'woo_archive_top_image' );
} elseif ( ( get_post_type() == 'product' ) && is_single() ) {
	$thim_heading_top_img = get_theme_mod( 'woo_single_top_image' );
} elseif ( get_post_type() == 'dn_campaign' ) {
	$thim_heading_top_img = get_theme_mod( 'donate_top_image' );
} elseif ( get_post_type() == 'our_team' ) {
	$thim_heading_top_img = get_theme_mod( 'our_team_top_image' );
} elseif ( is_category() ) {
	$thim_heading_top_img = get_theme_mod( 'archive_top_image' );
} elseif ( ( get_post_type() == 'post' ) && is_single() ) {
	$thim_heading_top_img = get_theme_mod( 'single_top_image' );
} else {
	if ( is_front_page() || is_home() ) {
		$thim_heading_top_img = get_theme_mod( 'front_page_top_image' );
	} elseif ( is_page() ) {
		$thim_heading_top_img = get_theme_mod( 'page_top_image' );
	} elseif ( is_404() ) {
		$thim_heading_top_img = get_theme_mod( '404_top_image' );
	} else {
		$thim_heading_top_img = THIM_URI . 'assets/images/page_top_image.jpg';
	}
}

if ( is_numeric( $thim_heading_top_img ) ) {
	$cate_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
	$cate_top_image_src  = $cate_top_attachment[0];
} else {
	$cate_top_image_src = $thim_heading_top_img;
}

// Get style blog && shop from metabox
if ( is_front_page() || is_home() ) {

	if ( is_front_page() || is_home() ) {
		$postid = get_option( 'page_for_posts' );
	} elseif ( is_post_type_archive( 'product' ) ) {
		$postid = get_option( 'woocommerce_shop_page_id' );
	}

	$using_custom_heading = get_post_meta( $postid, 'thim_mtb_using_custom_heading', true );

	if ( $using_custom_heading ) {

		if ( get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true ) ) {
			$hide_title = get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true );
		}
		if ( get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true ) ) {
			$hide_breadcrumb = get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true );
		}
		if ( get_post_meta( $postid, 'thim_mtb_custom_title', true ) ) {
			$custom_title = get_post_meta( $postid, 'thim_mtb_custom_title', true );
		}
		if ( get_post_meta( $postid, 'thim_subtitle', true ) ) {
			$subtitle = get_post_meta( $postid, 'thim_subtitle', true );
		}
		if ( get_post_meta( $postid, 'thim_mtb_text_color', true ) ) {
			$text_color_1 = get_post_meta( $postid, 'thim_mtb_text_color', true );
			if ( $text_color_1 <> '' ) {
				$text_color = $text_color_1;
			}
		}
		if ( get_post_meta( $postid, 'thim_mtb_color_sub_title', true ) ) {
			$sub_color_1 = get_post_meta( $postid, 'thim_mtb_color_sub_title', true );
			if ( $sub_color_1 <> '' ) {
				$sub_color = $sub_color_1;
			}
		}
		$bg_color_1 = '';
		if ( get_post_meta( $postid, 'thim_mtb_bg_color', true ) ) {
			$bg_color_1 = get_post_meta( $postid, 'thim_mtb_bg_color', true );
		}
		if ( $bg_color_1 <> '' ) {
			$bg_color = $bg_color_1;
		}
		if ( get_post_meta( $postid, 'thim_mtb_top_image', true ) ) {
			$thim_heading_top_img = get_post_meta( $postid, 'thim_mtb_top_image', true );
			$thim_heading_top_src = $thim_heading_top_img;

			if ( is_numeric( $thim_heading_top_src ) ) {
				$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
				$cate_top_image_src          = $thim_heading_top_attachment[0];
			}
		}
	}
}

// Get style from metabox
if ( is_page() || is_single() ) {
	$postid               = get_the_ID();
	$using_custom_heading = get_post_meta( $postid, 'thim_mtb_using_custom_heading', true );

	if ( $using_custom_heading ) {

		if ( get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true ) ) {
			$hide_title = get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true );
		}
		if ( get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true ) ) {
			$hide_breadcrumb = get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true );
		}
		if ( get_post_meta( $postid, 'thim_mtb_custom_title', true ) ) {
			$custom_title = get_post_meta( $postid, 'thim_mtb_custom_title', true );
		}
		if ( get_post_meta( $postid, 'thim_subtitle', true ) ) {
			$subtitle = get_post_meta( $postid, 'thim_subtitle', true );
		}
		if ( get_post_meta( $postid, 'thim_mtb_text_color', true ) ) {
			$text_color_1 = get_post_meta( $postid, 'thim_mtb_text_color', true );
			if ( $text_color_1 <> '' ) {
				$text_color = $text_color_1;
			}
		}
		if ( get_post_meta( $postid, 'thim_mtb_color_sub_title', true ) ) {
			$sub_color_1 = get_post_meta( $postid, 'thim_mtb_color_sub_title', true );
			if ( $sub_color_1 <> '' ) {
				$sub_color = $sub_color_1;
			}
		}
		$bg_color_1 = '';
		if ( get_post_meta( $postid, 'thim_mtb_bg_color', true ) ) {
			$bg_color_1 = get_post_meta( $postid, 'thim_mtb_bg_color', true );
		}
		if ( $bg_color_1 <> '' ) {
			$bg_color = $bg_color_1;
		}
		if ( get_post_meta( $postid, 'thim_mtb_top_image', true ) ) {
			$thim_heading_top_img = get_post_meta( $postid, 'thim_mtb_top_image', true );
			$thim_heading_top_src = $thim_heading_top_img;

			if ( is_numeric( $thim_heading_top_src ) ) {
				$thim_heading_top_attachment = wp_get_attachment_image_src( $thim_heading_top_img, 'full' );
				$cate_top_image_src          = $thim_heading_top_attachment[0];
			}
		}
	}
}


$hide_title = ( $hide_title === 'on' ) ? '1' : $hide_title;
// css
$c_css_style = $css_line = '';
$c_css_style .= ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
$c_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
$css_line    .= ( $text_color != '' ) ? 'background-color: ' . $text_color . ';' : '';

//css background and color
$c_css = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';

$c_css_1 = ( $bg_color != '' ) ? 'style="background-color:' . $bg_color . '"' : '';

if ( ! thim_plugin_active( 'thim-core' ) ) {
	$cate_top_image_src = get_template_directory_uri( 'template_directory' ) . "/assets/images/page_top_image.jpg";
}

if ( $cate_top_image_src != '' ) {
	$c_css .= 'style="background-image: url(' . $cate_top_image_src . ')"';
}

// css inline line
$c_css_line = ( $css_line != '' ) ? 'style="' . $css_line . '"' : '';

?>
<?php if ( $hide_title != '1' ) { ?>
	<div class="top_site_main<?php if ( $cate_top_image_src == '' ) {
		echo ' top-site-no-image';
	} else {
		echo ' thim-parallax-image';
	} ?>" <?php echo ent2ncr( $c_css ); ?> data-stellar-background-ratio="0.5">
		<span class="overlay-top-header"></span>
		<div class="page-title-wrapper">
			<div class="banner-wrapper container article_heading">
				<div class="row">
					<div class="col-xs-6">
						<?php
						$typography = 'h1';
						if ( ( is_page() || is_single() ) && get_post_type() != 'product' ) {
							if ( is_single() ) {
								$single_title = get_the_title( get_the_ID() );
								switch ( get_post_type() ) {
									case 'portfolio':
										$single_title = esc_html__( 'Project Detail', 'charitywp' );
										break;
									case 'dn_campaign':
										$single_title = esc_html__( 'Cause Detail', 'charitywp' );
										break;
									default:
										# code...
										break;
								}
								echo '<' . $typography . ' class="heading__primary">';
								echo ( $custom_title != '' ) ? $custom_title : $single_title;
								echo '</' . $typography . '>';
								echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__secondary">' . $subtitle . '</p></div>' : '';
							} else {
								echo '<' . $typography . ' class="heading__primary">';
								echo ( $custom_title != '' ) ? $custom_title : get_the_title( get_the_ID() );
								echo '</' . $typography . '>';
								echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__secondary">' . $subtitle . '</p></div>' : '';
							}
						} elseif ( get_post_type() == 'product' ) {
							echo '<' . $typography . ' class="heading__primary">' . esc_html__( 'Shop', 'charitywp' ) . '</' . $typography . '>';
						} elseif ( is_front_page() || is_home() ) {
							if ( get_theme_mod( 'custom_title' ) ) {
								$custom_title = get_theme_mod( 'custom_title' );
							}
							echo '<' . $typography . ' class="heading__primary">';
							echo ( $custom_title != '' ) ? $custom_title : esc_html__( 'Blog', 'charitywp' );
							echo '</' . $typography . '>';
							echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__secondary">' . $subtitle . '</p></div>' : '';
						} elseif ( is_404() ) {
							echo '<' . $typography . ' class="heading__primary">';
							echo ( $custom_title != '' ) ? $custom_title : esc_html__( '404 Error', 'charitywp' );
							echo '</' . $typography . '>';
							echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__secondary">' . $subtitle . '</p></div>' : '';
						} else {
							echo '<' . $typography . ' class="heading__primary">';
							echo ( $custom_title != '' ) ? $custom_title : thim_the_archive_title();
							echo '</' . $typography . '>';
							echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__secondary">' . $subtitle . '</p></div>' : '';
						}
						?>
					</div>
					<div class="col-xs-6">
						<?php
						thim_breadcrumbs();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Display sidebar -->
	<?php if ( is_active_sidebar( 'after_heading' ) && ! is_single() ) { ?>
		<div class="after-heading-sidebar thim-animated" data-animate="fadeInUp">
			<?php dynamic_sidebar( 'after_heading' ); ?>
		</div>  <!--slider_sidebar-->
	<?php } else { ?>
		<div class="not-heading-sidebar"></div>
	<?php } ?>


<?php } ?>


<?php if ( $cate_top_image_src != '' && $hide_title == '1' && $c_css_1 != '' ) { ?>
	<div class="top_site_main<?php if ( $cate_top_image_src == '' ) {
		echo ' top-site-no-image-custom';
	} ?>" <?php echo ent2ncr( $c_css_1 ); ?>>
	</div>
<?php } ?>