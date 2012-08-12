<?php

// Page ID
global $wp_query;
$page_id = $wp_query->get_queried_object_id();

// Heading
$heading = get_post_meta($page_id,'_front_portfolio_heading',TRUE);

// Content
$content = get_post_meta($page_id,'_front_portfolio_content',TRUE);

// Category
$category = get_post_meta($page_id,'_front_portfolio_category',TRUE);

// Portfolio loop arguments
$args = array(
	'post_type'	=> 'portfolio',
	'showposts'	=> 3
);

// Portfolio loop category
if($category) {
	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'portfolio_category',
			'field'		=> 'id',
			'terms'		=> $category
		)
	);
}

// Portfolio loop
$loop = new WP_Query($args);
?>

<div id="front-work" class="front">
	<div id="front-work-inner" class="container fix">
	
		<div class="one-fourth">
			<div class="text block-right">
				<?php if($heading) { echo '<h3>'.$heading.'</h3>'; } ?>
				<?php if($content) { echo wpautop($content); } ?>
			</div>
		</div>
		
		<?php while($loop->have_posts()): $loop->the_post(); ?>

		<?php
			$classes = 'work-item one-fourth';
			if('0'==$loop->current_post) { $classes .= ' first'; }
			if('2'==$loop->current_post) { $classes .= ' last'; }
			// Is there a custom link?
			$clink = get_post_meta($post->ID,'_link',TRUE);
			$link = $clink?$clink:get_permalink();
		?>

		<article class="<?php echo $classes; ?>">
			<a class="work-thumbnail" title="<?php the_title(); ?>" href="<?php echo $link; ?>">
				<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'portfolio-thumbnail-large'); ?>
				<img src="<?php echo $img[0]; ?>">
				<span class="zoom"><i class="icon-zoom"></i></span>
			</a>
			<a class="work-meta" href="<?php echo $link; ?>">
				<h4 class="work-title"><?php the_title() ;?></h4>
				<span class="work-category"><?php echo air_portfolio::get_category_list(); ?></span>
			</a>
		</article><!--/work-item-->
		<?php endwhile; ?>
		
	</div>
</div><!--/front-work-->