/* global jQuery, WEBBLOGER_STORAGE */

( function() {
	"use strict";

	var $window   = jQuery( window ),
		$document = jQuery( document ),
		is_touch_device = ('ontouchstart' in document.documentElement);



	/* Ready
	***************************/
	$document.ready(function() {
		// Add class to body if current deviced is touched
		if ( is_touch_device ) {
			jQuery('body').addClass('touch_device');
		} 

		// Color switcher init
		webbloger_skin_color_switcher_ready();

		// Infinite scroll in the single posts
		WEBBLOGER_STORAGE['cur_page_id'] = jQuery('body').hasClass('single-post') ? jQuery('body').attr('class').match(/postid-[0-9]+/g).toString().replace('postid-', '') : ''; 

		// Post navigation
		webbloger_skin_post_nav_links_ready();

		// Post comments
		webbloger_skin_post_comments_ready_ajax(); 

		// Post blocks
		webbloger_skin_post_blocks_ready_resize();

		// Post audio	
		webbloger_skin_post_audio_ready_ajax();

		// Post header
		webbloger_skin_post_header_ready_resize_ajax();

		// Blog  
		webbloger_skin_blog_ready_resize();

		// Add icons wrapper for widget title
		webbloger_skin_widget_title_ready();

		// Magnific Popup
		webbloger_skin_magnific_ready();

		// MailChimp
		webbloger_skin_mailchimp_ready_ajax();
		webbloger_skin_mc4wp_ready();
		webbloger_skin_mc4wp_alert();
		
		// Powerkit
		webbloger_skin_powerkit_ready();

		// Elementor Widget Video
		webbloger_skin_elementor_video_ready();

		// Elementor Widget Counter
		webbloger_skin_elementor_counter_ready();
	});



	/* Page Load
	***************************/
	$window.load(function() {
		// Position of Animated Item (on page load)
		jQuery('.ta_mouse_wheel').each(function() {
			var item = jQuery(this);
			webbloger_skin_mousewheelItemPosition(item);
		});

		// Progress bar
		var scroll_progress = jQuery('.scroll_progress_fixed');
		if ( scroll_progress.length > 0 ) {
			scroll_progress.appendTo(jQuery('.sc_layouts_row_fixed'));
		}

		// Visible on load
		webbloger_skin_isVisibleOnLoad(".single-post .sc_blogger.alignright .sc_blogger_item", "webbloger_animation_fade_in_up");
		webbloger_skin_isVisibleOnLoad(".single-post .sc_blogger.alignleft .sc_blogger_item", "webbloger_animation_fade_in_up");
	    webbloger_skin_isVisibleOnLoad(".single-post .content_wrap .sc_widget_video", "webbloger_animation_fade_in_up");
	    webbloger_skin_isVisibleOnLoad(".single-post .content_wrap .sc_widget_slider", "webbloger_animation_fade_in_up");

		// Title Animation 
		webbloger_skin_isVisibleOnLoad(".widgettitle_icons_wrapper", "webbloger_animation_fade_in");

		// Footer Animation 
		webbloger_skin_isVisibleOnLoad(".footer_wrap .wp-widget-nav_menu li", "webbloger_animation_fade_in"); 	
		webbloger_skin_isVisibleOnLoad(".footer_wrap .widget_nav_menu li", "webbloger_animation_fade_in");
		webbloger_skin_isVisibleOnLoad(".footer_wrap .mailchimp-form-2 .EMAIL-label", "webbloger_animation_width");
		webbloger_skin_isVisibleOnLoad(".footer_wrap #style-2 .email-label", "webbloger_animation_width");

		// Powerkit Animation
		webbloger_skin_isVisibleOnLoad(".pk-widget-author-container .pk-author-title", "webbloger_animation_fade_in_up");
		webbloger_skin_isVisibleOnLoad(".pk-widget-author-container .pk-author-data", "webbloger_animation_fade_in_up");
		webbloger_skin_isVisibleOnLoad(".pk-widget-author-container .widget_title", "webbloger_animation_fade_in_up");
	}); 


	 
	/* Page Scroll
	***************************/
	$document.on('action.scroll_webbloger', function() { 
		// Infinite scroll in the single posts
		webbloger_skin_infinite_scroll_single_posts_resize();

		// Progress bar
		var scroll_progress = jQuery('body > .scroll_progress_fixed');
		if ( scroll_progress.length > 0 ) {
			scroll_progress.appendTo(jQuery('.sc_layouts_row_fixed'));
		}

		// Blog Single Post Animation 
		webbloger_skin_isVisible(".single-post .sc_blogger.alignright .sc_blogger_item", "webbloger_animation_fade_in_up");
		webbloger_skin_isVisible(".single-post .sc_blogger.alignleft .sc_blogger_item", "webbloger_animation_fade_in_up");
	    webbloger_skin_isVisible(".single-post .content_wrap .sc_widget_video", "webbloger_animation_fade_in_up");
	    webbloger_skin_isVisible(".single-post .content_wrap .sc_widget_slider", "webbloger_animation_fade_in_up");

		// Title Animation 
		webbloger_skin_isVisible(".widgettitle_icons_wrapper", "webbloger_animation_fade_in");

		// Footer Animation 
		webbloger_skin_isVisible(".footer_wrap .wp-widget-nav_menu li", "webbloger_animation_fade_in"); 	
		webbloger_skin_isVisible(".footer_wrap .widget_nav_menu li", "webbloger_animation_fade_in");
		webbloger_skin_isVisible(".footer_wrap .mailchimp-form-2 .EMAIL-label", "webbloger_animation_width");
		webbloger_skin_isVisible(".footer_wrap #style-2 .email-label", "webbloger_animation_width");

		// Powerkit Animation
		webbloger_skin_isVisible(".pk-widget-author-container .pk-author-title", "webbloger_animation_fade_in_up");
		webbloger_skin_isVisible(".pk-widget-author-container .pk-author-data", "webbloger_animation_fade_in_up");
		webbloger_skin_isVisible(".pk-widget-author-container .widget_title", "webbloger_animation_fade_in_up");

		// Mouse Wheel 
		webbloger_skin_mousewheelScroll(".ta_mouse_wheel");

		// Parallax Images
		webbloger_skin_imageParallax(".blogger_coverbg_parallax.sc_blogger_item_with_image .featured_bg_wrapper .featured_bg");
		webbloger_skin_imageParallax(".blogger_coverbg_parallax .sc_blogger_item_with_image .featured_bg_wrapper .featured_bg");
		webbloger_skin_imageParallax(".blogger_coverbg_parallax.post_format_image .featured_bg_wrapper .featured_bg");
		webbloger_skin_imageParallax(".blogger_coverbg_parallax .post_format_image .featured_bg_wrapper .featured_bg");

		// Mailchimp
		webbloger_skin_mc4wp_ready();
		webbloger_skin_mc4wp_alert();
	});


	 
	/* Page Resize
	***************************/
	$document.on('action.resize_webbloger', function() {
		// Post blocks
		webbloger_skin_post_blocks_ready_resize();

		// Post header
		webbloger_skin_post_header_ready_resize_ajax();

		// Blog  
		webbloger_skin_blog_ready_resize();
	});



	/* Elementor Editor
	***************************/
	$window.on( 'elementor/frontend/init', function() {
		if ( typeof window.elementorFrontend !== 'undefined' && typeof window.elementorFrontend.hooks !== 'undefined' ) {
			// If Elementor is in the Editor's Preview mode
			if ( elementorFrontend.isEditMode() ) {
				// Init elements after creation
				elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $cont ) {			
					// Add icons wrapper for widget title
					webbloger_skin_widget_title_ready();

					// Elementor Widget Video ready				
					webbloger_skin_elementor_video_ready();

					// Mailchimp in the Editor's Preview mode
					webbloger_skin_mc4wp_ready();
					webbloger_skin_mc4wp_alert();
				} );
			}
		}
	});



	/* AJAX
	***************************/
	$document.on('action.got_ajax_response', function(event, params) {
		if (params['action'] == 'prev_post_loading') {

			var res_post_id = '';
			if ( params['result'] ) {
				var res =  jQuery( params['result'] );
				res_post_id = res.find('.content > article').attr('id');
				res_post_id = res_post_id.replace('post-', '');
			}

			jQuery.post(WEBBLOGER_STORAGE['ajax_url'], {
				action: 'webbloger_skin_prev_post_loading',
				nonce: WEBBLOGER_STORAGE['ajax_nonce'],
				post_id: res_post_id
			}, function(response) {
				if (response) {
					// Append kadence styles to head
					jQuery('head').append(response);

					// Post audio	
					webbloger_skin_post_audio_ready_ajax();

					// Post comments
					webbloger_skin_post_comments_ready_ajax();

					// MailChimp
					webbloger_skin_mailchimp_ready_ajax();
					webbloger_skin_mc4wp_ready();
					webbloger_skin_mc4wp_alert();

					// Post blocks
					webbloger_skin_post_blocks_ready_resize();

					// Post header
					webbloger_skin_post_header_ready_resize_ajax();

					// Call other functions
					$document.trigger('action.ajax_webbloger');

					// Recalculate blocks parameters
					$document.trigger('resize');
				}
			});
		}
	});
	


	/* Init hidden elements
	***************************/
	$document.on( 'action.init_hidden_elements', webbloger_skin_blog_init_hidden );



	// Animated item size
	function webbloger_skin_itemVarsFunction(item) {
		var itemVars = {
			height: item.outerHeight(),
			topPosition: item.offset().top,
			bottomPosition: item.offset().top + item.outerHeight()
		};
		return itemVars;
	}

	// Browser window size
	function webbloger_skin_windowVarsFunction() {
		var webWindow = $window;
		var windowVars = {
			height: webWindow.height(),
			topPosition: webWindow.scrollTop(),
			bottomPosition: webWindow.height() + webWindow.scrollTop()
		};
		return windowVars;
	}

	// Mouse weel animated element trigger
	function webbloger_skin_mousewheelScroll(item) {
		var animationElements = jQuery.find(item),
			webWindow = webbloger_skin_windowVarsFunction();

		jQuery.each(animationElements, function() {
			var element = jQuery(this),
				item = webbloger_skin_itemVarsFunction(jQuery(this));
			if( element.hasClass('under_position') && (item.bottomPosition < webWindow.topPosition) ) {
				element.removeClass('under_position');
				element.addClass('over_position');
			} else if ( element.hasClass('over_position') && (item.topPosition > webWindow.bottomPosition) ) {
				element.removeClass('over_position');
				element.addClass('under_position');
			}

			// Click trigger
			element.click(function() {
				if ( element.hasClass('under_position') && (item.bottomPosition >= webWindow.topPosition) && (item.topPosition <= webWindow.bottomPosition)) {					
					jQuery('html,body').stop().animate({
			        	scrollTop: webbloger_skin_scrollPosition(element, 'bottom') },
			        500, 'swing', function() {
			        	element.removeClass('under_position');
			        	setTimeout(function() {
					    	element.addClass('over_position');
					    }, 500);		
					});
				}
								 
				if ( element.hasClass('over_position') && (item.topPosition >= webWindow.topPosition) && (item.bottomPosition <= webWindow.bottomPosition)) {					
					jQuery('html,body').stop().animate({
			        	scrollTop: webbloger_skin_scrollPosition(element, 'top') },
			        500, 'swing', function() {						    	
					    element.removeClass('over_position');
					    setTimeout(function() {
					    	element.addClass('under_position');	
					    }, 500);						    	
				  	});					
				} 
			});	
		});
	}

	// Position of animated item (on page load)
	function webbloger_skin_mousewheelItemPosition(item) {
		var itemVars = webbloger_skin_itemVarsFunction(item),
			windowVars = webbloger_skin_windowVarsFunction(),
			position = '';
		if ((itemVars.topPosition < windowVars.topPosition) && ( itemVars.bottomPosition < windowVars.topPosition)) {
			position = 'over_position';
		} else if ((itemVars.topPosition > windowVars.bottomPosition) && ( itemVars.bottomPosition > windowVars.bottomPosition)) {
			position = 'under_position';
		}
		item.addClass(position);
	}

	// Position of animated item (on page load)
	function webbloger_skin_isVisibleOnLoad(item, className, type = '') {
		var animatedItem = jQuery.find(item);
		jQuery.each(animatedItem, function() {
			if ( jQuery(this).is(':hidden') ) return;	
			var element = jQuery(this),
				itemVars = webbloger_skin_itemVarsFunction(element),
				windowVars = webbloger_skin_windowVarsFunction();			 
			if ((itemVars.topPosition >= windowVars.topPosition) && (itemVars.bottomPosition <= windowVars.bottomPosition)) {	
				element.addClass(className);
			} 
		})
	}

	// Make sure the picture is visible
	function webbloger_skin_isVisible(item, className, type = '') {
		var animationElements = jQuery.find(item),
			webWindow = webbloger_skin_windowVarsFunction();
		jQuery.each(animationElements, function() {		
			if ( jQuery(this).is(':hidden') ) return;		
			var element = jQuery(this),
				item = webbloger_skin_itemVarsFunction(element);	
			if ( item.topPosition != 0 && item.bottomPosition != 0 && (item.bottomPosition >= webWindow.topPosition) && (item.topPosition <= webWindow.bottomPosition)) {
				element.addClass(className);
			} 
		});
	}

	// Function for image parallax by page scroll
	function webbloger_skin_imageParallax(item) {
	    var windowTopPos = $window.scrollTop();
	   	if(windowTopPos > 1) {		    	
	    	jQuery(item).each(function(){
	    		var itemParallax = jQuery(this);
	    		var itemParallaxOff = itemParallax.hasClass('background_parallax_off');
	    		var itemTopPos = itemParallax.offset().top;
	    		var itembottomPosition = itemParallax.offset().top + itemParallax.outerHeight();
	    		var itemNewPos = parseInt((windowTopPos - itemTopPos)/12);
	    		var itemOpacity = parseInt(100 - itemNewPos);

	    		itemParallax.addClass('background_parallax');

	    		if(windowTopPos >= itembottomPosition) {
	    			itemParallax.addClass('background_parallax_off');
	    		} else if(windowTopPos <= itemTopPos){
	    			itemParallax.removeClass('background_parallax_off');
	    		}
		    	if(windowTopPos >= itemTopPos && !itemParallaxOff) {
		    		if(itemNewPos <= 50 && itemNewPos > 0) {
		    			jQuery(this).css({
		    				'background-position':'center ' + itemNewPos +'px',
		    				'opacity': '0.'+ itemOpacity
		    			}); 
		    		}					
		    	} else {
			    	jQuery(item).each(function(){
			    		jQuery(this).css({
		    				'background-position':'center 0',
		    				'opacity': '1'
		    			}); 
			    	});
			    }
	    	});
	    } else {
	    	jQuery(item).each(function(){
	    		jQuery(this).css({
    				'background-position':'center 0',
    				'opacity': '1'
    			});  
	    	});
		}
	}

	// Scroll To	
	function webbloger_skin_scrollPosition(item, itemSibling) {
		var sibl,
			scroll,
			parentTop,
			siblTop,
			fixedRowsHeight,
			htmltagAttrStyleArr,
			htmltagAttrStyle = jQuery('html').attr('style'),
			parent = item.parents('section.elementor-element:not(.elementor-inner-section)'),
			siblName = 'section.elementor-element';
		
		if (htmltagAttrStyle.length > 0) {
			htmltagAttrStyleArr = htmltagAttrStyle.split(';')
			for (var i = 0; i < htmltagAttrStyleArr.length; i++) {
			  	if (htmltagAttrStyleArr[i].includes('--fixed-rows-height:')) {
			  		fixedRowsHeight = htmltagAttrStyleArr[i].replace('--fixed-rows-height:','').replace('px','');
			  	}
			}
		}

		if(itemSibling == 'top' ) {
			parentTop = parent.offset().top.toString();
			scroll = parentTop - fixedRowsHeight;	
			return scroll;
		} else if (itemSibling == 'bottom') {
			sibl = parent.next(siblName);
			if(sibl.attr('class') === undefined){
				return webWindow.bottomPosition;
			} else {
				var siblTop = sibl.offset().top.toString();
				scroll = siblTop - fixedRowsHeight;
				return scroll;
			}	
		}					
	}



	// Color switcher init
	function webbloger_skin_color_switcher_ready() {
		if ( jQuery('#color_scheme_switcher').length > 0 ) {
			// Change color scheme after page load
			var site_color_scheme = webbloger_get_cookie('webbloger_color_scheme');
			if ( site_color_scheme != null ) {		
				webbloger_skin_remove_color_scheme_class();
				jQuery('body').addClass('scheme_' + site_color_scheme);
				jQuery('#color_scheme_switcher li[data-value="' + site_color_scheme + '"]').addClass('selected');
				webbloger_skin_invert_logo_colors(site_color_scheme);
				setTimeout(function(){
					jQuery('body').removeClass('bg_white');
				}, 1000);
			}	

			// Open color schemes
			jQuery('#color_scheme_switcher').on('click', function(){
				jQuery(this).toggleClass('opened');
			});

			// Change color scheme on the button click
			jQuery('#color_scheme_switcher li').on('click', function() {
				jQuery('body').removeClass('bg_white');
				var val = jQuery(this).attr('data-value');
				webbloger_skin_remove_color_scheme_class();
				jQuery('body').addClass('scheme_' + val);
				jQuery('#color_scheme_switcher').removeClass('opened');
				webbloger_set_cookie( 'webbloger_color_scheme', val, { expires: 365, path: '/' } );
				webbloger_skin_invert_logo_colors(val);
			});
		}
	}

	// Remove body color scheme class
	function webbloger_skin_remove_color_scheme_class() {
		jQuery('#color_scheme_switcher li').each(function(){
			var val = jQuery(this).attr('data-value');
			jQuery('body').removeClass('scheme_' + val);
		});
	}

	// Invert logo colors
	function webbloger_skin_invert_logo_colors(site_color_scheme) {
		if ( jQuery('#color_scheme_switcher').hasClass('invert') ) {
			if ( site_color_scheme == 'dark') {
				jQuery('body.scheme_dark').find('header:not([class*="scheme_"]), .menu_mobile:not([class*="scheme_"]), footer:not([class*="scheme_"]), #trx_addons_login_popup').find('.logo_image, .sc_layouts_logo').addClass('invert');
			} else {
				jQuery('body.scheme_dark').find('header:not([class*="scheme_"]), .menu_mobile:not([class*="scheme_"]), footer:not([class*="scheme_"]), #trx_addons_login_popup').find('.logo_image, .sc_layouts_logo').removeClass('invert');
			}
		}
	}

	// Post navigation ready
	function webbloger_skin_post_nav_links_ready() {
		// Duplicate post navigation		
		if ( jQuery('.nav-links-single').length > 0 ) { 
			jQuery('.nav-links-single.nav-links-fixed:not(.inited)').addClass('inited').each(function() {
				var links = jQuery(this);
				var clone = links.clone().removeClass('nav-links-fixed nav-links-with-thumbs');
				clone.insertAfter(links);
				links.find('.nav-arrow-label').each(function() {
					var i = jQuery(this);
					i.insertBefore(i.parent());
				});
			});
		}
	}

	// Post comments ready
	function webbloger_skin_post_comments_ready_ajax() {
		if ( jQuery('.comments_wrap').length > 0 ) { 
			// Add lines to parents
			jQuery('.comments_wrap:not(.inited)').addClass('inited').each(function() {
				var wrap = jQuery(this);
				var button = wrap.find('.form-submit input[type="submit"]').removeAttr('type').removeAttr('name');
				var val = button.val();
				button.replaceWith(jQuery('<button class="sc_button sc_button_default sc_button_size_large sc_button_with_icon sc_button_icon_right hover_style_icon_1 color_style_1"><span class="sc_button_icon"><span class="icon-comment-1"></span></span><span class="sc_button_text"><span class="sc_button_title">' + val + '</span></span></button>'));
				wrap.find('.comments_list_wrap ul > li > ul').each(function() {
					jQuery(this).parent().addClass('has-children');
				});
			});

			// Show/Hide Comments
			jQuery('.show_comments_button:not(.inited)').addClass('inited').on('click', function(e) {
				var bt = jQuery(this);
				if (bt.attr('href') == '#') {
					var comments_wrap = bt.parent().find('+ .comments_wrap');
					bt.toggleClass('opened').text(bt.data(bt.hasClass('opened') ? 'hide' : 'show'));
					comments_wrap.slideToggle(function() {
						comments_wrap.toggleClass('opened');
					});
					e.preventDefault();
					return false;
				}
			});
		}
	}

	// Post blocks ready
	function webbloger_skin_post_blocks_ready_resize() {
		if ( jQuery('[class*="is-style-align"][class*="is-style-size"]').length > 0 ) {
			if ( $window.width() < 1680 ) {
				jQuery('[class*="is-style-align"][class*="is-style-size"] + .trx_addons_reviews_block').each(function(){
					jQuery(this).prev().addClass('responsive_view');
				});
			} else {
				jQuery('[class*="is-style-align"][class*="is-style-size"] + .trx_addons_reviews_block').each(function(){
					jQuery(this).prev().removeClass('responsive_view');
				});
			}
		}
	}	

	// Post audio
	function webbloger_skin_post_audio_ready_ajax() {
		jQuery('.post_header_wrap_in_header .post_featured.with_audio.with_thumb:not(.audio_inited)').each(function() {
			var featured = jQuery(this);
			if ( featured.find('.mejs-container').length > 0 ) {
				featured.addClass('audio_inited');
				var audio_wrap = featured.find('.post_audio');
				var audio = audio_wrap.find('audio')[0];
				var btn = jQuery('<div class="post_audio_btn"></div>');
				var header = featured.find(' + .post_header');
				if ( header.length == 0 ) {
					header = featured;
				}
				header.prepend(btn);
				audio_wrap.hide();
				btn.on('click', function() {
					audio_wrap.slideToggle(function(){
						audio_wrap.find('.mejs-playpause-button').click();
			        });
				});				
			} else {
				setTimeout(function(){
					webbloger_skin_post_audio_ready_ajax();
				}, 1000);
			}
		});
	}
	
	// Post header
	function webbloger_skin_post_header_ready_resize_ajax() {
		var header = jQuery('.post_header_wrap_style_style-1.with_featured_image,\
							 .post_header_wrap_style_style-2.with_featured_image,\
							 .post_header_wrap_style_style-3.with_featured_image');

		if ( jQuery(header).find('.post_featured.with_gallery').length > 0 ) {
			return;
		}

		header.find('.post_featured').css('min-height', 0); 
		header.each(function() {
			var self = jQuery(this);
			var image_h = self.find('.post_featured').outerHeight();
			var info_h = self.find('.post_header').outerHeight();			
			var x = 140;
			if ( jQuery('body').hasClass('mobile_layout') ) {
				x = 80;
			}
			
			info_h = info_h + x; 
			if ( info_h >= image_h ) {
				self.find('.post_featured').css('min-height', info_h);
			}
		});
	}	

	// Blog  
	function webbloger_skin_blog_ready_resize() {
  	  	// Blog - Band
		jQuery('.post_layout_band .slider_container').each(function() {
			if ( $window.width() <= 600 ) {
				jQuery(this).data('ratio', '16:9');
			} else {
				jQuery(this).data('ratio', '1:1');
			}
		});  	  	
	}

	// Add icons wrapper for widget title
	function webbloger_skin_widget_title_ready() {
		jQuery('.content .widget:not(.wp-widget-powerkit_widget_author) .widget_title:not(.inited), \
			.content .widget:not(.wp-widget-powerkit_widget_author) .widgettitle:not(.inited), \
			.sidebar .widget .widget_title:not(.inited), \
			.sidebar .widget .widgettitle:not(.inited), \
			.elementor-sidebar .widget .widget_title:not(.inited):not(.inited), \
			.elementor-sidebar .widget .widgettitle:not(.inited), \
			.elementor-sidebar .sc_item_title:not(.inited), \
			.footer_wrap .widget_recent_posts .sc_recent_posts_title_type_classic .widget_title:not(.inited), \
			.footer_wrap .widget_recent_posts .sc_recent_posts_title_type_classic .widgettitle:not(.inited), \
			.footer_wrap .widget_categories_list .widget_title:not(.inited), \
			.footer_wrap .widget_categories_list .widgettitle:not(.inited), \
			.footer_wrap .sc_widget_aboutme .widget_title:not(.inited), \
			.footer_wrap .sc_widget_aboutme .widgettitle:not(.inited), \
			.footer_wrap .wp-widget-search .widget_title:not(.inited), \
			.footer_wrap .wp-widget-search .widgettitle:not(.inited) ').each(function(){
			var self = jQuery(this).addClass('inited');
			var title = self.html();
			var titleWithIcons = title + "<span class="+'"widgettitle_icons_wrapper"'+"><span></span><span></span><span></span></span>";
			self.html(titleWithIcons);
		});
	}

	// Magnific Popup
	function webbloger_skin_magnific_ready() {
		jQuery('.video_hover.trx_addons_popup_link').on('mfpOpen', function() {
			var x = jQuery('html').attr('style');
			if ( x ) {
				x = x.replace('overflow: hidden', 'overflow: hidden !important');
			}
			jQuery('html').attr('style', x);
		});
	}

	// MailChimp
	function webbloger_skin_mailchimp_ready_ajax() {		
		if ( jQuery('.yikes-easy-mc-form').length > 0 ) { 
			jQuery('.yikes-easy-mc-form:not(.inited)').addClass('inited').each(function() {
				var form = jQuery(this);
				var checkbox = form.find('.yikes-mailchimp-eu-compliance-label');
				form.find('.yikes-easy-mc-submit-button').after(checkbox);				
			});
		}
	}

	function webbloger_skin_mc4wp_ready() {		
		if ( jQuery('.mc4wp-form').length > 0 ) { 
			jQuery('.mc4wp-form:not(.inited)').each(function() {
				var form = jQuery(this);
				var formId = form.attr('id');
				var formButton = form.find('button');
				var formLabel = form.find('label');
				var formCheckbox = form.find('input[type="checkbox"]');
				var formLabelIdRandom = Math.floor((Math.random() * 100) + 1) * Math.floor((Math.random() * 100) + 1);

				form.addClass('inited');
				formCheckbox.attr('id', formId + '_form' + formLabelIdRandom);
				formLabel.attr('for', formId + '_form' + formLabelIdRandom);
				

				if ( formId === 'style-1' ) {
					formButton.removeClass('sc_button_simple sc_button_icon_left').addClass('sc_button_icon_right hover_style_icon_1');
				}
				if ( formId === 'style-6' ) {
					formButton.removeClass('sc_button_simple').addClass('hover_style_1');
				}
			});
		}
	}

	function webbloger_skin_mc4wp_alert(form) {
		var formValue = form;
		if ( formValue === undefined || formValue === '' ) {
			formValue = jQuery(".mc4wp-form:not(.inited_validation)")
		} 

		jQuery(formValue).each(function () {

			var form = jQuery(this),
				btn = form.find('button, input[type="submit"], input[type="button"]');
			var $i_agree = form.find('input[type="checkbox"][name="i_agree_privacy_policy"]:not(.inited_alert)'
				+ ',input[type="checkbox"][name="gdpr_terms"]:not(.inited_alert)'
				+ ',input[type="checkbox"][name="wpgdprc"]:not(.inited_alert)'
				+ ',input[type="checkbox"][name="AGREE_TO_TERMS"]:not(.inited_alert)'
			);
			form.addClass('inited_validation');

			if ( $i_agree.length > 0 ) {				
				$i_agree.addClass( 'inited_alert' );
			}

			btn.on( 'click', function(e) {
				form.find('.trx_addons_message_box').remove();

				if ( $i_agree.length > 0 ) {
					
					if ( ! $i_agree.get(0).checked ) {
						form.append( '<div class="trx_addons_message_box trx_addons_message_box_error">' + WEBBLOGER_STORAGE['msg_i_agree_error'] + '</div>' );
						var error_msg = form.find('.trx_addons_message_box');
						error_msg.fadeIn(600);
						setTimeout( function() {
							error_msg.fadeOut( 600, function() {error_msg = form.find('.trx_addons_message_box');
								error_msg.remove();
							} );
						}, 3000 );

						e.preventDefault();
						return false;
					}
				}

				var rez = webbloger_form_validate(form, {
					error_message_show: true,
					error_message_time: 3000,
					error_message_class: 'trx_addons_message_box trx_addons_message_box_error',
					error_message_text: 'Global error text',
					error_fields_class: 'mc4wp_error_field',
					exit_after_first_error: true,
					rules: [
						{
							field: 'EMAIL',
							min_length: {value: 7, message: WEBBLOGER_STORAGE['mc4wp_msg_email_min']},
							max_length: {value: 60, message: WEBBLOGER_STORAGE['mc4wp_msg_email_max']},
							mask: {
								value: '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-zA-Z0-9_\\-]+(\\.[a-zA-Z0-9_\\-]+)*\\.[a-zA-Z]{2,6}$',
								message: 'Invalid email address'
							}
						},
					]
				});

				if (!rez) {
					jQuery(form).submit();
				}
				else {
					e.preventDefault();
					return rez;
				}

			});
		});
	}

	// Powerkit
	function webbloger_skin_powerkit_ready() {
		// Output only user name "Widget: Author (PowerKit)" 		
		if ( jQuery('.pk-widget-author').length > 0 ) { 
			jQuery('.pk-widget-author:not(.inited)').each(function() {
				var self = jQuery(this).addClass('inited'),
					authorTitle = self.find('.pk-author-title a'),
				    fullName = authorTitle.text(),
				    parsedName = fullName.split(' ');

			    authorTitle.html(parsedName[0]);
			});
		}
	}

	// Elementor Widget Video ready
	function webbloger_skin_elementor_video_ready() {
		if ( jQuery('.elementor-video').length > 0 ) { 
			var elemenor_video = jQuery( '.elementor-video[controls]' );
			if ( elemenor_video.length == 0 ){
				jQuery( '.elementor-video' ).attr( 'nocontrols', '' );
			};
		}
	}

	// Elementor Widget Counter ready
	function webbloger_skin_elementor_counter_ready() {
		if ( jQuery('.elementor-counter').length > 0 ) { 
			// Counter align extending from column align
			jQuery('.elementor-counter .elementor-counter-number-wrapper').each(function() {
			    var counter = jQuery(this),
			    	counterParentJC = counter.parents('.sc_layouts_column').css('justify-content'),
			    	counterParentTA = counter.parents('.sc_layouts_column').css('text-align');
			    counter.css('justify-content', counterParentJC).siblings('.elementor-counter-title').css('text-align', counterParentTA);
			});
		}
	}



	// Infinite scroll in the single posts
	function webbloger_skin_infinite_scroll_single_posts_resize() {
		var single_post_scrollers  = jQuery( '.nav-links-single-scroll' );
		if ( single_post_scrollers.length === 0 ) {
			return;
		}

		var cur_page_id = WEBBLOGER_STORAGE['cur_page_id'],
			cur_page_link  = WEBBLOGER_STORAGE['cur_page_url'];

		single_post_scrollers.each( function() {
			var inf  = jQuery(this),
				link = inf.data('post-link'),
				off  = inf.offset().top,
				st   = $window.scrollTop(),
				wh   = $window.height();
			
			// Change location url
			if (inf.hasClass('nav-links-single-scroll-loaded')) {
				if (link && off < st + wh / 2) {
					cur_page_id = inf.data('post-prev-id');
				}				
			} 				
		} );

		// Infinite scroll in the single posts - Update post meta and share
		if (cur_page_link != location.href) {
			jQuery( '.sc_layouts_meta .post_meta_item' ).each(function() {
				var meta = jQuery(this);
				var meta_class = meta.attr('class'); 
				var meta_type = meta_class.split(' ');
				if ( meta_type.length > 1 ) {
					if ( meta_type[1] == 'post_share' ) {					
						var socials = jQuery( 'article#post-' + cur_page_id + ' .post_share .social_items:first');
						if ( socials.length > 0 ) {
							meta.find('.social_item').each(function() {
								var x =  socials.find('.social_item[data-count="' + jQuery(this).data('count') + '"]').attr('href');
								jQuery(this).attr('href', x).data('link', x);
							})
						}
					} else {
						var meta_clone = jQuery( 'article#post-' + cur_page_id + ' .post_header_wrap .' + meta_type[1] ).clone();
						if ( meta_clone.length > 0 ) {
							meta.replaceWith(meta_clone);
						}								
					}
				} 
			});
		}
	}

	

	// Blog  
	function webbloger_skin_blog_init_hidden() {
		// Blog - Portfolio
		jQuery('.portfolio-masonry_wrap:not(.inited)').addClass( 'inited' ).each(function() {
			var masonry_wrap = jQuery( this );
			webbloger_when_images_loaded( masonry_wrap, function() {
				setTimeout( function() {
					masonry_wrap.find('.post_layout_portfolio').each(function() {
						var item = jQuery(this);
						var item_h = item.height();
						var info_h = item.find('.post_info').outerHeight();
						var formats = item.hasClass('post_format_audio') || item.hasClass('post_format_gallery') || item.hasClass('post_format_video');
						if ( formats ) {
							info_h += 82;
						}
						if ( info_h >= item_h ) {
							item.addClass('resize').find('.post_featured').css({'height': Math.floor(info_h) + 'px'});				
						} 
					});
					$document.trigger( 'action.init_hidden_elements', [masonry_wrap.parent()] );
				}, webbloger_apply_filters( 'webbloger_filter_masonry_init', 10 ) );
			});			
		}); 	  	
	}
})(); 
