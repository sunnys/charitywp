<?php
$title                 = $instance['title_group']['title'];
$title_color           = $instance['title_group']['text_color'];
$description           = $instance['desc_group']['content'];
$description_color     = $instance['desc_group']['text_color'];
$readmore_link         = $instance['readmore_group']['link'];
$readmore_style        = $instance['readmore_group']['read_more'];
$readmore_text         = $instance['readmore_group']['button_readmore_group']['read_text'];
$readmore_button_style = $instance['readmore_group']['button_readmore_group']['button_style'];
$background_image_id   = $instance['box_style_default']['background_image'];
$overlay_style         = $instance['box_style_default']['overlay_style'];


// CSS Style
$box_css = $title_css = $description_css = $overlay_css = $before_title = $after_title = $before_box = $after_box = '';
$line    = ( isset( $instance['title_group']['line'] ) && $instance['title_group']['line'] === 'false' ) ? 'not-line' : '';

if ( $title_color ) {
	$title_css .= 'color: ' . $title_color . ';';
}

if ( $description_color ) {
	$description_css .= 'color: ' . $description_color . ';';
}

if ( $overlay_style != 'none' ) {
	if ( $instance['box_style_default']['overlay_style'] === 'overlay' ) {
		// Overlay color
		$overlay_color   = $instance['box_style_default']['overlay_color'] != '' ? $instance['box_style_default']['overlay_color'] : '#000000';
		$overlay_opacity = $instance['box_style_default']['overlay_opacity'] != '' ? $instance['box_style_default']['overlay_opacity'] : 1;
		$overlay_css .= 'background-color: ' . $overlay_color . ';';
		$overlay_css .= 'opacity: ' . $overlay_opacity . ';';
	}
}

// End: CSS Style

// Link
$before_box = $after_box = $after_title = $before_title = '';
if ( $readmore_link != '' ) {
	switch ( $readmore_style ) {
		case 'complete_box':
			$before_box = '<a href="' . $readmore_link . '">';
			$after_box  = '</a>';
			break;
		case 'title':
		case 'title_more':
			$before_title = '<a href="' . $readmore_link . '">';
			$after_title  = '</a>';
			break;

		default:
			# code...
			break;
	}
}
// End: Link

// Font Family
$title_tag = ( isset( $instance['title_group']['font_family'] ) && $instance['title_group']['font_family'] === 'default' ) ? 'div' : 'h3';
// Title Style
$title_css .= isset( $instance['title_group']['font_size'] ) ? 'font-size: ' . $instance['title_group']['font_size'] . 'px;' : 'font-size: 24px;';
$title_css .= isset( $instance['title_group']['font_weight'] ) ? 'font-weight: ' . $instance['title_group']['font_weight'] . ';' : 'font-weight: 700;';

$html = '';
$html .= '<div class="thim-box ' . $instance['box_style'] . ' ' . $line . '" style="' . $box_css . '">';
$html .= '	<div class="inner">';

if ( $background_image_id ) :
	$src         = wp_get_attachment_image_src( $background_image_id, 'full' );
	$images_size = @getimagesize( $src['0'] );
	$img_src     = $src['0'];

	if ( $images_size[0] >= 532 && $images_size[1] >= 532 ) {
		$img_src = aq_resize( $src[0], 532, 532, true );
	}

	$html .= '<div class="media">';
	$html .= $before_box . '<img src="' . $img_src . '" alt="' . get_the_title( $background_image_id ) . '">' . $after_box;
	if ( $overlay_style != 'none' ) {
		$html .= '<div class="thim-overlay ' . $overlay_style . '" style="' . $overlay_css . '"></div>';
	}
	$html .= '</div>';
endif;
$html .= '<div class="box-content">';
if ( $title != '' ) :
	$html .= $before_title . $before_box;
	$html .= '<' . $title_tag . ' class="title" style="' . $title_css . '">' . $title . '</' . $title_tag . '>';
	$html .= $after_title . $after_box;
endif;

if ( $description != '' ) :
	$html .= '<div class="description" style="' . $description_css . '">' . $before_box . $description . $after_box . '</div>';
endif;

if ( $readmore_link != '' && $readmore_style != 'title' && $readmore_text != 'title' ) :
	$html .= '<a class="thim-button readmore ' . $readmore_button_style . '" href="' . $readmore_link . '">' . esc_html( $readmore_text ) . '</a>';
endif;
if ( $instance['box_style'] === 'video' ):
	$video_url = $instance['box_style_video']['url'];
	$html .= '<a href="' . $video_url . '" class="toggle-video"></a>';
endif;

$html .= '</div>';

$html .= '	</div>';

$html .= '</div>';
echo ent2ncr( $html );

