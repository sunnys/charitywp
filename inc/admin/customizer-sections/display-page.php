<?php
/**
 * Section Display Page
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_page',
	'panel'    => 'display',
	'title'    => esc_html__( 'Page', 'charitywp' ),
	'priority' => 3,
) );

thim_customizer()->add_field( array(
	'id'       => 'page_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Page Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for all pages.', 'charitywp' ),
	'section'  => 'display_page',
	'default'  => 'full-content',
	'priority' => 4,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'page_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Slect top image file for header all page.', 'charitywp' ),
	'section'  => 'display_page',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 5,
) );
