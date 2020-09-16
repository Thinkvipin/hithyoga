<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yogastudio_gdpr_compliance_theme_setup')) {
    add_action( 'yogastudio_action_before_init_theme', 'yogastudio_gdpr_compliance_theme_setup', 1 );
    function yogastudio_gdpr_compliance_theme_setup() {
        if (is_admin()) {
            add_filter( 'yogastudio_filter_required_plugins', 'yogastudio_gdpr_compliance_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'yogastudio_exists_gdpr_compliance' ) ) {
    function yogastudio_exists_gdpr_compliance() {
        return defined( 'WP_GDPR_C_SLUG' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'yogastudio_gdpr_compliance_required_plugins' ) ) {
    //Handler of add_filter('yogastudio_filter_required_plugins',    'yogastudio_gdpr_compliance_required_plugins');
    function yogastudio_gdpr_compliance_required_plugins($list=array()) {
        if (in_array('gdpr-compliance', (array)yogastudio_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('WP GDPR Compliance', 'yogastudio'),
                'slug'         => 'wp-gdpr-compliance',
                'required'     => false
            );
        return $list;
    }
}