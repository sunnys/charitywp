<?php
/**
 * Panel Header
 *
 * @package Charity
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'display_header',
		'priority' => 2,
		'title'    => esc_html__( 'Header', 'charitywp' ),
        'icon'     => 'dashicons-editor-table',
	)
);