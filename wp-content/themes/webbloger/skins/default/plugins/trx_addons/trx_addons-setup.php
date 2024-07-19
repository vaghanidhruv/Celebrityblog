<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */
if ( ! function_exists( 'webbloger_trx_addons_theme_specific_components' ) ) {
	add_filter( 'trx_addons_filter_components_editor', 'webbloger_trx_addons_theme_specific_components' );
	function webbloger_trx_addons_theme_specific_components( $enable = false ) {
		return WEBBLOGER_THEME_FREE
					? false     // Free version
					: false;     // Pro version or Developer mode
	}
}

if ( ! function_exists( 'webbloger_trx_addons_theme_specific_setup1' ) ) {
	add_action( 'after_setup_theme', 'webbloger_trx_addons_theme_specific_setup1', 1 );
	function webbloger_trx_addons_theme_specific_setup1() {
		if ( webbloger_exists_trx_addons() ) {
			add_filter( 'trx_addons_addons_list', 'webbloger_trx_addons_addons_list', 100 );
			add_filter( 'trx_addons_api_list', 'webbloger_trx_addons_api_list' );
			add_filter( 'trx_addons_cpt_list', 'webbloger_trx_addons_cpt_list' );
			add_filter( 'trx_addons_sc_list', 'webbloger_trx_addons_sc_list' );
			add_filter( 'trx_addons_widgets_list', 'webbloger_trx_addons_widgets_list' );
		}
	}
}

// Addons
if ( ! function_exists( 'webbloger_trx_addons_addons_list' ) ) {
	//Handler of the add_filter( 'trx_addons_addons_list', 'webbloger_trx_addons_addons_list', 100 );
	function webbloger_trx_addons_addons_list( $list = array() ) {
		// To do: Enable/Disable theme-specific addons via add/remove it in the list
		if ( is_array( $list ) ) {
			$required_addons = array();
			foreach( $required_addons as $k => $v ) {
				if ( ! isset( $list[ $k ] ) || ! is_array( $list[ $k ] ) ) {
					$list[ $k ] = $v;
				}
				$list[ $k ]['required'] = true;
			}
		}
		return $list;
	}
}

// API
if ( ! function_exists( 'webbloger_trx_addons_api_list' ) ) {
	//Handler of the add_filter('trx_addons_api_list',	'webbloger_trx_addons_api_list');
	function webbloger_trx_addons_api_list( $list = array() ) {
		// To do: Enable/Disable Third-party plugins API via add/remove it in the list

		// If it's a free version - leave only basic set
		if ( WEBBLOGER_THEME_FREE ) {
			$free_api = array( 'gutenberg', 'elementor', 'contact-form-7', 'instagram_feed', 'woocommerce' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_api ) ) {
					unset( $list[ $k ] );
				}
			}
		}
		return $list;
	}
}


// CPT
if ( ! function_exists( 'webbloger_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'webbloger_trx_addons_cpt_list');
	function webbloger_trx_addons_cpt_list( $list = array() ) {
		// To do: Enable/Disable CPT via add/remove it in the list

		// If it's a free version - leave only basic set
		if ( WEBBLOGER_THEME_FREE ) {
			$free_cpt = array( 'layouts', 'portfolio', 'post', 'services', 'team', 'testimonials' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_cpt ) ) {
					unset( $list[ $k ] );
				}
			}
		}
		return $list;
	}
}

// Shortcodes
if ( ! function_exists( 'webbloger_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'webbloger_trx_addons_sc_list');
	function webbloger_trx_addons_sc_list( $list = array() ) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php

		// If it's a free version - leave only basic set
		if ( WEBBLOGER_THEME_FREE ) {
			$free_shortcodes = array( 'action', 'anchor', 'blogger', 'button', 'form', 'icons', 'price', 'promo', 'socials' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_shortcodes ) ) {
					unset( $list[ $k ] );
				}
			}
		}
		return $list;
	}
}

// Widgets
if ( ! function_exists( 'webbloger_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'webbloger_trx_addons_widgets_list');
	function webbloger_trx_addons_widgets_list( $list = array() ) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php

		// If it's a free version - leave only basic set
		if ( WEBBLOGER_THEME_FREE ) {
			$free_widgets = array( 'aboutme', 'banner', 'contacts', 'flickr', 'popular_posts', 'recent_posts', 'slider', 'socials' );
			foreach ( $list as $k => $v ) {
				if ( ! in_array( $k, $free_widgets ) ) {
					unset( $list[ $k ] );
				}
			}
		}
		unset( $list['recent_news']['layouts_sc']['news-announce'] );
		unset( $list['recent_news']['layouts_sc']['news-excerpt'] );
		unset( $list['recent_news']['layouts_sc']['news-portfolio'] );
		return $list;
	}
}

// Add mobile menu to the plugin's cached menu list
if ( ! function_exists( 'webbloger_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'webbloger_trx_addons_menu_cache' );
	function webbloger_trx_addons_menu_cache( $list = array() ) {
		if ( in_array( '#menu_main', $list ) ) {
			$list[] = '#menu_mobile';
		}
		$list[] = '.menu_mobile_inner > nav > ul';
		return $list;
	}
}

// Add theme-specific vars into localize array
if ( ! function_exists( 'webbloger_trx_addons_localize_script' ) ) {
	add_filter( 'webbloger_filter_localize_script', 'webbloger_trx_addons_localize_script' );
	function webbloger_trx_addons_localize_script( $arr ) {
		$arr['alter_link_color'] = webbloger_get_scheme_color( 'alter_link' );

		// Mailchimp
		$arr['mc4wp_msg_email_min'] = esc_html__('Email address is too short (or empty)', 'webbloger');
		$arr['mc4wp_msg_email_max'] = esc_html__('Too long email address', 'webbloger');

		return $arr;
	}
}

// Add theme-specific width where used min 2 columns
if ( ! function_exists( 'webbloger_trx_addons_max_one_column_width' ) ) {
	add_filter( 'trx_addons_filter_max_one_column_width', 'webbloger_trx_addons_max_one_column_width' );
	function webbloger_trx_addons_max_one_column_width( $w ) {
		$media = webbloger_storage_get_array( 'responsive', 'sm_wp' );
		if ( empty( $media['max'] ) ) {
			$media = array( 'max' => 600 );
		}
		return $media['max'];
	}
}


// Shortcodes support
//------------------------------------------------------------------------

// Add new output types (layouts) in the shortcodes
if ( ! function_exists( 'webbloger_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'webbloger_trx_addons_sc_type', 10, 2 );
	function webbloger_trx_addons_sc_type( $list, $sc ) {
		// To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
		if ( 'trx_sc_blogger' == $sc ) {
			$list = webbloger_array_merge( $list, webbloger_get_list_blog_styles( false, 'sc' ) );
		}

		if ( 'trx_sc_layouts_iconed_text' == $sc ) {
			$list['menu'] = esc_html__('Menu', 'webbloger');
		}
		return $list;	
	}
}

// Add params values to the shortcode's atts
if ( ! function_exists( 'webbloger_trx_addons_sc_prepare_atts' ) ) {
	add_filter( 'trx_addons_filter_sc_prepare_atts', 'webbloger_trx_addons_sc_prepare_atts', 10, 2 );
	function webbloger_trx_addons_sc_prepare_atts( $atts, $sc ) {
		// Blogger
		if ( 'trx_sc_blogger' == $sc ) {
			$list = webbloger_get_list_blog_styles( false, 'sc' );
			if ( isset( $list[ $atts['type'] ] ) ) {
			    $blog_id = 0;
			    $blog_meta = array( 'scripts_required' => '' );
				$custom_type = '';
				$use_masonry = false;
				if ( strpos( $atts['type'], 'blog-custom-' ) === 0 ) {
					$blog_id = webbloger_get_custom_blog_id( $atts['type'] );
					$blog_meta = webbloger_get_custom_layout_meta( $blog_id );
					$custom_type = ! empty( $blog_meta['scripts_required'] ) ? $blog_meta['scripts_required'] : 'custom';
					$use_masonry = strpos( $blog_meta['scripts_required'], 'masonry' ) !== false;
				} else {
					$use_masonry = webbloger_is_blog_style_use_masonry( $atts['type'] );
				}
				// Classes for the container with posts
				$columns = $atts['columns'] > 0
								? $atts['columns']
								: ( 1 < $atts['count']
									? $atts['count']
									: ( -1 == $atts['count']
										? 3
										: 1
										)
									);
				$atts['posts_container'] = 'posts_container'
					. ' ' . esc_attr( $atts['type'] ) . '_wrap'
					. ( $columns > 1
							? ' ' . esc_attr( $atts['type'] ) . '_' . $columns 
							: '' )
					. ( $use_masonry
						?  sprintf( ' masonry_wrap masonry_%d', $columns )
						: ( $columns > 1
							? ' columns_wrap columns_padding_bottom'
							: ''
							)
						);
				// Scripts for masonry and portfolio
				if ( $use_masonry ) {
					webbloger_lazy_load_off();
					webbloger_load_masonry_scripts();
				}
			}
		}

		// Recent News
		if ( 'trx_widget_recent_news' == $sc ) {
			if ( $atts['style'] == 'news-magazine' ) {
				$atts['class'] = $atts['class'].' magazine_type_'.$atts['magazine_type'];
			}
		}
		return $atts;
	}
}


// Add new params to the default shortcode's atts
if ( ! function_exists( 'webbloger_trx_addons_sc_atts' ) ) {
	add_filter( 'trx_addons_sc_atts', 'webbloger_trx_addons_sc_atts', 10, 2 );
	function webbloger_trx_addons_sc_atts( $atts, $sc ) {

		// Param 'scheme'
		if ( in_array(
			$sc, array(
				'trx_sc_action',
				'trx_sc_blogger',
				'trx_sc_cars',
				'trx_sc_courses',
				'trx_sc_content',
				'trx_sc_countdown',
				'trx_sc_dishes',
				'trx_sc_events',
				'trx_sc_form',
				'trx_sc_icons',
				'trx_sc_googlemap',
				'trx_sc_yandexmap',
				'trx_sc_osmap',
				'trx_sc_portfolio',
				'trx_sc_price',
				'trx_sc_promo',
				'trx_sc_properties',
				'trx_sc_services',
				'trx_sc_skills',
				'trx_sc_socials',
				'trx_sc_table',
				'trx_sc_team',
				'trx_sc_testimonials',
				'trx_sc_title',
				'trx_widget_audio',
				'trx_widget_twitter',
				'trx_sc_layouts',
				'trx_sc_layouts_container',
			)
		) ) {
			$atts['scheme'] = 'inherit';
		}
		// Param 'color_style'
		if ( in_array(
			$sc, array(
				'trx_sc_action',
				'trx_sc_blogger',
				'trx_sc_cars',
				'trx_sc_courses',
				'trx_sc_content',
				'trx_sc_countdown',
				'trx_sc_dishes',
				'trx_sc_events',
				'trx_sc_form',
				'trx_sc_icons',
				'trx_sc_googlemap',
				'trx_sc_yandexmap',
				'trx_sc_osmap',
				'trx_sc_portfolio',
				'trx_sc_price',
				'trx_sc_promo',
				'trx_sc_properties',
				'trx_sc_services',
				'trx_sc_skills',
				'trx_sc_socials',
				'trx_sc_table',
				'trx_sc_team',
				'trx_sc_testimonials',
				'trx_sc_title',
				'trx_widget_audio',
				'trx_widget_twitter'
			)
		) ) {
			$atts['color_style'] = 'default';
		}
		// Button
		if ( $sc == 'trx_sc_button') {
			$atts['color_style'] = '';
			$atts['hover_style'] = '';
		}
		// Recent News
		if ( $sc == 'trx_widget_recent_news') {
			$atts['magazine_type'] = 'default';
			$atts['button_link'] = '';
			$atts['button_text'] = '';
		}
		// Recent Posts
		if ( $sc == 'trx_widget_recent_posts') {
			$atts['type'] = 'default';
		}
		// Rating Posts
		if ( $sc == 'trx_widget_rating_posts') {
			$atts['type'] = 'default';
		}
		// About Me
		if ( $sc == 'trx_widget_aboutme') {
			$atts['type'] = 'default';
		}
		// Blogger
		if ( $sc == 'trx_sc_blogger') {
			$atts['pagination_align'] = 'left';
			$atts['pagination_style'] = 'default';
			$atts['pagination_color'] = 'default';
			$atts['pagination_hover'] = 'default';

			$atts['full_size_image'] = 0;

			$atts['info_over_image'] = 'none';

			$atts['post_title_tag'] = 'h5';
			$atts['post_title_over_tag'] = 'h5';
			$atts['post_title_length'] = '';

			$atts['column_gap'] = 'no';
		}
		// Video
		if ( $sc == 'trx_widget_video') {
			$atts['button_style'] = 'default';
		}
		// Video list
		if ( $sc == 'trx_widget_video_list') {
			$atts['type'] = 'alter';
			$atts['content_style'] = 'default';
		}
		// Banner
		if ( $sc == 'trx_widget_banner') {
			$atts['align'] = '';
		}
		return $atts;
	}
}


// Add classes to the shortcode's output from new params
if ( ! function_exists( 'webbloger_trx_addons_sc_output' ) ) {
	add_filter( 'trx_addons_sc_output', 'webbloger_trx_addons_sc_output', 10, 4 );
	function webbloger_trx_addons_sc_output( $output, $sc, $atts, $content ) {
		$sc = str_replace( array( 'trx_widget', 'trx_' ), array( 'sc_widget', '' ), $sc );
		if ( substr( $sc, -3 ) == 'map' ) {
			$sc = str_replace( 'map', 'map_content', $sc );
		}
		if ( ! empty( $atts['scheme'] ) && ! webbloger_is_inherit( $atts['scheme'] ) ) {
			$output = str_replace( 'class="' . esc_attr( $sc ) . ' ', 'class="' . esc_attr( $sc ) . ' scheme_' . esc_attr( $atts['scheme'] ) . ' ', $output );
		}

		// Button
		if ( 'sc_button' == $sc ) { 
			if ( ! empty( $atts['color_style'] ) && ! webbloger_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$output = str_replace( 'class="' . esc_attr( $sc ) . ' ', 'class="' . esc_attr( $sc ) . ' color_style_' . esc_attr( $atts['color_style'] ) . ' ', $output );
			}			
		}
		return $output;
	}
}


// Add color_style to the button items
if ( ! function_exists( 'webbloger_trx_addons_sc_item_link_classes' ) ) {
	add_filter( 'trx_addons_filter_sc_item_link_classes', 'webbloger_trx_addons_sc_item_link_classes', 10, 3 );
	function webbloger_trx_addons_sc_item_link_classes( $class, $sc, $atts=array() ) {
		if ( 'sc_button' == $sc ) {
			if ( ! empty( $atts['color_style'] ) && ! webbloger_is_inherit( $atts['color_style'] ) && 'default' != $atts['color_style'] ) {
				$class .= ' color_style_' . esc_attr( $atts['color_style'] );
			}
			if ( ! empty( $atts['hover_style'] ) && ! webbloger_is_inherit( $atts['hover_style'] ) && 'default' != $atts['hover_style'] ) {
				$class .= ' hover_style_' . esc_attr( $atts['hover_style'] );
			}
		}
		return $class;
	}
}

// Return tag for the item's title
if ( ! function_exists( 'webbloger_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'webbloger_trx_addons_sc_item_title_tag' );
	function webbloger_trx_addons_sc_item_title_tag( $tag = '' ) {
		return 'h1' == $tag ? 'h2' : $tag;
	}
}

// Add new styles to the Google map
if ( ! function_exists( 'webbloger_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles', 'webbloger_trx_addons_sc_googlemap_styles' );
	function webbloger_trx_addons_sc_googlemap_styles( $list ) {
		$list['dark'] = esc_html__( 'Dark', 'webbloger' );
		return $list;
	}
}

// Show post info from CPT Portfolio instead post meta
if ( ! function_exists( 'webbloger_trx_addons_portfolio_info' ) ) {
	add_filter( 'webbloger_filter_show_blog_meta', 'webbloger_trx_addons_portfolio_info', 10, 2 );
	function webbloger_trx_addons_portfolio_info( $show, $meta_parts ) {
		if ( webbloger_exists_trx_addons() && defined( 'TRX_ADDONS_CPT_PORTFOLIO_PT' ) && get_post_type() == TRX_ADDONS_CPT_PORTFOLIO_PT && function_exists( 'trx_addons_cpt_portfolio_show_details' ) ) {
			trx_addons_cpt_portfolio_show_details( array( 'class' => 'post_meta', 'count' => 3 ) );
			$show = false;
		}
		return $show;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( ! function_exists( 'webbloger_trx_addons_tiny_mce_style_formats' ) ) {
	add_filter( 'trx_addons_filter_tiny_mce_style_formats', 'webbloger_trx_addons_tiny_mce_style_formats' );
	function webbloger_trx_addons_tiny_mce_style_formats( $style_formats ) {
		// Add style 'Arrow' to the 'List styles'
		// Remove 'false &&' from the condition below to add new style to the list
		if ( false && is_array( $style_formats ) && count( $style_formats ) > 0 ) {
			foreach ( $style_formats as $k => $v ) {
				if ( esc_html__( 'List styles', 'webbloger' ) == $v['title'] ) {
					$style_formats[ $k ]['items'][] = array(
						'title'    => esc_html__( 'Arrow', 'webbloger' ),
						'selector' => 'ul',
						'classes'  => 'trx_addons_list trx_addons_list_arrow',
					);
				}
			}
		}
		return $style_formats;
	}
}


// Setup team and portflio pages
//------------------------------------------------------------------------

// Disable override header image on team and portfolio pages
if ( ! function_exists( 'webbloger_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'webbloger_filter_allow_override_header_image', 'webbloger_trx_addons_allow_override_header_image' );
	function webbloger_trx_addons_allow_override_header_image( $allow ) {
		return is_single()
				&& (
					webbloger_is_team_page()
					|| webbloger_is_cars_page()
					|| webbloger_is_cars_agents_page()
					|| webbloger_is_properties_agents_page()
					)
				? false
				: $allow;
	}
}

// Add fields to the meta box for the team members
// All other CPT meta boxes may be modified in the same method
if ( ! function_exists( 'webbloger_trx_addons_meta_box_fields' ) ) {
	add_filter( 'trx_addons_filter_meta_box_fields', 'webbloger_trx_addons_meta_box_fields', 10, 2 );
	function webbloger_trx_addons_meta_box_fields( $mb, $post_type ) {
		if ( defined( 'TRX_ADDONS_CPT_TEAM_PT' ) && TRX_ADDONS_CPT_TEAM_PT == $post_type ) {
			if ( ! isset( $mb['email'] ) ) {
				$mb['email'] = array(
					'title'   => esc_html__( 'E-mail', 'webbloger' ),
					'desc'    => wp_kses_data( __( "Team member's email", 'webbloger' ) ),
					'std'     => '',
					'details' => true,
					'type'    => 'text',
				);
			}
		}
		return $mb;
	}
}


// Change thumb size for the team items
if ( ! function_exists( 'webbloger_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size', 'webbloger_trx_addons_thumb_size', 10, 2 );
	function webbloger_trx_addons_thumb_size( $thumb_size = '', $type = '' ) {
		return $thumb_size;
	}
}



// Modify layouts of some components
//------------------------------------------------------------------------

// Return theme specific title layout for the slider
if ( ! function_exists( 'webbloger_trx_addons_slider_title' ) ) {
	add_filter( 'trx_addons_filter_slider_title', 'webbloger_trx_addons_slider_title', 10, 4 );
	function webbloger_trx_addons_slider_title( $title, $data, $args, $num ) {
		$title = '';
		if ( ! empty( $data['cats'] ) ) {
			$title .= sprintf( '<div class="slide_cats">%s</div>', $data['cats'] );
		}
		if ( ! empty( $data['title'] ) ) {
			$title .= '<h3 class="slide_title">'
						. ( ! empty( $data['link'] )
								? '<a href="' . esc_url( $data['link'] ) . '"'
									. ( ! empty( $data['link_atts'] )
											? $data['link_atts']
											: ''
											)
									. '>'
								: ''
								)
							. esc_html( $data['title'] )
						. ( ! empty( $data['link'] ) ? '</a>' : '' )
					. '</h3>';
		}
		if ( ! empty( $title ) && ! empty( $num ) ) {
			$title .= '<div class="slide_number">' . apply_filters( 'trx_addons_filter_slider_number', sprintf( '%02d', $num ) ) . '</div>';
		}
		return $title;
	}
}



// New Functions
//--------------------------------------------------

// Enqueue custom scripts
if ( ! function_exists( 'webbloger_skin_trx_addons_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'webbloger_skin_trx_addons_frontend_scripts', 1100 );
	function webbloger_skin_trx_addons_frontend_scripts() {
		if ( webbloger_exists_trx_addons() ) {	
			if ( trx_addons_reviews_enable() && is_singular('post') ) {			
				wp_enqueue_style( 'webbloger-trx-addons-reviews', webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/trx_addons/trx_addons-reviews.css' ), array(), null );
			}

			if ( webbloger_is_on( webbloger_get_theme_option( 'debug_mode' ) ) ) {
				$webbloger_url = webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/trx_addons/trx_addons.js' );
				if ( '' != $webbloger_url ) {
					wp_enqueue_script( 'webbloger-trx-addons', $webbloger_url, array( 'jquery', 'webbloger-utils', 'webbloger-init' ), null, true );
				}
			}

			// Remove TRX Addons plugin scripts
			if ( wp_script_is('modernizr') ) {
	        	wp_dequeue_script( 'modernizr' );
			}
			if ( wp_script_is('draggabilly') ) {
	        	wp_dequeue_script( 'draggabilly' );
			}
			if ( wp_script_is('elastistack') ) {
	        	wp_dequeue_script( 'elastistack' );
			}
		}
	}
}

// Merge hover effects to the single js
if ( ! function_exists( 'webbloger_skin_trx_addons_merge_scripts' ) ) {
	add_filter( 'webbloger_filter_merge_scripts', 'webbloger_skin_trx_addons_merge_scripts' );
	function webbloger_skin_trx_addons_merge_scripts( $list ) {
		$list[] = webbloger_skins_get_current_skin_dir() . 'plugins/trx_addons/trx_addons.js';
		return $list;
	}
}

// Widgets arguments
if ( ! function_exists( 'webbloger_trx_addons_widget_args' ) ) {
	add_filter( 'trx_addons_filter_widget_args', 'webbloger_trx_addons_widget_args', 10, 3 );
	function webbloger_trx_addons_widget_args($array, $instance, $sc) {
		// Recent News
		if ( $sc == 'trx_addons_widget_recent_news') {
			$array['magazine_type'] = isset($instance['magazine_type']) ? $instance['magazine_type'] : '';
			$array['button_link'] = isset($instance['button_link']) ? $instance['button_link'] : '';
			$array['button_text'] = isset($instance['button_text']) ? $instance['button_text'] : '';
		}
		// Recent Posts
		if ( $sc == 'trx_addons_widget_recent_posts') {
			$array['type'] = isset($instance['type']) ? $instance['type'] : '';
		}
		// Rating Posts
		if ( $sc == 'trx_addons_widget_rating_posts') {
			$array['type'] = isset($instance['type']) ? $instance['type'] : '';
		}
		// About me
		if ( $sc == 'trx_addons_widget_aboutme') {
			$array['type'] = isset($instance['type']) ? $instance['type'] : '';

			$avatar = isset($instance['avatar']) ? $instance['avatar'] : '';
			$username = isset($instance['username']) ? $instance['username'] : '';

			if ( 'default' == $instance['type'] ) {
				$avatar = webbloger_get_attachment_url( $avatar, webbloger_get_thumb_size('med-square') );
			}
			if ( 'modern' == $instance['type'] ) {
				$avatar = webbloger_get_attachment_url( $avatar, webbloger_get_thumb_size('about-us-modern') );
			}
			if (!empty($avatar)) {				
				if (!empty($avatar)) {
					$attr = trx_addons_getimagesize($avatar);
					$avatar = '<img src="'.esc_url($avatar).'" alt="'.esc_attr($username).'"'.(!empty($attr[3]) ? ' '.trim($attr[3]) : '').'>';
				}
			}
			$array['avatar'] = $avatar;
		}
		// Blogger
		if ( $sc == 'trx_addons_sow_widget_blogger') {
			$array['pagination_align'] = isset($instance['pagination_align']) ? $instance['pagination_align'] : '';
			$array['pagination_style'] = isset($instance['pagination_style']) ? $instance['pagination_style'] : '';
			$array['pagination_color'] = isset($instance['pagination_color']) ? $instance['pagination_color'] : '';
			$array['pagination_hover'] = isset($instance['pagination_hover']) ? $instance['pagination_hover'] : '';

			$array['column_gap'] = isset($instance['column_gap']) ? $instance['column_gap'] : '';

			$array['info_over_image'] = isset($instance['info_over_image']) ? $instance['info_over_image'] : '';

			$array['post_title_tag'] = isset($instance['post_title_tag']) ? $instance['post_title_tag'] : '';
			$array['post_title_over_tag'] = isset($instance['post_title_over_tag']) ? $instance['post_title_over_tag'] : '';
			$array['post_title_length'] = isset($instance['post_title_length']) ? $instance['post_title_length'] : '';
		}
		// Video
		if ( $sc == 'trx_addons_widget_video') {
			$array['button_style'] = isset($instance['button_style']) ? $instance['button_style'] : '';
		}
		// Video list
		if ( $sc == 'trx_addons_widget_video_list') {
			$array['type'] = isset($instance['type']) ? $instance['type'] : '';
			$array['content_style'] = isset($instance['content_style']) ? $instance['content_style'] : '';
		}
		return $array;
	}
}

// Update the widget settings
if ( ! function_exists( 'webbloger_trx_addons_widget_args_update' ) ) {
	add_filter( 'trx_addons_filter_widget_args_update', 'webbloger_trx_addons_widget_args_update', 10, 3 );
	function webbloger_trx_addons_widget_args_update($instance, $new_instance, $sc) {
		// Recent News		
		if ( $sc == 'trx_addons_widget_recent_news') {
			$instance['magazine_type'] = $new_instance['magazine_type'];
			$instance['button_link'] = $new_instance['button_link'];
			$instance['button_text'] = $new_instance['button_text'];
		}
		// Recent Posts		
		if ( $sc == 'trx_addons_widget_recent_posts') {
			$instance['type'] = $new_instance['type'];
		}
		// Ratign Posts		
		if ( $sc == 'trx_addons_widget_rating_posts') {
			$instance['type'] = $new_instance['type'];
		}
		// About Me	
		if ( $sc == 'trx_addons_widget_aboutme') {
			$instance['type'] = $new_instance['type'];
		}
		// Blogger
		if ( $sc == 'trx_addons_sow_widget_blogger') {
			$instance['pagination_align'] = $new_instance['pagination_align'];
			$instance['pagination_style'] = $new_instance['pagination_style'];
			$instance['pagination_color'] = $new_instance['pagination_color'];
			$instance['pagination_hover'] = $new_instance['pagination_hover'];

			$instance['column_gap'] = $new_instance['column_gap'];

			$instance['full_size_image'] = $new_instance['full_size_image'];

			$instance['info_over_image'] = $new_instance['info_over_image'];

			$instance['post_title_tag'] = $new_instance['post_title_tag'];
			$instance['post_title_over_tag'] = $new_instance['post_title_over_tag'];
			$instance['post_title_length'] = $new_instance['post_title_length'];
		}
		// Video
		if ( $sc == 'trx_addons_widget_video') {
			$instance['button_style'] = $new_instance['button_style'];
		}
		// Video
		if ( $sc == 'trx_addons_widget_video_list') {
			$instance['type'] = $new_instance['type'];
			$instance['content_style'] = $new_instance['content_style'];
		}
		return $instance;
	}
}

// Set up some default widget settings
if ( ! function_exists( 'webbloger_trx_addons_widget_args_default' ) ) {
	add_filter( 'trx_addons_filter_widget_args_default', 'webbloger_trx_addons_widget_args_default', 10, 2 );
	function webbloger_trx_addons_widget_args_default($array, $sc) {		
		// Recent News
		if ( $sc == 'trx_addons_widget_recent_news') {
			$array['magazine_type'] = 'default';
			$array['button_link'] = '';
			$array['button_text'] = '';
		}
		// Recent Posts	
		if ( $sc == 'trx_addons_widget_recent_posts') {
			$array['type'] = 'default';
		}
		// Rating Posts	
		if ( $sc == 'trx_addons_widget_rating_posts') {
			$array['type'] = 'default';
		} 
		// About Me
		if ( $sc == 'trx_addons_widget_aboutme') {
			$array['type'] = 'default';
		} 
		// Blogger
		if ( $sc == 'trx_addons_sow_widget_blogger') {
			$array['pagination_align'] = 'left';
			$array['pagination_style'] = 'default';
			$array['pagination_color'] = 'default';
			$array['pagination_hover'] = 'default';

			$array['column_gap'] = 'no';

			$array['full_size_image'] = 0;

			$array['info_over_image'] = 'none';

			$array['post_title_tag'] = 'h5';
			$array['post_title_over_tag'] = 'h5';
			$array['post_title_length'] = '';
		}
		// Video
		if ( $sc == 'trx_addons_sow_widget_blogger') {
			$array['button_style'] = 'default';
		}
		// Video list
		if ( $sc == 'trx_addons_widget_video_list') {
			$array['type'] = 'type';
			$array['content_style'] = 'content_style';
		}
		return $array;
	}
}

// Add widget fields after title
if ( ! function_exists( 'webbloger_trx_addons_after_widget_title' ) ) {
	add_action( 'trx_addons_action_after_widget_title', 'webbloger_trx_addons_after_widget_title', 10, 3 );
	function webbloger_trx_addons_after_widget_title($instance, $sc, $widget) {		
		// Recent Posts
		if ( $sc == 'trx_addons_widget_recent_posts') {
			$widget->show_field( 
								array(
									'name' => 'type',
									'title' => esc_html__('Widget type:', 'webbloger'),
									'value' => $instance['type'],
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'classic' => esc_html__('Classic', 'webbloger'),
													'modern' => esc_html__('Modern', 'webbloger')
													),
									'type' => 'select'
									)
								);	
		}
		// Rating Posts
		if ( $sc == 'trx_addons_widget_rating_posts') {
			$widget->show_field( 
								array(
									'name' => 'type',
									'title' => esc_html__('Widget type:', 'webbloger'),
									'value' => $instance['type'],
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'modern' => esc_html__('Modern', 'webbloger')
													),
									'type' => 'select'
									)
								);
		}
		// About Me
		if ( $sc == 'trx_addons_widget_aboutme') {
			$widget->show_field( 
								array(
									'name' => 'type',
									'title' => esc_html__('Widget type:', 'webbloger'),
									'value' => $instance['type'],
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'modern' => esc_html__('Modern', 'webbloger')
													),
									'type' => 'select'
									)
								);
		}
		// Video
		if ( $sc == 'trx_addons_widget_video') {
			$widget->show_field( 
								array(
									'name' => 'button_style',
									'title' => esc_html__('Button style:', 'webbloger'),
									'value' => array_key_exists('button_style', $instance) ? $instance['button_style'] : '',
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'bordered' => esc_html__('Bordered', 'webbloger')
													),
									'type' => 'select'
									)
								);
		}  
		// Video list
		if ( $sc == 'trx_addons_widget_video_list') {
			$widget->show_field( 
								array(
									'name' => 'type',
									'title' => esc_html__('Type:', 'webbloger'),
									'value' => $instance['type'],
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'alter' => esc_html__('Alter', 'webbloger'),
													'wide' => esc_html__('Wide', 'webbloger'),
													'news' => esc_html__('News', 'webbloger'),
													'classic' => esc_html__('Classic', 'webbloger')
													),
									'type' => 'select'
									)
								);
			$widget->show_field( 
								array(
									'name' => 'content_style',
									'title' => esc_html__('Content style:', 'webbloger'),
									'value' => $instance['content_style'],
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'alter' => esc_html__('Alter', 'webbloger'),
													),
									'dependency' => array(
										'type' => array( 'classic' ),
									),
									'type' => 'select'
									)
								);
		}  
	}
}

// Add widget fields before filters
if ( ! function_exists( 'webbloger_trx_addons_before_widget_filters' ) ) {
	add_action( 'trx_addons_action_before_widget_filters', 'webbloger_trx_addons_before_widget_filters', 10, 3 );
	function webbloger_trx_addons_before_widget_filters($instance, $sc, $widget) {	
		// Blogger
		if ( $sc == 'trx_addons_sow_widget_blogger') {
			$widget->show_field( 
								array(
									'name' => 'pagination_align',
									'title' => esc_html__('Pagination align:', 'webbloger'),
									'value' => $instance['pagination_align'],
									'options' => trx_addons_get_list_sc_aligns(),
									'dependency' => array(
										'pagination' => array( 'load_more' ),
									),
									'type' => 'select'
									)
							);
			$widget->show_field( 
								array(
									'name' => 'pagination_style',
									'title' => esc_html__('Pagination style:', 'webbloger'),
									'value' => $instance['pagination_style'],
									'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'button'), 'trx_sc_button'),
									'dependency' => array(
										'pagination' => array( 'load_more' ),
									),
									'type' => 'select'
									)
							);
			$widget->show_field( 
								array(
									'name' => 'pagination_color',
									'title' => esc_html__('Pagination color:', 'webbloger'),
									'value' => $instance['pagination_color'],
									'options' => webbloger_skin_get_list_sc_color_styles(),
									'dependency' => array(
										'pagination' => array( 'load_more' ),
									),
									'type' => 'select'
									)
							);
			$widget->show_field( 
								array(
									'name' => 'pagination_hover',
									'title' => esc_html__('Pagination hover:', 'webbloger'),
									'value' => $instance['pagination_hover'],
									'options' => webbloger_skin_get_list_sc_hover_styles(false),
									'dependency' => array(
										'pagination' => array( 'load_more' ),
									),
									'type' => 'select'
									)
								);
		}
	}
}

// Add widget fields before widget meta
if ( ! function_exists( 'webbloger_trx_addons_before_widget_meta' ) ) {
	add_action( 'trx_addons_action_before_widget_meta', 'webbloger_trx_addons_before_widget_meta', 10, 3 );
	function webbloger_trx_addons_before_widget_meta($instance, $sc, $widget) {				
		// Blogger
		if ( $sc == 'trx_addons_sow_widget_blogger') {
			$widget->show_field( 
								array(
									'name' => 'full_size_image',
									'title' => '',
									'label' => esc_html__('Full size image', 'webbloger'),
									'value' => (int) $instance['full_size_image'],
									'dependency' => array(
										'type' => array( 'default' ),
									),
									'type' => 'checkbox'
									)
								);
			$widget->show_field( 
								array(
									'name' => 'info_over_image',
									'title' => esc_html__('Info over image:', 'webbloger'),
									'description' => esc_html__('Show info over image for the post format Image.', 'webbloger'),
									'value' => $instance['info_over_image'],
									'dependency' => array(
										'type' => array( 'default', 'wide' ),
										'template_default' => array( 'classic', 'classic_3' ),
									),
									'options' => array(
													'none' => esc_html__('None', 'webbloger'),
													'cc' => esc_html__('Center center', 'webbloger'),
													'bc' => esc_html__('Bottom center', 'webbloger'),
													'bl' => esc_html__('Bottom left', 'webbloger'),
													'bl_2' => esc_html__('Bottom left and category on the top', 'webbloger'),
													),
									'type' => 'select'
									)
								);
			$widget->show_field( 
								array(
									'name' => 'post_title_tag',
									'title' => esc_html__('Titles tag:', 'webbloger'),
									'value' => $instance['post_title_tag'],
									'dependency' => array(
										'type' => array( 'default', 'wide', 'list', 'news' ),
									),
									'options' => array(
													'h1' => esc_html__('Heading 1', 'webbloger'),
													'h2' => esc_html__('Heading 2', 'webbloger'),
													'h3' => esc_html__('Heading 3', 'webbloger'),
													'h4' => esc_html__('Heading 4', 'webbloger'),
													'h5' => esc_html__('Heading 5', 'webbloger'),
													'h6' => esc_html__('Heading 6', 'webbloger'),
													),
									'type' => 'select'
									)
								);
			$widget->show_field( 
								array(
									'name' => 'post_title_over_tag',
									'title' => esc_html__('Titles tag (over image):', 'webbloger'),
									'value' => $instance['post_title_over_tag'],
									'dependency' => array(
										'type' => array( 'default', 'wide' ),
										'template_default' => array( 'classic', 'classic_3' ),
									),
									'options' => array(
													'h1' => esc_html__('Heading 1', 'webbloger'),
													'h2' => esc_html__('Heading 2', 'webbloger'),
													'h3' => esc_html__('Heading 3', 'webbloger'),
													'h4' => esc_html__('Heading 4', 'webbloger'),
													'h5' => esc_html__('Heading 5', 'webbloger'),
													'h6' => esc_html__('Heading 6', 'webbloger'),
													),
									'type' => 'select'
									)
								);
			$widget->show_field( 
								array(
									'name' => 'post_title_length',
									'title' => esc_html__('Title length (in letters):', 'webbloger'),
									'value' => $instance['post_title_length'],
									'dependency' => array(
										'type' => array( 'default', 'wide', 'list', 'news' ),
									),
									'type' => 'text'
									)
								);
			$widget->show_field( 
								array(
									'name' => 'column_gap',
									'title' => esc_html__('Gap between posts:', 'webbloger'),
									'value' => $instance['column_gap'],
									'dependency' => array(
										'type' => array( 'default' ),
										'template_default' => array( 'over_centered', 'over_bottom_center', 'over_bottom_left' ),
									),
									'options' => array(
													'no' => esc_html__('No gap', 'webbloger'),
													'small' => esc_html__('Small gap', 'webbloger'),
													'normal' => esc_html__('Normal gap', 'webbloger'),
									),
									'type' => 'select'
									)
								);
		}
	}
}

// Add widget fields after all fields
if ( ! function_exists( 'webbloger_trx_addons_after_widget_fields' ) ) {
	add_action( 'trx_addons_action_after_widget_fields', 'webbloger_trx_addons_after_widget_fields', 10, 3 );
	function webbloger_trx_addons_after_widget_fields($instance, $sc, $widget) {		
		// Recent News
		if ( $sc == 'trx_addons_widget_recent_news') {
			$widget->show_field( 
								array(
									'name' => 'magazine_type',
									'title' => esc_html__('Magazine type:', 'webbloger'),
									'value' => $instance['magazine_type'],
									'dependency' => array(
										'style' => array( 'news-magazine' )
									),
									'options' => array(
													'default' => esc_html__('Default', 'webbloger'),
													'on_plate' => esc_html__('On Plate', 'webbloger'),
													'with_rating' => esc_html__('With Rating', 'webbloger')
													),
									'type' => 'select'
									)
								);
		
			$widget->show_field( 
								array(
									'name' => 'button_link',
									'title' => esc_html__('Button link:', 'webbloger'),
									'value' => $instance['button_link'],
									'dependency' => array(
										'style' => array( 'news-magazine' )
									),
									'type' => 'text'
									)
								);

			$widget->show_field( 
                                array(
                                    'name' => 'button_text',
                                    'title' => esc_html__('Button text:', 'webbloger'),
                                    'value' => array_key_exists('button_text', $instance) ? $instance['button_text'] : '',
                                    'dependency' => array(
                                            'style' => array( 'news-magazine' )
                                    ),
                                    'type' => 'text'
                                    )
                                );

		}
	}
}

// Add new attributes to Recent News template
if ( ! function_exists( 'webbloger_trx_addons_sc_recent_news_template_args' ) ) {
	add_filter( 'trx_addons_filter_sc_recent_news_template_args', 'webbloger_trx_addons_sc_recent_news_template_args', 10, 2 );
	function webbloger_trx_addons_sc_recent_news_template_args($array, $atts) {		
		$array['magazine_type'] = $atts['magazine_type'];
		$array['button_link'] = $atts['button_link'];
		$array['button_text'] = $atts['button_text'];
		return $array;
	}
}

// Add new controls to widgets and shortcodes
if ( ! function_exists( 'webbloger_elm_add_new_controls' ) ) {
	add_action( 'elementor/element/before_section_end', 'webbloger_elm_add_new_controls', 10, 3 );
	function webbloger_elm_add_new_controls( $element, $section_id, $args ) {		
		if ( is_object( $element ) ) {
			$el_name = $element->get_name();
			// Recent News
			if ( 'trx_sc_recent_news' == $el_name  && 'section_sc_recent_news' === $section_id ) {
				$element->add_control(
					'magazine_type', array(
						'label'       => esc_html__( 'Magazine type', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
										'default' => esc_html__('Default', 'webbloger'),
										'on_plate' => esc_html__('On Plate', 'webbloger'),
										'with_rating' => esc_html__('With Rating', 'webbloger')
									),
						'condition' => [
							'style' => ['news-magazine']
						],
						'default' => 'default'
					)
				);

				$element->add_control(
					'button_link', array(
						'label'       => esc_html__( 'Button link', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
								'style' => ['news-magazine']
						],
						'default' => ''
					)
				);

				$element->add_control(
					'button_text', array(
						'label'       => esc_html__( 'Button text', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
								'style' => ['news-magazine']
						],
						'default' => ''
					)
				);
			}
			// Recent Posts
			if ( 'trx_widget_recent_posts' == $el_name  && 'section_sc_recent_posts' === $section_id ) {
				$element->add_control(
					'type', array(
						'label'       => esc_html__( 'Type', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
										'default' => esc_html__('Default', 'webbloger'),
										'classic' => esc_html__('Classic', 'webbloger'),
										'modern' => esc_html__('Modern', 'webbloger')
									),
						'default' => 'default'
					), array(
						'index' => 2
					)
				);
			}
			// Rating Posts
			if ( 'trx_widget_rating_posts' == $el_name  && 'section_sc_rating_posts' === $section_id ) {
				$element->add_control(
					'type', array(
						'label'       => esc_html__( 'Type', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
										'default' => esc_html__('Default', 'webbloger'),
										'modern' => esc_html__('Modern', 'webbloger')
									),
						'default' => 'default'
					), array(
						'index' => 2
					)
				);
			}
			// About Me
			if ( 'trx_widget_aboutme' == $el_name  && 'section_sc_aboutme' === $section_id ) {
				$element->add_control(
					'type', array(
						'label'       => esc_html__( 'Type', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
										'default' => esc_html__('Default', 'webbloger'),
										'modern' => esc_html__('Modern', 'webbloger')
									),
						'default' => 'default'
					), array(
						'index' => 2
					)
				);
			}
			// Blogger
			if ( 'trx_sc_blogger' == $el_name  && 'section_sc_blogger' === $section_id ) {
				$element->add_control(
					'pagination_align', array(
						'label'       => esc_html__( 'Pagination align', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'pagination' => array( 'load_more' ),
						],
						'options' => trx_addons_get_list_sc_aligns(false, false),
						'default' => 'left',
					), array(
						'index' => 14
					)
				);
				$element->add_control(
					'pagination_style', array(
						'label'       => esc_html__( 'Pagination style', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'pagination' => array( 'load_more' ),
						],
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'button'), 'trx_sc_button'),
						'default' => 'default',
					), array(
						'index' => 15
					)
				);
				$element->add_control(
					'pagination_color', array(
						'label'       => esc_html__( 'Pagination color', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'pagination' => array( 'load_more' ),
						],
						'options' => webbloger_skin_get_list_sc_color_styles(),
						'default' => 'default',
					), array(
						'index' => 16
					)
				);
				$element->add_control(
					'pagination_hover', array(
						'label'       => esc_html__( 'Pagination hover', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'pagination' => array( 'load_more' ),
						],
						'options' => webbloger_skin_get_list_sc_hover_styles(false),
						'default' => 'default',
					), array(
						'index' => 17
					)
				);
			}
			if ( 'trx_sc_blogger' == $el_name  && 'section_sc_blogger_details' === $section_id ) {			
				$element->add_control( 
					'column_gap', array(
						'label'       => esc_html__( 'Gap between posts', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'type' => [ 'default' ],
										'template_default' => [ 'over_centered', 'over_bottom_center', 'over_bottom_left' ],
									],
						'options' => array(
										'no' => esc_html__('No gap', 'webbloger'),
										'small' => esc_html__('Small gap', 'webbloger'),
										'normal' => esc_html__('Normal gap', 'webbloger'),
									),
						'default' => 'no'
					), array(
						'index' => 34
					)
				);
				$element->add_control( 
					'full_size_image', array(
						'label'       => esc_html__( 'Full size image', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'condition' => [
										'type' => [ 'default' ],
									],
						'label_off' => __( 'Off', 'webbloger' ),
						'label_on' => __( 'On', 'webbloger' ),
						'return_value' => '1',
						'default' => ''
					), array(
						'index' => 35
					)
				);		
				$element->add_control(
					'info_over_image', array(
						'label'       => esc_html__( 'Info over image', 'webbloger' ),
						'description' => esc_html__('Show info over image for the post format Image', 'webbloger'),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'type' => [ 'default', 'wide' ],
										'template_default' => [ 'classic', 'classic_3' ],
									],
						'options' => array(
										'none' => esc_html__('None', 'webbloger'),
										'cc' => esc_html__('Center center', 'webbloger'),
										'bc' => esc_html__('Bottom center', 'webbloger'),
										'bl' => esc_html__('Bottom left', 'webbloger'),
										'bl_2' => esc_html__('Bottom left and category on the top', 'webbloger'),
									),
						'default' => 'none'
					), array(
						'index' => 40
					)
				);
				$element->add_control( 
					'post_title_tag', array(
						'label'       => esc_html__( 'Titles tag', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'type' => [ 'default', 'wide', 'list', 'news' ],
									],
						'options' => array(
										'h1' => esc_html__('Heading 1', 'webbloger'),
										'h2' => esc_html__('Heading 2', 'webbloger'),
										'h3' => esc_html__('Heading 3', 'webbloger'),
										'h4' => esc_html__('Heading 4', 'webbloger'),
										'h5' => esc_html__('Heading 5', 'webbloger'),
										'h6' => esc_html__('Heading 6', 'webbloger'),
									),
						'default' => 'h5'
					), array(
						'index' => 41
					)
				);
				$element->add_control( 
					'post_title_over_tag', array(
						'label'       => esc_html__( 'Titles tag (over image)', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
										'type' => [ 'default', 'wide' ],
										'template_default' => [ 'classic', 'classic_3' ],
									],
						'options' => array(
										'h1' => esc_html__('Heading 1', 'webbloger'),
										'h2' => esc_html__('Heading 2', 'webbloger'),
										'h3' => esc_html__('Heading 3', 'webbloger'),
										'h4' => esc_html__('Heading 4', 'webbloger'),
										'h5' => esc_html__('Heading 5', 'webbloger'),
										'h6' => esc_html__('Heading 6', 'webbloger'),
									),
						'default' => 'h5'
					), array(
						'index' => 42
					)
				);
				$element->add_control( 
					'post_title_length', array(
						'label'       => esc_html__( 'Title length (in letters)', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::TEXT,
						'condition' => [
										'type' => [ 'default', 'wide', 'list', 'news' ],
									],
						'default' => ''
					), array(
						'index' => 43
					)
				);
				$element->update_control(
					'on_plate', array(
					
						'label' => esc_html__( 'On plate', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'Off', 'webbloger' ),
						'label_on' => esc_html__( 'On', 'webbloger' ),
						'return_value' => '1',
						'condition' => [
							'type' => [ 'default' ],
						]
					)
				);
				$element->remove_control(
					'no_margin'				
				);
			}
			// Menu				
			if ( 'trx_sc_layouts_menu' == $el_name  && 'section_sc_layouts_menu' === $section_id ) {
				$element->update_control(
					'animation_in',
					[
						'label' => __( 'Submenu animation in', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_animations_in(),
						'default' => 'fadeIn',
						'condition' => [
							'type' => 'default',
							'direction' => 'horizontal'
						]
					]
				);

				$element->update_control(
					'animation_out',
					[
						'label' => __( 'Submenu animation out', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_animations_out(),
						'default' => 'fadeOut',
						'condition' => [
							'type' => 'default',
							'direction' => 'horizontal'
						]
					]
				);
			}
			// Video
			if ( 'trx_widget_video' == $el_name  && 'section_sc_video' === $section_id ) {
				$element->add_control(
					'button_style', array(
						'label'       => esc_html__( 'Button style', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(
										'default' => esc_html__('Default', 'webbloger'),
										'bordered' => esc_html__('Bordered', 'webbloger'),
									),
						'default' => 'default'
					), array(
						'index' => 2
					)
				);
			}
			// Video list
			if ( 'trx_widget_video_list' == $el_name  && 'section_sc_video_list' === $section_id ) {
				$element->add_control( 
					'type', array(
						'label'       => esc_html__( 'Type', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(										
										'default' => esc_html__('Default', 'webbloger'),
										'alter' => esc_html__('Alter', 'webbloger'),
										'wide' => esc_html__('Wide', 'webbloger'),
										'news' => esc_html__('News', 'webbloger'),
										'classic' => esc_html__('Classic', 'webbloger')
									),
						'default' => 'alter'
					), array(
						'index' => 2
					)
				);
				$element->add_control( 
					'content_style', array(
						'label'       => esc_html__( 'Content style', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => array(										
										'default' => esc_html__('Default', 'webbloger'),
										'alter' => esc_html__('Alter', 'webbloger'),
									),
						'condition' => [
							'type' => 'classic',
						],
						'default' => 'default'
					), array(
						'index' => 3
					)
				);
			}
			if ( 'trx_widget_video_list' == $el_name  && 'section_sc_video_list_controller' === $section_id ) {			
				$element->update_control( 
					'controller_pos', array(
						'label' => __( 'Position of the TOC', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_video_list_controller_positions(),
						'condition' => [
							'type' => array('default','alter','wide'),
						],
						'default' => 'bottom',
					)
				);	
				$element->remove_control('controller_pos');
				$element->remove_control('controller_height');
			}
			// Slider
			if ( 'trx_widget_slider' == $el_name  && 'section_sc_slider_controller' === $section_id ) {				
				$element->remove_control('section_sc_slider_controller');				
			}
			// Menu
			if ( 'trx_sc_layouts_menu' == $el_name  && 'section_sc_layouts_menu' === $section_id ) {				
				$element->update_control( 
					'submenu_style', array(
						'label' => __( 'Submenu style', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::HIDDEN,
						'options' => trx_addons_get_list_sc_submenu_styles(),
						'default' => 'popup',
						'condition' => [
							'type' => 'default',
							'direction' => 'vertical',
						]
					)
				);	
				$element->update_control( 
					'animation_in', array(
						'label' => __( 'Submenu animation in', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::HIDDEN,
						'options' => trx_addons_get_list_animations_in(),
						'default' => 'fadeIn',
						'condition' => [
							'type' => 'default'
						]
					)
				);

				$element->update_control( 
					'animation_out', array(
						'label' => __( 'Submenu animation out', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::HIDDEN,
						'options' => trx_addons_get_list_animations_out(),
						'default' => 'fadeOut',
						'condition' => [
							'type' => 'default'
						]
					)
				);		
			} 
			// Search
			if ( 'trx_sc_layouts_search' == $el_name  && 'section_sc_layouts_search' === $section_id ) {
				$post_types = trx_addons_get_list_posts_types();	
				$element->update_control( 
					'post_types', array(
						'label' => __( 'Search in post types', 'webbloger' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT2,
						'options' => $post_types,
						'multiple' => false,
						'default' => ''
					)
				);
			}
		}
	}
}

// Add param 'hover_style' to the shortcode 'Button' in the Elementor
if ( ! function_exists( 'webbloger_skin_trx_addons_sc_param_group_params' ) ) {
	add_filter( 'trx_addons_sc_param_group_params', 'webbloger_skin_trx_addons_sc_param_group_params', 10, 2 );
	function webbloger_skin_trx_addons_sc_param_group_params( $params, $sc ) {
		// Param 'hover_style'
		if ( in_array( $sc, array( 'trx_sc_button' ) ) ) {
			// If it's Elementor's params
			if ( isset( $params[0]['name'] ) && isset( $params[0]['label'] ) ) {
				array_splice($params, 1, 0, array( 
					array(
						'name'        => 'hover_style',
						'type'        => \Elementor\Controls_Manager::SELECT,
						'label'       => esc_html__( 'Hover style', 'webbloger' ),
						'label_block' => false,
						'condition' => [
							'type' => [ 'default' ],
						],
						'options'     => webbloger_skin_get_list_sc_hover_styles(),
						'default'     => 'default',
					),
					array(
						'name'        => 'hover_style_rounded',
						'type'        => \Elementor\Controls_Manager::SELECT,
						'label'       => esc_html__( 'Hover style', 'webbloger' ),
						'label_block' => false,
						'condition' => [
							'type' => [ 'rounded' ],
						],
						'options'     => webbloger_skin_get_list_sc_hover_styles(false),
						'default'     => 'default',
					) 
				) );
			}
		}
		return $params;
	}
}

// Send new attribute to widget template
if ( ! function_exists( 'webbloger_trx_addons_gb_map' ) ) {
	add_filter( 'trx_addons_gb_map', 'webbloger_trx_addons_gb_map', 10, 2 );
	function webbloger_trx_addons_gb_map($array, $sc) {	
		// Recent News	
		if ( $sc == 'trx-addons/recent-news' ) {
			$array['attributes']['magazine_type'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
			$array['attributes']['button_link'] = array(
											'type'    => 'string',
											'default' => '',
										);
			$array['attributes']['button_text'] = array(
											'type'    => 'string',
											'default' => '',
										);
		}
		// Recent Posts	
		if ( $sc == 'trx-addons/recent-posts' ) {
			$array['attributes']['type'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
		}
		// About Me
		if ( $sc == 'trx-addons/aboutme' ) {
			$array['attributes']['type'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
		}
		// Blogger
		if ( $sc == 'trx-addons/blogger' ) {
			$array['attributes']['pagination_align'] = array(
											'type'    => 'string',
											'default' => 'left',
										);
			$array['attributes']['pagination_style'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
			$array['attributes']['pagination_color'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
			$array['attributes']['pagination_hover'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
			$array['attributes']['column_gap'] = array(
											'type'    => 'string',
											'default' => 'no',
										);
			$array['attributes']['full_size_image'] = array(
											'type'    => 'boolean',
											'default' => false,
										);
			$array['attributes']['info_over_image'] = array(
											'type'    => 'string',
											'default' => 'none',
										);
			$array['attributes']['post_title_tag'] = array(
											'type'    => 'string',
											'default' => 'h5',
										);
			$array['attributes']['post_title_over_tag'] = array(
											'type'    => 'string',
											'default' => 'h5',
										);
			$array['attributes']['post_title_length'] = array(
											'type'    => 'string',
											'default' => '',
										);
		}
		// Video
		if ( $sc == 'trx-addons/video' ) {
			$array['attributes']['button_style'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
		}
		// Video list
		if ( $sc == 'trx-addons/video-player' ) {
			$array['attributes']['type'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
			$array['attributes']['content_style'] = array(
											'type'    => 'string',
											'default' => 'default',
										);
		}
		// Banner 		
		if ( $sc == 'trx-addons/banner' ) {
			$array['attributes']['align'] = array(
							'type'    => 'string',
							'default' => '',
						);
		}
		return $array;
	}
}