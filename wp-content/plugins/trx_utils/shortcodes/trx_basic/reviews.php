<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('yogastudio_sc_reviews_theme_setup')) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_sc_reviews_theme_setup' );
	function yogastudio_sc_reviews_theme_setup() {
		add_action('yogastudio_action_shortcodes_list', 		'yogastudio_sc_reviews_reg_shortcodes');
		if (function_exists('yogastudio_exists_visual_composer') && yogastudio_exists_visual_composer())
			add_action('yogastudio_action_shortcodes_list_vc','yogastudio_sc_reviews_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_reviews]
*/

if (!function_exists('yogastudio_sc_reviews')) {	
	function yogastudio_sc_reviews($atts, $content = null) {
		if (yogastudio_in_shortcode_blogger()) return '';
		extract(yogastudio_html_decode(shortcode_atts(array(
			// Individual params
			"align" => "right",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . yogastudio_get_css_position_as_classes($top, $right, $bottom, $left);
		$output = yogastudio_param_is_off(yogastudio_get_custom_option('show_sidebar_main'))
			? '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
						. ' class="sc_reviews'
							. ($align && $align!='none' ? ' align'.esc_attr($align) : '')
							. ($class ? ' '.esc_attr($class) : '')
							. '"'
						. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
						. (!yogastudio_param_is_off($animation) ? ' data-animation="'.esc_attr(yogastudio_get_animation_classes($animation)).'"' : '')
						. '>'
					. trim(yogastudio_get_reviews_placeholder())
					. '</div>'
			: '';
		return apply_filters('yogastudio_shortcode_output', $output, 'trx_reviews', $atts, $content);
	}
	yogastudio_require_shortcode("trx_reviews", "yogastudio_sc_reviews");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yogastudio_sc_reviews_reg_shortcodes' ) ) {
	//add_action('yogastudio_action_shortcodes_list', 'yogastudio_sc_reviews_reg_shortcodes');
	function yogastudio_sc_reviews_reg_shortcodes() {
	
		yogastudio_sc_map("trx_reviews", array(
			"title" => esc_html__("Reviews", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert reviews block in the single post", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"align" => array(
					"title" => esc_html__("Alignment", 'trx_utils'),
					"desc" => wp_kses_data( __("Align counter to left, center or right", 'trx_utils') ),
					"divider" => true,
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => yogastudio_get_sc_param('align')
				), 
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


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'yogastudio_sc_reviews_reg_shortcodes_vc' ) ) {
	//add_action('yogastudio_action_shortcodes_list_vc', 'yogastudio_sc_reviews_reg_shortcodes_vc');
	function yogastudio_sc_reviews_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_reviews",
			"name" => esc_html__("Reviews", 'trx_utils'),
			"description" => wp_kses_data( __("Insert reviews block in the single post", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			'icon' => 'icon_trx_reviews',
			"class" => "trx_sc_single trx_sc_reviews",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Align counter to left, center or right", 'trx_utils') ),
					"class" => "",
					"value" => array_flip(yogastudio_get_sc_param('align')),
					"type" => "dropdown"
				),
				yogastudio_get_vc_param('id'),
				yogastudio_get_vc_param('class'),
				yogastudio_get_vc_param('animation'),
				yogastudio_get_vc_param('css'),
				yogastudio_get_vc_param('margin_top'),
				yogastudio_get_vc_param('margin_bottom'),
				yogastudio_get_vc_param('margin_left'),
				yogastudio_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Reviews extends YOGASTUDIO_VC_ShortCodeSingle {}
	}
}
?>