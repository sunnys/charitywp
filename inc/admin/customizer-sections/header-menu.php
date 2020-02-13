<?php
/**
 * Section Header Menu
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_header_menu_setting',
	'panel'    => 'display_header',
	'title'    => esc_html__( 'Menu Settings', 'charitywp' ),
	'priority' => 3,
) );

thim_customizer()->add_field(
	array(
		'id'        => 'header_menu_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Menu Background', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for menu.', 'charitywp' ),
		'section'   => 'display_header_menu_setting',
		'default'   => 'rgba(255,255,255,0)',
		'priority'  => 4,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header .thim-menu,
				.thim_header_custom_style.thim_header_style3 header.site-header .thim-menu,
				.thim_header_custom_style.thim_header_style4 header.site-header .thim-menu,
				.thim_header_custom_style.thim_header_default .thim-menu',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Menu Text Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Header menu text color for menu.', 'charitywp' ),
		'section'   => 'display_header_menu_setting',
		'default'   => '#ffffff',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.thim_header_custom_style header.site-header .main-menu .disable_link,
					.thim_header_custom_style header.site-header .main-menu .menu-item a,
					.thim_header_custom_style.thim_header_default .thim-menu,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item a',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_menu_link_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Menu Hover Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Header menu hover color for menu.', 'charitywp' ),
		'section'   => 'display_header_menu_setting',
		'default'   => '#f8b864',
		'priority'  => 6,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.thim_header_custom_style header.site-header .main-menu .menu-item a:hover,
					.thim_header_custom_style header.site-header .main-menu .menu-item.current-menu-item > a,
					.thim_header_custom_style header.site-header .main-menu .disable_link:hover,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item.current-menu-item > a,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children > a:hover,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item-has-children .disable_link:hover,
					.thim_header_custom_style.thim_header_default .thim-menu .main-menu .menu-item a:hover,
					.thim_header_custom_style header.site-header .thim-menu .main-menu .navbar-nav > .menu-item .icon-toggle',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'main_menu',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts', 'charitywp' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for header menu. ', 'charitywp' ),
		'section'   => 'display_header_menu_setting',
		'priority'  => 7,
		'default'   => array(
			'font-family' => 'Open Sans',
			'variant'     => '700',
			'font-size'   => '13px'
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
		)
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'header_menu_line',
		'label'    => esc_html__( 'Menu item line settings', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show line between menu items.', 'charitywp' ),
		'default'  => 'not_line',
		'priority' => 8,
		'multiple' => 0,
		'section'  => 'display_header_menu_setting',
		'choices'  => array(
			'line'     => 'Display Line',
			'double'   => 'Display Double',
			'dot'      => 'Display Dot',
			'not_line' => 'No',
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_line_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Line Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Color for line between menu items.', 'charitywp' ),
		'section'   => 'display_header_menu_setting',
		'default'   => '#ffffff',
		'priority'  => 9,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.thim_header_custom_style header.site-header.line .thim-menu .main-menu .navbar-nav>.menu-item>a>span:before
				',
				'property' => 'background',
			)
		)
	)
);