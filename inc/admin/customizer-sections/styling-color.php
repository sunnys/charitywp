<?php
/**
 * Section Footer Setting
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'styling_color',
	'panel'    => 'styling',
	'title'    => esc_html__( 'Background Color & Text Color', 'charitywp' ),
	'priority' => 1,
) );

thim_customizer()->add_field(
	array(
		'id'        => 'body_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Body Background Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Body background color', 'charitywp' ),
		'section'   => 'styling_color',
		'default'   => '#ffffff',
		'priority'  => 2,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body',
				'property' => 'background-color',
			)
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'body_primary_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Theme Primary Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Primary background color', 'charitywp' ),
		'section'   => 'styling_color',
		'default'   => '#f8b864',
		'priority'  => 12,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim-button.style3, #back-to-top, .thim-button.style3,
				.donate_counter_percent',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
    array(
        'id'        => 'body_secondary_color',
        'type'      => 'color',
        'label'     => esc_html__( 'Theme Secondary Color', 'charitywp' ),
        'tooltip'   => esc_html__( 'Secondary background color', 'charitywp' ),
        'section'   => 'styling_color',
        'default'   => '#6442ff',
        'priority'  => 15,
        'choices'   => array( 'alpha' => true ),
        'transport' => 'postMessage',
    )
);