<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( has_post_thumbnail() ): ?>

	<?php if ( is_single() ): ?>
		<div class='post-formats-wrapper'>

			<?php

			$thumb = get_the_post_thumbnail( get_the_ID(), 'full' );

			if ( empty( $thumb ) ) {
				return;
			}

			echo '<a class="post-image" href="' . esc_url( get_permalink() ) . '">' . $thumb . '</a>';

			$event    = new WPEMS_Event( get_the_ID() );
			$quantity = $event->qty;

			if ( isset( $event ) ) {
				if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
					if ( absint( $quantity ) != 0 && get_post_meta( get_the_ID(), 'tp_event_status', true ) !== 'expired' ) { ?>
						<a href="#" class="thim-button style3 thim-toggle-div" data-div=".event_register_area" data-scroll="true"><?php esc_html_e( 'BUY TICKET', 'charitywp' ); ?></a>
						<?php
					}
				} else {
					if ( absint( $quantity ) != 0 && $event->post->post_status !== 'tp-event-expired' ) { ?>
						<a href="#" class="thim-button style3 thim-toggle-div" data-div=".event_register_area" data-scroll="true"><?php esc_html_e( 'BUY TICKET', 'charitywp' ); ?></a>
						<?php
					}
				}
			} ?>
		</div>

	<?php else: ?>

		<div class="entry-thumbnail">
			<?php thim_feature_image( 270, 250, true ); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>"
			   class="thim-button style3"><?php esc_html_e( 'Read more', 'charitywp' ); ?></a>
		</div>

	<?php endif; ?>

<?php endif; ?>