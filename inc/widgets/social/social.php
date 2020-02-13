<?php

class Thim_Social_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'social',
			__( 'Thim: Social Links', 'charitywp' ),
			array(
				'description' => esc_html__( 'Social Links', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title'          => array(
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'charitywp' )
				),
				'link_face'      => array(
					'type'  => 'text',
					'label' => esc_html__( 'Facebook Url', 'charitywp' )
				),
				'link_twitter'   => array(
					'type'  => 'text',
					'label' => esc_html__( 'Twitter Url', 'charitywp' )
				),
				'link_google'    => array(
					'type'  => 'text',
					'label' => esc_html__( 'Google Url', 'charitywp' )
				),
				'link_dribble'   => array(
					'type'  => 'text',
					'label' => esc_html__( 'Dribble Url', 'charitywp' )
				),
				'link_linkedin'  => array(
					'type'  => 'text',
					'label' => esc_html__( 'Linked in Url', 'charitywp' )
				),
				'link_pinterest' => array(
					'type'  => 'text',
					'label' => esc_html__( 'Pinterest Url', 'charitywp' )
				),
				'link_digg'      => array(
					'type'  => 'text',
					'label' => esc_html__( 'Digg Url', 'charitywp' )
				),
				'link_youtube'   => array(
					'type'  => 'text',
					'label' => esc_html__( 'Youtube Url', 'charitywp' )
				),
				'link_instagram'   => array(
					'type'  => 'text',
					'label' => esc_html__( 'Instagram Url', 'charitywp' )
				),
				'link_flickr'   => array(
					'type'  => 'text',
					'label' => esc_html__( 'Flickr Url', 'charitywp' )
				),

				'link_target'    => array(
					"type"    => "select",
					"label"   => esc_html__( "Link Target", 'charitywp' ),
					"options" => array(
						"_self"  => esc_html__( "Same window", 'charitywp' ),
						"_blank" => esc_html__( "New window", 'charitywp' ),
					),
				),

				'style'    => array(
					"type"    => "select",
					"label"   => esc_html__( "Style", 'charitywp' ),
					"options" => array(
						"default"  => esc_html__( "Default", 'charitywp' ),
						"color" => esc_html__( "Colors", 'charitywp' ),
					),
				),

				'align'	=> array(
					'type'		=> 'select',
					'label' 	=> esc_html__( 'Align', 'charitywp' ),
					'default'	=> 'left',
					'options' 	=> array(
						'left' 	=> esc_html__('Left', 'charitywp'),
						'right' 	=> esc_html__('Right', 'charitywp'),
						'center' 	=> esc_html__('Center', 'charitywp'),
					)
				),

			),
			THIM_DIR . 'inc/widgets/social/'
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

function thim_social_register_widget() {
	register_widget( 'Thim_Social_Widget' );
}

add_action( 'widgets_init', 'thim_social_register_widget' );