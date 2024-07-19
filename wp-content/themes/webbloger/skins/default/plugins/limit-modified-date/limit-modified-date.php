<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_limit_modified_date_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_limit_modified_date_theme_setup9', 9 );
    function webbloger_limit_modified_date_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_limit_modified_date_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_limit_modified_date_tgmpa_required_plugins' ) ) {    
    function webbloger_limit_modified_date_tgmpa_required_plugins( $list = array() ) {
        if ( webbloger_storage_isset( 'required_plugins', 'limit-modified-date' ) && webbloger_storage_get_array( 'required_plugins', 'limit-modified-date', 'install' ) !== false ) {
            $list[] = array(
                'name'     => webbloger_storage_get_array( 'required_plugins', 'limit-modified-date', 'title' ),
                'slug'     => 'limit-modified-date',
                'required' => false,
            );
        }
        return $list;
    }
}