<?php
/**
 * Template to display shortcode's link in the Elementor preview area
 *
 * Written as a Backbone JavaScript template and used to generate the live preview.
 *
 * @package ThemeREX Addons
 * @since v1.6.41
 */
extract(get_query_var('trx_addons_args_sc_show_links'));
?><#

// Default values
settings = trx_addons_array_merge({
									'link_image':	{ 'url': '' }
									}, settings);

var title_align = settings.title_align ? ' sc_align_'+settings.title_align : '';

if (typeof settings.link_image != 'undefined' && settings.link_image.url != '') {
	#><div class="<?php echo esc_attr($sc); ?>_button_image sc_item_button_image{{ title_align }}"><#
		if (settings.link.url != '') {
			#><a href="{{ settings.link.url }}"<#
				if (settings.link.is_external == 'on') print(' target="_blank"');
				if (settings.link.nofollow == 'on') print(' rel="nofollow"');
			#>><#
		}
		#><img src="{{ settings.link_image.url }}" alt="<?php esc_attr_e("Button's image", 'webbloger'); ?>"><#
		if (settings.link.url != '') {
			#></a><#
		}
	#></div><#
} else if (settings.link.url != '' && settings.link_text !='') {
	#><div class="sc_item_button sc_button_wrap {{ title_align }}"><#
		#><a href="{{ settings.link.url }}" class="sc_button sc_button_size_normal <# print('sc_button_' + settings.link_style ); #> 
			<# print(typeof settings.color_style != 'undefined' && settings.color_style != '' && settings.color_style != 'default' ? ' color_style_' + settings.color_style : ''); #> 
			<# print(typeof settings.hover_style != 'undefined' && settings.hover_style != '' && settings.hover_style != 'default' ? ' hover_style_' + settings.hover_style : ''); #>"<#
				if (settings.link.is_external == 'on') print(' target="_blank"');
		#>><span class="sc_button_text"><span class="sc_button_title">{{ settings.link_text }}</span></span><!-- /.sc_button_text --></a><!-- /.sc_button --><#
	#></div><!-- /.sc_item_button --><#
}
#>