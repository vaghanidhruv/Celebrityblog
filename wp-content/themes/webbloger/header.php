<?php
/**
 * The Header: Logo and main menu
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( webbloger_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'webbloger_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'webbloger_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('webbloger_action_body_wrap_attributes'); ?>>

		<?php do_action( 'webbloger_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'webbloger_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('webbloger_action_page_wrap_attributes'); ?>>

			<?php do_action( 'webbloger_action_page_wrap_start' ); ?>

			<?php
			$webbloger_full_post_loading = ( webbloger_is_singular( 'post' ) || webbloger_is_singular( 'attachment' ) ) && webbloger_get_value_gp( 'action' ) == 'full_post_loading';
			$webbloger_prev_post_loading = ( webbloger_is_singular( 'post' ) || webbloger_is_singular( 'attachment' ) ) && webbloger_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $webbloger_full_post_loading && ! $webbloger_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="webbloger_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'webbloger_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'webbloger' ); ?></a>
				<?php if ( webbloger_sidebar_present() ) { ?>
				<a class="webbloger_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'webbloger_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'webbloger' ); ?></a>
				<?php } ?>
				<a class="webbloger_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'webbloger_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'webbloger' ); ?></a>

				<?php
				do_action( 'webbloger_action_before_header' );

				// Header
				$webbloger_header_type = webbloger_get_theme_option( 'header_type' );
				if ( 'custom' == $webbloger_header_type && ! webbloger_is_layouts_available() ) {
					$webbloger_header_type = 'default';
				}
				get_template_part( apply_filters( 'webbloger_filter_get_template_part', "templates/header-" . sanitize_file_name( $webbloger_header_type ) ) );

				// Side menu
				if ( in_array( webbloger_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'webbloger_action_after_header' );

			}
			?>

			<?php do_action( 'webbloger_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( webbloger_is_off( webbloger_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $webbloger_header_type ) ) {
						$webbloger_header_type = webbloger_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $webbloger_header_type && webbloger_is_layouts_available() ) {
						$webbloger_header_id = webbloger_get_custom_header_id();
						if ( $webbloger_header_id > 0 ) {
							$webbloger_header_meta = webbloger_get_custom_layout_meta( $webbloger_header_id );
							if ( ! empty( $webbloger_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$webbloger_footer_type = webbloger_get_theme_option( 'footer_type' );
					if ( 'custom' == $webbloger_footer_type && webbloger_is_layouts_available() ) {
						$webbloger_footer_id = webbloger_get_custom_footer_id();
						if ( $webbloger_footer_id ) {
							$webbloger_footer_meta = webbloger_get_custom_layout_meta( $webbloger_footer_id );
							if ( ! empty( $webbloger_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'webbloger_action_page_content_wrap_class', $webbloger_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'webbloger_filter_is_prev_post_loading', $webbloger_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( webbloger_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'webbloger_action_page_content_wrap_data', $webbloger_prev_post_loading );
			?>>
				<?php
				do_action( 'webbloger_action_page_content_wrap', $webbloger_full_post_loading || $webbloger_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'webbloger_filter_single_post_header', webbloger_is_singular( 'post' ) || webbloger_is_singular( 'attachment' ) ) ) {
					if ( $webbloger_prev_post_loading ) {
						if ( webbloger_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'webbloger_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$webbloger_path = apply_filters( 'webbloger_filter_get_template_part', 'templates/single-styles/' . webbloger_get_theme_option( 'single_style' ) );
					if ( webbloger_get_file_dir( $webbloger_path . '.php' ) != '' ) {
						get_template_part( $webbloger_path );
					}
				}

				// Widgets area above page
				$webbloger_body_style   = webbloger_get_theme_option( 'body_style' );
				$webbloger_widgets_name = webbloger_get_theme_option( 'widgets_above_page' );
				$webbloger_show_widgets = ! webbloger_is_off( $webbloger_widgets_name ) && is_active_sidebar( $webbloger_widgets_name );
				if ( $webbloger_show_widgets ) {
					if ( 'fullscreen' != $webbloger_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					webbloger_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $webbloger_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'webbloger_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $webbloger_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'webbloger_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'webbloger_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="webbloger_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( webbloger_is_singular( 'post' ) || webbloger_is_singular( 'attachment' ) )
							&& $webbloger_prev_post_loading 
							&& webbloger_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'webbloger_action_between_posts' );
						}

						// Widgets area above content
						webbloger_create_widgets_area( 'widgets_above_content' );

						do_action( 'webbloger_action_page_content_start_text' );
