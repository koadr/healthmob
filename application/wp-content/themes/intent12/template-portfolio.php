<?php
/*
Template Name: Portfolio
*/

// Meta fields
$meta = get_post_custom();

// Current class
$current_class = ' class="current"';

// Layout
$layout = isset($meta['_portfolio_layout'])?$meta['_portfolio_layout'][0]:'one-fourth';

// Category
$category = isset($meta['_portfolio_category'])?$meta['_portfolio_category'][0]:'0';

// Lightbox
$lightbox = isset($meta['_portfolio_lightbox'])?$meta['_portfolio_lightbox'][0]:FALSE;
$gallery = isset($meta['_portfolio_lightbox_gallery'])?'rel="gallery"':'';

// Portfolio loop arguments
$args = array(
	'post_type'			=> 'portfolio',
	'posts_per_page'	=> -1,
	'orderby'			=> isset($meta['_portfolio_orderby'])?$meta['_portfolio_orderby'][0]:'title',
	'order'				=> isset($meta['_portfolio_order'])?$meta['_portfolio_order'][0]:'ASC',
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

<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<div id="page-title" class="fix">
	<div id="page-title-inner" class="container">
		<h1><?php bandit::page_title(); ?></h1>

		<?php if(!isset($meta['_portfolio_disable_switcher'])): ?>
		<ul id="work-size" class="fix" data-current="<?php echo $layout; ?>">
			<li><a id="switch-small" href="#" data-layout="one-fourth"><i class="icon-size small"></i>Small</a></li>
			<li><a id="switch-medium" href="#" data-layout="one-third"><i class="icon-size medium"></i>Medium</a></li>
			<li><a id="switch-large" href="#" data-layout="one-half"><i class="icon-size large"></i>Large</a></li>
		</ul>
		<?php endif; ?>

	</div><!--/page-title-inner-->
</div><!--/page-title-->

<?php if(!isset($meta['_portfolio_disable_categories'])): ?>
<div id="filter">
	<div id="filter-inner" class="container fix">
		<ul id="work-filter" class="fix">
			<li class="current"><a href="#" data-filter="*"><?php _e('All','intent'); ?></a></li>
			<?php air_portfolio::isotope_menu($category); ?>
		</ul>
	</div><!--/filter-inner-->
</div><!--/filter-->
<?php endif; ?>

<div id="page" class="work">
	<div id="page-inner" class="container fix">
	
		<div id="content">
		
<script type="text/javascript">
jQuery(document).ready(function() {
	// Isotope
	jQuery('.isotope').isotope({
		animationEngine : 'best-available',
		itemSelector : '.isotope-item',
		layoutMode : 'fitRows'
	});

	// Isotope Chrome Fix
	setTimeout(function () {
		jQuery('.isotope').isotope('reLayout');
	}, 1000);

	<?php if(!isset($meta['_portfolio_disable_switcher'])): ?>
	// Set current filter
	var current_filter = jQuery('#work-size').attr('data-current');

	// Set default filter li class
	jQuery('#work-size li a').each(function(e) {
		var layout = jQuery(this).attr('data-layout');
		if(current_filter == layout) {
			jQuery(this).parent().addClass('current');
		}
	});
	<?php endif; ?>

	<?php if(!isset($meta['_portfolio_disable_categories'])): ?>
	// Portfolio Filter
	jQuery('#work-filter li a').click(function(e) {
		jQuery('#work-filter li').removeClass('current');
		jQuery(this).parent().addClass('current');
		var category = jQuery(this).attr('data-filter');
		jQuery('.isotope').isotope({ filter: category });

		e.preventDefault();
	});
	<?php endif; ?>

	<?php if($lightbox): ?>
	// Portfolio Lightbox
	jQuery('a.work-thumbnail').fancybox({
		//nextEffect: 'fade',
		//prevEffect: 'fade',
		nextSpeed: 500,
		prevSpeed: 500,
	});
	<?php endif; ?>

});
</script>
			
			<section id="work" class="isotope">

				<?php while($loop->have_posts()): $loop->the_post(); ?>
				<?php
					// Get post category slugs
					$classes = $layout.' '.air_portfolio::get_category_slugs(' ');
					// Is there a custom link?
					$clink = get_post_meta($post->ID,'_link',TRUE);
					// Portfolio item link
					if($lightbox) {
						$img_large = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
						$link = $img_large[0];

						if(get_post_meta($post->ID,'_portfolio_video',TRUE)) {
							// Set empty link
							$link = "#";
							// Video URL
							$video_url = get_post_meta($post->ID,'_portfolio_video_url',TRUE);
							// Video Embed Code
							$video_embed_code = get_post_meta($post->ID,'_portfolio_video_embed_code',TRUE);

							// Create lightbox video div
							if(($video_url != '') || ($video_embed_code != '')) {
								// Set lightbox link to video div
								$link = '#video-'.get_the_ID();

								// Start div
								$lightbox_video_div = '<div id="video-'.get_the_ID().'" class="video-container fancybox-video">';

								// Video Url
								if($video_url != '') {
									global $wp_embed;
									$video = $wp_embed->run_shortcode('[embed width="640"]'.$video_url.'[/embed]');
									$lightbox_video_div .= $video;
								}

								// Video Embed Code
								if($video_embed_code != '') {
									$lightbox_video_div .= $video_embed_code;
								}

								// End lightbox video div 
								$lightbox_video_div .= '</div>';

								echo $lightbox_video_div;
							}
						}
					} else {
						$link = $clink?$clink:get_permalink();
					}
				?>

				<div class="isotope-item <?php echo $classes; ?>">
					<article class="work-item">
						<a class="work-thumbnail" <?php echo $gallery; ?> href="<?php echo $link; ?>" title="<?php the_title() ;?>">
							<?php $img=wp_get_attachment_image_src(get_post_thumbnail_id(),'portfolio-thumbnail-large'); ?>
							<img src="<?php echo $img[0]; ?>">
							<span class="zoom"><i class="icon-zoom"></i></span>
						</a>
						<a class="work-meta" href="<?php if($clink) { echo $clink; } else { the_permalink(); } ?>">
							<h4 class="work-title"><?php the_title() ;?></h4>
							<span class="work-category"><?php echo air_portfolio::get_category_list(); ?></span>
						</a>
					</article>
				</div>
				<?php endwhile; ?>
				
				<div class="clear"></div>
			</section>
		</div>
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php get_footer(); ?>