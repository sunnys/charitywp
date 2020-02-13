<?php
/**
 * Section Our Team Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'portfolio_single',
	'panel'    => 'display_portfolio',
	'title'    => esc_html__( 'Single Portfolio', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'id'       => 'portfolio_single_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Archive Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for all archive pages.', 'charitywp' ),
	'section'  => 'portfolio_single',
	'default'  => 'full-content',
	'priority' => 11,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );