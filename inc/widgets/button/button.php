<?php

class Thim_Button_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'button',
			esc_html__( 'Thim: Button', 'charitywp' ),
			array(
				'description' => esc_html__( 'Button', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(

				'text'	=> array(
					'type'		=> 'text',
					'label' 	=> esc_html__( 'Text', 'charitywp' ),
					'default'	=> esc_html__( 'Button Text', 'charitywp' )
				),


				'link'	=> array(
					'type'		=> 'text',
					'label' 	=> esc_html__( 'Link', 'charitywp' ),
					'default'	=> esc_html__( '#', 'charitywp' )
				),

				'align'	=> array(
					'type'		=> 'select',
					'label' 	=> esc_html__( 'Align', 'charitywp' ),
					'default'	=> 'left',
					'options' 	=> array(
						'left' 	=> esc_html__('Left', 'charitywp'),
						'right' 	=> esc_html__('Right', 'charitywp'),
						'center' 	=> esc_html__('Center', 'charitywp')
					)
				),

				'style'	=> array(
					'type'		=> 'select',
					'label' 	=> esc_html__( 'Style', 'charitywp' ),
					'default'	=> 'default',
					'options' 	=> array(
						'default' 	=> esc_html__('Default', 'charitywp'),
						'style2' 	=> esc_html__('Style 2', 'charitywp'),
						'style3' 	=> esc_html__('Style 3', 'charitywp'),
						'style4' 	=> esc_html__('Style 4', 'charitywp'),
						'style5' 	=> esc_html__('Style 5', 'charitywp'),
						'style6' 	=> esc_html__('Style 6', 'charitywp'),
						'style7' 	=> esc_html__('Style 7', 'charitywp'),
						'style8' 	=> esc_html__('Style 8', 'charitywp'),
					)
				),


				'size'	=> array(
					'type'		=> 'select',
					'label' 	=> esc_html__( 'Sizes', 'charitywp' ),
					'default'	=> 'default',
					'options' 	=> array(
						'default' 	=> esc_html__('Default button', 'charitywp'),
						'large' 	=> esc_html__('Large button', 'charitywp'),
					)
				),


				'button_option'         => array(
					'type'   => 'section',
					'label'  => esc_html__( 'Custom Style', 'charitywp' ),
					'hide'   => true,
					'fields' => array(

						'custom'	=> array(
							'type'		=> 'select',
							'label' 	=> esc_html__( 'Custom Style', 'charitywp' ),
							'default'	=> 'no',
							'options' 	=> array(
								'no' 	=> esc_html__('No', 'charitywp'),
								'yes' 	=> esc_html__('Yes', 'charitywp')
							)
						),

						'button_color'      => array(
							'type'  => 'color',
							'label' => esc_html__( 'Button Color', 'charitywp' ),
							'default'	=> '#333'
						),

						'text_color'      => array(
							'type'  => 'color',
							'label' => esc_html__( 'Text Color', 'charitywp' ),
							'default'	=> '#FFF'
						),

						'button_hover_color'      => array(
							'type'  => 'color',
							'label' => esc_html__( 'Button Hover Color', 'charitywp' ),
							'default'	=> '#999'
						),

						'text_hover_color'      => array(
							'type'  => 'color',
							'label' => esc_html__( 'Text Hover Color', 'charitywp' ),
							'default'	=> '#FFF'
						),
					),
				),

			),
			THIM_DIR . 'inc/widgets/button/'
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

function thim_button_register_widget() {
	register_widget( 'Thim_Button_Widget' );
}

add_action( 'widgets_init', 'thim_button_register_widget' );