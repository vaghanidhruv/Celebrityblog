<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */
// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_mailchimp_theme_setup9', 9 );
	function webbloger_mailchimp_theme_setup9() {
		if ( webbloger_exists_mailchimp() ) {
			add_action( 'wp_enqueue_scripts', 'webbloger_mailchimp_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'webbloger_mailchimp_frontend_scripts', 10, 1 );
			add_filter( 'webbloger_filter_merge_styles', 'webbloger_mailchimp_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('webbloger_filter_tgmpa_required_plugins',	'webbloger_mailchimp_tgmpa_required_plugins');
	function webbloger_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( webbloger_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && webbloger_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => webbloger_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_mailchimp' ) ) {
	function webbloger_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue styles for frontend
if ( ! function_exists( 'webbloger_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'webbloger_mailchimp_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_mailchimp', 'webbloger_mailchimp_frontend_scripts', 10, 1 );
	function webbloger_mailchimp_frontend_scripts( $force = false ) {
		webbloger_enqueue_optimized( 'mailchimp', $force, array(
			'css' => array(
				'webbloger-mailchimp-for-wp' => array( 'src' => 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' ),
			)
		) );
	}
}

// Merge custom styles
if ( ! function_exists( 'webbloger_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'webbloger_filter_merge_styles', 'webbloger_mailchimp_merge_styles');
	function webbloger_mailchimp_merge_styles( $list ) {
		$list[ 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( webbloger_exists_mailchimp() ) {
	$webbloger_fdir = webbloger_get_file_dir( 'plugins/mailchimp-for-wp/mailchimp-for-wp-style.php' );
	if ( ! empty( $webbloger_fdir ) ) {
		require_once $webbloger_fdir;
	}
}

