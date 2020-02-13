<?php
/**
 * Section Footer Copyright
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_copyright',
	'panel'    => 'display_footer',
	'title'    => esc_html__( 'Copyright Options', 'charitywp' ),
	'priority' => 10,
) );

thim_customizer()->add_field( array(
	'id'       => 'copyright_text',
	'type'     => 'textarea',
	'label'    => esc_html__( 'Copyright Text', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you can add content in copyright', 'charitywp' ),
	'section'  => 'display_copyright',
	'default'  => 'Designed by <a href="http://thimpress.com">ThimPress</a>. Powered by WordPress.',
	'priority' => 12,
) );