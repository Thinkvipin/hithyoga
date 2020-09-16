<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yogastudio_sc_content_theme_setup')) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_sc_content_theme_setup' );
	function yogastudio_sc_content_theme_setup() {
		add_action('yogastudio_action_shortcodes_list', 		'yogastudio_sc_content_reg_shortcodes');
		if (function_exists('yogastudio_exists_visual_composer') && yogastudio_exists_visual_composer())
			add_action('yogastudio_action_shortcodes_list_vc','yogastudio_sc_content_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_content id="unique_id" class="class_name" style="css-styles"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_content]
*/

if (!function_exists('yogastudio_sc_content')) {	
	function yogastudio_sc_content($atts, $content=null){	
		if (yogastudio_in_shortcode_blogger()) return '';
		extract(yogastudio_html_decode(shortcode_atts(array(
			"scheme" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"top" => "",
			"bottom" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . yogastudio_get_css_position_as_classes($top, '', $bottom);
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
			. ' class="sc_content content_wrap' 
				. ($scheme && !yogastudio_param_is_off($scheme) && !yogastudio_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
				. ($class ? ' '.esc_attr($class) : '') 
				. '"'
			. (!yogastudio_param_is_off($animation) ? ' data-animation="'.esc_attr(yogastudio_get_animation_classes($animation)).'"' : '')
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '').'>' 
			. do_shortcode($content) 
			. '</div>';
		return apply_filters('yogastudio_shortcode_output', $output, 'trx_content', $atts, $content);
	}
	yogastudio_require_shortcode('trx_content', 'yogastudio_sc_content');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yogastudio_sc_content_reg_shortcodes' ) ) {
	//add_action('yogastudio_action_shortcodes_list', 'yogastudio_sc_content_reg_shortcodes');
	function yogastudio_sc_content_reg_shortcodes() {
	
		yogastudio_sc_map("trx_content", array(
			"title" => esc_html__("Content block", 'trx_utils'),
			"desc" => wp_kses_data( __("Container for main content block with desired class and style (use it only on fullscreen pages)", 'trx_utils') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'trx_utils'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"value" => "",
					"type" => "checklist",
					"options" => yogastudio_get_sc_param('schemes')
				),
				"_content_" => array(
					"title" => esc_html__("Container content", 'trx_utils'),
					"desc" => wp_kses_data( __("Content for section container", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"top" => yogastudio_get_sc_param('top'),
				"bottom" => yogastudio_get_sc_param('bottom'),
				"id" => yogastudio_get_sc_param('id'),
				"class" => yogastudio_get_sc_param('class'),
				"animation" => yogastudio_get_sc_param('animation'),
				"css" => yogastudio_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yogastudio_sc_content_reg_shortcodes_vc' ) ) {
	//add_action('yogastudio_action_shortcodes_list_vc', 'yogastudio_sc_content_reg_shortcodes_vc');
	function yogastudio_sc_content_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_content",
			"name" => esc_html__("Content block", 'trx_utils'),
			"description" => wp_kses_data( __("Container for main content block (use it only on fullscreen pages)", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_content',
			"class" => "trx_sc_collection trx_sc_content",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'trx_utils'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'trx_utils') ),
					"group" => esc_html__('Colors and Images', 'trx_utils'),
					"class" => "",
					"value" => array_flip(yogastudio_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				yogastudio_get_vc_param('id'),
				yogastudio_get_vc_param('class'),
				yogastudio_get_vc_param('animation'),
				yogastudio_get_vc_param('css'),
				yogastudio_get_vc_param('margin_top'),
				yogastudio_get_vc_param('margin_bottom')
			)
		) );
		
		class WPBakeryShortCode_Trx_Content extends YOGASTUDIO_VC_ShortCodeCollection {}
	}
}
?>