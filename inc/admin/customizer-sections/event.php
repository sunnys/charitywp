<?php 
/**
 * Panel Event
 *
 * @package Charity
 */
thim_customizer()->add_panel(
	array(
		'id'       => 'event',
		'priority' => 8,
		'title'    => esc_html__( 'Event', 'charitywp' ),
        'icon'     => 'dashicons-calendar-alt',
	)
);