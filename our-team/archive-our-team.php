<?php
get_header();
?>

	<section class="content-area">
		<?php
		$post_per_row = get_theme_mod( 'our_team_post_per_row' );
		$col          = 12 / $post_per_row;
		$number       = $post_per_row = get_theme_mod( 'our_team_post_per_page' );
		$paged        = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 0;
		$offset       = ( $paged == 0 ) ? 0 : ( ( $paged - 1 ) * $number );
		$team_args    = array(
			'post_type'      => 'our_team',
			'posts_per_page' => (int) $number,
			'page'           => $paged,
			'offset'         => $offset
		);
		$members      = new WP_Query( $team_args );
		$html         = '';

		if ( $members->have_posts() ): ?>
			<div class="thim-our-team">
				<div class="row members">
					<?php
					$i = 0;
					while ( $members->have_posts() ):
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
						$html .= '<div class="member col-xs-6 col-md-' . $col . '">';
						$html .= '	<div class="inner">';
						if ( has_post_thumbnail() ) {
							$html .= '<div class="avatar-wrapper">';
							$html .= '	<div class="avatar-inner">';
							$html .= thim_feature_image( 200, 200, false );
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
						$html .= '			<div class="name">' . the_title( ' ', ' ', false ) . '</div>';
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
						$i ++;
					endwhile;
					echo ent2ncr( $html );
					thim_paging_nav();
					?>
				</div>
			</div>
		<?php endif;
		wp_reset_postdata();
		?>
		<?php
		do_action( 'thim_wrapper_loop_end' );
		?>
	</section>
<?php get_footer(); ?>