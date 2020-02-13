<?php
/**
 * Panel Product
 *
 * @package Charity
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'woocommerce',
		'priority' => 11,
		'title'    => esc_html__( 'Products', 'charitywp' ),
        'icon'     => 'dashicons-cart',
	)
);