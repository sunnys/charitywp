<?php
/**
 * Section Display Loading
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_loading',
	'panel'    => 'display',
	'title'    => esc_html__( 'Loading', 'charitywp' ),
	'priority' => 11,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'display_loading_show',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Loading', 'charitywp' ),
		'tooltip'  => esc_html__( 'Check this box to show/hidden loading.', 'charitywp' ),
		'section'  => 'display_loading',
		'default'  => true,
		'priority' => 12,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'display_loading_bg',
		'type'      => 'color',
		'label'     => esc_html__( 'Background Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for loading', 'charitywp' ),
		'section'   => 'display_loading',
		'default'   => '#ffffff',
		'priority'  => 13,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim-loading',
				'property' => 'background',
			)
		)
	)
);

thim_customizer()->add_field( array(
	'id'       => 'loading_logo',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Loading Logo', 'charitywp' ),
	'tooltip'  => esc_html__( 'Before image when loading page', 'charitywp' ),
	'section'  => 'display_loading',
	'default'  => THIM_URI . 'assets/images/loading.gif',
	'priority' => 14,
) );