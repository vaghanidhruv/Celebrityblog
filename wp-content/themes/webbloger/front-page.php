<?php
/**
 * The Front Page template file.
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( webbloger_is_on( webbloger_get_theme_option( 'front_page_enabled', false ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$webbloger_sections = webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'front_page_sections' ) );
		if ( is_array( $webbloger_sections ) ) {
			foreach ( $webbloger_sections as $webbloger_section ) {
				get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'front-page/section', $webbloger_section ), $webbloger_section );
			}
		}

		// Else if this page is a blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'blog' ) );

		// Else - display a native page content
	} else {
		get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'page' ) );
	}

	// Else get the template 'index.php' to show posts
} else {
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'index' ) );
}

get_footer();
