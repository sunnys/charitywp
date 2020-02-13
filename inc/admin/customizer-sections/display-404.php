<?php
/**
 * Section Display 404
 *
 * @package Charity
 */

thim_customizer()->add_section( array(
	'id'       => 'display_page_404',
	'panel'    => 'display',
	'title'    => esc_html__( 'Page 404', 'charitywp' ),
	'priority' => 15,
) );

thim_customizer()->add_field( array(
	'id'       => '404_top_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Top Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you can change top image in 404 page', 'charitywp' ),
	'section'  => 'display_page_404',
	'default'  => THIM_URI . 'assets/images/page_top_image.jpg',
	'priority' => 16,
) );

thim_customizer()->add_field( array(
	'id'       => '404_image',
	'type'     => 'kirki-image',
	'label'    => esc_html__( 'Image', 'charitywp' ),
	'tooltip'  => esc_html__( 'Allows you can add image in 404 page', 'charitywp' ),
	'section'  => 'display_page_404',
	'default'  => THIM_URI . 'assets/images/404-error.jpg',
	'priority' => 17,
) );

thim_customizer()->add_field( array(
	'label'   => esc_html__( 'Content', 'charitywp' ),
	'id'      => '404_content',
	'type'    => 'textarea',
	'section'  => 'display_page_404',
	'default' => '<h2 class="title">404 <span>Error!</span></h2><p>Dude, that page can\'t be found. You better go <a href="' . esc_url( home_url( '/' ) ) . '">Home</a>',
	'priority' => 18,
) );