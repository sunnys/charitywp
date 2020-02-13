<?php

$number = $instance['number'] ? $instance['number'] : 1;
$status = $instance['status'] ? $instance['status'] : 'tp-event-happenning';

if ( version_compare( WPEMS_VER, '2.1.5', '>=' ) ) {
	if ( $status == 'tp-event-happenning' ) {
		$status_new = 'happening';
	} elseif ( $status == 'tp-event-upcoming' ) {
		$status_new = 'upcoming';
	} else {
		$status_new = 'expired';
	}
	$event_args = array(
		'post_type'      => array( 'tp_event' ),
		'posts_per_page' => $number,
		'order'          => $instance['order'],
		'meta_query'     => array(
			array(
				'key'     => 'tp_event_status',
				'value'   => $status_new,
				'compare' => '=',
			),
		),
	);
} else {
	$event_args = array(
		'post_type'      => array( 'tp_event' ),
		'posts_per_page' => $number,
		'order'          => $instance['order'],
		'post_status'    => $status
	);
}

switch ( $instance['orderby'] ) {
	case 'recent' :
		$event_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$event_args['orderby'] = 'post_title';
		break;
	case 'tp_event_date_start' :
	case 'tp_event_date_end' :
		$event_args['orderby']  = 'meta_value';
		$event_args['meta_key'] = $instance['orderby'];
		break;
	default :
		$event_args['orderby'] = 'rand';
}

$events = new WP_Query( $event_args );
?>

	<div class="thim-slider-events layout-4">
		<div class="events owl-carousel owl-theme">
			<?php
			$html = '';
			if ( $events->have_posts() ) {
				while ( $events->have_posts() ) {
					$events->the_post();
					$event_email = get_post_meta( get_the_ID(), 'tp_event_email', true );
					$event_phone = get_post_meta( get_the_ID(), 'tp_event_phone', true );

					$current_time = current_time( 'Y-m-d H:i' );
					$time         = wpems_get_time( 'Y-m-d H:i', null, false );


					$html .= '<div class="event">';

					$html .= '	<div class="thumb">';
					$html .= thim_thumbnail_no_loaded( get_the_ID(), $instance['thumbnail_size'] );
					$html .= '<div class="entry-countdown">';

					if ( $time > $current_time ) {
						$date = new DateTime( date( 'Y-m-d H:i', strtotime( $time ) ) );
						$html .= '<div class="tp_event_counter" data-time="' . esc_attr( $date->format( 'M j, Y H:i:s O' ) ) . '"></div>';
					} else {
						$html .= '<p class="tp-event-notice error">' . esc_html__( 'This event has expired', 'wp-events-manager' ) . '</p>';
					}

					$html .= '</div>';
					$html .= '		</div>';

					$html .= '	<div class="content">';
					$html .= '		<a href="' . ( get_permalink( get_the_ID() ) ) . '" class="title">' . get_the_title() . '</a>';
					$html .= '<div class="des">' . get_the_excerpt( get_the_ID() ) . '</div>';
					$html .= '		<div class="meta clearfix">';
					if ( class_exists( 'WPEMS' ) ) {
						$html .= '<span class="location"> <i class="ion-location"></i>' . wpems_event_location() . '</span>';
					} elseif ( class_exists( 'TP_Event' ) ) {
						$html .= '<span class="location"><i class="ion-location"></i>' . tp_event_location() . '</span>';
					}

					if ( class_exists( 'WPEMS' ) ) {
						$html .= '<span class="time"><i class="ion-android-alarm-clock"></i>' . wpems_event_start( 'g:i a' ) . ' - ' . wpems_event_end( 'g:i a' ) . '</span>';
					} elseif ( class_exists( 'TP_Event' ) ) {
						$html .= '<span class="start"><i class="ion-android-alarm-clock"></i>' . tp_event_start( 'g:i a' ) . '-' . tp_event_end( 'g:i a' ) . '</span>';
					}

					if ( $event_email ) {
						$html .= '<span class="email"><i class="ion-email"></i>' . esc_attr( $event_email ) . '</span>';
					}

					if ( $event_phone ) {
						$html .= '<span class="phone"><i class="ion-ios-telephone"></i>' . esc_attr( $event_phone ) . '</span>';
					}


					$html .= '		</div>';
					$html .= '	</div>';

					$html .= '</div>';

				}

			}
			echo ent2ncr( $html );
			?>
		</div>
	</div>

<?php wp_reset_postdata(); ?>