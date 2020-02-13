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
	$html .= '<div class="sc-testimonials row style2">';
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
		
		$html .= '	<div class="content text-center">';
		$html .= "<span>&ldquo;</span>".get_the_content()."<span>&rdquo;</span>";
		$html .= '	</div>';
		$html .= '	<div class="info text-center">';
		$html .= '		<span class="regency">' . $before_web_link . the_title( ' ', ' ', false ) . $after_web_link;
		if ( $regency <> '' ) {
			$html .= ', ' . $regency . '</span>';
		}
		$html .= '	</div>';
		if ( has_post_thumbnail() ) {
			$html .= '<div class="avatar">';
			$html .= thim_feature_image( 62, 62 );
			$html .= '</div>';
		}
		$html .= '</div>';


		$html .= '</div>';
	endwhile;
	$html .= '</div>';
}
wp_reset_postdata();
echo ent2ncr( $html );

