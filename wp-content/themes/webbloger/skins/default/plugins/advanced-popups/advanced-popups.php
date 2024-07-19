<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_advanced_popups_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_advanced_popups_theme_setup9', 9 );
    function webbloger_advanced_popups_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_advanced_popups_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_advanced_popups_tgmpa_required_plugins' ) ) {    
    function webbloger_advanced_popups_tgmpa_required_plugins( $list = array() ) {
        if ( webbloger_storage_isset( 'required_plugins', 'advanced-popups' ) && webbloger_storage_get_array( 'required_plugins', 'advanced-popups', 'install' ) !== false ) {
            $list[] = array(
                'name'     => webbloger_storage_get_array( 'required_plugins', 'advanced-popups', 'title' ),
                'slug'     => 'advanced-popups',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_advanced_popups' ) ) {
    function webbloger_exists_advanced_popups() {
        return function_exists('adp_init');
    }
}
