<?php
/**
 * Panel General
 * 
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'general',
		'priority' => 1,
        'title' => esc_html__('General', 'charitywp'),
		'icon'     => 'dashicons-admin-generic',
	)
);