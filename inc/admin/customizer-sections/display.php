<?php
/**
 * Panel Display
 *
 * @package Charity
 */
thim_customizer()->add_panel(
	array(
		'id'       => 'display',
		'priority' => 5,
		'title'    => esc_html__( 'Display', 'charitywp' ),
        'icon'     => 'dashicons-welcome-view-site'
	)
);