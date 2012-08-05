<?php get_header(); ?>

<?php if(bandit::get_option('blog-heading')): ?>
<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h2><?php bandit::blog_heading(); ?></h2>
	</div><!--/page-title-inner-->
</div><!--/page-title-->
<?php endif; ?>

<div id="page">
	<div id="page-inner" class="container fix">
		
		<div id="content-part">
			<?php get_template_part('_loop-single'); ?>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-right">	
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>