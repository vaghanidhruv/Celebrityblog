<?php
/**
 * The template to display default site header
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_header_css   = '';
$webbloger_header_image = get_header_image();
$webbloger_header_video = webbloger_get_header_video();
if ( ! empty( $webbloger_header_image ) && webbloger_trx_addons_featured_image_override( is_singular() || webbloger_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$webbloger_header_image = webbloger_get_current_mode_image( $webbloger_header_image );
}
?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $webbloger_header_image ) || ! empty( $webbloger_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $webbloger_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $webbloger_header_image ) {
		echo ' ' . esc_attr( webbloger_add_inline_css_class( 'background-image: url(' . esc_url( $webbloger_header_image ) . ');' ) );
	}
	if ( is_singular() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( webbloger_is_on( webbloger_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight webbloger-full-height';
	}
	$webbloger_header_scheme = webbloger_get_theme_option( 'header_scheme' );
	if ( ! empty( $webbloger_header_scheme ) && ! webbloger_is_inherit( $webbloger_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $webbloger_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $webbloger_header_video ) ) {
		get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( webbloger_is_on( webbloger_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
