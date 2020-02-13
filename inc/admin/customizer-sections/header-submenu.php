<?php
/**
 * Section Submenu Header Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_header_submenu',
	'panel'    => 'display_header',
	'title'    => esc_html__( 'Sub Menu Header', 'charitywp' ),
	'priority' => 4,
) );

thim_customizer()->add_field(
	array(
		'id'        => 'header_submenu_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Header Background Sub Menu', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for sub menu.', 'charitywp' ),
		'section'   => 'display_header_submenu',
		'default'   => '#ffffff',
		'priority'  => 5,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu',
				'property' => 'background-color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_submenu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text/Link Color Sub Menu', 'charitywp' ),
		'tooltip'   => esc_html__( 'Text color for sub menu.', 'charitywp' ),
		'section'   => 'display_header_submenu',
		'default'   => '#333333',
		'priority'  => 6,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu a,
				 .thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu .disable_link',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_submenu_link_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text/Link Sub Menu Color Hover', 'charitywp' ),
		'tooltip'   => esc_html__( 'Text color for sub menu hover.', 'charitywp' ),
		'section'   => 'display_header_submenu',
		'default'   => '#f8b864',
		'priority'  => 7,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu a:hover,
				 .thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu .disable_link:hover',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'header_submenu_typography',
		'type'      => 'typography',
		'label'     => esc_html__( 'Fonts', 'charitywp' ),
		'tooltip'   => esc_html__( 'Allows you to select all font font properties for sub menu header. ', 'charitywp' ),
		'section'   => 'display_header_submenu',
		'priority'  => 8,
		'default'   => array(
			'font-family' => 'Open Sans',
			'variant'     => '700',
			'font-size'   => '13px',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-family',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu a,
				 .thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu .disable_link',
				'property' => 'font-family',
			),
			array(
				'choice'   => 'variant',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu a,
				 .thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu .disable_link',
				'property' => 'font-weight',
			),
			array(
				'choice'   => 'font-size',
				'element'  => '.thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu a,
				 .thim_header_custom_style header.site-header .main-menu .menu-item-has-children .sub-menu .disable_link',
				'property' => 'font-size',
			),
		)
	)
);