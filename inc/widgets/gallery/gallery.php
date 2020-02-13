<?php
class thim_gallery_widget extends Thim_Widget {

	function __construct() {

		$categories = get_terms( 'category', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
		$cate       = array();
		$cate[0]    = esc_html__( 'All', 'charitywp' );
		if ( is_array( $categories ) ) {
			foreach ( $categories as $cat ) {
				$cate[ $cat->term_id ] = $cat->name;
			}
		}

		parent::__construct(
			'gallery',
			__( 'Thim: Gallery', 'charitywp' ),
			array(
				'description' => esc_html__( 'Add gallery', 'charitywp' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-images-alt2'
			),
			array(),
			array(

				'source' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Source', 'charitywp' ),
					'options' => array(
						'images' 	=> esc_attr__('Images', 'charitywp'),
						'posts' 	=> esc_attr__('Posts', 'charitywp'),
						'image-order' 	=> esc_attr__('Images 2', 'charitywp'),
					),
					'default' => 'images',
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'source')
					)
				),

                'title'        => array(
                    'type'    => 'text',
                    'label'   => esc_html__( 'Title', 'charitywp' ),
                    'default' => '',
                    'state_handler' => array(
                        'source[images]'	=> array( 'hide' ),
                        'source[posts]'     => array( 'hide' ),
                        'source[image-order]'     => array( 'show' ),
                    ),
                ),

				'per_page'	=> array(
					'type' 		=> 'number',
					'label'		=> esc_attr__('Number item per page', 'charitywp'),
					'default'	=> '9',
					'min'		=> '1',
					'max'		=> '500',
                    'state_handler' => array(
                        'source[images]'	=> array( 'show' ),
                        'source[posts]'     => array( 'show' ),
                        'source[image-order]'     => array( 'hide' ),
                    ),
				),

                'gutter'                => array(
                    'type'    => 'checkbox',
                    'label'   => esc_html__( 'No padding columns', 'charitywp' ),
                    'default' => false,
                    'state_handler' => array(
                        'source[images]'	=> array( 'show' ),
                        'source[posts]'     => array( 'hide' ),
                        'source[image-order]'     => array( 'hide' ),
                    ),
                ),

				'column'	=> array(
					'type' 		=> 'number',
					'label'		=> esc_attr__('Column number', 'charitywp'),
					'default'	=> '3',
					'min'		=> '1',
					'max'		=> '12',
                    'state_handler' => array(
                        'source[images]'	=> array( 'show' ),
                        'source[posts]'     => array( 'show' ),
                        'source[image-order]'     => array( 'hide' ),
                    ),
				),

				'image' => array(
					'type'  => 'multimedia',
 					'label' => esc_html__( 'Images', 'charitywp' ),
					'description'  => esc_html__( 'Select image from media library.', 'charitywp' ),
					'state_handler' => array(
						'source[images]'	=> array( 'show' ),
						'source[posts]'     => array( 'hide' ),
						'source[image-order]'     => array( 'show' ),
					),
				),

				'cat'     => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Select Category', 'charitywp' ),
					'options' => $cate,
					'state_handler' => array(
						'source[images]'	=> array( 'hide' ),
						'source[posts]'     => array( 'show' ),
						'source[image-order]'     => array( 'hide' ),
					),
				),

                'info_group' => array(
                    'type'   => 'repeater',
                    'label' => esc_html__('Info List', 'charitywp'),
                    'item_name' => esc_html__('Info', 'charitywp'),
                    'fields' => array(

                        'title' => array(
                            'type'                  => 'text',
                            'label'                 => esc_html__( 'Title', 'charitywp' ),
                            "default"               => esc_html__( "This is an box.", 'charitywp' ),
                            "description"           => esc_html__( "Provide the title for this box.", 'charitywp' ),
                            'allow_html_formatting' => array(
                                'a'    => array(
                                    'href'   => true,
                                    'target' => true,
                                    'class'  => true,
                                    'alt'    => true,
                                    'title'  => true,
                                ),
                                'span' => array(),
                                'i'    => array(
                                    'class' => true,
                                ),
                                'ul'   => array(
                                    'class' => true,
                                ),
                                'li'   => array(
                                    'class' => true,
                                ),
                            )
                        ),
                        'content'    => array(
                            "type"                  => "textarea",
                            "label"                 => esc_html__( "Add description", 'charitywp' ),
                            "default"               => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'charitywp' ),
                            "description"           => esc_html__( "Provide the description for this box.", 'charitywp' ),
                            'allow_html_formatting' => array(
                                'a'    => array(
                                    'href'   => true,
                                    'target' => true,
                                    'class'  => true,
                                    'alt'    => true,
                                    'title'  => true,
                                ),
                                'span' => array(),
                                'i'    => array(
                                    'class' => true,
                                ),
                                'ul'   => array(
                                    'class' => true,
                                ),
                                'li'   => array(
                                    'class' => true,
                                ),
                            )
                        ),

                    ),
                    'state_handler' => array(
                        'source[images]'	=> array( 'hide' ),
                        'source[posts]'     => array( 'hide' ),
                        'source[image-order]'     => array( 'show' ),
                    ),
                ),

                'readmore_group' => array(
                    'type'   => 'section',
                    'label'  => esc_html__( 'Link Box', 'charitywp' ),
                    'hide'   => true,
                    'fields' => array(
                        'link'                  => array(
                            "type"        => "text",
                            "label"       => esc_html__( "Add Link", 'charitywp' ),
                            "description" => esc_html__( "Provide the link that will be applied to this box.", 'charitywp' )
                        ),
                        'button_readmore_group' => array(
                            'type'          => 'section',
                            'label'         => esc_html__( 'Option Button Read More', 'charitywp' ),
                            'hide'          => true,
                            'state_handler' => array(
                                'source[images]'	=> array( 'hide' ),
                                'source[posts]'     => array( 'hide' ),
                                'source[image-order]'     => array( 'show' ),
                            ),
                            'fields'        => array(
                                'read_text'    => array(
                                    "type"        => "text",
                                    "label"       => esc_html__( "Read More Text", 'charitywp' ),
                                    "default"     => "Read More",
                                    "description" => esc_html__( "Customize the read more text.", 'charitywp' ),
                                ),
                                'button_style' => array(
                                    'type'    => 'select',
                                    'label'   => esc_html__( 'Button Style', 'charitywp' ),
                                    'default' => 'default',
                                    'options' => array(
                                        'default' => esc_html__( 'Default', 'charitywp' ),
                                        'style2'  => esc_html__( 'Style 2', 'charitywp' ),
                                        'style3'  => esc_html__( 'Style 3', 'charitywp' ),
                                        'style4'  => esc_html__( 'Style 4', 'charitywp' ),
                                        'style5'  => esc_html__( 'Style 5', 'charitywp' ),
                                        'style6'  => esc_html__( 'Style 6', 'charitywp' ),
                                        'style7'  => esc_html__( 'Style 7', 'charitywp' ),
                                    ),
                                ),
                            )
                        ),
                    ),
                ),

			),
			THIM_DIR . 'inc/widgets/gallery/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */
	function get_template_name( $instance ) {
        switch ( $instance['source'] ) {
            case 'posts':
                $template = 'posts';
                break;
            case 'image-order':
                $template = 'image-order';
                break;
            default:
                $template = 'base';
                break;
        }

        return $template;
	}

	function get_style_name( $instance ) {
		return false;
	}
}
function thim_gallery_widget_register() {
	register_widget( 'thim_gallery_widget' );
}

add_action( 'widgets_init', 'thim_gallery_widget_register' );



//Function ajax widget gallery-posts
add_action( 'wp_ajax_thim_gallery_popup', 'thim_gallery_popup' );
add_action( 'wp_ajax_nopriv_thim_gallery_popup', 'thim_gallery_popup' );
function thim_gallery_popup() {
	global $post;
	$post_id = $_POST["post_id"];
	$post    = get_post( $post_id );
	$images = thim_meta( 'thim_gallery', "type=image&single=false&size=full" );
	// Get category permalink
	ob_start();
	if( !empty($images) ) {
		foreach( $images as $k=>$value ) {
			$url_image = $value['url'];
			if( $url_image ){
				echo '<a href="'.$url_image.'">';
				echo '<img src="'.$url_image.'" alt="Test" />';
				echo '</a>';
			}
		}
	}
 	$output = ob_get_contents();
 	ob_end_clean();
 	echo ent2ncr( $output );
 	die();
}