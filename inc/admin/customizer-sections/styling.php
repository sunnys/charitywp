<?php
/**
 * Panel Styling
 *
 * @package Charity
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'styling',
		'priority' => 4,
		'title'    => esc_html__( 'Styling', 'charitywp' ),
        'icon'     => 'dashicons-art',
	)
);

