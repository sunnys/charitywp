<?php
/**
 * @Author: ducnvtt
 * @Date  :   2016-02-19 09:11:59
 * @Last  Modified by:   leehld
 * @Last  Modified time: 2016-01-17 16:45:29
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$query = new WP_Query( $args );

wpems_print_notices();

if ( !is_user_logged_in() ) {
	printf( esc_html__( 'You are not <a href="%s">login</a>', 'charitywp' ), wpems_login_url() );
	return;
}

if ( $query->have_posts() ) : ?>

    <table>
        <thead>
        <th><?php esc_html_e( 'Booking ID', 'charitywp' ); ?></th>
        <th><?php esc_html_e( 'Events', 'charitywp' ); ?></th>
        <th><?php esc_html_e( 'Type', 'charitywp' ); ?></th>
        <th><?php esc_html_e( 'Cost', 'charitywp' ); ?></th>
        <th><?php esc_html_e( 'Quantity', 'charitywp' ); ?></th>
        <th><?php esc_html_e( 'Payment Method', 'charitywp' ); ?></th>
        <th><?php esc_html_e( 'Payment Status', 'charitywp' ); ?></th>
        </thead>
        <tbody>
		<?php foreach ( $query->posts as $post ): ?>

			<?php $booking = WPEMS_Booking::instance( $post->ID ) ?>
            <tr>
                <td><?php printf( '%s', wpems_format_ID( $post->ID ) ) ?></td>
                <td><?php printf( '<a href="%s">%s</a>', get_the_permalink( $booking->event_id ), get_the_title( $booking->event_id ) ) ?></td>
                <td><?php printf( '%s', floatval( $booking->price ) == 0 ? __( 'Free', 'charitywp' ) : __( 'Cost', 'charitywp' ) ) ?></td>
                <td><?php printf( '%s', wpems_format_price( floatval( $booking->price ), $booking->currency ) ) ?></td>
                <td><?php printf( '%s', $booking->qty ) ?></td>
                <td><?php printf( '%s', $booking->payment_id ? wpems_get_payment_title( $booking->payment_id ) : __( 'No payment', 'charitywp' ) ) ?></td>
                <th><?php printf( '%s', wpems_booking_status( $booking->ID ) ); ?></th>
            </tr>

		<?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
