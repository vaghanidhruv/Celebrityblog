<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'webbloger_skin_gutenberg_blocks_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'webbloger_skin_gutenberg_blocks_theme_setup9', 9 );
    function webbloger_skin_gutenberg_blocks_theme_setup9() {        
        if ( webbloger_is_off( webbloger_get_theme_option( 'debug_mode' ) ) ) {
            remove_action( 'webbloger_filter_merge_styles', 'webbloger_skin_gutenberg_merge_styles' );
            remove_action( 'webbloger_filter_merge_styles', 'webbloger_gutenberg_merge_styles' );
        }
    }
}

// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'webbloger_skin_gutenberg_editor_scripts' ) ) {
    add_action( 'enqueue_block_editor_assets', 'webbloger_skin_gutenberg_editor_scripts');
    function webbloger_skin_gutenberg_editor_scripts() {
        // Editor styles 
        wp_enqueue_style( 'webbloger-gutenberg', webbloger_get_file_url( webbloger_skins_get_current_skin_dir() . 'plugins/gutenberg/gutenberg.css' ), array(), null );
    }
}