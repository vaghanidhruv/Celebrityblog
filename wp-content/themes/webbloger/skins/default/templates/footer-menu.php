<?php
/**
 * The template to display menu in the footer
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.10
 */

// Footer menu
$webbloger_menu_footer = webbloger_skin_get_nav_menu( 'menu_footer' );
if ( ! empty( $webbloger_menu_footer ) ) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php
			webbloger_show_layout(
				$webbloger_menu_footer,
				'<nav class="menu_footer_nav_area sc_layouts_menu sc_layouts_menu_default"'
					. ' itemscope="itemscope" itemtype="' . esc_attr( webbloger_get_protocol( true ) ) . '//schema.org/SiteNavigationElement"'
					. '>',
				'</nav>'
			);
			?>
		</div>
	</div>
	<?php
}
