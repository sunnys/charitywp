<?php
/**
 * Field Logo and Sticky Logo
 *
 */

thim_customizer()->add_field(
	array(
		'id'       => 'logo',
		'type'     => 'kirki-image',
		'section'  => 'title_tagline',
		'label'    => esc_html__( 'Logo', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you to add, remove, change logo on your site. ', 'charitywp' ),
		'priority' => 10,
		'default'  => THIM_URI . "assets/images/logo_white.png",
	)
);

// Header Sticky Logo
thim_customizer()->add_field(
	array(
		'id'       => 'sticky_logo',
		'type'     => 'kirki-image',
		'section'  => 'title_tagline',
		'label'    => esc_html__( 'Sticky Logo', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you to add, remove, change sticky logo on your site. ', 'charitywp' ),
		'priority' => 20,
		'default'  => THIM_URI . "assets/images/logo.png",
	)
);

// Header Sticky Logo
thim_customizer()->add_field(
	array(
		'id'       => 'mobile_logo',
		'type'     => 'kirki-image',
		'section'  => 'title_tagline',
		'label'    => esc_html__( 'Mobile Logo', 'charitywp' ),
		'tooltip'  => esc_html__( 'Allows you to add, remove, change mobile logo on your site. ', 'charitywp' ),
		'priority' => 20,
		'default'  => THIM_URI . "assets/images/logo.png",
	)
);

// Logo width
thim_customizer()->add_field(
	array(
		'id'        => 'logo_width',
		'type'      => 'dimension',
		'label'     => esc_html__( 'Logo width', 'charitywp' ),
		'tooltip'   => esc_html__( 'Allows you to assign a value for logo width. Example: 10px, 3em, 48%, 90vh etc.', 'charitywp' ),
		'section'   => 'title_tagline',
		'default'   => '155px',
		'priority'  => 40,
		'choices'   => array(
			'min'  => 100,
			'max'  => 500,
			'step' => 1,
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.thim_header_custom_style header.site-header .top-header .thim-logo',
				'property' => 'width',
			)
		)
	)
);