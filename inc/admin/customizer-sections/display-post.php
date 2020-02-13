<?php
/**
 * Section Display Post
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_post',
	'panel'    => 'display',
	'title'    => esc_html__( 'Single Post', 'charitywp' ),
	'priority' => 4,
) );

thim_customizer()->add_field( array(
	'id'       => 'blog_single_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Single Layout', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for all post.', 'charitywp' ),
	'section'  => 'display_post',
	'default'  => 'sidebar-right',
	'priority' => 5,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'single_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select top image file for top image all post.', 'charitywp' ),
	'section'  => 'display_post',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 6,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'single_show_date',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Date', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you can hidden or show date.', 'charitywp' ),
		'section'  => 'display_post',
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
		'id'       => 'single_show_author',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Author', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you can hidden or show author.', 'charitywp' ),
		'section'  => 'display_post',
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
		'id'       => 'single_show_category',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Category', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you can hidden or show category.', 'charitywp' ),
		'section'  => 'display_post',
		'default'  => true,
		'priority' => 9,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'id'       => 'single_show_comment',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Comment', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you can hidden or show comment.', 'charitywp' ),
		'section'  => 'display_post',
		'default'  => true,
		'priority' => 10,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'single_related_show',
		'type'     => 'switch',
		'label'    => esc_html__( 'Single Related Show', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you can hidden or show single related.', 'charitywp' ),
		'section'  => 'display_post',
		'default'  => true,
		'priority' => 11,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field( array(
	'type'     => 'number',
	'id'       => 'single_related_number',
	'label'    => esc_attr__( 'Number of single related post', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select number show on single related post.', 'charitywp' ),
	'section'  => 'display_post',
	'default'  => 3,
	'choices'  => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
	'priority' => 13,
) );

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'single_related_column',
		'label'    => esc_html__( 'Column', 'charitywp' ),
		'tooltip'  => esc_html__( 'Choose the column type for single related column.', 'charitywp' ),
		'default'  => '3',
		'priority' => 14,
		'multiple' => 0,
		'section'  => 'display_post',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
		),
	)
);