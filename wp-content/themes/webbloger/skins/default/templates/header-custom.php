<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.06
 */

$webbloger_header_css   = '';
$webbloger_header_image = get_header_image();
$webbloger_header_video = webbloger_get_header_video();
if ( ! empty( $webbloger_header_image ) && webbloger_trx_addons_featured_image_override( is_singular() || webbloger_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$webbloger_header_image = webbloger_get_current_mode_image( $webbloger_header_image );
}

$webbloger_header_id = webbloger_get_custom_header_id();
$webbloger_header_meta = webbloger_get_custom_layout_meta( $webbloger_header_id );
if ( ! empty( $webbloger_header_meta['margin'] ) ) {
	webbloger_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( webbloger_prepare_css_value( $webbloger_header_meta['margin'] ) ) ) );
	webbloger_storage_set( 'custom_header_margin', webbloger_prepare_css_value( $webbloger_header_meta['margin'] ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $webbloger_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $webbloger_header_id ) ) ); ?>
				<?php
				echo ! empty( $webbloger_header_image ) || ! empty( $webbloger_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $webbloger_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $webbloger_header_image ) {
					echo ' ' . esc_attr( webbloger_add_inline_css_class( 'background-image: url(' . esc_url( $webbloger_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
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

	// Custom header's layout
	do_action( 'webbloger_action_show_layout', $webbloger_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
