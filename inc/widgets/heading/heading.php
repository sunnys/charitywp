<?php

class Thim_Heading_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'heading',
			__( 'Thim: Heading', 'charitywp' ),
			array(
				'description'   => esc_html__( 'Add heading text', 'charitywp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-edit'
			),
			array(),
			array(
				'title'               => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Heading Text', 'charitywp' ),
					'default' => '',
				),

				'sub-title'           => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Sub Heading', 'charitywp' ),
					'default' => '',
					'allow_html_formatting' => true,
				),
				
				'line'                => array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Show Separator', 'charitywp' ),
					'default' => false,
				),

				'show_line'                => array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Show Line', 'charitywp' ),
					'default' => false,
				),

				'textcolor'           => array(
					'type'    => 'color',
					'label'   => esc_html__( 'Text Heading color', 'charitywp' ),
					'default' => '',
				),
				'size'                => array(
					"type"    => "select",
					"label"   => esc_html__( "Size Heading", 'charitywp' ),
					"options" => array(
						"h2" => esc_html__( "h2", 'charitywp' ),
						"h3" => esc_html__( "h3", 'charitywp' ),
						"h4" => esc_html__( "h4", 'charitywp' ),
						"h5" => esc_html__( "h5", 'charitywp' ),
						"h6" => esc_html__( "h6", 'charitywp' ),
					),
					"default" => "h3"
				),

				'heading_padding'           => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Heading Padding', 'charitywp' ),
					'default' => '',
				),

				'font_heading'        => array(
					"type"          => "select",
					"label"         => esc_html__( "Font Heading", 'charitywp' ),
					"default"       => "default",
					"options"       => array(
						"default" => esc_html__( "Default", 'charitywp' ),
						"custom"  => esc_html__( "Custom", 'charitywp' )
					),
					"description"   => esc_html__( "Select Font heading.", 'charitywp' ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'font_heading_type' )
					)
				),
				'custom_font_heading' => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Custom Font Heading', 'charitywp' ),
					'hide'          => true,
					'state_handler' => array(
						'font_heading_type[custom]'  => array( 'show' ),
						'font_heading_type[default]' => array( 'hide' ),
					),
					'fields'        => array(
						'custom_font_size'   => array(
							"type"        => "number",
							"label"       => esc_html__( "Font Size", 'charitywp' ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => esc_html__( "custom font size", 'charitywp' ),
							"class"       => "color-mini",
						),
						'custom_font_weight' => array(
							"type"        => "select",
							"label"       => esc_html__( "Custom Font Weight", 'charitywp' ),
							"options"     => array(
								"normal" => esc_html__( "Normal", 'charitywp' ),
								"bold"   => esc_html__( "Bold", 'charitywp' ),
								"100"    => esc_html__( "100", 'charitywp' ),
								"200"    => esc_html__( "200", 'charitywp' ),
								"300"    => esc_html__( "300", 'charitywp' ),
								"400"    => esc_html__( "400", 'charitywp' ),
								"500"    => esc_html__( "500", 'charitywp' ),
								"600"    => esc_html__( "600", 'charitywp' ),
								"700"    => esc_html__( "700", 'charitywp' ),
								"800"    => esc_html__( "800", 'charitywp' ),
								"900"    => esc_html__( "900", 'charitywp' )
							),
							"description" => esc_html__( "Select Custom Font Weight", 'charitywp' ),
							"class"       => "color-mini",
						),
						'custom_font_style'  => array(
							"type"        => "select",
							"label"       => esc_html__( "Custom Font Style", 'charitywp' ),
							"options"     => array(
								"inherit" => esc_html__( "inherit", 'charitywp' ),
								"initial" => esc_html__( "initial", 'charitywp' ),
								"italic"  => esc_html__( "italic", 'charitywp' ),
								"normal"  => esc_html__( "normal", 'charitywp' ),
								"oblique" => esc_html__( "oblique", 'charitywp' )
							),
							"description" => esc_html__( "Select Custom Font Style", 'charitywp' ),
							"class"       => "color-mini",
						),
					),
				),

				'align'       => array(
					"type"    => "select",
					"label"   => esc_html__( "Align", 'charitywp' ),
					"options" => array(
						"center"  	=> esc_html__( "Center", 'charitywp' ),
						"left"		=> esc_html__( "Left", 'charitywp' ),
						"right" 	=> esc_html__( "Right", 'charitywp' )
					),
				),

			),
			THIM_DIR . 'inc/widgets/heading/'
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

function thim_heading_register_widget() {
	register_widget( 'Thim_Heading_Widget' );
}

add_action( 'widgets_init', 'thim_heading_register_widget' );