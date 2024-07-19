<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_cookie_law_info_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_cookie_law_info_theme_setup9', 9 );
    function webbloger_cookie_law_info_theme_setup9() {     
        if ( is_admin() ) {
            add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_cookie_law_info_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_cookie_law_info_tgmpa_required_plugins' ) ) {
    function webbloger_cookie_law_info_tgmpa_required_plugins( $list = array() ) {
        if ( webbloger_storage_isset( 'required_plugins', 'cookie-law-info' ) && webbloger_storage_get_array( 'required_plugins', 'cookie-law-info', 'install' ) !== false ) {
            $list[] = array(
                'name'     => webbloger_storage_get_array( 'required_plugins', 'cookie-law-info', 'title' ),
                'slug'     => 'cookie-law-info',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_cookie_law_info' ) ) {
    function webbloger_exists_cookie_law_info() {
        return class_exists( 'Cookie_Law_Info' ) || function_exists('cky_is_legacy');
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'webbloger_cookie_law_info_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'webbloger_cookie_law_info_importer_set_options' );
    function webbloger_cookie_law_info_importer_set_options($options=array()) {   
        if ( webbloger_exists_cookie_law_info() && in_array('cookie-law-info', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'cky_banner_template';
            $options['additional_options'][]    = 'cky_settings';              
            $options['additional_options'][]    = 'cky_admin_notices';                         
        }
        return $options;
    }
}