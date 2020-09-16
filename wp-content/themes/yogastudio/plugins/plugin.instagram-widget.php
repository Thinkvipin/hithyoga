<?php
/* Instagram Widget support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yogastudio_instagram_widget_theme_setup')) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_instagram_widget_theme_setup', 1 );
	function yogastudio_instagram_widget_theme_setup() {
		if (yogastudio_exists_instagram_widget()) {
			add_action( 'yogastudio_action_add_styles', 						'yogastudio_instagram_widget_frontend_scripts' );
		}
		if (is_admin()) {
			add_filter( 'yogastudio_filter_importer_required_plugins',		'yogastudio_instagram_widget_importer_required_plugins', 10, 2 );
			add_filter( 'yogastudio_filter_required_plugins',					'yogastudio_instagram_widget_required_plugins' );
		}
	}
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'yogastudio_exists_instagram_widget' ) ) {
	function yogastudio_exists_instagram_widget() {
		return function_exists('wpiw_init');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yogastudio_instagram_widget_required_plugins' ) ) {
	//Handler of add_filter('yogastudio_filter_required_plugins',	'yogastudio_instagram_widget_required_plugins');
	function yogastudio_instagram_widget_required_plugins($list=array()) {
		if (in_array('instagram_widget', yogastudio_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('Instagram Widget', 'yogastudio'),
					'slug' 		=> 'wp-instagram-widget',
					'required' 	=> false
				);
		return $list;
	}
}

// Enqueue custom styles
if ( !function_exists( 'yogastudio_instagram_widget_frontend_scripts' ) ) {
	//Handler of add_action( 'yogastudio_action_add_styles', 'yogastudio_instagram_widget_frontend_scripts' );
	function yogastudio_instagram_widget_frontend_scripts() {
		if (file_exists(yogastudio_get_file_dir('css/plugin.instagram-widget.css')))
			wp_enqueue_style( 'yogastudio-plugin.instagram-widget-style',  yogastudio_get_file_url('css/plugin.instagram-widget.css'), array(), null );
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check Instagram Widget in the required plugins
if ( !function_exists( 'yogastudio_instagram_widget_importer_required_plugins' ) ) {
	//Handler of add_filter( 'yogastudio_filter_importer_required_plugins',	'yogastudio_instagram_widget_importer_required_plugins', 10, 2 );
	function yogastudio_instagram_widget_importer_required_plugins($not_installed='', $list='') {
		if (yogastudio_strpos($list, 'instagram_widget')!==false && !yogastudio_exists_instagram_widget() )
			$not_installed .= '<br>' . esc_html__('WP Instagram Widget', 'yogastudio');
		return $not_installed;
	}
}
?>