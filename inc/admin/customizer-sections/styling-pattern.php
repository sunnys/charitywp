<?php
/**
 * Section Footer Setting
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'styling_pattern',
	'panel'    => 'styling',
	'title'    => esc_html__( 'Pattern', 'charitywp' ),
	'priority' => 4,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'user_bg_pattern',
		'type'     => 'switch',
		'label'    => esc_html__( 'Background Pattern', 'charitywp' ),
		'tooltip'  => esc_html__( 'Check the box to display a pattern in the background. If checked, select the pattern from below.', 'charitywp' ),
		'section'  => 'styling_pattern',
		'default'  => false,
		'priority' => 5,
		'choices'  => array(
			true  => esc_html__( 'Show', 'charitywp' ),
			false => esc_html__( 'Hidden', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field( array(
	'id'       => 'bg_pattern',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Select Pattern', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a pattern for site.', 'charitywp' ),
	'section'  => 'styling_pattern',
	'default'  => THIM_URI . '/images/patterns/pattern1.png',
	'priority' => 6,
	'choices'  => array(
		THIM_URI . 'assets/images/patterns/pattern1.png'  => THIM_URI . 'assets/images/patterns/pattern1_icon.png',
		THIM_URI . 'assets/images/patterns/pattern2.png'  => THIM_URI . 'assets/images/patterns/pattern2_icon.png',
		THIM_URI . 'assets/images/patterns/pattern3.png'  => THIM_URI . 'assets/images/patterns/pattern3_icon.png',
		THIM_URI . 'assets/images/patterns/pattern4.png'  => THIM_URI . 'assets/images/patterns/pattern4_icon.png',
		THIM_URI . 'assets/images/patterns/pattern5.png'  => THIM_URI . 'assets/images/patterns/pattern5_icon.png',
		THIM_URI . 'assets/images/patterns/pattern6.png'  => THIM_URI . 'assets/images/patterns/pattern6_icon.png',
		THIM_URI . 'assets/images/patterns/pattern7.png'  => THIM_URI . 'assets/images/patterns/pattern7_icon.png',
		THIM_URI . 'assets/images/patterns/pattern8.png'  => THIM_URI . 'assets/images/patterns/pattern8_icon.png',
		THIM_URI . 'assets/images/patterns/pattern9.png'  => THIM_URI . 'assets/images/patterns/pattern9_icon.png',
		THIM_URI . 'assets/images/patterns/pattern10.png' => THIM_URI . 'assets/images/patterns/pattern10_icon.png',
		THIM_URI . 'assets/images/patterns/pattern11.png' => THIM_URI . 'assets/images/patterns/pattern11_icon.png',
		THIM_URI . 'assets/images/patterns/pattern12.png' => THIM_URI . 'assets/images/patterns/pattern12_icon.png',
		THIM_URI . 'assets/images/patterns/pattern13.png' => THIM_URI . 'assets/images/patterns/pattern13_icon.png',
		THIM_URI . 'assets/images/patterns/pattern14.png' => THIM_URI . 'assets/images/patterns/pattern14_icon.png',
		THIM_URI . 'assets/images/patterns/pattern15.png' => THIM_URI . 'assets/images/patterns/pattern15_icon.png',
		THIM_URI . 'assets/images/patterns/pattern16.png' => THIM_URI . 'assets/images/patterns/pattern16_icon.png',
		THIM_URI . 'assets/images/patterns/pattern17.png' => THIM_URI . 'assets/images/patterns/pattern17_icon.png',
		THIM_URI . 'assets/images/patterns/pattern18.png' => THIM_URI . 'assets/images/patterns/pattern18_icon.png',
		THIM_URI . 'assets/images/patterns/pattern19.png' => THIM_URI . 'assets/images/patterns/pattern19_icon.png',
		THIM_URI . 'assets/images/patterns/pattern20.png' => THIM_URI . 'assets/images/patterns/pattern20_icon.png',
		THIM_URI . 'assets/images/patterns/pattern21.png' => THIM_URI . 'assets/images/patterns/pattern21_icon.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'bg_pattern_upload',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Background Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image for background site.', 'charitywp' ),
	'section'  => 'styling_pattern',
	'priority' => 7,
) );

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'bg_repeat',
		'label'    => esc_html__( 'Background Repeat', 'charitywp' ),
		'tooltip'  => esc_html__( 'Select background repeat.', 'charitywp' ),
		'default'  => 'repeat',
		'priority' => 8,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'repeat'    => esc_html__( 'repeat', 'charitywp' ),
			'repeat-x'  => esc_html__( 'repeat-x', 'charitywp' ),
			'repeat-y'  => esc_html__( 'repeat-y', 'charitywp' ),
			'no-repeat' => esc_html__( 'no-repeat', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'bg_position',
		'label'    => esc_html__( 'Background Position', 'charitywp' ),
		'tooltip'  => esc_html__( 'Select type background position.', 'charitywp' ),
		'default'  => 'center center',
		'priority' => 9,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'left top'      => esc_html__( 'Left Top', 'charitywp' ),
			'left center'   => esc_html__( 'Left Center', 'charitywp' ),
			'left bottom'   => esc_html__( 'Left Bottom', 'charitywp' ),
			'right top'     => esc_html__( 'Right Top', 'charitywp' ),
			'right center'  => esc_html__( 'Right Center', 'charitywp' ),
			'right bottom'  => esc_html__( 'Right Bottom', 'charitywp' ),
			'center top'    => esc_html__( 'Center Top', 'charitywp' ),
			'center center' => esc_html__( 'Center Center', 'charitywp' ),
			'center bottom' => esc_html__( 'Center Bottom', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'bg_attachment',
		'label'    => esc_html__( 'Background Attachment', 'charitywp' ),
		'tooltip'  => esc_html__( 'Select background attachment for site.', 'charitywp' ),
		'default'  => 'inherit',
		'priority' => 10,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'scroll'  => esc_html__( 'scroll', 'charitywp' ),
			'fixed'   => esc_html__( 'fixed', 'charitywp' ),
			'local'   => esc_html__( 'local', 'charitywp' ),
			'initial' => esc_html__( 'initial', 'charitywp' ),
			'inherit' => esc_html__( 'inherit', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'bg_size',
		'label'    => esc_html__( 'Background Size', 'charitywp' ),
		'tooltip'  => esc_html__( 'Select background size for site.', 'charitywp' ),
		'default'  => 'cover',
		'priority' => 11,
		'multiple' => 0,
		'section'  => 'styling_pattern',
		'choices'  => array(
			'100% 100%' => esc_html__( '100% 100%', 'charitywp' ),
			'contain'   => esc_html__( 'contain', 'charitywp' ),
			'cover'     => esc_html__( 'cover', 'charitywp' ),
			'inherit'   => esc_html__( 'inherit', 'charitywp' ),
			'initial'   => esc_html__( 'initial', 'charitywp' ),
		),
	)
);