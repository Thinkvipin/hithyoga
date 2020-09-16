<div class="row setup-content" id="step-start" >
	<div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
			<div id="checking-compatibility" class='checking'>
			
			</div>
			
	  		<h3 class='compatibility-good' style='display: none;'>Welcome!</h3>
			<p class='compatibility-good' style='display: none;'>This setup wizard is designed to get the Pegasaas Accelerator WP plugin initialized and automatically optimizing your pages for you in just a few short steps.</p>
			<p class='compatibility-good' style='display: none;'>Optimizations happen in the background, while you continue working with the rest of your site.  If at any time you want to revert back to your original un-optimized site, simply
			enable "diagnostic" mode, or disable the plugin.</p>
			

			
			<div class='text-center btn-row'>
				  <button id="check-button" disabled class="btn btn-primary" type="button"></button>
				  <button id="start-button" class="btn btn-primary nextBtn hidden" type="button">Start Setup</button>
			</div>
		 </div>
	</div>							
</div>  

<script>
function toggle_info(link) {
		 
		  var div = jQuery(link).parents("li").find("div");
		  if (jQuery(div).hasClass("more")) {
			  jQuery(div).removeClass("more");
		  } else {
			jQuery(div).addClass("more");
		  }
	  }
		
	  function check_compatibility() {
		  jQuery("#checking-compatibility").html("");
		  jQuery("#checking-compatibility").addClass("checking");
		  jQuery("#check-button").html("Checking Compatibility <i class='svg-icons svg-icon-14 svg-puff'></i>");
		  jQuery("#check-button").attr("disabled", "disabled");
		  
		jQuery.post(ajaxurl,
				{ 'action': 'pegasaas_check_compatibility', 'api_key': jQuery("#pegasaas-api-key").val() },
				function(data) {
					jQuery("#checking-compatibility").removeClass("checking");
			
					if (data['status'] == 0) {
						// warning
						jQuery("#checking-compatibility").html(data['html']);

						jQuery("#check-button").removeAttr("disabled");
						jQuery("#check-button").html("Check Again");
						jQuery("#checking-compatibility").html(data['html']);
					} else if (data['status'] == 1) {
						// all good
						
						jQuery("#start-button").removeClass("hidden");
						
						jQuery("#check-button").removeAttr("disabled");
						jQuery("#check-button").addClass("hidden");
						setTimeout("compatibility_fade_out()", 2500);
						
						jQuery("#checking-compatibility").html(data['html']);
						
					} else if (data['status'] == -1) {
						// have critical issues
						jQuery("#check-button").removeAttr("disabled");
						jQuery("#check-button").html("Check Again");
						jQuery("#checking-compatibility").html(data['html']);
						

					} else {
						jQuery("#check-button").removeAttr("disabled");
						jQuery("#check-button").html("Check Again");
						jQuery("#checking-compatibility").html("<h3 class='text-center'>Oops</h3><p class='text-center'>It looks like we encountered an error that we haven't seen before. Uhh... well this is embarassing.  Could you please hit the 'check again' button?  If that doesn't work, please shoot our <a href='?page=pegasaas-accelerator&skip=to-support'>support team</a> a message.");
						
					}
			
			 jQuery(".more-link").on("click", function(e) {
				 console.log("click");
			e.preventDefault();
			toggle_info(this);
		});
				}, "json");
		 
	  }	
	jQuery("#check-button").click(function() { check_compatibility() });
	check_compatibility();
	
	function compatibility_fade_out() {
		jQuery("#checking-compatibility").fadeOut(1000,function() {
			jQuery(".compatibility-good").fadeIn();
		});
	}
	
</script>
<style>

</style>