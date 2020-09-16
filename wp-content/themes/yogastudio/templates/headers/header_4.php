<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yogastudio_template_header_4_theme_setup' ) ) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_template_header_4_theme_setup', 1 );
	function yogastudio_template_header_4_theme_setup() {
		yogastudio_add_template(array(
			'layout' => 'header_4',
			'mode'   => 'header',
			'title'  => esc_html__('Header 4', 'yogastudio'),
			'icon'   => yogastudio_get_file_url('templates/headers/images/4.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'yogastudio_template_header_4_output' ) ) {
	function yogastudio_template_header_4_output($post_options, $post_data) {
		$button = yogastudio_get_theme_option('show_button');
		$btn_title = yogastudio_get_theme_option('button_title');
		$btn_link = yogastudio_get_theme_option('link_for_button');
		// WP custom header
		$header_css = '';
		if ($post_options['position'] != 'over') {
			$header_image = get_header_image();
			$header_css = $header_image!='' 
			? ' style="background: url('.esc_url($header_image).') repeat center top"' 
			: '';
		}
		?>
		

		<div class="top_panel_fixed_wrap"></div>

		<header class="top_panel_wrap top_panel_style_4 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_4 top_panel_position_<?php echo esc_attr(yogastudio_get_custom_option('top_panel_position')); ?>">
				
				<?php if (yogastudio_get_custom_option('show_top_panel_top')=='yes') { ?>
				<div class="top_panel_top">
					<div class="content_wrap clearfix">
						<?php
						yogastudio_template_set_args('top-panel-top', array(
							'top_panel_top_components' => array('contact_email','contact_phone','open_hours')
							));
						get_template_part(yogastudio_get_file_slug('templates/headers/_parts/top-panel-top.php'));
						?>
					</div>
				</div>
				<?php } ?>

				<div class="top_panel_middle" <?php yogastudio_show_layout($header_css); ?>>
					<div class="content_wrap">
						<div class="columns_wrap columns_fluid"><div
							class="column-1_4 contact_logo">
							<?php yogastudio_show_logo(true, true, false, false, true, false); ?>
						</div>
						<div class="column-3_4 menu_main_wrap">
						<a href="#" class="menu_main_responsive_button icon-menu"></a>
						<nav class="menu_main_nav_area">
							<?php
							$menu_main = yogastudio_get_nav_menu('menu_main');
							if (empty($menu_main)) $menu_main = yogastudio_get_nav_menu();
							yogastudio_show_layout($menu_main);
							?>
						</nav>
						<?php yogastudio_show_layout($button == "yes" ? '
							<a href="'.(!empty($btn_link) ? esc_url($btn_link) : esc_url('#'))
							.'" class="sc_button sc_button_square sc_button_style_filled sc_button_size_small">'
							. (!empty($btn_title) ? esc_attr($btn_title) : esc_html__('Make an Appointment', 'yogastudio')).'</a>' : '');
							?>
						</div>
						<span class="menu-search search icon-search"></span>
						<div class="menu-search-box">
						    <span class="menu-search-cross">x</span>
						    <?php  yogastudio_show_layout(yogastudio_sc_search(array('state'=>'fixed'))); ?>
						</div>

					</div>
				</div>
			</div>

		</div>
	</header>

		<?php
		yogastudio_storage_set('header_mobile', array(
			'open_hours' => false,
			'login' => false,
			'socials' => false,
			'bookmarks' => true,
			'contact_address' => false,
			'contact_phone_email' => false,
			'woo_cart' => true,
			'search' => false
			)
		);
	}
}
?>