<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="entry-content">
	<?php the_excerpt(); ?>
</div>

<div class="entry-meta">
	<div class="date">
		<div class="day"><?php echo wpems_event_start('d'); ?></div>
		<div class="month"><?php echo wpems_event_start('M'); ?></div>
	</div>
	<div class="metas">
		<div class="time"><i class="fa fa-clock-o"></i> <?php echo wpems_event_start('h:i a'); ?> - <?php echo wpems_event_end('h:i a'); ?></div>
		<div class="location"><i class="fa fa-map-marker"></i> <?php echo wpems_event_location(); ?></div>
	</div>
</div>