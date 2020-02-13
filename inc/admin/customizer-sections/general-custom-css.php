<?php
/**
 * Section Custom CSS
 * 
 * @package Thim_Starter_Theme
 */

thim_customizer()->add_section(
	array(
		'id'       => 'custom_css',
		'panel'    => 'general',
        'title' => esc_html__('Custom CSS', 'charitywp'),
		'priority' => 100,
	)
);