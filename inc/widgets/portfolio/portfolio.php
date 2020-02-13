<?php

class Thim_Portfolio_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'portfolio',
			esc_html__( 'Thim Portfolio', 'charitywp' ),
			array(
				'description'   => esc_html__( 'Show Post', 'charitywp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'category'        => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Select Category', 'charitywp' ),
					'default' => 'all',
					'options' => $this->portfolio_category()
				),
				'filter'          => array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Enable Filter', 'charitywp' ),
					'default'     => true,
					'description' => esc_html__( 'Turn on/off filter portfolio', 'charitywp' )
				),
				'portfolio_style' => array(
					'type'        => 'select',
					'label'       => esc_html__( 'Portfolio Style', 'charitywp' ),
					'description' => esc_html__( 'Select portfolio style', 'charitywp' ),
					'options'     => array(
						'same_size'  => esc_html__( 'Same size', 'charitywp' ),
						'multi_grid' => esc_html__( 'Multi Grid', 'charitywp' ),
						'masonry'    => esc_html__( 'Masonry', 'charitywp' )
					),
					'default'     => 'masonry'
				),
				'gutter'          => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Gutter', 'charitywp' ),
					'default' => 20
				),
				'columns'         => array(
					'type'    => 'slider',
					'label'   => esc_html__('Columns', 'charitywp'),
					'default' => 3,
					'min'     => 1,
					'max'     => 5
				),
				'number_posts' => array(
					'type' => 'number',
					'label' => esc_html__( 'Number Posts', 'charitywp' ),
					'default' => 16
				)
			),
			THIM_DIR . 'inc/widgets/portfolio/'
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

	function portfolio_category() {
		$category_name['all'] = esc_html__( 'All', 'charitywp' );
		$args        = array(
			'taxonomy'      => 'portfolio_category',
		);
		$categories = get_categories( $args );
		foreach($categories as $category) {
			$category_name[$category->slug] = $category->name;
		}
		return $category_name;
	}
}

function thim_portfolio_widget_register() {
	register_widget( 'Thim_Portfolio_Widget' );
}

add_action( 'widgets_init', 'thim_portfolio_widget_register' );