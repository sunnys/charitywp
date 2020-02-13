<?php
/**
 * @Author: ducnvtt
 * @Date  :   2016-03-03 10:34:45
 * @Last  Modified by:   leehld
 * @Last  Modified time: 2017-01-17 14:15:29
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !is_user_logged_in() ) {
	?>

    <div class="event_register_area">
        <div class="inner">
			<?php
			printf( wp_kses( __( '<span class="event_auth_user_is_not_login">You must <a href="%s">Login</a> to Our site to register this event!</span>', 'charitywp' ), array( 'a' => array( 'href' => array() ), 'br' => array() ) ), esc_url( tp_event_login_url() ) . '?redirect_to=' . esc_url( tp_event_get_current_url() ) );
			return;
			?>
        </div>
    </div>
	<?php
}

// disable register event when event is expired
if ( get_post_status( get_the_ID() ) === 'tp-event-expired' ) {
	return;
}

$event    = TP_Event_Event::instance( get_the_ID() );
$user_reg = $event->booked_quantity( get_current_user_id() );

if ( absint( $event->qty ) == 0 || $event->post->post_status === 'tp-event-expired' ) {
	return;
}

?>

<div class="event_register_area">
    <div class="inner">
        <div class="meta-info">
            <ul>
                <li class="total-slot">
                    <span><?php echo esc_html__( 'Total Slot: ', 'charitywp' ); ?></span><?php echo absint( $event->qty ); ?>
                </li>
                <li class="booked-time">
                    <span><?php echo esc_html__( 'Booked Time: ', 'charitywp' ); ?></span><?php echo count( $event->load_registered() ); ?>
                </li>
                <li class="booked-slot">
                    <span><?php echo esc_html__( 'Booked Slot: ', 'charitywp' ); ?></span><?php echo esc_html( $event->booked_quantity() ); ?>
                </li>
                <li class="cost">
                    <span><?php echo esc_html__( 'Cost: ', 'charitywp' ); ?></span><?php echo esc_html( tp_event_format_price( $event->cost ) ); ?>
                </li>
            </ul>
        </div>

        <form name="event_register" class="event_register" method="POST">
            <div class="row">
                <div class="col-xs-6">
					<?php if ( !$event->is_free() || tp_event_get_option( 'email_register_times' ) === 'many' ) : ?>
                        <!--allow set slot-->
                        <div class="event_auth_form_field">
                            <label for="event_register_qty"><?php esc_html_e( 'Quantity', 'charitywp' ) ?></label>
                            <input type="number" name="qty" value="1" min="1" id="event_register_qty" />
                        </div>
                        <!--end allow set slot-->
					<?php else: ?>
                        <!--disallow set slot-->
                        <input type="hidden" name="qty" value="1" min="1" />
					<?php endif; ?>
                </div>
                <div class="col-xs-6">
                    <!--Hide payment option when cost is 0-->
					<?php if ( !$event->is_free() ) {
						$payments = tp_event_gateways_enable();
						if ( $payments ) { ?>
                            <label><?php esc_html_e( 'Payment via', 'charitywp' ) ?></label>
                            <ul class="event_auth_payment_methods">
								<?php $i = 0; ?>
								<?php foreach ( $payments as $id => $payment ) : ?>
                                    <li>
                                        <input id="payment_method_<?php echo esc_attr( $id ) ?>" type="radio" name="payment_method" value="<?php echo esc_attr( $id ) ?>"<?php echo $i === 0 ? ' checked' : '' ?>/>
                                        <label for="payment_method_<?php echo esc_attr( $id ) ?>"><?php echo esc_html( $payment->get_title() ) ?></label>
                                    </li>
									<?php $i ++; ?>
								<?php endforeach; ?>
                            </ul>
						<?php } else {
							tp_event_print_notice( 'error', esc_html__( 'There are no payment gateway available. Please contact administrator to setup it.', 'tp-event' ) );
						}
					} ?>
                    <!--End hide payment option when cost is 0-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="event_register_foot">
                        <input type="hidden" name="event_id" value="<?php echo esc_attr( get_the_ID() ) ?>" />
                        <input type="hidden" name="action" value="event_auth_register" />
						<?php wp_nonce_field( 'event_auth_register_nonce', 'event_auth_register_nonce' ); ?>
                        <button class="event_register_submit event_auth_button thim-button style3"><?php esc_html_e( 'BUY NOW', 'charitywp' ); ?></button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>