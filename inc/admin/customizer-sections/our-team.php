<?php
/**
 * Panel Our Team
 *
 * @package Charity
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'our_team',
		'priority' => 9,
		'title'    => esc_html__( 'Our Team', 'charitywp' ),
        'icon'     => 'dashicons-groups',
	)
);