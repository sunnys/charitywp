<?php
/**
 * hook after active plugin thim_core
 */
if ( ! function_exists( 'thim_activation_thim_core' ) ) {
	function thim_activation_thim_core() {
		$active_plugins = get_option( 'active_plugins' );
		if ( ( $key = array_search( 'thim-framework/tp-framework.php', $active_plugins ) ) !== false ) {
			unset( $active_plugins[ $key ] );
			update_option( 'active_plugins', $active_plugins );
		}
	}
}
add_action( 'thim_core_installer_install_success', 'thim_activation_thim_core' );