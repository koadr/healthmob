<?php

/**
	Theme Library :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package AirTheme
		@version 1.0
**/

//! AirTheme
class AirTheme extends AirBase {

	/**
		Initialize
			@public
	**/
	static function init() {
		# Set default options, if necessary
		if(!self::$option) { self::set_default_options(); }

		# Create images table, if necessary
		self::create_images_table();

		# Load common theme library
		require(AIR_PATH.'/theme/bandit.php');

		# Enqueue scripts
		add_action('wp_enqueue_scripts',__CLASS__.'::enqueue_scripts');

		# Remove SEO options, if necessary
		if(class_exists('All_in_One_SEO_Pack')) {
			unset(self::$config['theme-options-menu']['seo']);
		}
	}

	/**
		Set default options
			@private
	**/
	private static function set_default_options() {
		# Theme defaults
		$defaults = array(
			'version'					=> self::get_config('theme_version'),
			'style'						=> '0',
			'blog-format'				=> '0',
			'post-content-home'			=> '1',
			'comments-form-location'	=> 'bottom',
			'comments-pages-disable'	=> '1',
			'seo-title-append-sitename'	=> '1',
			'seo-noindex-author'		=> '1',
			'seo-noindex-date'			=> '1',
			'seo-noindex-tag'			=> '1',
			'seo-nofollow-author'		=> '1',
			'seo-nofollow-date'			=> '1',
			'seo-nofollow-tag'			=> '1',
			'seo-noodp'					=> '1',
			'seo-noydir'				=> '1'
		);

		# Save defaults
		update_option('bandit-intent',$defaults);
	}


	/**
		Enqueue scripts
			@public
	**/
	static function enqueue_scripts() {
		# comment-reply.js
		if(is_singular()) { wp_enqueue_script('comment-reply'); }

		# jquery.theme.js
		wp_enqueue_script('theme');
	}

	/**
		Admin Category Dropdown
			@public
	**/
	static function admin_category_dropdown($args) {
		# Arguments for category dropdown
		$cat_args = array(
			'show_option_all'	=> __('All Categories','intent'),
			'hide_empty' 		=> 0,
			'name'		 		=> $args['name'],
			'orderby'	 		=> 'name',
			'selected'	 		=> self::get_option($args['id'])
		);
		# Create dropdown
		wp_dropdown_categories($cat_args);
	}

	/**
		Create table
			@private
	**/
	private static function create_images_table() {
		global $wpdb;
		$table_name='bandit_images';
		// Create dynamic images table if it doesn't exist
		if(!$wpdb->get_var("show tables like '".$table_name."'")) {
			$sql = "CREATE TABLE  ".$table_name." (
							image_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
							post_id bigint(20) unsigned NOT NULL,
							image_file varchar(255) DEFAULT '' NOT NULL,
							UNIQUE KEY image_id (image_id)
							) CHARSET=utf8;";
			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}

	/**
		Portfolio Meta Category Dropdown
			@public
	**/
	static function portfolio_meta_category_dropdown() {
		# Get terms
		$terms = get_terms('portfolio_category');
		# Build dropdown choices
		$choices = array(__('All Categories','intent'));
		if($terms) {
			foreach($terms as $term) {
				$choices[$term->term_id] = $term->name;
			}
		}
		return $choices;
	}
	
	/**
		Convert hexadecimal to rgb
			@public
	**/
	static function hex2rgb($hex,$array=FALSE) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array($r, $g, $b);
		if(!$array) { $rgb = implode(",", $rgb); } // separated values by commas
		return $rgb; // returns an array with the rgb values
	}

	/**
		Write advanced styles to style-advanced.css
			@public
	**/
	static function write_advanced_css($option) {
		$file = get_template_directory().'/style-advanced.css';

		if(is_writable($file)) {
			$styles = '/* Note : Do not place custom styles in this stylesheet */'."\n\n";
			
			
			// header text color
			$styles .= '#logo a, #tagline, #nav li a { ';
			if($option['styling-header-text-color']) { $styles .= 'color: #'.$option['styling-header-text-color'].'; ';	}
			$styles .= '}'."\n";
			
			// header
			$styles .= '#header { ';
			// header background color
			if($option['styling-header-bg-color']) { $styles .= 'background-color: #'.$option['styling-header-bg-color'].'; ';	}
			// header background image
			if($option['styling-header-bg-image']) { $styles .= 'background-image: url('.$option['styling-header-bg-image'].'); '; }
			// header background repeat
			if($option['styling-header-bg-image-repeat']) { $styles .= 'background-repeat: '.$option['styling-header-bg-image-repeat'].'; '; }	
			$styles .= '}'."\n";
			
			// subheader
			$styles .= '#subheader { ';
			// subheader background color
			if($option['styling-subheader-bg-color']) { $styles .= 'background-image: none; background-color: #'.$option['styling-subheader-bg-color'].'; ';	}
			// subheader background image
			if($option['styling-subheader-bg-image']) { $styles .= 'background-image: url('.$option['styling-subheader-bg-image'].'); '; }
			// subheader background repeat
			if($option['styling-subheader-bg-image-repeat']) { $styles .= 'background-repeat: '.$option['styling-subheader-bg-image-repeat'].'; '; }	
			$styles .= '}'."\n";
			
			// body
			$styles .= 'body { ';
			// body background color
			if($option['styling-body-bg-color']) { $styles .= 'background-color: #'.$option['styling-body-bg-color'].'; ';	}
			// body background image
			if($option['styling-body-bg-image']) { $styles .= 'background-image: url('.$option['styling-body-bg-image'].'); '; }
			// body background repeat
			if($option['styling-body-bg-image-repeat']) { $styles .= 'background-repeat: '.$option['styling-body-bg-image-repeat'].'; '; }	
			$styles .= '}'."\n";
			
			// footer
			$styles .= '#footer { ';
			// footer background color
			if($option['styling-footer-bg-color']) { $styles .= 'background-color: #'.$option['styling-footer-bg-color'].'; ';	}
			// footer background image
			if($option['styling-footer-bg-image']) { $styles .= 'background-image: url('.$option['styling-footer-bg-image'].'); '; }
			// footer background repeat
			if($option['styling-footer-bg-image-repeat']) { $styles .= 'background-repeat: '.$option['styling-footer-bg-image-repeat'].'; '; }	
			$styles .= '}'."\n";

			// misc shadows
			if($option['styling-misc-shadows-1']) { $styles .= '#subheader, #footer, #flex-front-3.flexslider { -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; } '."\n"; }
			if($option['styling-misc-shadows-2']) { $styles .= '#header, #subfooter { -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; } '."\n"; }
			
			// theme color
			if($option['styling-color-1']) {
				$rgb = self::hex2rgb($option['styling-color-1']);
				$styles .= '
a,
#nav li a:hover, 
#nav li:hover a, 
#nav li.current_page_item a, 
#nav li.current-menu-ancestor a, 
#nav li.current-menu-item a,
ul#breadcrumbs li a:hover,
.entry-title a:hover,
.widget_archive ul li,
.widget_categories ul li,
.widget_links ul li,
.widget_rss ul li a,
.widget_tag_cloud .tagcloud a:hover,
.widget_calendar a,
.work-item:hover a.work-meta .work-title,
.work-item a.work-meta:hover .work-title,
.sitemap a:hover,
#child-menu li li.current_page_item a, #child-menu li li.current-menu-item a ,
#child-menu li li li.current_page_item a, #child-menu li li li.current-menu-item a,
#child-menu-alt li li li.current_page_item a,
#child-menu-alt li li li.current-menu-item a,
#child-menu-alt li li li.current_page_item a:hover,
#child-menu-alt li li li.current-menu-item a:hover,
ul.tabs-nav li a.active { color: #'.$option['styling-color-1'].'; }

a.item-large:hover span.featured-title,
.entry-comments a.bubble:hover,
.entry-comments a.bubble:hover span,
.entry-format.link p a,
.widget_calendar caption,
ul#work-filter li a:hover,
ul#work-filter li.current a,
#child-menu-alt li li.current_page_item a, 
#child-menu-alt li li.current-menu-item a,
#child-menu-alt li li.current_page_parent a, 
#child-menu-alt li li.current_page_item a:hover, 
#child-menu-alt li li.current-menu-item a:hover,
#child-menu-alt li li.current_page_parent a:hover,
input[type="submit"],
button[type="submit"],
a.button,
.plan.featured .plan-head,
.toggle .title .icon,
.accordion .title .icon,
ol.commentlist li.comment .comment-body .reply a:hover,
#footer a#to-top:hover { background-color: #'.$option['styling-color-1'].'; }

#nav li.current_page_item a, 
#nav li.current-menu-ancestor a, 
#nav li.current-menu-item a,
.work-item:hover a.work-meta,
.work-item a.work-meta:hover,
.plan.featured { border-color: #'.$option['styling-color-1'].'; }

#nav li a:hover, 
#nav li:hover a,
#nav ul,
ul.tabs-nav li a.active { border-top-color: #'.$option['styling-color-1'].'; }

.wp-pagenavi a { color: #'.$option['styling-color-1'].'!important; border: 1px solid rgba('.$rgb.', 0.3)!important; }
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { background: #'.$option['styling-color-1'].'!important; border: 1px solid #'.$option['styling-color-1'].'!important; }
				'."\n";
			}

			// open file for writing
			$fh = fopen($file, 'w');
			// write styles
			fwrite($fh, $styles);
			// close file
			fclose($fh);

		} else {
			// Cannot write to style-advanced.css
			return FALSE;
		}
		return TRUE;
	}

}