<?php $themes = bandit::get_themes_from_envato(); ?>


<?php if(isset($themes)): foreach($themes as $theme): ?>
<div class="theme">
	<p>
		<a href="<?php echo $theme['url']; ?>" title="<?php echo $theme['name']; ?>" target="_blank">
			<img src="<?php echo $theme['preview']; ?>" />
		</a>
	<p>
</div>
<?php endforeach; endif; ?>