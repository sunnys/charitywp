<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( wpems_event_location() && function_exists( 'wpems_get_location_map' ) ): ?>
    <div class="event-location">
		<?php wpems_get_location_map(); ?>
    </div>
<?php endif; ?>