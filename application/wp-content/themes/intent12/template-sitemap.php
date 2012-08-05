<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
<?php get_template_part('_page-image'); ?>

<?php while(have_posts()): the_post(); ?>

<div id="page-title" class="fix">
	<div id="page-title-inner" class="container">
		<h2><?php bandit::page_title(); ?></h2>
	</div><!--/page-title-inner-->
</div><!--/page-title-->

<div id="page">
	<div id="page-inner" class="container fix">
		<div id="content">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
				<div class="sitemap fix">
					<div class="one-third">
						<h4 class="heading"><?php _e('Pages','intent'); ?></h4>
						<ul><?php wp_list_pages("title_li=" ); ?></ul>								
					</div>
					<div class="one-third">
						<h4 class="heading"><?php _e('All Blog Posts:','intent'); ?></h4>
						<ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8'); while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
								(<?php comments_number('0', '1', '%'); ?>)
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<div class="one-third last">
						<h4 class="heading"><?php _e('Feeds','intent'); ?></h4>
						<ul>
							<li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','intent'); ?></a></li>
							<li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','intent'); ?></a></li>
						</ul>
						<h4 class="heading"><?php _e('Categories','intent'); ?></h4>
						<ul><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&feed=RSS&title_li='); ?></ul>
						<h4 class="heading"><?php _e('Archives','intent'); ?></h4>
						<ul><?php wp_get_archives('type=monthly&show_post_count=true'); ?></ul>
					</div>
				</div><!--/sitemap-->
			</article>
		</div>
		
	</div><!--/page-inner-->
</div><!--/page-->

<?php endwhile;?>

<?php get_footer(); ?>