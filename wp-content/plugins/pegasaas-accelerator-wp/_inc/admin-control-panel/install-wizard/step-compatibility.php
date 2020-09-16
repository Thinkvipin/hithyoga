<div class="row setup-content" id="step-compatibility" style="display: none;">
		      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
	  <h3>Compatibility Check</h3>
<p class='text-left'>Before we get into the installation further, we're just going to check to make sure we are compatible with your WordPress installation. </p>
<!--
		<h4>Third Party Plugin Compatibility</h4>
		<ul class='text-center'>
<?php $plugin_issues = PegasaasPluginCompatibility::get_caching_plugins_issues(); ?>
	<?php if (sizeof($plugin_issues['warning']) == 0 && sizeof($plugin_issues['critical']) == 0) { ?>
				<li>No Issues <i class='material-icons'>done</i></li>
	<?php } else { ?>
		 <?php foreach ($plugin_issues['critical'] as $issue) { ?>
		  <li class='conflict'><i class='material-icons'>error</i> <?php echo $issue['title']; ?> <a href='#' class='btn btn-xs btn-info more-link'>help</a>
			<div>
			<?php if (is_array($issue['advice'])) { foreach ($issue['advice'] as $advice) { print "<p>{$advice}</p>"; }} else { print "<p>".$issue['advice']."</p>"; }   ?>
			</div>
			</li>
		 <?php } ?>
		 <?php foreach ($plugin_issues['warning'] as $issue) { ?>
		  <li class='warning'><i class='material-icons'>warning</i> <?php echo $issue['title']; ?> </li>
		 <?php } ?>			
	<?php } ?>
		</ul>
		
		<h4>API Communication</h4>
		<ul class='text-center'>
		  <li>API Reachable</li>
		  <li>Optimization Test</li>
		  <li>Web Performance Scan Test</li>			
		</ul>	
		
		<h4>System Check</h4>
			<ul class='text-center'>
	<?php $system_issues = PegasaasPluginCompatibility::get_system_issues(); ?>
	<?php if (sizeof($system_issus['warning']) == 0 && sizeof($system_issues['critical']) == 0) { ?>
				<li class='pass'><i class='material-icons'>done</i> No Issues</li>
	<?php } else { ?>
		
		  <li>Filesystem Writable <span></span></li>	
	<?php } ?>
		</ul>
	
					
	-->
			<div id="compatibility-checker-progress">
			
			</div>
			
				  </div>
		</div>
			<div class='col-xs-12 btn-row'>
				  <a style='display: none' class="btn btn-primary nextBtn pull-right">Check Again <i class='fa fa-rotate-left'></i></button>
				  <button style='display: none' class="btn btn-primary nextBtn pull-right" type="button" >Continue <i class='fa fa-angle-right'></i></button>
				  <button class="btn btn-default backBtn pull-left" type="button" ><i class='fa fa-angle-left'></i> Back</button>
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
		jQuery(".more-link").on("click", function(e) {
			e.preventDefault();
			toggle_info(this);
		});
	</script>
</div>