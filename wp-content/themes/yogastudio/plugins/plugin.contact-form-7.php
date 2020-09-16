<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yogastudio_cf7_theme_setup')) {
    add_action( 'yogastudio_action_before_init_theme', 'yogastudio_cf7_theme_setup', 1 );
    function yogastudio_cf7_theme_setup() {
        if (is_admin()) {
            add_filter( 'yogastudio_filter_required_plugins', 'yogastudio_cf7_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yogastudio_cf7_required_plugins' ) ) {
    function yogastudio_cf7_required_plugins($list=array()) {
        if (in_array('contact-form-7', (array)yogastudio_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Contact Form 7', 'yogastudio'),
                'slug'         => 'contact-form-7',
                'required'     => false
            );
        return $list;
    }
}


// Check if cf7 installed and activated
if ( !function_exists( 'yogastudio_exists_cf7' ) ) {
	function trueman_exists_cf7() {
		return class_exists('WPCF7');
	}
}
?>