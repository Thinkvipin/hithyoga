<?php
/**
 * The template for displaying the footer.
 */

				yogastudio_close_wrapper();	// <!-- </.content> -->

				yogastudio_profiler_add_point(esc_html__('After Page content', 'yogastudio'));

				// Show main sidebar
				get_sidebar();

				if (yogastudio_get_custom_option('body_style')!='fullscreen') yogastudio_close_wrapper();	// <!-- </.content_wrap> -->
				?>

			</div>		<!-- </.page_content_wrap> -->
	
			<?php if ( is_active_sidebar( 'sidebar_custom_0' ) ) : ?>
				<ul id="sidebar">
					<?php dynamic_sidebar( 'sidebar_custom_0' ); ?>
				</ul>
			<?php endif; ?>


			<?php
			// Footer Testimonials stream
			if (yogastudio_get_custom_option('show_testimonials_in_footer')=='yes') { 
				$count = max(1, yogastudio_get_custom_option('testimonials_count'));
				$data = yogastudio_sc_testimonials(array('count'=>$count));
				if ($data) {
					?>
					<footer class="testimonials_wrap sc_section scheme_<?php echo esc_attr(yogastudio_get_custom_option('testimonials_scheme')); ?>">
						<div class="testimonials_wrap_inner sc_section_inner sc_section_overlay">
							<div class="content_wrap"><?php yogastudio_show_layout($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}
			
			


			// Footer Twitter stream
			if (yogastudio_get_custom_option('show_twitter_in_footer')=='yes' && function_exists('yogastudio_sc_twitter')) {
				$count = max(1, yogastudio_get_custom_option('twitter_count'));
				$data = yogastudio_sc_twitter(array('count'=>$count));
				if ($data) {
					?>
					<footer class="twitter_wrap sc_section scheme_<?php echo esc_attr(yogastudio_get_custom_option('twitter_scheme')); ?>">
						<div class="twitter_wrap_inner sc_section_inner sc_section_overlay">
							<div class="content_wrap"><?php yogastudio_show_layout($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}

			// Footer contacts
			if (yogastudio_get_custom_option('show_contacts_in_footer')=='yes') { 
				$address_1 = yogastudio_get_theme_option('contact_address_1');
				$phone = yogastudio_get_theme_option('contact_phone');
				$email = yogastudio_get_theme_option('contact_email');
				if (!empty($address_1) || !empty($address_2) || !empty($phone) || !empty($fax)) {
					?>
					<footer class="contacts_wrap scheme_<?php echo esc_attr(yogastudio_get_custom_option('contacts_scheme')); ?>">
						<div class="contacts_wrap_inner">
							<div class="content_wrap">
								<div class="contacts_address columns_wrap">
									<div class="column-1_3"><address class="address_address">
										<span class="icon icon-home"></span>
										<div class="contact_title"><?php echo esc_html__('Address:', 'yogastudio') ?></div>
										<span class="contact_item address"><?php if (!empty($address_1)) echo esc_attr($address_1); ?></span>
									</address></div><div class="column-1_3">
									<address class="address_phone">
										<span class="icon icon-phone"></span>
										<div class="contact_title"><?php echo esc_html__('Phone:', 'yogastudio') ?></div>
										<span class="contact_item phone">
                                            <a href="tel:<?php yogastudio_show_layout($phone); ?>">
                                            <?php if (!empty($phone)) echo esc_attr($phone); ?></a></span>
									</address></div><div class="column-1_3">
									<address class="address_email">
										<span class="icon icon-mail"></span>
										<div class="contact_title"><?php echo esc_html__('Email:', 'yogastudio') ?></div>
										<span class="contact_item mail">
                                            <a href="mailto:<?php yogastudio_show_layout($email); ?>">
                                            <?php if (!empty($email)) echo esc_attr($email); ?></a></span>
									</address></div>
								</div>
							</div>	<!-- /.content_wrap -->
						</div>	<!-- /.contacts_wrap_inner -->
					</footer>	<!-- /.contacts_wrap -->
					<?php
				}
			}
			

			// Google map
			if ( yogastudio_get_custom_option('show_googlemap')=='yes' && function_exists('yogastudio_sc_googlemap')) {
				$map_address = yogastudio_get_custom_option('googlemap_address');
				$map_latlng  = yogastudio_get_custom_option('googlemap_latlng');
				$map_zoom    = yogastudio_get_custom_option('googlemap_zoom');
				$map_style   = yogastudio_get_custom_option('googlemap_style');
				$map_height  = yogastudio_get_custom_option('googlemap_height');
				if (!empty($map_address) || !empty($map_latlng)) {
					$args = array();
					if (!empty($map_style))		$args['style'] = esc_attr($map_style);
					if (!empty($map_zoom))		$args['zoom'] = esc_attr($map_zoom);
					if (!empty($map_height))	$args['height'] = esc_attr($map_height);
// 					yogastudio_show_layout(yogastudio_sc_googlemap($args));
				}
			}

			// Footer sidebar
			$footer_show  = yogastudio_get_custom_option('show_sidebar_footer');
			$sidebar_name = yogastudio_get_custom_option('sidebar_footer');
			if (!yogastudio_param_is_off($footer_show) && is_active_sidebar($sidebar_name)) { 
				yogastudio_storage_set('current_sidebar', 'footer');
				?>
				<footer class="footer_wrap widget_area scheme_<?php echo esc_attr(yogastudio_get_custom_option('sidebar_footer_scheme')); ?>">
					<div class="footer_wrap_inner widget_area_inner">
						<div class="content_wrap">
							<div class="columns_wrap"><?php
								ob_start();
								do_action( 'before_sidebar' );
								if ( !dynamic_sidebar($sidebar_name) ) {
								// Put here html if user no set widgets in sidebar
								}
								do_action( 'after_sidebar' );
								$out = ob_get_contents();
								ob_end_clean();
								yogastudio_show_layout(chop(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out)));
								?></div>	<!-- /.columns_wrap -->
							</div>	<!-- /.content_wrap -->
						</div>	<!-- /.footer_wrap_inner -->
					</footer>	<!-- /.footer_wrap -->
					<?php
				}

			// Copyright area
				$copyright_style = yogastudio_get_custom_option('show_copyright_in_footer');
				if (!yogastudio_param_is_off($copyright_style)) {
					?> 
					<div class="copyright_wrap copyright_style_<?php echo esc_attr($copyright_style); ?>  scheme_<?php echo esc_attr(yogastudio_get_custom_option('copyright_scheme')); ?>">
						<div class="copyright_wrap_inner">
							<div class="content_wrap">
								<?php yogastudio_show_logo(false, false, true, false, true, false); ?>
								<div class="copyright_text"><?php yogastudio_show_layout(do_shortcode(str_replace(array('{{Y}}', '{Y}'), date('Y'), yogastudio_get_custom_option('footer_copyright')))); ?></div>
								<?php
								if ($copyright_style == 'menu') {
									if (($menu = yogastudio_get_nav_menu('menu_footer'))!='') {
										yogastudio_show_layout($menu);
									}
								} else if ($copyright_style == 'socials' && function_exists('yogastudio_sc_socials')) {
									yogastudio_show_layout(yogastudio_sc_socials(array('size'=>"tiny")));
								}
								?>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div>	<!-- /.page_wrap -->

			</div>		<!-- /.body_wrap -->

		<?php wp_footer(); ?>


		<!-- Modal -->
          <div class="modal fade popup-modal" id="popup-modal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Subscribe to get free health updated from Hith Yoga</h4>
                </div>
                <div class="modal-body">
                    <?php echo do_shortcode('[email-subscribers-form id="1"]')?>
                </div>
                <!--<div class="modal-footer">-->
                <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--</div>-->
              </div>
              
            </div>
          </div>
          
<div class="ccw_plugin chatbot" style="bottom:20px; left:20px;">
    <!-- style 9  logo -->
    <div class="ccw_style9 animated no-animation ccw-no-hover-an">
        <a target="_blank" href="https://web.whatsapp.com/send?phone=919650577578&amp;text=I'd like chat with you" class="img-icon-a nofocus">   
            <img id="style-9" data-ccw="style-9" style="height: 48px;" alt="WhatsApp chat" data-src="https://www.hithyoga.com/wp-content/uploads/2020/06/whatsapp-logo.png" class="img-icon ccw-analytics" src="https://www.hithyoga.com/wp-content/uploads/2020/06/whatsapp-logo.png">
            
        </a>
    </div>
</div>
<style>
    .chatbot {
    position: fixed;
    z-index: 99999999;
    bottom: 20px;
    left: 20px;
}
div.ccw_plugin, .inline {
    display: inline;
}
.ccw_plugin .animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}
.animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    visibility: visible;
}
.mg-icon.ccw-analytics{
	height:48px;
}
.ccw_plugin .animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}
</style>
          

<script>
	jQuery(document).ready(function(){

		jQuery("#fixed-button").click(function(event) {
		    event.preventDefault();
		    jQuery('html, body').animate({
		        scrollTop: jQuery('#fixed').offset().top - 220 
		    });
		  });
		jQuery("input[type='checkbox']").on('click',function(){
			var other = jQuery(this).val();
			if(other == 'others'){
				if(jQuery(this).prop('checked') == true){

					jQuery("form #hidden").css('display','block');
				}else{
					jQuery("form #hidden").css('display','none');
				}
			}
			

		});
		jQuery(".menu-search.search.icon-search").click(function(){
		    jQuery(".menu-search-box").fadeIn(100);
		});
		jQuery(".menu-search-cross").click(function(){
		    jQuery(".menu-search-box").fadeOut(100);
		})
		
        
// 		jQuery(window).load(function(){
//           setTimeout(function(){
//               jQuery('#popup-modal').fadeIn(1000);
//           }, 3000);
//         });
        
        jQuery("#categories-6 ul").append("<div><a href='https://www.hithyoga.com/category/' target='_blank'>All Category</a></div>");

	});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.3.0/jquery.cookie.js" defer></script>
    <script>
        jQuery(document).ready(function() {
            
            jQuery("button.close").click(function(){
                jQuery('#popup-modal').fadeOut(400);
                jQuery.cookie('dialogShown', true); 
            });
            var dialogShown = jQuery.cookie('dialogShown');
            var loggedin = jQuery.cookie('is-logged-in');
            if(dialogShown == null){
            // if (dialogShown != true && loggedin != 1) {
                jQuery(window).load(function(){
                    setTimeout(function(){
                        jQuery('#popup-modal').fadeIn(1000);
                    }, 3000);
                });
                // console.log("dialog No cookie");
            }
            else {
                jQuery("#popup-modal").hide();
                // console.log("dialog yes cookie");
            }
            if(loggedin != null){
                jQuery("#popup-modal").hide();
            }
        }); 
    
      function init() {
		var vidDefer = document.getElementsByTagName('iframe');
		for (var i=0; i<vidDefer.length; i++) {
		if(vidDefer[i].getAttribute('data-src')) {
		vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
		} } }
		window.onload = init;
        
        
        
        
    </script>
	</body>
	</html>