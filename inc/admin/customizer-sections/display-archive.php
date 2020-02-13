<?php
/**
 * Section Display Archive
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_archive',
	'panel'    => 'display',
	'title'    => esc_html__( 'Blog Archive', 'charitywp' ),
	'priority' => 3,
) );

thim_customizer()->add_field( array(
	'id'       => 'blog_archive_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Archive Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for all archive pages.', 'charitywp' ),
	'section'  => 'sidebar-right',
	'default'  => 'full-content',
	'priority' => 3,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'archive_column',
		'label'    => esc_html__( 'Column', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the column type for archive page.', 'charitywp' ),
		'default'  => '2',
		'priority' => 4,
		'multiple' => 0,
		'section'  => 'display_archive',
		'choices'  => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
		),
	)
);

thim_customizer()->add_field( array(
	'id'       => 'archive_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image top header for archive page', 'charitywp' ),
	'section'  => 'display_archive',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 5,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'show_date',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Date', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off date', 'charitywp' ),
		'section'  => 'display_archive',
		'default'  => true,
		'priority' => 6,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'show_author',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Author', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off author', 'charitywp' ),
		'section'  => 'display_archive',
		'default'  => true,
		'priority' => 7,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'id'       => 'show_comment',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Comment', 'charitywp' ),
		'tooltip'  => esc_html__( 'Turn On/Off comment', 'charitywp' ),
		'section'  => 'display_archive',
		'default'  => true,
		'priority' => 8,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'custom_title',
		'label'    => esc_html__( 'Custom Title', 'charitywp' ),
		'tooltip'  => esc_html__( 'Setup custom heading for archive page.', 'charitywp' ),
		'section'  => 'display_archive',
		'priority' => 9,
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'number',
		'id'       => 'archive_excerpt_length',
		'label'    => esc_html__( 'Excerpt Length Archive', 'charitywp' ),
		'tooltip'  => esc_html__( 'Setup excerpt length for archive page.', 'charitywp' ),
		'section'  => 'display_archive',
		'default'  => 50,
		'choices'  => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 10,
		),
		'priority' => 10,
	)
);