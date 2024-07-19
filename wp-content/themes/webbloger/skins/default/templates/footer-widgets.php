<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */

// Footer sidebar
$webbloger_footer_name    = webbloger_get_theme_option( 'footer_widgets' );
$webbloger_footer_present = ! webbloger_is_off( $webbloger_footer_name ) && is_active_sidebar( $webbloger_footer_name );
if ( $webbloger_footer_present ) {
	webbloger_storage_set( 'current_sidebar', 'footer' );
	$webbloger_footer_wide = webbloger_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $webbloger_footer_name ) ) {
		dynamic_sidebar( $webbloger_footer_name );
	}
	$webbloger_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $webbloger_out ) ) {
		$webbloger_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $webbloger_out );
		$webbloger_need_columns = true;  
		if ( $webbloger_need_columns ) {
			$webbloger_columns = max( 0, (int) webbloger_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $webbloger_columns ) {
				$webbloger_columns = min( 4, max( 1, webbloger_tags_count( $webbloger_out, 'aside' ) ) );
			}
			if ( $webbloger_columns > 1 ) {
				$webbloger_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $webbloger_columns ) . ' widget', $webbloger_out );
			} else {
				$webbloger_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $webbloger_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'webbloger_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $webbloger_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $webbloger_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'webbloger_action_before_sidebar', 'footer' );
				webbloger_show_layout( $webbloger_out );
				do_action( 'webbloger_action_after_sidebar', 'footer' );
				if ( $webbloger_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $webbloger_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'webbloger_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
