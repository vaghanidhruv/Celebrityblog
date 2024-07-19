<?php
// Add theme-specific CSS-animations
if ( ! function_exists( 'webbloger_elm_add_theme_animations' ) ) {
	add_filter( 'elementor/controls/animations/additional_animations', 'webbloger_elm_add_theme_animations' );
	function webbloger_elm_add_theme_animations( $animations ) {
		/* To add a theme-specific animations to the list:
			1) Merge to the array 'animations': array(
													esc_html__( 'Theme Specific', 'webbloger' ) => array(
														'ta_custom_1' => esc_html__( 'Custom 1', 'webbloger' )
													)
												)
			2) Add a CSS rules for the class '.ta_custom_1' to create a custom entrance animation
		*/
		$animations = array_merge(
						$animations,
						array(
							esc_html__( 'Theme Specific', 'webbloger' ) => array(
																			'ta_fadeinup'     => esc_html__( 'Fade In Up (Short)', 'webbloger' ),
																			'ta_fadeinright'  => esc_html__( 'Fade In Right (Short)', 'webbloger' ),
																			'ta_fadeinleft'   => esc_html__( 'Fade In Left (Short)', 'webbloger' ),
																			'ta_fadeindown'   => esc_html__( 'Fade In Down (Short)', 'webbloger' ),
																			'ta_fadein'       => esc_html__( 'Fade In (Short)', 'webbloger' ),
																			'ta_under_strips' => esc_html__( 'Under strips', 'webbloger' ),
																			'ta_mouse_wheel' => esc_html__( 'Mouse Wheel', 'webbloger' ),
																			'blogger_coverbg_parallax' => esc_html__( 'Only Blogger cover image parallax', 'webbloger' ),
																			)
							)
						);
		return $animations;
	}
}
