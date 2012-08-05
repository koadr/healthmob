<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<div id="page-title" class="fix">
	<div id="page-title-inner" class="container">
		<h1><?php bandit::page_title(); ?></h1>
		<ul id="work-pagination" class="fix">
			<?php next_post_link('<li class="previous">%link</li>','<i class="icon"></i>%title'); ?>
			<?php previous_post_link('<li class="next">%link</li>','<i class="icon"></i>%title'); ?>
		</ul>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<?php
# Template 
$template = get_post_meta($post->ID,'_portfolio_template',TRUE);
if(!$template) { $template = 'left'; }
$template = locate_template('_portfolio-single-'.$template.'.php');

# Post images
$images = bandit::get_post_images();

# Load template
require($template);
?>

<?php endwhile; ?>

<?php get_footer(); ?>