<?php
$img_id     = explode( ",", $instance['image'] );
$column     = (int) ( isset( $instance['column'] ) ? $instance['column'] : 3 );
$per_page   = isset( $instance['per_page'] ) ? $instance['per_page'] : 9;
$gutter = ( isset( $instance['gutter'] ) && $instance['gutter'] == true ) ? 'not-gutter' : '';
$col        = 'col-xs-6 col-md-' . ( 12 / $column );
$gallery_id = 'gallery_' . uniqid();
if ( $img_id ):
	?>
	<div class="thim-gallery source-images <?php echo esc_attr( $gutter ); ?>" id="<?php echo esc_attr( $gallery_id ); ?>" data-per_page="<?php echo esc_attr( $per_page ); ?>">
		<div class="gallery-wrapper">
			<div class="items row" id="<?php echo esc_attr( $gallery_id ); ?>_items">
				<?php
				foreach ( $img_id as $id ) {
					$src      = wp_get_attachment_image_src( $id, 'full' );
					$src_info = wp_get_attachment_metadata( $id );
					$info     = get_post( $id );


					if ( $src ):

						$img_src = $src[0];
						if ( $src_info['width'] >= 370 && $src_info['height'] >= 310 ) {
							$img_src = aq_resize( $src[0], 370, 310, true );
						}

						$image = '<div class="item ' . $col . '">';
						$image .= '		<div class="inner">';
						$image .= '			<a class="media" href="' . esc_url( $src[0] ) . '" data-title="' . ( $info->post_title ) . '" data-caption="' . esc_attr( $info->post_excerpt ) . '">';
						$image .= '				<img src="' . esc_url( $img_src ) . '" alt="' . ( $info->post_title ) . '"/>';
						$image .= '			</a>';
						$image .= '			<div class="infos">';
						$image .= '				<div class="title">' . esc_attr( $info->post_title ) . '</div>';
						$image .= '				<div class="caption">' . esc_attr( $info->post_excerpt ) . '</div>';
						$image .= '			</div>';
						$image .= '		</div>';
						$image .= '</div>';
						echo ent2ncr( $image );

					endif;
				}
				?>
			</div>
			<div class="gallery-pagination">
				<div class="inner-nav"></div>
			</div>
		</div>
	</div>
<?php endif; ?>
