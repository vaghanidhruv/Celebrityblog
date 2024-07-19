<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_accelerated_mobile_pages_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_accelerated_mobile_pages_theme_setup9', 9 );
    function webbloger_accelerated_mobile_pages_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'webbloger_filter_tgmpa_required_plugins', 'webbloger_accelerated_mobile_pages_tgmpa_required_plugins' );
        }
    }
}

// Disable mobile redirection
if ( ! function_exists( 'webbloger_accelerated_mobile_pages_parse_query' ) ) {
    add_action( 'parse_query', 'webbloger_accelerated_mobile_pages_parse_query' );
    function webbloger_accelerated_mobile_pages_parse_query() {
        if ( webbloger_exists_accelerated_mobile_pages() ) {
            remove_action('wp_head', 'ampforwp_mobile_redirection_js');
        }
    }
}

// Add theme specified classes to the body
if ( ! function_exists( 'webbloger_accelerated_mobile_pages_body_classes' ) ) {
    add_filter( 'ampforwp_body_class', 'webbloger_accelerated_mobile_pages_body_classes', 10, 2 );
    function webbloger_accelerated_mobile_pages_body_classes( $classes, $class ) {        
        if ( webbloger_exists_accelerated_mobile_pages() && webbloger_is_amp() && class_exists('AMPforWP_Mobile_Detect') ) {
            $mobile_detect = new AMPforWP_Mobile_Detect;
            if ( $mobile_detect->isMobile() ) { 
                if ( $mobile_detect->is('iOS') && $mobile_detect->version('iPhone', $mobile_detect::VERSION_TYPE_FLOAT) < 16 ) {
                    $classes[] = 'iphone6';
                }
            }
        }
        return $classes;
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'webbloger_accelerated_mobile_pages_tgmpa_required_plugins' ) ) {    
    function webbloger_accelerated_mobile_pages_tgmpa_required_plugins( $list = array() ) {
        if ( webbloger_storage_isset( 'required_plugins', 'accelerated-mobile-pages' ) && webbloger_storage_get_array( 'required_plugins', 'accelerated-mobile-pages', 'install' ) !== false ) {
            $list[] = array(
                'name'     => webbloger_storage_get_array( 'required_plugins', 'accelerated-mobile-pages', 'title' ),
                'slug'     => 'accelerated-mobile-pages',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'webbloger_exists_accelerated_mobile_pages' ) ) {
    function webbloger_exists_accelerated_mobile_pages() {
        return function_exists( 'ampforwp_add_custom_rewrite_rules' );
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'webbloger_exists_accelerated_mobile_pages_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'webbloger_exists_accelerated_mobile_pages_importer_set_options' );
    function webbloger_exists_accelerated_mobile_pages_importer_set_options($options=array()) {   
        if ( webbloger_exists_accelerated_mobile_pages() && in_array('accelerated-mobile-pages', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'redux_builder_amp';                   
        }
        return $options;
    }
}

// Detect if current page is amp
if ( ! function_exists( 'webbloger_is_amp' ) ) {
    function webbloger_is_amp() {
        return function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ? true : false;
    }
}

// AMP styles 
if ( ! function_exists( 'webbloger_ampforwp_add_custom_css' ) ) {
    add_action('amp_post_template_css','webbloger_ampforwp_add_custom_css', 11);
    function webbloger_ampforwp_add_custom_css() {
        if ( !ampforwp_get_setting('ampforwp_css_tree_shaking') ) {
            $css = webbloger_fgc( webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/accelerated-mobile-pages/accelerated-mobile-pages.css' ) );
            if ( '' != $css ) {
                echo trim($css);
            }
            if ( is_rtl() ) {
                $css = webbloger_fgc( webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/accelerated-mobile-pages/accelerated-mobile-pages-rtl.css' ) );            
                if ( '' != $css ) {
                    echo trim($css);
                }
            }
        }
    }
}

// Optimize CSS styles
if ( ! function_exists( 'webbloger_ampforwp_the_content_last_filter' ) ) {
    add_filter('ampforwp_the_content_last_filter','webbloger_ampforwp_the_content_last_filter', 12);
    function webbloger_ampforwp_the_content_last_filter($content) {
        if ( ampforwp_get_setting('ampforwp_css_tree_shaking') ) {
            $css = webbloger_fgc( webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/accelerated-mobile-pages/accelerated-mobile-pages.css' ) );        
            if ( is_rtl() ) {
                $css .= webbloger_fgc( webbloger_get_file_dir( webbloger_skins_get_current_skin_dir() . 'plugins/accelerated-mobile-pages/accelerated-mobile-pages-rtl.css' ) );     
            }
            $css = webbloger_ampforwp_minify_css($css);

            if ( preg_match('/(<style\samp-custom>(.*?)<\/style>)|(<style\samp-custom>(.*?)<\/style>)|(<style\samp-custom>.*<\/style>)/s', $content, $matches) ) {
                $amp_css = $matches[1];
                $amp_css = preg_replace('/<\/style>/', '', $amp_css);
                $amp_css .= $css . '</style>';
                $content = preg_replace("/(<style\samp-custom>(.*?)<\/style>)|(<style\samp-custom>(.*?)<\/style>)|(<style\samp-custom>.*<\/style>)/", $amp_css, $content );
            }
        }
        return $content;
    }
}

// Minify CSS styles
if ( ! function_exists( 'webbloger_ampforwp_minify_css' ) ) {
    function webbloger_ampforwp_minify_css($css) {
        $css = trim(preg_replace('/(\s+)/', ' ', $css));
        //$css = preg_replace('/(, .)/', ',.', $css);
        $css = preg_replace('/(: )/', ':', $css);
        $css = preg_replace('/(; )/', ';', $css);
        $css = preg_replace('/(\{ )/', '{', $css);
        $css = preg_replace('/( \{)/', '{', $css);
        $css = preg_replace('/( \})/', '}', $css);
        $css = preg_replace('/(\} )/', '}', $css);
        $css = preg_replace('/( > )/', '>', $css);
        $css = preg_replace('/(\/\*.+?\*\/)|(@charset "UTF-8";)/', '', $css);
        $css = preg_replace('/([;]-webkit-.*?;)|([;]-ms-.*?;)|([;]-o-.*?;)|([;]-moz-.*?;)/', ';', $css);
        return $css;
    }
}

