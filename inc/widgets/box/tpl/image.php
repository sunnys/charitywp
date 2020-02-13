<?php
$title                 = $instance['title_group']['title'];
$title_color           = $instance['title_group']['text_color'];
$description           = $instance['desc_group']['content'];
$description_color     = $instance['desc_group']['text_color'];
$readmore_link         = $instance['readmore_group']['link'];
$readmore_style        = $instance['readmore_group']['read_more'];
$readmore_text         = $instance['readmore_group']['button_readmore_group']['read_text'];
$readmore_button_style = $instance['readmore_group']['button_readmore_group']['button_style'];
$image_id              = $instance['box_style_simple']['background_image'];


// CSS Style
$box_css  = $title_css = $description_css = $overlay_css = $before_title = $after_title = $before_box = $after_box = $media_css = '';
$line     = ( isset( $instance['title_group']['line'] ) && $instance['title_group']['line'] === 'false' ) ? 'not-line' : '';
$layout   = isset( $instance['box_style_simple']['layout'] ) ? $instance['box_style_simple']['layout'] : 'image-at-top';
$overflow = isset( $instance['box_style_simple']['overflow'] ) ? $instance['box_style_simple']['overflow'] : 'hidden';

$media_css .= 'overflow: ' . $overflow . ';';


if ( $title_color ) {
	$title_css .= 'color: ' . $title_color . ';';
}

if ( $description_color ) {
	$description_css .= 'color: ' . $description_color . ';';
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

?>

<div class="thim-box-<?php echo esc_attr( $instance['box_style'] . ' ' . $line . ' ' . $layout ); ?>"
	 style="<?php echo esc_attr( $box_css ); ?>">
	<div class="inner">

		<?php if ( $image_id ) :
			$src = wp_get_attachment_image_src( $image_id, 'full' );
			$images_size = @getimagesize( $src['0'] );
			$img_src = $src['0'];

			?>

			<div class="media" style="<?php echo esc_attr( $media_css ); ?>">
				<?php
				echo ent2ncr( $before_box . '<img src="' . $img_src . '" alt="' . get_the_title( $image_id ) . '">' . $after_box );
				?>
			</div>
		<?php endif; ?>

		<div class="box-content">
			<?php
			if ( $title != '' ) :
				echo ent2ncr( $before_box . $before_title . '<' . $title_tag . ' class="title" style="' . $title_css . '">' . $title . '</' . $title_tag . '>' . $after_box . $after_title );
			endif;

			if ( $description != '' ) :
				echo '<div class="description" style="' . $description_css . '">' . $before_box . $description . $after_box . '</div>';
			endif;

			if ( $readmore_link != '' && $readmore_style != 'title' && $readmore_text != 'title' ) :
				echo '<a class="thim-button readmore ' . $readmore_button_style . '" href="' . $readmore_link . '">' . esc_html( $readmore_text ) . '</a>';
			endif;
			if ( $instance['box_style'] === 'video' ):
				$video_url = $instance['box_style_video']['url'];
				echo '<a href="' . $video_url . '" class="toggle-video"></a>';
			endif;
			
			if ( $instance['box_char_background'] ) {
				echo '<div class="char_background">' . $instance['box_char_background'] . '</div>';
			}
			?>
		</div>

	</div>

</div>

