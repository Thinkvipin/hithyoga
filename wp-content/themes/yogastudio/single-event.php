<?php
/**
 * Single post
 */
get_header(); 

$single_style = yogastudio_storage_get('single_style');
if (empty($single_style)) $single_style = yogastudio_get_custom_option('single_style');

while ( have_posts() ) { the_post();
	yogastudio_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !yogastudio_param_is_off(yogastudio_get_custom_option('show_sidebar_main')),
			'content' => yogastudio_get_template_property($single_style, 'need_content'),
			'terms_list' => yogastudio_get_template_property($single_style, 'need_terms')
		)
	);
}
?>
<style type="text/css">
	.vc_custom_1452607657927{
	background-image: url(http://yogastudio.ancorathemes.com/wp-content/uploads/2015/11/bg1.jpg?id=2388) !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
	}
</style>

<?php
 echo do_shortcode( '[vc_row full_width="stretch_row" css=".vc_custom_1452607657927{background-image: url(http://yogastudio.ancorathemes.com/wp-content/uploads/2015/11/bg1.jpg?id=2388) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][vc_empty_space height="40px"][trx_title type="2" align="center" color="#ffffff"]Testimonials[/trx_title][trx_testimonials controls="side" align="center" cat="211" count="16"][/trx_testimonials][vc_empty_space][/vc_column][/vc_row]');

 echo do_shortcode( '[vc_row full_width="stretch_row"][vc_column][vc_empty_space height="40px"][trx_title type="2" align="center" color="#000"]Video Testimonials[/trx_title][trx_testimonials controls="side" align="center" cat="215" count="3"][/trx_testimonials][vc_empty_space][/vc_column][/vc_row]');

get_footer();
?>