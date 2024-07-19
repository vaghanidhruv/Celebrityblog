<?php
/* Advanced Product Labels For Woocommerce support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_advanced_product_labels_for_woocommerce_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_advanced_product_labels_for_woocommerce_theme_setup9', 9 );
	function webbloger_advanced_product_labels_for_woocommerce_theme_setup9() {		
		if ( is_admin() ) {
			add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_advanced_product_labels_for_woocommerce_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_advanced_product_labels_for_woocommerce_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('webbloger_filter_tgmpa_required_plugins',	'webbloger_advanced_product_labels_for_woocommerce_tgmpa_required_plugins');
	function webbloger_advanced_product_labels_for_woocommerce_tgmpa_required_plugins( $list = array() ) {
		if ( webbloger_storage_isset( 'required_plugins', 'advanced-product-labels-for-woocommerce' ) && webbloger_storage_get_array( 'required_plugins', 'advanced-product-labels-for-woocommerce', 'install' ) !== false && webbloger_is_theme_activated() ) {
			$path = webbloger_get_plugin_source_path( 'plugins/advanced-product-labels-for-woocommerce/advanced-product-labels-for-woocommerce.zip' );
			if ( ! empty( $path ) || webbloger_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => webbloger_storage_get_array( 'required_plugins', 'advanced-product-labels-for-woocommerce', 'title' ),
					'slug'     => 'advanced-product-labels-for-woocommerce',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_advanced_product_labels_for_woocommerce' ) ) {
	function webbloger_exists_advanced_product_labels_for_woocommerce() {
		return class_exists( 'BeRocket_products_label' );
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'webbloger_exists_advanced_product_labels_for_woocommerce_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'webbloger_exists_advanced_product_labels_for_woocommerce_importer_set_options' );
    function webbloger_exists_advanced_product_labels_for_woocommerce_importer_set_options($options=array()) {   
        if ( webbloger_exists_advanced_product_labels_for_woocommerce() && in_array('advanced-product-labels-for-woocommerce', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'br-products_label-options';
        }
        return $options;
    }
}