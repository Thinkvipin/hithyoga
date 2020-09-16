<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yogastudio_sc_table_theme_setup')) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_sc_table_theme_setup' );
	function yogastudio_sc_table_theme_setup() {
		add_action('yogastudio_action_shortcodes_list', 		'yogastudio_sc_table_reg_shortcodes');
		if (function_exists('yogastudio_exists_visual_composer') && yogastudio_exists_visual_composer())
			add_action('yogastudio_action_shortcodes_list_vc','yogastudio_sc_table_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_table id="unique_id" style="1"]
Table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/
[/trx_table]
*/

if (!function_exists('yogastudio_sc_table')) {	
	function yogastudio_sc_table($atts, $content=null){	
		if (yogastudio_in_shortcode_blogger()) return '';
		extract(yogastudio_html_decode(shortcode_atts(array(
			// Individual params
			"align" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => "",
			"width" => "100%"
		), $atts)));
		$class .= ($class ? ' ' : '') . yogastudio_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= yogastudio_get_css_dimensions_from_values($width);
		$content = str_replace(
					array('<p><table', 'table></p>', '><br />'),
					array('<table', 'table>', '>'),
					html_entity_decode($content, ENT_COMPAT, 'UTF-8'));
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_table' 
					. (!empty($align) && $align!='none' ? ' align'.esc_attr($align) : '') 
					. (!empty($class) ? ' '.esc_attr($class) : '') 
					. '"'
				. (!yogastudio_param_is_off($animation) ? ' data-animation="'.esc_attr(yogastudio_get_animation_classes($animation)).'"' : '')
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
				.'>' 
				. do_shortcode($content) 
				. '</div>';
		return apply_filters('yogastudio_shortcode_output', $output, 'trx_table', $atts, $content);
	}
	yogastudio_require_shortcode('trx_table', 'yogastudio_sc_table');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yogastudio_sc_table_reg_shortcodes' ) ) {
	//add_action('yogastudio_action_shortcodes_list', 'yogastudio_sc_table_reg_shortcodes');
	function yogastudio_sc_table_reg_shortcodes() {
	
		yogastudio_sc_map("trx_table", array(
			"title" => esc_html__("Table", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert a table into post (page). ", 'trx_utils') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"align" => array(
					"title" => esc_html__("Content alignment", 'trx_utils'),
					"desc" => wp_kses_data( __("Select alignment for each table cell", 'trx_utils') ),
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => yogastudio_get_sc_param('align')
				),
				"_content_" => array(
					"title" => esc_html__("Table content", 'trx_utils'),
					"desc" => wp_kses_data( __("Content, created with any table-generator", 'trx_utils') ),
					"divider" => true,
					"rows" => 8,
					"value" => "Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/",
					"type" => "textarea"
				),
				"width" => yogastudio_shortcodes_width(),
				"top" => yogastudio_get_sc_param('top'),
				"bottom" => yogastudio_get_sc_param('bottom'),
				"left" => yogastudio_get_sc_param('left'),
				"right" => yogastudio_get_sc_param('right'),
				"id" => yogastudio_get_sc_param('id'),
				"class" => yogastudio_get_sc_param('class'),
				"animation" => yogastudio_get_sc_param('animation'),
				"css" => yogastudio_get_sc_param('css')
			)
		));
	}
}


/* Add shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yogastudio_sc_table_reg_shortcodes_vc' ) ) {
	//add_action('yogastudio_action_shortcodes_list_vc', 'yogastudio_sc_table_reg_shortcodes_vc');
	function yogastudio_sc_table_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_table",
			"name" => esc_html__("Table", 'trx_utils'),
			"description" => wp_kses_data( __("Insert a table", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_table',
			"class" => "trx_sc_container trx_sc_table",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "align",
					"heading" => esc_html__("Cells content alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Select alignment for each table cell", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(yogastudio_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "content",
					"heading" => esc_html__("Table content", 'trx_utils'),
					"description" => wp_kses_data( __("Content, created with any table-generator", 'trx_utils') ),
					"class" => "",
					"value" => esc_html__("Paste here table content, generated on one of many public internet resources, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/", 'trx_utils'),
					"type" => "textarea_html"
				),
				yogastudio_get_vc_param('id'),
				yogastudio_get_vc_param('class'),
				yogastudio_get_vc_param('animation'),
				yogastudio_get_vc_param('css'),
				yogastudio_vc_width(),
				yogastudio_vc_height(),
				yogastudio_get_vc_param('margin_top'),
				yogastudio_get_vc_param('margin_bottom'),
				yogastudio_get_vc_param('margin_left'),
				yogastudio_get_vc_param('margin_right')
			),
			'js_view' => 'VcTrxTextContainerView'
		) );
		
		class WPBakeryShortCode_Trx_Table extends YOGASTUDIO_VC_ShortCodeContainer {}
	}
}
?>