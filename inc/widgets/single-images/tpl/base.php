<?php
$link_before         = $after_link = $image = $images_size = '';
$instance_image_size = $instance['image_size'] != '' ? $instance['image_size'] : 'full';
$src                 = wp_get_attachment_image_src( $instance['image'], $instance_image_size );

if ( $src ) {
	$images_size = @getimagesize( $src['0'] );
	$image       = '<img src ="' . $src['0'] . '" ' . $images_size['3'] . ' alt=""/>';
}
if ( $instance['image_link'] ) {
	$link_before = '<a target="' . ( $instance['link_target'] ) . '" href="' . ( $instance['image_link'] ) . '">';
	$after_link  = "</a>";
}
?>

<div class="thim-single-image <?php echo esc_attr( $instance['effect_hover'] ); ?>">
	<?php
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}
	echo '<div class="wrapper-image">';
	if ( $image ) {
		echo '<div class="single-image ' . $instance['image_alignment'] . '">' . $link_before . $image . $after_link . '</div>';
	}
	if ( $instance['subtitle'] ) {
		echo '<div class="subtitle">' . $instance['subtitle'] . '</div>';
	}
	if ( $instance['description'] ) {
		echo '<div class="description">' . $instance['description'] . '</div>';
	}
	echo '</div>';
	?>
</div>
