<div id="air-wrap">

	<div id="air-header">
		<a id="wpbandit-logo" href="http://wpbandit.com">WPBandit</a>
		<div id="air-theme-version"><?php echo Air::get_config('theme_name').' '.Air::get_config('theme_version'); ?></div>
		<div id="air-air-version"><?php echo Air::TEXT_Name.' '.Air::TEXT_Version; ?></div>
	</div><!--/air-header-->

	<div id="air-content">

		<div id="air-sidebar">
			<ul id="air-menu">
				<li class="air-menu-title">Theme Options</li>
				<?php Air::print_theme_admin_menu(); ?>
			</ul>
		</div><!--/air-sidebar-->

		<div id="air-main">

			<div id="air-subheader">
				<?php if(isset($_GET['settings-updated']) && ('true'===$_GET['settings-updated'])): ?>
					<div id="air-save-notice">
						<p>Settings saved.</p>
					</div>
				<?php endif; ?>
				<ul id="air-headmenu">
					<li><a href="<?php echo admin_url('/admin.php?page=theme-options&section=changelog'); ?>"><i class="air-icon air-icon-changelog"></i>View Changelog</a></li>
					<li><a href="http://member.wpbandit.com/forums/" target="_blank"><i class="air-icon air-icon-forums"></i>View Forums</a></li>
				</ul>
			</div><!--/air-subheader-->

			<form method="post" action="options.php">
				<div id="air-main-inner" class="air-text">
					<div class="air-section">

						<?php if(!in_array($section,array('help','changelog'))): ?>
							<?php settings_fields('air-settings'); ?>
							<?php do_settings_sections('air-'.$section); ?>				
							<input type="hidden" name="<?php echo Air::$option_name; ?>[section]" value="<?php echo $section; ?>">
						<?php elseif('help'===$section): ?>
							<?php require(AIR_PATH.'/gui/air-section-help.php'); ?>
						<?php elseif('changelog'===$section): ?>
							<pre><?php require(get_template_directory().'/changelog.txt'); ?></pre>
						<?php endif; ?>
						
					</div>
					<div class="air-clear"></div>
				</div><!--/air-main-inner-->
			
				<?php if(!in_array($section,array('help','changelog'))): ?>
				<div id="air-footer">
					<p class="submit air-submit">
						<input type="submit" name="<?php echo Air::$option_name; ?>[reset]" class="button-secondary" value="Reset Options" />
						<input type="submit" class="button-primary" value="Save Changes" />
					</p>
				</div><!--/air-footer-->
				<?php endif; ?>
			</form>

		</div><!--/air-main-->

		<div class="air-clear"></div>
	</div><!--/air-content-->

</div><!--/air-wrap-->