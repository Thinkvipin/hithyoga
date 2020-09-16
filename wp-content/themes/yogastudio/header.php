<?php
/**
 * The Header for our theme.
 */

// Theme init - don't remove next row! Load custom options
yogastudio_core_init_theme();

yogastudio_profiler_add_point(esc_html__('Before Theme HTML output', 'yogastudio'));

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php
		// Add class 'scheme_xxx' into <html> because it used as context for the body classes!
$body_scheme = yogastudio_get_custom_option('body_scheme');
if (empty($body_scheme) || yogastudio_is_inherit_option($body_scheme)) $body_scheme = 'original';
echo 'scheme_' . esc_attr($body_scheme);
?>">

<head>
    
<link rel="dns-prefetch" href="//fonts.googleapis.com">	
<link rel="dns-prefetch" href="//ajax.googleapis.com">
<link rel="dns-prefetch" href="//www.google-analytics.com">   
	<?php wp_head(); ?>
	<link rel="preload" href="https://www.hithyoga.com/wp-content/themes/yogastudio/css/fontello/font/fontello.woff?10833409" as="font" crossorigin="anonymous">

</head>

<body <?php body_class();?>>

	<?php do_action( 'before' ); 

	$body_style  = yogastudio_get_custom_option('body_style');
	$class = $style = '';
	if (yogastudio_get_custom_option('bg_custom')=='yes' && ($body_style=='boxed' || yogastudio_get_custom_option('bg_image_load')=='always')) {
		if (($img = yogastudio_get_custom_option('bg_image_custom')) != '')
			$style = 'background: url('.esc_url($img).') ' . str_replace('_', ' ', yogastudio_get_custom_option('bg_image_custom_position')) . ' no-repeat fixed;';
		else if (($img = yogastudio_get_custom_option('bg_pattern_custom')) != '')
			$style = 'background: url('.esc_url($img).') 0 0 repeat fixed;';
		else if (($img = yogastudio_get_custom_option('bg_image')) > 0)
			$class = 'bg_image_'.($img);
		else if (($img = yogastudio_get_custom_option('bg_pattern')) > 0)
			$class = 'bg_pattern_'.($img);
		if (($img = yogastudio_get_custom_option('bg_color')) != '')
			$style .= 'background-color: '.($img).';';
	} ?>

	<div class="body_wrap<?php echo !empty($class) ? ' '.esc_attr($class) : ''; ?>"<?php echo !empty($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>

		<?php
		$video_bg_show = yogastudio_get_custom_option('show_video_bg')=='yes';
		$youtube = yogastudio_get_custom_option('video_bg_youtube_code');
		$video   = yogastudio_get_custom_option('video_bg_url');
		$overlay = yogastudio_get_custom_option('video_bg_overlay')=='yes';
		if ($video_bg_show && (!empty($youtube) || !empty($video))) {
			if (!empty($youtube)) {
				?>
				<div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>" data-youtube-code="<?php echo esc_attr($youtube); ?>"></div>
				<?php
			} else if (!empty($video)) {
				$ext = yogastudio_get_file_ext($video);
				if (empty($ext)) $ext = 'src';
				?>
				<div class="video_bg<?php echo !empty($overlay) ? ' video_bg_overlay' : ''; ?>"><video class="video_bg_tag" width="1280" height="720" data-width="1280" data-height="720" data-ratio="16:9" preload="metadata" autoplay loop src="<?php echo esc_url($video); ?>"><source src="<?php echo esc_url($video); ?>" type="video/<?php echo esc_attr($ext); ?>"></source></video></div>
				<?php
			}
		}
		?>

		<div class="page_wrap">

			<?php
			$top_panel_style = yogastudio_get_custom_option('top_panel_style');
			$top_panel_position = yogastudio_get_custom_option('top_panel_position');
			$top_panel_scheme = yogastudio_get_custom_option('top_panel_scheme');
			// Top panel 'Above' or 'Over'
			if (in_array($top_panel_position, array('above', 'over'))) {
				yogastudio_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => $top_panel_scheme
					), false);
				// Mobile Menu
				get_template_part(yogastudio_get_file_slug('templates/headers/_parts/header-mobile.php'));
			}

			// Slider
			get_template_part(yogastudio_get_file_slug('templates/headers/_parts/slider.php'));

			// Top panel 'Below'
			if ($top_panel_position == 'below') {
				yogastudio_show_post_layout(array(
					'layout' => $top_panel_style,
					'position' => $top_panel_position,
					'scheme' => $top_panel_scheme
					), false);
				// Mobile Menu
				get_template_part(yogastudio_get_file_slug('templates/headers/_parts/header-mobile.php'));
			}

			// Top of page section: page title and breadcrumbs
			$show_title = yogastudio_get_custom_option('show_page_title')=='yes';
			$show_breadcrumbs = yogastudio_get_custom_option('show_breadcrumbs')=='yes';
			if ($show_title || $show_breadcrumbs) {
				?>
				<div class="top_panel_title top_panel_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present' : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present' : ''); ?> scheme_<?php echo esc_attr($top_panel_scheme); ?>">
					<div class="top_panel_title_inner top_panel_inner_style_<?php echo esc_attr(str_replace('header_', '', $top_panel_style)); ?> <?php echo (!empty($show_title) ? ' title_present_inner' : '') . (!empty($show_breadcrumbs) ? ' breadcrumbs_present_inner' : ''); ?>">
						<div class="content_wrap">
							<?php if ($show_title) { ?>
							<h1 class="page_title"><?php echo strip_tags(yogastudio_get_blog_title()); ?></h1>
							<?php } ?>
							<?php if ($show_breadcrumbs) { ?>
							<div class="breadcrumbs">
								<?php if (!is_404()) yogastudio_show_breadcrumbs(); ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>

			<div class="page_content_wrap page_paddings_<?php echo esc_attr(yogastudio_get_custom_option('body_paddings')); ?>">

				<?php
				// Content and sidebar wrapper
				if ($body_style!='fullscreen') yogastudio_open_wrapper('<div class="content_wrap">');

				
			//Header for woocommerce custom heading
				if (yogastudio_get_custom_option('show_woo_heading') == 'yes') { 
					$woo_title = yogastudio_get_theme_option('show_woo_title');
					$woo_slogan = yogastudio_get_theme_option('show_woo_slogan');
					$woo_image = yogastudio_get_theme_option('woo_header_bg');
					?>
					<div class="content_wrap">
						<div class="custom_header_wrap">	
							<div class="woocommerce_custom_header" <?php echo (!empty($woo_image) ? 'style="background: url('.esc_url($woo_image).') center center;"' : ''); ?> ></div>
							<div class="header_content_wrap">
								<h2 class="title_header"><?php echo (!empty($woo_title) ? esc_attr($woo_title) : esc_html__('Welcome', 'yogastudio')); ?></h2>
								<h6 class="slogan_header"><?php echo (!empty($woo_slogan) ? esc_attr($woo_slogan) : esc_html__('Glad to see you in our store', 'yogastudio'));?></h6>
								
							</div>
						</div>	<!-- /.content_wrap -->
					</div>	<!-- /.contacts_wrap_inner -->
					<?php
				}

				// Main content wrapper
				yogastudio_open_wrapper('<div class="content">');
				?>