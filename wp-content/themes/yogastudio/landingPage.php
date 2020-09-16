<?php
/**
 * Template Name: Landing Page

 */

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


?>