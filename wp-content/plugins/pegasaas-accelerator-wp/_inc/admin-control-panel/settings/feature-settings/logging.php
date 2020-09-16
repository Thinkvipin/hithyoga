	<ul>
						
						<li class='logging-subsystem-header'>API</li>
 							<li <?php if ($feature_settings['log_api'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_api' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_api'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; API - General
						</li>						
						<li <?php if ($feature_settings['log_submit_scans'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_submit_scans' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_submit_scans'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; Submit PageSpeed Scans
						  </li>
						  <li <?php if ($feature_settings['log_submit_benchmark_scans'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_submit_benchmark_scans' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_submit_benchmark_scans'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; Submit Benchmark Scans
						  </li>	
						  <li <?php if ($feature_settings['log_process_pagespeed_scans'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_process_pagespeed_scans' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_process_pagespeed_scans'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; Process PageSpeed Scans
						  </li>
						  <li <?php if ($feature_settings['log_process_benchmark_scans'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_process_benchmark_scans' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_process_benchmark_scans'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; Process Benchmark Scans
						  </li>							
						
					  	<li class='logging-subsystem-header'>Caching</li>
					  	<li <?php if ($feature_settings['log_caching'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_caching' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_caching'] == 1) { print "checked"; } ?> />
							</form> 
						  &nbsp; Page Caching
					  	</li>
						<li <?php if ($feature_settings['log_cloudflare'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_cloudflare' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_cloudflare'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; Cloudflare
						</li>
 						<li <?php if ($feature_seattings['log_varnish'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_varnish' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_varnish'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; Varnish
						</li>						
					  	<li <?php if ($feature_settings['log_file_permissions'] != 1) { print "class='feature-disabled'"; } ?>>
							<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
								<input type="hidden" name="c" value="toggle-local-setting">
								<input type='hidden' name='f' value='logging_log_file_permissions' />
								<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_file_permissions'] == 1) { print "checked"; } ?> />
							</form> 
							  &nbsp; File Permissions
					  	</li>
						
							<li class='logging-subsystem-header'>CRON</li>
 						<li <?php if ($feature_settings['log_pickup_queued_requests'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_pickup_queued_requests' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_pickup_queued_requests'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Pickup Queued Requests
						</li>
 						<li <?php if ($feature_settings['log_auto_crawl'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_auto_crawl' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_auto_crawl'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Auto Crawl
						</li>
							<li <?php if ($feature_settings['log_auto_clear_page_cache'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_auto_clear_page_cache' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_auto_clear_page_cache'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Auto Clear Page Cache
						</li>						
 
					  <li class='logging-subsystem-header'>Misc</li>
						<li <?php if ($feature_settings['log_database'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_database' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_database'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Database
						</li>							
						<li <?php if ($feature_settings['log_script_execution_benchmarks'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_script_execution_benchmarks' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_script_execution_benchmarks'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Script Execution Benchmarks
						</li>	
					  <li <?php if ($feature_settings['log_server_info'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_server_info' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_server_info'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Server Info
					  </li>
						
					  <li <?php if ($feature_settings['log_semaphores'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_semaphores' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_semaphores'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Semaphores
						</li>
						<li <?php if ($feature_settings['log_data_structures'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_data_structures' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_data_structures'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Data Structures
						</li>		
					  <li class='logging-subsystem-header'>Optimization</li>
						<li <?php if ($feature_settings['log_html_conditioning'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_html_conditioning' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_html_conditioning'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; HTML Conditioning
						</li>
					  <li <?php if ($feature_settings['log_image_data'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_image_data' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['image_data'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Image Data
						</li>	
						<li <?php if ($feature_settings['log_cpcss'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_cpcss' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_cpcss'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Critical CSS
						</li>				
		
						<li class='logging-subsystem-header'>PHP Errors</li>
						<li <?php if ($feature_settings['log_pegasaas_only'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_pegasaas_only' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_pegasaas_only'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Only Log Error/Messages Related to Pegasaas Plugin
						</li>
						<li <?php if ($feature_settings['log_E_DEPRECATED'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_E_DEPRECATED' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_E_DEPRECATED'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Deprecated Functionality
						</li>
					  	<li <?php if ($feature_settings['log_E_NOTICE'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_E_NOTICE' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_E_NOTICE'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Notices
						</li>
						<li <?php if ($feature_settings['log_E_WARNING'] != 1) { print "class='feature-disabled'"; } ?>>
						<form method="post" class='feature-toggle-switch pull-left' target="hidden-frame">
							<input type="hidden" name="c" value="toggle-local-setting">
							<input type='hidden' name='f' value='logging_log_E_WARNING' />
							<input type='checkbox' class='js-switch js-switch-small' <?php if ($feature_settings['log_E_WARNING'] == 1) { print "checked"; } ?> />
						</form> 
						  &nbsp; Warnings
						</li>

						

						
					</ul>
				<br/>
						
						
				<form method="post" style="display: inline-block" target="hidden-frame">
					<input type="hidden" name="c" value="reset-log-file">
					<button type='submit' class='btn btn-primary'>Clear Log File</button>
			</form> 

			  <form method="get" style="display: inline-block" target="_blank" action="<?php echo PEGASAAS_ACCELERATOR_URL."log.txt"; ?>">

					<button type='submit' class='btn btn-primary'>View Log File</button>
			</form> 