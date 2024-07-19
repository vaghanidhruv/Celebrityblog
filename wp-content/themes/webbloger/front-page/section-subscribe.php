<div class="front_page_section front_page_section_subscribe<?php
	$webbloger_scheme = webbloger_get_theme_option( 'front_page_subscribe_scheme' );
	if ( ! empty( $webbloger_scheme ) && ! webbloger_is_inherit( $webbloger_scheme ) ) {
		echo ' scheme_' . esc_attr( $webbloger_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( webbloger_get_theme_option( 'front_page_subscribe_paddings' ) );
	if ( webbloger_get_theme_option( 'front_page_subscribe_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$webbloger_css      = '';
		$webbloger_bg_image = webbloger_get_theme_option( 'front_page_subscribe_bg_image' );
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
	$webbloger_anchor_icon = webbloger_get_theme_option( 'front_page_subscribe_anchor_icon' );
	$webbloger_anchor_text = webbloger_get_theme_option( 'front_page_subscribe_anchor_text' );
if ( ( ! empty( $webbloger_anchor_icon ) || ! empty( $webbloger_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_subscribe"'
									. ( ! empty( $webbloger_anchor_icon ) ? ' icon="' . esc_attr( $webbloger_anchor_icon ) . '"' : '' )
									. ( ! empty( $webbloger_anchor_text ) ? ' title="' . esc_attr( $webbloger_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_subscribe_inner
	<?php
	if ( webbloger_get_theme_option( 'front_page_subscribe_fullheight' ) ) {
		echo ' webbloger-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$webbloger_css      = '';
			$webbloger_bg_mask  = webbloger_get_theme_option( 'front_page_subscribe_bg_mask' );
			$webbloger_bg_color_type = webbloger_get_theme_option( 'front_page_subscribe_bg_color_type' );
			if ( 'custom' == $webbloger_bg_color_type ) {
				$webbloger_bg_color = webbloger_get_theme_option( 'front_page_subscribe_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$webbloger_caption = webbloger_get_theme_option( 'front_page_subscribe_caption' );
			if ( ! empty( $webbloger_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo ! empty( $webbloger_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $webbloger_caption, 'webbloger_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$webbloger_description = webbloger_get_theme_option( 'front_page_subscribe_description' );
			if ( ! empty( $webbloger_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo ! empty( $webbloger_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $webbloger_description ), 'webbloger_kses_content' ); ?></div>
				<?php
			}

			// Content
			$webbloger_sc = webbloger_get_theme_option( 'front_page_subscribe_shortcode' );
			if ( ! empty( $webbloger_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo ! empty( $webbloger_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					webbloger_show_layout( do_shortcode( $webbloger_sc ) );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
