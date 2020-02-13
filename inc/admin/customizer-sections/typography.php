<?php
/**
 * Panel Styling
 *
 * @package Charity
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'typography',
		'priority' => 5,
		'title'    => esc_html__( 'Typography', 'charitywp' ),
        'icon'     => 'dashicons-edit',
	)
);
