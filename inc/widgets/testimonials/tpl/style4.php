<?php

$link         = $regency = '';
$limit        = $instance['number'] ? $instance['number'] : 3;

$s4_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $limit,
	'ignore_sticky_posts' => true
);

$style4_testimonial = new WP_Query( $s4_args );

$module_id = uniqid();


$html = '<div class="thim-testimonial-slides">';
if ( $style4_testimonial->have_posts() ) {
	$html .= '<div id="'.$module_id.'" class="testimonial-slides">';
	while ( $style4_testimonial->have_posts() ) : $style4_testimonial->the_post();
		$link    = get_post_meta( get_the_ID(), 'website_url', true );
		$regency = get_post_meta( get_the_ID(), 'regency', true );

		$html .= '<div class="item">';
		$html .= '<div class="content">'. get_the_content() .'</div>';
        if ( ! empty($link) ) {
            $html .= '<div class="name"><a href="'. esc_url($link).'">'. get_the_title() .'</a></div>';
        } else {
            $html .= '<div class="name">'. get_the_title() .'</div>';
        }
		if ( ! empty($regency) ) {
            $html .= '<div class="regency">'. $regency .'</div>';
        }

		$html .= '</div>';

	endwhile;
	$html .= '</div>';
}
$html .= '</div>';
echo ent2ncr( $html );

wp_reset_postdata();
?>


