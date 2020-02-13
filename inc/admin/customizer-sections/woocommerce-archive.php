<?php
/**
 * Section Archive
 *
 * @package Charity
 */

thim_customizer()->add_section(
	array(
		'id'       => 'woo_archive',
		'panel'    => 'woocommerce',
		'title'    => esc_html__( 'Archive Pages', 'charitywp' ),
		'priority' => 10,
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'woo_archive_layout',
		'type'     => 'radio-image',
		'label'    => esc_html__( 'Archive Layouts', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you to choose a layout for all products archive pages.', 'charitywp' ),
		'section'  => 'woo_archive',
		'priority' => 12,
		'default'  => 'full-content',
		'choices'  => array(
			'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
			'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
			'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'      => 'kirki-image',
		'id'        => 'woo_archive_top_image',
		'label'     => esc_html__( 'Top Image', 'charitywp' ),
		'priority'  => 30,
		'transport' => 'postMessage',
		'section'   => 'woo_archive',
		'default'   => THIM_URI . "assets/images/page_top_image.jpg",
	)
);
