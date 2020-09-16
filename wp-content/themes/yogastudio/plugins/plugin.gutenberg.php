<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yogastudio_gutenberg_theme_setup')) {
    add_action( 'yogastudio_action_before_init_theme', 'yogastudio_gutenberg_theme_setup', 1 );
    function yogastudio_gutenberg_theme_setup() {
        if (is_admin()) {
            add_filter( 'yogastudio_filter_required_plugins', 'yogastudio_gutenberg_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'yogastudio_exists_gutenberg' ) ) {
    function yogastudio_exists_gutenberg() {
        return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yogastudio_gutenberg_required_plugins' ) ) {
    //Handler of add_filter('yogastudio_filter_required_plugins',    'yogastudio_gutenberg_required_plugins');
    function yogastudio_gutenberg_required_plugins($list=array()) {
        if (in_array('gutenberg', (array)yogastudio_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Gutenberg', 'yogastudio'),
                'slug'         => 'gutenberg',
                'required'     => false
            );
        return $list;
    }
}