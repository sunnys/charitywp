<?php
/**
 * Section Event Sharing
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'event_share',
	'panel'    => 'event',
	'title'    => esc_html__( 'Sharing', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'event_sharing_facebook',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Facebook', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the facebook sharing option in event.', 'charitywp' ),
		'section'  => 'event_share',
		'default'  => false,
		'priority' => 11,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'event_sharing_twitter',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Twitter', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Twitter sharing option in event.', 'charitywp' ),
		'section'  => 'event_share',
		'default'  => false,
		'priority' => 12,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'event_sharing_google',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Google Plus', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Google Plus sharing option in event.', 'charitywp' ),
		'section'  => 'event_share',
		'default'  => false,
		'priority' => 13,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'id'       => 'event_sharing_pinterest',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Pinterest', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Pinterest sharing option in event.', 'charitywp' ),
		'section'  => 'event_share',
		'default'  => false,
		'priority' => 14,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);
thim_customizer()->add_field(
	array(
		'id'       => 'event_sharing_fancy',
		'type'     => 'switch',
		'label'    => esc_html__( 'Hidden Fancy', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show the Fancy sharing option in event.', 'charitywp' ),
		'section'  => 'event_share',
		'default'  => false,
		'priority' => 15,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

