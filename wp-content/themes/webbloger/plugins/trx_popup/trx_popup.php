<?php
/* ThemeREX Popup support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_trx_popup_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_trx_popup_theme_setup9', 9 );
	function webbloger_trx_popup_theme_setup9() {
		if ( webbloger_exists_trx_popup() ) {
			add_action( 'wp_enqueue_scripts', 'webbloger_trx_popup_frontend_scripts', 1100 );
			add_filter( 'webbloger_filter_merge_styles', 'webbloger_trx_popup_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_trx_popup_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_trx_popup_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter( 'webbloger_filter_tgmpa_required_plugins',	'webbloger_trx_popup_tgmpa_required_plugins' );
	function webbloger_trx_popup_tgmpa_required_plugins( $list = array() ) {
		if ( webbloger_storage_isset( 'required_plugins', 'trx_popup' ) && webbloger_storage_get_array( 'required_plugins', 'trx_popup', 'install' ) !== false && webbloger_is_theme_activated() ) {
			$path = webbloger_get_plugin_source_path( 'plugins/trx_popup/trx_popup.zip' );
			if ( ! empty( $path ) || webbloger_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => webbloger_storage_get_array( 'required_plugins', 'trx_popup', 'title' ),
					'slug'     => 'trx_popup',
					'source'   => ! empty( $path ) ? $path : 'upload://trx_popup.zip',
					'version'  => '1.0',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_trx_popup' ) ) {
	function webbloger_exists_trx_popup() {
		return defined( 'TRX_POPUP_URL' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'webbloger_trx_popup_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'webbloger_trx_popup_frontend_scripts', 1100 );
	function webbloger_trx_popup_frontend_scripts() {
		if ( webbloger_is_on( webbloger_get_theme_option( 'debug_mode' ) ) ) {
			$webbloger_url = webbloger_get_file_url( 'plugins/trx_popup/trx_popup.css' );
			if ( '' != $webbloger_url ) {
				wp_enqueue_style( 'webbloger-trx-popup', $webbloger_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'webbloger_trx_popup_merge_styles' ) ) {
	//Handler of the add_filter('webbloger_filter_merge_styles', 'webbloger_trx_popup_merge_styles');
	function webbloger_trx_popup_merge_styles( $list ) {
		$list[ 'plugins/trx_popup/trx_popup.css' ] = true;
		return $list;
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if ( webbloger_exists_trx_popup() ) {
	$webbloger_fdir = webbloger_get_file_dir( 'plugins/trx_popup/trx_popup-style.php' );
	if ( ! empty( $webbloger_fdir ) ) {
		require_once $webbloger_fdir;
	}
}
