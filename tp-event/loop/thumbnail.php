<?php

if ( !defined( 'ABSPATH' ) ) {
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
			if ( class_exists( 'TP_Event_Authentication' ) ) {
				$event    = TP_Event_Authentication()->loader->load_module( 'TP_Event_Auth\Events\Event', get_the_ID() );
				$quantity = $event->quantity;
			} elseif ( get_option( 'thimpress-event-version' ) ) {
				$event    = new TP_Event_Event( get_the_ID() );
				$quantity = $event->qty;
			}
			if ( isset( $event ) ) {
				if ( absint( $quantity ) != 0 && $event->post->post_status !== 'tp-event-expired' ) { ?>
                    <a href="#" class="thim-button style3 thim-toggle-div" data-div=".event_register_area" data-scroll="true"><?php esc_html_e( 'BUY TICKET', 'charitywp' ); ?></a>
					<?php
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