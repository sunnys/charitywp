<?php
class Thim_Counters_Box_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'counters-box',
			esc_html__( 'Thim: Counters Box', 'charitywp' ),
			array(
				'description' => esc_html__( 'Counters Box', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon'   => 'dashicons dashicons-performance'
			),
			array(),
			array(

				'counters_label'   => array(
					"type"    => "text",
					"label"   => esc_html__( "Counters label", 'charitywp' ),
				),

				'before_counters_value'   => array(
					"type"    => "text",
					"label"   => esc_html__( "Text Before Counters Value", 'charitywp' ),
					'default' => '',
				),

				'counters_value'   => array(
					"type"    => "number",
					"label"   => esc_html__( "Counters Value", 'charitywp' ),
					"default" => "20",
				),

				'display_number'   => array(
					"type"    => "number",
					"label"   => esc_html__( "Length Of Number", 'charitywp' ),
					"default" => "2",
				),

				'icon'   => array(
					"type"    => "icon",
					"label"   => esc_html__( "Icon", 'charitywp' ),
				),
				'border_color'   => array(
					"type"    => "color",
					"label"   => esc_html__( "Border Color Icon", 'charitywp' ),
				),

				'counter_color'   => array(
					"type"    => "color",
					"label"   => esc_html__( "Counters Box Icon", 'charitywp' ),
				),

				'show_line' => array(
					"type"    => "select",
					"label"   => esc_html__( "Show Line", 'charitywp' ),
					"options" => array(
						"no-line"       => esc_html__( "No", 'charitywp' ),
						"line-in-right" => esc_html__( "Line in Right", 'charitywp' ),
						"line-in-bottom" => esc_html__( "Line in Bottom", 'charitywp' ),
					),
				),

				'padding' => array(
					"type"    => "select",
					"label"   => esc_html__( "Padding", 'charitywp' ),
					'default' => 'has-padding',
					"options" => array(
						"no-padding"       => esc_html__( "No Padding", 'charitywp' ),
						"has-padding" => esc_html__( "Has Padding", 'charitywp' ),
					),
				),
			),
			THIM_DIR . 'inc/widgets/counters-box/'
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

function thim_counters_box_widget() {
	register_widget( 'Thim_Counters_Box_Widget' );
}

add_action( 'widgets_init', 'thim_counters_box_widget' );