<?php


$column 	= (int) (isset($instance['column']) ? $instance['column'] : 3);
$per_page 	= isset($instance['per_page']) ? $instance['per_page'] : 9;
$class_col = 'col-xs-6 col-md-'.(12/$column);


$query_args = array(
	'post_type' => 'post',
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-gallery' ),
		)
	)
);

if ( ! empty( $instance['cat'] ) ) {
	$query_args['cat'] = $instance['cat'];
}

$gallery_id = 'gallery_'.uniqid();

$posts_display = new WP_Query( $query_args );

if ( $posts_display->have_posts() ) :

	$categories = array();
	$html       = '';

	while ( $posts_display->have_posts() ) : $posts_display->the_post();

		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		$src_info = wp_get_attachment_metadata(get_post_thumbnail_id());
		
		if ( $src ):
			
			$img_src = $src[0];
			if ($src_info['width'] >= 370 && $src_info['height'] >= 310) {
				$img_src = aq_resize( $src[0], 370, 310, true ); 
			}

			$html .= '<div class="item '.$class_col.'">';
			$html .= '		<div class="inner">';
			$html .= '			<a class="media" href="'.get_post_permalink().'" data-title="'.get_the_title().'" data-caption="'.esc_attr(get_the_excerpt()).'" data-id="'.get_the_id().'">';
			$html .= '				<img src="'.esc_url($img_src).'" alt="'.get_the_title().'"/>';
			$html .= '			</a>';
			$html .= '			<div class="infos">';
			$html .= '				<div class="title"><a href="'.get_post_permalink().'">'.get_the_title().'</a></div>';
			$html .= '				<div class="caption">'.esc_attr(strip_tags(get_the_excerpt())).'</div>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '</div>';

		endif;

	endwhile;

	?>

	<div class="thim-gallery source-posts" id="<?php echo esc_attr($gallery_id); ?>" data-per_page="<?php echo esc_attr($per_page);?>">
		<div class="gallery-wrapper">
			<div class="items row" id="<?php echo esc_attr($gallery_id); ?>_items">
			<?php
				echo ent2ncr( $html );
			?>
			</div>
			<div class="gallery-pagination">
				<div class="inner-nav"></div>
			</div>
		</div>
		<div class="thim-gallery-show"></div>
	</div>

	<?php
endif;
wp_reset_postdata();
