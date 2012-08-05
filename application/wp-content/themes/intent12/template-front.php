<?php
/*
Template Name: Front
*/

global $meta;
$meta = get_post_custom(); // Custom fields
?>

<?php get_header(); ?>

<?php // Is slider enabled on front page ?
if(isset($meta['_front_slider_enable'])) {
	// Set slider layout
	$s_layout = isset($meta['_front_slider_layout'])?$meta['_front_slider_layout'][0]:'_front-slider-1';
	// Get slider template
	if($s_layout=='_front-slider-1' || $s_layout=='_front-slider-3') {
		get_template_part($s_layout);
	}
}
?>

<?php while (have_posts()) : the_post(); ?>
<div id="page" class="front">
	<div id="page-inner" class="container fix">
	<?php
		if(isset($s_layout) && ($s_layout=='_front-slider-2' || $s_layout=='_front-slider-4')) {
			get_template_part($s_layout);
		}
	?>

		<div id="content">
			<div id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</div>
		</div><!--/content-->
	</div><!--/page-inner-->
</div><!--/page-->
<?php endwhile; ?>

<?php

// Is portfolio enabled on front page ?
if(isset($meta['_front_portfolio_enable'])) {
	// Set portfolio layout
	$p_layout = isset($meta['_front_portfolio_layout'])?$meta['_front_portfolio_layout'][0]:'_front-portfolio-1';
	// Get portfolio template
	get_template_part($p_layout);
}

// Is blog enabled on front page ?
if(isset($meta['_front_blog_enable'])) {
	// Set blog layout
	$b_layout = isset($meta['_front_blog_layout'])?$meta['_front_blog_layout'][0]:'_front-blog-1';
	// Get blog template
	get_template_part($b_layout);
}

?>

<?php get_footer(); ?>