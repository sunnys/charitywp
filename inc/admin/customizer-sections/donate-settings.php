<?php
/**
 * Section Donate Setting
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'donate_setting',
	'panel'    => 'donate',
	'title'    => esc_html__( 'Settings', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'id'       => 'donate_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Archive Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for donate archive pages.', 'charitywp' ),
	'section'  => 'donate_setting',
	'default'  => 'sidebar-right',
	'priority' => 11,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'donate_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image top header for Donate archive page', 'charitywp' ),
	'section'  => 'donate_setting',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 12,
) );

thim_customizer()->add_field( array(
	'type'     => 'number',
	'id'       => 'donate_per_page',
	'label'    => esc_attr__( 'Number of donate per Page', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select number show on Donate page.', 'charitywp' ),
	'section'  => 'donate_setting',
	'default'  => 9,
	'choices'  => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
	'priority' => 13,
) );

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'donate_layout_filter',
		'label'    => esc_html__( 'Layout Donate', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the layout type for donate archive page.', 'charitywp' ),
		'default'  => 'grid',
		'priority' => 14,
		'multiple' => 0,
		'section'  => 'donate_setting',
		'choices'  => array(
			'grid' => esc_html__( 'Grid', 'charitywp' ),
			'list' => esc_html__( 'List', 'charitywp' ),
		),
	)
);