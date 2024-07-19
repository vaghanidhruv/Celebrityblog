<?php
/* One Click Demo Import support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_ocdi_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_ocdi_theme_setup9', 9 );
	function webbloger_ocdi_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_ocdi_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_ocdi_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('webbloger_filter_tgmpa_required_plugins',	'webbloger_ocdi_tgmpa_required_plugins');
	function webbloger_ocdi_tgmpa_required_plugins( $list = array() ) {
		if ( webbloger_storage_isset( 'required_plugins', 'one-click-demo-import' ) && webbloger_storage_get_array( 'required_plugins', 'one-click-demo-import', 'install' ) !== false ) {
			$list[] = array(
				'name'     => webbloger_storage_get_array( 'required_plugins', 'one-click-demo-import', 'title' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin is installed and activated
if ( ! function_exists( 'webbloger_exists_ocdi' ) ) {
	function webbloger_exists_ocdi() {
		return class_exists( 'OCDI_Plugin' );
	}
}

