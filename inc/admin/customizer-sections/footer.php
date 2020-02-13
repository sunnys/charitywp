<?php
/**
 * Panel Footer
 *
 * @package Charity
 */
thim_customizer()->add_panel(
	array(
		'id'       => 'display_footer',
		'priority' => 6,
		'title'    => esc_html__( 'Footer', 'charitywp' ),
        'icon'     => 'dashicons-editor-kitchensink'
	)
);