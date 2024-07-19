<?php
/**
 * The template to display the socials in the footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */


// Socials
if ( webbloger_is_on( webbloger_get_theme_option( 'socials_in_footer' ) ) ) {
	$webbloger_output = webbloger_get_socials_links();
	if ( '' != $webbloger_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php webbloger_show_layout( $webbloger_output ); ?>
			</div>
		</div>
		<?php
	}
}
