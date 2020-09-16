<?php
/**
 * Template Name: Retreat Past

 */

get_header();

date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d");

		 	
				$args = array(
					'post_type' => WP_TRAVEL_POST_TYPE,
					'post__not_in' => array( $post_id ),
					'posts_per_page' => $col_per_row,
				);
				$query = new WP_Query( $args );
			if ( $query->have_posts() ) { ?>
				
				<ul style="grid-template-columns:repeat(<?php esc_attr_e( $col_per_row, 'wp-travel') ?>, 1fr)" class="wp-travel-itinerary-list">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php
						$start_date = get_post_meta( get_the_ID(), 'wp_travel_start_date', true );
						if(strtotime($current_date) > strtotime($start_date)){

						?>
						<?php wp_travel_get_template_part( 'content', 'archive-itineraries-past'  ); ?>

						<?php
						}
						?>

					<?php endwhile; ?>
				</ul>
			<?php
			}


get_footer();
?>