<?php
global $user_identity;
$commenter = wp_get_current_commenter();
?>

<form class="bandit-form fix" action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="respond">

	<header class="header-comments"> 
		<h4 class="heading"><span><?php _e('Leave a comment','intent'); ?></span></h4>
		<?php cancel_comment_reply_link(); ?>

	<?php if (is_user_logged_in()): ?>
	</header>

	<ul class="fix">
	<?php else: ?>
	</header>
	
	<ul class="fix">
		<li class="leftThird">
			<label for="author" class="desc"><?php _e('Name','intent'); ?>
				<span class="req">*</span>
			</label>
			<div>
				<input type="text" name="author" value="<?php echo esc_attr($commenter['comment_author']); ?>" id="author" class="field text medium">
			</div>
		</li>
		<li class="middleThird">
			<label for="email" class="desc"><?php _e('Email','intent'); ?>
				<span class="req">*</span>
			</label>
			<div>
				<input type="text" name="email" value="<?php echo esc_attr($commenter['comment_author_email']); ?>" id="email" class="field text medium">
			</div>
		</li>
		<li class="rightThird">
			<label for="url" class="desc"><?php _e('Website','intent'); ?></label>
			<div>
				<input type="text" name="url" value="<?php echo esc_attr($commenter['comment_author_url']); ?>" id="url" class="field text medium">
			</div>
		</li>
<?php endif; ?>
		<li>
			<div>
				<textarea name="comment" id="comment" cols="50" rows="10" class="field textarea small"></textarea>
			</div>
		</li>
		<li class="buttons">
			<div>
				<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="<?php _e('Submit','intent'); ?>" />
			</div>
		</li>
	</ul>

<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>