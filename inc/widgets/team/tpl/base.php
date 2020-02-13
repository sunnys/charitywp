<?php

$col       = 12 / $instance['per_row'];
$number    = $instance['number'] ? $instance['number'] : 4;
$team_args = array(
	'post_type'      => 'our_team',
	'posts_per_page' => (int) $number,
	'order'          => $instance['order']
);

switch ( $instance['source'] ) {
	case 'id':
		$ids       = explode( ',', $instance['member_ids'] );
		$team_args = array(
			'post_type'      => 'our_team',
			'post__in'       => $ids,
			'order'          => $instance['order'],
			'posts_per_page' => - 1
		);
		break;

	case 'category':
		$team_args = array(
			'post_type'      => 'our_team',
			'posts_per_page' => (int) $number,
			'order'          => $instance['order'],
			'tax_query'      => array(
				array(
					'taxonomy' => 'our_team_category',
					'field'    => 'slug',
					'terms'    => $instance['cat_id'],
				),
			),
		);
		break;

	default:
		$team_args = array(
			'post_type'      => 'our_team',
			'posts_per_page' => (int) $number,
			'order'          => $instance['order']
		);
		break;
}

switch ( $instance['orderby'] ) {
	case 'recent' :
		$team_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$team_args['orderby'] = 'post_title';
		break;
	default :
		$team_args['orderby'] = 'rand';
}

$members = new WP_Query( $team_args );
$html    = '';

$display = $instance['display'];
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

				$link_detail = '<li><a href="' . ( get_permalink() ) . '"><i class="fa fa-link"></i></a></li>';
				if ( 'show' === $display['link'] ) {
					$show_social = true;
				}
				if ( $regency != '' ) {
					$regency     = '<div class="regency">' . $regency . '</div>';
					$show_social = true;
				}
				$face_url = get_post_meta( get_the_ID(), 'face_url', true );
				if ( $face_url != '' ) {
					$face_url    = '<li><a href="' . ( $face_url ) . '"><i class="fa fa-facebook"></i></a></li>';
					$show_social = true;
				}
				$twitter_url = get_post_meta( get_the_ID(), 'twitter_url', true );
				if ( $twitter_url != '' ) {
					$twitter_url = '<li><a href="' . ( $twitter_url ) . '"><i class="fa fa-twitter"></i></a></li>';
					$show_social = true;
				}
				$rss_url = get_post_meta( get_the_ID(), 'rss_url', true );
				if ( $rss_url != '' ) {
					$rss_url     = '<li><a href="' . ( $rss_url ) . '"><i class="fa fa-rss"></i></a></li>';
					$show_social = true;
				}
				$skype_url = get_post_meta( get_the_ID(), 'skype_url', true );
				if ( $skype_url != '' ) {
					$skype_url   = '<li><a href="' . ( $skype_url ) . '"><i class="fa fa-skype"></i></a></li>';
					$show_social = true;
				}
				$dribbble_url = get_post_meta( get_the_ID(), 'dribbble_url', true );
				if ( $dribbble_url != '' ) {
					$dribbble_url = '<li><a href="' . ( $dribbble_url ) . '"><i class="fa fa-dribbble"></i></a></li>';
					$show_social  = true;
				}
				$linkedin_url = get_post_meta( get_the_ID(), 'linkedin_url', true );
				if ( $linkedin_url != '' ) {
					$linkedin_url = '<li><a href="' . ( $linkedin_url ) . '"><i class="fa fa-linkedin"></i></a></li>';
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
//					$html .= thim_feature_image( 200, 200 , false);
					$html .= get_the_post_thumbnail( get_the_ID(), 'full' );
					$html .= '	</div>';
					if ( $show_social ) {
						$html .= '<div class="social"><ul>';

						if ( 'show' === $display['link'] ) {
							$html .= $link_detail;
						}
						if ( 'show' === $display['facebook'] ) {
							$html .= $face_url;
						}
						if ( 'show' === $display['twitter'] ) {
							$html .= $twitter_url;
						}
						if ( 'show' === $display['rss'] ) {
							$html .= $rss_url;
						}
						if ( 'show' === $display['skype'] ) {
							$html .= $skype_url;
						}
						if ( 'show' === $display['dribbble'] ) {
							$html .= $dribbble_url;
						}
						if ( 'show' === $display['linkedin'] ) {
							$html .= $linkedin_url;
						}

						$html .= '</ul></div>';
					}
					$html .= '</div>';
				}


				$html .= ' 		<div class="info">';
				$html .= '			<div class="name"><a href="' . get_the_permalink() . '">' . the_title( ' ', ' ', false ) . '</a></div>';
				$html .= $regency;
				if ( 'show' === $display['phone'] ) {
					$html .= $our_team_phone;
				}
				if ( 'show' === $display['email'] ) {
					$html .= $our_team_email;
				}
				$html .= '		</div>';

				if ( 'show' === $display['content'] ) {
					$html .= '<div class="description">';
					$html .= get_the_excerpt();
					$html .= '</div>';
				}

				$html .= '	</div>';
				$html .= '</div>';
			endwhile;
			echo ent2ncr( $html );
			//$terms = get_the_terms()
			?>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
?>
