<div class="row setup-content" id="step-api" style="display: none;">
      		<div class="col-md-10 col-md-offset-1">
        		<div class="col-md-12">
          		<h3><?php _e("API Key", "pegasaas-accelerator"); ?></h3>
		   		<?php if ($pegasaas->is_standard()) { ?>
				
		   		<p><?php _e("An API key is required to access the Pegasaas API to optimize your pages, fetch PageSpeed scores, and perform image optimization.", "pegasaas-accelerator"); ?></p>
			
				<ul class='api-key-type'>
			  		
				
					<li class='selected_key_type'><input class='material-selector' type='radio' id="api_key_type_quick" name='api_key_type' value='quick' checked> <label class='material-selector' for="api_key_type_quick">Request Guest API Key <span>(Take a Test Flight)</span></label>
			  			<a target='_blank' class='btn btn-info btn-compare pull-right' href='https://pegasaas.com/compare-products/?utm_source=pegasaas-accelerator-install&v=3' target='_blank'>compare plans <i class='fa fa-external-link'></i></a>
						<div id="api-request-email">
							<p>The <b>Guest API</b> allows you limited access to evaluate the Pegasaas Accelerator web performance optimization API.  
								<b>Guest API</b> accounts are limited to the number of pages that can have <b>premium</b> optimizations performed.  Full site coverage of standard web performance optimizations is included.</b></p>
							
						<div class="form-group <?php if (false && PegasaasAccelerator::$settings['reason'] != "" && $_POST['c'] == "register-api-key") { ?>has-error<?php } ?>">
								<?php if (false && PegasaasAccelerator::$settings['reason'] != "" && $_POST['c'] == "register-api-key") { ?>
								<p><?php echo PegasaasAccelerator::$settings['reason']; ?></p>
								<?php } ?>

								<div class='row'>
									<div class='col-sm-8'>
										<div class="input-group input-group-required">
  											<span class="input-group-addon"><i class="fa fa-envelope  fa-fw"></i></span>
				  							<input class='form-control' id="api_request_email_input_field" placeholder="E-Mail Address" type='email' value="<?php echo $api_request_email; ?>" name="api_request_email"/>
										</div>
										<p class='email-address-description'><b><?php echo get_option("admin_email"); ?></b> is the e-mail address in your WordPress settings.  You may use this e-mail address, or change it to any valid email address that you own.  A guest API account will be created for you.</p>
									</div>
									<div class='col-sm-4'>
										<div class="input-group input-group-optional">
  											<span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>
				  							<input class='form-control' placeholder="PROMO Code" type='text' value="<?php echo $api_promo_code; ?>" name="api_promo_code"/>
										</div>
									</div>									
								</div>

							</div>
						</div>
					</li>
					<li class=''><input class='material-selector' type='radio' id="api_key_type_pro"  name='api_key_type' value='pro' > <label class='material-selector' for="api_key_type_pro">Use Premium API Key <span>(Rise Above The Cloud)</span></label> 
						<a  target='_blank' class='btn btn-info pull-right btn-compare' href='https://pegasaas.com/compare-products/?utm_source=pegasaas-accelerator-install&v=3' target='_blank'>compare plans <i class='fa fa-external-link'></i></a>

				<?php } ?>
				<div id="pro-api-key-container" <?php if ($pegasaas->is_standard()) { ?> style='display:none;' <?php } ?>>
		  					<p>If you have not
							yet signed up for a Premium API Key, you can <a href='https://pegasaas.com/compare-products/?utm_source=pegasaas-accelerator-install&v=3' target='_blank'>signup here</a>.</p>
					 <p>If you already have an API Key, you can get it from your account at <a href='https://pegasaas.com/manage/?utm_source=pegasaas-accelerator-install' target='_blank'>pegasaas.com/manage</a>.  </p>
			
						
		
          
							<div class="form-group <?php if (PegasaasAccelerator::$settings['reason'] != "" && $_POST['c'] == "register-api-key") { ?>has-error<?php } ?>">
								<div class="input-group">
  									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
  									<input class="form-control" type="text" placeholder='API Key' id="api_key_input_field" <?php if (!$pegasaas->is_standard()) { ?> required <?php } ?> name='api_key' value='<?php echo $_POST['api_key']; ?>'>
								</div>
			
				 				<?php if (PegasaasAccelerator::$settings['reason'] != "" && $_POST['api_key'] != "") { ?>
								<div class='help-block' style='margin-left: 50px; font-size: 10px; font-weight: bold; '><?php echo PegasaasAccelerator::$settings['reason']; ?></div>
								<?php } ?>
          					</div>
						</div>
						<?php if ($pegasaas->is_standard()) { ?>
					</li>
				</ul>
				<script>
			  	jQuery(".api-key-type input[type=radio]").on("change", function() {
				  jQuery(this).parents("ul").find("li").removeClass("selected_key_type");
				  jQuery(this).parents("li").addClass("selected_key_type");
				 
				  if (jQuery(this).attr("value") == "pro") { 
				    jQuery("#pro-api-key-container").css("display", "block");
				    jQuery("#api-request-email").css("display", "none");
				    jQuery("#api_request_email_input_field").removeAttr("required");
					jQuery("#api_key_input_field").prop("required", true);
					
					  

					  
				  } else {
					 jQuery("#pro-api-key-container").css("display", "none"); 
					  jQuery("#api-request-email").css("display", "block");
					  
					  jQuery("#api_key_input_field").removeAttr("required");
					  jQuery("#api_request_email_input_field").prop("required", true);

				  }
			  	});
				</script>		
					<?php } ?>        
          		
        	</div>
      	</div>
			<div class='col-xs-12 btn-row'>
				  <button class="btn btn-primary nextBtn pull-right" type="button" >Continue <i class='fa fa-angle-right'></i></button>
				  <button class="btn btn-default backBtn pull-left" type="button" ><i class='fa fa-angle-left'></i> Back</button>
				</div>
    </div>