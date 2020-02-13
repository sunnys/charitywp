<?php if ( $instance['title'] <> '' ) {
	echo '<h3 class="widget-title">' . esc_attr( $instance['title'] ) . '</h3>';
} ?>
<?php
if ( empty( $instance['api_key'] ) ) {
	echo sprintf( wp_kses( __( '<p class="container">You must enter Google Map API Key. Refer on <a href="%s">Google Api Key</a></p>', 'charitywp' ),
		array( 'a' => array( 'href' => array() ) , 'p' => array( 'class' => array() ) ) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) );
} else {
	?>
	<div class="kcf-module">
		<div
			class="ob-google-map-canvas"
			style="height:<?php echo intval( $height ) ?>px;"
			id="ob-map-canvas-<?php echo esc_attr( $map_id ) ?>"
			<?php foreach ( $map_data as $key => $val ) : ?>
				<?php if ( !empty( $val ) ) : ?>
					data-<?php echo esc_attr( $key ) . '="' . esc_attr( $val ) . '"' ?>
				<?php endif ?>
			<?php endforeach; ?>
		></div>
	</div>
	<?php

}
?>
