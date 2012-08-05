<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>

	<?php if(!bandit::get_option('post-hide-format-icon')): ?>
		<div class="format-icon"><i class="icon"></i></div>
	<?php endif; ?>
	
	<header class="fix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
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

	<?php get_template_part('_post-formats'); ?>

	<div class="clear"></div>
	
	<div class="text">
		<?php the_content(); ?>
		<?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','intent'),'after'=>'</div>')); ?>
		<div class="clear"></div>
	</div>

	<?php if(!bandit::get_option('post-hide-tags')): // Post Tags ?>
		<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','intent').'</span> ','','</p>'); ?>
	<?php endif; ?>

</article>

<?php if(!bandit::get_option('post-hide-categories')): // Post Categories ?>
	<p class="entry-category"><span><?php _e('Posted in:','intent'); ?></span> <?php the_category(' &middot; '); ?></p>
<?php endif; ?>
<?php if(bandit::get_option('post-enable-author-block')): // Post Author Block ?>
	<div class="entry-author-block fix">
		<div class="entry-author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'80'); ?></div>
		<p class="entry-author-name"><?php the_author_meta('display_name'); ?></p>
		<p class="entry-author-description"><?php the_author_meta('description'); ?></p>
	</div>
<?php endif; ?>

<?php comments_template(); ?>

<?php endwhile;?>