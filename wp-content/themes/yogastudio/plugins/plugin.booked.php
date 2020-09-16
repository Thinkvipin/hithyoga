<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('yogastudio_booked_theme_setup')) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_booked_theme_setup', 1 );
	function yogastudio_booked_theme_setup() {
		// Register shortcode in the shortcodes list
		if (yogastudio_exists_booked()) {
			add_action('yogastudio_action_add_styles', 					'yogastudio_booked_frontend_scripts');
			add_action('yogastudio_action_shortcodes_list',				'yogastudio_booked_reg_shortcodes');
			if (function_exists('yogastudio_exists_visual_composer') && yogastudio_exists_visual_composer())
				add_action('yogastudio_action_shortcodes_list_vc',		'yogastudio_booked_reg_shortcodes_vc');
			if (is_admin()) {
				add_filter( 'yogastudio_filter_importer_options',			'yogastudio_booked_importer_set_options' );
				add_filter( 'yogastudio_filter_importer_import_row',		'yogastudio_booked_importer_check_row', 9, 4);
			}
		}
		if (is_admin()) {
			add_filter( 'yogastudio_filter_importer_required_plugins',	'yogastudio_booked_importer_required_plugins', 10, 2);
			add_filter( 'yogastudio_filter_required_plugins',				'yogastudio_booked_required_plugins' );
		}
	}
}


// Check if plugin installed and activated
if ( !function_exists( 'yogastudio_exists_booked' ) ) {
	function yogastudio_exists_booked() {
		return class_exists('booked_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'yogastudio_booked_required_plugins' ) ) {
	//Handler of add_filter('yogastudio_filter_required_plugins',	'yogastudio_booked_required_plugins');
	function yogastudio_booked_required_plugins($list=array()) {
		if (in_array('booked', yogastudio_storage_get('required_plugins'))) {
			$path = yogastudio_get_file_dir('plugins/install/booked.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> esc_html__('Booked', 'yogastudio'),
					'slug' 		=> 'booked',
					'source'	=> $path,
					'required' 	=> false
					);
			}
            $path = yogastudio_get_file_dir( 'plugins/install/booked-calendar-feeds.zip' );
            if ( !empty($path) && file_exists($path) ) {
                $list[] = array(
                    'name'     => esc_html__( 'Booked Calendar Feeds', 'yogastudio' ),
                    'slug'     => 'booked-calendar-feeds',
                    'source'   => $path,
                    'version'  => '1.1.5',
                    'required' => false,
                );
            }
            $path = yogastudio_get_file_dir( 'plugins/install/booked-frontend-agents.zip' );
            if ( !empty($path) && file_exists($path) ) {
                $list[] = array(
                    'name'     => esc_html__( 'Booked Front-End Agents', 'yogastudio' ),
                    'slug'     => 'booked-frontend-agents',
                    'source'   => $path,
                    'version'  => '1.1.15',
                    'required' => false,
                );
            }
            $path = yogastudio_get_file_dir( 'plugins/install/booked-woocommerce-payments.zip' );
            if ( !empty($path) && file_exists($path) ) {
                $list[] = array(
                    'name'     => esc_html__( 'WooCommerce addons - Booked Payments with WooCommerce', 'yogastudio' ),
                    'slug'     => 'booked-woocommerce-payments',
                    'source'   => $path,
                    'version'  => '1.4.9',
                    'required' => false,
                );
            }
        }
        return $list;
	}
}

// Enqueue custom styles
if ( !function_exists( 'yogastudio_booked_frontend_scripts' ) ) {
	//Handler of add_action( 'yogastudio_action_add_styles', 'yogastudio_booked_frontend_scripts' );
	function yogastudio_booked_frontend_scripts() {
		if (file_exists(yogastudio_get_file_dir('css/plugin.booked.css')))
			wp_enqueue_style( 'yogastudio-plugin.booked-style',  yogastudio_get_file_url('css/plugin.booked.css'), array(), null );
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check in the required plugins
if ( !function_exists( 'yogastudio_booked_importer_required_plugins' ) ) {
	//Handler of add_filter( 'yogastudio_filter_importer_required_plugins',	'yogastudio_booked_importer_required_plugins', 10, 2);
	function yogastudio_booked_importer_required_plugins($not_installed='', $list='') {
		if (yogastudio_strpos($list, 'booked')!==false && !yogastudio_exists_booked() )
			$not_installed .= '<br>' . esc_html__('Booked Appointments', 'yogastudio');
		return $not_installed;
	}
}

// Set options for one-click importer
if ( !function_exists( 'yogastudio_booked_importer_set_options' ) ) {
	//Handler of add_filter( 'yogastudio_filter_importer_options',	'yogastudio_booked_importer_set_options', 10, 1 );
	function yogastudio_booked_importer_set_options($options=array()) {
		if (in_array('booked', yogastudio_storage_get('required_plugins')) && yogastudio_exists_booked()) {
			$options['additional_options'][] = 'booked_%';		// Add slugs to export options for this plugin
		}
		return $options;
	}
}

// Check if the row will be imported
if ( !function_exists( 'yogastudio_booked_importer_check_row' ) ) {
	//Handler of add_filter('yogastudio_filter_importer_import_row', 'yogastudio_booked_importer_check_row', 9, 4);
	function yogastudio_booked_importer_check_row($flag, $table, $row, $list) {
		if ($flag || strpos($list, 'booked')===false) return $flag;
		if ( yogastudio_exists_booked() ) {
			if ($table == 'posts')
				$flag = $row['post_type']=='booked_appointments';
		}
		return $flag;
	}
}


// Lists
//------------------------------------------------------------------------

// Return booked calendars list, prepended inherit (if need)
if ( !function_exists( 'yogastudio_get_list_booked_calendars' ) ) {
	function yogastudio_get_list_booked_calendars($prepend_inherit=false) {
		return yogastudio_exists_booked() ? yogastudio_get_list_terms($prepend_inherit, 'booked_custom_calendars') : array();
	}
}



// Register plugin's shortcodes
//------------------------------------------------------------------------

// Register shortcode in the shortcodes list
if (!function_exists('yogastudio_booked_reg_shortcodes')) {
	//Handler of add_filter('yogastudio_action_shortcodes_list',	'yogastudio_booked_reg_shortcodes');
	function yogastudio_booked_reg_shortcodes() {
		if (yogastudio_storage_isset('shortcodes')) {

			$booked_cals = yogastudio_get_list_booked_calendars();

			yogastudio_sc_map('booked-appointments', array(
				"title" => esc_html__("Booked Appointments", 'yogastudio'),
				"desc" => esc_html__("Display the currently logged in user's upcoming appointments", 'yogastudio'),
				"decorate" => true,
				"container" => false,
				"params" => array()
			));

			yogastudio_sc_map('booked-calendar', array(
				"title" => esc_html__("Booked Calendar", 'yogastudio'),
				"desc" => esc_html__("Insert booked calendar", 'yogastudio'),
				"decorate" => true,
				"container" => false,
				"params" => array(
					"calendar" => array(
						"title" => esc_html__("Calendar", 'yogastudio'),
						"desc" => esc_html__("Select booked calendar to display", 'yogastudio'),
						"value" => "0",
						"type" => "select",
						"options" => yogastudio_array_merge(array(0 => esc_html__('- Select calendar -', 'yogastudio')), $booked_cals)
					),
					"year" => array(
						"title" => esc_html__("Year", 'yogastudio'),
						"desc" => esc_html__("Year to display on calendar by default", 'yogastudio'),
						"value" => date("Y"),
						"min" => date("Y"),
						"max" => date("Y")+10,
						"type" => "spinner"
					),
					"month" => array(
						"title" => esc_html__("Month", 'yogastudio'),
						"desc" => esc_html__("Month to display on calendar by default", 'yogastudio'),
						"value" => date("m"),
						"min" => 1,
						"max" => 12,
						"type" => "spinner"
					)
				)
			));
		}
	}
}


// Register shortcode in the VC shortcodes list
if (!function_exists('yogastudio_booked_reg_shortcodes_vc')) {
	//Handler of add_filter('yogastudio_action_shortcodes_list_vc',	'yogastudio_booked_reg_shortcodes_vc');
	function yogastudio_booked_reg_shortcodes_vc() {

		$booked_cals = yogastudio_get_list_booked_calendars();

		// Booked Appointments
		vc_map( array(
				"base" => "booked-appointments",
				"name" => esc_html__("Booked Appointments", 'yogastudio'),
				"description" => esc_html__("Display the currently logged in user's upcoming appointments", 'yogastudio'),
				"category" => esc_html__('Content', 'yogastudio'),
				'icon' => 'icon_trx_booked',
				"class" => "trx_sc_single trx_sc_booked_appointments",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array()
			) );
			
		class WPBakeryShortCode_Booked_Appointments extends YOGASTUDIO_VC_ShortCodeSingle {}

		// Booked Calendar
		vc_map( array(
				"base" => "booked-calendar",
				"name" => esc_html__("Booked Calendar", 'yogastudio'),
				"description" => esc_html__("Insert booked calendar", 'yogastudio'),
				"category" => esc_html__('Content', 'yogastudio'),
				'icon' => 'icon_trx_booked',
				"class" => "trx_sc_single trx_sc_booked_calendar",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "calendar",
						"heading" => esc_html__("Calendar", 'yogastudio'),
						"description" => esc_html__("Select booked calendar to display", 'yogastudio'),
						"admin_label" => true,
						"class" => "",
						"std" => "0",
						"value" => array_flip(yogastudio_array_merge(array(0 => esc_html__('- Select calendar -', 'yogastudio')), $booked_cals)),
						"type" => "dropdown"
					),
					array(
						"param_name" => "year",
						"heading" => esc_html__("Year", 'yogastudio'),
						"description" => esc_html__("Year to display on calendar by default", 'yogastudio'),
						"admin_label" => true,
						"class" => "",
						"std" => date("Y"),
						"value" => date("Y"),
						"type" => "textfield"
					),
					array(
						"param_name" => "month",
						"heading" => esc_html__("Month", 'yogastudio'),
						"description" => esc_html__("Month to display on calendar by default", 'yogastudio'),
						"admin_label" => true,
						"class" => "",
						"std" => date("m"),
						"value" => date("m"),
						"type" => "textfield"
					)
				)
			) );
			
		class WPBakeryShortCode_Booked_Calendar extends YOGASTUDIO_VC_ShortCodeSingle {}

	}
}
?>