<?php $option = air_portfolio::get_var('option_name'); //! Set option name ?>

<form method="post" action="options.php">
<?php settings_fields($option.'-settings'); ?>
<?php do_settings_sections('air-'.$section); ?>

</div>
<div class="air-clear"></div>
</div><!--/air-main-inner-->


<div id="air-footer">
	<p class="submit air-submit">
		<input type="submit" class="button-primary" value="Save Changes" />
	</p>
</div><!--/air-footer-->
</form>

<?php if(isset($_GET['settings-updated'])) { flush_rewrite_rules(); } // Flush rewrite rules ?>