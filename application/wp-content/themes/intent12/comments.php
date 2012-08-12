<?php if((comments_open() && bandit::comments_enabled()) || have_comments()): ?>
<div id="entry-comments">
	<div id="comments">

	<?php if(comments_open() && bandit::comments_enabled() && ('top'==bandit::get_option('comments-form-location'))): ?>
		<div id="commentform" class="noI">
			<?php get_template_part('comment-form'); ?>
		</div>
	<?php endif; ?>


	<?php if (have_comments()): ?>
		<h4 class="heading"><span><?php printf( _n('%1$s Comment','%1$s Comments',get_comments_number(),'intent'), number_format_i18n(get_comments_number()) ); ?></span></h4>

		<ol class="commentlist fix">
			<?php wp_list_comments('avatar_size=50'); ?>
		</ol>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(); ?></div>
				<div class="nav-next"><?php next_comments_link(); ?></div>
				<div class="clear"></div>
			</div><!--/navigation -->
		<?php endif; // check for comment navigation ?>
	<?php endif; ?>


	<?php if(comments_open() && bandit::comments_enabled() && ('bottom'==bandit::get_option('comments-form-location'))): ?>
		<div id="commentform" class="noI">
			<?php get_template_part('comment-form'); ?>
		</div>
	<?php endif; ?>

	</div><!--/#comments-->
</div><!--/#entry-comments-->
<?php endif; ?>
