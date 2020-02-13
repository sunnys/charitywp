<?php

class Thim_List_Post_Widget extends Thim_Widget {
	function __construct() {

		parent::__construct(
			'list-post',
			__( 'Thim: List Posts', 'charitywp' ),
			array(
				'description'   => esc_html__( 'Show Post', 'charitywp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),

			),
			array(),
			array(
				'title'        => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Title', 'charitywp' ),
					'default' => esc_html__( "From Blog", 'charitywp' )
				),

				'cat_id' => array(
					'type' 		=> 'select',
					'label'		=> esc_html__('Select Categories', 'charitywp'),
					'default'	=> 'none',
					'options'	=> $this->thim_get_categories()
				),

				'number_posts' => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Number Post', 'charitywp' ),
					'default' => '3'
				),

				'orderby'      => array(
					"type"    => "select",
					"label"   => esc_html__( "Order by", 'charitywp' ),
					"options" => array(
						"popular" => esc_html__( "Popular", 'charitywp' ),
						"recent"  => esc_html__( "Recent", 'charitywp' ),
						"title"   => esc_html__( "Title", 'charitywp' ),
						"random"  => esc_html__( "Random", 'charitywp' ),
					),
				),

				'order'        => array(
					"type"    => "select",
					"label"   => esc_html__( "Order by", 'charitywp' ),
					"options" => array(
						"asc"  => esc_html__( "ASC", 'charitywp' ),
						"desc" => esc_html__( "DESC", 'charitywp' )
					),
				),

				'date' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Date', 'charitywp' ),
					'default' => 'show',
					'options' => array(
						'show'		=> esc_html__('Show','charitywp'),
						'hidden'	=> esc_html__('Hidden','charitywp'),
					)
				),

				'template' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Template', 'charitywp' ),
					'default' => 'base',
					'options' => array(
						'base'		=> esc_html__('Default','charitywp'),
						'style2'	=> esc_html__('Style 2','charitywp'),
						'style3'    => esc_html__('Style 3','charitywp'),
						'style4'    => esc_html__('Style 4','charitywp')
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'template' )
					)
				),

				'columns'      => array(
					'type'    => 'number',
					'label'   => esc_html__( 'Columns', 'charitywp' ),
					'default' => '3',
					'state_handler' => array(
						'template[base]'    => array( 'hide' ),
						'template[style2]' 	=> array( 'show' ),
						'template[style3]'  => array( 'show' ),
						'template[style4]'  => array( 'hide' )
					),
				),
				'button_text'   => array(
					'type' => 'text',
					'label' => esc_html__( 'Button Text', 'charitywp' ),
					'default' => 'Read More',
					'state_handler' => array(
						'template[base]'    => array( 'hide' ),
						'template[style2]' 	=> array( 'show' ),
						'template[style3]'  => array( 'show' ),
                        'template[style4]'  => array( 'hide' )
					)
				)

			),
			THIM_DIR . 'inc/widgets/list-post/'
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

    // Get list category
    function thim_get_categories(){
    	$args = array(
		  'orderby' 	=> 'id',
		  'parent' 		=> 0
		 );
		$items = array();
		$items['all'] = '---------';
		$categories = get_categories( $args );
		if (isset($categories)) {
			foreach ($categories as $key => $cat) {
				$items[$cat -> cat_ID] = $cat -> cat_name;
				$childrens = get_term_children($cat->term_id, $cat->taxonomy);
				if ($childrens){
					foreach ($childrens as $key => $children) {
						$child = get_term_by( 'id', $children, $cat->taxonomy);
						$items[$child->term_id] = '--'.$child->name;

					}
				}
			}
		}
		return $items;
    }
}

function list_post_register_widget() {
	register_widget( 'Thim_List_Post_Widget' );
}

add_action( 'widgets_init', 'list_post_register_widget' );