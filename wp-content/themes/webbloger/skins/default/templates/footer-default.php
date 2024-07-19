<?php
/**
 * The template to display default site footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$webbloger_footer_scheme = webbloger_get_theme_option( 'footer_scheme' );
$webbloger_footer_scheme = webbloger_is_woocommerce_page() ? webbloger_get_theme_option( 'woo_footer_scheme' ) : $webbloger_footer_scheme;
if ( ! empty( $webbloger_footer_scheme ) && ! webbloger_is_inherit( $webbloger_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $webbloger_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/footer-socials' ) );

	// Menu
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/footer-menu' ) );

	// Copyright area
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
