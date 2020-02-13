<?php

class Google_Map_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'google-map',
			__( 'Thim: Google Maps', 'charitywp' ),
			array(
				'description'   => esc_html__( 'A Google Maps widget.', 'charitywp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'title'      => array(
					'type'        => 'text',
					'label'       => __( 'Title', 'charitywp' ),
					'description' => __( 'Enter your title', 'charitywp' )
				),
				'map_center' => array(
					'type'        => 'textarea',
					'rows'        => 2,
					'label'       => __( 'Map center', 'charitywp' ),
					'description' => __( 'The name of a place, town, city, or even a country. Can be an exact address too.', 'charitywp' )
				),
				'api_key'    => array(
					'type'        => 'text',
					'label'       => __( 'Google Map API Key', 'charitywp' ),
					'description' => __( 'Enter your Google Map API Key. Refer on https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key', 'charitywp' ),
					'default'     => 'AIzaSyAJLBZVWXcdMJF3oHiSZH3gKRRdlzp4aTM',
				),
				'settings'   => array(
					'type'        => 'section',
					'label'       => __( 'Settings', 'charitywp' ),
					'hide'        => false,
					'description' => __( 'Set map display options.', 'charitywp' ),
					'fields'      => array(
						'height'      => array(
							'type'    => 'text',
							'default' => 480,
							'label'   => __( 'Height', 'charitywp' )
						),
						'zoom'        => array(
							'type'        => 'slider',
							'label'       => __( 'Zoom level', 'charitywp' ),
							'description' => __( 'A value from 0 (the world) to 21 (street level).', 'charitywp' ),
							'min'         => 0,
							'max'         => 21,
							'default'     => 12,
							'integer'     => true,

						),
						'scroll_zoom' => array(
							'type'        => 'checkbox',
							'default'     => true,
							'state_name'  => 'interactive',
							'label'       => __( 'Scroll to zoom', 'charitywp' ),
							'description' => __( 'Allow scrolling over the map to zoom in or out.', 'charitywp' )
						),
						'draggable'   => array(
							'type'        => 'checkbox',
							'default'     => true,
							'state_name'  => 'interactive',
							'label'       => __( 'Draggable', 'charitywp' ),
							'description' => __( 'Allow dragging the map to move it around.', 'charitywp' )
						)
					)
				),
				'markers'    => array(
					'type'        => 'section',
					'label'       => __( 'Markers', 'charitywp' ),
					'hide'        => true,
					'description' => __( 'Use markers to identify points of interest on the map.', 'charitywp' ),
					'fields'      => array(
						'marker_at_center' => array(
							'type'    => 'checkbox',
							'default' => true,
							'label'   => __( 'Show marker at map center', 'charitywp' )
						),
						'marker_icon'      => array(
							'type'        => 'media',
							'default'     => '',
							'label'       => __( 'Marker Icon', 'charitywp' ),
							'description' => __( 'Replaces the default map marker with your own image.', 'charitywp' )
						),

						'marker_positions' => array(
							'type'      => 'repeater',
							'label'     => __( 'Marker positions', 'charitywp' ),
							'item_name' => __( 'Marker', 'charitywp' ),
							'fields'    => array(
								'place' => array(
									'type'  => 'textarea',
									'rows'  => 2,
									'label' => __( 'Place', 'charitywp' )
								)
							)
						)
					)
				),
			)
		);
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-google-map', THIM_URI . '/inc/widgets/google-map/js/js-google-map.js', array( 'jquery' ), true );
	}

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

	function get_template_variables( $instance, $args ) {
		$settings = $instance['settings'];
		$markers  = $instance['markers'];
		$mrkr_src = wp_get_attachment_image_src( $instance['markers']['marker_icon'] );
		//$api_key = ( !empty( $instance['api_key'] ) ) ? $instance['api_key'] : 'AIzaSyAVv2tyh3rLYN0bQlLPyUWkPgGohVUyixE';
		$api_key = ( ! empty( $instance['api_key'] ) ) ? $instance['api_key'] : '';
		{
			return array(
				'map_id'   => md5( $instance['map_center'] ),
				'height'   => $settings['height'],
				'map_data' => array(
					'address'          => $instance['map_center'],
					'zoom'             => $settings['zoom'],
					'scroll-zoom'      => $settings['scroll_zoom'],
					'draggable'        => $settings['draggable'],
					'marker-icon'      => ! empty( $mrkr_src ) ? $mrkr_src[0] : '',
					'marker-at-center' => $markers['marker_at_center'],
					'marker-positions' => isset( $markers['marker_positions'] ) ? json_encode( $markers['marker_positions'] ) : '',
					'api-key'          => $api_key
				)
			);
		}
	}
}

function thim_google_map_widget() {
	register_widget( 'Google_Map_Widget' );
}

add_action( 'widgets_init', 'thim_google_map_widget' );