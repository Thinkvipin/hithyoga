<?php

// Check if shortcodes settings are now used
if ( !function_exists( 'yogastudio_shortcodes_is_used' ) ) {
	function yogastudio_shortcodes_is_used() {
		return yogastudio_options_is_used() 															// All modes when Theme Options are used
			|| (is_admin() && isset($_POST['action']) 
					&& in_array($_POST['action'], array('vc_edit_form', 'wpb_show_edit_form')))		// AJAX query when save post/page
			|| (is_admin() && yogastudio_strpos($_SERVER['REQUEST_URI'], 'vc-roles')!==false)			// VC Role Manager
			|| (function_exists('yogastudio_vc_is_frontend') && yogastudio_vc_is_frontend());			// VC Frontend editor mode
	}
}

// Width and height params
if ( !function_exists( 'yogastudio_shortcodes_width' ) ) {
	function yogastudio_shortcodes_width($w="") {
		return array(
			"title" => esc_html__("Width", 'trx_utils'),
			"divider" => true,
			"value" => $w,
			"type" => "text"
		);
	}
}
if ( !function_exists( 'yogastudio_shortcodes_height' ) ) {
	function yogastudio_shortcodes_height($h='') {
		return array(
			"title" => esc_html__("Height", 'trx_utils'),
			"desc" => wp_kses_data( __("Width and height of the element", 'trx_utils') ),
			"value" => $h,
			"type" => "text"
		);
	}
}

// Return sc_param value
if ( !function_exists( 'yogastudio_get_sc_param' ) ) {
	function yogastudio_get_sc_param($prm) {
		return yogastudio_storage_get_array('sc_params', $prm);
	}
}

// Set sc_param value
if ( !function_exists( 'yogastudio_set_sc_param' ) ) {
	function yogastudio_set_sc_param($prm, $val) {
		yogastudio_storage_set_array('sc_params', $prm, $val);
	}
}

// Add sc settings in the sc list
if ( !function_exists( 'yogastudio_sc_map' ) ) {
	function yogastudio_sc_map($sc_name, $sc_settings) {
		yogastudio_storage_set_array('shortcodes', $sc_name, $sc_settings);
	}
}

// Add sc settings in the sc list after the key
if ( !function_exists( 'yogastudio_sc_map_after' ) ) {
	function yogastudio_sc_map_after($after, $sc_name, $sc_settings='') {
		yogastudio_storage_set_array_after('shortcodes', $after, $sc_name, $sc_settings);
	}
}

// Add sc settings in the sc list before the key
if ( !function_exists( 'yogastudio_sc_map_before' ) ) {
	function yogastudio_sc_map_before($before, $sc_name, $sc_settings='') {
		yogastudio_storage_set_array_before('shortcodes', $before, $sc_name, $sc_settings);
	}
}

// Compare two shortcodes by title
if ( !function_exists( 'yogastudio_compare_sc_title' ) ) {
	function yogastudio_compare_sc_title($a, $b) {
		return strcmp($a['title'], $b['title']);
	}
}



/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yogastudio_shortcodes_settings_theme_setup' ) ) {
//	if ( yogastudio_vc_is_frontend() )
	if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline') )
		add_action( 'yogastudio_action_before_init_theme', 'yogastudio_shortcodes_settings_theme_setup', 20 );
	else
		add_action( 'yogastudio_action_after_init_theme', 'yogastudio_shortcodes_settings_theme_setup' );
	function yogastudio_shortcodes_settings_theme_setup() {
		if (yogastudio_shortcodes_is_used()) {

			// Sort templates alphabetically
			$tmp = yogastudio_storage_get('registered_templates');
			ksort($tmp);
			yogastudio_storage_set('registered_templates', $tmp);

			// Prepare arrays 
			yogastudio_storage_set('sc_params', array(
			
				// Current element id
				'id' => array(
					"title" => esc_html__("Element ID", 'trx_utils'),
					"desc" => wp_kses_data( __("ID for current element", 'trx_utils') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				// Current element class
				'class' => array(
					"title" => esc_html__("Element CSS class", 'trx_utils'),
					"desc" => wp_kses_data( __("CSS class for current element (optional)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
			
				// Current element style
				'css' => array(
					"title" => esc_html__("CSS styles", 'trx_utils'),
					"desc" => wp_kses_data( __("Any additional CSS rules (if need)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
			
			
				// Switcher choises
				'list_styles' => array(
					'ul'	=> esc_html__('Unordered', 'trx_utils'),
					'ol'	=> esc_html__('Ordered', 'trx_utils'),
					'iconed'=> esc_html__('Iconed', 'trx_utils')
				),

				'yes_no'	=> yogastudio_get_list_yesno(),
				'on_off'	=> yogastudio_get_list_onoff(),
				'dir' 		=> yogastudio_get_list_directions(),
				'align'		=> yogastudio_get_list_alignments(),
				'float'		=> yogastudio_get_list_floats(),
				'hpos'		=> yogastudio_get_list_hpos(),
				'show_hide'	=> yogastudio_get_list_showhide(),
				'sorting' 	=> yogastudio_get_list_sortings(),
				'ordering' 	=> yogastudio_get_list_orderings(),
				'shapes'	=> yogastudio_get_list_shapes(),
				'sizes'		=> yogastudio_get_list_sizes(),
				'sliders'	=> yogastudio_get_list_sliders(),
				'controls'	=> yogastudio_get_list_controls(),
				'categories'=> yogastudio_get_list_categories(),
				'columns'	=> yogastudio_get_list_columns(),
				'images'	=> array_merge(array('none'=>"none"), yogastudio_get_list_images("images/icons", "png")),
				'icons'		=> array_merge(array("inherit", "none"), yogastudio_get_list_icons()),
				'locations'	=> yogastudio_get_list_dedicated_locations(),
				'filters'	=> yogastudio_get_list_portfolio_filters(),
				'formats'	=> yogastudio_get_list_post_formats_filters(),
				'hovers'	=> yogastudio_get_list_hovers(true),
				'hovers_dir'=> yogastudio_get_list_hovers_directions(true),
				'schemes'	=> yogastudio_get_list_color_schemes(true),
				'animations'		=> yogastudio_get_list_animations_in(),
				'margins' 			=> yogastudio_get_list_margins(true),
				'blogger_styles'	=> yogastudio_get_list_templates_blogger(),
				'forms'				=> yogastudio_get_list_templates_forms(),
				'posts_types'		=> yogastudio_get_list_posts_types(),
				'googlemap_styles'	=> yogastudio_get_list_googlemap_styles(),
				'field_types'		=> yogastudio_get_list_field_types(),
				'label_positions'	=> yogastudio_get_list_label_positions()
				)
			);

			// Common params
			yogastudio_set_sc_param('animation', array(
				"title" => esc_html__("Animation",  'trx_utils'),
				"desc" => wp_kses_data( __('Select animation while object enter in the visible area of page',  'trx_utils') ),
				"value" => "none",
				"type" => "select",
				"options" => yogastudio_get_sc_param('animations')
				)
			);
			yogastudio_set_sc_param('top', array(
				"title" => esc_html__("Top margin",  'trx_utils'),
				"divider" => true,
				"value" => "inherit",
				"type" => "select",
				"options" => yogastudio_get_sc_param('margins')
				)
			);
			yogastudio_set_sc_param('bottom', array(
				"title" => esc_html__("Bottom margin",  'trx_utils'),
				"value" => "inherit",
				"type" => "select",
				"options" => yogastudio_get_sc_param('margins')
				)
			);
			yogastudio_set_sc_param('left', array(
				"title" => esc_html__("Left margin",  'trx_utils'),
				"value" => "inherit",
				"type" => "select",
				"options" => yogastudio_get_sc_param('margins')
				)
			);
			yogastudio_set_sc_param('right', array(
				"title" => esc_html__("Right margin",  'trx_utils'),
				"desc" => wp_kses_data( __("Margins around this shortcode", 'trx_utils') ),
				"value" => "inherit",
				"type" => "select",
				"options" => yogastudio_get_sc_param('margins')
				)
			);

			yogastudio_storage_set('sc_params', apply_filters('yogastudio_filter_shortcodes_params', yogastudio_storage_get('sc_params')));

			// Shortcodes list
			//------------------------------------------------------------------
			yogastudio_storage_set('shortcodes', array());
			
			// Register shortcodes
			do_action('yogastudio_action_shortcodes_list');

			// Sort shortcodes list
			$tmp = yogastudio_storage_get('shortcodes');
			uasort($tmp, 'yogastudio_compare_sc_title');
			yogastudio_storage_set('shortcodes', $tmp);
		}
	}
}
?>