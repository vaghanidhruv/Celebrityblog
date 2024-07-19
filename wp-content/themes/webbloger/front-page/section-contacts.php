<div class="front_page_section front_page_section_contacts<?php
	$webbloger_scheme = webbloger_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $webbloger_scheme ) && ! webbloger_is_inherit( $webbloger_scheme ) ) {
		echo ' scheme_' . esc_attr( $webbloger_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( webbloger_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( webbloger_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$webbloger_css      = '';
		$webbloger_bg_image = webbloger_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $webbloger_bg_image ) ) {
			$webbloger_css .= 'background-image: url(' . esc_url( webbloger_get_attachment_url( $webbloger_bg_image ) ) . ');';
		}
		if ( ! empty( $webbloger_css ) ) {
			echo ' style="' . esc_attr( $webbloger_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$webbloger_anchor_icon = webbloger_get_theme_option( 'front_page_contacts_anchor_icon' );
	$webbloger_anchor_text = webbloger_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $webbloger_anchor_icon ) || ! empty( $webbloger_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $webbloger_anchor_icon ) ? ' icon="' . esc_attr( $webbloger_anchor_icon ) . '"' : '' )
									. ( ! empty( $webbloger_anchor_text ) ? ' title="' . esc_attr( $webbloger_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( webbloger_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' webbloger-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$webbloger_css      = '';
			$webbloger_bg_mask  = webbloger_get_theme_option( 'front_page_contacts_bg_mask' );
			$webbloger_bg_color_type = webbloger_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $webbloger_bg_color_type ) {
				$webbloger_bg_color = webbloger_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $webbloger_bg_color_type ) {
				$webbloger_bg_color = webbloger_get_scheme_color( 'bg_color', $webbloger_scheme );
			} else {
				$webbloger_bg_color = '';
			}
			if ( ! empty( $webbloger_bg_color ) && $webbloger_bg_mask > 0 ) {
				$webbloger_css .= 'background-color: ' . esc_attr(
					1 == $webbloger_bg_mask ? $webbloger_bg_color : webbloger_hex2rgba( $webbloger_bg_color, $webbloger_bg_mask )
				) . ';';
			}
			if ( ! empty( $webbloger_css ) ) {
				echo ' style="' . esc_attr( $webbloger_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$webbloger_caption     = webbloger_get_theme_option( 'front_page_contacts_caption' );
			$webbloger_description = webbloger_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $webbloger_caption ) || ! empty( $webbloger_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $webbloger_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $webbloger_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $webbloger_caption, 'webbloger_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $webbloger_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $webbloger_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $webbloger_description ), 'webbloger_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$webbloger_content = webbloger_get_theme_option( 'front_page_contacts_content' );
			$webbloger_layout  = webbloger_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $webbloger_layout && ( ! empty( $webbloger_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $webbloger_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $webbloger_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $webbloger_content, 'webbloger_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $webbloger_layout && ( ! empty( $webbloger_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$webbloger_sc = webbloger_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $webbloger_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $webbloger_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					webbloger_show_layout( do_shortcode( $webbloger_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $webbloger_layout && ( ! empty( $webbloger_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
