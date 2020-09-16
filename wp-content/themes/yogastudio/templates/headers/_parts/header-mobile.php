<?php
$header_options = yogastudio_storage_get('header_mobile');
$contact_address_1 = trim(yogastudio_get_custom_option('contact_address_1'));
$contact_address_2 = trim(yogastudio_get_custom_option('contact_address_2'));
$contact_phone = trim(yogastudio_get_custom_option('contact_phone'));
$contact_email = trim(yogastudio_get_custom_option('contact_email'));
?>
<div class="header_mobile">
<?php if (yogastudio_get_custom_option('show_top_panel_top')=='yes') { ?>
<div class="top_panel_top">
	<div class="content_wrap clearfix">
		<?php
		yogastudio_template_set_args('top-panel-top', array(
			'top_panel_top_components' => array('contact_email','contact_phone', 'open_hours')
			));
		get_template_part(yogastudio_get_file_slug('templates/headers/_parts/top-panel-top.php'));
		?>
	</div>
</div>
<?php } ?>
	<div class="content_wrap">
	    <span class="menu-search search icon-search"></span>
		<div class="menu-search-box">
		    <span class="menu-search-cross">x</span>
		    <?php  yogastudio_show_layout(yogastudio_sc_search(array('state'=>'fixed'))); ?>
		</div>
		<div class="menu_button icon-menu"></div>
		<?php 
		yogastudio_show_logo_mobile(true, false, false, false, true, false); 
		if ($header_options['woo_cart']){
			if (function_exists('yogastudio_exists_woocommerce') && yogastudio_exists_woocommerce() && (yogastudio_is_woocommerce_page() && yogastudio_get_custom_option('show_cart')=='shop' || yogastudio_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { 
				?>
				<div class="menu_main_cart top_panel_icon">
					<?php get_template_part(yogastudio_get_file_slug('templates/headers/_parts/contact-info-cart.php')); ?>
				</div>
				<?php
			}
		}
		?>
	</div>
	<div class="side_wrap">
		<div class="close"><?php esc_html_e('Close', 'yogastudio'); ?></div>
		<div class="panel_top">
			<nav class="menu_main_nav_area">
				<?php
				$menu_main = yogastudio_get_nav_menu('menu_main');
				if (empty($menu_main)) $menu_main = yogastudio_get_nav_menu();
				yogastudio_show_layout($menu_main);
				?>
			</nav>
			<?php 
			if ($header_options['search'] && yogastudio_get_custom_option('show_search')=='yes' && function_exists('yogastudio_sc_search'))
				yogastudio_show_layout(yogastudio_sc_search(array()));

			if ($header_options['login']) {
				if ( is_user_logged_in() ) { 
					?>
					<div class="login"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="popup_link"><?php esc_html_e('Logout', 'yogastudio'); ?></a></div>
					<?php
				} else {
						// Load core messages
					yogastudio_enqueue_messages();
						// Load Popup engine
					yogastudio_enqueue_popup();
					?>
					<div class="login"><?php do_action('trx_utils_action_login'); ?></div><?php
						// Anyone can register ?
					if ( (int) get_option('users_can_register') > 0) {
						?>
						<div class="login"><?php do_action('trx_utils_action_register'); ?></div><?php 
					}
				}
			}
			?>
		</div>

		<?php if ($header_options['contact_address'] || $header_options['contact_phone_email'] || $header_options['open_hours']) { ?>
		<div class="panel_middle">
			<?php
			if ($header_options['contact_address'] && (!empty($contact_address_1) || !empty($contact_address_2))) {
				?><div class="contact_field contact_address">
				<span class="contact_icon icon-home"></span>
				<span class="contact_label contact_address_1"><?php yogastudio_show_layout($contact_address_1); ?></span>
				<span class="contact_address_2"><?php yogastudio_show_layout($contact_address_2); ?></span>
			</div><?php
		}

		if ($header_options['contact_phone_email'] && (!empty($contact_phone) || !empty($contact_email))) {
			?><div class="contact_field contact_phone">
			<span class="contact_icon icon-phone"></span>
			<span class="contact_label contact_phone"><?php yogastudio_show_layout($contact_phone); ?></span>
			<span class="contact_email"><?php yogastudio_show_layout($contact_email); ?></span>
		</div><?php
	}

	yogastudio_template_set_args('top-panel-top', array(
		'top_panel_top_components' => array(
			($header_options['open_hours'] ? 'open_hours' : '')
			)
		));
	get_template_part(yogastudio_get_file_slug('templates/headers/_parts/top-panel-top.php'));
	?>
</div>
<?php } ?>

<div class="panel_bottom">
	<?php if ($header_options['socials'] && yogastudio_get_custom_option('show_socials')=='yes' && function_exists('yogastudio_sc_socials')) { ?>
	<div class="contact_socials">
		<?php yogastudio_show_layout(yogastudio_sc_socials(array('size'=>'small'))); ?>
	</div>
	<?php } ?>
</div>
</div>
<div class="mask"></div>
</div>