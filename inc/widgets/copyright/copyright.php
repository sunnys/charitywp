<?php

class Thim_Copyright_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'copyright',
			__( 'Thim: Copyright', 'charitywp' ),
			array(
				'description' => esc_html__( 'Display copyright text', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'text_align'  => array(
					"type"    => "select",
					"label"   => esc_html__( "Text Align", 'charitywp' ),
					"options" => array(
						"left"  	=> esc_html__( "Left", 'charitywp' ),
						"right" 	=> esc_html__( "Right", 'charitywp' ),
						"center"  	=> esc_html__( "Center", 'charitywp' ),
					),
				),

			),
			THIM_DIR . 'inc/widgets/copyright/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}

function thim_copyright_register_widget() {
	register_widget( 'Thim_Copyright_Widget' );
}

add_action( 'widgets_init', 'thim_copyright_register_widget' );