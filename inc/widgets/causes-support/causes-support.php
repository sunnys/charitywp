<?php

class Thim_Causes_Support_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'causes-support',
			esc_html__( 'Thim: Causes Support', 'charitywp' ),
			array(
				'description' => esc_html__( 'Add Cause Support', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-list-view'
			),
			array(),
			array(
                'style' => array(
                    "type"          => "select",
                    "label"         => esc_html__( "Style", 'charitywp' ),
                    "options"       => array(
                        "base"    => esc_html__( "Default", 'charitywp' ),
                        "list"   => esc_html__( "Layout 2", 'charitywp' ),
                    ),
                    'default'       => 'base',
                    'state_emitter' => array(
                        'callback' => 'select',
                        'args'     => array( 'style' )
                    )
                ),

				'title' => array(
					'type' => 'text',
					'label' => esc_html__('Title', 'charitywp'),
					'default' => '',
                    'state_handler' => array(
                        'style[base]'    => array( 'show' ),
                        'style[list]'  => array( 'hide' ),
                    ),
				),

                'sub-title'           => array(
                    'type'    => 'text',
                    'label'   => esc_html__( 'Sub Heading', 'charitywp' ),
                    'default' => '',
                    'allow_html_formatting' => true,
                    'state_handler' => array(
                        'style[base]'    => array( 'show' ),
                        'style[list]'  => array( 'hide' ),
                    ),
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

                        'panel_sub_title' => array(
                            'type' => 'text',
                            'label' => esc_html__('Panel Sub Title', 'charitywp'),
                            'state_handler' => array(
                                'style[base]'    => array( 'hide' ),
                                'style[list]'  => array( 'show' ),
                            ),
                        ),

                        'panel_image' => array(
							'type'    => 'media',
							'label'   => esc_html__( 'Background Image', 'charitywp' ),
							'default' => '',
							'library' => 'image',
						),

                        'panel_color'           => array(
                            'type'    => 'color',
                            'label'   => esc_html__( 'Background color', 'charitywp' ),
                            'default' => '',
                        ),

                        'panel_link' => array(
                            'type' => 'text',
                            'label' => esc_html__('Panel Link', 'charitywp'),
                        ),
					),
				),

			),
			THIM_DIR . 'inc/widgets/causes-support/'
		);

		
	}


	function get_template_name( $instance ) {
        switch ( $instance['style'] ) {
            case 'list':
                $template = 'list';
                break;
            default:
                $template = 'base';
                break;
        }

        return $template;
	}

	function get_style_name( $instance ) {
		return false;
	}

}

function thim_causes_support_register_widget() {
	register_widget( 'Thim_Causes_Support_Widget' );
}

add_action( 'widgets_init', 'thim_causes_support_register_widget' );