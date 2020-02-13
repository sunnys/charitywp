<?php
/**
 * Created By: Khoapq
 * Date: 30/09/2015
 */
class Thim_Client_Logo_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'client-logo',
			esc_html__( 'Thim: Client Logo', 'charitywp' ),
			array(
				'description' => esc_html__( 'Add client logo', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(

                'template' => array(
                    "type"    	=> "select",
                    "label"   	=> esc_html__( "Template", 'charitywp' ),
                    "default"	=> "base",
                    "options"	=> array(
                        "base"        => esc_html__( "Slider", 'charitywp' ),
                        "grid"        => esc_html__( "Grid", 'charitywp' ),
                    ),
                    'state_emitter' => array(
                        'callback' => 'select',
                        'args'     => array( 'template' )
                    )
                ),

				'image'         => array(
					'type'        => 'multimedia',
					'label'       => esc_html__( 'Logo', 'charitywp' ),
					'description' => esc_html__( 'Select image from media library.', 'charitywp' )
				),

				'image_size'    => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Logo size', 'charitywp' ),
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full"', 'charitywp' )
				),
				
				'image_link'    => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Logo Link', 'charitywp' ),
					'description' => esc_html__( 'Enter URL if you want this image to have a link. These links are separated by comma (Ex: #,#,#,#)', 'charitywp' )
				),

				'link_target'   => array(
					"type"    => "select",
					"label"   => esc_html__( "Link Target", 'charitywp' ),
					"options" => array(
						"_self"  => esc_html__( "Same window", 'charitywp' ),
						"_blank" => esc_html__( "New window", 'charitywp' ),
					),
				),

				'items'   => array(
					"type"    		=> "number",
					"label"   		=> esc_html__( "Items", 'charitywp' ),
					'description'	=> esc_html__('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'charitywp'),
					'default'		=> 5
				),

				'autoPlay'   => array(
					"type"    => "select",
					"label"   => esc_html__( "Auto Play", 'charitywp' ),
					"options" => array(
						"false"  => esc_html__( "False", 'charitywp' ),
						"true" => esc_html__( "True", 'charitywp' ),
					),
                    'state_handler' => array(
                        'template[base]' 	=> array( 'show' ),
                        'template[grid]' 	=> array( 'hide' ),
                    )
				),


			),
			THIM_DIR . 'inc/widgets/client-logo/'
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


function thim_client_logo_register_widget() {
	register_widget( 'Thim_Client_Logo_Widget' );
}

add_action( 'widgets_init', 'thim_client_logo_register_widget' );