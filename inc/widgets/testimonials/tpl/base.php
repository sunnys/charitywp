<?php
$html = '';
$number = 4;
if ( $instance['number'] <> '' ) {
	$number = $instance['number'];
}

$col = 12 / $number;

$testomonial_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $number
);

$lop_testimonial = new WP_Query( $testomonial_args );

if ( $lop_testimonial->have_posts() ) {
	$html .= '<div class="sc-testimonials row">';
	while ( $lop_testimonial->have_posts() ): $lop_testimonial->the_post();
		$html .= '<div class="testimonial-item col-sm-'.$col.'">';
		$web_link        = get_post_meta( get_the_ID(), 'website_url', true );
		$before_web_link = $after_web_link = '';
		if ( $web_link <> '' ) {
			$before_web_link = '<a href="' . $web_link . '">';
			$after_web_link  = "</a>";
		}
		$regency = get_post_meta( get_the_ID(), 'regency', true );
		
		$html .= '<div class="testimonial-inner">';
		if ( has_post_thumbnail() ) {
			$html .= '<div class="avatar">';
			$html .= thim_feature_image( 570, 570 );
			$html .= '</div>';
		}
		$html .= '<div class="content">';
		$html .= get_the_content();
		$html .= '</div>';
		$html .= '<div class="info">';
		$html .= '<div class="name">' . $before_web_link . the_title( ' ', ' ', false ) . $after_web_link . '</div>';
		if ( $regency <> '' ) {
			$html .= '<div class="regency">' . $regency . '</div>';
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
	endwhile;
	$html .= '</div>';
}
wp_reset_postdata();
echo ent2ncr( $html );

