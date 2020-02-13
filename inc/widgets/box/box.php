<?php

class Thim_Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'box',
			esc_html__( 'Thim: Box', 'charitywp' ),
			array(
				'description'   => esc_html__( 'Add box', 'charitywp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'box_style'           => array(
					"type"          => "select",
					"label"         => esc_html__( "Box Style", 'charitywp' ),
					"options"       => array(
						"base"    => esc_html__( "Default", 'charitywp' ),
						"video"   => esc_html__( "Video Box", 'charitywp' ),
						"simple"  => esc_html__( "Simple Box", 'charitywp' ),
						"iconbox" => esc_html__( "Icon Box", 'charitywp' ),
						"list"    => esc_html__( "List Box", 'charitywp' ),
						"image"   => esc_html__( "Image Box", 'charitywp' ),
					),
					'default'       => 'base',
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'box_style' )
					)
				),
				'title_group'         => array(
					'type'   => 'section',
					'label'  => esc_html__( 'Title Options', 'charitywp' ),
					'hide'   => true,
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

						'drop_cap' => array(
							'type'          => 'text',
							'label'         => esc_html__( 'Drop Cap', 'charitywp' ),
							"default"       => esc_html__( "C", 'charitywp' ),
							"description"   => esc_html__( "Provide the drop cap for this box.", 'charitywp' ),
							'state_handler' => array(
								'box_style[base]'    => array( 'hide' ),
								'box_style[simple]'  => array( 'hide' ),
								'box_style[iconbox]' => array( 'hide' ),
								'box_style[list]'    => array( 'hide' ),
								'box_style[image]'   => array( 'show' ),
							),
						),

						'font_family' => array(
							"type"    => "select",
							"label"   => esc_html__( "Font Family", 'charitywp' ),
							"options" => array(
								"default" => esc_html__( "Default", 'charitywp' ),
								"custom"  => esc_html__( "Custom", 'charitywp' )
							),
							'default' => 'custom',
						),

						'text_color' => array(
							'type'  => 'color',
							'label' => esc_html__( 'Text Color', 'charitywp' ),
						),

						'font_size' => array(
							"type"    => "number",
							"label"   => esc_html__( "Font Size", 'charitywp' ),
							"suffix"  => "px",
							"default" => "24",
						),

						'font_weight' => array(
							"type"    => "select",
							"label"   => esc_html__( "Font Weight", 'charitywp' ),
							"options" => array(
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
							'default' => '700'
						),

						'line' => array(
							"type"    => "select",
							"label"   => esc_html__( "Show Separator", 'charitywp' ),
							"options" => array(
								"true"  => esc_html__( "Yes", 'charitywp' ),
								"false" => esc_html__( "No", 'charitywp' )
							),
							'default' => 'true'
						),

					),
				),
				'desc_group'          => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Description', 'charitywp' ),
					'hide'          => true,
					'fields'        => array(
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
						'text_color' => array(
							"type"  => "color",
							"label" => esc_html__( "Text Color", 'charitywp' ),
							"class" => "color-mini",
						),
					),
					'state_handler' => array(
						'box_style[base]'    => array( 'show' ),
						'box_style[simple]'  => array( 'show' ),
						'box_style[iconbox]' => array( 'show' ),
						'box_style[list]'    => array( 'show' ),
						'box_style[image]'   => array( 'hide' ),
					),
				),
				'list_group'          => array(
					'type'          => 'section',
					'label'         => esc_html__( 'List group', 'charitywp' ),
					'hide'          => true,
					'fields'        => array(
						'content'    => array(
							"type"                  => "textarea",
							"label"                 => esc_html__( "Add list", 'charitywp' ),
							"default"               => esc_html__( "Write a short list, that will describe the title or something informational and useful.", 'charitywp' ),
							"description"           => esc_html__( "Provide the list for this box.", 'charitywp' ),
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
						'text_color' => array(
							"type"  => "color",
							"label" => esc_html__( "Text Color", 'charitywp' ),
							"class" => "color-mini",
						),
					),
					'state_handler' => array(
						'box_style[base]'    => array( 'hide' ),
						'box_style[simple]'  => array( 'hide' ),
						'box_style[iconbox]' => array( 'hide' ),
						'box_style[list]'    => array( 'show' ),
						'box_style[image]'   => array( 'hide' ),
					),
				),
				'readmore_group'      => array(
					'type'   => 'section',
					'label'  => esc_html__( 'Link Box', 'charitywp' ),
					'hide'   => true,
					'fields' => array(
						'link'                  => array(
							"type"        => "text",
							"label"       => esc_html__( "Add Link", 'charitywp' ),
							"description" => esc_html__( "Provide the link that will be applied to this box.", 'charitywp' )
						),
						'read_more'             => array(
							"type"          => "select",
							"label"         => esc_html__( "Apply link to:", 'charitywp' ),
							"options"       => array(
								"complete_box" => esc_html__( "Complete Box", 'charitywp' ),
								"title"        => esc_html__( "Title", 'charitywp' ),
								"more"         => esc_html__( "Read More", 'charitywp' ),
								"title_more"   => esc_html__( "Title & Read More", 'charitywp' ),
							),
							"description"   => esc_html__( "Select whether to use color for icon or not.", 'charitywp' ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'readmore_option' )
							)
						),
						'button_readmore_group' => array(
							'type'          => 'section',
							'label'         => esc_html__( 'Option Button Read More', 'charitywp' ),
							'hide'          => true,
							'state_handler' => array(
								'readmore_option[more]'         => array( 'show' ),
								'readmore_option[complete_box]' => array( 'show' ),
								'readmore_option[title]'        => array( 'hide' ),
								'readmore_option[title_more]'   => array( 'show' ),
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
				'box_style_default'   => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Background Options', 'charitywp' ),
					'hide'          => true,
					'fields'        => array(
						'background_image' => array(
							'type'    => 'media',
							'label'   => esc_html__( 'Background Image', 'charitywp' ),
							'default' => '',
							'library' => 'image',
						),
						'overlay_style'    => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Overlay', 'charitywp' ),
							'default'       => 'overlay',
							'options'       => array(
								'none'    => esc_html__( 'No', 'charitywp' ),
								'overlay' => esc_html__( 'Yes', 'charitywp' ),
							),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'overlay_style' )
							)
						),

						'overlay_color' => array(
							"type"          => "color",
							"label"         => esc_html__( "Overlay color", 'charitywp' ),
							"class"         => "color-mini",
							'default'       => '#000000',
							'state_handler' => array(
								'overlay_style[none]'    => array( 'hide' ),
								'overlay_style[overlay]' => array( 'show' ),
							),
						),

						'overlay_opacity' => array(
							"type"          => "number",
							"label"         => esc_html__( "Overlay Opacity", 'charitywp' ),
							'default'       => 0.5,
							'state_handler' => array(
								'overlay_style[none]'    => array( 'hide' ),
								'overlay_style[overlay]' => array( 'show' ),
							),
						),

					),
					'state_handler' => array(
						'box_style[base]'    => array( 'show' ),
						'box_style[simple]'  => array( 'hide' ),
						'box_style[iconbox]' => array( 'hide' ),
						'box_style[list]'    => array( 'hide' ),
						'box_style[image]'   => array( 'hide' ),
					),
				),
				'box_style_video'     => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Video Options', 'charitywp' ),
					'hide'          => true,
					'fields'        => array(
						'url' => array(
							"type"        => "text",
							"label"       => esc_html__( "Video URL", 'charitywp' ),
							"default"     => "",
							"description" => esc_html__( "Support: youtube.com, vimeo.com", 'charitywp' ),
						),
					),
					'state_handler' => array(
						'box_style[video]'   => array( 'show' ),
						'box_style[base]'    => array( 'hide' ),
						'box_style[simple]'  => array( 'hide' ),
						'box_style[iconbox]' => array( 'hide' ),
						'box_style[list]'    => array( 'hide' ),
						'box_style[image]'   => array( 'hide' ),
					),
				),
				'box_style_simple'    => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Simple Box Options', 'charitywp' ),
					'hide'          => true,
					'fields'        => array(
						'background_image' => array(
							'type'    => 'media',
							'label'   => esc_html__( 'Image', 'charitywp' ),
							'default' => '',
							'library' => 'image',
						),

						'layout' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Layout', 'charitywp' ),
							'default' => 'image-at-top',
							'options' => array(
								'image-at-top'  => esc_html__( 'Image At Top', 'charitywp' ),
								'image-at-left' => esc_html__( 'Image At Left', 'charitywp' ),
								'center'        => esc_html__( 'Box align center', 'charitywp' )
							),
						),

						'overflow' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Image Overflow', 'charitywp' ),
							'default' => 'hidden',
							'options' => array(
								'hidden'  => esc_html__( 'Hidden', 'charitywp' ),
								'visible' => esc_html__( 'Visible', 'charitywp' ),
							),
						),

					),
					'state_handler' => array(
						'box_style[base]'    => array( 'hide' ),
						'box_style[video]'   => array( 'hide' ),
						'box_style[simple]'  => array( 'show' ),
						'box_style[iconbox]' => array( 'hide' ),
						'box_style[list]'    => array( 'hide' ),
						'box_style[image]'   => array( 'show' ),
					),
				),
				'box_style_iconbox'   => array(
					'type'          => 'section',
					'label'         => esc_html__( 'Icon Box Options', 'charitywp' ),
					'hide'          => true,
					'fields'        => array(
						'icon' => array(
							"type"        => "icon",
							"class"       => "",
							"label"       => esc_html__( "Select Icon:", 'charitywp' ),
							"description" => esc_html__( "Select the icon from the list.", 'charitywp' ),
							"class_name"  => 'font-awesome',
						),

						'icon_size' => array(
							"type"       => "number",
							"class"      => "color-mini",
							"label"      => esc_html__( "Icon Font Size ", 'charitywp' ),
							"suffix"     => "px",
							"default"    => "14",
							"class_name" => 'font-awesome'
						),

						'icon_color' => array(
							"type"    => "color",
							"label"   => esc_html__( "Color", 'charitywp' ),
							"class"   => "color-mini",
							'default' => '#333'
						),

						'icon_line_height' => array(
							"type"       => "number",
							"class"      => "",
							"label"      => esc_html__( "Icon Font Line-Height ", 'charitywp' ),
							"suffix"     => "px",
							"default"    => "14",
							"class_name" => 'font-awesome'
						),

						'icon_width' => array(
							"type"    => "number",
							"class"   => "color-mini",
							"default" => "100",
							"label"   => esc_html__( "Width Box Icon", 'charitywp' ),
							"suffix"  => "px",
						),

						'icon_height' => array(
							"type"    => "number",
							"class"   => "color-mini",
							"default" => "100",
							"label"   => esc_html__( "Height Box Icon", 'charitywp' ),
							"suffix"  => "px",
						),

						'pos' => array(
							"type"    => "select",
							"class"   => "color-mini",
							"label"   => esc_html__( "Box Style", 'charitywp' ),
							"default" => "top",
							"options" => array(
								"left"  => esc_html__( "Icon at Left", 'charitywp' ),
								"right" => esc_html__( "Icon at Right", 'charitywp' ),
								"top"   => esc_html__( "Icon at Top", 'charitywp' )
							),
						),
					),
					'state_handler' => array(
						'box_style[base]'    => array( 'hide' ),
						'box_style[video]'   => array( 'hide' ),
						'box_style[simple]'  => array( 'hide' ),
						'box_style[iconbox]' => array( 'show' ),
						'box_style[list]'    => array( 'hide' ),
						'box_style[image]'   => array( 'hide' ),
					),
				),
				'box_char_background' => array(
					'type'          => 'text',
					'label'         => esc_html__( 'Alphabet Background', 'charitywp' ),
					"description"   => esc_html__( "Add one alphabet background", 'charitywp' ),
					'state_handler' => array(
						'box_style[base]'    => array( 'hide' ),
						'box_style[video]'   => array( 'hide' ),
						'box_style[simple]'  => array( 'hide' ),
						'box_style[iconbox]' => array( 'hide' ),
						'box_style[list]'    => array( 'hide' ),
						'box_style[image]'   => array( 'show' ),
					),
				),
			),
			THIM_DIR . 'inc/widgets/box/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {

		switch ( $instance['box_style'] ) {
			case 'simple':
				$template = 'simple';
				break;
			case 'iconbox':
				$template = 'iconbox';
				break;
			case 'image':
				$template = 'image';
				break;
			case 'list':
				$template = 'list';
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

function thim_box_register_widget() {
	register_widget( 'Thim_Box_Widget' );
}

add_action( 'widgets_init', 'thim_box_register_widget' );