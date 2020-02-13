<?php
/**
 * Section Sticky Header Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_header_sticky_settings',
	'panel'    => 'display_header',
	'title'    => esc_html__( 'Sticky Header', 'charitywp' ),
	'priority' => 2,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'header_fixed_menu',
		'type'     => 'switch',
		'label'    => esc_html__( 'Menu Sticky', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off menu sticky when up scroll mouse.', 'charitywp' ),
		'section'  => 'display_header_sticky_settings',
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
		'id'        => 'header_sticky_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Sticky Background', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for menu sticky.', 'charitywp' ),
		'section'   => 'display_header_sticky_settings',
		'default'   => '#ffffff',
		'priority'  => 4,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header.menu-show .top-header',
				'property' => 'background-color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_fixed_menu',
                'operator' => '==',
                'value'    => true,
            ),
        ),

	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_sticky_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Text/Link Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Header text color for menu sticky.', 'charitywp' ),
		'section'   => 'display_header_sticky_settings',
		'default'   => '#333333',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .disable_link,
					.thim_header_custom_style header.site-header .main-menu .menu-item a,
					.thim_header_custom_style.thim_header_default .thim-menu,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item a',
				'property' => 'color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_fixed_menu',
                'operator' => '==',
                'value'    => true,
            ),
        ),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_sticky_link_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Text/Link Color Hover', 'charitywp' ),
		'tooltip'   => esc_html__( 'Header text color for menu sticky hover.', 'charitywp' ),
		'section'   => 'display_header_sticky_settings',
		'default'   => '#f8b864',
		'priority'  => 6,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item a:hover,
					.thim_header_custom_style header.site-header .main-menu .menu-item.current-menu-item > a,
					.thim_header_custom_style header.site-header .main-menu .disable_link:hover,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item.current-menu-item > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a:hover,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link:hover,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item a:hover,
					.thim_header_custom_style header.site-header .thim-menu .main-menu .navbar-nav > .menu-item .icon-toggle',
				'property' => 'background-color',
			)
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_fixed_menu',
                'operator' => '==',
                'value'    => true,
            ),
        ),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_sticky_typography',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts', 'charitywp' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for header sticky. ', 'charitywp' ),
		'section'   => 'display_header_sticky_settings',
		'priority'  => 7,
		'default'   => array(
			'font-family' => 'Open Sans',
			'variant'     => '700',
			'font-size'   => '13px',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-family',
				'element'  => '
					.thim_header_custom_style header.site-header .main-menu,
					.thim_header_custom_style.thim_header_default .thim-menu,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link
				',
				'property' => 'font-family',
			),
			array(
				'choice'   => 'variant',
				'element'  => '
					.thim_header_custom_style header.site-header .main-menu,
					.thim_header_custom_style.thim_header_default .thim-menu,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link
				',
				'property' => 'font-weight',
			),
			array(
				'choice'   => 'font-size',
				'element'  => '
					.thim_header_custom_style header.site-header .main-menu,
					.thim_header_custom_style.thim_header_default .thim-menu,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link
				',
				'property' => 'font-size',
			),
		),
        'active_callback' => array(
            array(
                'setting'  => 'header_fixed_menu',
                'operator' => '==',
                'value'    => true,
            ),
        ),
	)
);