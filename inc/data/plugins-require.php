<?php

function thim_get_all_plugins_require( $plugins ) {
	$plugins = array(
		array(
			'name'        => 'Thim Our Team',
			'slug'        => 'thim-our-team',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/thim-our-team.png',
			'version'     => '1.3.1',
			'description' => 'A plugin that allows you to show off your team members. By ThimPress.',
		),
		array(
			'name'        => 'Thim Testimonials',
			'slug'        => 'thim-testimonials',
			'premium'     => true,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/thim-testimonials.png',
			'required'    => false,
			'version'     => '1.3.1',
			'description' => 'A plugin that allows you to show off your testimonials. By ThimPress.',
		),
		array(
			'name'        => 'Revolution Slider',
			'slug'        => 'revslider',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/revslider.png',
			'version'     => '5.4.7',
			'description' => 'Slider Revolution – Premium responsive slider By ThemePunch.',
		),
		array(
			'name'        => 'SiteOrigin Page Builder',
			'slug'        => 'siteorigin-panels',
			'required'    => true,
			'version'     => '2.6.3',
			'description' => 'A drag and drop, responsive page builder that simplifies building your website. By SiteOrigin.',
		),
		array(
			'name'        => 'SiteOrigin Widgets Bundle',
			'slug'        => 'so-widgets-bundle',
			'required'    => false,
			'version'     => '1.11.7',
			'description' => 'A collection of all widgets, neatly bundled into a single plugin. It\'s also a framework to code your own widgets on top of.',
		),
		array(
			'name'        => 'Contact Form 7',
			'slug'        => 'contact-form-7',
			'required'    => false,
			'version'     => '5.0.1',
			'description' => 'Just another contact form plugin. Simple but flexible. By Takayuki Miyoshi.',
		),
		array(
			'name'        => 'MailChimp for WordPress',
			'slug'        => 'mailchimp-for-wp',
			'required'    => false,
			'version'     => '4.2',
			'description' => 'MailChimp for WordPress by ibericode. Adds various highly effective sign-up methods to your site. By ibericode.',
		),
		array(
			'name'        => 'WooCommerce',
			'slug'        => 'woocommerce',
			'required'    => false,
			'version'     => '3.3.4',
			'description' => 'An e-commerce toolkit that helps you sell anything. Beautifully. By WooThemes.',
		),
		array(
			'name'        => 'Thim Portfolio',
			'slug'        => 'tp-portfolio',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/thim-portfolio.png',
			'version'     => '1.6',
			'description' => 'A plugin that allows you to show off your portfolio. By ThimPress.',
		),
		array(
			'name'        => 'WP Events Manager',
			'slug'        => 'wp-events-manager',
			'required'    => false,
			'version'     => '2.1.4',
			'description' => 'WP Events Manager is a powerful Events Manager plugin with all of the most important features of an Event Website.',
		),

		array(
			'name'        => 'WP Events Manager - WooCommerce Payment ',
			'slug'        => 'wp-events-manager-woo-payment',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.2',
			'description' => 'Support paying for a booking with the payment methods provided by Woocommerce',
			'add-on'      => true,
		),
		array(
			'name'        => 'Instagram Feed',
			'slug'        => 'instagram-feed',
			'required'    => false,
			'version'     => '1.6.2',
			'description' => 'Display beautifully clean, customizable, and responsive Instagram feeds By Smash Balloon.',
			'add-on'      => true,
		),
		array(
			'name'     => 'FundPress - WordPress Donation Plugin',
			'slug'     => 'fundpress',
			'required' => true,
		),
		array(
			'name'     => 'Widget Logic',
			'slug'     => 'widget-logic',
			'required' => false,
		),
		array(
			'name'        => 'Charity WP Demo Data',
			'slug'        => 'charity-wp-demo-data',
			'version'     => '1.0.1',
			'description' => 'Demo data for the theme Charity WP.',
			'premium'     => true
		)
	);

	return $plugins;
}

add_filter( 'thim_core_get_all_plugins_require', 'thim_get_all_plugins_require' );

function thim_envato_item_id() {
	return '15593989';
}

add_filter( 'thim_envato_item_id', 'thim_envato_item_id' );