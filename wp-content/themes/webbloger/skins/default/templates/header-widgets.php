<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

// Header sidebar
$webbloger_header_name    = webbloger_get_theme_option( 'header_widgets' );
$webbloger_header_present = ! webbloger_is_off( $webbloger_header_name ) && is_active_sidebar( $webbloger_header_name );
if ( $webbloger_header_present ) {
	webbloger_storage_set( 'current_sidebar', 'header' );
	$webbloger_header_wide = webbloger_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $webbloger_header_name ) ) {
		dynamic_sidebar( $webbloger_header_name );
	}
	$webbloger_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $webbloger_widgets_output ) ) {
		$webbloger_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $webbloger_widgets_output );
		$webbloger_need_columns   = strpos( $webbloger_widgets_output, 'columns_wrap' ) === false;
		if ( $webbloger_need_columns ) {
			$webbloger_columns = max( 0, (int) webbloger_get_theme_option( 'header_columns' ) );
			if ( 0 == $webbloger_columns ) {
				$webbloger_columns = min( 6, max( 1, webbloger_tags_count( $webbloger_widgets_output, 'aside' ) ) );
			}
			if ( $webbloger_columns > 1 ) {
				$webbloger_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $webbloger_columns ) . ' widget', $webbloger_widgets_output );
			} else {
				$webbloger_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $webbloger_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'webbloger_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $webbloger_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $webbloger_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'webbloger_action_before_sidebar', 'header' );
				webbloger_show_layout( $webbloger_widgets_output );
				do_action( 'webbloger_action_after_sidebar', 'header' );
				if ( $webbloger_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $webbloger_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'webbloger_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
