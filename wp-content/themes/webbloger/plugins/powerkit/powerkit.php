<?php
/* PowerKit support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_powerkit_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_powerkit_theme_setup9', 9 );
	function webbloger_powerkit_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_powerkit_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_powerkit_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('webbloger_filter_tgmpa_required_plugins',	'webbloger_powerkit_tgmpa_required_plugins');
	function webbloger_powerkit_tgmpa_required_plugins( $list = array() ) {
		if ( webbloger_storage_isset( 'required_plugins', 'powerkit' ) && webbloger_storage_get_array( 'required_plugins', 'powerkit', 'install' ) !== false ) {
			$list[] = array(
				'name'     => webbloger_storage_get_array( 'required_plugins', 'powerkit', 'title' ),
				'slug'     => 'powerkit',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_powerkit' ) ) {
	function webbloger_exists_powerkit() {
		return class_exists( 'Powerkit' );
	}
}
