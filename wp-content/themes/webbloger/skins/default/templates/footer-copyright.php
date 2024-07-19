<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$webbloger_copyright_scheme = webbloger_get_theme_option( 'copyright_scheme' );
if ( ! empty( $webbloger_copyright_scheme ) && ! webbloger_is_inherit( $webbloger_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $webbloger_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$webbloger_copyright = webbloger_get_theme_option( 'copyright' );
			if ( ! empty( $webbloger_copyright ) ) {
				$webbloger_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $webbloger_copyright );
				$webbloger_copyright = webbloger_prepare_macros( $webbloger_copyright );
				// Display copyright
				echo wp_kses( nl2br( $webbloger_copyright ), 'webbloger_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
