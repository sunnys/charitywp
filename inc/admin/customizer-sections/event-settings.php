<?php
/**
 * Section Event Setting
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'event_setting',
	'panel'    => 'event',
	'title'    => esc_html__( 'Settings', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'id'       => 'event_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Archive Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for event archive pages.', 'charitywp' ),
	'section'  => 'event_setting',
	'default'  => 'sidebar-right',
	'priority' => 11,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'event_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image top header for Event Archive Page', 'charitywp' ),
	'section'  => 'event_setting',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 12,
) );

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'event_column',
		'label'    => esc_html__( 'Column', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the column type for event archive page.', 'charitywp' ),
		'default'  => '3',
		'priority' => 13,
		'multiple' => 0,
		'section'  => 'event_setting',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
		),
	)
);