<?php
/**
 * Section Header Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_header_settings',
	'panel'    => 'display_header',
	'title'    => esc_html__( 'Header Settings', 'charitywp' ),
	'priority' => 1,
) );

thim_customizer()->add_field( array(
	'id'       => 'header_style',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Header Syle', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a style for header.', 'charitywp' ),
	'section'  => 'display_header_settings',
	'default'  => 'style2',
	'priority' => 2,
	'choices'  => array(
		'default' => THIM_URI . '/assets/images/admin/header/default.jpg',
		'style2'  => THIM_URI . '/assets/images/admin/header/style2.jpg',
		'style3'  => THIM_URI . '/assets/images/admin/header/style3.jpg',
		'style4'  => THIM_URI . '/assets/images/admin/header/style4.jpg',
	),
) );

thim_customizer()->add_field(
	array(
		'id'       => 'header_overlay',
		'type'     => 'switch',
		'label'    => esc_html__( 'Header Overlay', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off header overlay.', 'charitywp' ),
		'section'  => 'display_header_settings',
		'default'  => true,
		'priority' => 3,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Background', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for header.', 'charitywp' ),
		'section'   => 'display_header_settings',
		'default'   => 'rgba(255,255,255,0)',
		'priority'  => 4,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Text Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Text color for header.', 'charitywp' ),
		'section'   => 'display_header_settings',
		'default'   => '#ffffff',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_link_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Color Hover', 'charitywp' ),
		'tooltip'   => esc_html__( 'Header color hover for header.', 'charitywp' ),
		'section'   => 'display_header_settings',
		'default'   => '#f8b864',
		'priority'  => 6,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'header a',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_typography',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts', 'charitywp' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for header. ', 'charitywp' ),
		'section'   => 'display_header_settings',
		'priority'  => 7,
		'default'   => array(
			'font-family' => 'Open Sans',
			'variant'     => '700',
			'font-size'   => '13px',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'variant',
				'element'  => 'header',
				'property' => 'font-weight',
			),
			array(
				'choice'   => 'font-size',
				'element'  => 'header',
				'property' => 'font-size',
			),
		)
	)
);

// Logo width
thim_customizer()->add_field(
	array(
		'id'        => 'header_sidebar_width',
		'type'      => 'dimension',
		'label'     => esc_html__( 'Header Sidebar Width', 'charitywp' ),
		'tooltip'   => esc_html__( 'Max-width of sidebar (px) -- i.e: 185px, 3em, 48%, 90vh etc.', 'charitywp' ),
		'section'   => 'display_header_settings',
		'default'   => '185px',
		'priority'  => 8,
		'choices'   => array(
			'min'  => 1,
			'max'  => 1000,
			'step' => 1,
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.thim_header_custom_style.thim_header_style2 header.site-header .top-header .top-sidebar',
				'property' => 'width',
			)
		)
	)
);

thim_customizer()->add_field(
    array(
        'type'     => 'select',
        'id'       => 'header_bottom_line',
        'label'    => esc_html__( 'Line Horizontal Settings', 'charitywp' ),
        'tooltip'  => esc_html__( 'Show line bottom header.', 'charitywp' ),
        'default'  => 'header_not_line',
        'priority' => 80,
        'multiple' => 0,
        'section'  => 'display_header_settings',
        'choices'  => array(
            'header_line'     => 'Display Line',
            'header_dot'      => 'Display Dot',
            'header_not_line' => 'No',
        ),
    )
);