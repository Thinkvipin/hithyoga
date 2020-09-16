<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */


// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'yogastudio_theme_setup' ) ) {
	add_action( 'yogastudio_action_before_init_theme', 'yogastudio_theme_setup', 1 );
	function yogastudio_theme_setup() {

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        // Enable support for Post Thumbnails
        add_theme_support( 'post-thumbnails' );

        // Custom header setup
        add_theme_support( 'custom-header', array('header-text'=>false));

        // Custom backgrounds setup
        add_theme_support( 'custom-background');

        // Supported posts formats
        add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') );

        // Autogenerate title tag
        add_theme_support('title-tag');

        // Add user menu
        add_theme_support('nav-menus');

        // WooCommerce Support
        add_theme_support( 'woocommerce' );

		// Register theme menus
		add_filter( 'yogastudio_filter_add_theme_menus',		'yogastudio_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'yogastudio_filter_add_theme_sidebars',	'yogastudio_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'yogastudio_filter_importer_options',		'yogastudio_set_importer_options' );

		// Add theme required plugins
		add_filter( 'yogastudio_filter_required_plugins',		'yogastudio_add_required_plugins' );

		// Add preloader styles
		add_filter('yogastudio_filter_add_styles_inline',		'yogastudio_head_add_page_preloader_styles');

				// Init theme after WP is created
		add_action( 'wp',									'yogastudio_core_init_theme' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 							'yogastudio_body_classes' );

		// Add data to the head and to the beginning of the body
		add_action('wp_head',								'yogastudio_head_add_page_meta', 1);
		add_action('before',								'yogastudio_body_add_gtm');
		add_action('before',								'yogastudio_body_add_toc');
		add_action('before',								'yogastudio_body_add_page_preloader');

		// Add data to the footer (priority 1, because priority 2 used for localize scripts)
		add_action('wp_footer',								'yogastudio_footer_add_views_counter', 1);
		add_action('wp_footer',								'yogastudio_footer_add_theme_customizer', 1);
		add_action('wp_footer',								'yogastudio_footer_add_scroll_to_top', 1);
		add_action('wp_footer',								'yogastudio_footer_add_custom_html', 1);
		add_action('wp_footer',								'yogastudio_footer_add_gtm2', 1);

		
		// Set list of the theme required plugins	
		yogastudio_storage_set('required_plugins', array(
			'booked',
			'essgrids',
			'instagram_widget',
			'revslider',
			'mailchimp',
			'trx_utils',
			'visual_composer',
			'woocommerce',
            'gdpr-compliance',
            'contact-form-7'
			)
		);

				// Set list of the theme required custom fonts from folder /css/font-faces
		// Attention! Font's folder must have name equal to the font's name
		yogastudio_storage_set('required_custom_fonts', array(
			'Amadeus'
			)
		);

		yogastudio_storage_set('list_skins', array(
			'default' => esc_html__('Less', 'yogastudio'),
			'default_no_less' => esc_html__('No Less', 'yogastudio')
			));

		
		yogastudio_storage_set('demo_data_url',  esc_url(yogastudio_get_protocol() . '://yogastudio.ancorathemes.com/demo/'));

        // Gutenberg support
        add_theme_support( 'align-wide' );
		
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'yogastudio_add_theme_menus' ) ) {
	function yogastudio_add_theme_menus($menus) {
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'yogastudio_add_theme_sidebars' ) ) {
	function yogastudio_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'yogastudio' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'yogastudio' ),
				'sidebar_left'	=> esc_html__( 'Left Sidebar', 'yogastudio' ),
				'sidebar_rightwoo'	=> esc_html__( 'Right WooCommerce Sidebar', 'yogastudio' )
				);
			if (function_exists('yogastudio_exists_woocommerce') && yogastudio_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'yogastudio' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme required plugins
if ( !function_exists( 'yogastudio_add_required_plugins' ) ) {
	//Handler of add_filter( 'yogastudio_filter_required_plugins',		'yogastudio_add_required_plugins' );
	function yogastudio_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__('ThemeREX Utilities', 'yogastudio'),
			'version'	=> '3.2',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> yogastudio_get_file_dir('plugins/install/trx_utils.zip'),
			'required' 	=> true
		);
		return $plugins;
	}
}

//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'yogastudio_importer_set_options' ) ) {
    add_filter( 'trx_utils_filter_importer_options', 'yogastudio_importer_set_options', 9 );
    function yogastudio_importer_set_options( $options=array() ) {
        if ( is_array( $options ) ) {
            // Save or not installer's messages to the log-file
            $options['debug'] = false;
            // Prepare demo data
            if ( is_dir( YOGASTUDIO_THEME_PATH . 'demo/' ) ) {
                $options['demo_url'] = YOGASTUDIO_THEME_PATH . 'demo/';
            } else {
                $options['demo_url'] = esc_url( yogastudio_get_protocol().'://demofiles.ancorathemes.com/yogastudio/' ); // Demo-site domain
            }

            // Required plugins
            $options['required_plugins'] =  array(
                'booked',
                'essential-grid',
                'revslider',
                'mailchimp-for-wp',
                'js_composer',
                'woocommerce'
            );

            $options['theme_slug'] = 'yogastudio';

            // Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
            // Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
            $options['regenerate_thumbnails'] = 3;
            // Default demo
            $options['files']['default']['title'] = esc_html__( 'Jacqueline Demo', 'yogastudio' );
            $options['files']['default']['domain_dev'] = esc_url(yogastudio_get_protocol().'://yogastudio.ancorathemes.com'); // Developers domain
            $options['files']['default']['domain_demo']= esc_url(yogastudio_get_protocol().'://yogastudio.ancorathemes.com'); // Demo-site domain

        }
        return $options;
    }
}


// Add data to the head and to the beginning of the body
//------------------------------------------------------------------------

// Add theme specified classes to the body tag
if ( !function_exists('yogastudio_body_classes') ) {
	//Handler of add_filter( 'body_class', 'yogastudio_body_classes' );
	function yogastudio_body_classes( $classes ) {

		$classes[] = 'yogastudio_body';
		$classes[] = 'body_style_' . trim(yogastudio_get_custom_option('body_style'));
		$classes[] = 'body_' . (yogastudio_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'theme_skin_' . trim(yogastudio_get_custom_option('theme_skin'));
		$classes[] = 'article_style_' . trim(yogastudio_get_custom_option('article_style'));
		
		$blog_style = yogastudio_get_custom_option(is_singular() && !yogastudio_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(yogastudio_get_template_name($blog_style));
		
		$body_scheme = yogastudio_get_custom_option('body_scheme');
		if (empty($body_scheme)  || yogastudio_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = yogastudio_get_custom_option('top_panel_position');
		if (!yogastudio_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = yogastudio_get_sidebar_class();

		if (yogastudio_get_custom_option('show_video_bg')=='yes' && (yogastudio_get_custom_option('video_bg_youtube_code')!='' || yogastudio_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (!yogastudio_param_is_off(yogastudio_get_theme_option('page_preloader')))
			$classes[] = 'preloader';

		return $classes;
	}
}

// Add page meta to the head
if (!function_exists('yogastudio_head_add_page_meta')) {
	//Handler of add_action('wp_head', 'yogastudio_head_add_page_meta', 1);
	function yogastudio_head_add_page_meta() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1<?php if (yogastudio_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=5'; ?>">
		<meta name="format-detection" content="telephone=no">
	
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
	}
}

// Add page preloader styles to the head
if (!function_exists('yogastudio_head_add_page_preloader_styles')) {
	//Handler of add_filter('yogastudio_filter_add_styles_inline', 'yogastudio_head_add_page_preloader_styles');
	function yogastudio_head_add_page_preloader_styles($css) {
		if (($preloader=yogastudio_get_theme_option('page_preloader'))!='none') {
			$image = yogastudio_get_theme_option('page_preloader_image');
			$bg_clr = yogastudio_get_scheme_color('bg_color');
			$link_clr = yogastudio_get_scheme_color('text_link');
			$css .= '
				#page_preloader {
					background-color: '. esc_attr($bg_clr) . ';'
					. ($preloader=='custom' && $image
						? 'background-image:url('.esc_url($image).');'
						: ''
						)
				    . '
				}
				.preloader_wrap > div {
					background-color: '.esc_attr($link_clr).';
				}';
		}
		return $css;
	}
}


// Add gtm code to the beginning of the body 
if (!function_exists('yogastudio_body_add_gtm')) {
	//Handler of add_action('before', 'yogastudio_body_add_gtm');
	function yogastudio_body_add_gtm() {
		yogastudio_show_layout(yogastudio_get_custom_option('gtm_code'));
	}
}

// Add TOC anchors to the beginning of the body 
if (!function_exists('yogastudio_body_add_toc')) {
	//Handler of add_action('before', 'yogastudio_body_add_toc');
	function yogastudio_body_add_toc() {
		// Add TOC items 'Home' and "To top"
		if (yogastudio_get_custom_option('menu_toc_home')=='yes' && function_exists('yogastudio_sc_anchor'))
			yogastudio_show_layout(yogastudio_sc_anchor(array(
				'id' => "toc_home",
				'title' => esc_html__('Home', 'yogastudio'),
				'description' => esc_html__('{{Return to Home}} - ||navigate to home page of the site', 'yogastudio'),
				'icon' => "icon-home",
				'separator' => "yes",
				'url' => esc_url(home_url('/'))
				)
			)); 
		if (yogastudio_get_custom_option('menu_toc_top')=='yes' && function_exists('yogastudio_sc_anchor'))
			yogastudio_show_layout(yogastudio_sc_anchor(array(
				'id' => "toc_top",
				'title' => esc_html__('To Top', 'yogastudio'),
				'description' => esc_html__('{{Back to top}} - ||scroll to top of the page', 'yogastudio'),
				'icon' => "icon-double-up",
				'separator' => "yes")
				)); 
	}
}

// Add page preloader to the beginning of the body
if (!function_exists('yogastudio_body_add_page_preloader')) {
	//Handler of add_action('before', 'yogastudio_body_add_page_preloader');
	function yogastudio_body_add_page_preloader() {
		if ( ($preloader=yogastudio_get_theme_option('page_preloader')) != 'none' && ( $preloader != 'custom' || ($image=yogastudio_get_theme_option('page_preloader_image')) != '')) {
			?><div id="page_preloader"><?php
				if ($preloader == 'circle') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_circ1"></div><div class="preloader_circ2"></div><div class="preloader_circ3"></div><div class="preloader_circ4"></div></div><?php
				} else if ($preloader == 'square') {
					?><div class="preloader_wrap preloader_<?php echo esc_attr($preloader); ?>"><div class="preloader_square1"></div><div class="preloader_square2"></div></div><?php
				}
			?></div><?php
		}
	}
}

// Add theme required plugins
if ( !function_exists( 'yogastudio_add_trx_utils' ) ) {
    add_filter( 'trx_utils_active', 'yogastudio_add_trx_utils' );
    function yogastudio_add_trx_utils($enable=true) {
        return true;
    }
}

// Return text for the Privacy Policy checkbox
if ( ! function_exists('yogastudio_get_privacy_text' ) ) {
    function yogastudio_get_privacy_text() {
        $page = get_option( 'wp_page_for_privacy_policy' );
        $privacy_text = yogastudio_get_theme_option( 'privacy_text' );
        return apply_filters( 'yogastudio_filter_privacy_text', wp_kses_post(
                $privacy_text
                . ( ! empty( $page ) && ! empty( $privacy_text )
                    // Translators: Add url to the Privacy Policy page
                    ? ' ' . sprintf( __( 'For further details on handling user data, see our %s', 'yogastudio' ),
                        '<a href="' . esc_url( get_permalink( $page ) ) . '" target="_blank">'
                        . __( 'Privacy Policy', 'yogastudio' )
                        . '</a>' )
                    : ''
                )
            )
        );
    }
}

// Return text for the "I agree ..." checkbox
if ( ! function_exists( 'yogastudio_trx_addons_privacy_text' ) ) {
    add_filter( 'trx_addons_filter_privacy_text', 'yogastudio_trx_addons_privacy_text' );
    function yogastudio_trx_addons_privacy_text( $text='' ) {
        return yogastudio_get_privacy_text();
    }
}

// Add data to the footer
//------------------------------------------------------------------------

// Add post/page views counter
if (!function_exists('yogastudio_footer_add_views_counter')) {
	//Handler of add_action('wp_footer', 'yogastudio_footer_add_views_counter');
	function yogastudio_footer_add_views_counter() {
		// Post/Page views counter
		get_template_part(yogastudio_get_file_slug('templates/_parts/views-counter.php'));
	}
}

// Add theme customizer
if (!function_exists('yogastudio_footer_add_theme_customizer')) {
	//Handler of add_action('wp_footer', 'yogastudio_footer_add_theme_customizer');
	function yogastudio_footer_add_theme_customizer() {
		// Front customizer
		if (yogastudio_get_custom_option('show_theme_customizer')=='yes') {
			require_once YOGASTUDIO_FW_PATH . 'core/core.customizer/front.customizer.php';
		}
	}
}

// Add scroll to top button
if (!function_exists('yogastudio_footer_add_scroll_to_top')) {
	//Handler of add_action('wp_footer', 'yogastudio_footer_add_scroll_to_top');
	function yogastudio_footer_add_scroll_to_top() {
		?><a href="#" class="scroll_to_top icon-up" title="<?php esc_attr_e('Scroll to top', 'yogastudio'); ?>"></a><?php
	}
}

// Add custom html
if (!function_exists('yogastudio_footer_add_custom_html')) {
	//Handler of add_action('wp_footer', 'yogastudio_footer_add_custom_html');
	function yogastudio_footer_add_custom_html() {
		?><div class="custom_html_section"><?php
			yogastudio_show_layout(yogastudio_get_custom_option('custom_code'));
		?></div><?php
	}
}

// Add gtm code
if (!function_exists('yogastudio_footer_add_gtm2')) {
	//Handler of add_action('wp_footer', 'yogastudio_footer_add_gtm2');
	function yogastudio_footer_add_gtm2() {
		yogastudio_show_layout(yogastudio_get_custom_option('gtm_code2'));
	}
}

/* Include framework core files
------------------------------------------------------------------- */
// If now is WP Heartbeat call - skip loading theme core files
require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';


function retreat(){
	$args = array(
	    'post_type' => 'itineraries',
	    'post_status' => 'publish',
	    'posts_per_page' => 5
	);
	$posts = new WP_Query( $args );
	if ( $posts -> have_posts() ) {
	    while ( $posts -> have_posts() ) {

	        the_title();
	        // Or your video player code here

	    }
	}
}


function getRefererPage( $form_tag )
{
if ( $form_tag['name'] == 'referer-page' ) {
$form_tag['values'][] = htmlspecialchars($_SERVER['HTTP_REFERER']);
}
return $form_tag;
}
if ( !is_admin() ) {
add_filter( 'wpcf7_form_tag', 'getRefererPage' );
}



function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
    return $parts[0];
}

add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );





?>