<?php
/**
 * Created by: Khoapq
 * Created Date: 09/11/2015
 */
class thim_events_widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'events',
			__( 'Thim: Events', 'charitywp' ),
			array(
				'description' => esc_html__( 'Display events', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-groups'
			),
			array(),
			array(

				'title'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Title', 'charitywp' ),
					'default' => ''
				),

				'number'      => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Numbers', 'charitywp' ),
					'default' => '3'
				),


				'status'      	=> array(
					"type"    	=> "select",
					"label"   	=> esc_html__( "Status", 'charitywp' ),
					'default'	=> 'tp-event-happenning',
					"options" 	=> array(
						"tp-event-happenning"  	=> esc_html__( "Happening", 'charitywp' ),
						"tp-event-upcoming"   	=> esc_html__( "Upcoming", 'charitywp' ),
						"tp-event-expired"  	=> esc_html__( "Expired", 'charitywp' ),
					),
				),

				'orderby'      	=> array(
					"type"    	=> "select",
					"label"   	=> esc_html__( "Order by", 'charitywp' ),
					"options" 	=> array(
						"recent"  				=> esc_html__( "Recent", 'charitywp' ),
						"title"   				=> esc_html__( "Title", 'charitywp' ),
						"random"  				=> esc_html__( "Random", 'charitywp' ),
						"tp_event_date_start"  	=> esc_html__( "Date Start", 'charitywp' ),
						"tp_event_date_end"  	=> esc_html__( "Date End", 'charitywp' ),
					),
				),

				'order'        	=> array(
					"type"    	=> "select",
					"label"   	=> esc_html__( "Order", 'charitywp' ),
					"options" 	=> array(
						"asc"  	=> esc_html__( "ASC", 'charitywp' ),
						"desc" 	=> esc_html__( "DESC", 'charitywp' )
					),
				),


				'template'	=> array(
					'type' 		=> 'select', 
					'label'		=> esc_html__( 'Template', 'charitywp' ),
					'default'	=> 'base',
					'options'	=> array(
						'base' 		=> esc_html__('Default', 'charitywp'), 
						'style2' 	=> esc_html__('Style 2', 'charitywp'), 
						'style3' 	=> esc_html__('Style 3 - Simple List', 'charitywp'), 
						'style4' 	=> esc_html__('Style 4 - Slider', 'charitywp'),
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'template' )
					)
				),

                'thumbnail_size'        => array(
                    'type'    => 'text',
                    'label'   => esc_html__( 'Thumbnail size', 'charitywp' ),
                    'default' => '475x276',
                    'state_handler' => array(
                        'template[base]'        => array( 'hide' ),
                        'template[style2]'		=> array( 'hide' ),
                        'template[style3]'      => array( 'hide' ),
                        'template[style4]'      => array( 'show' ),
                    ),
                ),


				'default_option' => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Options', 'charitywp' ),
					'hide'          => true,
					'state_handler' => array(
						'template[base]'        => array( 'hide' ),
						'template[style2]'		=> array( 'show' ),
						'template[style3]'      => array( 'hide' ),
						'template[style4]'      => array( 'hide' ),
					),
					'fields'        => array(
						'columns' 	=> array(
							'type'	=> 'select',
							'label'	=> esc_html__('Columns', 'charitywp'),
							'default'	=> '2',
							'options'	=> array(
								'1'		=> esc_html__('1', 'charitywp'),
								'2'		=> esc_html__('2', 'charitywp'),
								'3'		=> esc_html__('3', 'charitywp'),
								'4'		=> esc_html__('4', 'charitywp'),
								'5'		=> esc_html__('5', 'charitywp'),
								'6'		=> esc_html__('6', 'charitywp'),
								'7'		=> esc_html__('7', 'charitywp'),
								'8'		=> esc_html__('8', 'charitywp'),
								'9'		=> esc_html__('9', 'charitywp'),
								'10'	=> esc_html__('10', 'charitywp'),
								'11'	=> esc_html__('11', 'charitywp'),
								'12'	=> esc_html__('12', 'charitywp'),
							),
						),
					)
				),

			),
			THIM_DIR . 'inc/widgets/events/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		return isset($instance['template']) ? $instance['template'] : 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}
function thim_events_widget_register() {
	register_widget( 'thim_events_widget' );
}

add_action( 'widgets_init', 'thim_events_widget_register' );