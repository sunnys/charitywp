<?php
/**
 * Section Display Front Page
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_frontpage',
	'panel'    => 'display',
	'title'    => esc_html__( 'Post Page', 'charitywp' ),
	'priority' => 2,
) );

thim_customizer()->add_field( array(
	'id'       => 'front_page_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Archive Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for all archive pages.', 'charitywp' ),
	'section'  => 'display_frontpage',
	'default'  => 'sidebar-right',
	'priority' => 3,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'front_page_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image top header for archive page', 'charitywp' ),
	'section'  => 'display_frontpage',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 5,
) );

