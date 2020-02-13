<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package thim
 */
if ( !function_exists( 'thim_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_paging_nav() {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );

		$query_args = array();
		$url_parts  = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $GLOBALS['wp_query']->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'charitywp' ),
			'next_text' => esc_html__( 'Next', 'charitywp' ),
			'type'      => 'list'
		) );

		if ( $links ) :
			?>
			<div class="pagination loop-pagination">
				<?php //echo '<span> Page </span>'
				?>
				<?php echo ent2ncr( $links ); ?>
			</div>
			<!-- .pagination -->
		<?php
		endif;
	}
endif;

if ( !function_exists( 'thim_post_nav' ) ) :

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function thim_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( !$next && !$previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'charitywp' ); ?></h1>

			<div class="nav-links">
				<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'charitywp' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'charitywp' ) );
				?>
			</div>
			<!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}

endif;

if ( !function_exists( 'thim_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thim_entry_meta() {
		if ( get_post_type() == 'post' ) {
			?>
			<ul class="entry-meta">

				<?php

				if ( get_theme_mod( 'show_date' ) ) {
					?>
					<li class="date">
						<span><?php echo get_the_date(); ?> </span>
					</li>
					<?php
				}

				if ( get_theme_mod( 'show_author' ) ) {
					?>
					<li class="author">
						<span><?php echo esc_html__( 'Post by ', 'charitywp' ); ?></span>
						<?php printf( ' <a href="%1$s">%2$s</a>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_html( get_the_author() )
						); ?>
					</li>
					<?php
				}

				if ( get_theme_mod( 'show_comment' ) ) {
					?>
					<?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
						?>
						<li class="comment-total">
							<?php comments_popup_link( esc_html__( '0', 'charitywp' ), esc_html__( '1', 'charitywp' ), esc_html__( '%', 'charitywp' ) ); ?>
						</li>
					<?php
					endif;
				}
				?>

			</ul>
			<?php
		}
	}
endif;


/**
 * Display category in post
 */
if ( !function_exists( 'thim_entry_meta_category' ) ) :

	function thim_entry_meta_category() {
		if ( get_theme_mod( 'show_category' ) && get_the_category() ) { ?>
			<div class="entry-meta">
				<div class="category">
					<?php
					if ( get_theme_mod( 'limit_cates' ) ) { ?>
						<?php thim_random_cats( 2, ', ' ); ?>
						<?php
					} else { ?>
						<?php the_category( ', ', '' ); ?>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
	}

endif;


if ( !function_exists( 'thim_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thim_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( 'Posted on %s', 'post date', 'charitywp' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( 'by %s', 'post author', 'charitywp' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
	}

endif;

if ( !function_exists( 'thim_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function thim_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'charitywp' ) );
			if ( $categories_list && thim_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'charitywp' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'charitywp' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'charitywp' ) . '</span>', $tags_list );
			}
		}

		if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'charitywp' ), esc_html__( '1 Comment', 'charitywp' ), esc_html__( '% Comments', 'charitywp' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'charitywp' ), '<span class="edit-link">', '</span>' );
	}

endif;

if ( !function_exists( 'thim_tags' ) ) :
	function thim_tags() {
		if ( 'post' == get_post_type() ) {
			the_tags( '<div class="tags-links"><span>Tag:</span> ', ', ', '</div>' );
		}
	}
endif;


if ( !function_exists( 'thim_the_archive_title' ) ) :

	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function thim_the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( esc_html__( '%s', 'charitywp' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( esc_html__( '%s', 'charitywp' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( esc_html__( 'Author: %s', 'charitywp' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Year: %s', 'charitywp' ), get_the_date( _x( 'Y', 'yearly archives date format', 'charitywp' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Month: %s', 'charitywp' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'charitywp' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Day: %s', 'charitywp' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'charitywp' ) ) );
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'charitywp' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'charitywp' );
		} elseif ( is_post_type_archive( 'our_team' ) ) {
			$title = esc_html__( 'All Our Team', 'charitywp' );
		} elseif ( is_post_type_archive( 'tp_event' ) ) {
			$title = esc_html__( 'All Events', 'charitywp' );
		} elseif ( is_post_type_archive( 'dn_campaign' ) ) {
			$title = esc_html__( 'All Causes', 'charitywp' );
		} elseif ( is_post_type_archive( 'portfolio' ) ) {
			$title = esc_html__( 'All Portfolio', 'charitywp' );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( 'All %s', 'charitywp' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s', 'charitywp' ), single_term_title( '', false ) );
		} elseif ( is_search() ) {
			$title = sprintf( esc_html__( 'Results for: %1$s', 'charitywp' ), get_search_query() );
		} else {
			$title = esc_html__( 'Archives', 'charitywp' );
		}
		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( !empty( $title ) ) {
			echo ent2ncr( $before . $title . $after );
		}
	}
endif;

if ( !function_exists( 'the_archive_description' ) ) :

	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( !empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo ent2ncr( $before . $description . $after );
		}
	}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function thim_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'thim_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'thim_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so thim_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so thim_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in thim_categorized_blog.
 */
function thim_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'thim_categories' );
}

add_action( 'edit_category', 'thim_category_transient_flusher' );
add_action( 'save_post', 'thim_category_transient_flusher' );


if ( !function_exists( 'thim_post_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thim_post_meta( $show ) {
		if ( get_post_type() == 'post' || get_post_type() == 'portfolio' ) {
			?>
			<ul class="entry-meta">

				<?php

				if ( get_theme_mod( 'single_show_date' ) && $show['date'] == true ) {
					?>
					<li class="date">
						<span><?php echo get_the_date(); ?> </span>
					</li>
					<?php
				}

				if ( get_theme_mod( 'single_show_author' ) && $show['author'] == true ) {
					?>
					<li class="author">
						<?php printf( ' <a href="%1$s">%2$s</a>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_html( get_the_author() )
						); ?>
					</li>
					<?php
				}

				if ( get_theme_mod( 'single_show_category' ) && $show['category'] == true ) {
					?>
					<li class="categories">
						<?php
						if ( get_post_type() == 'post' ) {
							$categories_list = get_the_category_list( esc_html__( ', ', 'charitywp' ) );
							if ( $categories_list && thim_categorized_blog() ) {
								printf( '<span class="cat-links">' . esc_html__( '%1$s', 'charitywp' ) . '</span>', $categories_list );
							}
						} else {
							$taxonomy = 'portfolio_category';
							$terms    = get_the_terms( get_the_ID(), $taxonomy ); // Get all terms of a taxonomy
							if ( $terms && !is_wp_error( $terms ) ) {
								printf( '<a href="' . esc_url( get_term_link( $terms[0]->slug, $taxonomy ) ) . '"><span class="cat-links">' . esc_html__( '%1$s', 'charitywp' ) . '</span></a>', $terms[0]->name );
							} else {
								printf( '<span class="cat-links">' . esc_html__( '%1$s', 'charitywp' ) . '</span>', 'Uncategorized' );
							}
						}
						?>
					</li>
					<?php
				}

				if ( get_theme_mod( 'single_show_comment' ) && $show['comment'] == true ) {
					?>
					<?php if ( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
						?>
						<li class="comment-total">
							<?php comments_popup_link( esc_html__( '0 Comment', 'charitywp' ), esc_html__( '1 Comment', 'charitywp' ), esc_html__( '% Comments', 'charitywp' ) ); ?>
						</li>
					<?php
					endif;
				}

				?>

			</ul>
			<?php
		}
	}
endif;


/**
 * Show related posts
 */
if ( !function_exists( 'thim_related_post' ) ) :

	function thim_related_post() {
		global $post;
		$column = 3;
		$column = get_theme_mod( 'single_related_column' );
		$number = get_theme_mod( 'single_related_number' );
		$col    = 'col-xs-' . 12 / $column;
		$show   = get_theme_mod( 'single_related_show' );
		$tags   = wp_get_post_tags( $post->ID );
		if ( $show && $tags ) {
			$first_tag = $tags[0]->term_id;
			$args      = array(
				'tag__in'             => array( $first_tag ),
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => $number,
				'ignore_sticky_posts' => 1
			);
			$related   = new WP_Query( $args );
			if ( $related->have_posts() ) {
				?>
				<div class="thim-related-posts">
					<div class="inner-list">
						<h3 class="widget-title"><?php esc_html_e( 'Your might also like', 'charitywp' ); ?></h3>
						<div class="list-posts">
							<div class="row">
								<?php
								while ( $related->have_posts() ) : $related->the_post();
									?>
									<div <?php post_class( $col ); ?>>
										<div class="article-title-wrapper">
											<div class="article-inner">
												<div class="media">
													<?php thim_thumbnail( get_the_ID(), '270x200', 'post', true ); ?>
												</div>

												<div class="content">
													<ul class="entry-meta">
														<li class="date"><?php echo get_the_date() ?></li>
													</ul>
													<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="article-title"><?php echo esc_attr( get_the_title() ) ?></a>
												</div>
											</div>
										</div>
									</div>
								<?php
								endwhile;
								?>
							</div>
							<!-- Row -->
						</div>
						<!-- List-post -->
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
	}

endif;

function thim_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
	$id     = get_the_ID();
	$title  = get_the_title();
	$number = get_comments_number( $id );

	if ( false === $zero ) {
		/* translators: %s: post title */
		$zero = sprintf( __( 'No Comments<span class="screen-reader-text"> on %s</span>' ), $title );
	}

	if ( false === $one ) {
		/* translators: %s: post title */
		$one = sprintf( __( '1 Comment<span class="screen-reader-text"> on %s</span>' ), $title );
	}

	if ( false === $more ) {
		/* translators: 1: Number of comments 2: post title */
		$more = _n( '%1$s Comment<span class="screen-reader-text"> on %2$s</span>', '%1$s Comments<span class="screen-reader-text"> on %2$s</span>', $number );
		$more = sprintf( $more, number_format_i18n( $number ), $title );
	}

	if ( false === $none ) {
		/* translators: %s: post title */
		$none = sprintf( __( 'Comments Off<span class="screen-reader-text"> on %s</span>' ), $title );
	}

	if ( 0 == $number && !comments_open() && !pings_open() ) {
		echo '<span' . ( ( !empty( $css_class ) ) ? ' class="' . esc_attr( $css_class ) . '"' : '' ) . '>' . $none . '</span>';

		return;
	}

	if ( post_password_required() ) {
		_e( 'Enter your password to view comments.' );

		return;
	}

	echo '<a href="';
	if ( 0 == $number ) {
		$respond_link = get_permalink() . '#comments';
		/**
		 * Filters the respond link when a post has no comments.
		 *
		 * @since 4.4.0
		 *
		 * @param string  $respond_link The default response link.
		 * @param integer $id           The post ID.
		 */
		echo apply_filters( 'respond_link', $respond_link, $id );
	} else {
		comments_link();
	}
	echo '"';

	if ( !empty( $css_class ) ) {
		echo ' class="' . $css_class . '" ';
	}

	$attributes = '';
	/**
	 * Filters the comments link attributes for display.
	 *
	 * @since 2.5.0
	 *
	 * @param string $attributes The comments link attributes. Default empty.
	 */
	echo apply_filters( 'comments_popup_link_attributes', $attributes );

	echo '>';
	comments_number( $zero, $one, $more );
	echo '</a>';
}