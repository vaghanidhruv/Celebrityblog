<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */

// Logo
if ( webbloger_is_on( webbloger_get_theme_option( 'logo_in_footer' ) ) ) {
	$webbloger_logo_image = webbloger_get_logo_image( 'footer' );
	$webbloger_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $webbloger_logo_image['logo'] ) || ! empty( $webbloger_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $webbloger_logo_image['logo'] ) ) {
					$webbloger_attr = webbloger_getimagesize( $webbloger_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $webbloger_logo_image['logo'] ) . '"'
								. ( ! empty( $webbloger_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $webbloger_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'webbloger' ) . '"'
								. ( ! empty( $webbloger_attr[3] ) ? ' ' . wp_kses_data( $webbloger_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $webbloger_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $webbloger_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
