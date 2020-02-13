<?php
/**
 * Section Our Team Settings
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'our_team_single',
	'panel'    => 'our_team',
	'title'    => esc_html__( 'Settings', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'id'       => 'our_team_layout',
	'type'     => 'radio-image',
	'label'    => esc_html__( 'Layout Our Team', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you to choose a layout for all our team pages.', 'charitywp' ),
	'section'  => 'our_team_single',
	'default'  => 'full-content',
	'priority' => 11,
	'choices'  => array(
		'full-content'  => THIM_URI . 'assets/images/admin/layout/body-full.png',
		'sidebar-left'  => THIM_URI . 'assets/images/admin/layout/sidebar-left.png',
		'sidebar-right' => THIM_URI . 'assets/images/admin/layout/sidebar-right.png',
	),
) );

thim_customizer()->add_field( array(
	'id'       => 'our_team_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Select Image top header for our team page.', 'charitywp' ),
	'section'  => 'our_team_single',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 12,
) );

thim_customizer()->add_field( array(
	'type'    => 'number',
	'id'      => 'our_team_post_per_page',
	'label'   => esc_attr__( 'Number of our team per Page', 'charitywp' ),
	'tooltip' => esc_html__( 'Select number show on our team page.', 'charitywp' ),
	'section' => 'our_team_single',
	'default' => 16,
	'choices' => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
	'priority' => 13,
) );

thim_customizer()->add_field( array(
	'type'    => 'number',
	'id'      => 'our_team_post_per_row',
	'label'   => esc_attr__( 'Number row', 'charitywp' ),
	'tooltip' => esc_html__( 'Select number row on out team page.', 'charitywp' ),
	'section' => 'our_team_single',
	'default' => 4,
	'choices' => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
	'priority' => 13,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'our_team_display_link',
		'type'     => 'switch',
		'label'    => esc_html__( 'Link To Detail', 'charitywp' ),
		'tooltip'  => esc_html__( 'Link To Detail Our Team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_facebook',
		'type'     => 'switch',
		'label'    => esc_html__( 'Facebook', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Facebook sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_twitter',
		'type'     => 'switch',
		'label'    => esc_html__( 'Twitter', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Twitter sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_rss',
		'type'     => 'switch',
		'label'    => esc_html__( 'RSS', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the RSS sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_skype',
		'type'     => 'switch',
		'label'    => esc_html__( 'Skype', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Skype sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_dribbble',
		'type'     => 'switch',
		'label'    => esc_html__( 'Dribbble', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Dribbble sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_linkedin',
		'type'     => 'switch',
		'label'    => esc_html__( 'Linkedin', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Linkedin sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_phone',
		'type'     => 'switch',
		'label'    => esc_html__( 'Phone', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Phone sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_email',
		'type'     => 'switch',
		'label'    => esc_html__( 'Email', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Email sharing option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
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
		'id'       => 'our_team_display_content',
		'type'     => 'switch',
		'label'    => esc_html__( 'Content', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the content option in our team.', 'charitywp' ),
		'section'  => 'our_team_single',
		'default'  => false,
		'priority' => 15,
		'choices'  => array(
			true  => esc_html__( 'Show', 'charitywp' ),
			false => esc_html__( 'Hidden', 'charitywp' ),
		),
	)
);