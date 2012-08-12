<?php get_header(); ?>

<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h2><?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e('Search results for','intent'); ?> <span>"<?php echo get_search_query(); ?>"</span></h2>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">

		<div id="content-part">
			<?php if(!have_posts()): ?>
			<article class="entry">
				<div class="text">
					<h1><?php _e('No search results','intent'); ?></h1>
					<p><?php _e('The good news is you can try again.','intent'); ?></p>
					<form role="search" method="get" action="<?php echo home_url('/'); ?>">
						<div class="fix">
							<input type="text" value="" name="s" id="s" />
							<input type="submit" id="searchsubmit" value="<?php _e('Search','intent'); ?>" />
						</div>
					</form>
					<div class="clear"></div>
				</div>
			</article>
			<?php endif; ?>
			<?php get_template_part('_loop'); ?>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-right">	
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>