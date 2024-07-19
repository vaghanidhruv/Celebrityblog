<?php
/**
 * The "Style 8" template to display the post header of the single post or attachment:
 * featured image and title placed in the post header
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.75.0
 */

if ( apply_filters( 'webbloger_filter_single_post_header', is_singular( 'post' ) || is_singular( 'attachment' ) ) ) {
	$webbloger_post_format = str_replace( 'post-format-', '', get_post_format() );
	// Featured image
	ob_start();
	webbloger_show_post_featured_image( array(
		'thumb_bg' => false,
		'popup'    => true,
	) );
	$webbloger_post_header = ob_get_contents();
	ob_end_clean();
	$webbloger_with_featured_image = webbloger_is_with_featured_image( $webbloger_post_header );

	if ( strpos( $webbloger_post_header, 'post_featured' ) !== false
		|| strpos( $webbloger_post_header, 'post_title' ) !== false
		|| strpos( $webbloger_post_header, 'post_meta' ) !== false
	) {
		?>
		<div class="post_header_wrap post_header_wrap_in_header post_header_wrap_style_<?php
			echo esc_attr( webbloger_get_theme_option( 'single_style' ) );
			if ( $webbloger_with_featured_image ) {
				echo ' with_featured_image';
			}
		?>">
			<div class="content_wrap">
				<?php
				webbloger_show_layout( $webbloger_post_header );
				?>
			</div>
		</div>
		<?php
	}
}