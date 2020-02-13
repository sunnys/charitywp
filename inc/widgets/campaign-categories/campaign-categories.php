<?php
/**
 * Created by: Khoapq
 * Created Date: 07/03/2016
 */
class thim_campaign_categories_widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'campaign-categories',
			__( 'Thim: Campaign Categories', 'charitywp' ),
			array(
				'description' => esc_html__( 'Display campaign categories', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-heart'
			),
			array(),
			array(

				'title'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Title', 'charitywp' ),
					'default' => ''
				),	

				'show_all'      => array(
					"type"    => "select",
					"label"   => esc_html__( "Show All", 'charitywp' ),
					'default' => 'show',
					"options" => array(
						"show" => esc_html__( "Show", 'charitywp' ),
						"hidden"  => esc_html__( "Hidden", 'charitywp' ),
					),
				),	

				'show_count'      => array(
					"type"    => "select",
					"label"   => esc_html__( "Show Count", 'charitywp' ),
					'default' => 'show',
					"options" => array(
						"show" => esc_html__( "Show", 'charitywp' ),
						"hidden"  => esc_html__( "Hidden", 'charitywp' ),
					),
				),	

			),
			THIM_DIR . 'inc/widgets/campaign-categories/'
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
function thim_campaign_categories_widget_register() {
	register_widget( 'thim_campaign_categories_widget' );
}

add_action( 'widgets_init', 'thim_campaign_categories_widget_register' );