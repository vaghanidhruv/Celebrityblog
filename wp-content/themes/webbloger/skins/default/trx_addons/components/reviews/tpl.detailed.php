<?php
/**
 * Detailed template to display the "post reviews" block on the single page
 *
 * @package ThemeREX Addons
 * @since v1.6.57
 */

$trx_addons_args = get_query_var('trx_addons_args_sc_reviews');
$gutenberg_preview = function_exists('trx_addons_gutenberg_is_preview') && trx_addons_gutenberg_is_preview() && !trx_addons_sc_stack_check('trx_sc_blogger');
$trx_addons_meta = $gutenberg_preview
						? array(
								'reviews_enable' => true,
								'reviews_mark' => 50,
								'reviews_title' => __('Review title', 'webbloger'),
								'reviews_mark_text' => __('Mark title', 'webbloger'),
								'reviews_summary' => __('Real data Review this post you will see in the frontend.', 'webbloger'),
								)
						: get_post_meta( get_the_ID(), 'trx_addons_options', true );
if ( !empty($trx_addons_meta['reviews_enable']) && $trx_addons_meta['reviews_mark'] > 0 ) {
	?> <div class="trx_addons_reviews_block trx_addons_reviews_block_detailed<?php echo esc_attr(!empty($trx_addons_meta['reviews_image']) ? ' with_image' : ''); ?>"><?php
		
		// Title
		if ( !empty($trx_addons_meta['reviews_title']) && empty($trx_addons_meta['reviews_image']) ) {
			?><h6 class="trx_addons_reviews_block_title"><?php echo esc_html($trx_addons_meta['reviews_title']); ?></h6><?php
		}

		// Image 		
		if ( !empty($trx_addons_meta['reviews_image']) ) {
			$image = trx_addons_get_attachment_url($trx_addons_meta['reviews_image'], apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size('masonry'), 'reviews'));
			if (!empty($image)) {
				$attr = trx_addons_getimagesize($image);
				?><div class="trx_addons_reviews_block_image"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($trx_addons_meta['reviews_title']); ?>"<?php echo (!empty($attr[3]) ? ' '.trim($attr[3]) : ''); ?>></div><?php
			}
		}

		// Mark and summary
		?> <div class="trx_addons_reviews_block_info"><?php
			?><div class="trx_addons_reviews_block_mark_wrap"><?php
				?><div class="trx_addons_reviews_block_mark"><?php
					$trx_addons_reviews_max  = trx_addons_get_option('reviews_mark_max');
					$trx_addons_reviews_mark = trx_addons_reviews_mark2show( $trx_addons_meta['reviews_mark'], $trx_addons_reviews_max );
					$trx_addons_reviews_decimals = trx_addons_get_option('reviews_mark_decimals');
					?><canvas id="<?php echo esc_attr($trx_addons_args['id']); ?>_mark"
						width="90" height="90"
						data-max-value="<?php echo esc_attr($trx_addons_reviews_max); ?>"
						data-decimals="<?php echo esc_attr($trx_addons_reviews_decimals); ?>"
						data-value="<?php echo esc_attr($trx_addons_reviews_mark); ?>"
						data-color="<?php echo esc_attr( apply_filters('trx_addons_filter_get_theme_accent_color', '#efa758') ); ?>"></canvas><?php
					?><div class="trx_addons_reviews_block_mark_content">
						<span class="trx_addons_reviews_block_mark_value" data-max-value="<?php echo esc_attr($trx_addons_reviews_max); ?>"><?php
							echo esc_html( $trx_addons_reviews_mark );
						?></span><?php
						if ( !empty($trx_addons_meta['reviews_mark_text']) ) {
							?><span class="trx_addons_reviews_block_mark_text"><?php echo esc_html($trx_addons_meta['reviews_mark_text']); ?></span><?php
						} ?>
					</div>
					<span class="trx_addons_reviews_block_mark_progress"></span><?php
				?></div><?php
			?></div><?php

			if ( !empty($trx_addons_meta['reviews_summary']) ) {
				?> <div class="trx_addons_reviews_block_summary"> 
					<h6><?php echo esc_html__('Description', 'webbloger'); ?></h6><?php 
					echo nl2br( wp_kses_data( $trx_addons_meta['reviews_summary'] ) );

					// Pos & Neg
					if ( !empty($trx_addons_meta['reviews_positives']) || !empty($trx_addons_meta['reviews_negatives']) ) {
						?> <div class="trx_addons_reviews_block_pn"><?php
							// Positive
							?><div class="trx_addons_reviews_block_positives">
								<p class="trx_addons_reviews_block_subtitle"><?php esc_html_e('Positives', 'webbloger'); ?></p>
								<?php
								if (!empty($trx_addons_meta['reviews_positives'])) {
									$items = explode( "\n", str_replace("\r", '', $trx_addons_meta['reviews_positives']) );
									if (count($items) > 0) {
										?><ul class="trx_addons_reviews_block_list"><?php
										foreach($items as $item) {
											$item = trim($item);
											if (empty($item)) continue;
											?><li><?php echo esc_html($item); ?></li><?php
										}
									}
								}
							?></div><?php

							// Negative
							?><div class="trx_addons_reviews_block_negatives">
								<p class="trx_addons_reviews_block_subtitle"><?php esc_html_e('Negatives', 'webbloger'); ?></p>
								<?php
								if (!empty($trx_addons_meta['reviews_negatives'])) {
									$items = explode( "\n", str_replace("\r", '', $trx_addons_meta['reviews_negatives']) );
									if (count($items) > 0) {
										?><ul class="trx_addons_reviews_block_list"><?php
										foreach($items as $item) {
											$item = trim($item);
											if (empty($item)) continue;
											?><li><?php echo esc_html($item); ?></li><?php
										}
										?></ul><?php
									}
								}
							?></div>
						</div> <?php
					} ?>
				</div> <?php 
			}
		?> </div>

		<div class="trx_addons_reviews_block_footer_info"><?php
			// Criterias
			if ( !empty($trx_addons_meta['reviews_criterias']) && count($trx_addons_meta['reviews_criterias']) > 0 && $trx_addons_meta['reviews_criterias'][0]['mark'] > 0 ) {
				?><div class="trx_addons_reviews_block_criterias" data-mark-max="<?php echo esc_attr($trx_addons_reviews_max); ?>">
					<p class="trx_addons_reviews_block_subtitle"><?php esc_html_e('Review Breakdown', 'webbloger'); ?></p>
					<ul class="trx_addons_reviews_block_list">
						<?php
						foreach($trx_addons_meta['reviews_criterias'] as $item) {
							if (empty($item['title']) || empty($item['mark'])) continue;
							$trx_addons_reviews_mark = trx_addons_reviews_mark2show( $item['mark'], $trx_addons_reviews_max );
							?><li>
								<span class="trx_addons_reviews_block_list_title"><?php echo esc_html($item['title']); ?></span>
								<?php
								if ( $trx_addons_reviews_max == 5 ) {
									?><span class="trx_addons_reviews_block_list_mark"><?php
										trx_addons_reviews_show_stars( 'p'.get_the_ID(), array(
											'mark' => $trx_addons_reviews_mark,
											'mark_max' => $trx_addons_reviews_max
										));
									?></span><?php
								} else {
									?>
									<span class="trx_addons_reviews_block_list_mark">
										<span class="trx_addons_reviews_block_list_mark_value"><?php echo esc_html($trx_addons_reviews_mark); ?></span>
										<span class="trx_addons_reviews_block_list_mark_line"></span>
										<span class="trx_addons_reviews_block_list_mark_line_hover" style="width:<?php echo esc_attr($item['mark']); ?>%;"></span>
									</span>
									<?php
								}
							?></li><?php
						}
						?>
					</ul>
				</div><?php
			}

			// Attributes
			if ( !empty($trx_addons_meta['reviews_attributes']) && count($trx_addons_meta['reviews_attributes']) > 0 && !empty($trx_addons_meta['reviews_attributes'][0]['title']) ) {
				?><div class="trx_addons_reviews_block_attributes"><?php
					foreach($trx_addons_meta['reviews_attributes'] as $attr) {
						if ( empty($attr['title']) && empty($attr['value']) ) continue;
						?><div class="trx_addons_reviews_block_attributes_row trx_addons_reviews_block_attributes_row_type_<?php echo esc_attr($attr['type']); ?>"><?php
							if ( !empty($attr['link']) ) {
								?><a href="<?php echo esc_url($attr['link']); ?>" class="trx_addons_reviews_block_attributes_<?php echo esc_attr($attr['type'] == 'text' ? 'link' : 'button sc_button sc_button_default sc_button_size_large sc_button_with_icon sc_button_icon_left color_style_1 hover_style_1'); ?>"><?php
							}							
							if ( !empty($attr['link']) && ! empty($attr['title']) ) {
								?><span class="sc_button_icon"><span class="icon-cart-3"></span></span>
								<span class="sc_button_text"><span class="sc_button_title"><?php echo esc_html($attr['title']); ?></span></span><?php
							}
							if ( empty($attr['link']) && ! empty($attr['title']) ) {
								?><span class="trx_addons_reviews_block_attributes_title"><?php echo esc_html($attr['title']); ?></span><?php
							}
							if ( ! empty($attr['value']) && ! empty($attr['title'])) {
								?><span class="trx_addons_reviews_block_attributes_line"></span><?php
							}
							if ( ! empty($attr['value']) ) {
								?><span class="trx_addons_reviews_block_attributes_value"><?php echo esc_html($attr['value']); ?></span><?php
							}
							if ( !empty($attr['link']) ) {
								?></a><?php
							}
						?></div><?php
					}
				?></div><?php
			}

			// Button
			if ( !empty($trx_addons_meta['reviews_link']) && !empty($trx_addons_meta['reviews_link_caption']) ) {
				?><div class="trx_addons_reviews_block_buttons"><?php
					if ( !empty($trx_addons_meta['reviews_link_title']) ) {
						?><p class="trx_addons_reviews_block_subtitle"><?php echo esc_html($trx_addons_meta['reviews_link_title']); ?></p><?php
					}
					?><a href="<?php echo esc_url($trx_addons_meta['reviews_link']); ?>" class="trx_addons_reviews_block_button sc_button sc_button_default sc_button_size_large sc_button_with_icon sc_button_icon_left hover_style_1 color_style_1">
						<span class="sc_button_icon">
							<span class="icon-cart-3"></span>
						</span>
						<span class="sc_button_text">
							<span class="sc_button_title"><?php echo esc_html($trx_addons_meta['reviews_link_caption']); ?></span>
						</span>
					</a>
				</div><?php
			} ?>
		</div>
</div> <?php
}
