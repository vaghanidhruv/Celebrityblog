<?php
/* Powerkit support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_skin_powerkit_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_skin_powerkit_theme_setup9', 9 );
    function webbloger_skin_powerkit_theme_setup9() {
        if ( webbloger_exists_powerkit() ) {
            add_action( 'wp_enqueue_scripts', 'webbloger_powerkit_frontend_scripts', 1100 );
            add_filter( 'webbloger_filter_merge_styles', 'webbloger_powerkit_merge_styles' );
        }
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'webbloger_exists_powerkit_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'webbloger_exists_powerkit_importer_set_options' );
    function webbloger_exists_powerkit_importer_set_options($options=array()) {   
        if ( webbloger_exists_powerkit() && in_array('accelerated-mobile-pages', $options['required_plugins']) ) {
            $options['additional_options'][]    = 'powerkit_%';                   
        }
        return $options;
    }
}

// Video cover image size
if ( ! function_exists( 'webbloger_powerkit_social_links_color_schemes' ) ) {
    add_filter( 'powerkit_social_links_color_schemes', 'webbloger_powerkit_social_links_color_schemes' );
    function webbloger_powerkit_social_links_color_schemes($schemes) {    
        $schemes = array(
            'default'         => array(
                'name' => esc_html__('Default', 'webbloger')
            ),
            'rounded'         => array(
                'name' => esc_html__('Rounded', 'webbloger')
            ),
            'rounded_border'         => array(
                'name' => esc_html__('Rounded with border', 'webbloger')
            ),
            'square'         => array(
                'name' => esc_html__('Square', 'webbloger')
            ),
            'square_border'         => array(
                'name' => esc_html__('Square with border', 'webbloger')
            ),
        );
        return $schemes;
    }
}

// Twitter avatar
if ( ! function_exists( 'webbloger_powerkit_lazy_process_images' ) ) {
    add_filter( 'powerkit_lazy_process_images', 'webbloger_powerkit_lazy_process_images', 20 );
    function webbloger_powerkit_lazy_process_images($image_avatar) {  
        $image_avatar = str_replace('_normal', '', $image_avatar);
        return $image_avatar;
    }
}


// Change thumb size for Author Widget (Powerkit)
if ( ! function_exists( 'webbloger_powerkit_widget_author_avatar_size' ) ) {
    add_filter( 'powerkit_widget_author_avatar_size', 'webbloger_powerkit_widget_author_avatar_size');
    function webbloger_powerkit_widget_author_avatar_size() {
        return '410';
    }
}

// Change title tag for Author Widget (Powerkit)
if ( ! function_exists( 'webbloger_powerkit_widget_author_title_tag' ) ) {
    add_filter( 'powerkit_widget_author_title_tag', 'webbloger_powerkit_widget_author_title_tag');
    function webbloger_powerkit_widget_author_title_tag() {
        return 'h4';
    }
}

// Enqueue custom scripts
if ( ! function_exists( 'webbloger_powerkit_frontend_scripts' ) ) {
    //Handler of the add_action( 'wp_enqueue_scripts', 'webbloger_powerkit_frontend_scripts', 1100 );
    function webbloger_powerkit_frontend_scripts( $force = false ) {
        static $loaded = false;
        if ( ! $loaded ) {
            $loaded = true;
            $webbloger_url = webbloger_get_file_url( 'plugins/powerkit/powerkit.css' );
            if ( '' != $webbloger_url ) {
                wp_enqueue_style( 'webbloger-powerkit', $webbloger_url, array(), null );
            }
        }
    }
}

// Merge custom styles
if ( ! function_exists( 'webbloger_powerkit_merge_styles' ) ) {
    add_filter('webbloger_filter_merge_styles', 'webbloger_powerkit_merge_styles');
    function webbloger_powerkit_merge_styles( $list ) {
        $list[] = 'plugins/powerkit/powerkit.css';
        return $list;
    }
}