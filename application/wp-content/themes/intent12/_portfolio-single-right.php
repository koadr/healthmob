<?php $meta = get_post_custom(); ?>

<div id="page" class="work single">
	<div id="page-inner" class="container fix">
	
		<div id="content-part">
			<div class="work-item-single">
			<?php if(!isset($meta['_portfolio_video'])): ?>
				<div class="flexslider" id="flex-work">
					<ul class="slides">
						<?php foreach($images as $image): ?>
						<?php $img = wp_get_attachment_image_src($image->ID,'post-format'); ?>
						<li><img src="<?php echo $img[0]; ?>" alt="<?php echo $image->post_title; ?>" /></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<script type="text/javascript">
					jQuery(window).load(function() {
						jQuery('#flex-work').flexslider({
							/* slideDirection: "", */
							animation: "fade",
							slideshow: true,
							directionNav: true,
							controlNav: true,
							pauseOnHover: true,
							slideshowSpeed: 7000,
							animationDuration: 600 
						});
						jQuery('.slides').addClass('loaded');
					}); 
				</script>
			<?php endif; ?>

				<?php
				if(isset($meta['_portfolio_video'])) {
					echo '<div class="video-container">';
					if(isset($meta['_portfolio_video_url'])) {
						global $wp_embed;
						$video = $wp_embed->run_shortcode('[embed width="640"]'.$meta['_portfolio_video_url'][0].'[/embed]');
						echo $video;
					} elseif(isset($meta['_portfolio_video_embed_code'][0])) {
						echo $meta['_portfolio_video_embed_code'][0];
					}
					echo '</div>';
				}
				?>

			</div>
		</div><!--/content-part-->
		
		<div id="sidebar" class="sidebar-right work">
			<article>
				<div class="text">
					<p class="work-category"><?php echo air_portfolio::get_category_list(); ?></p>
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			</article>
		</div><!--/sidebar-->
		
	</div><!--/page-inner-->
</div><!--/page-->