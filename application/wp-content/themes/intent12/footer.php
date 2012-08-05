<div class="clear"></div>
<?php if(bandit::get_option('footer-widgets') || bandit::get_option('footer-contact-enable')): ?>
	<div id="subfooter">
		<div id="subfooter-inner" class="container fix">
			<?php if(bandit::get_option('footer-widgets')): ?>
			<div id="subfooter-widgets">
				<ul class="one-fourth">
					<?php dynamic_sidebar('widget-footer-1'); ?>
				</ul>
				<ul class="one-fourth">
					<?php dynamic_sidebar('widget-footer-2'); ?>
				</ul>
				<ul class="one-fourth">
					<?php dynamic_sidebar('widget-footer-3'); ?>
				</ul>
				<ul class="one-fourth last">
					<?php dynamic_sidebar('widget-footer-4'); ?>
				</ul>
				<div class="clear"></div>
			</div><!--/subfooter-widgets-->
			<?php endif; ?>

			<?php if(bandit::get_option('footer-contact-enable')): ?>
			<div id="subfooter-contact" class="fix">
				<?php if(bandit::get_option('footer-address')) { echo '<p id="contact-address">'.bandit::get_option('footer-address').'</p>'; } ?>
				<?php if(bandit::get_option('footer-phone')) { echo '<p id="contact-phone">'.bandit::get_option('footer-phone').'</p>'; } ?>
				<?php if(bandit::get_option('footer-email')) { echo '<p id="contact-email"><a href="mailto:'.bandit::get_option('footer-email').'">'.bandit::get_option('footer-email').'</a></p>'; } ?>
			</div><!--/subfooter-contact-->
			<?php endif; ?>

		</div><!--/subfooter-inner-->
	</div><!--/subfooter-->
<?php endif; ?>
	
	<footer id="footer" class="fix">
		<div id="footer-inner" class="container fix">
			<div class="one-half">
				<?php wp_nav_menu(array('container'=>'nav','container_id'=>'nav-footer','theme_location'=>'bandit_nav_footer','menu_id'=>'nav-alt','menu_class'=>'fix', 'fallback_cb'=>FALSE)); ?>
				<div class="clear"></div>
				<p id="copy"><?php bandit::footer_text(); ?></p>
			</div>
			<div class="one-half last">
				<a id="to-top" href="#"><i class="icon-top"></i></a>
				<?php bandit::social_media_links(array('id'=>'footer-social')); ?>
			</div>
		</div><!--/footer-inner-->
	</footer><!--/footer-->
	
</div><!--/wrap-->
<?php wp_footer(); ?>
</body>
</html>