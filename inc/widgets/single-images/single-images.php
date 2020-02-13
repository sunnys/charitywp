<?php
class Thim_Single_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'single-images',
			__( 'Thim: Single Images', 'charitywp' ),
			array(
				'description' => esc_html__( 'Add single image', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-format-image'
			),
			array(),
			array(
				'title' => array(
					'type'  => 'text',
 					'label' => esc_html__( 'Title', 'charitywp' )
				),
				'subtitle' => array(
					'type'  => 'text',
 					'label' => esc_html__( 'Sub title', 'charitywp' )
				),
				'description' => array(
					'type'  => 'textarea',
 					'label' => esc_html__( 'Description', 'charitywp' )
				),
				'image' => array(
					'type'  => 'media',
 					'label' => esc_html__( 'Image', 'charitywp' ),
					'description'  => esc_html__( 'Select image from media library.', 'charitywp' )
				),
				'image_size'         => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Image size', 'charitywp' ),
 					'description'    => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'charitywp' )
				),
				'image_link'         => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Image Link', 'charitywp' ),
					'description'    => esc_html__( 'Enter URL if you want this image to have a link.', 'charitywp' )
				),
				'link_target'       => array(
					"type"    => "select",
					"label"   => esc_html__( "Link Target", 'charitywp' ),
 					"options" => array(
						"_self"              => esc_html__( "Same window", 'charitywp' ),
						"_blank" => esc_html__( "New window", 'charitywp' ),
 					),
				),
				'image_alignment'       => array(
					"type"    => "select",
					"label"   => esc_html__( "Image alignment", 'charitywp' ),
					"description"=> esc_html__("Select image alignment.", 'charitywp'),
					"options" => array(
						"left"              => esc_html__( "Align Left", 'charitywp' ),
						"right" => esc_html__( "Align Right", 'charitywp' ),
						"center" => esc_html__( "Align Center", 'charitywp' )
					),
				),
				'effect_hover'       => array(
					"type"    => "select",
					"label"   => esc_html__( "Hover Effect", 'charitywp' ),
					"options" => array(
						"effect-hover"  => esc_html__( "Yes", 'charitywp' ),
						"no-effect" 	=> esc_html__( "No", 'charitywp' ),
					),
					'default'	=> 'effect-hover'
				),
			),
			THIM_DIR . 'inc/widgets/single-images/'
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
function thim_single_images_register_widget() {
	register_widget( 'Thim_Single_Images_Widget' );
}

add_action( 'widgets_init', 'thim_single_images_register_widget' );