<?php
if ( is_admin() ) {
	/*
	   * prefix of meta keys, optional
	   */
	$prefix = 'thim_';
	/*
	   * configure your meta box
	   */
	$config = array(
		'id'             => 'category_meta_box',
		// meta box id, unique per meta box
		'title'          =>  esc_html__('Category Meta Box','charitywp' ),
		// meta box title
		'pages'          => array( 'category' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$my_meta          = new Tax_Meta_Class( $config );

}
