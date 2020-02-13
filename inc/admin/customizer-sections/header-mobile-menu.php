<?php 
/**
 * Section Header Menu Mobile
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_header_mobile_menu',
	'panel'    => 'display_header',
	'title'    => esc_html__( 'Mobile Menu', 'charitywp' ),
	'priority' => 11,
) );

thim_customizer()->add_field(
	array(
		'id'        => 'header_mobile_menu_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Menu Mobile Background', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for menu mobile.', 'charitywp' ),
		'section'   => 'display_header_mobile_menu',
		'default'   => '#343434',
		'priority'  => 11,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body.thim-active-menu>.thim-menu',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_mobile_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Mobile Menu Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Header mobile menu text color for mobile menu.', 'charitywp' ),
		'section'   => 'display_header_mobile_menu',
		'default'   => '#ffffff',
		'priority'  => 12,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body > .thim-menu .main-menu .menu-item a,
				body > .thim-menu .main-menu .menu-item span.icon-toggle',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_mobile_menu_link_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Mobile Menu Link Hover', 'charitywp' ),
		'tooltip'   => esc_html__( 'Mobile menu link hover for menu.', 'charitywp' ),
		'section'   => 'display_header_mobile_menu',
		'default'   => '#f8b864',
		'priority'  => 13,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body > .thim-menu .main-menu .menu-item.current-menu-item > a,
				 body > .thim-menu .main-menu .menu-item.current-menu-item span.icon-toggle,
				 body > .thim-menu .main-menu .menu-item:hover a,
				 body > .thim-menu .main-menu .menu-item:focus a,
				 body > .thim-menu .main-menu .menu-item:hover span.icon-toggle,
				 body > .thim-menu .main-menu .menu-item:focus span.icon-toggle',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'mobile_menu',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts Mobile Menu', 'charitywp' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for mobile menu. ', 'charitywp' ),
		'section'   => 'display_header_mobile_menu',
		'priority'  => 14,
		'default'   => array(
			'font-family' => 'Roboto',
			'variant'     => '600',
			'font-size'   => '13px',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-family',
				'element'  => 'body>.thim-menu .main-menu .navbar-nav>.menu-item>a',
				'property' => 'font-family',
			),
			array(
				'choice'   => 'variant',
				'element'  => 'body>.thim-menu .main-menu .navbar-nav>.menu-item>a',
				'property' => 'font-weight',
			),
			array(
				'choice'   => 'font-size',
				'element'  => 'body>.thim-menu .main-menu .navbar-nav>.menu-item>a',
				'property' => 'font-size',
			),
		)
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'header_mobile_menu_line',
		'label'    => esc_html__( 'Line', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show line between menu mobile items.', 'charitywp' ),
		'default'  => 'not_line',
		'priority' => 15,
		'multiple' => 0,
		'section'  => 'display_header_mobile_menu',
		'choices'  => array(
			'mobile-line' => 'Display Line',
			'mobile-dot'  => 'Display Dot',
			'not_line'    => 'No',
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_mobile_menu_line_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Line Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Line color for line bottom menu mobile items.', 'charitywp' ),
		'section'   => 'display_header_mobile_menu',
		'default'   => '#f3f3f3',
		'priority'  => 16,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'body > .thim-menu.mobile-line .main-menu .menu-item',
				'property' => 'border-color',
			)
		)
	)
);