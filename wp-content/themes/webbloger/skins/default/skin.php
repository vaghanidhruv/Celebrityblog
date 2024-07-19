<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.46
 */

// SKIN SETUP
//--------------------------------------------------------------------

// Setup fonts, colors, blog and single styles, etc.
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'skin-setup.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Skin options
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'skin-options.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Required plugins
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'skin-plugins.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Demo import
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'skin-demo-importer.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Woocomerce skin settings
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/woocommerce/woocommerce-skin.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Gutenberg skin settings
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/gutenberg/gutenberg-skin.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Powerkit skin settings
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/powerkit/powerkit-skin.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}

// Contact Form 7 skin settings
$webbloger_skin_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/contact-form-7/contact-form-7-skin.php' );
if ( ! empty( $webbloger_skin_path ) ) {
	require_once $webbloger_skin_path;
}


// TRX_ADDONS SETUP
//--------------------------------------------------------------------

// Filter to add in the required plugins list
// Priority 11 to add new plugins to the end of the list
if ( ! function_exists( 'webbloger_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_skin_tgmpa_required_plugins', 11 );
	function webbloger_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( webbloger_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => webbloger_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug', 'title' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}

		foreach ($list as $key => $plugin) {
			if ( in_array ($plugin['slug'], array('contact-form-7-datepicker', 'coblocks') )) {
				unset($list[$key]);
			}
		}
		return $list;
	}
}
// Override internal settings of the theme.
if ( ! function_exists( 'webbloger_skin_override_theme_settings' ) ) {
	add_action( 'after_setup_theme', 'webbloger_skin_override_theme_settings', 1 );
	function webbloger_skin_override_theme_settings() {
		// ToDo: Set a new value of the theme settings
		//---> For example (to add a theme-specific checkboxes "Hide on XXX" after the Elementor's checkboxes):
		//---> webbloger_storage_set_array( 'settings', 'add_hide_on_xxx', 'add' );
	}
}

// Filter to add/remove components of ThemeREX Addons when current skin is active
if ( ! function_exists( 'webbloger_skin_trx_addons_default_components' ) ) {
	add_filter('trx_addons_filter_load_options', 'webbloger_skin_trx_addons_default_components', 20);
	function webbloger_skin_trx_addons_default_components($components) {
		return $components;
	}
}

// Filter to add/remove CPT
if ( ! function_exists( 'webbloger_skin_trx_addons_cpt_list' ) ) {
	add_filter('trx_addons_cpt_list', 'webbloger_skin_trx_addons_cpt_list');
	function webbloger_skin_trx_addons_cpt_list( $list = array() ) {
		return $list;
	}
}

// Filter to add/remove shortcodes
if ( ! function_exists( 'webbloger_skin_trx_addons_sc_list' ) ) {
	add_filter('trx_addons_sc_list', 'webbloger_skin_trx_addons_sc_list');
	function webbloger_skin_trx_addons_sc_list( $list = array() ) {
		// Button
		$list['button']['layouts_sc']['rounded'] = esc_html__('Rounded', 'webbloger');

		// Blogger Default
		$list['blogger']['templates']['default'] = 
		array(
			'classic' => array(
				'title'  => esc_html__('Classic Grid', 'webbloger'),
				'layout' => array(
					'featured' => array(),
					'content' => array(
						'meta_categories', 'title', 'price', 'excerpt', 'meta', 'readmore'
					),
				)
			),
			'classic_2' => array(
				'title'  => esc_html__('Classic with cats over image', 'webbloger'),
				'layout' => array(
					'featured' => array(
						'bc' => array(
							'meta_categories'
						),
					),
					'content' => array(
						'title', 'excerpt', 'meta', 'readmore'
					)
				)
			),
			'classic_3' => array(
				'title'  => esc_html__('Classic with border bottom', 'webbloger'),
				'layout' => array(
					'featured' => array(),
					'content' => array(
						'meta_categories', 'title', 'excerpt', 'meta', 'readmore'
					)
				)
			),
			'classic_4' => array(
				'title'  => esc_html__('Classic with header above', 'webbloger'),
				'layout' => array(
					'header' => array(
						'meta_categories', 'title', 'meta'
					),
					'featured' => array(),
					'content' => array(
						'excerpt', 'readmore', 'meta_share'
					)
				)
			),
			'classic_5' => array(
				'title' => esc_html__('Classic with alternative structure', 'webbloger'),
				'grid'  => array(
						// One post
						array(
							'grid-layout' => array(
								array(
									'template' => 'default/classic',
									'args' => array( 'image_ratio' => '16:9', 'columns' => 1 )
								),
							)
						),
						// Two posts
						array(
							'grid-layout' => array(
								array(
									'template' => 'default/classic',
									'args' => array( 'image_ratio' => '9:8', 'columns' => 1 )
								),
								array(
									'template' => 'default/classic',
									'args' => array( 'image_ratio' => '16:9', 'columns' => 1 )
								),
							)
						)
					)
			),
			'over_centered' => array(
				'title'  => esc_html__('Info over image (center)', 'webbloger'),
				'layout' => array(
					'featured' => array(
						'mc' => array(
							'meta_categories', 'title', 'meta', 'readmore'
						),
					),
				)
			),
			'over_bottom_center' => array(
				'title'  => esc_html__('Info over image (bottom)', 'webbloger'),
				'layout' => array(
					'featured' => array(
						'bc' => array(
							'meta_categories', 'title', 'meta', 'readmore'
						),
					),
				)
			),
			'over_bottom_modern' => array(
				'title'  => esc_html__('Info over image (modern)', 'webbloger'),
				'layout' => array(
					'featured' => array(
						'bc' => array(
							'meta_categories', 'title', 'meta', 'readmore'
						),
					),
				)
			),
		);

		// Blogger Wide
		$list['blogger']['templates']['wide'] = 
		array(
			'default' => array(
				'title'  => esc_html__('Default', 'webbloger'),
				'layout' => array(
					'featured' => array(
					),
					'content' => array(
						'meta_categories', 'title', 'meta', 'excerpt', 'readmore'
					)
				)
			)
		);

		// Blogger List
		$list['blogger']['templates']['list']['with_rounded_image'] = 
		array(
			'title'  => esc_html__('With rounded image', 'webbloger'),
			'layout' => array(
				'featured' => array(
				),
				'content' => array(
					'meta_categories', 'title', 'meta'
				)
			)
		);
		return $list;
	}
}

// Filter to add/remove widgets
if ( ! function_exists( 'webbloger_skin_trx_addons_widgets_list' ) ) {
	add_filter('trx_addons_widgets_list', 'webbloger_skin_trx_addons_widgets_list');
	function webbloger_skin_trx_addons_widgets_list( $list = array() ) {
		return $list;
	}
}

// Scroll to top progress
if ( ! function_exists( 'webbloger_skin_trx_addons_scroll_progress_type' ) ) {
	add_filter('trx_addons_filter_scroll_progress_type', 'webbloger_skin_trx_addons_scroll_progress_type');
	function webbloger_skin_trx_addons_scroll_progress_type( $type = '' ) {
		return 'round';	// round | box | vertical | horizontal
	}
}

// Posts meta arguments
if ( ! function_exists( 'webbloger_skin_trx_addons_post_meta_args' ) ) {
	add_filter( 'trx_addons_filter_post_meta_args', 'webbloger_skin_trx_addons_post_meta_args', 10, 3 );
	function webbloger_skin_trx_addons_post_meta_args($array, $type, $x) {
		if ( $type == 'posts-list' ) {
			$array['components'] = 'comments';
		}
		return $array;
	}
}

// Return list of the image ratio
if ( ! function_exists( 'webbloger_skin_trx_addons_get_list_sc_image_ratio' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_image_ratio', 'webbloger_skin_trx_addons_get_list_sc_image_ratio', 10, 1 );
	function webbloger_skin_trx_addons_get_list_sc_image_ratio($array) {
		$array = array(
			'none' => esc_html__('Default', 'webbloger'),
			'masonry' => esc_html__('Masonry', 'webbloger'),
			'100:37' => esc_html__('100:37', 'webbloger'), //37%
			'7:3' => esc_html__('7:3', 'webbloger'), //42.857%
			'2:1' => esc_html__('2:1', 'webbloger'), //50%
			'1043:20' => esc_html__('40:21', 'webbloger'), //52.15% 
			'17:9' => esc_html__('17:9', 'webbloger'), //52.94% 
			'16:9' => esc_html__('16:9', 'webbloger'), //56.25%
			'5:3' => esc_html__('5:3', 'webbloger'), //60%
			'50:31' => esc_html__('50:31', 'webbloger'), //62%
			'3:2' => esc_html__('3:2', 'webbloger'), //66.666%
			'10:7' => esc_html__('10:7', 'webbloger'), //70%
			'4:3' => esc_html__('4:3', 'webbloger'), //75%
			'1000:757' => esc_html__('19:14', 'webbloger'), //75.7%
			'19:15' => esc_html__('19:15', 'webbloger'), //78.947%
			'5:4' => esc_html__('5:4', 'webbloger'), //80%
			'1000:829' => esc_html__('6:5', 'webbloger'), //82.9%
			'6:7' => esc_html__('6:7', 'webbloger'), //85.714%
			'25:23' => esc_html__('25:23', 'webbloger'), //92%
			'1:1' => esc_html__('1:1', 'webbloger'), //100%			
			'9:8' => esc_html__('9:8', 'webbloger'), //112.5%
			'7:8' => esc_html__('7:8', 'webbloger'), //114.285%
			'5:6' => esc_html__('5:6', 'webbloger'), //120%
			'100:129' => esc_html__('10:13', 'webbloger'), //129%
			'3:4' => esc_html__('3:4', 'webbloger'), //133.33%
			'21:32' => esc_html__('21:32', 'webbloger'), //152.38%
			'9:16' => esc_html__('9:16', 'webbloger'), //177.77%
			'9:17' => esc_html__('9:17', 'webbloger'), //188.88%
			'1:2' => esc_html__('1:2', 'webbloger'), //200%
		);
		return $array;
	}
}

// Links custom attributes
if ( ! function_exists( 'webbloger_skin_trx_addons_action_sc_item_link_classes' ) ) {
	add_filter( 'trx_addons_filter_action_sc_item_link_classes', 'webbloger_skin_trx_addons_action_sc_item_link_classes', 10, 3 );
	function webbloger_skin_trx_addons_action_sc_item_link_classes($class, $sc, $item) {
		if ( !empty($item['link_extra']['custom_attributes']) ) {
			$atts = explode(',', $item['link_extra']['custom_attributes']);
			if ( is_array($atts) ) {
				foreach ($atts as $x) {
					$y = explode('|', $x);
					if ( $y[0] == 'class' ) {
						$class .= ' ' . $y[1];
					}
				}
			}
		}
		return $class;
	}
}

// Video mask
if ( ! function_exists( 'webbloger_skin_trx_addons_video_mask' ) ) {
	add_filter( 'trx_addons_filter_video_mask', 'webbloger_skin_trx_addons_video_mask', 10, 2 );
	function webbloger_skin_trx_addons_video_mask($output, $args) {	
		if ( array_key_exists('button_style', $args) && $args['button_style'] == 'bordered' ) {
			$output = str_replace('video_hover', 'video_hover style_bordered', $output);
		}
		return $output;
	}
}

// Video cover image size
if ( ! function_exists( 'webbloger_skin_video_cover_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_video_cover_thumb_size', 'webbloger_skin_video_cover_thumb_size' );
	function webbloger_skin_video_cover_thumb_size($size) {	
		if ( is_singular('post') ) {	
			if ( $size == 'webbloger-thumb-masonry-big' ) {
				$size = 'webbloger-thumb-masonry-huge';
			} 
		}
		return $size;
	}
}

// Pagination
if ( ! function_exists( 'webbloger_skin_trx_addons_get_list_sc_paginations' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_paginations', 'webbloger_skin_trx_addons_get_list_sc_paginations' );
	function webbloger_skin_trx_addons_get_list_sc_paginations($list) {	
		unset($list['prev_next']);
		unset($list['advanced_pages']);
		$list['pages_rounded'] = esc_html__('Page numbers - rounded', 'webbloger');
		$list['pages_simple'] = esc_html__('Page numbers - simple', 'webbloger');
		return $list;
	}
}

// Return list of the image positions in the blogger
if ( ! function_exists( 'webbloger_skin_trx_addons_get_list_sc_blogger_image_positions' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_blogger_image_positions', 'webbloger_skin_trx_addons_get_list_sc_blogger_image_positions' );
	function webbloger_skin_trx_addons_get_list_sc_blogger_image_positions($array) {	
		unset($array['alter']);
		return $array;
	}
}

// Open wrapper around single post video
if (!function_exists('webbloger_skin_trx_addons_cpt_post_before_video_sticky')) {
	add_action( 'trx_addons_action_before_single_post_video', 'webbloger_skin_trx_addons_cpt_post_before_video_sticky', 10, 1 );
	function webbloger_skin_trx_addons_cpt_post_before_video_sticky( $args = array() ) {
		if ( ! empty( $args['singular'] ) || ! empty( $args['singular_extra'] ) ) {
			$post_meta = get_post_meta( get_the_ID(), 'trx_addons_options', true );
			if ( ! empty( $post_meta['video_sticky'] ) ) {
				$class = '';
				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail_url(get_the_ID(), 'webbloger-thumb-med');
					if ( !empty($image) ) {
						$class = webbloger_add_inline_css_class( 'background-image: url(' . esc_url( $image ) . ');' );
					}
				}
				?>
				<div class="trx_addons_video_sticky">
					<div class="trx_addons_video_sticky_inner<?php echo esc_attr(!empty($class) ? ' ' . $class : ''); ?>">
						<h5 class="trx_addons_video_sticky_title">
							<span class="trx_addons_video_sticky_subtitle"><?php echo esc_html__( 'Video:', 'webbloger' ); ?></span><?php 
							echo esc_html(get_the_title(get_the_ID())); 
						?></h5>
				<?php
				$GLOBALS['TRX_ADDONS_STORAGE']['video_sticky_opened'] = true;
			}

		}
	}
}

// Post Meta of Widget Video List
if ( ! function_exists( 'webbloger_skin_trx_addons_video_list_content' ) ) {
	add_filter( 'trx_addons_filter_video_list_content', 'webbloger_skin_trx_addons_video_list_content', 10, 2 );
	function webbloger_skin_trx_addons_video_list_content( $array, $instance ) {
		$array['subtitle'] = trx_addons_get_post_terms('', get_the_ID(), $instance['taxonomy'] );
		$meta_data = $array['meta'];
		$meta_author = get_the_author();
		$meta_comments = get_comments_number();
		$meta_array = array(
		    "author" => $meta_author,
		    "data" => $meta_data,
			"comments" => $meta_comments,
		);
		$array['meta'] = $meta_array;
		return $array;
	}
}

// Return embeded code layout
if ( ! function_exists( 'webbloger_skin_trx_addons_embed_layout' ) ) {
	add_filter( 'trx_addons_filter_embed_layout', 'webbloger_skin_trx_addons_embed_layout', 10, 2 );
	function webbloger_skin_trx_addons_embed_layout( $embed, $args ) {
        if (strpos($args['link'], 'facebook.com')) {
			$embed = '<iframe src="'. esc_url($args['link']) .'" allowfullscreen width="1290" height="725"></iframe>';
		}
        return $embed;
	}
}

// Change array with current system info
if ( ! function_exists( 'webbloger_skin_trx_addons_get_sys_info' ) ) {
	add_filter( 'trx_addons_filter_get_sys_info', 'webbloger_skin_trx_addons_get_sys_info');
	function webbloger_skin_trx_addons_get_sys_info( $array ) {
		$array['php_version']  = array(
										'title' => esc_html__('PHP version', 'webbloger'),
										'value' => phpversion(),
										'recommended' => '7.0.0+',
										'checked' => version_compare( phpversion(), '7.0.0', '>=' ),
										);
		return $array;
	}
}

// Social sharing attribute
if ( ! function_exists( 'webbloger_skin_trx_addons_social_sharing_attr' ) ) {
	add_filter( 'trx_addons_filter_social_sharing_attr', 'webbloger_skin_trx_addons_social_sharing_attr');
	function webbloger_skin_trx_addons_social_sharing_attr( $social ) {
		if ( !empty($social['title']) ) {
			return ' data-title="' . esc_attr($social['title']) . '"';
		}
		return '';
	}
}

// Change video list options for single post 
if ( ! function_exists( 'webbloger_skin_trx_addons_meta_box_fields' ) ) {
	add_filter( 'trx_addons_filter_meta_box_fields', 'webbloger_skin_trx_addons_meta_box_fields');
	function webbloger_skin_trx_addons_meta_box_fields( $array ) {	
		if ( array_key_exists('video_autoplay_archive', $array ) ) {			
			$array['video_autoplay_archive']['type'] = "hidden";
		}
		if ( array_key_exists('video_autoplay', $array ) ) {		
			$array['video_autoplay']['type'] = "hidden";
		}
		if ( array_key_exists('video_list', $array ) ) {		
			$array['video_list']['fields']['meta']['type'] = "hidden";
		}
		return $array;
	}
}

// Hide plugin's options
if ( ! function_exists( 'webbloger_skin_trx_addons_options' ) ) {
	add_filter( 'trx_addons_filter_options', 'webbloger_skin_trx_addons_options' );
	function webbloger_skin_trx_addons_options($array) {
		$array['emotions_info']['type'] = 'hidden'; 
		$array['emotions_allowed']['type'] = 'hidden';
		$array['extended_taxonomy_attributes']['std'] = array('image' => 1, 'icon' => 1);	
		return $array;	
	}
}

// Hide extended taxonomy attributes
if ( ! function_exists( 'webbloger_skin_trx_addons_extended_taxonomy_attributes' ) ) {
	add_filter( 'trx_addons_filter_extended_taxonomy_attributes', 'webbloger_skin_trx_addons_extended_taxonomy_attributes' );
	function webbloger_skin_trx_addons_extended_taxonomy_attributes($array) {
		$array = array(
			'image_large' => esc_html__("Large image", 'webbloger'),
			'image_small' => esc_html__("Small image", 'webbloger'),
		);
		return $array;	
	}
}

// Return input hover effects
if ( ! function_exists( 'webbloger_skin_trx_addons_get_list_input_hover' ) ) {
	add_filter( 'trx_addons_filter_get_list_input_hover', 'webbloger_skin_trx_addons_get_list_input_hover');
	function webbloger_skin_trx_addons_get_list_input_hover( $array ) {	
		unset($array['jump']);
		unset($array['path']);
		return $array;
	}
}

// Remove width from popup video
if ( ! function_exists( 'webbloger_skin_trx_addons_video_layouts' ) ) {
	add_filter( 'trx_addons_filter_video_layout', 'webbloger_skin_trx_addons_video_layouts', 10, 2 );
	function webbloger_skin_trx_addons_video_layouts(  $output, $args ) {
		if ( ! empty($args['popup']) ) {
			if ( preg_match( '/(class="trx_addons_video")/', $output ) ) {
				$output = preg_replace( '/(width: )[0-9]+(px;)/', '', $output );
			}
		}
		return $output;
	}
}

// Return list of the menu layouts
if ( !function_exists( 'webbloger_skin_get_list_sc_layouts_menu' ) ) {
	add_action( 'trx_addons_filter_get_list_sc_layouts_menu', 'webbloger_skin_get_list_sc_layouts_menu' );
	function webbloger_skin_get_list_sc_layouts_menu() {
		return array( 'default' => esc_html__('Default', 'webbloger') );
	}
}

// Slide arguments
if ( ! function_exists( 'webbloger_skin_trx_addons_slider_content' ) ) {
	add_filter( 'trx_addons_filter_slider_content', 'webbloger_skin_trx_addons_slider_content', 10, 2 );
	function webbloger_skin_trx_addons_slider_content( $array, $args ) {
		$array['cats'] = trx_addons_get_post_terms('', get_the_ID(), $args['taxonomy']);
		return $array;
	}
}

// Button hover style
if ( ! function_exists( 'webbloger_skins_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'webbloger_skins_trx_addons_sc_item_button_args' );
	function webbloger_skins_trx_addons_sc_item_button_args( $args ) {		
		if ( ! empty( $args['type'] ) && 'rounded' == $args['type'] && !empty($args['hover_style_rounded']) ) {
			$args['hover_style'] = $args['hover_style_rounded'];
		}
		return $args;
	}
}

// Import Theme options Fix
if ( ! function_exists( 'webbloger_skins_trx_addons_importer_import_end' ) ) {
	add_action( 'trx_addons_action_importer_import_end', 'webbloger_skins_trx_addons_importer_import_end', 11, 1 );
	function webbloger_skins_trx_addons_importer_import_end( $importer ) {		
		if (  $importer->options['demo_set'] == 'part' ) {
			$theme = get_option( 'stylesheet' );
			$data = get_option( 'theme_mods_' . $theme );
			$options = trx_addons_unserialize($data);			
			$array = array('header_type', 'footer_type');
			foreach ( $array as $key ) {
				$options[$key]  = 'default';
			}		
			$array = array('header_type_blog', 'header_type_single', 'footer_type_single', 'footer_type_shop');
			foreach ( $array as $key ) {
				$options[$key]  = 'inherit';
			} 
			update_option( 'theme_mods_' . $theme, apply_filters( 'webbloger_filter_options_save', $options, 'theme_mods' ) );
		}
	}
}

// Import site settings Fix
if ( ! function_exists( 'webbloger_skins_trx_addons_import_theme_options' ) ) {
	add_filter( 'trx_addons_filter_import_theme_options', 'webbloger_skins_trx_addons_import_theme_options', 10, 4 );
	function webbloger_skins_trx_addons_import_theme_options( $allow, $k, $v, $options ) {		
		if ( $options['demo_set'] == 'part' ) {
			if ( $allow && in_array($k, array('show_on_front', 'page_on_front', 'page_for_posts') ) ) {
				return false;
			}
		}
		return $allow;
	}
} 

// Import content Fix
if ( ! function_exists( 'webbloger_skins_trx_addons_importer_row_content' ) ) {
	add_filter( 'trx_addons_filter_importer_row_content', 'webbloger_skins_trx_addons_importer_row_content', 10, 2 );
	function webbloger_skins_trx_addons_importer_row_content( $row, $table ) {		
		if ( $table=='postmeta' ) {
			if ($row['meta_key']=='_elementor_data' ) {
				$row['meta_value'] = preg_replace('/("ids":")[0-9,]+(")/', ' "ids":""', $row['meta_value']);
				$row['meta_value'] = preg_replace('/("cat":\[")[0-9,]+("])/', ' "cat":[]', $row['meta_value']);
			}
		}
		if ( $table=='posts' ) {
			$row['post_content'] = preg_replace('/("ids":")[0-9,]+(")/', ' "ids":""', $row['post_content']);
			$row['post_content'] = preg_replace('/("cat":")[0-9,]+(")/', ' "cat":""', $row['post_content']);
		}
		return $row;
	}
} 

// Widget Slider slide
if ( ! function_exists( 'webbloger_skins_trx_addons_slider_slide' ) ) {
	add_filter( 'trx_addons_filter_slider_slide', 'webbloger_skins_trx_addons_slider_slide', 10, 3 );
	function webbloger_skins_trx_addons_slider_slide( $output, $image, $args ) {		
		if ( trx_addons_is_on($args['large']) ) {
			$output = str_replace( ' with_titles', ' with_titles with_large_titles', $output );
		}
		return $output;
	}
} 

// Load if current mode is Preview in the PageBuilder
if ( !function_exists( 'webbloger_skins_trx_addons_enqueue_slider_pagebuilder_preview_scripts' ) ) {
	add_action("trx_addons_action_pagebuilder_preview_scripts", 'webbloger_skins_trx_addons_enqueue_slider_pagebuilder_preview_scripts', 10, 1);
	function webbloger_skins_trx_addons_enqueue_slider_pagebuilder_preview_scripts($editor='') {
		wp_enqueue_style(  'swiper', trx_addons_get_file_url('js/swiper/swiper.min.css'), array(), null );
		wp_enqueue_script( 'swiper', trx_addons_get_file_url('js/swiper/swiper.min.js'), array(), null, true );
	}
}


// SCRIPTS AND STYLES
//--------------------------------------------------
// Enqueue skin-specific scripts
// Priority 1050 -  before main theme plugins-specific (1100)
if ( ! function_exists( 'webbloger_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'webbloger_skin_frontend_scripts', 1050 );
	function webbloger_skin_frontend_scripts() {
		// Skin style
		$webbloger_url = webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'css/style.css' );
		if ( '' != $webbloger_url ) {
			wp_enqueue_style( 'webbloger-skin-' . esc_attr( webbloger_skins_get_current_skin_name() ), $webbloger_url, array(), null );
		}		
		// Skin script
		$webbloger_url = webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'skin.js' );
		if ( '' != $webbloger_url ) {
			wp_enqueue_script( 'webbloger-skin-' . esc_attr( webbloger_skins_get_current_skin_name() ), $webbloger_url, array( 'jquery' ), null, true );
		}
		// Remove Dashicons
		if ( !is_user_logged_in() && wp_style_is('dashicons') ) {
		 	wp_deregister_style('dashicons');
		}
	}
}

// Enqueue skin-specific scripts
if ( ! function_exists( 'webbloger_skin_admin_scripts' ) ) {
	add_action( 'admin_enqueue_scripts', 'webbloger_skin_admin_scripts' );
	function webbloger_skin_admin_scripts() {
		$webbloger_url = webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'css/skin-admin.css' );
		if ( '' != $webbloger_url ) {
			wp_enqueue_style( 'webbloger-skin-admin-' . esc_attr( webbloger_skins_get_current_skin_name() ), $webbloger_url, array(), null );
		}
	}
}

// Save CSS
if ( ! function_exists( 'webbloger_skin_customizer_save_css' ) ) {
	add_action( 'webbloger_action_save_options', 'webbloger_skin_customizer_save_css', 20 );
	add_action( 'trx_addons_action_save_options', 'webbloger_skin_customizer_save_css', 20 );
	function webbloger_skin_customizer_save_css() {
		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'webbloger' )
				. "\n----------------------------------------------------------------------- */\n";

		// Save CSS with custom fonts and vars to the __custom.css
		$css = webbloger_customizer_get_css();
		webbloger_fpc( webbloger_get_file_dir( 'css/__custom.css' ), $msg . $css );

		// Gutenberg & Kadence Blocks
		if ( true ) {				
			// Merge styles
			webbloger_merge_css(
				'css/__gutenberg.css', apply_filters(
					'webbloger_filter_merge_gutenberg_styles', array(
					)
				)
			);
			// Merge responsive styles
			webbloger_merge_css(
				'css/__gutenberg_responsive.css', apply_filters(
					'webbloger_filter_merge_gutenberg_styles_responsive', array(
					)
				), true
			);
		}
	}
}

// Load styles of theme components
if ( ! function_exists( 'webbloger_skin_wp_styles_plugins' ) ) {
	add_action('wp_enqueue_scripts', 'webbloger_skin_wp_styles_plugins', 1100);
	function webbloger_skin_wp_styles_plugins() {
		// Enqueue theme-specific single scripts
		if ( webbloger_is_on( webbloger_get_theme_option( 'debug_mode' ) ) ) {
			$posts_navigation  = webbloger_get_theme_option( 'posts_navigation' );
			if ( 'scroll' == $posts_navigation && ( is_singular( 'post' ) || is_singular( 'attachment' ) ) ) {
				$styles = webbloger_storage_get( 'single_styles' );
				if ( is_array($styles) ) {
					foreach ( $styles as $k => $v ) {
						webbloger_customizer_add_single_styles_and_scripts( false, 'styles', false, $k );
						webbloger_customizer_add_single_styles_and_scripts( false, 'scripts', false, $k );
					}
				}
			} else {
				webbloger_customizer_add_single_styles_and_scripts( false, 'styles' );
				webbloger_customizer_add_single_styles_and_scripts( false, 'scripts' );
			}
		}

		if ( webbloger_is_off( webbloger_get_theme_option( 'debug_mode' ) ) ) {
			// Enqueue Gutenberg & Kadence Blocks styles
			if ( !webbloger_elm_is_elementor_page() ) {
				wp_enqueue_style( 'webbloger-gutenberg', webbloger_get_file_url( 'css/__gutenberg.css' ), array(), null );
			}
		}
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( ! function_exists( 'webbloger_skin_wp_styles_responsive' ) ) {
	add_action('wp_enqueue_scripts', 'webbloger_skin_wp_styles_responsive', 2000);
	function webbloger_skin_wp_styles_responsive() {
		// Enqueue theme-specific single scripts for responsive
		if ( webbloger_is_on( webbloger_get_theme_option( 'debug_mode' ) ) ) {
			$posts_navigation  = webbloger_get_theme_option( 'posts_navigation' );
			if ( 'scroll' == $posts_navigation && ( is_singular( 'post' ) || is_singular( 'attachment' ) ) ) {
				$styles = webbloger_storage_get( 'single_styles' );
				if ( is_array($styles) ) {
					foreach ( $styles as $k => $v ) {
						webbloger_customizer_add_single_styles_and_scripts( false, 'styles', true, $k );
					}
				}
			} else {
				webbloger_customizer_add_single_styles_and_scripts( false, 'styles', true );
			}
		}

		if ( webbloger_is_off( webbloger_get_theme_option( 'debug_mode' ) ) ) {
			// Enqueue Gutenberg & Kadence Blocks styles
			if ( !webbloger_elm_is_elementor_page() ) {
				wp_enqueue_style( 'webbloger-gutenberg-responsive', webbloger_get_file_url( 'css/__gutenberg_responsive.css' ), array(), null, webbloger_media_for_load_css_responsive( 'skin-gutenberg' ) );
			}
		}
	}
}

// If separate single styles are supported with current skin - return true to place its to the stand-alone files
// '__single.css' with general styles for single posts
// '__single-responsive.css' with responsive styles for single posts
if ( ! function_exists( 'webbloger_skin_allow_separate_single_styles' ) ) {
	add_filter( 'webbloger_filters_separate_single_styles', 'webbloger_skin_allow_separate_single_styles' );
	function webbloger_skin_allow_separate_single_styles( $allow ) {
		return true;
	}
}

// Custom styles
$webbloger_style_path = webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'css/style.php' );
if ( ! empty( $webbloger_style_path ) ) {
	require_once $webbloger_style_path;
}


// SKIN SETUP
//--------------------------------------------------
if ( ! function_exists( 'webbloger_skin_theme_specific_setup1' ) ) {
	add_action( 'after_setup_theme', 'webbloger_skin_theme_specific_setup1', 1 );
	function webbloger_skin_theme_specific_setup1() {
		webbloger_storage_set_array( 'settings', 'allow_fullscreen', true );
	}
}

if ( ! function_exists( 'webbloger_skin_theme_specific_setup9' ) ) {
	add_action( 'after_setup_theme', 'webbloger_skin_theme_specific_setup9', 9 );
	function webbloger_skin_theme_specific_setup9() {
		if ( webbloger_exists_trx_addons() ) {
			remove_action( 'trx_addons_action_before_single_post_video', 'trx_addons_cpt_post_before_video_sticky' );
		}
		remove_action( 'wp_enqueue_scripts', 'webbloger_customizer_single_styles', 1100 );
		remove_action( 'wp_enqueue_scripts', 'webbloger_customizer_single_styles_responsive', 1100 );
		remove_action( 'webbloger_filter_list_sidebars', 'webbloger_front_page_sidebars' );
		
		if ( webbloger_is_off( webbloger_get_theme_option( 'debug_mode' ) ) ) {			
			// Single
			remove_action( 'webbloger_filter_merge_styles', 'webbloger_customizer_merge_single_styles', 8, 1 );
			remove_action( 'webbloger_filter_merge_styles_responsive', 'webbloger_customizer_merge_single_styles_responsive', 8, 1 );

			add_filter( 'webbloger_filter_merge_single_styles', 'webbloger_customizer_merge_single_styles', 8, 1 );
			add_filter( 'webbloger_filter_merge_single_styles_responsive', 'webbloger_customizer_merge_single_styles_responsive', 8, 1 );			
		}
	}
}

// Add theme specified classes to the body
if ( ! function_exists( 'webbloger_skin_add_body_classes' ) ) {
	add_filter( 'body_class', 'webbloger_skin_add_body_classes' );
	function webbloger_skin_add_body_classes( $classes ) {
		if ( is_singular('post') ) {
			$webbloger_share_position = webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'share_position' ) );
			$classes[] = in_array( 'left', $webbloger_share_position ) ? 'post_with_info_vertical' : '';
		}

		if ( webbloger_sidebar_present() ) {
			if ( ('default' == webbloger_get_theme_option( 'sidebar_type' ) && is_active_sidebar( webbloger_get_theme_option( 'sidebar_widgets' ) ) ) || !empty(webbloger_get_custom_sidebar_id()) ) {
				$classes[] = 'sidebar_present';
			}
		}

		if ( isset($_COOKIE['webbloger_color_scheme']) ) {
			$webbloger_color_scheme_cookie = wp_unslash( $_COOKIE['webbloger_color_scheme'] );
			$webbloger_get_theme_option = webbloger_get_theme_option( 'color_scheme' );
			
			if ( ! empty( $webbloger_color_scheme_cookie ) && ! empty( $webbloger_get_theme_option ) ) {

				if ( $webbloger_color_scheme_cookie !== $webbloger_get_theme_option ) {
					$classes[] = 'scheme_' . $webbloger_color_scheme_cookie;

					if ( $webbloger_color_scheme_cookie === 'default' ) {
						$classes[] = 'bg_white';
					}
				}
			}
			
		}
		return $classes;
	}
}

// Update options for previous post
if ( ! function_exists( 'webbloger_skin_prev_post_loading' ) ) {
	add_action( 'webbloger_action_prev_post_loading', 'webbloger_skin_prev_post_loading', 10, 2 );
	function webbloger_skin_prev_post_loading($prev_post_loading, $type) {
		if ( !$prev_post_loading && 'article' == $type ) {
			update_option( 'webbloger_current_single_style', 'style-10' );	
			update_option( 'webbloger_current_single_sidebar_position', webbloger_get_theme_option( 'sidebar_position' ) );
			update_option( 'webbloger_current_single_expand_content', webbloger_get_theme_option( 'expand_content' ) );
			update_option( 'webbloger_current_single_post_vertical_content', webbloger_get_theme_option( 'post_vertical_content' ) );
			update_option( 'webbloger_current_single_post_share_position', webbloger_get_theme_option( 'share_position' ) );
		}
		if ( $prev_post_loading && 'article' == $type ) {
			webbloger_storage_set_array( 'options_meta', 'single_style', get_option( 'webbloger_current_single_style') );
			webbloger_storage_set_array( 'options_meta', 'sidebar_position', get_option( 'webbloger_current_single_sidebar_position') );
			webbloger_storage_set_array( 'options_meta', 'expand_content', get_option( 'webbloger_current_single_expand_content') );
			webbloger_storage_set_array( 'options_meta', 'post_vertical_content', get_option( 'webbloger_current_single_post_vertical_content') );
			webbloger_storage_set_array( 'options_meta', 'share_position', get_option( 'webbloger_current_single_post_share_position') );
		}
	}
}

// Convert number to roman 
if ( ! function_exists( 'webbloger_skin_num_to_roman' ) ) {
	function webbloger_skin_num_to_roman($num) {
	    $n = intval($num);
	    $result = ''; 
	    $lookup = array(
	        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
	        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
	        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
	    ); 	 
	    foreach ($lookup as $roman => $value) {
	        $matches = intval($n / $value); 	 
	        $result .= str_repeat($roman, $matches); 	 
	        $n = $n % $value; 
	    }
	    return $result; 
	}
}

// Content width
if ( ! function_exists( 'webbloger_skin_list_expand_content' ) ) {
	add_filter( 'webbloger_filter_list_expand_content', 'webbloger_skin_list_expand_content' );
	function webbloger_skin_list_expand_content($array) {
		//unset($array['normal']);
		return $array;
	}
}

// Theme vars
if ( ! function_exists( 'webbloger_skin_add_theme_vars' ) ) {
	add_filter( 'webbloger_filter_add_theme_vars', 'webbloger_skin_add_theme_vars', 10, 2 );
	function webbloger_skin_add_theme_vars($rez, $vars) {
		if ( substr( $vars['page_width'], 0, 2 ) != '{{' ) {
			$rez['page_narrow_width'] = webbloger_prepare_css_value( $vars['page_width'] );
		} else {
			$rez['page_narrow_width'] = '{{ data.page_narrow_width }}';
		}
		return $rez;
	}
}


// Posts author block
if ( ! function_exists( 'webbloger_skin_post_author_content' ) ) {
	add_filter( 'webbloger_filter_post_author_content', 'webbloger_skin_post_author_content', 10, 3 );
	function webbloger_skin_post_author_content($output, $author_avatar, $author_name) {
		if ( ! empty( $author_avatar ) && ! empty( $author_name ) ) {
			$output = 	( ! empty( $author_avatar )
							? sprintf( '<span class="post_author_avatar">%s</span>', $author_avatar )
							: '<span class="post_author_by">' . esc_html__( 'By', 'webbloger' ) . '</span>'
							)
						. '<span class="post_author_by">' . esc_html__( 'By', 'webbloger' ) . '</span>'
						. '<span class="post_author_name">' . esc_html( $author_name ) . '</span>';
		}
		return $output;
	}
}

// Button color styles
if ( ! function_exists( 'webbloger_skin_get_list_sc_color_styles' ) ) {
	add_filter( 'webbloger_filter_get_list_sc_color_styles', 'webbloger_skin_get_list_sc_color_styles', 10, 1 );
	function webbloger_skin_get_list_sc_color_styles($array = array()) {
		$array = array(			
			'default' => esc_html__( 'Accent', 'webbloger' ),
			'1' => esc_html__( 'Dark', 'webbloger' ),
			'2' => esc_html__( 'Light', 'webbloger' ),
			'3' => esc_html__( 'Bordered - light', 'webbloger' ),
			'4' => esc_html__( 'Bordered - dark', 'webbloger' ),
		);
		return $array;
	}
}

if ( ! function_exists( 'webbloger_skin_get_list_sc_hover_styles' ) ) {
	function webbloger_skin_get_list_sc_hover_styles( $icon = true ) {
		$array = array(
			'default' => esc_html__( 'Accent', 'webbloger' ),
			'1' => esc_html__( 'Dark', 'webbloger' ),
			'2' => esc_html__( 'Light', 'webbloger' ),
			'3' => esc_html__( 'Light - accent', 'webbloger' ),
			'4' => esc_html__( 'Bordered - light', 'webbloger' ),	
			'5' => esc_html__( 'Bordered - dark', 'webbloger' ), 
		);

		if ( $icon ) {
			$array['icon_default'] = esc_html__( 'Accent iconed', 'webbloger' );
			$array['icon_1'] = esc_html__( 'Dark iconed', 'webbloger' );
			$array['icon_2'] = esc_html__( 'Light iconed', 'webbloger' );
			$array['icon_3'] = esc_html__( 'Light iconed - accent', 'webbloger' );
			$array['icon_4'] = esc_html__( 'Bordered iconed - light', 'webbloger' );
			$array['icon_5'] = esc_html__( 'Bordered iconed - dark', 'webbloger' );
		}	
		return $array;
	}
}

// Return list of the image hover styles
if ( ! function_exists( 'webbloger_skin_list_hovers' ) ) {
	add_filter( 'webbloger_filter_list_hovers', 'webbloger_skin_list_hovers', 10, 1 );
	function webbloger_skin_list_hovers($array) {
		$array = array(
			'inherit'   => esc_html__( 'Inherit', 'webbloger' ),
		);
		return $array;
	}
}

// Change placeholder text for Search Widget
if ( ! function_exists( 'webbloger_skin_search_form_placeholder_text' ) ) {
	add_filter( 'get_search_form', 'webbloger_skin_search_form_placeholder_text' );
	function webbloger_skin_search_form_placeholder_text( $html ) {
        $html = str_replace( 'placeholder="Search ', 'placeholder="Type words and hit enter', $html );
        return $html;
	}
}

// Filter to add/remove widget area
if ( ! function_exists( 'webbloger_skin_remove_widgets_area' ) ) {
	add_filter('webbloger_filter_list_sidebars', 'webbloger_skin_remove_widgets_area');
	function webbloger_skin_remove_widgets_area( $list = array() ) {
		unset( $list['header_widgets'] );
		unset( $list['above_page_widgets'] );
		unset( $list['above_content_widgets'] );
		unset( $list['below_content_widgets'] );
		unset( $list['below_page_widgets'] );
		return $list;
	}
}

// Return body styles list, prepended inherit
if ( ! function_exists( 'webbloger_skin_list_body_styles' ) ) {
	add_filter( 'webbloger_filter_list_body_styles', 'webbloger_skin_list_body_styles');
	function webbloger_skin_list_body_styles( $list ) {
		unset($list['fullwide']);
		// unset($list['boxed']);
		return $list;
	}
}

// Remove Background Image Section 
if ( ! function_exists( 'webbloger_skin_customizer_register_controls' ) ) {
	add_action( 'customize_register', 'webbloger_skin_customizer_register_controls', 21 );
	function webbloger_skin_customizer_register_controls( $wp_customize ) {
		$wp_customize->remove_section( 'background_image' );
		return $wp_customize;
	}
}

// Hide options from the Front Page option
if ( ! function_exists( 'webbloger_skin_front_page_options' ) ) {
	add_filter( 'webbloger_filter_front_page_options', 'webbloger_skin_front_page_options', 11 );
	function webbloger_skin_front_page_options( $options ) {
		return array();
	}
}

// Change comments depth
if ( ! function_exists( 'webbloger_skin_comment_depth' ) ) {
	//Handler of the add_filter( 'webbloger_filter_comment_depth', 'webbloger_skin_comment_depth' );
	function webbloger_skin_comment_depth( $depth ) {
		if ( webbloger_get_theme_option( 'expand_content_single' ) == 'narrow' ) {
			$depth--;
		}
		return $depth;
	}
}

// Comments buttons class
if ( ! function_exists( 'webbloger_skin_comments_button_class' ) ) {
	add_filter( 'webbloger_filter_comments_button_class', 'webbloger_skin_comments_button_class' );
	function webbloger_skin_comments_button_class( $class ) {
		$class = 'show_comments_button sc_button sc_button_default sc_button_size_large hover_style_1 color_style_1';
		return $class;
	}
}

// Change comments depth
if ( ! function_exists( 'webbloger_skin_comment_form_args' ) ) {
	add_filter( 'webbloger_filter_comment_form_args', 'webbloger_skin_comment_form_args' );
	function webbloger_skin_comment_form_args( $array ) {
		$array['title_reply_before'] = '<h4 id="reply-title" class="section_title comments_form_title comment-reply-title">';
		$array['title_reply_after'] = '</h4>';
		return $array;
	}
}

if ( ! function_exists( 'webbloger_skin_is_singular_type' ) ) {
	add_filter( 'webbloger_filter_is_singular_type', 'webbloger_skin_is_singular_type' );
	function webbloger_skin_is_singular_type( $array ) {
		$array = array('post', 'page');
		return $array;
	}
}

if ( ! function_exists( 'webbloger_skin_is_prev_post_loading' ) ) {
	add_filter( 'webbloger_filter_is_prev_post_loading', 'webbloger_skin_is_prev_post_loading' );
	function webbloger_skin_is_prev_post_loading( $bool ) {
		return false;
	}
}

// Add previos post id to post navigation
if ( ! function_exists( 'webbloger_skin_nav_links_single_scroll_data' ) ) {
	add_action( 'webbloger_action_nav_links_single_scroll_data', 'webbloger_skin_nav_links_single_scroll_data' );
	function webbloger_skin_nav_links_single_scroll_data( $prev_post ) {
		echo ' data-post-prev-id="' . esc_attr( $prev_post->ID ) . '"';
	}
}

// Add video button in the post header
if ( ! function_exists( 'webbloger_skin_post_header_start' ) ) {
	add_action( 'webbloger_action_post_header_start', 'webbloger_skin_post_header_start' );
	function webbloger_skin_post_header_start() {
		// Post video hover
		if ( is_singular() && get_post_format() == 'video' ) {
			?><div class="post_video_hover hide"></div><?php
		}
	}
}

// Share links text
if ( ! function_exists( 'webbloger_skin_share_links_text' ) ) {
	add_filter( 'webbloger_filter_share_links_args', 'webbloger_skin_share_links_text' );
	function webbloger_skin_share_links_text($array) {
		$array['caption'] = esc_html__( 'Share Post', 'webbloger' );
		return $array;
	}
}

// Load More button's class
if ( ! function_exists( 'webbloger_skin_load_more_class' ) ) {
	add_filter( 'webbloger_filter_load_more_class', 'webbloger_skin_load_more_class' );
	function webbloger_skin_load_more_class($class) {
		$class .= ' sc_button sc_button_default hover_style_default color_style_default';
		return $class;
	}
}

// Post navigation previous button css
if ( ! function_exists( 'webbloger_skin_post_navigation_previous_css' ) ) {
	add_filter( 'webbloger_filter_post_navigation_previous_css', 'webbloger_skin_post_navigation_previous_css' );
	function webbloger_skin_post_navigation_previous_css($css) {
		$css = '.nav-links-single.nav-links-with-thumbs .nav-links .nav-previous a { padding-right: 2.1rem; }'
					. '.post-navigation .nav-previous a .nav-arrow { display: none; background-color: rgba(128,128,128,0.05); border: 1px solid rgba(128,128,128,0.1); }'
					. '.post-navigation .nav-previous a .nav-arrow:after { top: 0; opacity: 1; }';
		return $css;
	}
}

// Post navigation next button css
if ( ! function_exists( 'webbloger_skin_post_navigation_next_css' ) ) {
	add_filter( 'webbloger_filter_post_navigation_next_css', 'webbloger_skin_post_navigation_next_css' );
	function webbloger_skin_post_navigation_next_css($css) {
		$css = '.nav-links-single.nav-links-with-thumbs .nav-links .nav-next a { padding-left: 2.1rem; }'
					. '.post-navigation .nav-next a .nav-arrow { display: none; background-color: rgba(128,128,128,0.05); border: 1px solid rgba(128,128,128,0.1); }'
					. '.post-navigation .nav-next a .nav-arrow:after { top: 0; opacity: 1; }';
		return $css;
	}
}

// Add content_wrap on the full screen pages. It help to calculate width of submenu  
if ( ! function_exists( 'webbloger_skin_page_content_wrap' ) ) {
	add_action( 'webbloger_action_page_content_wrap', 'webbloger_skin_page_content_wrap' );
	function webbloger_skin_page_content_wrap() {
		$webbloger_body_style   = webbloger_get_theme_option( 'body_style' );
		if ( 'fullscreen' == $webbloger_body_style ) {
			echo '<div class="content_wrap"></div>';
		}
	}
}

// Add theme-specific vars into localize array
if ( ! function_exists( 'webbloger_skin_localize_script' ) ) {
	add_filter( 'webbloger_filter_localize_script', 'webbloger_skin_localize_script' );
	function webbloger_skin_localize_script( $arr ) {
		$arr['submenu_not_allowed'] = esc_html__("Custom submenu can not be used in this widget", 'webbloger');
		return $arr;
	}
}

// Slider arguments
if ( ! function_exists( 'webbloger_skin_post_slider_args' ) ) {
	add_filter( 'webbloger_filter_post_slider_args', 'webbloger_skin_post_slider_args' );
	function webbloger_skin_post_slider_args( $args ) {
		if ( $args['slides_ratio'] == '16:9' ) {
			if ( array_key_exists('thumb_size', $args) ) {
				if ( $args['thumb_size'] == 'webbloger-thumb-huge' ) {
					$args['slides_ratio'] = '1290:618';
				}
				if ( $args['thumb_size'] == 'webbloger-thumb-big' ) {
					$args['slides_ratio'] = '850:542';
				}
				if ( $args['thumb_size'] == 'webbloger-thumb-med' ) {
					$args['slides_ratio'] = '642:492';
				}
			}
		}
		return $args;
	}
}

// Post meta arguments
if ( ! function_exists( 'webbloger_skin_post_meta_args' ) ) {
	add_filter( 'webbloger_filter_post_meta_args', 'webbloger_skin_post_meta_args', 10, 3 );
	function webbloger_skin_post_meta_args( $args = array() ) {
		$args['cat_sep'] = false;
		return $args;
	}
}

// Post meta separator
if ( ! function_exists( 'webbloger_skin_post_meta_cat_separator' ) ) {
	add_filter( 'webbloger_filter_post_meta_cat_separator', 'webbloger_skin_post_meta_cat_separator', 10, 1 );
	function webbloger_skin_post_meta_cat_separator( $args ) {
		return ' ';
	}
}

// Return 'expand content' choices
if ( ! function_exists( 'webbloger_skin_get_list_expand_content' ) ) {
	function webbloger_skin_get_list_expand_content( $prepend_inherit = false, $narrow = false, $expand = true ) {
		$list = apply_filters(
			'webbloger_filter_list_expand_content', array_merge(
				( $narrow
					? array(
						'narrow' => array(
								'title' => esc_html__( 'Narrow', 'webbloger' ),
								'icon'  => 'images/theme-options/expand-content/narrow.png',
								)
						)
					: array()
				),
				array_merge (
					array(
						'normal' => array(
								'title' => esc_html__( 'Normal', 'webbloger' ),
								'icon'  => 'images/theme-options/expand-content/normal.png',
								)
					),
					( $expand
						? array(
							'expand' => array(
									'title' => esc_html__( 'Wide', 'webbloger' ),
									'icon'  => 'images/theme-options/expand-content/wide.png',
								)
						)
						: array()
					)
				)
			)
		);
		return $prepend_inherit
					? webbloger_array_merge(
							array( 
								'inherit' => array(
												'title' => esc_html__( 'Inherit', 'webbloger' ),
												'icon'  => 'images/theme-options/inherit.png',
												),
							),
							$list
						)
					: $list;
	}
}

// Return nav menu html
if ( ! function_exists( 'webbloger_skin_get_nav_menu' ) ) {
	function webbloger_skin_get_nav_menu( $location = '', $menu = '' ) { 
		if ( !empty($location) && array_key_exists( $location, $GLOBALS['WEBBLOGER_STORAGE']) ) { 
			return $GLOBALS['WEBBLOGER_STORAGE'][$location];
		} else {
			$menu = webbloger_get_nav_menu( $location, $menu );
			$GLOBALS['WEBBLOGER_STORAGE'][$location] = $menu;
			return $menu;
		}
	}
}

// Disable video autoplay
if ( ! function_exists( 'webbloger_skin_post_featured_args' ) ) {
	add_filter( 'webbloger_filter_post_featured_args', 'webbloger_skin_post_featured_args', 10, 1 );
	function webbloger_skin_post_featured_args( $args = array() ) {
		$args['autoplay'] = false;
		return $args;
	}
}

// Return a skin-specific media slug for each responsive css-file
if ( ! function_exists( 'webbloger_skin_media_for_load_css_responsive' ) ) {
    add_filter( 'webbloger_filter_media_for_load_css_responsive', 'webbloger_skin_media_for_load_css_responsive', 10, 2 );
    function webbloger_skin_media_for_load_css_responsive( $media, $slug ) {
        if ( in_array( $slug, array( 'skin-gutenberg', 'gutenberg-general', 'gutenberg', 'main' ) ) ) {
            $media = 'xxl';
        } else if ( in_array( $slug, array(  ) ) ) {
            $media = 'xl';
        } else if ( in_array( $slug, array( 'hovers', 'trx-addons' ) ) ) {
            $media = 'lg';
        } else if ( in_array( $slug, array( ) ) ) {
            $media = 'md';
        } else if ( in_array( $slug, array( ) ) ) {
            $media = 'sm';
        } else if ( in_array( $slug, array( ) ) ) {
            $media = 'xs';
        }
        return $media;
    }
}

// Check if current page ia a PageBuilder preview mode
if ( ! function_exists( 'webbloger_skin_is_preview' ) ) {
	function webbloger_skin_is_preview( $builder = 'any' ) {
		if ( function_exists( 'trx_addons_is_preview' ) ) {
			return trx_addons_is_preview( $builder );
		} else {
			return ( in_array( $builder, array( 'any', 'elm', 'elementor' ) ) && function_exists( 'trx_addons_elm_is_preview' ) && trx_addons_elm_is_preview() )
					||
					( in_array( $builder, array( 'any', 'gb', 'gutenberg' ) ) && function_exists( 'trx_addons_gutenberg_is_preview' ) && trx_addons_gutenberg_is_preview() );
		}
	}
}

// Check if shortcode is present in the content of the current page
if ( ! function_exists( 'webbloger_skin_sc_check_in_content')) {
	function webbloger_skin_sc_check_in_content( $args, $post_id=-1 ) {
		if ( function_exists( 'trx_addons_sc_check_in_content') ) {
			return trx_addons_sc_check_in_content( $args, $post_id );
		} else {
			static $posts = array();
			$sc_wrappers = array(
				'sc' => array( '[', ']' ),
				'gutenberg' => array( '<!-- ', ' -->' )
			);
			if ( $post_id < 0 ) {
				$post_id = trx_addons_get_the_ID();
			}
			if ( $post_id > 0 ) {
				if ( ! isset( $posts[ $post_id ] ) ) {
					$posts[ $post_id ] = array(
						'post'  => get_post( $post_id ),
						'meta'  => array(),
						'check' => array()
					);
				}
				if ( ! isset( $posts[ $post_id ]['check'][ $args['sc'] ] ) ) {
					$posts[ $post_id ]['check'][ $args['sc'] ] = false;
					// Check entries
					if ( ! empty( $args['entries'] ) ) {
						foreach( $args['entries'] as $entry ) {
							// Check in the content for shortcodes and gutenberg blocks
							if ( empty( $entry['type'] ) || ! in_array( $entry['type'], array( 'elm', 'elementor' ) ) ) {
								$content = ! empty( $posts[ $post_id ]['post']->post_content ) ? $posts[ $post_id ]['post']->post_content : '';
								if ( ! empty( $content ) ) {
									$sc    = $entry['sc'];
									$type  = str_replace(
												array( 'gb', 'elm' ),
												array( 'gutenberg', 'elementor' ),
												empty( $entry['type'] ) ? 'sc' : $entry['type']
											);
									$start = isset( $sc_wrappers[ $type ] ) ? $sc_wrappers[ $type ][0] : '';
									$end   = isset( $sc_wrappers[ $type ] ) ? $sc_wrappers[ $type ][1] : '';
									$param = ! empty( $entry['param'] ) ? $entry['param'] : '';
									$posts[ $post_id ]['check'][ $args['sc'] ] = preg_match( "#\\{$start}{$sc} " . ( ! empty( $param ) ? "[^\\" . substr( $end, -1 ) . "]*{$param}" : '' ) . "#", $content );
								}
							
							// Check in the meta for Elementor
							} else if ( trx_addons_exists_elementor() ) {
								$key = '_elementor_data';
								if ( ! isset( $posts[ $post_id ]['meta'][ $key ] ) ) {
									$posts[ $post_id ]['meta'][ $key ] = get_post_meta( $post_id, $key, true );
								}
								if ( is_string( $posts[ $post_id ]['meta'][ $key ] ) ) {
									$sc    = $entry['sc'];
									$param = ! empty( $entry['param'] ) ? $entry['param'] : '';
									$posts[ $post_id ]['check'][ $args['sc'] ] = strpos( $posts[ $post_id ]['meta'][ $key ], $sc ) !== false
																				&& ( empty( $param ) || strpos( $posts[ $post_id ]['meta'][ $key ], $param ) !== false );
								}
							}
							if ( $posts[ $post_id ]['check'][ $args['sc'] ] ) break;
						}
					}
				}
				return $posts[ $post_id ]['check'][ $args['sc'] ];
			} else {
				return false;
			}
		}
	}
}

// Add Reading time to the meta parts list
if ( ! function_exists( 'webbloger_skin_list_meta_parts' ) ) {
	add_filter( 'webbloger_filter_list_meta_parts', 'webbloger_skin_list_meta_parts' );
	function webbloger_skin_list_meta_parts( $list ) {
		$list['read'] = esc_html__( 'Read time', 'webbloger' );
		return $list;
	}
}

// Show post meta block: post date, author, categories, counters, etc.
if ( ! function_exists( 'webbloger_skin_show_post_meta' ) ) {
	add_action( 'webbloger_action_show_post_meta', 'webbloger_skin_show_post_meta', 10, 3 );
	function webbloger_skin_show_post_meta( $meta, $post_id, $args=array() ) {
		if ( 'read' == $meta ) {
			$word_count = str_word_count(strip_tags(strip_shortcodes(get_post_field( 'post_content', $post_id ))));
			$post_read_time = intdiv($word_count, 120);
			echo '<a href="' . esc_url( get_permalink() ) . '" class="post_meta_item post_meta_reading icon-clock-empty">'
							. '<span class="post_meta_number">' . esc_html( webbloger_num2size( $post_read_time ) ) . ' ' . esc_html__( 'min', 'webbloger' ) . '</span>'
							. ( $args['show_labels'] ? '<span class="post_meta_label">' . esc_html( _n( 'Read time', 'Read time', $post_read_time, 'webbloger' ) ) . '</span>' : '' )
						. '</a>';
		}
	}
}

// Add color scheme button to the body
if ( ! function_exists('webbloger_skin_add_color_scheme_button') ) {
	add_action('wp_footer', 'webbloger_skin_add_color_scheme_button', 9);
	function webbloger_skin_add_color_scheme_button() {
		if ( is_customize_preview() || webbloger_elm_is_preview() ) {
			return;
		}
		if ( webbloger_is_on( webbloger_get_theme_option( 'scheme_switcher' ) ) ) {
			$list = webbloger_get_list_schemes();
			if ( is_array($list) ) {
				$invert = webbloger_is_on( webbloger_get_theme_option( 'invert_logo' ) ) ? 'invert' : '';
				$output = '<ul id="color_scheme_switcher" class="icon-color-picker ' . esc_attr($invert) . '">';
				foreach ($list as $key => $value) {					
					$output .= '<li class="scheme_' . esc_attr($key) . '" data-value="' . esc_attr($key) . '"><span>' . esc_html($value) . '</span></li>';
				}
				$output .= '</ul>';
			}
			webbloger_show_layout($output);
		}
	}
}

// Disable comments on all posts
if ( ! function_exists( 'webbloger_skin_before_comments' ) ) {
	add_action( 'webbloger_action_before_comments', 'webbloger_skin_before_comments' );
	function webbloger_skin_before_comments() {
		if ( webbloger_is_off( webbloger_get_theme_option( 'enable_comments' ) ) ) {
			webbloger_sc_layouts_showed( 'comments', true );
		}
	}
}

// Display the category's image, description on the Category page
if ( ! function_exists( 'webbloger_skin_blog_archive_start' ) ) {
	add_action( 'webbloger_action_blog_archive_start', 'webbloger_skin_blog_archive_start' );
	function webbloger_skin_blog_archive_start() {
		if ( is_category() ) {
			do_action( 'webbloger_action_before_page_category' );
			get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/category-page' ) );
			do_action( 'webbloger_action_after_page_category' );
		}
	}
}


// Rewrited functions
//--------------------------------------------------
// WOOCOMMERCE - Change text on 'Add to cart' button
if ( ! function_exists( 'webbloger_woocommerce_add_to_cart_text' ) ) {	
	function webbloger_woocommerce_add_to_cart_text( $text = '' ) {
		global $product;
		return is_object( $product ) && $product->is_in_stock()
				&& 'grouped' !== $product->get_type()
				&& 'variable' !== $product->get_type()
				&& ( 'external' !== $product->get_type() || $product->get_button_text() == '' )
					? esc_html__( 'Add to Cart', 'webbloger' )
					: $text;
	}
}

// Show post featured block: image, video, audio, etc.
if ( ! function_exists( 'webbloger_show_post_featured' ) ) {
	function webbloger_show_post_featured( $args = array() ) {
		$args = apply_filters( 'webbloger_filter_post_featured_args', array_merge(
			array(
				'popup'         => webbloger_get_theme_option( 'video_in_popup' ),  // Open video in popup
				'hover'         => webbloger_get_theme_option( 'image_hover' ),     // Hover effect
				'parallax'      => webbloger_get_theme_option( 'single_parallax' ), // Parallax speed. If 0 - no parallax effect is used
				'no_links'      => false,                                         // Disable links
				'link'          => '',                                            // Alternative (external) link
				'class'         => '',                                            // Additional Class for featured block
				'data'          => array(),                                       // Data parameters
				'post_info'     => '',                                            // Additional layout after hover
				'meta_parts'    => array(),                                       // String with comma separated meta parts
				'thumb_bg'      => false,                                         // Put thumb image as block background or as separate tag
				'thumb_size'    => '',                                            // Image size
				'thumb_ratio'   => '',                                            // Image's ratio for the slider
				'thumb_only'    => false,                                         // Display only thumb (without post formats)
				'show_no_image' => webbloger_is_on( webbloger_get_theme_setting( 'allow_no_image' ) ),  // Display 'no-image.jpg' if post haven't thumbnail
				'video'         => '',                                            // Video layout
				'autoplay'      => false,                                         // Autoplay video (if present)
				'seo'           => webbloger_is_on( webbloger_get_theme_option( 'seo_snippets' ) ),     // Add SEO-snippets
				'singular'      => false                                          // Current page is singular (true) or blog/shortcode (false)
			), $args
		) );

		if ( post_password_required() ) {
			return;
		}

		$post_format = str_replace( 'post-format-', '', get_post_format() );
		if ( empty( $post_format ) ) {
			$post_format = 'standard';
		}

		$show_video_player = false;
		$videos            = false;
		$show_audio_player = false;
		$audios            = false;
		$show_gallery      = false;
		$gallery_images    = false;
		
		$post_meta         = array();

		$thumb_size        = ! empty( $args['thumb_size'] )
								? $args['thumb_size']
								: webbloger_get_thumb_size( is_attachment() || is_single() ? 'full' : 'big' );
		$has_thumb         = has_post_thumbnail();
		$thumb_id          = 0;
		$thumb_caption 	   = '';

		$parallax          = ! empty( $args['parallax'] ) && is_singular('post') && ! in_array( $post_format, array( 'audio', 'video', 'gallery' ) )
								? $args['parallax']
								: 0;

		if ( 'audio' == $post_format ) {
			$audios   = webbloger_get_post_audio_list();
			if ( ! empty( $audios[0]['cover'] ) ) {
				$has_thumb = true;
				$thumb_id  = webbloger_attachment_url_to_postid( $audios[0]['cover'] );
			}
		} elseif ( 'video' == $post_format ) {
			$videos    = webbloger_get_post_video_list();
			$post_meta = get_post_meta( get_the_ID(), 'trx_addons_options', true );
			if ( ! empty( $args['singular'] ) && ! empty( $post_meta['video_without_cover'] ) ) {
				$has_thumb             = false;
				$args['thumb_bg']      = false;
				$args['show_no_image'] = false;
			} elseif ( ( empty( $args['singular'] ) || empty( $post_meta['video_without_cover'] ) ) && ! empty( $videos[0]['image'] ) ) {
				$has_thumb = true;
				$thumb_id  = webbloger_attachment_url_to_postid( $videos[0]['image'] );
			}
		}
		if ( empty( $thumb_id ) && $has_thumb ) {
			$thumb_id = get_post_thumbnail_id( get_the_ID() );
			$thumb_caption = wp_get_attachment_caption( $thumb_id );
		}

		$no_image = ! empty( $args['show_no_image'] ) ? webbloger_get_no_image( '', true ) : '';

		if ( $parallax ) {
			$args['thumb_bg'] = false;
		}

		if ( $args['thumb_bg'] ) {
			if ( $has_thumb ) {
				$image = wp_get_attachment_image_src( $thumb_id, $thumb_size );
				$image = empty( $image[0] ) ? '' : $image[0];
			} elseif ( 'image' == $post_format ) {
				$image = webbloger_get_post_image();
				if ( ! empty( $image ) ) {
					$image = webbloger_add_thumb_size( $image, $thumb_size );
				}
			}
			if ( empty( $image ) ) {
				$image = $no_image;
			}
			if ( ! empty( $image ) ) {
				$args['thumb_bg_class'] = 'post_featured_bg ' . webbloger_add_inline_css_class( 'background-image: url(' . esc_url( $image ) . ');' );
			} else {
				$args['thumb_bg'] = false;
			}
		}

		if ( ! empty( $args['singular'] ) ) {

			if ( is_attachment() ) {
				?>
				<div class="post_featured post_attachment
					<?php
					echo ( ! empty( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : '' )
						. ( ! empty( $args['thumb_bg_class'] ) ? ' ' . $args['thumb_bg_class'] : '' );
					?>
				">
				<?php
				do_action('webbloger_action_before_featured');
				if ( ! $args['thumb_bg'] ) {
					echo wp_get_attachment_image(
							get_the_ID(),
							$thumb_size,
							false,
							webbloger_is_on( webbloger_get_theme_option( 'seo_snippets' ) )
								? array( 'itemprop' => 'image' )
								: ''
					);
				}
				if ( webbloger_get_theme_setting( 'attachments_navigation' ) ) {
					?>
						<nav id="image-navigation" class="navigation image-navigation">
							<div class="nav-previous"><?php previous_image_link( false, '' ); ?></div>
							<div class="nav-next"><?php next_image_link( false, '' ); ?></div>
						</nav><!-- .image-navigation -->
						<?php
				}
				do_action('webbloger_action_after_featured');
				?>
				</div><!-- .post_featured -->
				<?php
				if ( has_excerpt() ) {
					?>
					<div class="entry-caption"><?php the_excerpt(); ?></div><!-- .entry-caption -->
					<?php
				}
			} else {
				if ( 'video' == $post_format ) {
					if ( function_exists( 'trx_addons_sc_widget_video_list' ) ) {
						if ( ! empty( $videos ) && is_array( $videos ) ) {
							if ( count( $videos ) > 1 ) {
								$args['thumb_bg']  = false;
								$show_video_player = true;
							} elseif ( empty( $args['post_info'] ) && ! empty( $videos[0]['title'] ) ) {
								$args['post_info'] = apply_filters(
														'webbloger_filter_video_post_info',
									 					'<div class="post_info post_info_video">'
															. ( ! empty( $videos[0]['subtitle'] ) ? '<div class="post_info_subtitle">' . $videos[0]['subtitle'] . '</div>' : '' )
															. '<h3 class="post_info_title">' . $videos[0]['title'] . '</h3>'
															. ( ! empty( $videos[0]['meta'] ) ? '<div class="post_info_meta">' . $videos[0]['meta'] . '</div>' : '' )
														. '</div>',
														$videos[0],
														$args
													);
							}
						}
					}
				} elseif ( 'audio' == $post_format ) {
					if ( function_exists( 'trx_addons_sc_widget_audio' ) ) {
						if ( ! empty( $audios ) && is_array( $audios ) && count( $audios ) > 0 ) {
							$show_audio_player = true;
						}
					}
				} elseif ( 'gallery' == $post_format ) {
					$post_meta = get_post_meta( get_the_ID(), 'trx_addons_options', true );
					if ( ! empty( $post_meta['gallery_list'] ) ) {
						$gallery_images   = explode( '|', $post_meta['gallery_list'] );
						$args['thumb_bg'] = false;
					}
					$show_gallery     = true;
				}
				if ( ( ( $has_thumb || ! empty( $args['show_no_image'] ) ) && ! webbloger_sc_layouts_showed( 'featured' ) )
						|| $show_video_player || ! empty( $videos )
						|| $show_audio_player
						|| $show_gallery
				) {
					$output = '<div class="post_featured'
											. ( $args['class'] ? ' ' . esc_attr( $args['class'] ) : '' )
											. ( $show_video_player
												? ( ' with_video with_video_list'
													. ( ! empty( $args['class_avg'] )  ? ' ' . esc_attr( $args['class_avg'] ) : '' )
													)
												: ( $show_audio_player
													? ( ' with_audio'
														. ( $has_thumb || ! empty( $args['show_no_image'] ) ? ' with_thumb' : ' without_thumb' )
														. ( ! empty( $args['thumb_bg_class'] ) ? ' ' . $args['thumb_bg_class'] : '' )
														. ( ! empty( $args['class_avg'] )  ? ' ' . esc_attr( $args['class_avg'] ) : '' )
														)
													: ( $show_gallery
														? ( ' with_gallery'
															. ( ! empty( $args['class_avg'] )  ? ' ' . esc_attr( $args['class_avg'] ) : '' )
															)
														: (
															  ( $has_thumb || ! empty( $args['show_no_image'] )
															  	? ' with_thumb' . ( $parallax ? ' sc_parallax_wrap' : '' )
															  	: ' without_thumb'
															  	)
															. ( ! empty( $args['thumb_bg_class'] ) ? ' ' . $args['thumb_bg_class'] : '' )
															. ( in_array( $post_format, array( 'video' ) ) || ! empty( $args['video'] )
																? ( ' with_video'
																	. ( $has_thumb || ! empty( $args['show_no_image'] )
																		? ' hover_play'
																		: ( ! empty( $args['class_avg'] )  ? ' ' . esc_attr( $args['class_avg'] ) : '' )
																		)
																	)
																: '' )
															)
														)
													)
												)
											. '"'
									. ( $args['seo']
										? ' itemscope="itemscope" itemprop="image" itemtype="' . esc_attr( webbloger_get_protocol( true ) ) . '//schema.org/ImageObject"'
										: ''
										)
									. ( ! empty( $args['thumb_bg'] ) && ! empty( $args['thumb_ratio'] )
										? ' data-ratio="' . esc_attr( $args['thumb_ratio'] ) . '"'
										: ''
										)
									. ( $parallax
										? ' data-parallax="' . esc_attr( $parallax ) . '"'
										: ''
										)
									. ( ! empty( $thumb_caption )
										? ' data-caption="' . esc_attr( $thumb_caption ) . '"'
										: ''
										);
					if ( ! empty( $args['data'] ) && is_array( $args['data'] ) ) {
						foreach( $args['data'] as $k => $v ) {
							$output .= ' data-' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
						}
					}
					$output .= '>';
					webbloger_show_layout( $output );
					do_action('webbloger_action_before_featured');
					if ( $has_thumb && $args['seo'] ) {
						$webbloger_attr = webbloger_getimagesize( wp_get_attachment_url( $thumb_id ) );
						?>
						<meta itemprop="width" content="<?php echo esc_attr( $webbloger_attr[0] ); ?>">
						<meta itemprop="height" content="<?php echo esc_attr( $webbloger_attr[1] ); ?>">
						<?php
					}
					if ( ! $args['thumb_bg'] && ! $show_video_player && ! $show_gallery ) {
						$atts = array();
						if ( webbloger_is_on( webbloger_get_theme_option( 'seo_snippets' ) ) ) {
							$atts['itemprop'] = 'url';
						}
						if ( is_numeric( $thumb_id ) && (int) $thumb_id > 0 ) {
							echo wp_get_attachment_image( $thumb_id, $thumb_size, false, $atts );
						} elseif ( has_post_thumbnail() && ( 'video' != $post_format || empty( $post_meta['video_without_cover'] ) ) ) {
							the_post_thumbnail( $thumb_size, $atts );
						} elseif ( ! empty( $no_image ) ) {
							?>
							<img
								<?php
								if ( $args['seo'] ) {
									echo ' itemprop="url"';
								}
								?>
								src="<?php echo esc_url( $no_image ); ?>" alt="<?php the_title_attribute( '' ); ?>">
							<?php
						}
					}
					// Add audio, video or gallery
					webbloger_show_post_avg( array_merge( $args, compact( 'post_format', 'has_thumb', 'thumb_id', 'thumb_size', 'videos', 'audios', 'gallery_images', 'post_meta' ) ) );
					// Put optional info block over the thumb
					webbloger_show_layout( $args['post_info'] );
					do_action('webbloger_action_after_featured');
					echo '</div><!-- .post_featured -->';
				}
			}

		} else {

			if ( $has_thumb
				|| ! empty( $args['show_no_image'] )
				|| ( ! $args['thumb_only']
						&& ( in_array( $post_format, array( 'image', 'audio', 'video' ) )
							|| ( 'gallery' == $post_format && webbloger_exists_trx_addons() )
							)
					)
			) {
				$output = '<div class="post_featured'
					. ( ! empty( $has_thumb ) || 'image' == $post_format || ! empty( $args['show_no_image'] )
						? ( ' with_thumb'
							. ' hover_' . esc_attr( $args['hover'] )
							. ( in_array( $post_format, array( 'video' ) ) || ! empty( $args['video'] )
								? ' hover_play'
								: ''
								)
							)
						: ' without_thumb' )
					. ( ! empty( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : '' )
					. ( ! empty( $image ) ? ' post_featured_bg' : '' )
					. '"'
					. ( ! empty( $args['thumb_bg'] ) && ! empty( $args['thumb_ratio'] ) ? ' data-ratio="' . esc_attr($args['thumb_ratio']) . '"' : '' );
				if ( ! empty( $args['data'] ) && is_array( $args['data'] ) ) {
					foreach( $args['data'] as $k => $v ) {
						$output .= ' data-' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
					}
				}
				if ( !webbloger_is_amp() ) {
					$output .= '>'
							// Add background image wrap (need for animation)
							. ( ! empty( $image ) ? '<div class="featured_bg_wrapper">'
								. '<div class="featured_bg ' . esc_attr(webbloger_add_inline_css_class( 'background-image: url(' . esc_url( $image ) . ');' )) . '"></div>' 
							. '</div>' : '' ); 
				} else {
					$output .= '>'
							. ( ! empty( $image ) ? '<div class="featured_bg_wrapper">'
								. '<img src="' . esc_url( $image ) . '">' 
							. '</div>' : '' ); 
				}
				webbloger_show_layout( $output );
				do_action('webbloger_action_before_featured');
				// Put the thumb or gallery or image or video from the post
				$show_hover = false;
				$image_hover = '';
				if ( $args['thumb_bg'] ) {
					$show_hover = true;
				} elseif ( $has_thumb ) {
					if ( has_post_thumbnail() ) {
						if ( $args['thumb_ratio'] == 'none' ) {
							?><div class="post_featured_wrap"><?php
						}
						the_post_thumbnail(
							$thumb_size, array()
						);
						if ( $args['thumb_ratio'] == 'none' ) {
							?></div><?php
						}
					} elseif ( is_numeric( $thumb_id ) && (int) $thumb_id > 0 ) {
						echo wp_get_attachment_image(
								$thumb_id, $thumb_size, false, ''
							);
					}
					$show_hover = true;
				} elseif ( 'image' == $post_format ) {
					$image = webbloger_get_post_image();
					if ( ! empty( $image ) ) {
						$image = webbloger_add_thumb_size( $image, $thumb_size );
						?>
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(''); ?>">
						<?php
						$show_hover = true;
					}
				} elseif ( ! empty( $args['show_no_image'] ) && ! empty( $no_image ) ) {
					?>
					<img src="<?php echo esc_url( $no_image ); ?>" alt="<?php the_title_attribute(''); ?>">
					<?php
					$show_hover = true;
				} elseif ( 'gallery' == $post_format ) {
					$show_hover = true;
				}

				if ( 'gallery' == $post_format && empty($args['thumb_ratio']) && $has_thumb ) {
					$show_hover = true;
					if (!empty($thumb_size)) {						
						$thumb_sizes = webbloger_storage_get( 'theme_thumbs' );
						$x = $thumb_sizes[$thumb_size]['size'][0];
						$y = $thumb_sizes[$thumb_size]['size'][1];
						if ( $x > 0 && $y > 0 ) {
							$args['thumb_ratio'] = $x . ':' . $y;
						} else {							
							$thumbnail = wp_get_attachment_image_src($thumb_id, 'full');
							$x = $thumbnail[1];
							$y = $thumbnail[2];
							if ( $x > 0 && $y > 0 ) {
								$args['thumb_ratio'] = $x . ':' . $y;
							}
						}
					}
				}
				
				if ( $show_hover ) {
					if ( ! empty( $args['hover'] ) ) {
						?>
						<div class="mask"></div>
						<?php
					}
					webbloger_hovers_add_icons(
						$args['hover'],
						array(
							'no_links'   => $args['no_links'],
							'link'       => $args['link'],
							'post_info'  => $args['post_info'],
							'meta_parts' => $args['meta_parts'],
							'image'      => $image_hover,
						)
					);
				}
				// Add audio, video or gallery
				webbloger_show_post_avg( array_merge( $args, compact( 'post_format', 'has_thumb', 'thumb_id', 'thumb_size', 'videos', 'audios' ) ) );
				// Put optional info block over the thumb				
				webbloger_show_layout( $args['post_info'] );
				
				// Close div.post_featured
				do_action('webbloger_action_after_featured');
				echo '</div>';
			} else {
				// Put optional info block over the thumb
				webbloger_show_layout( $args['post_info'] );
			}
		}
	}
}


// Plugins functions
//--------------------------------------------------
// ELEMENTOR - Check if current page is Elementor page
if ( ! function_exists( 'webbloger_elm_is_elementor_page' ) ) {
	function webbloger_elm_is_elementor_page() {
		if ( webbloger_exists_elementor() ) {
		  global $post;
          if (!isset($post->ID)) {
              return false;
          }
		  return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
		}
		return false;
	}
}

// Return true if Elementor exists and current mode is edit
if ( !function_exists( 'webbloger_elm_is_preview' ) ) {
	function webbloger_elm_is_preview() {
		static $is_preview = -1;
		if ( $is_preview === -1 ) {
			$is_preview = webbloger_exists_elementor() 
							&& (\Elementor\Plugin::instance()->preview->is_preview_mode()
								|| webbloger_get_value_gp('elementor-preview') > 0
								|| (webbloger_get_value_gp('post') > 0
									&& webbloger_get_value_gp('action') == 'elementor'
									)
								|| ( is_admin()
									&& in_array( webbloger_get_value_gp( 'action' ), array( 'elementor', 'elementor_ajax', 'wp_ajax_elementor_ajax' ) )
									)
								);
		}
		return $is_preview;
	}
}

// Activation methods
if ( ! function_exists( 'webbloger_skin_filter_activation_methods' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'webbloger_skin_filter_activation_methods', 10, 1 );
    function webbloger_skin_filter_activation_methods( $args ) {
        $args['elements_key'] = false;
        return $args;
    }
}