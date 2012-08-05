<?php get_header(); ?>

<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h2><?php _e('Error 404. <span>Oops!</span>','intent'); ?></h2>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">

		<div id="content-part">
			<article class="entry">
				<div class="text">
					<h1><?php _e('Something went wrong.','intent'); ?></h1>
					<p><?php _e('The page you are looking for could not be found.','intent'); ?></p>
					<div class="clear"></div>
				</div>
			</article>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-right">	
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>