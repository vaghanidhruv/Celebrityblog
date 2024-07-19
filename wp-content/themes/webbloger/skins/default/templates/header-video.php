<?php
/**
 * The template to display the background video in the header
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.14
 */
$webbloger_header_video = webbloger_get_header_video();
$webbloger_embed_video  = '';
if ( ! empty( $webbloger_header_video ) && ! webbloger_is_from_uploads( $webbloger_header_video ) ) {
	if ( webbloger_is_youtube_url( $webbloger_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $webbloger_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php webbloger_show_layout( webbloger_get_embed_video( $webbloger_header_video ) ); ?></div>
		<?php
	}
}
