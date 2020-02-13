<?php
get_header();

$regency = get_post_meta( get_the_ID(), 'regency', true );
if ( $regency != '' ) {
	$regency = '<div class="regency">' . $regency . '</div>';
}
$face_url = get_post_meta( get_the_ID(), 'face_url', true );
if ( $face_url != '' ) {
	$face_url = '<li><a href="' . esc_url( $face_url ) . '"><i class="fa fa-facebook"></i></a></li>';
}
$twitter_url = get_post_meta( get_the_ID(), 'twitter_url', true );
if ( $twitter_url != '' ) {
	$twitter_url = '<li><a href="' . esc_url( $twitter_url ) . '"><i class="fa fa-twitter"></i></a></li>';
}
$rss_url = get_post_meta( get_the_ID(), 'rss_url', true );
if ( $rss_url != '' ) {
	$rss_url = '<li><a href="' . esc_url( $rss_url ) . '"><i class="fa fa-rss"></i></a></li>';
}
$skype_url = get_post_meta( get_the_ID(), 'skype_url', true );
if ( $skype_url != '' ) {
	$skype_url = '<li><a href="' . esc_url( $skype_url ) . '"><i class="fa fa-skype"></i></a></li>';
}
$dribbble_url = get_post_meta( get_the_ID(), 'dribbble_url', true );
if ( $dribbble_url != '' ) {
	$dribbble_url = '<li><a href="' . esc_url( $dribbble_url ) . '"><i class="fa fa-dribbble"></i></a></li>';
}
$linkedin_url = get_post_meta( get_the_ID(), 'linkedin_url', true );
if ( $linkedin_url != '' ) {
	$linkedin_url = '<li><a href="' . esc_url( $linkedin_url ) . '"><i class="fa fa-linkedin"></i></a></li>';
}
$our_team_phone = get_post_meta( get_the_ID(), 'our_team_phone', true );
if ( $our_team_phone != '' ) {
	$our_team_phone = '<li class="phone"><i class="fa fa-phone"></i> <a href="tel:' . $our_team_phone . '">' . $our_team_phone . '</a></li>';
}
$our_team_email = get_post_meta( get_the_ID(), 'our_team_email', true );
if ( $our_team_email != '' ) {
	$our_team_email = '<li class="email"><i class="fa fa-envelope"></i> <a href="mailto:' . $our_team_email . '">' . $our_team_email . '</a></li>';
}
?>

<?php while ( have_posts() ) : the_post(); ?>
	<section class="content-area">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="content-inner row">

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="avatar col-md-3 col-xs-12">
						<div class="inner-avatar">
							<!--						--><?php //echo thim_feature_image( 200, 200 , false); ?>
							<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="entry-content col-md-6 col-xs-12">
					<div class="info">
						<?php the_title( '<div class="blog_title">', '</div>' ); ?>
						<?php echo ent2ncr( $regency ); ?>
					</div>
					<div class="detail">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="entry-meta col-md-3 col-xs-12">
					<ul class="meta-list">
						<?php
						$html = '';
						$html .= $our_team_email;
						$html .= $our_team_phone;

						$html .= '<li class="social"><ul>';
						$html .= $face_url;
						$html .= $twitter_url;
						$html .= $rss_url;
						$html .= $skype_url;
						$html .= $dribbble_url;
						$html .= $linkedin_url;
						$html .= '</ul></li>';

						echo ent2ncr( $html );
						?>
					</ul>
				</div>

			</div>
		</article><!-- #post-## -->
		<?php
		do_action( 'thim_wrapper_loop_end' );
		?>

		<div class="related-posts container">
			<h3 class="title"><?php esc_html_e( 'Other Members', 'charitywp' ); ?></h3>
			<?php
			$categories = get_the_terms( $post->ID, 'our_team_category' );
			foreach ( $categories as $term ) {
				$name = $term->term_id;
			}
			$post_per_row = 3;
			$post_per_row = get_theme_mod( 'our_team_post_per_row' );
			$col          = 12 / $post_per_row;
			$number       = $post_per_row;
			$team_args    = array(
				'post_type'      => 'our_team',
				'posts_per_page' => (int) $number,
				'order'          => 'post_date',
				'orderby'        => 'title',
				'post__not_in'   => array( get_the_id() ),
				'tax_query'      => array(
					array(
						'taxonomy' => 'our_team_category',
						'field'    => 'term_id',
						'terms'    => $name,
					),
				),
			);

			$members = new WP_Query( $team_args );
			$html    = '';

			if ( $members->have_posts() ): ?>
				<div class="thim-our-team">
					<div class="row members">
						<?php
						$i = 0;
						while ( $members->have_posts() ):
							$i ++;
							$members->the_post();
							$regency     = get_post_meta( get_the_ID(), 'regency', true );
							$show_social = false;

							$link_detail = '<li><a href="' . esc_url( get_permalink() ) . '"><i class="fa fa-link"></i></a></li>';
							if ( 1 == get_theme_mod( 'our_team_display_link' ) ) {
								$show_social = true;
							}
							if ( $regency != '' ) {
								$regency     = '<div class="regency">' . $regency . '</div>';
								$show_social = true;
							}
							$face_url = get_post_meta( get_the_ID(), 'face_url', true );
							if ( $face_url != '' ) {
								$face_url    = '<li><a href="' . esc_url( $face_url ) . '"><i class="fa fa-facebook"></i></a></li>';
								$show_social = true;
							}
							$twitter_url = get_post_meta( get_the_ID(), 'twitter_url', true );
							if ( $twitter_url != '' ) {
								$twitter_url = '<li><a href="' . esc_url( $twitter_url ) . '"><i class="fa fa-twitter"></i></a></li>';
								$show_social = true;
							}
							$rss_url = get_post_meta( get_the_ID(), 'rss_url', true );
							if ( $rss_url != '' ) {
								$rss_url     = '<li><a href="' . esc_url( $rss_url ) . '"><i class="fa fa-rss"></i></a></li>';
								$show_social = true;
							}
							$skype_url = get_post_meta( get_the_ID(), 'skype_url', true );
							if ( $skype_url != '' ) {
								$skype_url   = '<li><a href="' . esc_url( $skype_url ) . '"><i class="fa fa-skype"></i></a></li>';
								$show_social = true;
							}
							$dribbble_url = get_post_meta( get_the_ID(), 'dribbble_url', true );
							if ( $dribbble_url != '' ) {
								$dribbble_url = '<li><a href="' . esc_url( $dribbble_url ) . '"><i class="fa fa-dribbble"></i></a></li>';
								$show_social  = true;
							}
							$linkedin_url = get_post_meta( get_the_ID(), 'linkedin_url', true );
							if ( $linkedin_url != '' ) {
								$linkedin_url = '<li><a href="' . esc_url( $linkedin_url ) . '"><i class="fa fa-linkedin"></i></a></li>';
								$show_social  = true;
							}
							$our_team_phone = get_post_meta( get_the_ID(), 'our_team_phone', true );
							if ( $our_team_phone != '' ) {
								$our_team_phone = '<div class="phone"><i class="fa fa-phone"></i> ' . $our_team_phone . '</div>';
							}
							$our_team_email = get_post_meta( get_the_ID(), 'our_team_email', true );
							if ( $our_team_email != '' ) {
								$our_team_email = '<div class="email"><i class="fa fa-envelope"></i> ' . $our_team_email . '</div>';
							}
							$html .= '<div class="member col-xs-6 col-sm-' . $col . '">';
							$html .= '	<div class="inner">';
							if ( has_post_thumbnail() ) {
								$html .= '<div class="avatar-wrapper">';
								$html .= '	<div class="avatar-inner">';
								$html .= get_the_post_thumbnail( get_the_ID(), 'full' );
								$html .= '	</div>';
								if ( $show_social ) {
									$html .= '<div class="social"><ul>';

									if ( 1 == get_theme_mod( 'our_team_display_link' ) ) {
										$html .= $link_detail;
									}
									if ( 1 == get_theme_mod( 'our_team_display_facebook' ) ) {
										$html .= $face_url;
									}
									if ( 1 == get_theme_mod( 'our_team_display_twitter' ) ) {
										$html .= $twitter_url;
									}
									if ( 1 == get_theme_mod( 'our_team_display_rss' ) ) {
										$html .= $rss_url;
									}
									if ( 1 == get_theme_mod( 'our_team_display_skype' ) ) {
										$html .= $skype_url;
									}
									if ( 1 == get_theme_mod( 'our_team_display_dribbble' ) ) {
										$html .= $dribbble_url;
									}
									if ( 1 == get_theme_mod( 'our_team_display_linkedin' ) ) {
										$html .= $linkedin_url;
									}

									$html .= '</ul></div>';
								}
								$html .= '</div>';
							}


							$html .= ' 		<div class="info">';
							$html .= '			<div class="name"><a href="' . get_permalink() . '">' . the_title( ' ', ' ', false ) . '</a></div>';
							$html .= $regency;
							if ( 1 == get_theme_mod( 'our_team_display_phone' ) ) {
								$html .= $our_team_phone;
							}
							if ( 1 == get_theme_mod( 'our_team_display_email' ) ) {
								$html .= $our_team_email;
							}
							$html .= '		</div>';

							if ( 1 == get_theme_mod( 'our_team_display_content' ) ) {
								$html .= '<div class="description">';
								$html .= get_the_excerpt();
								$html .= '</div>';
							}

							$html .= '	</div>';
							$html .= '</div>';
						endwhile;
						echo ent2ncr( $html );
						?>
					</div>
				</div>
			<?php endif;
			wp_reset_postdata();
			?>
		</div>

	</section>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>