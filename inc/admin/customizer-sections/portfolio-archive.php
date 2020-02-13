<?php
/**
 * Section Our Team Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'portfolio_archive',
	'panel'    => 'display_portfolio',
	'title'    => esc_html__( 'Archive Portfolio', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'id'       => 'portfolio_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Archive Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for portfolio archive page.', 'charitywp' ),
	'section'  => 'portfolio_archive',
	'default'  => 'full-content',
	'priority' => 11,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'portfolio_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image top header for portfolio archive page.', 'charitywp' ),
	'section'  => 'portfolio_archive',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 12,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'portfolio_filter',
		'type'     => 'switch',
		'label'    => esc_html__( 'Portfolio Filter', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off portfolio filter.', 'charitywp' ),
		'section'  => 'portfolio_archive',
		'default'  => false,
		'priority' => 15,
		'choices'  => array(
			true  => esc_html__( 'Show', 'charitywp' ),
			false => esc_html__( 'Hidden', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'portfolio_style',
		'label'    => esc_html__( 'Style Portfolio', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the style portfolio page.', 'charitywp' ),
		'default'  => 'same_width',
		'priority' => 13,
		'multiple' => 0,
		'section'  => 'portfolio_archive',
		'choices'  => array(
			'same_width' => esc_html__( 'Same width', 'charitywp' ),
			'multi_grid' => esc_html__( 'Multi Grid', 'charitywp' ),
			'masonry'    => esc_html__( 'Masonry', 'charitywp' )
		),
	)
);

thim_customizer()->add_field( array(
	'type'     => 'number',
	'id'       => 'portfolio_gutter',
	'label'    => esc_attr__( 'Gutter', 'charitywp' ),
	'tooltip'  => esc_html__( 'Enter a number of px for the gutter.', 'charitywp' ),
	'section'  => 'portfolio_archive',
	'default'  => 15,
	'choices'  => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
	'priority' => 14,
) );

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'portfolio_columns',
		'label'    => esc_html__( 'Column', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the column type for portfolio page.', 'charitywp' ),
		'default'  => '3',
		'priority' => 13,
		'multiple' => 0,
		'section'  => 'portfolio_archive',
		'choices'  => array(
			'2' => esc_html__( 'Two', 'charitywp' ),
			'3' => esc_html__( 'Three', 'charitywp' ),
			'4' => esc_html__( 'Four', 'charitywp' ),
			'5' => esc_html__( 'Five', 'charitywp' ),
			'6' => esc_html__( 'Six', 'charitywp' )
		),
	)
);

thim_customizer()->add_field( array(
	'type'     => 'number',
	'id'       => 'portfolio_paging',
	'label'    => esc_attr__( 'Paging', 'charitywp' ),
	'tooltip'  => esc_html__( 'Enter a number of paging for portfolio.', 'charitywp' ),
	'section'  => 'portfolio_archive',
	'default'  => 9,
	'choices'  => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
	'priority' => 14,
) );