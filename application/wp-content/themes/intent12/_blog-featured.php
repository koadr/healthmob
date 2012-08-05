<?php

# Get featured post options 
$cat1 = bandit::get_option('featured-cat-1');
$cat2 = bandit::get_option('featured-cat-2');
$cat1_num = bandit::get_option('featured-cat-1-num');

# Array of excluded posts
$exclude = array();

# Set category 1 query arguments
$args1 = array(
	'cat' => $cat1,
	'showposts'	=> $cat1_num,
	'ignore_sticky_posts' => 1
);

# Query category 1 posts
$feat1 = new WP_Query($args1);

?>

<div id="subheader">
	<div id="subheader-inner" class="container fix">
		<div id="blog-featured" class="fix">
			<div class="flexslider" id="flex-blog">
				<ul class="slides">
					<?php while($feat1->have_posts()): $feat1->the_post(); $exclude[]=get_the_ID(); ?>
					<?php $img=wp_get_attachment_image_src(get_post_thumbnail_id(),'post-thumbnail-large'); ?>
					<?php if(!$img) { $img[0] = get_template_directory_uri().'/img/placeholder.png'; } ?>
					<li <?php post_class(); ?>>
						<a class="item-large" href="<?php the_permalink(); ?>">
							<img src="<?php echo $img[0]; ?>">
							<span class="flex-caption"><?php the_title(); ?></span>
						</a>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>

<?php
# Set category 2 query arguments
$args2 = array(
	'cat' => $cat2,
	'showposts'	=> 3,
	'ignore_sticky_posts' => 1
);

# Are category 1 and 2 the same ?
if(($cat1==$cat2) || ('0'==$cat1) || ('0'==$cat2)) { $args2['post__not_in'] = $exclude; }

# Query category 2 posts
$feat2 = new WP_Query($args2);
?>

			<?php while($feat2->have_posts()): $feat2->the_post(); $exclude[]=get_the_ID(); ?>
			<?php $img=wp_get_attachment_image_src(get_post_thumbnail_id(),'post-thumbnail-medium'); ?>
			<?php if(!$img) { $img[0] = get_template_directory_uri().'/img/placeholder-small.png'; } ?>
			<article <?php post_class(); ?>>
				<a class="item-small" href="<?php the_permalink(); ?>">
					<span class="featured-image">
						<img src="<?php echo $img[0]; ?>" />
						<span class="zoom"><i class="icon-zoom"></i></span>
					</span>
					<span class="featured-title"><?php echo bandit::limit_characters(get_the_title(),54); ?></span>
					<span class="featured-excerpt"><?php echo bandit::limit_characters(get_the_excerpt(),140); ?></span>
				</a>
			</article>
			<?php endwhile; ?>

		</div>

<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#flex-blog').flexslider({
		/* slideDirection: "", */
		animation: "fade",
		slideshow: true,
		directionNav: false,
		controlNav: true,
		pauseOnHover: true,
		slideshowSpeed: 7000,
		animationDuration: 600 
	});
	jQuery('.slides').addClass('loaded');
}); 
</script>

	</div>
</div>

<?php
# Exclude featured posts from content area ?
if(!bandit::get_option('featured-content')) {
	# Reset post data
	wp_reset_postdata();
	# Exclude featured posts from main content area
	global $wp_query;
	$args = array_merge($wp_query->query, array('post__not_in' => $exclude));
	query_posts($args);
}
?>