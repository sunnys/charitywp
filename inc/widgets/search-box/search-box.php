<?php
/**
 * Created by: Khoapq
 * Created Date: 29/02/2016
 */
class thim_search_box_widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'search-box',
			__( 'Thim: Search Box', 'charitywp' ),
			array(
				'description' => esc_html__( 'Display Search Box', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(

			),
			THIM_DIR . 'inc/widgets/search-box/'
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
function thim_search_box_register_widget() {
	register_widget( 'thim_search_box_widget' );
}

add_action( 'widgets_init', 'thim_search_box_register_widget' );