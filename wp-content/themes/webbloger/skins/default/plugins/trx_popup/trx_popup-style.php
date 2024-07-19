<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'webbloger_trx_popup_get_css' ) ) {
	add_filter( 'webbloger_filter_get_css', 'webbloger_trx_popup_get_css', 10, 2 );
	function webbloger_trx_popup_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
CSS;
		}

		return $css;
	}
}

