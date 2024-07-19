<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

if ( webbloger_sidebar_present() ) {
	
	$webbloger_sidebar_type = webbloger_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $webbloger_sidebar_type && ! webbloger_is_layouts_available() ) {
		$webbloger_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $webbloger_sidebar_type ) {
		// Default sidebar with widgets
		$webbloger_sidebar_name = webbloger_get_theme_option( 'sidebar_widgets' );
		webbloger_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $webbloger_sidebar_name ) ) {
			dynamic_sidebar( $webbloger_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$webbloger_sidebar_id = webbloger_get_custom_sidebar_id();
		do_action( 'webbloger_action_show_layout', $webbloger_sidebar_id );
	}
	$webbloger_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $webbloger_out ) ) {
		$webbloger_sidebar_position    = webbloger_get_theme_option( 'sidebar_position' );
		$webbloger_sidebar_position_ss = webbloger_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $webbloger_sidebar_position );
			echo ' sidebar_' . esc_attr( $webbloger_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $webbloger_sidebar_type );

			$webbloger_sidebar_scheme = apply_filters( 'webbloger_filter_sidebar_scheme', webbloger_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $webbloger_sidebar_scheme ) && ! webbloger_is_inherit( $webbloger_sidebar_scheme ) && 'custom' != $webbloger_sidebar_type ) {
				echo ' scheme_' . esc_attr( $webbloger_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="webbloger_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'webbloger_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $webbloger_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$webbloger_title = apply_filters( 'webbloger_filter_sidebar_control_title', 'float' == $webbloger_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'webbloger' ) : '' );
				$webbloger_text  = apply_filters( 'webbloger_filter_sidebar_control_text', 'above' == $webbloger_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'webbloger' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $webbloger_title ); ?>"><?php echo esc_html( $webbloger_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'webbloger_action_before_sidebar', 'sidebar' );
				webbloger_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $webbloger_out ) );
				do_action( 'webbloger_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'webbloger_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
