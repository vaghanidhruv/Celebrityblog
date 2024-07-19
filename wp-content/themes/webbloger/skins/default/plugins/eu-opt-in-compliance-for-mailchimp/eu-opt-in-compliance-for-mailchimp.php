<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_eu_opt_in_compliance_for_mailchimp_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_eu_opt_in_compliance_for_mailchimp_theme_setup9', 9 );
    function webbloger_eu_opt_in_compliance_for_mailchimp_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_eu_opt_in_compliance_for_mailchimp_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_eu_opt_in_compliance_for_mailchimp_tgmpa_required_plugins' ) ) {
    
    function webbloger_eu_opt_in_compliance_for_mailchimp_tgmpa_required_plugins( $list = array() ) {
        if ( webbloger_storage_isset( 'required_plugins', 'eu-opt-in-compliance-for-mailchimp' ) && webbloger_storage_get_array( 'required_plugins', 'eu-opt-in-compliance-for-mailchimp', 'install' ) !== false ) {
            $list[] = array(
                'name'     => webbloger_storage_get_array( 'required_plugins', 'eu-opt-in-compliance-for-mailchimp', 'title' ),
                'slug'     => 'eu-opt-in-compliance-for-mailchimp',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_eu_opt_in_compliance_for_mailchimp' ) ) {
    function webbloger_eu_opt_in_compliance_for_mailchimp() {
        return class_exists( 'Yikes_Inc_Easy_Mailchimp_EU_Law_Compliance_Extension' );
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'webbloger_eu_opt_in_compliance_for_mailchimp_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'webbloger_eu_opt_in_compliance_for_mailchimp_importer_set_options' );
    function webbloger_eu_opt_in_compliance_for_mailchimp_importer_set_options($options=array()) {   
        if ( webbloger_eu_opt_in_compliance_for_mailchimp() && in_array('eu-opt-in-compliance-for-mailchimp', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'CookieLawInfo-0.9';                   
            $options['additional_options'][]    = 'cookielawinfo_%';                   
        }
        return $options;
    }
}
