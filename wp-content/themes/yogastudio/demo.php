<?php
/*
Template Name: Demo
*/
get_header(); 

global $post;
$args = array( 'post_type' => 'testimonial', 'posts_per_page' => -1,'testimonial_group'=>'home-testimonials'); 
$attachments = get_posts( $args );
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



?>
<?php 
get_footer();

?>