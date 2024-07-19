<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_elegro_payment_theme_setup9', 9 );
	function webbloger_elegro_payment_theme_setup9() {
		if ( webbloger_exists_elegro_payment() ) {
			add_action( 'wp_enqueue_scripts', 'webbloger_elegro_payment_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_elegro_payment', 'webbloger_elegro_payment_frontend_scripts', 10, 1 );
			add_filter( 'webbloger_filter_merge_styles', 'webbloger_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_elegro_payment_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('webbloger_filter_tgmpa_required_plugins',	'webbloger_elegro_payment_tgmpa_required_plugins');
	function webbloger_elegro_payment_tgmpa_required_plugins( $list = array() ) {
		if ( webbloger_storage_isset( 'required_plugins', 'woocommerce' ) && webbloger_storage_isset( 'required_plugins', 'elegro-payment' ) && webbloger_storage_get_array( 'required_plugins', 'elegro-payment', 'install' ) !== false ) {
			$list[] = array(
				'name'     => webbloger_storage_get_array( 'required_plugins', 'elegro-payment', 'title' ),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'webbloger_exists_elegro_payment' ) ) {
	function webbloger_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'webbloger_elegro_payment_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'webbloger_elegro_payment_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_elegro_payment', 'webbloger_elegro_payment_frontend_scripts', 10, 1 );
	function webbloger_elegro_payment_frontend_scripts( $force = false ) {
		webbloger_enqueue_optimized( 'elegro_payment', $force, array(
			'css' => array(
				'webbloger-elegro-payment' => array( 'src' => 'plugins/elegro-payment/elegro-payment.css' ),
			)
		) );
	}
}

// Merge custom styles
if ( ! function_exists( 'webbloger_elegro_payment_merge_styles' ) ) {
	//Handler of the add_filter('webbloger_filter_merge_styles', 'webbloger_elegro_payment_merge_styles');
	function webbloger_elegro_payment_merge_styles( $list ) {
		$list[ 'plugins/elegro-payment/elegro-payment.css' ] = false;
		return $list;
	}
}
