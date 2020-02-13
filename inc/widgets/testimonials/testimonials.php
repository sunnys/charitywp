<?php
if ( class_exists( 'THIM_Testimonials' ) ) {
	class Thim_Testimonials_Widget extends Thim_Widget {
		function __construct() {
			parent::__construct(
				'testimonials',
				esc_html__( 'Thim: Testimonials', 'charitywp' ),
				array(
					'help'          => '',
					'panels_groups' => array( 'thim_widget_group' ),
					'panels_icon'   => 'dashicons dashicons-format-quote'
				),
				array(),
				array(

					'number'        => array(
						'type'    => 'number',
						'label'   => esc_html__( 'Number', 'charitywp' ),
						'default' => '4'
					),

					'item_visible'          => array(
						'type'          => 'number',
						'fallback'      => true,
						'label'         => esc_html__( 'Item Visible', 'charitywp' ),
						'default'       => '5',
						'state_handler' => array(
							'template[base]' 	=> array( 'hide' ),
							'template[style2]' 	=> array( 'hide' ),
							'template[style4]' 	=> array( 'hide' ),
							'template[style3]' 	=> array( 'show' ),
						)
					),

					'mousewheel'             => array(
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Mousewheel Scroll', 'charitywp' ),
						'default' => false,
						'state_handler' => array(
							'template[base]' 	=> array( 'hide' ),
							'template[style2]' 	=> array( 'hide' ),
							'template[style4]' 	=> array( 'hide' ),
							'template[style3]' 	=> array( 'show' ),
						)
					),

					'color'       => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Color', 'charitywp' ),
						'default' => '#FFFFFF',
						'state_handler' => array(
							'template[base]' 	=> array( 'hide' ),
							'template[style2]' 	=> array( 'hide' ),
							'template[style4]' 	=> array( 'hide' ),
							'template[style3]' 	=> array( 'show' ),
						)
					),

					'border_avatar_color'       => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Border Avatar Color', 'charitywp' ),
						'default' => '#FFFFFF',
						'state_handler' => array(
							'template[base]' 	=> array( 'hide' ),
							'template[style2]' 	=> array( 'hide' ),
							'template[style4]' 	=> array( 'hide' ),
							'template[style3]' 	=> array( 'show' ),
						)
					),

					'template' => array(
						"type"    	=> "select",
						"label"   	=> esc_html__( "Template", 'charitywp' ),
						"default"	=> "base",
						"options"	=> array(
							"base"              => esc_html__( "Default", 'charitywp' ),
							"style2"        => esc_html__( "Style 2", 'charitywp' ),
							"style3"        => esc_html__( "Style 3", 'charitywp' ),
							"style4"        => esc_html__( "Style 4", 'charitywp' )
						),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array( 'template' )
						)
					)
				),
				THIM_DIR . 'inc/widgets/testimonials/'
			);
		}

		/**
		 * Initialize the CTA widget
		 */


		function get_template_name( $instance ) {
			return $instance['template'] ?  $instance['template'] : 'base';
		}

		function get_style_name( $instance ) {
			return false;
		}

	}

	function thim_testimonials_register_widget() {
		register_widget( 'Thim_Testimonials_Widget' );
	}

	add_action( 'widgets_init', 'thim_testimonials_register_widget' );
}