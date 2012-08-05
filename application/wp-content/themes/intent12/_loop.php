<?php $content = bandit::get_content_format(); // Set content format ?>

<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

	<?php if(!bandit::get_option('post-hide-format-icon')): ?>
		<span class="format-icon"><i class="icon"></i></span>
	<?php endif; ?>

	<?php if((bandit::get_option('blog-format') == '1') && has_post_thumbnail()): ?>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<span class="zoom"><i class="icon-zoom"></i></span>
			<?php the_post_thumbnail('post-thumbnail-medium'); ?>
		</a>	
	</div><!--/entry-thumbnail-->
	<div class="entry-wrap-thumbnail">
	<?php else: ?>
	<div class="entry-wrap">
	<?php endif; ?>
	
		<header class="fix">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<div class="entry-comments">
				<a class="bubble" href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?><span></span></a>
			</div>
			<div class="entry-byline fix">	
				<?php if(!bandit::get_option('post-hide-author')): ?>
					<p class="entry-author"><?php _e('By','intent'); ?> <?php the_author_posts_link(); ?></p>
				<?php endif; ?>
				<p class="entry-date"><?php if(!bandit::get_option('post-hide-date')) { the_time('F jS, Y'); } ?></p>
			</div>
		</header>
		<?php if((bandit::get_option('blog-format') == '2') && get_post_format()) { get_template_part('_post-formats'); } ?>
		<div class="clear"></div>
		
		<div class="text">
			<?php if('content'===$content) { the_content(); } ?>
			<?php if('excerpt'===$content) {the_excerpt(); } ?>

			<?php if(('excerpt'===$content) && bandit::get_option('excerpt-more-link-enable')): ?>
				<?php $read_more = bandit::get_option('read-more')?bandit::get_option('read-more'):__('Read More','intent'); ?>
				<p><a class="more-link" href="<?php the_permalink(); ?>"><?php echo $read_more; ?></a></p>
			<?php endif; ?>
		</div>
		
	</div><!--/entry-wrap-->
</article>
<?php endwhile;?>

<?php get_template_part('_nav-posts'); ?>