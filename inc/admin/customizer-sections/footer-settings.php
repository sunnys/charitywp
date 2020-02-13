<?php
/**
 * Section Footer Setting
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_footer_settings',
	'panel'    => 'display_footer',
	'title'    => esc_html__( 'Footer Settings', 'charitywp' ),
	'priority' => 9,
) );

thim_customizer()->add_field(
	array(
		'id'       => 'show_to_top',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show To Top', 'charitywp' ),
		'tooltip'  => esc_html__( 'Show or hide back to top.', 'charitywp' ),
		'section'  => 'display_footer_settings',
		'default'  => true,
		'priority' => 11,
		'choices'  => array(
			true  => esc_html__( 'On', 'charitywp' ),
			false => esc_html__( 'Off', 'charitywp' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'footer_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Footer Background Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Background color for footer.', 'charitywp' ),
		'section'   => 'display_footer_settings',
		'default'   => '#2b2b2b',
		'priority'  => 12,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'footer',
				'property' => 'background',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'footer_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Footer Text Color', 'charitywp' ),
		'tooltip'   => esc_html__( 'Text color for footer.', 'charitywp' ),
		'section'   => 'display_footer_settings',
		'default'   => '#999999',
		'priority'  => 13,
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'footer ul li a, footer .widget a:hover, footer .fa, footer .text-copyright, footer .text-copyright a:hover',
				'property' => 'color',
			)
		)
	)
);