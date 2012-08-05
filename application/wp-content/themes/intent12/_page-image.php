<?php if(has_post_thumbnail()): ?>
<div id="subheader" class="page-image">
	<?php $image_id = get_post_thumbnail_id(); ?>
	<?php $image = bandit::dynamic_resize($image_id,'','1600','320',TRUE); ?>
	
	<img src="<?php echo $image['url']; ?>" />
	
	<div id="page-image-text">
		<?php bandit::post_thumbnail_caption(); ?>
	</div>
	<div class="container">
		<div id="page-image-cover"></div>
	</div>
</div><!--/subheader-->
<?php endif; ?>	