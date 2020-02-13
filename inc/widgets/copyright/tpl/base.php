<div class="thim-widget-copyright-text text-<?php echo esc_attr( $instance['text_align'] ); ?>">
	<?php
	if ( get_theme_mod( 'copyright_text' ) ) {
		echo '<p class="text-copyright">' . get_theme_mod( 'copyright_text' ) . '</p>';
	}
	?>
</div>