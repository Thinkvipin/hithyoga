<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'yogastudio_template_header_5_theme_setup' ) ) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_template_header_5_theme_setup', 1 );
	function yogastudio_template_header_5_theme_setup() {
		yogastudio_add_template(array(
			'layout' => 'header_5',
			'mode'   => 'header',
			'title'  => esc_html__('Header 5', 'yogastudio'),
			'icon'   => yogastudio_get_file_url('templates/headers/images/5.jpg')
			));
	}
}

// Template output
if ( !function_exists( 'yogastudio_template_header_5_output' ) ) {
	function yogastudio_template_header_5_output($post_options, $post_data) {
		
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

		<header class="top_panel_wrap top_panel_style_5 scheme_<?php echo esc_attr($post_options['scheme']); ?>">
			<div class="top_panel_wrap_inner top_panel_inner_style_5 top_panel_position_<?php echo esc_attr(yogastudio_get_custom_option('top_panel_position')); ?>">
				<div class="top_panel_middle" <?php yogastudio_show_layout($header_css); ?>>
					<div class="top_panel_top">
						<div class="content_wrap">
							<div class="columns_wrap contact_logo_wrap">
								<div class="column-1_3">
									<?php
									if (($contact_info=trim(yogastudio_get_custom_option('contact_info')))!='') {
										?>
										<div class="top_panel_top_contact_info icon-location"><span><?php yogastudio_show_layout($contact_info); ?></span></div>
										<?php
									}
									?>
								</div><div class="column-1_4">
								<div class="contact_logo">
									<?php yogastudio_show_logo(true, true, false, false, true, false); ?>
								</div>
							</div><div class="column-1_3">
							<?php
							if (($contact_phone=trim(yogastudio_get_custom_option('contact_phone')))!='') {
								?>
								<div class="top_panel_top_contact_phone icon-phone"><span><?php yogastudio_show_layout($contact_phone); ?></span></div>
								<?php
							}
							?>
							<?php
							if (($open_hours=trim(yogastudio_get_custom_option('contact_open_hours')))!='') {
								?>
								<div class="top_panel_top_open_hours icon-clock"><span><?php yogastudio_show_layout($open_hours); ?></span></div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="top_panel_middle">
				<div class="content_wrap">
					<div class="menu_main_wrap clearfix">
						<a href="#" class="menu_main_responsive_button icon-menu"></a>
						<nav class="menu_main_nav_area">
							<?php
							$menu_main = yogastudio_get_nav_menu('menu_main');
							if (empty($menu_main)) $menu_main = yogastudio_get_nav_menu();
							yogastudio_show_layout($menu_main);
							?>
						</nav>
					</div>
					<div class="social_icon search_panel">
						<?php 
						if (yogastudio_get_custom_option('show_socials')=='yes' && function_exists('yogastudio_sc_socials')) {
							?>
							<div class="top_panel_top_socials">
								<?php
								yogastudio_show_layout(yogastudio_sc_socials(array('size'=>'tiny')));
								?>
							</div>
							<?php
						}
						if (yogastudio_get_custom_option('show_search')=='yes' && function_exists('yogastudio_sc_search'))
							yogastudio_show_layout(yogastudio_sc_search(array('class'=>"top_panel_icon", 'state'=>"closed")));
						?>
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