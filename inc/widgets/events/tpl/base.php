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

	<div class="thim-events">
		<div class="events">
			<?php
			$html = '';
			if ( $events->have_posts() ) {
				while ( $events->have_posts() ) {
					$events->the_post();
					$html .= '<div class="event">';
					$html .= '	<div class="date">';
					$html .= '		<span class="day">';
					if ( class_exists( 'WPEMS' ) ) {
						$html .= wpems_event_start( 'j' );
					} elseif ( class_exists( 'TP_Event' ) ) {
						$html .= tp_event_start( 'j' );
					}
					$html .= '		</span>';
					$html .= '		<span class="month">';
					if ( class_exists( 'WPEMS' ) ) {
						$html .= wpems_event_start( 'F' );
					} elseif ( class_exists( 'TP_Event' ) ) {
						$html .= tp_event_start( 'F' );
					}

					$html .= '		</span>';
					$html .= '	</div>';

					$html .= '	<div class="content">';
					$html .= '		<a href="' . ( get_permalink( get_the_ID() ) ) . '" class="title">' . get_the_title() . '</a>';
					$html .= '		<div class="meta">';
					$html .= '			<span class="time">';
					if ( class_exists( 'WPEMS' ) ) {
						$html .= '<span class="start">' . wpems_event_start( 'H:i' ) . '</span> - <span class="end">' . wpems_event_end( 'H:i' ) . '</span>';
					} elseif ( class_exists( 'TP_Event' ) ) {
						$html .= '<span class="start">' . tp_event_start( 'H:i' ) . '</span> - <span class="end">' . tp_event_end( 'H:i' ) . '</span>';
					}

					$html .= '			</span>';
					if ( class_exists( 'WPEMS' ) ) {
						$html .= '<span class="location">' . wpems_event_location() . '</span>';
					} elseif ( class_exists( 'TP_Event' ) ) {
						$html .= '<span class="location">' . tp_event_location() . '</span>';
					}

					$html .= '		</div>';
					$html .= '	</div>';

					$html .= '	<div class="more-info"><a href="' . ( get_permalink( get_the_ID() ) ) . '" class="thim-button style4 readmore">' . esc_html__( 'Learn More', 'charitywp' ) . '</a></div>';
					$html .= '</div>';

				}

			}
			echo ent2ncr( $html );
			?>
		</div>
	</div>

<?php wp_reset_postdata(); ?>