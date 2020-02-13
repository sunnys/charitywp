<?php
/**
 * Created by: Khoapq
 * Date: 15/10/2015
 */
class Thim_Accordion_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'accordion',
			esc_html__( 'Thim: Accordion', 'charitywp' ),
			array(
				'description' => esc_html__( 'Add Accordion', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-list-view'
			),
			array(),
			array(
				'title' => array(
					'type' => 'text',
					'label' => esc_html__('Title', 'charitywp'),
					'default' => ''
				),

				'panel' => array(
					'type' => 'repeater',
					'label' => esc_html__('Panel List', 'charitywp'),
					'item_name' => esc_html__('Panel', 'charitywp'),
					'fields' => array(
						'panel_title' => array(
							'type' => 'text',
							'label' => esc_html__('Panel Title', 'charitywp'),
						),

						'panel_body' => array(
							'type' => 'textarea',
							'allow_html_formatting' => true,
							'label' => esc_html__('Panel Body', 'charitywp'),
						),
					),
				),

				'expand_first' => array(
					'type' => 'select',
					'label' => esc_html__('Expand First Item', 'charitywp'),
					'default' => 'true',
					'options' => array(
						'true' => esc_html__('Yes', 'charitywp'), 
						'false' => esc_html__('No', 'charitywp'), 
					)
				),

			),
			THIM_DIR . 'inc/widgets/accordion/'
		);

		
	}


	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}

function thim_accordion_register_widget() {
	register_widget( 'Thim_Accordion_Widget' );
}

add_action( 'widgets_init', 'thim_accordion_register_widget' );