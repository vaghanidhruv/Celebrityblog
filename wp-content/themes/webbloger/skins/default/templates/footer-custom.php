<?php
/**
 * The template to display default site footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */

$webbloger_footer_id = webbloger_get_custom_footer_id();
$webbloger_footer_meta = webbloger_get_custom_layout_meta( $webbloger_footer_id );
if ( ! empty( $webbloger_footer_meta['margin'] ) ) {
	webbloger_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( webbloger_prepare_css_value( $webbloger_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $webbloger_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $webbloger_footer_id ) ) ); ?>
						<?php
						$webbloger_footer_scheme = webbloger_get_theme_option( 'footer_scheme' );
						$webbloger_footer_scheme = webbloger_is_woocommerce_page() ? 
													( ( empty(webbloger_get_theme_option( 'woo_footer_scheme' ) ) || webbloger_get_theme_option( 'woo_footer_scheme' ) === 'inherit') ? 
														$webbloger_footer_scheme 
														: webbloger_get_theme_option( 'woo_footer_scheme' ) ) 
													: $webbloger_footer_scheme;
						if ( ! empty( $webbloger_footer_scheme ) && ! webbloger_is_inherit( $webbloger_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $webbloger_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'webbloger_action_show_layout', $webbloger_footer_id );
	?>
</footer><!-- /.footer_wrap -->
