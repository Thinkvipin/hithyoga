<?php
/**
 * Itinerary Single Contnet Template
 *
 * This template can be overridden by copying it to yourtheme/wp-travel/content-single-itineraries.php.
 *
 * HOWEVER, on occasion wp-travel will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.wensolutions.com/document/template-structure/
 * @author      WenSolutions
 * @package     wp-travel/Templates
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $wp_travel_itinerary;
?>

<?php
do_action( 'wp_travel_before_single_itinerary', get_the_ID() );
if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

do_action( 'wp_travel_before_content_start');
?>

<div id="itinerary-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content entry-content">
		<div class="wp-travel trip-headline-wrapper clearfix">
			<style type="text/css">
				.wp-travel-feature-slide-content.left-plot,.wp-travel-feature-slide-content.right-plot{
					height: auto !important;
				}
				.carousel, .carousel .carousel-inner, .carousel .carousel-inner, .carousel .carousel-inner .item, .carousel .carousel-inner .item img{
					height: auto !important;
				}
			</style>
	        <div class="wp-travel-feature-slide-content featured-side-image left-plot" 	>
	            
	            <!-- <div class="banner-image-wrapper" style="background-image: url(<?php echo esc_url( wp_travel_get_post_thumbnail_url( get_the_ID(), 'large' ) ) ?>)"> -->
	            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="background:#000;">
						<?php //echo wp_kses( wp_travel_get_post_thumbnail( get_the_ID() ), wp_travel_allowed_html( array( 'img' )  ) ); ?>
						  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
						  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
						  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
						  <style type="text/css">
						  	.carousel, .carousel .carousel-inner,.carousel .carousel-inner, .carousel .carousel-inner .item,.carousel .carousel-inner .item img{
									height:100%;
								}
								.carousel .carousel-inner .item img{
									object-fit:contain;
									object-position:center;
								}
						  </style>
						<?php
						global $wp_travel_itinerary;
						$gallery_ids  = $wp_travel_itinerary->get_gallery_ids();
						$image_size = apply_filters( 'wp_travel_gallery_image', 'full' ); // previously using 'medium' before 1.9.0
	            		?>
						    <!-- Wrapper for slides -->
						    <div class="carousel-inner">
						    	<?php 
						    	$i = 0;
						    	foreach ( $gallery_ids as $gallery_id ) : 
						    	$i++;
						    	if($i == 1){
						    		?>
						    		<div class="item active">
								        <img alt="" src="<?php echo esc_url( wp_get_attachment_url( $gallery_id,'large' ) ); ?>" />
								      </div>

						    		<?php
						    	}
						    	else{
						    		?>
						    		<div class="item">
								        <img alt="" src="<?php echo esc_url( wp_get_attachment_url( $gallery_id,'large' ) ); ?>" />
								      </div>
						    		<?php
						    	}
						    	?>
						      	<?php endforeach; ?>
						    <!-- <div class="item">
						        <img alt="" src="<?php //echo esc_url( wp_get_attachment_url( $gallery_id ) ); ?>" />
						      </div> -->
						    <!-- Left and right controls -->
						    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
						      <span class="glyphicon glyphicon-chevron-left"></span>
						      <span class="sr-only">Previous</span>
						    </a>
						    <a class="right carousel-control" href="#myCarousel" data-slide="next">
						      <span class="glyphicon glyphicon-chevron-right"></span>
						      <span class="sr-only">Next</span>
						    </a>
						</div>

	        	</div>
				<?php // if ( $wp_travel_itinerary->is_sale_enabled() ) : ?>
				<?php if ( wp_travel_is_enable_sale( get_the_ID() ) ) : ?>

					<div class="wp-travel-offer">
						<span><?php esc_html_e( 'Offer', 'wp-travel' ) ?></span>
					</div>
					<?php endif; ?>
						<?php if ( $wp_travel_itinerary->has_multiple_images() ) : ?>
					<!-- <div class="wp-travel-view-gallery">
						<a class="top-view-gallery" href=""><?php //esc_html_e( 'View Gallery', 'wp-travel' ) ?></a>
					</div> -->
				<?php endif; ?>
	        </div>
	        <div class="wp-travel-feature-slide-content featured-detail-section right-plot" >
				<div class="right-plot-inner-wrap">
					<?php do_action( 'wp_travel_before_single_title', get_the_ID() ); ?>
					<?php wp_travel_do_deprecated_action( 'wp_tarvel_before_single_title', array( get_the_ID() ), '2.0.4', 'wp_travel_before_single_title' ); ?>
					<?php $show_title = apply_filters( 'wp_travel_show_single_page_title', true ); ?>
					<?php if ( $show_title ) : ?>
						<header class="entry-header">
							<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
						</header>
					<?php endif; ?>					
					<?php wp_travel_do_deprecated_action( 'wp_travel_after_single_title', array( get_the_ID() ), '2.0.4', 'wp_travel_single_trip_after_title' );  // @since 1.0.4 and deprecated in 2.0.4 ?>
					<?php do_action( 'wp_travel_single_trip_after_title', get_the_ID() ) ?>
					
				</div>
	        </div>
	        
	    </div>
		<?php
			wp_travel_do_deprecated_action( 'wp_travel_after_single_itinerary_header', array( get_the_ID() ), '2.0.4', 'wp_travel_single_trip_after_header' );  // @since 1.0.4 and deprecated in 2.0.4
			 do_action( 'wp_travel_single_trip_after_header', get_the_ID() );
		?>
	</div><!-- .summary -->
</div><!-- #itinerary-<?php the_ID(); ?> -->

<?php do_action( 'wp_travel_after_single_itinerary', get_the_ID() ); ?>


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
 echo do_shortcode( '[vc_row full_width="stretch_row"][vc_column][vc_empty_space height="40px"][trx_title type="2" align="center" color="#000"]Video Testimonials[/trx_title][trx_testimonials controls="side" align="center" cat="215" count="3"][/trx_testimonials][vc_empty_space][/vc_column][/vc_row]');
?>
