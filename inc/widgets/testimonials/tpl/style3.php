<?php

$link         = $regency = '';
$limit        = $instance['number'] ? $instance['number'] : 10;
$item_visible = $instance['item_visible']  ? $instance['item_visible'] : 5;
$mousewheel   = $instance['mousewheel'] ? 1 : 0;

$s3_args = array(
	'post_type'      => 'testimonials',
	'posts_per_page' => $limit,
	'ignore_sticky_posts' => true
);

$style3_testimonial = new WP_Query( $s3_args );

$module_id = uniqid();

$color = isset($instance['color']) ? $instance['color'] : '#FFF';
$avatar_color = isset($instance['border_avatar_color']) ? $instance['border_avatar_color'] : '#FFF';

$custom_css = '';
$custom_css .= '.thim-content-slider .control-nav{ color: '.$color .'; border-color: '.$color .'}';
$custom_css .= '.thim-content-slider .slides-wrapper .scrollable>li .slide-content{ border-color: '.$avatar_color .' }';
$custom_css .= '.thim-content-slider .slides-wrapper .scrollable>li .slide-content:before{ background: '.$color .' }';



$html = '<div class="thim-testimonial-slider">';
if ( $style3_testimonial->have_posts() ) {
	$html .= '<div id="'.$module_id.'" class="testimonial-slider" data-visible="' . $item_visible . '" data-mousewheel="' . $mousewheel . '">';
	while ( $style3_testimonial->have_posts() ) : $style3_testimonial->the_post();
		$link    = get_post_meta( get_the_ID(), 'website_url', true );
		$regency = get_post_meta( get_the_ID(), 'regency', true );

		$html .= '<div class="item">';
		if ( has_post_thumbnail() ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$img_src = aq_resize( $src[0], 75, 75, true );
			$html .= '<img src="'.esc_attr($img_src).'" alt="'.get_the_title().'" title="'.get_the_title().'"  data-heading="'.get_the_title().'" data-content="'.esc_attr( $regency ) .'" />';
		}
		$html .= '<div class="content">'.get_the_content().'</div>';

		$html .= '</div>';

	endwhile;
	$html .= '</div>';
}
$html .= '</div>';
echo ent2ncr( $html );

wp_reset_postdata();
?>

<style>
	<?php
		echo ent2ncr($custom_css);
	?>
</style>


