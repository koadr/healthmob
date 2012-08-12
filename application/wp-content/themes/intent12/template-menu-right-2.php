<?php
/*
Template Name: Child Menu Right 2
*/
?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page-title">
	<div id="page-title-inner" class="container fix">
		<h1><?php bandit::page_title(); ?></h1>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">
			
		<div id="content-part">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</article>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-right mobile">	
			<ul id="child-menu-alt">
				<?php wp_list_pages('title_li=&sort_column=post_title&depth=3'); ?>
			</ul>
		</div><!--/sidebar-->

<?php endwhile; ?>
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>