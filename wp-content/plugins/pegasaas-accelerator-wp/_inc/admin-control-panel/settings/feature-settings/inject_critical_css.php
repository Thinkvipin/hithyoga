					<div class='hidden-novice hidden-intermediate'>
					<b>Where To Inject:</b><br/>
				<form method="post" style="display: inline-block" class='feature-setting-change'>
					<input type="hidden" name="c" value="change-feature-status">
					<input type="hidden" name="f" value="<?php echo $feature; ?>">
					<?php if (in_array($feature, $requires_cache_clearing )) { ?>
					<input type='hidden' name='prompt' value='clear_cache' />
					<?php } ?>							
				<select class='form-control' onchange="submit_form(this)" name="s">
				  <option value="1">Default</option>
				  <option value="2" <?php if ($feature_settings['status'] == "2") { ?>selected<?php } ?>>Before Closing &lt;/head&gt; Tag </option>
				  <option value="3" <?php if ($feature_settings['status'] == "3") { ?>selected<?php } ?>>Before First &lt;link&gt; Tag (default) </option>
				</select>
			</form>
						</div>