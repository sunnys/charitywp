<?php
$client_logo_id = 'thim_'.uniqid();
$link_before = $after_link = $image = $css_animation =  $style_width = '';
if ( $instance['image'] ) {
	if ( $instance['link_target'] ) {
		$t = 'target="_blank"';
	} else {
		$t = '';
	}

	$img_id = explode( ",", $instance['image'] );
	if ( $instance['image_link'] ) {
		$img_url = explode( ",", $instance['image_link'] );
	}

	?>

	<div id="<?php echo esc_attr($client_logo_id) ?>" class="thim-client-logo slider" data-autoplay="<?php echo esc_attr($instance['autoPlay']); ?>" data-items="<?php echo esc_attr($instance['items']); ?>">
		<?php
			$i = 0;
			foreach ( $img_id as $id ) {
				$src = wp_get_attachment_image_src( $id, $instance['image_size'] );
				if ( $src ) {
					$img_size = '';
					$src_size = @getimagesize( $src['0'] );
					$image    = '<img src ="' . ( $src['0'] ) . '" ' . $src_size[3] . ' alt=""/>';
				}
				if ( $instance['image_link'] && isset($img_url[$i])) {
					$link_before = '<a ' . $t . ' href="' . ( $img_url[$i] ) . '">';
					$after_link  = "</a>";
				}
				echo '<div class="item"' . $style_width . '>' . $link_before . $image . $after_link . "</div>";
				$i ++;
			}

		?>	
	</div>
<?php
}