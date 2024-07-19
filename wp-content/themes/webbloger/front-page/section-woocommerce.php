<?php
$webbloger_woocommerce_sc = webbloger_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $webbloger_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$webbloger_scheme = webbloger_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $webbloger_scheme ) && ! webbloger_is_inherit( $webbloger_scheme ) ) {
			echo ' scheme_' . esc_attr( $webbloger_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( webbloger_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( webbloger_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$webbloger_css      = '';
			$webbloger_bg_image = webbloger_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$webbloger_anchor_icon = webbloger_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$webbloger_anchor_text = webbloger_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $webbloger_anchor_icon ) || ! empty( $webbloger_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $webbloger_anchor_icon ) ? ' icon="' . esc_attr( $webbloger_anchor_icon ) . '"' : '' )
											. ( ! empty( $webbloger_anchor_text ) ? ' title="' . esc_attr( $webbloger_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( webbloger_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' webbloger-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$webbloger_css      = '';
				$webbloger_bg_mask  = webbloger_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$webbloger_bg_color_type = webbloger_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $webbloger_bg_color_type ) {
					$webbloger_bg_color = webbloger_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$webbloger_caption     = webbloger_get_theme_option( 'front_page_woocommerce_caption' );
				$webbloger_description = webbloger_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $webbloger_caption ) || ! empty( $webbloger_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $webbloger_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $webbloger_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $webbloger_caption, 'webbloger_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $webbloger_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $webbloger_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $webbloger_description ), 'webbloger_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $webbloger_woocommerce_sc ) {
						$webbloger_woocommerce_sc_ids      = webbloger_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$webbloger_woocommerce_sc_per_page = count( explode( ',', $webbloger_woocommerce_sc_ids ) );
					} else {
						$webbloger_woocommerce_sc_per_page = max( 1, (int) webbloger_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$webbloger_woocommerce_sc_columns = max( 1, min( $webbloger_woocommerce_sc_per_page, (int) webbloger_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$webbloger_woocommerce_sc}"
										. ( 'products' == $webbloger_woocommerce_sc
												? ' ids="' . esc_attr( $webbloger_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $webbloger_woocommerce_sc
												? ' category="' . esc_attr( webbloger_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $webbloger_woocommerce_sc
												? ' orderby="' . esc_attr( webbloger_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( webbloger_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $webbloger_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $webbloger_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
