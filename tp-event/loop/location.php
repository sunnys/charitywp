<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( tp_event_location() && function_exists( 'tp_event_get_location_map' ) ): ?>
    <div class="event-location">
		<?php tp_event_get_location_map(); ?>
    </div>
<?php endif; ?>