<?php
/**
 * Section Toolbar Header Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_header_toolbar_settings',
	'panel'    => 'display_header',
	'title'    => esc_html__( 'Toolbar Header', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'header_toolbar_show',
		'type'     => 'switch',
		'label'    => esc_html__( 'Header Toolbar', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off toolbar header.', 'charitywp' ),
		'section'  => 'display_header_toolbar_settings',
		'default'  => false,
		'priority' => 1,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_toolbar_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Toolbar Background', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for toolbar.', 'charitywp' ),
		'section'   => 'display_header_toolbar_settings',
		'default'   => '#ffffff',
		'priority'  => 11,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.toolbar-sidebar',
				'property' => 'background-color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_toolbar_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),

	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_toolbar_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Text color for toolbar.', 'charitywp' ),
		'section'   => 'display_header_toolbar_settings',
		'default'   => '#333333',
		'priority'  => 11,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.toolbar-sidebar',
				'property' => 'color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_toolbar_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_toolbar_link_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Link Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Link color for toolbar.', 'charitywp' ),
		'section'   => 'display_header_toolbar_settings',
		'default'   => '#f8b864',
		'priority'  => 11,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.toolbar-sidebar a',
				'property' => 'color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_toolbar_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_toolbar_a_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text/Link Color Hover', 'charitywp' ),
		'tooltip'   => esc_html__( 'Text color for text toolbar hover.', 'charitywp' ),
		'section'   => 'display_header_toolbar_settings',
		'default'   => '#f8b864',
		'priority'  => 11,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.toolbar-sidebar a:hover',
				'property' => 'color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_toolbar_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),
	)
);

