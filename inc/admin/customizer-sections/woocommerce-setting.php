<?php
/**
 * Section Settings
 *
 * @package Charity
 */

thim_customizer()->add_section(
	array(
		'id'       => 'woo_setting',
		'panel'    => 'woocommerce',
		'title'    => esc_html__( 'Settings', 'charitywp' ),
		'priority' => 20,
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'woo_product_column',
		'label'    => esc_html__( 'Grid Columns', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the number grid columns for product.', 'charitywp' ),
		'default'  => '4',
		'priority' => 10,
		'multiple' => 0,
		'section'  => 'woo_setting',
		'choices'  => array(
			'2' => esc_html__( '2', 'charitywp' ),
			'3' => esc_html__( '3', 'charitywp' ),
			'4' => esc_html__( '4', 'charitywp' ),
			'5' => esc_html__( '5', 'charitywp' ),
			'6' => esc_html__( '6', 'charitywp' ),
		),
	)
);

// Product per page
thim_customizer()->add_field(
	array(
		'id'       => 'woo_product_per_page',
		'type'     => 'slider',
		'label'    => esc_html__( 'Products Per Page', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the number of products per page.', 'charitywp' ),
		'priority' => 30,
		'default'  => 8,
		'section'  => 'woo_setting',
		'choices'  => array(
			'min'  => '1',
			'max'  => '20',
			'step' => '1',
		),
	)
);

// Enable or disable quick view
thim_customizer()->add_field(
	array(
		'id'       => 'woo_set_show_qv',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Quick View', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you to enable or disable quick view.', 'charitywp' ),
		'section'  => 'woo_setting',
		'default'  => true,
		'priority' => 40,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);
