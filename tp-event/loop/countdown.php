<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$current_time = date( 'Y-m-d H:i' );
$time         = tp_event_get_time( 'Y-m-d H:i', null, false ); ?>
<div class="entry-countdown">

	<?php
	if ( function_exists( 'tp_event_get_timezone_string' ) ) {
		$date = new DateTime( date( 'Y-m-d H:i', strtotime( $time ) ) );
	} ?>
	<div class="tp_event_counter" data-time="<?php echo isset( $date ) ? esc_attr( $date->format( 'M j, Y H:i:s O' ) ) : esc_attr( tp_event_get_time( 'M j, Y H:i:s O', null, false ) ) ?>"></div>

</div>

