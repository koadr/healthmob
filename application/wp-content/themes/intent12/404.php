<?php get_header(); ?>

<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h2><?php _e("Hmm, we couldn't find that page.",'intent'); ?></h2>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">

		<div id="content-part">
			<article class="entry">
				<div class="text">
					<p><?php _e("We're not sure what you're looking for, but it's not here. But don't worry, we can help you get back on track. From here, you can:",'intent'); ?></p>
					<div class="clear"></div>

					<div>
						<a href="<?php echo site_url(); ?>">Go to the Homepage →</a>
					</div>
				</div>
			</article>
		</div><!--/content-part-->

		<div id="sidebar" class="sidebar-right">
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->

	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>