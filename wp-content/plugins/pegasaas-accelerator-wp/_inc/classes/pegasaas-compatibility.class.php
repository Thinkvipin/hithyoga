<?php
class PegasaasPluginCompatibility {
	
	
	function __construct() {
	
	}

	static function get_caching_plugins_issues() {
		global $pegasaas;
		$issues = array();
		$issues['critical'] = array();
		$issues['warning']  = array();
		
		if ($pegasaas->cache->pantheon_exists()  && !$pegasaas->utils->does_plugin_exists_and_active("pantheon-advanced-page-cache")) { 
			$issues['critical'][] = array("title" => "'Pantheon Advanced Page Cache' Detected",
										  "advice" => "To allow Pegasaas Accelerator to automatically clear related page caches when you update content, you will need to Install and Activate the <i>Pantheon Advanced Page Caching</i> plugin.  Install <a href='plugin-install.php?s=pantheon+advanced+page+cache&tab=search&type=term&action=pantheon-load-infobox'>Pantheon Advanced Page Cache</a>.");
		}
		
		if ($pegasaas->utils->does_plugin_exists_and_active("wp-rocket")) {
			$issues['warning'][] = array("title" => "'WP Rocket' Caching Plugin Detected",
										 "advice" => "We recommend that you disable 'WP Rocket' as you should not operate more than one caching plugin at a time.");
		}
		if ($pegasaas->utils->does_plugin_exists_and_active("wp-super-cache")) {
			$issues['critical'][] = array("title" => "'WP Super Cache' Caching Plugin Detected",
										 "advice" => "Please disable 'WP Super Cache' as you should not operate more than one caching plugin at a time.");
		}		

		if ($pegasaas->utils->does_plugin_exists_and_active("wp-fastest-cache")) {
			$issues['critical'][] = array("title" => "'WP Fastest Cache' Caching Plugin Detected",
										 "advice" => "Please disable 'WP Fastest Cache' as you should not operate more than one caching plugin at a time.");
		}
		
		if ($pegasaas->utils->does_plugin_exists_and_active("litespeed-cache")) {
			$issues['warning'][] = array("title" => "'Litespeed Cache' Caching Plugin Detected",
										 "advice" => "Please disable 'Litespeed Cache' as you should not operate more than one caching plugin at a time.");
		}

		if ($pegasaas->utils->does_plugin_exists_and_active("hyper-cache")) {
			$issues['critical'][] = array("title" => "'Hyper Cache' Caching Plugin Detected",
										 "advice" => "Please disable 'Hyper Cache' as you should not operate more than one caching plugin at a time.");
		}

		if ($pegasaas->utils->does_plugin_exists_and_active("comet-cache")) {
			$issues['critical'][] = array("title" => "'Comet Cache' Caching Plugin Deteced",
										 "advice" => "Please disable 'Comet Cache' as you should not operate more than one caching plugin at a time.");
		}	
		
		if ($pegasaas->utils->does_plugin_exists_and_active("comet-cache")) {
			$issues['critical'][] = array("title" => "'W3 Total Cache' Caching Plugin Detected",
										 "advice" => "Please disable 'W3 Total Cache' as you should not operate more than one caching plugin at a time.");
		}
		
		if ($pegasaas->utils->does_plugin_exists_and_active("page-optimize")) {
			$issues['critical'][] = array("title" => "'Page Optimize' Plugin Detected",
										 "advice" => "Please disable 'Page Optimize' as you should not operate more than one minification/concatination plugin at a time.");
		}		
		
		return $issues;
	}
	
	static function get_api_issues() {
		global $pegasaas;
		$issues = array();
		$issues['critical'] = array();
		$issues['warning']  = array();	
		$issues['passed'] = array();
		
		$api_connection_ok = false;
		
		// test api reachable
		$start_time = time();
		$response = $pegasaas->api->post(array("command" => "test-api-response"), array('timeout' => 30, 'blocking' => true));
		if ($response == "") {
			$issues['critical'][] = array("title" => "API Unrechable",
										 "advice" => "It may be that our API servers are busy.  Please try again.  If the problem persists, please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a>.");

		} else { 
			
			$data = json_decode($response, true);
			
			if ($data['status'] == 1) {
				$end_time = time();
				if ($end_time - $start_time > 30) {
					$issues['warning'][] = array("title" => "API Connection Slow",
										 "advice" => "It may be that our API servers are busy.  You can try again, however if the problem persists, please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a>.");
				} else {
					$api_connection_ok = true;
					$issues['pass'][] = array('title' => 'API Connection OK');
				}
			} else {
				$issues['critical'][] = array("title" => "API Response Not Correct",
										 "advice" => "It may be that our API servers are busy.  Please try again.  If the problem persists, please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a>.");
				
			}
			
		}
		
		if ($api_connection_ok) {
			// test optimization test
			$response = $pegasaas->utils->touch_url("/", array("return-data" => true, "optimization-test" => true, "blocking" => true, "timeout" => 30)); 
			
			
			if ($response) {
				if ($response == "1") {
					$issues['pass'][] = array('title' => 'Test Submission OK');
				} else {
					if (substr($response, 0,1) == 1) {
						$issues['critical'][] = array("title" => "Test Submission Failed",
												  "data" => $response,
										 "advice" => "It seems as though your web server was able to submit the test submission, however there appears to be something interfering with the response.  This could be due to a firewall, or a server side caching system.  Please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> so that we may investigate.");
					
					} else {
						$issues['critical'][] = array("title" => "Test Submission Blocked",
												  "data" => $response,
										 		  "advice" => "It seems as though your web server has blocked our optimization from submitting.  This could be due to a firewall, or a server side caching system.  Please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> so that we may investigate.");
					}
				}
			   
			} else {
				$issues['critical'][] = array("title" => "Test Submission Not Completed - Web Server Too Slow",
											  "data" => $response,
											  
										 "advice" => "It seems as though your web server failed to complete the test submission in under five seconds.  This indicates that your web server, given the mix of plugins installed in your site, would be unsuited to communicating with an outside API.  If you believe this diagnosis is in error, and you woud like us to investigate further, please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> so that we may investigate.");
				
			}
			
			$location = $pegasaas->utils->get_wp_location();
			$post_fields = array();
			$post_fields['command'] = "test-optimization-push-fetch";
			//$post_fields['callback_url'] 		= ($_SERVER['HTTPS'] == "on" ? "https://" : "http://").$pegasaas->utils->get_http_host().$location."/wp-admin/admin-ajax.php?wp_rid=".$resource_id."&request_id={$request_id}"; 
			$post_fields['callback_url']   		= admin_url( 'admin-ajax.php' )."?wp_rid=".$resource_id."&request_id={$request_id}"; 

			
			$test_communication_passed = false;
			
			// test optimization push fetch
			$response = $pegasaas->api->post($post_fields, array('timeout' => 45, 'blocking' => true));
			
			if ($response == "") {
				$issues['critical'][] = array("title" => "WordPress Plugin Unreachable By API",
											 "advice" => "It appears as though our API cannot communicate with the 'wp-admin/admin-ajax.php' endpoint.   Please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> so that we can investigate.");

			} else { 
				$data = json_decode($response, true);
				
				if ($data['status'] == 1) {
					
					$api_connection_ok = true;
					$issues['pass'][] = array('title' => 'API Communication Test Pass');
		 			$test_communication_passed = true;
				} else {
					$issues['critical'][] = array("title" => "API Communication Test Failed",
											 "advice" => "It seems as though there is something block our API from returning optimizations to the plugin.  Please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> and report that the system returned status '{$data['status']}'.");

				}

			}
			if ($test_communication_passed) {
				$location = $pegasaas->utils->get_wp_location();
				$post_fields = array();
				$post_fields['command'] 	 = "test-webperf-push";
			//	$post_fields['callback_url'] = ($_SERVER['HTTPS'] == "on" ? "https://" : "http://").$pegasaas->utils->get_http_host().$location."/wp-admin/admin-ajax.php?wp_rid=".$resource_id."&request_id={$request_id}"; 
				$post_fields['callback_url'] 		= admin_url( 'admin-ajax.php' )."?wp_rid=".$resource_id."&request_id={$request_id}"; 


				// test optimization push fetch
				$response = $pegasaas->api->post($post_fields, array('timeout' => 45, 'blocking' => true)); 

				if ($response == "") {
					$issues['critical'][] = array("title" => "WordPress Plugin Unreachable By API (Test #2)",
												 "advice" => "It appears as though our API cannot communicate with the 'wp-admin/admin-ajax.php' endpoint.   Please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> so that we can investigate.");

				} else { 
					$data = json_decode($response, true);

					if ($data['status'] == 1) { 

						$api_connection_ok = true;
						$issues['pass'][] = array('title' => 'API Communication Test #2 Pass');

					} else {
						$issues['critical'][] = array("title" => "API Communication Test #2 Failed",
												 "advice" => "It seems as though there is something block our API from returning optimizations to the plugin.  Please <a href='?page=pegasaas-accelerator&skip=to-support'>contact support</a> and report that the system returned status '{$data['status']}'.");

					}

				}	
			}
			
		}
		
		
		
		return $issues;
		
	}
	
	static function get_system_issues() {
		global $pegasaas;
		$issues = array();
		$issues['critical'] = array();
		$issues['warning']  = array();	
		$issues['passed']   = array();	
		
		// test memory
		 if (!PegasaasUtils::memory_within_limits()) {
			$issues['critical'][] = array("title" => "PHP Memory Limits",
										 "advice" => "Your PHP memory usage is nearing the defined upper limit of ".ini_get('memory_limit').".  Please increase the 'memory_limit' setting in your PHP settings to ".PegasaasUtils::get_next_memory_limit().".");
		 } else {
			 $issues['passed'][] = array("title" => "PHP Memory Limit OK");
		 }
		
		// test htaccess writable
		if (!$pegasaas->is_htaccess_writable()) {
			$issues['critical'][] = array("title" => ".htaccess file is not writable",
										 "advice" => array("Please ensure the .htaccess file, found in the website root directory, is writable (at least until installation is complete).",
														   "Pegasaas needs to write to this file each time a setting that requires .htaccess rule changes is enabled/disabled, or if the plugin itself is disabled/enabled.",
														   "If you do not know how to change the permissions on the .htaccess file, <a rel='noopener noreferrer' target='_blank' href='https://pegasaas.com/knowledge-base/htaccess-file-is-not-writable/'>click here</a>."));
														  

		} 
		
		if (!$pegasaas->is_cache_writable()) {
			$issues['critical'][] = array("title" => "wp-content/pegasaas-cache is not writable",
										 "advice" => "Pegasaas automatically creates a folder that it uses for caching called 'pegasaas-cache' in the 'wp-content' folder.  Please ensure that either the 'wp-content' folder is writable, or that you have
			created a folder called 'pegasaas-cache' within the 'wp-content' folder with write permissions.");
														  

		} else {
			 $issues['passed'][] = array("title" => "Cache Folder Writable");
		 }

		
		if (!$pegasaas->is_log_writable()) {
			$issues['critical'][] = array("title" => str_replace($pegasaas->get_home_url(), "", PEGASAAS_ACCELERATOR_URL)."log.txt is not writable",
										 "advice" => "In order to troubleshoot any issues, the log.txt file should be writable.");
														  

		} else {
			 $issues['passed'][] = array("title" => "Log File Writable");
		}	
		
		
		return $issues;
		
	}	
	
	
	static function bunny_cdn_ob_finish($buffer) {
		
		$options = BunnyCDN::getOptions();
		if(strlen(trim($options["cdn_domain_name"])) > 0) {
			$rewriter = new PegasaasBunnyCDNFilter($options["site_url"], (is_ssl() ? 'https://' : 'http://') . $options["cdn_domain_name"], $options["directories"], $options["excluded"], $options["disable_admin"]);
			return $rewriter->rewrite($buffer);
		} else {
			return $buffer;
		}
	}
}
if (class_exists("BunnyCDNFilter")) {
	

	class PegasaasBunnyCDNFilter extends BunnyCDNFilter {
		public function pegasaas_rewrite($buffer) {
			return $this->rewrite($buffer);
		}
	}
}

