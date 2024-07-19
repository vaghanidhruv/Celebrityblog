<?php
/**
 * Required plugins
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$webbloger_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'webbloger' ),
	'page_builders' => esc_html__( 'Page Builders', 'webbloger' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'webbloger' ),
	'socials'       => esc_html__( 'Socials and Communities', 'webbloger' ),
	'events'        => esc_html__( 'Events and Appointments', 'webbloger' ),
	'content'       => esc_html__( 'Content', 'webbloger' ),
	'other'         => esc_html__( 'Other', 'webbloger' ),
);
$webbloger_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'webbloger' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'webbloger' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $webbloger_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'webbloger' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'webbloger' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $webbloger_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'webbloger' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'webbloger' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $webbloger_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'webbloger' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'webbloger' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $webbloger_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'webbloger' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'webbloger' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $webbloger_theme_required_plugins_groups['ecommerce'],
	),
	'advanced-product-labels-for-woocommerce'             => array(
		'title'       => esc_html__( 'Advanced Product Labels For Woocommerce', 'webbloger' ),
		'description' => esc_html__( "With Advanced Product Labels plugin you can create labels easily and quickly", 'webbloger' ),
		'required'    => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/advanced-product-labels-for-woocommerce/advanced-product-labels-for-woocommerce.png' ),
		'group'       => $webbloger_theme_required_plugins_groups['ecommerce'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'webbloger' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'webbloger' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $webbloger_theme_required_plugins_groups['socials'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'webbloger' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'webbloger' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $webbloger_theme_required_plugins_groups['socials'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'webbloger' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'webbloger' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $webbloger_theme_required_plugins_groups['content'],
	),
	'yikes-inc-easy-mailchimp-extender'             => array(
		'title'       => esc_html__( 'Easy Forms for Mailchimp', 'webbloger' ),
		'description' => esc_html__( "Easy Forms for Mailchimp allows you to add unlimited Mailchimp sign up forms to your WordPress site", 'webbloger' ),
		'required'    => false,
		'install'     => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/yikes-inc-easy-mailchimp-extender/yikes-inc-easy-mailchimp-extender.png' ),
		'group'       => $webbloger_theme_required_plugins_groups['content'],
	),
	'eu-opt-in-compliance-for-mailchimp'             => array(
		'title'       => esc_html__( 'GDPR Compliance for Mailchimp', 'webbloger' ),
		'description' => esc_html__( "This addon creates an additional section on the Easy Forms for Mailchimp form builder called ‘EU Law Compliance.’", 'webbloger' ),
		'required'    => false,
		'install'     => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/eu-opt-in-compliance-for-mailchimp/eu-opt-in-compliance-for-mailchimp.png' ),
		'group'       => $webbloger_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'webbloger' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'webbloger' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $webbloger_theme_required_plugins_groups['content'],
	),
	'accelerated-mobile-pages'         => array(
		'title'       => esc_html__( 'AMP for WP – Accelerated Mobile Pages', 'webbloger' ),
		'description' => esc_html__( "AMP makes your website faster for Mobile visitors", 'webbloger' ),
		'required'    => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/accelerated-mobile-pages/accelerated-mobile-pages.png' ),
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'gdpr-framework'  => array(
		'title'       => esc_html__( 'The GDPR Framework', 'webbloger' ),
		'description' => esc_html__( "Tools to help make your website GDPR-compliant", 'webbloger' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gdpr-framework.png',
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'WP GDPR Compliance', 'webbloger' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'webbloger' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'webbloger' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'webbloger' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'trx_popup'                  => array(
		'title'       => esc_html__( 'ThemeREX Popup', 'webbloger' ),
		'description' => esc_html__( "Add popup to your site.", 'webbloger' ),
		'required'    => false,
		'logo'        => 'trx_popup.png',
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'webbloger' ),
		'required'    => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'powerkit'              => array(
		'title'       => esc_html__( 'Powerkit', 'webbloger' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'powerkit.png',
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'kadence-blocks'		=> array(
		'title'       => esc_html__( 'Kadence Blocks', 'webbloger' ),
		'description' => '',
		'required'    => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/kadence-blocks/kadence-blocks.png' ),
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'limit-modified-date'		=> array(
		'title'       => esc_html__( 'Limit Modified Date', 'webbloger' ),
		'description' => '',
		'required'    => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/limit-modified-date/limit-modified-date.png' ),
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	),
	'cookie-law-info'         => array(
		'title'       => esc_html__( 'GDPR Cookie Consent', 'webbloger' ),
		'description' => esc_html__( "The CookieYes GDPR Cookie Consent & Compliance Notice plugin will assist you in making your website GDPR (RGPD, DSVGO) compliant.", 'webbloger' ),
		'required'    => false,
		'logo'        => webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/cookie-law-info/cookie-law-info.png'),
		'group'       => $webbloger_theme_required_plugins_groups['other'],
	)
);

if ( WEBBLOGER_THEME_FREE ) {
	unset( $webbloger_theme_required_plugins['js_composer'] );
	unset( $webbloger_theme_required_plugins['vc-extensions-bundle'] );
	unset( $webbloger_theme_required_plugins['easy-digital-downloads'] );
	unset( $webbloger_theme_required_plugins['give'] );
	unset( $webbloger_theme_required_plugins['bbpress'] );
	unset( $webbloger_theme_required_plugins['booked'] );
	unset( $webbloger_theme_required_plugins['content_timeline'] );
	unset( $webbloger_theme_required_plugins['mp-timetable'] );
	unset( $webbloger_theme_required_plugins['learnpress'] );
	unset( $webbloger_theme_required_plugins['the-events-calendar'] );
	unset( $webbloger_theme_required_plugins['calculated-fields-form'] );
	unset( $webbloger_theme_required_plugins['essential-grid'] );
	unset( $webbloger_theme_required_plugins['revslider'] );
	unset( $webbloger_theme_required_plugins['ubermenu'] );
	unset( $webbloger_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $webbloger_theme_required_plugins['envato-market'] );
	unset( $webbloger_theme_required_plugins['trx_updater'] );
	unset( $webbloger_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
webbloger_storage_set( 'required_plugins', $webbloger_theme_required_plugins );
