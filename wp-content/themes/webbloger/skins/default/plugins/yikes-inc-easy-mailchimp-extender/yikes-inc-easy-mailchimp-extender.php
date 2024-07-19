<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_yikes_inc_easy_mailchimp_extender_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_yikes_inc_easy_mailchimp_extender_theme_setup9', 9 );
    function webbloger_yikes_inc_easy_mailchimp_extender_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_yikes_inc_easy_mailchimp_extender_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_yikes_inc_easy_mailchimp_extender_tgmpa_required_plugins' ) ) {
    function webbloger_yikes_inc_easy_mailchimp_extender_tgmpa_required_plugins( $list = array() ) {
        if ( webbloger_storage_isset( 'required_plugins', 'yikes-inc-easy-mailchimp-extender' ) && webbloger_storage_get_array( 'required_plugins', 'yikes-inc-easy-mailchimp-extender', 'install' ) !== false ) {
            $list[] = array(
                'name'     => webbloger_storage_get_array( 'required_plugins', 'yikes-inc-easy-mailchimp-extender', 'title' ),
                'slug'     => 'yikes-inc-easy-mailchimp-extender',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_yikes_inc_easy_mailchimp_extender' ) ) {
    function webbloger_exists_yikes_inc_easy_mailchimp_extender() {
        return function_exists( 'yikes_inc_easy_mailchimp_extender' );
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'webbloger_exists_yikes_inc_easy_mailchimp_extender_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options', 'webbloger_exists_yikes_inc_easy_mailchimp_extender_importer_set_options' );
    function webbloger_exists_yikes_inc_easy_mailchimp_extender_importer_set_options( $options=array() ) {   
        if ( webbloger_exists_yikes_inc_easy_mailchimp_extender() && in_array('yikes-inc-easy-mailchimp-extender', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'yikes_easy_mailchimp_extender_forms';                   
        }
        return $options;
    }
}

// Submit button 
if ( !function_exists( 'webbloger_yikes_mailchimp_form_submit_button' ) ) {
    add_filter( 'yikes-mailchimp-form-submit-button', 'webbloger_yikes_mailchimp_form_submit_button', 10, 2 );
    function webbloger_yikes_mailchimp_form_submit_button( $html, $id ) {   
        $html = str_replace('<span class="yikes-mailchimp-submit-button-span-text', '<span class="sc_button_icon"><span class="icon-plain"></span></span><span class="yikes-mailchimp-submit-button-span-text', $html);
        $html = str_replace('yikes-mailchimp-submit-button-span-text', 'yikes-mailchimp-submit-button-span-text sc_button_text', $html);
        return $html;
    }
}

// Submit button classes
if ( !function_exists( 'webbloger_yikes_mailchimp_form_submit_button_classes' ) ) {
    add_filter( 'yikes-mailchimp-form-submit-button-classes', 'webbloger_yikes_mailchimp_form_submit_button_classes', 10, 2 );
    function webbloger_yikes_mailchimp_form_submit_button_classes( $class, $id ) {   
        if ( 1 == $id ) {
            $class .= ' sc_button sc_button_with_icon sc_button_icon_right hover_style_icon_1 color_style_1';
        } else if ( 6 == $id ) {
            $class .= ' sc_button sc_button_with_icon sc_button_icon_left hover_style_1 color_style_1';
        } else {
            $class .= ' sc_button sc_button_simple sc_button_with_icon sc_button_icon_left color_style_1';
        }
        return $class;
    }
}