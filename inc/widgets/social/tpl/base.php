<?php
$title          = $link_face = $link_twitter = $link_google = $link_dribble = $link_pinterest = $link_youtube = $link_digg = $link_linkedin = $link_instagram = '';
$title          = isset( $instance['title'] ) ? $instance['title'] : '';
$link_face      = isset( $instance['link_face'] ) ? $instance['link_face'] : '';
$link_twitter   = isset( $instance['link_twitter'] ) ? $instance['link_twitter'] : '';
$link_google    = isset( $instance['link_google'] ) ? $instance['link_google'] : '';
$link_dribble   = isset( $instance['link_dribble'] ) ? $instance['link_dribble'] : '';
$link_linkedin  = isset( $instance['link_linkedin'] ) ? $instance['link_linkedin'] : '';
$link_pinterest = isset( $instance['link_pinterest'] ) ? $instance['link_pinterest'] : '';
$link_digg      = isset( $instance['link_digg'] ) ? $instance['link_digg'] : '';
$link_youtube   = isset( $instance['link_youtube'] ) ? $instance['link_youtube'] : '';
$link_flickr    = isset( $instance['link_flickr'] ) ? $instance['link_flickr'] : '';
$link_instagram = isset( $instance['link_instagram'] ) ? $instance['link_instagram'] : '';
$style          = isset( $instance['style'] ) ? $instance['style'] : 'default';
?>
<div class="thim-social text-<?php echo esc_attr( $instance['align'] ); ?> style-<?php echo esc_attr( $style ); ?>">
	<?php
	if ( $title ) {
		echo ent2ncr( $before_title . esc_attr( $title ) . $after_title );
	}
	?>
    <ul class="social_link">
		<?php
		if ( $link_face != '' ) {
			echo '<li><a class="facebook" href="' . esc_url( $link_face ) . '" target="' . esc_attr( $instance['link_target'] ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( $link_twitter != '' ) {
			echo '<li><a class="twitter" href="' . esc_url( $link_twitter ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $link_google != '' ) {
			echo '<li><a class="google-plus" href="' . esc_url( $link_google ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( $link_dribble != '' ) {
			echo '<li><a class="dribbble" href="' . esc_url( $link_dribble ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( $link_linkedin != '' ) {
			echo '<li><a class="linkedin" href="' . esc_url( $link_linkedin ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( $link_pinterest != '' ) {
			echo '<li><a class="pinterest" href="' . esc_url( $link_pinterest ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( $link_digg != '' ) {
			echo '<li><a class="digg" href="' . esc_url( $link_digg ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-digg"></i></a></li>';
		}
		if ( $link_youtube != '' ) {
			echo '<li><a class="youtube" href="' . esc_url( $link_youtube ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-youtube"></i></a></li>';
		}
		if ( $link_instagram != '' ) {
			echo '<li><a class="instagram" href="' . esc_url( $link_instagram ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-instagram"></i></a></li>';
		}
		if ( $link_flickr != '' ) {
			echo '<li><a class="flickr" href="' . esc_url( $link_flickr ) . '" target="' . esc_attr( $instance['link_target'] ) . '" ><i class="fa fa-flickr"></i></a></li>';
		}
		?>
    </ul>
</div>