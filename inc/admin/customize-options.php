<?php
/**
 * Create Thim_Charity_Customize
 *
 */

/**
 * Class Thim_Customize_Options
 */
class Thim_Customize_Options {
	/**
	 * Thim_Customize_Options constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'thim_deregister') );
		add_action( 'thim_customizer_register', array( $this, 'thim_create_customize_options') );
	}

	/**
	 * Deregister customize default unnecessary
	 *
	 * @param $wp_customize
	 */
	public function thim_deregister( $wp_customize ) {
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_control( 'blogdescription' );
		$wp_customize->remove_control( 'blogname' );
		$wp_customize->remove_control( 'display_header_text' );
		$wp_customize->remove_section( 'woocommerce_product_catalog' );
		$wp_customize->remove_section( 'woocommerce_store_notice' );
        $wp_customize->remove_section( 'static_front_page' );
        // Rename existing section
        $wp_customize->add_section( 'title_tagline', array(
            'title'    => esc_html__( 'Logo', 'charitywp' ),
            'panel'    => 'general',
            'priority' => 20,
        ) );
	}

	/**
	 * Create customize
	 *
	 * @param $wp_customize
	 */
	public function thim_create_customize_options( $wp_customize ) {

		//	Auto include sections
		foreach ( glob( THIM_DIR . "inc/admin/customizer-sections/*.php" ) as $file ) {
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}
}

$thim_customize = new Thim_Customize_Options();