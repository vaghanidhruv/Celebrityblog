<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_args = get_query_var( 'webbloger_logo_args' );

// Site logo
$webbloger_logo_type   = isset( $webbloger_args['type'] ) ? $webbloger_args['type'] : '';
$webbloger_logo_image  = webbloger_get_logo_image( $webbloger_logo_type );
$webbloger_logo_text   = webbloger_is_on( webbloger_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$webbloger_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $webbloger_logo_image['logo'] ) || ! empty( $webbloger_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $webbloger_logo_image['logo'] ) ) {
			if ( empty( $webbloger_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $webbloger_logo_image['logo'] ) && $webbloger_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$webbloger_attr = webbloger_getimagesize( $webbloger_logo_image['logo'] );
				echo '<img src="' . esc_url( $webbloger_logo_image['logo'] ) . '"'
						. ( ! empty( $webbloger_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $webbloger_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $webbloger_logo_text ) . '"'
						. ( ! empty( $webbloger_attr[3] ) ? ' ' . wp_kses_data( $webbloger_attr[3] ) : '' )
						. '>';
			}
		} else {
			webbloger_show_layout( webbloger_prepare_macros( $webbloger_logo_text ), '<span class="logo_text">', '</span>' );
			webbloger_show_layout( webbloger_prepare_macros( $webbloger_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
