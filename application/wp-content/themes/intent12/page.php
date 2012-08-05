<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page-title" class="fix">
	<div id="page-title-inner" class="container">
		<h1><?php bandit::page_title(); ?></h1>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page" class="fix">
	<div id="page-inner" class="container fix">
		
		<div id="content-part">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</article>
		</div><!--/content-part-->

<?php endwhile; ?>
		
		<div id="sidebar" class="sidebar-right">	
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>