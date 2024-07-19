<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_template = apply_filters( 'webbloger_filter_get_template_part', webbloger_blog_archive_get_template() );

if ( ! empty( $webbloger_template ) && 'index' != $webbloger_template ) {

	get_template_part( $webbloger_template );

} else {

	webbloger_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$webbloger_stickies   = is_home()
								|| ( in_array( webbloger_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) webbloger_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$webbloger_post_type  = webbloger_get_theme_option( 'post_type' );
		$webbloger_args       = array(
								'blog_style'     => webbloger_get_theme_option( 'blog_style' ),
								'post_type'      => $webbloger_post_type,
								'taxonomy'       => webbloger_get_post_type_taxonomy( $webbloger_post_type ),
								'parent_cat'     => webbloger_get_theme_option( 'parent_cat' ),
								'posts_per_page' => webbloger_get_theme_option( 'posts_per_page' ),
								'sticky'         => webbloger_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $webbloger_stickies )
															&& count( $webbloger_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		webbloger_blog_archive_start();

		do_action( 'webbloger_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'webbloger_action_before_page_author' );
			get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'webbloger_action_after_page_author' );
		}

		if ( webbloger_get_theme_option( 'show_filters' ) ) {
			do_action( 'webbloger_action_before_page_filters' );
			webbloger_show_filters( $webbloger_args );
			do_action( 'webbloger_action_after_page_filters' );
		} else {
			do_action( 'webbloger_action_before_page_posts' );
			webbloger_show_posts( array_merge( $webbloger_args, array( 'cat' => $webbloger_args['parent_cat'] ) ) );
			do_action( 'webbloger_action_after_page_posts' );
		}

		do_action( 'webbloger_action_blog_archive_end' );

		webbloger_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
